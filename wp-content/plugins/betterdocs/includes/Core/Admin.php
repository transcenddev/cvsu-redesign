<?php

namespace WPDeveloper\BetterDocs\Core;

use Exception;
use PriyoMukul\WPNotice\Notices;
use PriyoMukul\WPNotice\Utils\CacheBank;
use PriyoMukul\WPNotice\Utils\NoticeRemover;
use WPDeveloper\BetterDocs\Admin\Analytics;
use WPDeveloper\BetterDocs\Dependencies\DI\Container;
use WPDeveloper\BetterDocs\Utils\Base;
use WPDeveloper\BetterDocs\Utils\Enqueue;
use WPDeveloper\BetterDocs\Utils\Helper;
use WPDeveloper\BetterDocs\Utils\Insights;

class Admin extends Base {
    /**
     * @var CacheBank
     */
    private static $cache_bank;
    /**
     * Admin Root Menu Slug
     * @var string
     */
    private $slug = 'betterdocs-admin';
    /**
     * Insights
     *
     * @var Insights
     */
    private $insights = null;

    /**
     * DI\Container
     *
     * @var Container
     */
    private $container;

    /**
     * Database Wrapper
     *
     * @var Settings
     */
    private $settings;

    /**
     * Enqueue
     * @var Enqueue
     */
    private $assets;

    /**
     * FAQBuilder
     * @var FAQBuilder
     */
    private $faq_builder;

    public function __construct( Container $container, PostType $type, Enqueue $assets, Settings $settings ) {
        $this->container = $container;
        $this->assets    = $assets;
        $this->settings  = $settings;
        $this->slug      = 'betterdocs-admin';

        add_action( 'init', [ $type, 'register' ], 9 );

        $type->init();
        $type->admin_init();

        $this->faq_builder = $this->container->get( FAQBuilder::class );

        if ( ! is_admin() ) {
            return;
        }

        $this->plugin_insights();
        add_action( 'admin_notices', [$this, 'compatibility_notices'] );
        // add_action( 'admin_init', [$this, 'notices'], 9 );
        add_filter( 'admin_init', [$this, 'save_admin_page'], 99 );

        add_action( 'admin_menu', [$this, 'menus'] );
        add_action( 'admin_menu', [$this, 'reset_submenu'] );
        add_filter( 'plugin_action_links_' . BETTERDOCS_PLUGIN_BASENAME, [$this, 'insert_plugin_links'] );

        // $this->container->get( SetupWizard::class )->init();

        add_action( 'admin_enqueue_scripts', [ $this, 'styles' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'scripts' ] );
        add_action( 'betterdocs_listing_header', [ $this, 'header' ], 10, 1 );
        add_action( 'admin_bar_menu', [ $this, 'toolbar_menu' ], 32 );

        add_filter( 'admin_body_class', [ $this, 'body_classes' ] );
        add_filter( 'parent_file', [ $type, 'highlight_admin_menu' ] );
        add_filter( 'submenu_file', [ $type, 'highlight_admin_submenu' ], 10, 2 );
        add_filter( 'betterdocs_admin_menu', [ $this, 'quick_setup_menu' ], 10, 1 );

        /**
         * Remove Comments Column from List Table.
         */
        add_filter( 'manage_docs_posts_columns', [ $this, 'set_custom_edit_action_columns' ] );
        add_filter( 'manage_docs_posts_custom_column', [ $this, 'manage_custom_columns' ], 10, 2 );

        self::$cache_bank = CacheBank::get_instance();
        try {
            $this->notices();
        } catch ( Exception $e ) {
            unset( $e );
        }
        // Remove OLD notice from 1.0.0 (if other WPDeveloper plugin has notice)
        NoticeRemover::get_instance( '1.0.0' );
    }

    public function compatibility_notices() {
        if ( betterdocs()->is_pro_active() ) {
            $plugins     = Helper::get_plugins();
            $plugin_data = $plugins['betterdocs-pro/betterdocs-pro.php'];

            if ( isset( $plugin_data['Version'] ) && version_compare( $plugin_data['Version'], '2.5.0', '>=' ) ) {
                return;
            }

            betterdocs()->views->get( 'admin/notices/compatibility', [ 'version' => $plugin_data['Version'] ] );
        }
    }

    public function plugin_insights( $prevent_init = false ) {
        $this->insights = Insights::get_instance( BETTERDOCS_PLUGIN_FILE, [
            'opt_in'       => true,
            'goodbye_form' => true,
            'item_id'      => 'c7b16777b4f1b83f6083'
        ] );

        $this->insights->set_notice_options( [
            'notice'       => __( 'Want to help make <strong>BetterDocs</strong> even more awesome? You can get a <strong>10% discount coupon</strong> for Premium extensions if you allow us to track the usage.', 'betterdocs' ),
            'extra_notice' => __( 'We collect non-sensitive diagnostic data and plugin usage information. Your site URL, WordPress & PHP version, plugins & themes and email address to send you the discount coupon. This data lets us make sure this plugin always stays compatible with the most popular plugins and themes. No spam, I promise.', 'betterdocs' )
        ] );

        if ( ! $prevent_init ) {
            $this->insights->init();
        }

        return $this->insights;
    }

    /**
     * Admin notices for Review and others.
     *
     * @return void
     * @throws Exception
     */
    public function notices() {
        $notices = new Notices( [
            'id'             => 'betterdocs',
            'storage_key'    => 'notices',
            'lifetime'       => 3,
            'stylesheet_url' => $this->assets->asset_url( 'admin/css/notices.css' ),
            'styles' => $this->assets->asset_url( 'admin/css/notices.css' ),
            'priority'       => 4
        ] );

        /**
         * Review Notice
         * @var mixed $message
         */

        $message = __( 'We hope you\'re enjoying BetterDocs! Could you please do us a BIG favor and give it a 5-star rating on WordPress to help us spread the word and boost our motivation?', 'betterdocs' );

        $_review_notice = [
            'thumbnail' => $this->assets->icon( 'betterdocs-icon.svg', true ),
            'html'      => '<p>' . $message . '</p>',
            'links'     => [
                'later'            => [
                    'link'       => 'https://wordpress.org/plugins/betterdocs/#reviews',
                    'target'     => '_blank',
                    'label'      => __( 'Sure, you deserve it!', 'betterdocs' ),
                    'icon_class' => 'dashicons dashicons-external'
                ],
                'allready'         => [
                    'label'      => __( 'I already did', 'betterdocs' ),
                    'icon_class' => 'dashicons dashicons-smiley',
                    'attributes' => [
                        'data-dismiss' => true
                    ]
                ],
                'maybe_later'      => [
                    'label'      => __( 'Maybe Later', 'betterdocs' ),
                    'icon_class' => 'dashicons dashicons-calendar-alt',
                    'attributes' => [
                        'data-later' => true,
                        'class'      => 'dismiss-btn'
                    ]
                ],
                'support'          => [
                    'link'       => 'https://wpdeveloper.com/support',
                    'attributes' => [
                        'target' => '_blank'
                    ],
                    'label'      => __( 'I need help', 'betterdocs' ),
                    'icon_class' => 'dashicons dashicons-sos'
                ],
                'never_show_again' => [
                    'label'      => __( 'Never show again', 'betterdocs' ),
                    'icon_class' => 'dashicons dashicons-dismiss',
                    'attributes' => [
                        'data-dismiss' => true
                    ]
                ]
            ]
        ];

        $notices->add( 'review', $_review_notice, [
            'start'       => $notices->strtotime( '+10 days' ),
            'recurrence'  => 30,
            'dismissible' => true
            // 'screens'     => [
            //     'dashboard', 'plugins', 'themes', 'edit-page',
            //     'edit-post', 'users', 'tools', 'options-general',
            //     'nav-menus', 'toplevel_page_betterdocs-admin', 'betterdocs_page_betterdocs-settings', 'betterdocs_page_betterdocs-analytics', 'betterdocs_page_betterdocs-faq', 'edit-doc_tag', 'edit-doc_category'
            // ]
        ] );

        /**
         * Opt-In Notice
         */
        if ( $this->insights != null ) {
            $notices->add( 'opt_in', [ $this->insights, 'notice' ], [
                'classes'     => 'updated put-dismiss-notice',
                'start'       => $notices->strtotime( '+20 days' ),
                'dismissible' => true,
                'do_action'   => 'wpdeveloper_notice_clicked_for_betterdocs',
                'display_if'  => ! function_exists( 'betterdocs_pro' )
            ] );
        }

        $b_message            = '<p style="margin-top: 0; margin-bottom: 10px;">Black Friday Sale: Enjoy 40% off & unlock <strong>premium features to streamline customer support</strong> & knowledge base 🎁</p><a class="button button-primary" href="https://wpdeveloper.com/upgrade/betterdocs-bfcm" target="_blank">Upgrade to pro</a> <button data-dismiss="true" class="dismiss-btn button button-link">I don’t want to save money</button>';
        $_black_friday_notice = [
            'thumbnail' => $this->assets->icon( 'betterdocs-logo.svg', true ),
            'html'      => $b_message,
        ];

        $notices->add( 'black_friday_notice', $_black_friday_notice, [
            'start'       => $notices->time(),
            'recurrence'  => false,
            'dismissible' => true,
            'refresh'     => BETTERDOCS_VERSION,
            "expire"      => strtotime( '11:59:59pm 2nd December, 2023' ),
            'display_if'  => ! is_plugin_active( 'betterdocs-pro/betterdocs-pro.php' )
        ] );

        self::$cache_bank->create_account( $notices );
        self::$cache_bank->calculate_deposits( $notices );
    }

    public function body_classes( $classes ) {
        $saved_settings = get_option( 'betterdocs_settings', false );
        $dark_mode      = isset( $saved_settings['dark_mode'] ) ? $saved_settings['dark_mode'] : false;
        $dark_mode      = ! empty( $dark_mode ) ? boolval( $dark_mode ) : false;

        if ( $dark_mode === true ) {
            $classes .= ' betterdocs-dark-mode ';
        }

        return $classes;
    }

    /**
     * Remove Comments Column From List Table
     *
     * @param array $columns
     *
     * @return array
     * @since 1.0.0
     */
    public function set_custom_edit_action_columns( $columns ) {
        unset( $columns['comments'] );
        $new_columns = [];
        foreach ( $columns as $key => $value ) {
            if ( $key == 'date' ) {
                $new_columns['betterdocs_word_count'] = __( 'Word Count', 'betterdocs' ); // put the tags column before it
            }
            $new_columns[ $key ] = $value;
        }

        return $new_columns;
    }

    public function manage_custom_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'betterdocs_word_count':
                $word_count = str_word_count( trim( strip_tags( get_post_field( 'post_content', $post_id ) ) ) );
                echo '<span>' . $word_count . '</span>';
                break;
        }
    }

    /**
     * Enqueue Assets for Admin ( Styles )
     *
     * @param string $hook
     *
     * @return void
     * @since 1.0.0
     */
    public function styles( $hook ) {
        $this->assets->enqueue( 'betterdocs-global', 'admin/css/global.css', [], 'all' );

        if ( ! in_array( $hook, [
            'toplevel_page_betterdocs-admin',
            'betterdocs_page_betterdocs-settings',
            'betterdocs_page_betterdocs-analytics'
        ] ) ) {
            return;
        }

        $this->assets->enqueue( 'betterdocs-select2', 'vendor/css/select2.min.css', [], 'all' );
        $this->assets->enqueue( 'betterdocs-daterangepicker', 'vendor/css/daterangepicker.css', [], 'all' );
        $this->assets->enqueue( 'betterdocs', 'admin/css/betterdocs.css', [], 'all' );
    }

    /**
     * Enqueue Assets for Admin ( Scripts )
     *
     * @param string $hook
     *
     * @return void
     * @since 1.0.0
     */
    public function scripts( $hook ) {
        $this->assets->register( 'betterdocs-admin', 'admin/js/betterdocs.js', [ 'jquery', 'jquery-ui-sortable' ] );

        $saved_settings = get_option( 'betterdocs_settings', false );
        $dark_mode      = isset( $saved_settings['dark_mode'] ) ? $saved_settings['dark_mode'] : false;
        $dark_mode      = ! empty( $dark_mode ) ? boolval( $dark_mode ) : false;
        $this->assets->localize( 'betterdocs-admin', 'betterdocs_admin', [
            'ajaxurl'                    => admin_url( 'admin-ajax.php' ),
            'doc_cat_order_nonce'        => wp_create_nonce( 'doc_cat_order_nonce' ),
            'knowledge_base_order_nonce' => wp_create_nonce( 'knowledge_base_order_nonce' ),
            'paged'                      => isset( $_GET['paged'] ) ? absint( wp_unslash( $_GET['paged'] ) ) : 0,
            'per_page_id'                => "edit_doc_category_per_page",
            'menu_title'                 => __( 'Switch to BetterDocs UI', 'betterdocs' ),
            'dark_mode'                  => ! empty( $dark_mode ) ? boolval( $dark_mode ) : false,
            'text'                       => __( 'Copied!', 'betterdocs' ),
            'test_report'                => __( 'Test Report!', 'betterdocs' ),
            'sending'                    => __( 'Sending...', 'betterdocs' )
        ] );

        if ( ( $hook === 'edit.php' || $hook === 'toplevel_page_betterdocs-admin' ) && get_post_type() == 'docs' ) {
            $this->assets->enqueue( 'betterdocs-switcher', 'admin/js/switcher.js', [
                'jquery'
            ] );

            $this->assets->localize( 'betterdocs-switcher', 'betterdocsSwitcher', [
                'menu_title'            => __( 'Switch to BetterDocs UI', 'betterdocs' ),
                'site_address'          => get_bloginfo( 'url' ),
                'betterdocs_pro_plugin' => betterdocs()->is_pro_active()
            ] );
        }

        if ( ! in_array( $hook, [ 'toplevel_page_betterdocs-admin', 'betterdocs_page_betterdocs-analytics' ] ) ) {
            return;
        }

        wp_enqueue_script( 'wp-color-picker' );

        $this->assets->enqueue( 'betterdocs-select2', 'vendor/js/select2.min.js', [] );
        $this->assets->enqueue( 'betterdocs-sweetalert', 'vendor/js/sweetalert.min.js', [] );
        $this->assets->enqueue( 'moment', 'vendor/js/moment.min.js', [] );
        $this->assets->enqueue( 'betterdocs-daterangepicker', 'vendor/js/daterangepicker.min.js', [] );
        wp_enqueue_script( 'betterdocs-admin' );
    }

    /**
     * All admin pages header
     *
     * @return void
     * @since 1.0.0
     */
    public function header( $admin_tab_name ) {
        $quick_links = [
            'switch_view' => sprintf( '<a href="%s" class="betterdocs-button betterdocs-button-secondary">%s</a>', add_query_arg( [
                'post_type'  => 'docs',
                'bdocs_view' => 'classic'
            ], 'edit.php' ), __( 'Switch to Classic UI', 'betterdocs' ) ),
            'add_new_doc' => sprintf( '<a href="%s" class="betterdocs-button betterdocs-button-primary">%s</a>', add_query_arg( [ 'post_type' => 'docs' ], 'post-new.php' ), __( 'Add New Doc', 'betterdocs' ) )
        ];

        $quick_links = apply_filters( 'betterdocs_quick_links', $quick_links );

        betterdocs()->views->get( 'admin/header', [
            'quick_links' => $quick_links,
            'active_tab'  => $admin_tab_name
        ] );
    }

    /**
     * Register all the menus for BetterDocs
     *
     * @return void
     * @since 1.0.0
     */
    // public function menus() {
    //     add_menu_page(
    //         'BetterDocs',
    //         'BetterDocs',
    //         'edit_posts',
    //         $this->slug,
    //         [$this, 'output'],
    //         betterdocs()->assets->icon( 'betterdocs-icon-white.svg', true ),
    //         5 // Position on the menu (use a unique number)
    //     );
    // }

    public function menus() {
        $default_args = [
            'page_title' => 'BetterDocs',
            'menu_title' => 'BetterDocs',
            'capability' => 'edit_posts',
            'menu_slug'  => $this->slug,
            'callback'   => [ $this, 'output' ],
            'icon_url'   => betterdocs()->assets->icon( 'betterdocs-icon-white.svg', true ),
            'position'   => 5
        ];

        $_menu_position = 5;

        foreach ( $this->menu_list() as $key => $value ) {
            if ( $key === 'betterdocs' ) {
                $callable = 'add_menu_page';
                $value    = wp_parse_args( $value, $default_args );
            } else {
                $callable                 = 'add_submenu_page';
                $default_args['callback'] = '';
                $default_args['position'] = $_menu_position;
                unset( $default_args['icon_url'] );
                $value = wp_parse_args( $value, array_merge( [ 'parent_slug' => $this->slug ], $default_args ) );
            }

            $_menu_position++;

            call_user_func_array( $callable, $value );
        }
    }

    /**
     * BetterDocs Admin Page Output
     *
     * @return void
     * @since 1.0.0
     */
    public function output() {
        betterdocs()->views->get( 'admin/main', [
            'admin_ui' => 'dnd'
        ] );
    }

    /**
     * Menu creator helper
     *
     * @param string $title
     * @param string $slug
     * @param string $cap
     * @param array  $callback
     *
     * @return array
     * @since 2.5.0
     *
     */
    private function normalize_menu( $title, $slug, $cap = 'edit_docs', $callback = null ) {
        return Helper::normalize_menu( $title, $slug, $cap, $callback );
    }

    /**
     * BetterDocs Menu List
     *
     * @return array
     * @since 1.0.0
     */
    private function menu_list() {
        $betterdocs_admin_pages = [
            'betterdocs' => [
                'menu_slug'  => $this->slug,
                'page_title' => 'BetterDocs',
                'menu_title' => 'BetterDocs',
                'capability' => 'edit_docs',
                'callback'   => [ $this, 'output' ],
                'icon_url'   => betterdocs()->assets->icon( 'betterdocs-icon-white.svg', true ),
                'position'   => 5
            ],
            'all_docs'    => $this->normalize_menu( __( 'All Docs', 'betterdocs' ), $this->ui_slug() ),
            'add_new'     => $this->normalize_menu( __( 'Add New', 'betterdocs' ), 'post-new.php?post_type=docs' ),
            'categories'  => $this->normalize_menu(
                __( 'Categories', 'betterdocs' ),
                'edit-tags.php?taxonomy=doc_category&post_type=docs',
                'manage_doc_terms'
            ),
            'tags'        => $this->normalize_menu(
                __( 'Tags', 'betterdocs' ),
                'edit-tags.php?taxonomy=doc_tag&post_type=docs',
                'manage_doc_terms'
            ),
            'settings'    => $this->normalize_menu(
                __( 'Settings', 'betterdocs' ),
                'betterdocs-settings',
                'edit_docs_settings',
                [$this->container->get( Settings::class ), 'views']
            ),
            'analytics'   => $this->normalize_menu(
                __( 'Analytics', 'betterdocs' ),
                'betterdocs-analytics',
                'read_docs_analytics',
                [$this->container->get( Analytics::class ), 'views']
            ),
            'faq'         => $this->normalize_menu(
                __( 'FAQ Builder', 'betterdocs' ),
                'betterdocs-faq',
                'read_docs_analytics',
                [$this->faq_builder, 'output']
            )
        ];

        return apply_filters( 'betterdocs_admin_menu', $betterdocs_admin_pages );
    }

    public function quick_setup_menu( $menus ) {
        $betterdocs_settings = get_option( 'betterdocs_settings' );
        if ( $betterdocs_settings ) {
            return $menus;
        } else {
            $menus['quick_setup'] = $this->normalize_menu( __( 'Quick Setup', 'betterdocs' ), 'betterdocs-setup', 'delete_users', [
                $this->container->get( SetupWizard::class ),
                'views'
            ] );
        }

        return $menus;
    }

    public function insert_plugin_links( $links ) {
        $links[] = '<a href="admin.php?page=betterdocs-settings">' . __( 'Settings', 'betterdocs' ) . '</a>';

        return $links;
    }

    public function toolbar_menu( $admin_bar ) {
        if ( ! is_admin() || ! is_admin_bar_showing() ) {
            return;
        }

        // Show only when the user is a member of this site, or they're a super admin.
        if ( ! is_user_member_of_blog() && ! is_super_admin() ) {
            return;
        }

        $docs_url = '';

        if ( $this->settings->get( 'builtin_doc_page' ) ) {
            $docs_url = get_post_type_archive_link( 'docs' );
        } elseif ( intval( $docs_page = $this->settings->get( 'docs_page' ) ) ) {
            $docs_url = ! empty( $docs_page ) ? get_page_link( $docs_page ) : false;
        }

        if ( ! $docs_url ) {
            return;
        }

        $admin_bar->add_node( [
            'parent' => 'site-name',
            'id'     => 'view-docs',
            'title'  => __( 'Visit Documentation', 'betterdocs' ),
            'href'   => $docs_url
        ] );
    }
    /**
     * Save last visited admin ui
     *
     * @since 3.0.1
     *
     */
    public function save_admin_page() {
        if (isset($_GET['post_type']) && $_GET['post_type'] === 'docs' && isset($_GET['bdocs_view']) && $_GET['bdocs_view'] === 'classic') {
            update_user_meta( get_current_user_id(), 'last_visited_docs_admin_page', 'classic_ui' );
        } elseif (isset($_GET['page']) && $_GET['page'] === 'betterdocs-admin') {
            update_user_meta( get_current_user_id(), 'last_visited_docs_admin_page', 'modern_ui' );
        }
    }

    /**
     * Return last visited admin ui slug
     *
     * @since 3.0.1
     * @return string
     */
    public function ui_slug() {
        $last_visited = get_user_meta( get_current_user_id(), 'last_visited_docs_admin_page', true);
        if ($last_visited === 'classic_ui') {
            $slug = admin_url('edit.php?post_type=docs&bdocs_view=classic');
        } else {
            $slug = 'betterdocs-admin';
        }

        return $slug;
    }

    /**
     * Resets a duplicate submenu in WordPress if the parent main menu and the first submenu permalink are not the same.
     *
     * @since 3.0.1
     * @return string
     */
    public function reset_submenu() {
        global $submenu;
        $last_visited = get_user_meta( get_current_user_id(), 'last_visited_docs_admin_page', true);

        if ( $last_visited === 'classic_ui' && in_array( "betterdocs-admin", $submenu['betterdocs-admin'][0] ) ) {
            unset($submenu['betterdocs-admin'][0]);
            $submenu['betterdocs-admin'] = array_values($submenu['betterdocs-admin']);
        }
    }
}
