<?php

namespace WPDeveloper\BetterDocs\Core;

use WP_Post;
use WPDeveloper\BetterDocs\Utils\Base;
use WPDeveloper\BetterDocs\Utils\Database;

class Rewrite extends Base {
    protected $settings;
    protected $database;

    public function __construct( Settings $settings, Database $database ) {
        $this->settings = $settings;
        $this->database = $database;
    }

    public function init() {
        add_action( 'init', [$this, 'rules'] );
        add_action( 'betterdocs::settings::saved', [$this, 'save_permalink_structure'], 2, 3 );
    }

    public function remove_knowledge_base_placeholder( $permalink ) {
        $permalink_array = $this->permalink_structure( $permalink, 'arraywithpercent' );
        $permalink_array = array_filter( $permalink_array, function ( $item ) {
            return $item !== '%knowledge_base%';
        } );

        return trailingslashit( implode( '/', $permalink_array ) );
    }

    /**
     * This method is hooked with an action called 'betterdocs::settings::saved'
     *
     * @since 2.5.0
     *
     * @param bool $_saved
     * @param array $_settings
     * @param array $_old_settings
     *
     * @return void
     */
    public function save_permalink_structure( $_saved, $_settings, $_old_settings ) {
        $_permalink_structure = $_settings['permalink_structure'];

        /**
         * TODO: Let's re-check later to optimize it.
         */
        if ( ! betterdocs()->is_pro_active() ) {
            $_permalink_structure = $this->remove_knowledge_base_placeholder( $_permalink_structure );
        }

        if ( $_permalink_structure !== $_old_settings['permalink_structure'] ) {
            $this->settings->save( 'permalink_structure', $this->permalink_structure( $_permalink_structure ) );
        }

        /**
         * This block of code decides whether it needs to be flushed or not.
         * Flush happens after register the post type.
         */
        switch ( true ) {
            case $_permalink_structure !== $_old_settings['permalink_structure']:
            case $_settings['docs_slug'] !== $_old_settings['docs_slug']:
            case $_settings['builtin_doc_page'] !== $_old_settings['builtin_doc_page']:
            case $_settings['docs_page'] !== $_old_settings['docs_page']:
            case $_settings['tag_slug'] !== $_old_settings['tag_slug']:
            case $_settings['category_slug'] !== $_old_settings['category_slug']:
                $this->database->set_transient( 'betterdocs_flush_rewrite_rules', true );
                break;
        }
    }

    public function permalink_structure( $structure = '', $output = 'string' ) {
        if ( empty( $structure ) ) {
            $structure = $this->settings->get( 'permalink_structure', 'docs' );
        }

        $docs_slug = $this->get_base_slug();

        $_structure_array = explode( '%', $structure );
        if ( $_structure_array[0] == '/' ) {
            $structure = $docs_slug . $structure;
        } else if ( $_structure_array[0] == '' ) {
            $structure = $docs_slug . '/' . $structure;
        }

        $structure = trim( $structure, '/' );

        if ( $output === 'string' ) {
            return $structure;
        }

        if ( $output === 'array' ) {
            $structure = explode( '/', $structure );
            $structure = array_map( function ( $item ) {
                return trim( $item, "/%" );
            }, $structure );
        }

        if ( $output === 'arraywithpercent' ) {
            $structure = explode( '/', $structure );
            $structure = array_map( function ( $item ) {
                return trim( $item, "/" );
            }, $structure );
        }

        return $structure;
    }

    public function get_base_slug() {
        $docs_slug        = $this->settings->get( 'docs_slug', 'docs' );
        $docs_page        = $this->settings->get( 'docs_page', 0 );
        $builtin_doc_page = $this->settings->get( 'builtin_doc_page', true );

        if ( ! $builtin_doc_page && $docs_page !== 0 ) {
            $post_info = get_post( $docs_page );
            $docs_slug = $post_info instanceof WP_Post ? $post_info->post_name : $docs_slug;
        }

        $docs_slug = trim( $docs_slug, '/' );

        return $docs_slug;
    }

    public function normalzie_doc_perma_structure( $structure ){
        $structure = $this->permalink_structure( $structure, 'arraywithpercent' );
        $structure = array_reduce( $structure, function( $carry, $item ){
            if( strpos( $item, '%' ) !== false ) {
                $carry[] = $item;
            } else {
                if ($carry && strpos(end($carry), '%') === false) {
                    $carry[count($carry) - 1] .= "/$item";
                } else {
                    $carry[] = $item;
                }
            }

            return $carry;
        }, []);

        $structure[] = '%docs%';

        $group = array_filter( $structure, function( $item ){
            return strpos($item, '%') === 0;
        });

        return [
            'raw' => $structure,
            'group' => $group
        ];
    }

    public function make_regex( $segments ){
        return array_reduce( $segments, function( $carry, $item ){
            $carry .= ( strpos( $item, '%' ) !== false ? "([^/]+)" : $item ) . '/';
            return $carry;
        }, '') . '?$';
    }

    public function make_query( $segments ){
        $query = [];
        $matchId = 1;

        foreach( $segments as $segment ) {
            $query[] = trim($segment, '%') . '=$matches[' . $matchId . ']';
            $matchId++;
        }

        return 'index.php?' . implode('&', $query) . '&post_type=docs';
    }

    public function rules() {
        /**
         * docs can be dynamic / as its a root slug
         *
         * https://url/docs/kb-slug
         * https://url/docs/kb-slug/category-slug
         * https://url/docs-category/category-slug
         *
         * Docs Visit:
         * docs can be dynamic / as its a root slug
         * or docs can be change by settings.
         *
         * https://url/docs/(docs-slug)
         * https://url/docs/(cat-slug)/(docs-slug)
         * https://url/docs/(kb-slug)/(docs-slug)
         * https://url/docs/(kb-slug)/(cat-slug)/(docs-slug)
         * https://url/docs/(cat-slug)/(kb-slug)/(docs-slug)
         */

        /**
         * This code of blocks used to determine single docs permalink.
         */
        $_docs_perma_struct = betterdocs()->settings->get( 'permalink_structure', 'docs' );
        $_normalized_structure = $this->normalzie_doc_perma_structure($_docs_perma_struct);

        $_feed_regex = $_normalized_structure['raw'];
        $_feed_regex[] = '(feed|rdf|rss|rss2|atom)';
        $_feed_group = $_normalized_structure['group'];
        $_feed_group[] = '%feed%';

        $this->add_rewrite_rule( $this->make_regex( $_feed_regex ), $this->make_query( $_feed_group ) );

        $this->add_rewrite_rule(
            $this->make_regex( $_normalized_structure['raw'] ),
            $this->make_query( $_normalized_structure['group'] )
        );

        $base = $this->get_base_slug();
        $this->add_rewrite_rule( $base . '/(feed|rdf|rss|rss2|atom)/?$', 'index.php?post_type=docs&feed=$matches[1]' );
    }

    public function add_rewrite_rule( $regex, $query, $after = 'top' ) {
        add_rewrite_rule( $regex, $query, $after );
    }

    public function docs_type_rewrite( $rewrite, $slug ) {
        $permalink           = betterdocs()->settings->get( 'permalink_structure', 'docs/' );
        $permalink_structure = $this->permalink_structure( $permalink, 'array' );
        $permalink           = apply_filters( 'betterdocs_docs_type_rewrite_permalink', $permalink, $slug, $permalink_structure );

        /**
         * TODO: Let's re-check later for optimization.
         */
        if ( ! betterdocs()->is_pro_active() ) {
            $permalink = $this->remove_knowledge_base_placeholder( $permalink );
        }

        return apply_filters( 'betterdocs_docs_rewrite', [
            'slug' => trim( $permalink, '/' ),
            'with_front' => false
        ], $slug );
    }
}
