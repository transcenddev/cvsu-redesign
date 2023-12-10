<?php

namespace WPDeveloper\BetterDocs\Core;

use WP_Post;
use WPDeveloper\BetterDocs\Utils\Base;
use WPDeveloper\BetterDocs\Utils\Database;
use WPDeveloper\BetterDocs\Dependencies\DI\Container;

class PostType extends Base {
    public $post_type = 'docs';
    public $position  = 5;
    public $category  = 'doc_category';
    public $tag       = 'doc_tag';

    public $docs_archive;
    public $docs_slug;
    public $cat_slug;
    /**
     * Database
     * @var Database
     */
    private $database = null;

    /**
     * Summary of Settings
     * @var Settings
     */
    private $settings = null;

    /**
     * Rewrite class
     * @var Rewrite
     */
    private $rewrite = null;

    /**
     * Initially Invoked Functions
     * @since 2.5.0
     *
     * @param Container $container
     */
    public function __construct( Container $container ) {
        $this->database     = $container->get( Database::class );
        $this->settings     = $container->get( Settings::class );
        $this->rewrite     = $container->get( Rewrite::class );

        $this->docs_archive = $this->docs_slug();
        $this->docs_slug    = $this->docs_slug();
        $this->cat_slug     = $this->category_slug();
    }

    public static function permalink_structure() {
        return apply_filters( "betterdocs_doc_permalink_default", ( self::get_instance( betterdocs()->container ) )->docs_slug() );
    }

    public function init() {
        add_filter( 'post_type_link', [$this, 'post_link'], 1, 3 );
        add_filter( 'rest_docs_collection_params', [$this, 'add_rest_orderby_params'], 10, 1 );
        add_filter( 'rest_doc_category_collection_params', [$this, 'add_rest_orderby_params_on_doc_category'], 10, 1 );
        add_filter( 'rest_doc_category_query', [$this, 'modify_doc_category_rest_query'], 10, 2 );
    }

    /**
     * Add menu_order param to the list of rest api orderby values
     */
    public function add_rest_orderby_params( $params ) {
        $params['orderby']['enum'][] = 'menu_order';
        return $params;
    }

    /**
     * Add doc_category_order param to the list of rest api orderby values on doc_category taxonomy
     */
    public function add_rest_orderby_params_on_doc_category( $params ) {
        $params['orderby']['enum'][] = 'doc_category_order';
        return $params;
    }

    /**
     * Modify doc_category rest query for doc_category_order meta key
     */
    public function modify_doc_category_rest_query( $args, $request ) {
        $order_by = $request->get_param( 'orderby' );
        if ( isset( $order_by ) && 'doc_category_order' === $order_by ) {
            $args['meta_key'] = $order_by;
            $args['orderby']  = 'meta_value_num';
        }
        return $args;
    }

    public function post_link( $url, $post, $leavename = false ) {
        if ( 'docs' != get_post_type( $post ) ) {
            return $url;
        }

        $cat_terms = wp_get_object_terms( $post->ID, 'doc_category' );

        if ( is_array( $cat_terms ) && ! empty( $cat_terms ) ) {
            $doccat_terms = $cat_terms[0]->slug;
        } else {
            $doccat_terms = 'uncategorized';
        }

        $url = str_replace( '%doc_category%', $doccat_terms, $url );
        return apply_filters( 'betterdocs_post_type_link', $url, $post, $leavename );
    }

    public function ajax() {
        /**
         * All kind of ajax related to post type: docs
         * for admin side.
         */
        add_action( 'wp_ajax_update_doc_cat_order', [$this, 'update_category_order'] );
        add_action( 'wp_ajax_update_doc_order_by_category', [$this, 'update_docs_order_by_category'] );
        add_action( 'wp_ajax_update_docs_term', [$this, 'update_docs_term'] );
    }

    public function admin_init() {
        $this->ajax();

        add_action( 'new_to_auto-draft', [$this, 'auto_add_category'] );
        add_action( 'save_post_docs', [$this, 'save_docs'] );
        add_action( 'rest_after_insert_docs', [$this, 'save_docs'] );

        // Doc Category Taxonomy EXTRA Fields
        add_action( 'admin_enqueue_scripts', [$this, 'scripts'] );

        if( ! is_admin() ) {
            return;
        }

        add_action( 'doc_category_add_form_fields', [$this, 'add_form_fields'], 10, 2 );
        add_action( 'doc_category_edit_form_fields', [$this, 'edit_form_fields'], 10, 2 );
        add_action( 'created_doc_category', [$this, 'save_category_meta'], 11, 2 );
        add_action( 'edited_doc_category', [$this, 'updated_category_meta'], 11, 2 );

        // Order the terms on the admin side.
        add_action( 'admin_head', [$this, 'order_terms'] );
    }

    public function scripts( $hook ) {
        $current_screen = get_current_screen();
        if ( isset( $current_screen->id ) && $current_screen->id !== 'edit-doc_category' ) {
            return;
        }

        wp_enqueue_media();

        betterdocs()->assets->enqueue( 'betterdocs-category-edit', 'admin/js/category-edit.js' );

        betterdocs()->assets->localize( 'betterdocs-category-edit', 'betterdocsCategorySorting', [
            'action'      => 'update_doc_cat_order',
            'selector'    => '.taxonomy-doc_category',
            'ajaxurl'     => admin_url( 'admin-ajax.php' ),
            'nonce'       => wp_create_nonce( 'doc_cat_order_nonce' ),
            'paged'       => isset( $_GET['paged'] ) ? absint( wp_unslash( $_GET['paged'] ) ) : 0,
            'per_page_id' => "edit_{$current_screen->taxonomy}_per_page"
        ] );
    }

    public function add_form_fields( $taxonomy ) {
        betterdocs()->views->get( 'admin/taxonomy/add' );
    }

    public function edit_form_fields( $term, $taxonomy ) {
        $term_meta   = get_option( "doc_category_$term->term_id" );
        $cat_order   = get_term_meta( $term->term_id, 'doc_category_order', true );
        $cat_icon_id = get_term_meta( $term->term_id, 'doc_category_image-id', true );

        betterdocs()->views->get( 'admin/taxonomy/edit', [
            'term'    => $term,
            'meta'    => $term_meta,
            'order'   => $cat_order,
            'icon_id' => $cat_icon_id
        ] );
    }

    public function save_category_meta( $term_id, $tt_id ) {
        if ( isset( $_POST['term_meta'] ) ) {
            $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ) {
                if ( isset( $_POST['term_meta'][$key] ) ) {
                    add_term_meta( $term_id, "doc_category_$key", sanitize_text_field( $_POST['term_meta'][$key] ) );
                }
            }
        }

        // @todo PRO
        if ( isset( $_POST['doc_category_kb'] ) ) {
            $doc_category_kb = rest_sanitize_array( $_POST['doc_category_kb'] );
            update_term_meta( $term_id, "doc_category_knowledge_base", $doc_category_kb );
        }

        // Default the taxonomy's terms' order if it's not set.
        $this->set_term_order( $term_id, $tt_id );
    }

    public function set_term_order( $term_id, $tt_id ) {
        $order = $this->get_max_taxonomy_order( 'doc_category' );
        update_term_meta( $term_id, 'doc_category_order', $order++ );
    }

    /**
     * Get the maximum doc_category_order for this taxonomy.
     * This will be applied to terms that don't have a tax position.
     */
    private function get_max_taxonomy_order( $tax_slug ) {
        global $wpdb;

        $max_term_order = $wpdb->get_col(
            $wpdb->prepare(
                "SELECT MAX( CAST( tm.meta_value AS UNSIGNED ) )
				FROM $wpdb->terms t
				JOIN $wpdb->term_taxonomy tt ON t.term_id = tt.term_id AND tt.taxonomy = '%s'
				JOIN $wpdb->termmeta tm ON tm.term_id = t.term_id WHERE tm.meta_key = 'doc_category_order'",
                $tax_slug
            )
        );

        $max_term_order = is_array( $max_term_order ) ? current( $max_term_order ) : 0;

        return (int) $max_term_order === 0 || empty( $max_term_order ) ? 1 : (int) $max_term_order + 1;
    }

    public function updated_category_meta( $term_id ) {
        if ( isset( $_POST['term_meta'] ) ) {
            $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ) {
                if ( isset( $_POST['term_meta'][$key] ) ) {
                    update_term_meta( $term_id, "doc_category_$key", $_POST['term_meta'][$key] );
                }
            }
        }
        if ( isset( $_POST['doc_category_kb'] ) ) {
            $doc_category_kb = rest_sanitize_array( $_POST['doc_category_kb'] );
            update_term_meta( $term_id, "doc_category_knowledge_base", $doc_category_kb );
        }
    }

    /**
     * Summary of order_terms
     * @return void
     */
    public function order_terms() {
        global $current_screen;
        $screen_id = isset( $current_screen->id ) ? $current_screen->id : '';

        if ( in_array( $screen_id, ['toplevel_page_betterdocs-admin', 'betterdocs_page_betterdocs-settings'] ) ) {
            $this->default_term_order( 'doc_category' );
        }

        if ( ! isset( $_GET['orderby'] ) && ! empty( $current_screen->base ) && $current_screen->base === 'edit-tags' && $current_screen->taxonomy === 'doc_category' ) {
            $this->default_term_order( $current_screen->taxonomy );
            add_filter( 'terms_clauses', [$this, 'set_tax_order'], 10, 3 );
        }
    }

    /**
     * Default the taxonomy's terms' order if it's not set.
     *
     * @param string $tax_slug The taxonomy's slug.
     */
    private function default_term_order( $tax_slug ) {
        $terms = get_terms( $tax_slug, ['hide_empty' => false] );
        $order = $this->get_max_taxonomy_order( $tax_slug );

        if ( ! is_array( $terms ) ) {
            return;
        }

        foreach ( $terms as $term ) {
            if ( ! get_term_meta( $term->term_id, 'doc_category_order', true ) ) {
                update_term_meta( $term->term_id, 'doc_category_order', $order );
                $order++;
            }
        }
    }

    /**
     * Re-Order the taxonomies based on the doc_category_order value.
     *
     * @param array $pieces     Array of SQL query clauses.
     * @param array $taxonomies Array of taxonomy names.
     * @param array $args       Array of term query args.
     */
    public function set_tax_order( $pieces, $taxonomies, $args ) {
        global $wpdb;

        foreach ( $taxonomies as $taxonomy ) {
            if ( $taxonomy === 'doc_category' ) {
                $join_statement = " LEFT JOIN $wpdb->termmeta AS term_meta ON t.term_id = term_meta.term_id AND term_meta.meta_key = 'doc_category_order'";

                if ( ! $this->does_substring_exist( $pieces['join'], $join_statement ) ) {
                    $pieces['join'] .= $join_statement;
                }

                $pieces['orderby'] = 'ORDER BY CAST( term_meta.meta_value AS UNSIGNED )';
            }
        }

        return $pieces;
    }

    /**
     * Check if a substring exists inside a string.
     *
     * @param string $string    The main string (haystack) we're searching in.
     * @param string $substring The substring we're searching for.
     *
     * @return bool True if substring exists, else false.
     */
    protected function does_substring_exist( $string, $substring ) {
        return strstr( $string, $substring ) !== false;
    }

    /**
     * Auto Add in Category, Adding from Sorting
     *
     * @param \WP_Post $post
     * @return void
     */
    public function auto_add_category( $post ) {
        if ( ! strpos( $_SERVER['REQUEST_URI'], 'wp-admin/post-new.php' ) ) {
            return;
        }
        if ( empty( $_GET['cat'] ) ) {
            return;
        }
        $cat = wp_unslash( $_GET['cat'] );
        if ( false === ( $cat = get_term_by( 'term_id', $cat, 'doc_category' ) ) ) {
            return;
        }

        wp_set_post_terms( $post->ID, [$cat->term_id], 'doc_category', false );
    }

    public function update_category_order() {
        if ( ! check_ajax_referer( 'doc_cat_order_nonce', 'nonce', false ) ) {
            wp_send_json_error( __( 'Nonce Failed', 'betterdocs' ) );
        }

        if( ! current_user_can('manage_doc_terms') ) {
            wp_send_json_error( __( 'You don\'t have permission to manage docs term.', 'betterdocs' ) );
        }

        $taxonomy_ordering_data = filter_var_array( wp_unslash( $_POST['data'] ), FILTER_SANITIZE_NUMBER_INT );
        $base_index             = filter_var( wp_unslash( $_POST['base_index'] ), FILTER_SANITIZE_NUMBER_INT );

        foreach ( $taxonomy_ordering_data as $order_data ) {
            if ( $base_index > 0 ) {
                $current_position = get_term_meta( $order_data['term_id'], 'doc_category_order', true );

                if ( (int) $current_position < (int) $base_index ) {
                    continue;
                }
            }
            update_term_meta( $order_data['term_id'], 'doc_category_order', ( (int) $order_data['order'] + (int) $base_index ) );
        }

        wp_send_json_success( __( 'Successfully updated.', 'betterdocs' ) );
    }

    /**
     * AJAX Handler to update docs position.
     */
    public function update_docs_order_by_category() {
        if ( ! check_ajax_referer( 'doc_cat_order_nonce', 'doc_cat_order_nonce', false ) ) {
            wp_send_json_error( __( 'Nonce Failed', 'betterdocs' ) );
        }

        if( ! current_user_can('edit_docs') ) {
            wp_send_json_error( __( 'You don\'t have permission to update docs term.', 'betterdocs' ) );
        }

        $docs_ordering_data = isset( $_POST['docs_ordering_data'] ) ? implode( ',', filter_var_array( $_POST['docs_ordering_data'], FILTER_SANITIZE_NUMBER_INT ) ) : '';
        $term_id            = intval( $_POST['list_term_id'] );

        if ( ! $term_id ) {
            wp_send_json_error( __( 'Invalid term ID.', 'betterdocs' ) );
        }

        if ( update_term_meta( $term_id, '_docs_order', $docs_ordering_data ) ) {
            wp_send_json_success( __( 'Successfully updated.', 'betterdocs' ) );
        }

        wp_send_json_error( __( 'Something went wrong.', 'betterdocs' ) );
    }

    /**
     * AJAX Handler to update docs position.
     */
    public function update_docs_term() {
        if ( ! check_ajax_referer( 'doc_cat_order_nonce', 'doc_cat_order_nonce', false ) ) {
            wp_send_json_error( __( 'Nonce Failed', 'betterdocs' ) );
        }

        if( ! current_user_can('edit_docs') ) {
            wp_send_json_error( __( 'You don\'t have permission to update docs term.', 'betterdocs' ) );
        }

        $object_id    = intval( $_POST['object_id'] );
        $term_id      = intval( $_POST['list_term_id'] );
        $prev_term_id = intval( isset( $_POST['prev_term_id'] ) ? $_POST['prev_term_id'] : 0 );

        if ( ! $term_id || ! $object_id ) {
            wp_send_json_error( __( 'Invalid object or term ID.', 'betterdocs' ) );
        }

        global $wpdb;

        if ( $prev_term_id ) {
            wp_remove_object_terms( $object_id, $prev_term_id, 'doc_category' );
        }

        $terms_added = wp_set_object_terms( $object_id, $term_id, 'doc_category' );

        if ( ! is_wp_error( $terms_added ) ) {
            wp_send_json_success( __( 'Successfully updated.', 'betterdocs' ) );
        }

        wp_send_json_error( __( 'Something went wrong.', 'betterdocs' ) );
    }

    /**
     * Update docs_term meta when new post created
     */

    public function save_docs( $post_id ) {
        // bail out if this is an autosave
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }

        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

        if( $post_id instanceof WP_Post ) {
            $post_id = $post_id->ID;
        }

        $term_list = wp_get_post_terms( $post_id, 'doc_category', ['fields' => 'ids'] );

        if ( ! empty( $term_list ) ) {
            foreach ( $term_list as $term_id ) {
                $term_meta = get_term_meta( $term_id, '_docs_order', true );
                if ( ! empty( $term_meta ) ) {
                    $_term_meta_array = explode( ",", $term_meta );

                    if ( ! in_array( $post_id, $_term_meta_array ) ) {
                        array_unshift( $_term_meta_array, $post_id );
                        $_docs_order_data = filter_var_array( wp_unslash( $_term_meta_array ), FILTER_SANITIZE_NUMBER_INT );
                        update_term_meta( $term_id, '_docs_order', implode( ',', $_docs_order_data ) );
                    }
                } else {
                    update_term_meta( $term_id, '_docs_order', implode( ',', [ $post_id ] ) );
                }
            }
        }
    }

    public function register() {
        /**
         * Flush Rewrite Rules
         */
        if ( $this->database->get_transient( 'betterdocs_flush_rewrite_rules' ) ) {
            betterdocs()->rewrite->rules();

            flush_rewrite_rules();
            $this->database->delete_transient( 'betterdocs_flush_rewrite_rules' );
        }

        $this->register_post_type();
        $this->register_category_taxonomy();
        $this->register_tag_taxonomy();
    }

    /**
     * Register the post type: docs
     * @since 1.0.0
     *
     * @return void
     */
    public function register_post_type() {
        $singular_name = $this->settings->get( 'breadcrumb_doc_title' );

        $labels = [
            'name'               => ( $singular_name ) ? $singular_name : 'Docs',
            'singular_name'      => ( $singular_name ) ? $singular_name : 'Docs',
            'menu_name'          => __( 'BetterDocs', 'betterdocs' ),
            'name_admin_bar'     => __( 'Docs', 'betterdocs' ),
            'add_new'            => __( 'Add New', 'betterdocs' ),
            'add_new_item'       => __( 'Add New Docs', 'betterdocs' ),
            'new_item'           => __( 'New Docs', 'betterdocs' ),
            'edit_item'          => __( 'Edit Docs', 'betterdocs' ),
            'view_item'          => __( 'View Docs', 'betterdocs' ),
            'all_items'          => __( 'All Docs', 'betterdocs' ),
            'search_items'       => __( 'Search Docs', 'betterdocs' ),
            'parent_item_colorn' => null,
            'not_found'          => __( 'No docs found', 'betterdocs' ),
            'not_found_in_trash' => __( 'No docs found in trash', 'betterdocs' )
        ];

        $betterdocs_articles_caps = apply_filters( 'betterdocs_articles_caps', 'edit_posts', 'article_roles' );

        $args = [
            'labels'              => $labels,
            'description'         => __( 'Add new doc from here', 'betterdocs' ),
            'public'              => true,
            'public_queryable'    => true,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => false,
            'show_in_admin_bar'   => $betterdocs_articles_caps,
            'query_var'           => true,
            'capability_type'     => ['doc', 'docs'],
            'hierarchical'        => false,
            'map_meta_cap'        => true,
            'menu_position'       => $this->position,
            'show_in_rest'        => true,
            'menu_icon'           => betterdocs()->assets->icon( 'betterdocs-icon-white.svg' ),
            'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions', 'custom-fields', 'comments']
        ];

        $builtin_doc_page = $this->settings->get( 'builtin_doc_page', false );
        $docs_page = $this->settings->get( 'docs_page' );

        $args['has_archive'] = ! $builtin_doc_page && $docs_page ? false : $this->docs_archive;

        $args['rewrite'] = betterdocs()->rewrite->docs_type_rewrite( [
            'slug'       => $this->docs_archive,
            'with_front' => false
        ], $this->docs_slug );

        register_post_type( $this->post_type, $args );
    }

    /**
     * Register the taxonomy for Category
     *
     * @since 1.0.0
     * @return void
     */
    public function register_category_taxonomy() {
        $category_labels = [
            'name'              => __( 'Docs Categories', 'betterdocs' ),
            'singular_name'     => __( 'Docs Category', 'betterdocs' ),
            'all_items'         => __( 'Docs Categories', 'betterdocs' ),
            'parent_item'       => __( 'Parent Docs Category', 'betterdocs' ),
            'parent_item_colon' => __( 'Parent Docs Category:', 'betterdocs' ),
            'edit_item'         => __( 'Edit Category', 'betterdocs' ),
            'update_item'       => __( 'Update Category', 'betterdocs' ),
            'add_new_item'      => __( 'Add New Docs Category', 'betterdocs' ),
            'new_item_name'     => __( 'New Docs Category Name', 'betterdocs' ),
            'menu_name'         => __( 'Categories', 'betterdocs' )
        ];

        $category_args = [
            'hierarchical'      => true,
            'public'            => true,
            'labels'            => $category_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'has_archive'       => true,
            'capabilities'      => [
                'manage_terms' => 'manage_doc_terms',
                'edit_terms'   => 'edit_doc_terms',
                'delete_terms' => 'delete_doc_terms',
                'assign_terms' => 'edit_docs'
            ]
        ];

        $category_args['rewrite'] = apply_filters( 'betterdocs_category_rewrite', [
            'slug'       => $this->cat_slug,
            'with_front' => false
        ], $this->cat_slug );

        register_taxonomy( $this->category, [$this->post_type], $category_args );
    }

    /**
     * Register the taxonomy for Tags.
     *
     * @since 1.0.0
     * @return void
     */
    public function register_tag_taxonomy() {
        $tags_labels = [
            'name'                       => __( 'Docs Tags', 'betterdocs' ),
            'singular_name'              => __( 'Tag', 'betterdocs' ),
            'search_items'               => __( 'Search Tags', 'betterdocs' ),
            'popular_items'              => __( 'Popular Tags', 'betterdocs' ),
            'all_items'                  => __( 'All Tags', 'betterdocs' ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __( 'Edit Tag', 'betterdocs' ),
            'update_item'                => __( 'Update Tag', 'betterdocs' ),
            'add_new_item'               => __( 'Add New Tag', 'betterdocs' ),
            'new_item_name'              => __( 'New Tag Name', 'betterdocs' ),
            'separate_items_with_commas' => __( 'Separate tags with commas', 'betterdocs' ),
            'add_or_remove_items'        => __( 'Add or remove tags', 'betterdocs' ),
            'choose_from_most_used'      => __( 'Choose from the most used tags', 'betterdocs' ),
            'menu_name'                  => __( 'Tags', 'betterdocs' )
        ];

        $tag_args = [
            'hierarchical'          => true,
            'labels'                => $tags_labels,
            'show_ui'               => true,
            'update_count_callback' => '_update_post_term_count',
            'show_admin_column'     => true,
            'query_var'             => true,
            'show_in_rest'          => true,
            'capabilities'          => [
                'manage_terms' => 'manage_doc_terms',
                'edit_terms'   => 'edit_doc_terms',
                'delete_terms' => 'delete_doc_terms',
                'assign_terms' => 'edit_docs'
            ]
        ];

        $tag_slug = $this->settings->get( 'tag_slug' );

        $tag_args['rewrite'] = apply_filters( 'betterdocs_tags_rewrite', [
            'slug'       => ! empty( $tag_slug ) ? $tag_slug : 'docs-tag',
            'with_front' => false
        ] );

        register_taxonomy( $this->tag, [$this->post_type], $tag_args );
    }

    /**
     * Get Docs Slug
     *
     * @since 1.0.0
     * @return string
     */
    private function docs_slug() {
        return $this->rewrite->get_base_slug();
    }

    /**
     * Get Category Taxonomy Slug
     *
     * @since 1.0.0
     * @return string
     */
    private function category_slug() {
        return $this->settings->get( 'category_slug', 'docs-category' );
    }

    public function highlight_admin_menu( $parent_file ) {
        global $current_screen;

        if ( $current_screen->id === 'edit-docs' || in_array( $current_screen->id, ['edit-doc_tag', 'edit-doc_category'] ) ) {
            $parent_file = 'betterdocs-admin';
        } else {
            if ( in_array( $current_screen->id, ['edit-doc_tag', 'edit-doc_category'] ) ) {
                $parent_file = 'edit.php?post_type=docs';
            }
        }

        return apply_filters( 'betterdocs_highlight_admin_menu', $parent_file, $current_screen );
    }

    public function highlight_admin_submenu( $submenu_file ) {
        global $current_screen, $pagenow;

        if ( $current_screen->post_type == 'docs' ) {
            if ( $pagenow == 'edit.php' ) {
                $submenu_file = 'betterdocs-admin';
            }
            if ( $pagenow == 'post.php' ) {
                $submenu_file = 'edit.php?post_type=docs';
            }
            if ( $pagenow == 'post-new.php' ) {
                $submenu_file = 'post-new.php?post_type=docs';
            }
            if ( $current_screen->id === 'edit-doc_category' ) {
                $submenu_file = 'edit-tags.php?taxonomy=doc_category&post_type=docs';
            }
            if ( $current_screen->id === 'edit-doc_tag' ) {
                $submenu_file = 'edit-tags.php?taxonomy=doc_tag&post_type=docs';
            }
        }

        if ( 'betterdocs_page_betterdocs-settings' == $current_screen->id ) {
            $submenu_file = 'betterdocs-settings';
        }

        if ( 'betterdocs_page_betterdocs-analytics' == $current_screen->id ) {
            $submenu_file = 'betterdocs-analytics';
        }

        if ( 'betterdocs_page_betterdocs-setup' == $current_screen->id ) {
            $submenu_file = 'betterdocs-setup';
        }

        return apply_filters( 'betterdocs_highlight_admin_submenu', $submenu_file, $current_screen, $pagenow );
    }
}
