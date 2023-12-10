<?php

namespace WPDeveloper\BetterDocs\Core;

use WP_User;
use WP_Error;
use WPDeveloper\BetterDocs\Utils\Base;
use WPDeveloper\BetterDocs\Utils\Database;
use WPDeveloper\BetterDocs\Admin\Builder\Rules;
use WPDeveloper\BetterDocs\Admin\Builder\GlobalFields;

class Settings extends Base {
    public $base_key = 'betterdocs_settings';

    /**
     * Database class
     * @var Database
     */
    protected $database;

    private $deprecated = [];

    private $cannot_be_empty = [
        'breadcrumb_doc_title',
        'docs_slug',
        'category_slug',
        'tag_slug',
        'permalink_structure',
        'docs_page'
    ];

    public function __construct( Database $database ) {
        $this->database   = $database;
        $this->deprecated = $this->deprecated_settings();

        add_action( 'admin_enqueue_scripts', [$this, 'enqueue'] );

        if ( isset( $_GET['page'] ) && $_GET['page'] === 'betterdocs-settings' && ! has_action( 'betterdocs_settings_header' ) ) {
            add_action( 'betterdocs_settings_header', [$this, 'header'] );
        }

        add_action( 'wp_ajax_betterdocs_dark_mode', [$this, 'dark_mode'] );
        add_filter( 'betterdocs_settings_tab_advance', [$this, 'hide_roles_management'], 11, 1 );
        add_action( 'betterdocs::settings::saved', [$this, 'fallback_slugs'], 99, 3 );
    }

    public function fallback_slugs( $_saved, $_settings, $_old_settings = [] ) {
        $_default = $this->get_default();
        foreach ( $this->cannot_be_empty as $key ) {
            if ( $key === 'docs_page' && ! $_settings['builtin_doc_page'] && empty( $_settings[$key] ) ) {
                $this->save( 'builtin_doc_page', true );
                continue;
            }

            if ( empty( $_settings[$key] ) ) {
                $this->save( $key, $_default[$key] );
            }
        }
    }

    /**
     * Get the settings URL for admin
     * @return string
     */
    public function url() {
        return esc_url( admin_url( 'admin.php?page=betterdocs-settings' ) );
    }

    /**
     * This method is responsible for enqueueing scripts in settings panel
     *
     * @since 2.5.0
     * @param string $hook
     *
     * @return void
     */
    public function enqueue( $hook ) {
        if ( $hook !== 'betterdocs_page_betterdocs-settings' ) {
            return;
        }
        wp_enqueue_script( 'betterdocs-admin' );
        betterdocs()->assets->enqueue( 'betterdocs-settings', 'admin/css/settings.css' );
        betterdocs()->assets->enqueue( 'betterdocs-icons', 'admin/btd-icon/style.css' );
        betterdocs()->assets->enqueue( 'betterdocs-settings', 'admin/js/settings.js' );
        betterdocs()->assets->localize(
            'betterdocs-settings',
            'betterdocsAdminSettings',
            GlobalFields::normalize( $this->settings_args() )
        );
    }

    /**
     * This method is responsible for printing header in dashboard settings page.
     *
     * @since 2.5.0
     * @param string $hook
     *
     * @return void
     */
    public function header( $hook ) {
        if ( $hook !== 'settings' ) {
            return;
        }

        betterdocs()->views->get( 'admin/template-parts/settings-header' );
        betterdocs()->views->get( 'admin/template-parts/settings-header-2' );
    }

    /**
     * A list of deprecated settings keys.
     *
     * @since 2.5.0
     * @return array
     */
    public function deprecated_settings() {
        return [];
    }

    /**
     * Dynamic migration caller.
     *
     * @since 2.5.0
     * @return void
     */
    public function migration( $version ) {
        if ( $version > 250 ) {
            for ( $v = 250; $v <= $version; $v++ ) {
                $_func = "v{$v}";
                if ( method_exists( $this, $_func ) ) {
                    call_user_func( [$this, $_func] );
                }
            }
        }
    }

    /**
     * Migration for version 2.5.0
     *
     * @since 2.5.0
     * @return void
     */
    public function v250() {
        if ( $this->get( 'alphabetically_order_term', false ) ) {
            $this->save( 'terms_orderby', 'name' );
        }

        if ( $orderby = $this->get( 'alphabetically_order_post', false ) ) {
            if ( $orderby === '1' ) {
                $this->save( 'alphabetically_order_post', 'title' );
            }
        }
    }

    /**
     * A list of default settings data.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_default() {
        $_default = [
            'multiple_kb'                => '',
            'builtin_doc_page'           => true,
            'breadcrumb_doc_title'       => __( 'Docs', 'betterdocs' ),
            'docs_slug'                  => 'docs',
            'docs_page'                  => 0,
            'category_slug'              => 'docs-category',
            'tag_slug'                   => 'docs-tag',
            'permalink_structure'        => 'docs/',
            'enable_faq_schema'          => false,
            'live_search'                => true,
            'advance_search'             => false,
            'popular_keyword_limit'      => 5,
            'search_letter_limit'        => 3,
            'search_placeholder'         => __( 'Search...', 'betterdocs' ),
            'search_not_found_text'      => __( 'Sorry, no docs were found.', 'betterdocs' ),
            'search_result_image'        => true,
            'masonry_layout'             => true,
            'category_title_link'        => false,
            'terms_orderby'              => 'betterdocs_order',
            'alphabetically_order_term'  => false,
            'terms_order'                => 'ASC',
            'alphabetically_order_post'  => 'betterdocs_order',
            'docs_order'                 => 'ASC',
            'nested_subcategory'         => false,
            'column_number'              => 3,
            'posts_number'               => 10,
            'post_count'                 => true,
            'count_text'                 => __( 'docs', 'betterdocs' ),
            'count_text_singular'        => __( 'doc', 'betterdocs' ),
            'exploremore_btn'            => true,
            'exploremore_btn_txt'        => __( 'Explore More', 'betterdocs' ),
            'doc_single'                 => 1,
            'enable_toc'                 => true,
            'toc_title'                  => __( 'Table of Contents', 'betterdocs' ),
            'toc_hierarchy'              => true,
            'toc_list_number'            => true,
            'toc_dynamic_title'          => false,
            'enable_sticky_toc'          => true,
            'sticky_toc_offset'          => 100,
            'collapsible_toc_mobile'     => false,
            'supported_heading_tag'      => ['1', '2', '3', '4', '5', '6'],
            'enable_post_title'          => true,
            'title_link_ctc'             => true,
            'enable_breadcrumb'          => true,
            'breadcrumb_home_text'       => __( 'Home', 'betterdocs' ),
            'breadcrumb_home_url'        => get_home_url(),
            'enable_breadcrumb_category' => true,
            'enable_breadcrumb_title'    => true,
            'enable_sidebar_cat_list'    => true,
            'enable_print_icon'          => true,
            'enable_tags'                => true,
            'email_feedback'             => true,
            'feedback_link_text'         => __( 'Still stuck? How can we help?', 'betterdocs' ),
            'feedback_url'               => '',
            'feedback_form_title'        => __( 'How can we help?', 'betterdocs' ),
            'email_address'              => get_option( 'admin_email' ),
            'show_last_update_time'      => true,
            'enable_navigation'          => true,
            'enable_comment'             => true,
            'enable_credit'              => true,
            'enable_archive_sidebar'     => true,
            'archive_nested_subcategory' => true,
            'enable_content_restriction' => false,
            'enable_reporting'           => false,
            'reporting_day'              => 'monday',
            'reporting_email'            => get_option( 'admin_email' )
        ];

        $_default = apply_filters( 'betterdocs_default_settings', $_default );
        // $_default = apply_filters_deprecated(
        //     'betterdocs_option_default_settings', [$_default], '2.5.0',
        //     'betterdocs_default_settings', 'betterdocs_option_default_settings will be removed from v3.5.0.'
        // );

        return $_default;
    }

    /**
     * A list of default settings for pro plugins.
     *
     * @since 2.5.0
     * @return array
     */
    public function get_pro_defaults() {
        return [];
    }

    /**
     * Get customizer links for docs page.
     *
     * @since 1.0.0
     * @return string
     */
    public function customizer_link() {
        $query['autofocus[panel]'] = 'betterdocs_customize_options';
        $query['return']           = admin_url( 'edit.php?post_type=docs' );
        $builtin_doc_page          = betterdocs()->settings->get( 'builtin_doc_page' );
        $docs_slug                 = betterdocs()->settings->get( 'docs_slug' );
        $docs_page                 = betterdocs()->settings->get( 'builtin_doc_page' );

        if ( $builtin_doc_page == 1 && $docs_slug ) {
            $query['url'] = site_url( '/' . $docs_slug );
        } elseif ( $builtin_doc_page != 1 && $docs_page ) {
            $post_info    = get_post( $docs_page );
            $query['url'] = site_url( '/' . $post_info->post_name );
        }

        return add_query_arg( $query, admin_url( 'customize.php' ) );
    }

    /**
     * Get All Roles
     * dynamically
     *
     * @return array
     */
    public function get_roles() {
        $roles = wp_roles()->role_names;
        unset( $roles['subscriber'] );
        return $roles;
    }

    /**
     * Set dark mode
     *
     * @since 1.0.0
     * @return void
     */
    public function dark_mode() {
        if ( ! check_ajax_referer( 'doc_cat_order_nonce', 'nonce', false ) ) {
            wp_send_json_error();
        }

        if ( isset( $_POST['mode'] ) ) {
            if ( $this->save( 'dark_mode', rest_sanitize_boolean( $_POST['mode'] ) ) ) {
                wp_send_json_success();
            }
        }

        wp_send_json_error();
    }

    public function get_normalized_value( $key, $value, $default = null ) {
        $_origin_value = $_value = $value;

        if ( in_array( $_value, ['on', 'off', '1', 'false', 'true'], true ) ) {
            switch ( $_value ) {
                case 'on':
                case 'ON':
                case '1':
                case 'true':
                    $_value = true;
                    break;
                case 'off':
                case 'OFF':
                case '':
                case 'false':
                    $_value = false;
                    break;
            }
        }

        $this->type_validation( $_value, $default );
        return $_value;
    }

    public function get_normalized_values( $values, $default_values = [] ) {
        if ( empty( $values ) ) {
            return [];
        }

        $_settings = [];
        foreach ( $values as $key => $value ) {
            $_default_value  = isset( $default_values[$key] ) ? $default_values[$key] : null;
            $_settings[$key] = $this->get_normalized_value( $key, $value, $_default_value );
        }

        return $_settings;
    }

    public function get_all( $raw = false ) {
        $_default_settings = $raw ? [] : array_merge( $this->get_default(), $this->get_pro_defaults() );
        $_settings         = $this->database->get( $this->base_key, $_default_settings );
        return $this->get_normalized_values( $_settings, $_default_settings );
    }

    public function type_validation( &$value, $defaultValue = null ) {
        if ( $defaultValue !== null ) {
            /**
             * Check if value is not in same type
             */
            $_default_type = gettype( $defaultValue );

            if ( ! ( is_scalar( $defaultValue ) && is_scalar( $value ) ) && empty( $value ) ) {
                $value = $defaultValue;
            }

            settype( $value, $_default_type );
        }
    }

    /**
     * Get settings value by key
     *
     * @since 2.5.0
     *
     * @param string $key
     * @param mixed $default
     * @param bool   $get_all
     *
     * @return mixed
     */
    public function get( $key, $default = null ) {
        $_default_settings = array_merge( $this->get_default(), $this->get_pro_defaults() );
        $_settings         = $this->database->get( $this->base_key, $_default_settings );

        $_value = $default;
        switch ( true ) {
            // Check if it's a PRO Option
            case ! isset( $_default_settings[$key] ):
                $_value = $default;
                break;
            // Check if it's a FREE Option and not in DB.
            case ! isset( $_settings[$key] ) && isset( $_default_settings[$key] ):
                $_value = $default !== null ? $default : $_default_settings[$key];
                break;
            // Check if it's a FREE Option
            case isset( $_settings[$key] ) && isset( $_default_settings[$key] ):
                $_value = $_settings[$key];
                break;
        }

        $_value = $this->get_normalized_value( $key, $_value, isset( $_default_settings[$key] ) ? $_default_settings[$key] : null );

        if ( gettype( $_value ) === 'string' ) {
            if ( empty( $_value ) && $default != null ) {
                $_value = $default;
            } elseif ( empty( $_value ) && $default === null && isset( $_default_settings[$key] ) ) {
                $_value = $_default_settings[$key];
            }
        }

        return $_value;
    }

    public function get_raw_field( $key, $default = null ) {
        $_settings = $this->database->get( $this->base_key, [] );

        if ( isset( $_settings[$key] ) ) {
            return $this->get_normalized_value( $key, $_settings[$key], $default );
        }

        return $default;
    }

    public function save( $key, $value ) {
        $_settings       = $this->database->get( $this->base_key, [] );
        $_settings[$key] = $value;
        // $backtrace = debug_backtrace();
        // error_log(print_r($backtrace, true));
        return $this->database->save( $this->base_key, $_settings );
    }

    public function save_settings( $settings ) {
        $existing_plugins = betterdocs()->kbmigration->knowledge_base_plugins();
        if ( ! current_user_can( 'edit_docs_settings' ) ) {
            return new WP_Error( 'unauthorized_action', __( 'You don\'t have any rights for saving settings.', 'betterdocs' ) );
        }

        $_old_settings = $this->database->get( $this->base_key, $this->get_default() );
        // @todo: sanitize the data before inject in DB.
        $_normalized_settings = $this->get_normalized_values( $settings );
        if ( $existing_plugins && isset( $_normalized_settings['migration_step'] ) && $_normalized_settings['migration_step'] == true ) {
            betterdocs()->kbmigration->migrate();
        }
        $_settings = wp_parse_args( $_normalized_settings, $_old_settings );
        $_saved    = $this->database->save( $this->base_key, $_settings );

        do_action_ref_array( 'betterdocs::settings::saved', [$_saved, $_settings, $_old_settings, &$this] );

        return $_saved;
    }

    public function views( $hook ) {
        return betterdocs()->views->get( 'admin/settings' );
    }

    public function save_default_settings() {
        $_settings = $this->get_all();
        return $this->database->save( $this->base_key, $_settings );
    }

    public function get_pages() {
        $_pages = betterdocs()->query->get_posts( [
            'post_type'      => 'page',
            'numberposts'    => -1,
            'post_status'    => 'publish',
            'posts_per_page' => -1
        ] );

        $__pages = [];

        if ( ! empty( $_pages ) ) {
            $__pages[0] = __( 'Select a Page', 'betterdocs' );
            foreach ( $_pages->posts as $page ) {
                $__pages[$page->ID] = esc_html( $page->post_title );
            }
        }

        return $__pages;
    }

    public function settings_args() {
        $wp_roles = $this->normalize_options( $this->get_roles() );

        $settings = [
            'id'            => 'betterdocs_settings_metabox_wrapper',
            'title'         => __( 'betterdocs', 'betterdocs' ),
            'object_types'  => ['betterdocs'],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_header'   => false,
            'tabnumber'     => false,
            'is_pro_active' => betterdocs()->is_pro_active(),
            'logoURL'       => betterdocs()->assets->icon( 'betterdocs-icon.svg', true ),
            'layout'        => 'vertical',
            'config'        => [
                'active'  => 'tab-general',
                'sidebar' => true,
                'title'   => false
            ],
            'submit'        => [
                'show'         => true,
                'label'        => __( 'Save', 'betterdocs' ),
                'loadingLabel' => __( 'Saving...', 'betterdocs' ),
                'class'        => 'save-settings',
                'rules'        => Rules::logicalRule( [
                    Rules::is( 'config.active', 'tab-design', true ),
                    Rules::is( 'config.active', 'tab-shortcodes', true ),
                    Rules::is( 'config.active', 'tab-instant-answer', true )
                ], 'and' )
            ],
            'values'        => $this->get_all( true ),
            'tabs'          => apply_filters( 'betterdocs_settings_tabs', [
                'tab-general'          => apply_filters( 'betterdocs_settings_tab_general', [
                    'id'       => 'tab-general',
                    'label'    => __( 'General', 'betterdocs' ),
                    'classes'  => 'tab-general',
                    'priority' => 10,
                    'fields'   => [
                        'title-general' => [
                            'name'     => 'title-general-tab',
                            'type'     => 'section',
                            'label'    => __( 'General Settings', 'betterdocs' ),
                            'priority' => 10,
                            'fields'   => [
                                'multiple_kb'           => apply_filters( 'betterdocs_multi_kb_settings', [
                                    'name'                       => 'multiple_kb',
                                    'type'                       => 'toggle',
                                    'label'                      => __( 'Multiple Knowledge Base', 'betterdocs' ),
                                    'enable_disable_text_active' => true,
                                    'default'                    => '',
                                    'priority'                   => 1,
                                    'is_pro'                     => true
                                ] ),
                                'builtin_doc_page'      => [
                                    'name'                       => 'builtin_doc_page',
                                    'type'                       => 'toggle',
                                    'label'                      => __( 'Built-in Documentation Page', 'betterdocs' ),
                                    'enable_disable_text_active' => true,
                                    'default'                    => 1,
                                    'priority'                   => 2,
                                    'label_subtitle'             => __( 'If you disable root slug for KB Archives, your individual knowledge base URL will be like this: https://example.com/knowledgebase-1', 'betterdocs' )
                                ],
                                'breadcrumb_doc_title'  => [
                                    'name'     => 'breadcrumb_doc_title',
                                    'type'     => 'text',
                                    'label'    => __( 'Documentation Page Title', 'betterdocs' ),
                                    'default'  => 'Docs',
                                    'priority' => 3
                                ],
                                'docs_slug'             => [
                                    'name'     => 'docs_slug',
                                    'type'     => 'text',
                                    'label'    => __( 'BetterDocs Root Slug', 'betterdocs' ),
                                    'default'  => 'docs',
                                    'priority' => 4,
                                    'rules'    => Rules::is( 'builtin_doc_page', true )
                                ],
                                'docs_page'             => [
                                    'name'           => 'docs_page',
                                    'label'          => __( 'Docs Page', 'betterdocs' ),
                                    'type'           => 'select',
                                    'default'        => 0,
                                    'priority'       => 5,
                                    'search'         => true,
                                    'options'        => $this->normalize_options( $this->get_pages() ),
                                    'label_subtitle' => __( 'You will need to insert BetterDocs Shortcode inside the page. This page will be used as docs permalink.', 'betterdocs' ),
                                    'rules'          => Rules::is( 'builtin_doc_page', false )
                                ],
                                'category_slug'         => [
                                    'name'     => 'category_slug',
                                    'type'     => 'text',
                                    'label'    => __( 'Custom Category Slug', 'betterdocs' ),
                                    'default'  => 'docs-category',
                                    'priority' => 6
                                ],
                                'tag_slug'              => [
                                    'name'     => 'tag_slug',
                                    'type'     => 'text',
                                    'label'    => __( 'Custom Tag Slug', 'betterdocs' ),
                                    'default'  => 'docs-tag',
                                    'priority' => 7
                                ],
                                'permalink_structure'   => [
                                    'name'           => 'permalink_structure',
                                    'type'           => 'permalink_structure',
                                    'label'          => __( 'Single Docs Permalink', 'betterdocs' ),
                                    'default'        => PostType::permalink_structure(),
                                    'priority'       => 9,
                                    'tags'           => $this->normalize_options( [
                                        '%doc_category%'   => '%doc_category%',
                                        '%knowledge_base%' => '%knowledge_base%'
                                    ] ),
                                    'label_subtitle' => __( 'Make sure to keep Docs Root Slug in the Single Docs Permalink. You are not able to keep it blank. You can use the available tags from below.', 'betterdocs' )
                                ],
                                'enable_faq_schema'     => [
                                    'name'                       => 'enable_faq_schema',
                                    'type'                       => 'toggle',
                                    'label'                      => __( 'FAQ Schema', 'betterdocs' ),
                                    'enable_disable_text_active' => true,
                                    'default'                    => '',
                                    'priority'                   => 10
                                ],
                                'analytics_from'        => [
                                    'name'     => 'analytics_from',
                                    'type'     => 'select',
                                    'label'    => __( 'Analytics From', 'betterdocs' ),
                                    'options'  => $this->normalize_options( [
                                        'everyone'         => __( 'Everyone', 'betterdocs' ),
                                        'guests'           => __( 'Guests Only', 'betterdocs' ),
                                        'registered_users' => __( 'Registered Users Only', 'betterdocs' )
                                    ] ),
                                    'default'  => 'everyone',
                                    'priority' => 11,
                                    'is_pro'   => true
                                ],
                                'exclude_bot_analytics' => [
                                    'name'                       => 'exclude_bot_analytics',
                                    'type'                       => 'toggle',
                                    'label'                      => __( 'Exclude Bot Analytics', 'betterdocs' ),
                                    'enable_disable_text_active' => true,
                                    'default'                    => true,
                                    'priority'                   => 12,
                                    'is_pro'                     => true
                                ]
                            ]
                        ]
                    ]
                ] ),
                'tab-layout'           => apply_filters( 'betterdocs_settings_tab_layout', [
                    'id'       => 'tab-layout',
                    'label'    => __( 'Layout', 'betterdocs' ),
                    'classes'  => 'tab-layout',
                    'priority' => 20,
                    'fields'   => [
                        'title-layout' => [
                            'name'     => 'title-layout-tab',
                            'type'     => 'section',
                            'label'    => __( 'Layout Settings', 'betterdocs' ),
                            'priority' => 20,
                            'fields'   => [
                                'tab-sidebar-layout' => apply_filters( 'betterdocs_settings_tab_sidebar_layout', [
                                    'id'              => 'tab-sidebar-layout',
                                    'name'            => 'tab_sidebar_layout',
                                    'label'           => __( 'Layout Settings', 'betterdocs' ),
                                    'classes'         => 'tab-layout',
                                    'type'            => "tab",
                                    'active'          => "layout_documentation_page",
                                    'completionTrack' => true,
                                    'sidebar'         => false,
                                    'save'            => false,
                                    'title'           => false,
                                    'config'          => [
                                        'active'  => 'layout_documentation_page',
                                        'sidebar' => false,
                                        'title'   => false
                                    ],
                                    'submit'          => [
                                        'show' => false
                                    ],
                                    'step'            => [
                                        'show' => false
                                    ],
                                    'priority'        => 20,
                                    'fields'          => [
                                        'layout_documentation_page' => [
                                            'id'       => 'layout_documentation_page',
                                            'name'     => 'layout_documentation_page',
                                            'type'     => 'section',
                                            'label'    => __( 'Documentation Page', 'betterdocs' ),
                                            'priority' => 1,
                                            'fields'   => [
                                                'tab-nested-layout-1' => [
                                                    'id'              => 'tab-nested-layout-1',
                                                    'name'            => 'tab_nested_layout_1',
                                                    'label'           => __( 'Documentation Page', 'betterdocs' ),
                                                    'classes'         => 'tab-nested-layout',
                                                    'type'            => "tab",
                                                    'active'          => "layout_documentation_page_general",
                                                    'completionTrack' => true,
                                                    'sidebar'         => false,
                                                    'save'            => false,
                                                    'title'           => false,
                                                    'config'          => [
                                                        'active'  => 'layout_documentation_page_general',
                                                        'sidebar' => false,
                                                        'title'   => false
                                                    ],
                                                    'submit'          => [
                                                        'show' => false
                                                    ],
                                                    'step'            => [
                                                        'show' => false
                                                    ],
                                                    'priority'        => 1,
                                                    'fields'          => [
                                                        'layout_documentation_page_general'  => [
                                                            'id'       => 'layout_documentation_page_general',
                                                            'name'     => 'layout_documentation_page_general',
                                                            'type'     => 'section',
                                                            'label'    => __( 'General', 'betterdocs' ),
                                                            'priority' => 1,
                                                            'fields'   => [
                                                                'category_title_link'                  => [
                                                                    'name'                       => 'category_title_link',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Category Title Link', 'betterdocs' ),
                                                                    'label_subtitle'             => __( 'This setting is applicable for category grid layout', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => false,
                                                                    'priority'                   => 0
                                                                ],
                                                                'masonry_layout'                 => [
                                                                    'name'                       => 'masonry_layout',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Masonry', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 1
                                                                ],
                                                                'nested_subcategory'             => [
                                                                    'name'                       => 'nested_subcategory',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Nested Sub Category', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => '',
                                                                    'priority'                   => 2
                                                                ],
                                                                'column_number'                  => [
                                                                    'name'     => 'column_number',
                                                                    'type'     => 'number',
                                                                    'label'    => __( 'Number Of Columns', 'betterdocs' ),
                                                                    'default'  => 3,
                                                                    'priority' => 3
                                                                ],
                                                                'posts_number'                   => apply_filters( 'betterdocs_posts_number', [
                                                                    'name'           => 'posts_number',
                                                                    'type'           => 'number',
                                                                    'label'          => __( 'Number Of Docs', 'betterdocs' ),
                                                                    'label_subtitle' => __( 'This setting is not applicable for handbook layout.', 'betterdocs' ),
                                                                    'default'        => 10,
                                                                    'priority'       => 4
                                                                ] ),
                                                                'post_count'                     => [
                                                                    'name'                       => 'post_count',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Doc Count', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 5
                                                                ],
                                                                'count_text'                     => [
                                                                    'name'     => 'count_text',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'Count Text', 'betterdocs' ),
                                                                    'default'  => __( 'docs', 'betterdocs' ),
                                                                    'priority' => 6
                                                                ],
                                                                'count_text_singular'            => [
                                                                    'name'     => 'count_text_singular',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'Count Text Singular', 'betterdocs' ),
                                                                    'default'  => __( 'doc', 'betterdocs' ),
                                                                    'priority' => 7
                                                                ],
                                                                'exploremore_btn'                => [
                                                                    'name'                       => 'exploremore_btn',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Explore More Button', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => true,
                                                                    'priority'                   => 8
                                                                ],
                                                                'exploremore_btn_txt'            => [
                                                                    'name'     => 'exploremore_btn_txt',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'Explore More Button Text', 'betterdocs' ),
                                                                    'default'  => __( 'Explore More', 'betterdocs' ),
                                                                    'priority' => 9,
                                                                    'rules'    => Rules::is( 'exploremore_btn', true )
                                                                ],
                                                                'betterdocs_popular_docs_text'   => [
                                                                    'name'     => 'betterdocs_popular_docs_text',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'Popular Docs Text', 'betterdocs' ),
                                                                    'default'  => __( 'Popular Docs', 'betterdocs' ),
                                                                    'priority' => 10,
                                                                    "is_pro"   => true
                                                                ],
                                                                'betterdocs_popular_docs_number' => [
                                                                    'name'     => 'betterdocs_popular_docs_number',
                                                                    'type'     => 'number',
                                                                    'label'    => __( 'Popular Docs Number', 'betterdocs' ),
                                                                    'default'  => 10,
                                                                    'priority' => 11,
                                                                    "is_pro"   => true
                                                                ]
                                                            ]
                                                        ],
                                                        'layout_documentation_page_search'   => [
                                                            'id'       => 'layout_documentation_page_search',
                                                            'name'     => 'layout_documentation_page_search',
                                                            'type'     => 'section',
                                                            'label'    => __( 'Search', 'betterdocs' ),
                                                            'priority' => 2,
                                                            'fields'   => [
                                                                'live_search'            => [
                                                                    'name'                       => 'live_search',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Live Search', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 1
                                                                ],
                                                                'advance_search'         => apply_filters( 'betterdocs_advance_search_settings', [
                                                                    'name'                       => 'advance_search',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Advanced Search', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => '',
                                                                    'priority'                   => 2,
                                                                    'is_pro'                     => true
                                                                ] ),
                                                                'child_category_exclude' => apply_filters( 'child_category_exclude', [
                                                                    'name'                       => 'child_category_exclude',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Category Search', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => '',
                                                                    'priority'                   => 3,
                                                                    'is_pro'                     => true
                                                                ] ),
                                                                'popular_keyword_limit'  => apply_filters( 'betterdocs_popular_keyword_limit_settings', [
                                                                    'name'     => 'popular_keyword_limit',
                                                                    'type'     => 'number',
                                                                    'label'    => __( 'Minimum amount of Keywords Search', 'betterdocs' ),
                                                                    'default'  => 5,
                                                                    'priority' => 4,
                                                                    'is_pro'   => true
                                                                ] ),
                                                                'search_letter_limit'    => [
                                                                    'name'     => 'search_letter_limit',
                                                                    'type'     => 'number',
                                                                    'label'    => __( 'Minimum Character Limit For Search Result', 'betterdocs' ),
                                                                    'priority' => 5,
                                                                    'default'  => 3
                                                                ],
                                                                'search_placeholder'     => [
                                                                    'name'     => 'search_placeholder',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'Search Placeholder', 'betterdocs' ),
                                                                    'default'  => __( 'Search..', 'betterdocs' ),
                                                                    'priority' => 6
                                                                ],
                                                                'search_button_text'     => apply_filters( 'betterdocs_search_button_text', [
                                                                    'name'     => 'search_button_text',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'Search Button Text', 'betterdocs' ),
                                                                    'priority' => 7,
                                                                    'default'  => __( 'Search', 'betterdocs' ),
                                                                    'is_pro'   => true
                                                                ] ),
                                                                'search_not_found_text'  => [
                                                                    'name'     => 'search_not_found_text',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'Search Not Found Text', 'betterdocs' ),
                                                                    'default'  => 'Sorry, no docs were found.',
                                                                    'priority' => 8
                                                                ],
                                                                'search_result_image'    => [
                                                                    'name'                       => 'search_result_image',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Search Result Image', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 9
                                                                ],
                                                                'kb_based_search'        => apply_filters( 'betterdocs_kb_based_search_settings', [
                                                                    'name'                       => 'kb_based_search',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'KB Based Search', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => '',
                                                                    'priority'                   => 10,
                                                                    'is_pro'                     => true,
                                                                    'rules'                      => Rules::is( 'multiple_kb', true )
                                                                ] )
                                                            ]
                                                        ],
                                                        'layout_documentation_page_order_by' => [
                                                            'id'       => 'layout_documentation_page_order_by',
                                                            'name'     => 'layout_documentation_page_order_by',
                                                            'type'     => 'section',
                                                            'label'    => __( 'Order By', 'betterdocs' ),
                                                            'priority' => 3,
                                                            'fields'   => [
                                                                'terms_orderby'             => [
                                                                    'name'     => 'terms_orderby',
                                                                    'type'     => 'select',
                                                                    'label'    => __( 'Terms Order By', 'betterdocs' ),
                                                                    'default'  => 'betterdocs_order',
                                                                    'options'  => $this->normalize_options(
                                                                        apply_filters( 'betterdocs_terms_orderby_options', [
                                                                            'none'             => __( 'No order', 'betterdocs' ),
                                                                            'name'             => __( 'Name', 'betterdocs' ),
                                                                            'slug'             => __( 'Slug', 'betterdocs' ),
                                                                            'term_group'       => __( 'Term Group', 'betterdocs' ),
                                                                            'term_id'          => __( 'Term ID', 'betterdocs' ),
                                                                            'id'               => __( 'ID', 'betterdocs' ),
                                                                            'description'      => __( 'Description', 'betterdocs' ),
                                                                            'parent'           => __( 'Parent', 'betterdocs' ),
                                                                            'betterdocs_order' => __( 'BetterDocs Order', 'betterdocs' )
                                                                        ] )
                                                                    ),
                                                                    'priority' => 1
                                                                ],
                                                                'terms_order'               => [
                                                                    'name'     => 'terms_order',
                                                                    'type'     => 'select',
                                                                    'label'    => __( 'Terms Order', 'betterdocs' ),
                                                                    'default'  => 'ASC',
                                                                    'options'  => $this->normalize_options( [
                                                                        'ASC'  => 'Ascending',
                                                                        'DESC' => 'Descending'
                                                                    ] ),
                                                                    'priority' => 3
                                                                ],
                                                                'alphabetically_order_post' => [
                                                                    'name'     => 'alphabetically_order_post',
                                                                    'type'     => 'select',
                                                                    'label'    => __( 'Docs Order By', 'betterdocs' ),
                                                                    'default'  => 'betterdocs_order',
                                                                    'options'  => $this->normalize_options( [
                                                                        'none'             => __( 'No order', 'betterdocs' ),
                                                                        'ID'               => __( 'Docs ID', 'betterdocs' ),
                                                                        'author'           => __( 'Docs Author', 'betterdocs' ),
                                                                        'title'            => __( 'Title', 'betterdocs' ),
                                                                        'date'             => __( 'Date', 'betterdocs' ),
                                                                        'modified'         => __( 'Last Modified Date', 'betterdocs' ),
                                                                        'parent'           => __( 'Parent Id', 'betterdocs' ),
                                                                        'rand'             => __( 'Random', 'betterdocs' ),
                                                                        'comment_count'    => __( 'Comment Count', 'betterdocs' ),
                                                                        'menu_order'       => __( 'Menu Order', 'betterdocs' ),
                                                                        'betterdocs_order' => __( 'BetterDocs Order', 'betterdocs' )
                                                                    ] ),
                                                                    'priority' => 4
                                                                ],
                                                                'docs_order'                => [
                                                                    'name'     => 'docs_order',
                                                                    'type'     => 'select',
                                                                    'label'    => __( 'Docs Order', 'betterdocs' ),
                                                                    'default'  => 'ASC',
                                                                    'options'  => $this->normalize_options( [
                                                                        'ASC'  => 'Ascending',
                                                                        'DESC' => 'Descending'
                                                                    ] ),
                                                                    'priority' => 5
                                                                ]
                                                            ]
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ],
                                        'layout_single_doc'         => [
                                            'id'       => 'layout_single_doc',
                                            'name'     => 'layout_single_doc',
                                            'type'     => 'section',
                                            'label'    => __( 'Single Doc', 'betterdocs' ),
                                            'priority' => 2,
                                            'fields'   => [
                                                'tab-nested-layout-2' => [
                                                    'id'              => 'tab-nested-layout-2',
                                                    'name'            => 'tab_nested_layout_2',
                                                    'label'           => __( 'Single Doc', 'betterdocs' ),
                                                    'classes'         => 'tab-nested-layout',
                                                    'type'            => "tab",
                                                    'active'          => "layout_single_doc_general",
                                                    'completionTrack' => true,
                                                    'sidebar'         => false,
                                                    'save'            => false,
                                                    'title'           => false,
                                                    'config'          => [
                                                        'active'  => 'layout_single_doc_general',
                                                        'sidebar' => false,
                                                        'title'   => false
                                                    ],
                                                    'submit'          => [
                                                        'show' => false
                                                    ],
                                                    'step'            => [
                                                        'show' => false
                                                    ],
                                                    'priority'        => 20,
                                                    'fields'          => [
                                                        'layout_single_doc_general'        => [
                                                            'id'       => 'layout_single_doc_general',
                                                            'name'     => 'layout_single_doc_general',
                                                            'type'     => 'section',
                                                            'label'    => __( 'General', 'betterdocs' ),
                                                            'priority' => 5,
                                                            'fields'   => [
                                                                'enable_post_title'       => [
                                                                    'name'                       => 'enable_post_title',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Doc Title', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 1
                                                                ],
                                                                'enable_sidebar_cat_list' => [
                                                                    'name'                       => 'enable_sidebar_cat_list',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Sidebar Category List', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 2
                                                                ],
                                                                'enable_print_icon'       => [
                                                                    'name'                       => 'enable_print_icon',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Print Icon', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 3
                                                                ],
                                                                'enable_tags'             => [
                                                                    'name'                       => 'enable_tags',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Tags', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 4
                                                                ],
                                                                'show_last_update_time'   => [
                                                                    'name'                       => 'show_last_update_time',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Last Update Time', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 5
                                                                ],
                                                                'enable_navigation'       => [
                                                                    'name'                       => 'enable_navigation',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Navigation', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 6
                                                                ],
                                                                'enable_comment'          => [
                                                                    'name'                       => 'enable_comment',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Comment', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => '',
                                                                    'priority'                   => 7
                                                                ],
                                                                'enable_credit'           => [
                                                                    'name'                       => 'enable_credit',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Credit', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 8
                                                                ]
                                                            ]
                                                        ],
                                                        'layout_single_doc_TOC'            => [
                                                            'id'       => 'layout_single_doc_TOC',
                                                            'name'     => 'layout_single_doc_TOC',
                                                            'type'     => 'section',
                                                            'label'    => __( 'TOC', 'betterdocs' ),
                                                            'priority' => 5,
                                                            'fields'   => [
                                                                'enable_toc'             => [
                                                                    'name'                       => 'enable_toc',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Table of Contents', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 1
                                                                ],
                                                                'toc_title'              => [
                                                                    'name'     => 'toc_title',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'TOC Title', 'betterdocs' ),
                                                                    'default'  => __( 'Table of Contents', 'betterdocs' ),
                                                                    'priority' => 2,
                                                                    'rules'    => Rules::is( 'enable_toc', true )

                                                                ],
                                                                'toc_hierarchy'          => [
                                                                    'name'                       => 'toc_hierarchy',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'TOC Hierarchy', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 3,
                                                                    'rules'                      => Rules::is( 'enable_toc', true )
                                                                ],
                                                                'toc_list_number'        => [
                                                                    'name'                       => 'toc_list_number',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'TOC List Number', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 4,
                                                                    'rules'                      => Rules::is( 'enable_toc', true )
                                                                ],
                                                                'toc_dynamic_title'      => [
                                                                    'name'                       => 'toc_dynamic_title',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Show TOC Title in Anchor Links', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 0,
                                                                    'priority'                   => 5,
                                                                    'rules'                      => Rules::is( 'enable_toc', true )
                                                                ],
                                                                'enable_sticky_toc'      => [
                                                                    'name'                       => 'enable_sticky_toc',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Sticky TOC', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 6,
                                                                    'rules'                      => Rules::is( 'enable_toc', true )
                                                                ],
                                                                'collapsible_toc_mobile' => [
                                                                    'name'                       => 'collapsible_toc_mobile',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Collapsible TOC on small devices', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => '',
                                                                    'priority'                   => 7,
                                                                    'rules'                      => Rules::is( 'enable_toc', true )
                                                                ],
                                                                'title_link_ctc'         => [
                                                                    'name'                       => 'title_link_ctc',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Title Link Copy To Clipboard', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 8
                                                                ],
                                                                'supported_heading_tag'  => [
                                                                    'name'     => 'supported_heading_tag',
                                                                    'label'    => __( 'TOC Supported Heading Tag', 'betterdocs' ),
                                                                    'type'     => 'checkbox-select',
                                                                    'multiple' => true,
                                                                    'priority' => 10,
                                                                    'default'  => ['1', '2', '3', '4', '5', '6'],
                                                                    'options'  => $this->normalize_options( [
                                                                        '1' => 'H1',
                                                                        '2' => 'H2',
                                                                        '3' => 'H3',
                                                                        '4' => 'H4',
                                                                        '5' => 'H5',
                                                                        '6' => 'H6'
                                                                    ] ),
                                                                    'priority' => 9,
                                                                    'rules'    => Rules::is( 'enable_toc', true )
                                                                ],
                                                                'sticky_toc_offset'      => [
                                                                    'name'           => 'sticky_toc_offset',
                                                                    'type'           => 'number',
                                                                    'label'          => __( 'Content Offset', 'betterdocs' ),
                                                                    'default'        => 100,
                                                                    'priority'       => 10,
                                                                    'label_subtitle' => __( 'content offset from top on scroll.', 'betterdocs' ),
                                                                    'rules'          => Rules::is( 'enable_toc', true )
                                                                ]
                                                            ]
                                                        ],
                                                        'layout_single_doc_breadcrumb'     => [
                                                            'id'       => 'layout_single_doc_breadcrumb',
                                                            'name'     => 'layout_single_doc_breadcrumb',
                                                            'type'     => 'section',
                                                            'label'    => __( 'Breadcrumb', 'betterdocs' ),
                                                            'priority' => 5,
                                                            'fields'   => [
                                                                'enable_breadcrumb'          => [
                                                                    'name'                       => 'enable_breadcrumb',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Breadcrumb', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 1
                                                                ],
                                                                'breadcrumb_home_text'       => [
                                                                    'name'     => 'breadcrumb_home_text',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'Breadcrumb Home Text', 'betterdocs' ),
                                                                    'default'  => __( 'Home', 'betterdocs' ),
                                                                    'priority' => 2,
                                                                    'rules'    => Rules::is( 'enable_breadcrumb', true )
                                                                ],
                                                                'breadcrumb_home_url'        => [
                                                                    'name'     => 'breadcrumb_home_url',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'Breadcrumb Home URL', 'betterdocs' ),
                                                                    'priority' => 3,
                                                                    'default'  => get_home_url(),
                                                                    'rules'    => Rules::is( 'enable_breadcrumb', true )
                                                                ],
                                                                'enable_breadcrumb_category' => [
                                                                    'name'                       => 'enable_breadcrumb_category',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Category on Breadcrumb', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 4,
                                                                    'rules'                      => Rules::is( 'enable_breadcrumb', true )
                                                                ],
                                                                'enable_breadcrumb_title'    => [
                                                                    'name'                       => 'enable_breadcrumb_title',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Title on Breadcrumb', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 5,
                                                                    'rules'                      => Rules::is( 'enable_breadcrumb', true )
                                                                ]
                                                            ]
                                                        ],
                                                        'layout_single_doc_email_feedback' => [
                                                            'id'       => 'layout_single_doc_email_feedback',
                                                            'name'     => 'layout_single_doc_email_feedback',
                                                            'type'     => 'section',
                                                            'label'    => __( 'Email Feedback', 'betterdocs' ),
                                                            'priority' => 5,
                                                            'fields'   => [
                                                                'email_feedback'      => [
                                                                    'name'                       => 'email_feedback',
                                                                    'type'                       => 'toggle',
                                                                    'label'                      => __( 'Email Feedback', 'betterdocs' ),
                                                                    'enable_disable_text_active' => true,
                                                                    'default'                    => 1,
                                                                    'priority'                   => 1
                                                                ],
                                                                'feedback_link_text'  => [
                                                                    'name'     => 'feedback_link_text',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'Feedback Link Text', 'betterdocs' ),
                                                                    'default'  => __( 'Still stuck? How can we help?', 'betterdocs' ),
                                                                    'priority' => 2,
                                                                    'rules'    => Rules::is( 'email_feedback', true )
                                                                ],
                                                                'feedback_form_title' => [
                                                                    'name'     => 'feedback_form_title',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'Feedback Form Title', 'betterdocs' ),
                                                                    'default'  => __( 'Still stuck? How can we help?', 'betterdocs' ),
                                                                    'priority' => 3,
                                                                    'rules'    => Rules::is( 'email_feedback', true )
                                                                ],
                                                                'email_address'       => [
                                                                    'name'           => 'email_address',
                                                                    'type'           => 'text',
                                                                    'label'          => __( 'Email Address', 'betterdocs' ),
                                                                    'default'        => get_option( 'admin_email' ),
                                                                    'priority'       => 4,
                                                                    'label_subtitle' => __( 'The email address where the Feedback form will be sent', 'betterdocs' ),
                                                                    'rules'          => Rules::is( 'email_feedback', true )
                                                                ],
                                                                'feedback_url'        => [
                                                                    'name'     => 'feedback_url',
                                                                    'type'     => 'text',
                                                                    'label'    => __( 'Feedback URL', 'betterdocs' ),
                                                                    'default'  => '',
                                                                    'priority' => 5,
                                                                    'rules'    => Rules::is( 'email_feedback', true )
                                                                ]
                                                            ]
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ],
                                        'layout_archive_page'       => [
                                            'id'       => 'layout_archive_page',
                                            'name'     => 'layout_archive_page',
                                            'type'     => 'section',
                                            'label'    => __( 'Archive Page', 'betterdocs' ),
                                            'priority' => 3,
                                            'fields'   => [
                                                'enable_archive_sidebar'     => [
                                                    'name'                       => 'enable_archive_sidebar',
                                                    'type'                       => 'toggle',
                                                    'label'                      => __( 'Sidebar Category List', 'betterdocs' ),
                                                    'enable_disable_text_active' => true,
                                                    'default'                    => 1,
                                                    'priority'                   => 31
                                                ],
                                                'archive_nested_subcategory' => [
                                                    'name'                       => 'archive_nested_subcategory',
                                                    'type'                       => 'toggle',
                                                    'label'                      => __( 'Nested Subcategory', 'betterdocs' ),
                                                    'enable_disable_text_active' => true,
                                                    'default'                    => 1,
                                                    'priority'                   => 32
                                                ]
                                            ]
                                        ]
                                    ]
                                ] )
                            ]
                        ]
                    ]
                ] ),
                'tab-design'           => apply_filters( 'betterdocs_settings_tab_design', [
                    'id'       => 'tab-design',
                    'label'    => __( 'Design', 'betterdocs' ),
                    'priority' => 30,
                    'fields'   => [
                        'title-design' => [
                            'name'     => 'title-design-tab',
                            'type'     => 'section',
                            'label'    => __( 'Design', 'betterdocs' ),
                            'priority' => 30,
                            'fields'   => [
                                'customizer_link' => [
                                    'name'           => 'customizer_link',
                                    'type'           => 'action',
                                    'action'         => 'betterdocs_settings_customizer_link',
                                    'label'          => __( 'Customize BetterDocs', 'betterdocs' ),
                                    'url'            => $this->customizer_link(),
                                    'customizer_img' => betterdocs()->assets->icon( 'customizer/betterdocs-customize.png', true ),
                                    'priority'       => 1
                                ]
                            ]
                        ]
                    ]
                ] ),
                'tab-shortcodes'       => apply_filters( 'betterdocs_settings_tab_shortcodes', [
                    'label'    => __( 'Shortcodes', 'betterdocs' ),
                    'id'       => 'tab-shortcodes',
                    'classes'  => 'tab-shortcodes',
                    'priority' => 40,
                    'fields'   => [
                        'title-shortcodes' => [
                            'name'                  => 'title-shortcodes-tab',
                            'type'                  => 'section',
                            'label'                 => __( 'Shortcodes', 'betterdocs' ),
                            'priority'              => 40,
                            'searchable'            => true,
                            'searchPlaceholder'     => __( 'Search for shortcode', 'betterdocs' ),
                            'searchNotFoundMessage' => '<img src="' . betterdocs()->assets->icon( 'not-found.svg', true ) . '"/><p>' . __( 'No Shortcodes Found with these keywords', 'betterdocs' ) . '</p>',
                            'fields'                => apply_filters( 'betterdocs_shortcode_fields', [
                                'search_form'        => [
                                    'name'                => 'search_form',
                                    'type'                => 'copy-to-clipboard',
                                    'label'               => __( 'Search Form', 'betterdocs' ),
                                    'default'             => '[betterdocs_search_form]',
                                    'readOnly'            => true,
                                    'priority'            => 1,
                                    'description'         => __( '[betterdocs_search_form placeholder="Search..." heading="Heading" subheading="Subheading" category_search="true" search_button="true" popular_search="true"]', 'betterdocs' ),
                                    'descriptionLabel'    => __( 'Example with parameters:', 'betterdocs' ),
                                    'descriptionCopyable' => true
                                ],
                                'feedback_form'      => [
                                    'name'                => 'feedback_form',
                                    'type'                => 'copy-to-clipboard',
                                    'label'               => __( 'Feedback Form', 'betterdocs' ),
                                    'default'             => '[betterdocs_feedback_form]',
                                    'readOnly'            => true,
                                    'priority'            => 2,
                                    'description'         => __( '[betterdocs_feedback_form button_text="Send"]', 'betterdocs' ),
                                    'descriptionLabel'    => __( 'Example with parameters:', 'betterdocs' ),
                                    'descriptionCopyable' => true
                                ],
                                'category_grid'      => [
                                    'name'                => 'category_grid',
                                    'type'                => 'copy-to-clipboard',
                                    'label'               => __( 'Category Grid- Layout 1', 'betterdocs' ),
                                    'default'             => '[betterdocs_category_grid]',
                                    'readOnly'            => true,
                                    'priority'            => 3,
                                    'description'         => __( '[betterdocs_category_grid post_counter="true" show_icon="true" masonry="true" column="3" posts_per_page="5" nested_subcategory="true" terms="term_ID, term_ID" terms_orderby="" terms_order="" multiple_knowledge_base="" kb_slug="" title_tag="h2" orderby="" order="" ]', 'betterdocs' ),
                                    'descriptionLabel'    => __( 'Example with parameters:', 'betterdocs' ),
                                    'descriptionCopyable' => true
                                ],
                                'category_box'       => [
                                    'name'                => 'category_box',
                                    'type'                => 'copy-to-clipboard',
                                    'label'               => __( 'Category Box- Layout 2', 'betterdocs' ),
                                    'default'             => '[betterdocs_category_box]',
                                    'readOnly'            => true,
                                    'priority'            => 4,
                                    'description'         => __( '[betterdocs_category_box orderby="" column="" nested_subcategory="" terms="" terms_orderby="" show_icon="" kb_slug="" title_tag="h2" multiple_knowledge_base="false" border_bottom="false"]', 'betterdocs' ),
                                    'descriptionLabel'    => __( 'Example with parameters:', 'betterdocs' ),
                                    'descriptionCopyable' => true
                                ],
                                'category_list'      => [
                                    'name'                => 'category_list',
                                    'type'                => 'copy-to-clipboard',
                                    'label'               => __( 'Category List', 'betterdocs' ),
                                    'default'             => '[betterdocs_category_list]',
                                    'readOnly'            => true,
                                    'priority'            => 5,
                                    'description'         => __( '[betterdocs_category_list orderby="" order="" posts_per_page="" nested_subcategory="" terms="" terms_orderby="" terms_order="" kb_slug="" multiple_knowledge_base="false" title_tag="h2"]', 'betterdocs' ),
                                    'descriptionLabel'    => __( 'Example with parameters:', 'betterdocs' ),
                                    'descriptionCopyable' => true
                                ],
                                'faq_modern_layout'  => [
                                    'name'                => 'faq_modern_layout',
                                    'type'                => 'copy-to-clipboard',
                                    'label'               => __( 'FAQ Layout - 1', 'betterdocs' ),
                                    'default'             => '[betterdocs_faq_list_modern]',
                                    'readOnly'            => true,
                                    'priority'            => 13,
                                    'description'         => __( '[betterdocs_faq_list_modern groups="group_id" class="" group_exclude="group_id" faq_heading="Frequently Asked Questions"]', 'betterdocs' ),
                                    'descriptionLabel'    => __( 'Example with parameters:', 'betterdocs' ),
                                    'descriptionCopyable' => true
                                ],
                                'faq_classic_layout' => [
                                    'name'                => 'faq_classic_layout',
                                    'type'                => 'copy-to-clipboard',
                                    'label'               => __( 'FAQ Layout - 2', 'betterdocs' ),
                                    'default'             => '[betterdocs_faq_list_classic]',
                                    'readOnly'            => true,
                                    'priority'            => 14,
                                    'description'         => __( '[betterdocs_faq_list_classic groups="group_id" class="" group_exclude="group_id" faq_heading="Frequently Asked Questions"]', 'betterdocs' ),
                                    'descriptionLabel'    => __( 'Example with parameters:', 'betterdocs' ),
                                    'descriptionCopyable' => true
                                ]
                            ] )
                        ]
                    ]
                ] ),
                'tab-advance-settings' => apply_filters( 'betterdocs_settings_tab_advance', [
                    'id'       => 'tab-advance-settings',
                    'label'    => __( 'Advanced Settings', 'betterdocs' ),
                    'priority' => 50,
                    'fields'   => [
                        'title-advance-settings' => [
                            'name'     => 'title-advance-settings-tab',
                            'type'     => 'section',
                            'label'    => __( 'Advanced Settings', 'betterdocs' ),
                            'priority' => 50,
                            'fields'   => apply_filters( 'betterdocs_internal_kb_fields', [
                                'article_roles'              => [
                                    'name'     => 'article_roles',
                                    'type'     => 'checkbox-select',
                                    'label'    => __( 'Who Can Write Docs?', 'betterdocs' ),
                                    'priority' => 1,
                                    'multiple' => true,
                                    'search'   => true,
                                    'is_pro'   => true,
                                    'default'  => ['administrator'],
                                    'options'  => $wp_roles
                                ],
                                'settings_roles'             => [
                                    'name'     => 'settings_roles',
                                    'type'     => 'checkbox-select',
                                    'label'    => __( 'Who Can Edit Settings?', 'betterdocs' ),
                                    'priority' => 2,
                                    'multiple' => true,
                                    'is_pro'   => true,
                                    'search'   => true,
                                    'default'  => ['administrator'],
                                    'options'  => $wp_roles
                                ],
                                'analytics_roles'            => [
                                    'name'     => 'analytics_roles',
                                    'type'     => 'checkbox-select',
                                    'label'    => __( 'Who Can Check Analytics?', 'betterdocs' ),
                                    'priority' => 3,
                                    'multiple' => true,
                                    'is_pro'   => true,
                                    'search'   => true,
                                    'default'  => ['administrator'],
                                    'options'  => $wp_roles
                                ],
                                'enable_content_restriction' => [
                                    'name'                       => 'enable_content_restriction',
                                    'type'                       => 'toggle',
                                    'is_pro'                     => true,
                                    'priority'                   => 4,
                                    'label'                      => __( 'Internal Knowledge Base', 'betterdocs' ),
                                    'enable_disable_text_active' => true,
                                    'default'                    => ['all']
                                ],
                                'content_visibility'         => [
                                    'name'           => 'content_visibility',
                                    'type'           => 'checkbox-select',
                                    'label'          => __( 'Restrict Access to', 'betterdocs' ),
                                    'label_subtitle' => __( 'Only selected User Roles will be able to view your Knowledge Base', 'betterdocs' ),
                                    'is_pro'         => true,
                                    'priority'       => 5,
                                    'multiple'       => true,
                                    'search'         => true,
                                    'default'        => ['all'],
                                    'placeholder'    => __( 'Select any', 'betterdocs' ),
                                    'options'        => $this->normalize_options( array_merge( [
                                        'all' => __( 'All logged in users', 'betterdocs' )
                                    ], wp_roles()->role_names ) ),
                                    'rules'          => Rules::is( 'enable_content_restriction', true ),
                                    'filterValue'    => 'all'
                                ],
                                'restrict_template'          => [
                                    'name'           => 'restrict_template',
                                    'type'           => 'checkbox-select',
                                    'label'          => __( 'Restriction on Docs', 'betterdocs' ),
                                    'label_subtitle' => __( 'Selected Docs pages will be restricted', 'betterdocs' ),
                                    'is_pro'         => true,
                                    'priority'       => 6,
                                    'multiple'       => true,
                                    'search'         => true,
                                    'default'        => ['all'],
                                    'placeholder'    => __( 'Select any', 'betterdocs' ),
                                    'options'        => $this->get_texanomy(),
                                    'rules'          => Rules::is( 'enable_content_restriction', true ),
                                    'filterValue'    => 'all'
                                ],
                                'restrict_category'          => [
                                    'name'           => 'restrict_category',
                                    'type'           => 'checkbox-select',
                                    'label'          => __( 'Restriction on Docs Categories', 'betterdocs' ),
                                    'label_subtitle' => __( 'Selected Docs categories will be restricted', 'betterdocs' ),
                                    'is_pro'         => true,
                                    'priority'       => 7,
                                    'multiple'       => true,
                                    'search'         => true,
                                    'default'        => ['all'],
                                    'placeholder'    => __( 'Select any', 'betterdocs' ),
                                    'options'        => $this->get_terms( 'doc_category' ),
                                    'rules'          => Rules::is( 'enable_content_restriction', true ),
                                    'filterValue'    => 'all'
                                ],
                                'restricted_redirect_url'    => [
                                    'name'           => 'restricted_redirect_url',
                                    'type'           => 'text',
                                    'label'          => __( 'Redirect URL', 'betterdocs' ),
                                    'label_subtitle' => __( 'Set a custom URL to redirect users without permissions when they try to access internal knowledge base. By default, restricted content will redirect to the "404 not found" page', 'betterdocs' ),
                                    'default'        => '',
                                    'placeholder'    => 'https://',
                                    'is_pro'         => true,
                                    'priority'       => 9,
                                    'rules'          => Rules::is( 'enable_content_restriction', true )
                                ]
                            ] )
                        ]
                    ]
                ] ),
                'tab-email-reporting'  => apply_filters( 'betterdocs_settings_tab_email_reporting', [
                    'id'       => 'tab-email-reporting',
                    'label'    => __( 'Email Reporting', 'betterdocs' ),
                    'priority' => 60,
                    'fields'   => [
                        'title-email-reporting' => [
                            'name'     => 'title-email-reporting-tab',
                            'type'     => 'section',
                            'label'    => __( 'Email Reporting', 'betterdocs' ),
                            'priority' => 60,
                            'fields'   => [
                                'enable_reporting'      => [
                                    'name'                       => 'enable_reporting',
                                    'label'                      => __( 'Email Reporting', 'betterdocs' ),
                                    'enable_disable_text_active' => true,
                                    'type'                       => 'toggle',
                                    'priority'                   => 1,
                                    'default'                    => 0
                                ],
                                'reporting_frequency'   => apply_filters( 'betterdocs_reporting_frequency_settings', [
                                    'name'     => 'reporting_frequency',
                                    'type'     => 'select',
                                    'label'    => __( 'Reporting Frequency', 'betterdocs' ),
                                    'default'  => 'betterdocs_weekly',
                                    'priority' => 2,
                                    'is_pro'   => true,
                                    'options'  => $this->normalize_options( [
                                        'betterdocs_daily'   => __( 'Once Daily', 'betterdocs' ),
                                        'betterdocs_weekly'  => __( 'Once Weekly', 'betterdocs' ),
                                        'betterdocs_monthly' => __( 'Once Monthly', 'betterdocs' )
                                    ] ),
                                    'rules'    => Rules::is( 'enable_reporting', true )
                                ] ),
                                'reporting_day'         => [
                                    'name'           => 'reporting_day',
                                    'type'           => 'select',
                                    'label'          => __( 'Reporting Day', 'betterdocs' ),
                                    'default'        => 'monday',
                                    'rules'          => Rules::logicalRule( [
                                        Rules::is( 'enable_reporting', true ),
                                        Rules::is( 'reporting_frequency', 'betterdocs_weekly' )
                                    ], 'and' ),
                                    'priority'       => 3,
                                    'options'        => $this->normalize_options( [
                                        'sunday'    => __( 'Sunday', 'betterdocs' ),
                                        'monday'    => __( 'Monday', 'betterdocs' ),
                                        'tuesday'   => __( 'Tuesday', 'betterdocs' ),
                                        'wednesday' => __( 'Wednesday', 'betterdocs' ),
                                        'thursday'  => __( 'Thursday', 'betterdocs' ),
                                        'friday'    => __( 'Friday', 'betterdocs' ),
                                        'saturday'  => __( 'Saturday', 'betterdocs' )
                                    ] ),
                                    'label_subtitle' => __( 'This is only applicable for the “Weekly” report', 'betterdocs' )
                                ],
                                'select_reporting_data' => apply_filters( 'betterdocs_select_reporting_data_settings', [
                                    'name'     => 'select_reporting_data',
                                    'type'     => 'checkbox-select',
                                    'label'    => __( 'Select Reporting Data', 'betterdocs' ),
                                    'priority' => 4,
                                    'multiple' => true,
                                    'options'  => $this->normalize_options( [
                                        'overview'    => 'Overview',
                                        'top-docs'    => 'Top Docs',
                                        'most-search' => 'Most Searched Keywords'
                                    ] ),
                                    'default'  => ['overview', 'top-docs', 'most-search'],
                                    'is_pro'   => true,
                                    'rules'    => Rules::is( 'enable_reporting', true )
                                ] ),
                                'reporting_email'       => [
                                    'name'     => 'reporting_email',
                                    'type'     => 'text',
                                    'label'    => __( 'Reporting Email', 'betterdocs' ),
                                    'default'  => get_option( 'admin_email' ),
                                    'priority' => 5,
                                    'rules'    => Rules::is( 'enable_reporting', true )
                                ],
                                'reporting_subject'     => apply_filters( 'betterdocs_reporting_subject_settings', [
                                    'name'     => 'reporting_subject',
                                    'type'     => 'textarea',
                                    'label'    => __( 'Reporting Email Subject', 'betterdocs' ),
                                    'default'  => wp_sprintf( __( 'Your Documentation Performance of %s Website', 'betterdocs' ), get_bloginfo( 'name' ) ),
                                    'priority' => 6,
                                    'is_pro'   => true,
                                    'rules'    => Rules::is( 'enable_reporting', true )
                                ] ),
                                'test_report'           => [
                                    'name'     => 'test_report',
                                    'label'    => __( 'Reporting Test', 'betterdocs' ),
                                    'text'     => __( 'Test Report', 'betterdocs' ),
                                    'type'     => 'button',
                                    'priority' => 7,
                                    'rules'    => Rules::is( 'enable_reporting', true ),
                                    'ajax'     => [
                                        'on'   => 'click',
                                        'api'  => '/betterdocs/v1/reporting-test',
                                        'data' => [
                                            'enable_reporting'      => '@enable_reporting',
                                            'select_reporting_data' => '@select_reporting_data',
                                            'reporting_subject'     => '@reporting_subject',
                                            'reporting_email'       => '@reporting_email',
                                            'reporting_day'         => '@reporting_day',
                                            'reporting_frequency'   => '@reporting_frequency'
                                        ],
                                        'swal' => [
                                            'text'      => __( 'Successfully Sent a Test Report in Your Email.', 'betterdocs' ),
                                            'icon'      => 'success',
                                            'autoClose' => 2000
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ] ),
                'tab-instant-answer'   => apply_filters( 'betterdocs_settings_tab_instant_answer', [
                    'id'       => 'tab-instant-answer',
                    'name'     => 'tab-instant-answer',
                    'type'     => 'section',
                    'label'    => __( 'Instant Answer', 'betterdocs' ),
                    'is_pro'   => ! defined( 'BETTERDOCS_PRO_VERSION' ),
                    'priority' => 70,
                    'fields'   => [
                        'title-instant-answer' => [
                            'name'       => 'title-instant-answer-tab',
                            'type'       => 'section',
                            'label'      => __( 'Instant Answer', 'betterdocs' ),
                            'priority'   => 80,
                            'showSubmit' => true,
                            'fields'     => apply_filters( 'betterdocs_instant_answer_fields', [
                                'enable_disable_wrapper' => [
                                    'name'     => 'enable_disable_wrapper',
                                    'type'     => 'section',
                                    'priority' => 0,
                                    'fields'   => [
                                        'enable_disable' => [
                                            'name'                       => 'enable_disable',
                                            'type'                       => 'toggle',
                                            'priority'                   => 100,
                                            'description'                => __( 'Enable Instant Answer', 'betterdocs' ),
                                            'enable_disable_text_active' => false,
                                            'default'                    => true,
                                            'is_pro'                     => true
                                        ]
                                    ]
                                ]
                            ] )
                        ]
                    ]
                ] )
            ] )
        ];

        return apply_filters( 'betterdocs_settings_args', $settings );
    }

    public function normalize_options( $options ) {
        return GlobalFields::normalize_fields( $options );
    }

    public function get_texanomy() {
        $docs_tax = $this->database->get_cache( 'betterdocs::settings::taxonomies' );

        if ( $docs_tax ) {
            return $docs_tax;
        }

        $taxonomies = get_taxonomies( [
            'object_type' => ['docs']
        ], 'objects' );

        $docs_tax = [
            'all'  => 'All Docs Archive',
            'docs' => 'Docs Page'
        ];
        foreach ( $taxonomies as $key => $value ) {
            $docs_tax[$key] = $value->label;
        }
        unset( $docs_tax['doc_tag'] );

        $docs_tax = $this->normalize_options( $docs_tax );
        if ( count( $docs_tax ) > 2 ) {
            $this->database->set_cache( 'betterdocs::settings::taxonomies', $docs_tax );
        }

        return $docs_tax;
    }

    public function get_terms( $taxonomy ) {
        $_cache_key = 'betterdocs::settings::terms::' . trim( $taxonomy );
        $docs_tax   = $this->database->get_cache( $_cache_key );

        if ( $docs_tax ) {
            return $docs_tax;
        }

        $get_terms = get_terms( [
            'taxonomy'   => $taxonomy,
            'hide_empty' => false
        ] );

        $terms = [
            'all' => 'All'
        ];

        if ( ! empty( $get_terms ) && ! is_wp_error( $get_terms ) ) {
            foreach ( $get_terms as $value ) {
                if ( isset( $value->slug ) && isset( $value->name ) ) {
                    $terms[$value->slug] = $value->name;
                }
            }
        }

        $terms = $this->normalize_options( $terms );
        if ( count( $terms ) > 1 ) {
            $this->database->set_cache( $_cache_key, $terms );
        }

        return $terms;
    }

    public function hide_roles_management( $tabData = [] ) {
        global $current_user;

        if ( $current_user instanceof WP_User && ! in_array( 'administrator', $current_user->roles ) ) {
            unset( $tabData['fields']['title-advance-settings']['fields']['article_roles'] );
            unset( $tabData['fields']['title-advance-settings']['fields']['settings_roles'] );
            unset( $tabData['fields']['title-advance-settings']['fields']['analytics_roles'] );
        }

        return $tabData;
    }
}
