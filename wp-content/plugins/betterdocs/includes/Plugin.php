<?php

namespace WPDeveloper\BetterDocs;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use WPDeveloper\BetterDocs\Core\Admin;
use WPDeveloper\BetterDocs\Core\Query;
use WPDeveloper\BetterDocs\Core\Roles;
use WPDeveloper\BetterDocs\Dependencies\DI\Container;
use WPDeveloper\BetterDocs\Utils\Views;
use WPDeveloper\BetterDocs\Core\BaseAPI;
use WPDeveloper\BetterDocs\Core\Install;
use WPDeveloper\BetterDocs\Core\Request;
use WPDeveloper\BetterDocs\Core\Rewrite;
use WPDeveloper\BetterDocs\Core\Scripts;
use WPDeveloper\BetterDocs\Utils\Helper;
use WPDeveloper\BetterDocs\Core\Settings;
use WPDeveloper\BetterDocs\Core\KBMigration;
use WPDeveloper\BetterDocs\Utils\Enqueue;
use WPDeveloper\BetterDocs\Editors\Editor;
use WPDeveloper\BetterDocs\Utils\Database;
use WPDeveloper\BetterDocs\Admin\Analytics;
use WPDeveloper\BetterDocs\Admin\ReportEmail;
use WPDeveloper\BetterDocs\FrontEnd\FrontEnd;
use WPDeveloper\BetterDocs\Core\ShortcodeFactory;
use WPDeveloper\BetterDocs\FrontEnd\TemplateTags;
use WPDeveloper\BetterDocs\Admin\Customizer\Customizer;
use WPDeveloper\BetterDocs\Dependencies\DI\ContainerBuilder;

final class Plugin {
    private static $_instance = null;
    /**
     * Assets manager
     *
     * @var Enqueue
     */
    public $assets;
    /**
     * View manager
     *
     * @var Views
     */
    public $views;
    /**
     * Container Manager
     *
     * @var Container
     */
    public $container;
    /**
     * Editor Manager
     * @var Editor
     */
    public $editor;
    /**
     * Helper class
     * @var Helper
     */
    public $helper;
    /**
     * KBMigration class
     * @var KBMigration
     */
    public $kbmigration;
    /**
     * KBMigration class
     * @var Admin
     */
    public $admin;
    /**
     * Helper class
     * @var Database
     */
    public $database;
    /**
     * Helper class
     * @var Settings
     */
    public $settings;
    /**
     * Helper class
     * @var TemplateTags
     */
    public $template_helper;
    /**
     * Customizer class
     * @var Customizer
     */
    public $customizer;
    /**
     * Query class
     * @var Query
     */
    public $query;
    /**
     * Rewrite Class
     * @var Rewrite
     */
    public $rewrite;
    /**
     * Request Class
     * @var Request
     */
    public $request;
    /**
     * Analytics Class
     * @var Analytics
     */
    public $analytics;
    /**
     * Plugin Version
     * @var string
     */
    public $version = '3.0.2';

    /**
     * Plugin DB Version
     * @var string
     */
    public $db_version = '1.0.1';

    public function __construct() {
        $this->define_constants();

        do_action( 'betterdocs_init_before' );
        $this->setup_container();
        /**
         * Register activation and deactivation hooks
         * and version updates check
         */
        $this->container->get( Install::class );

        $this->initialize();

        add_action( 'init', [ $this, 'init' ], 0 );

        /**
         * For admin only
         */
        add_action( 'admin_init', [ $this, 'admin_init' ], 0 );

        /**
         * For AJAX only
         */
        $this->ajax();
    }

    private function define_constants() {
        $this->define( 'BETTERDOCS_VERSION', $this->version );
        $this->define( 'BETTERDOCS_DB_VERSION', $this->db_version );
        $this->define( 'BETTERDOCS_ABSPATH', dirname( BETTERDOCS_PLUGIN_FILE ) . '/' );
        $this->define( 'BETTERDOCS_ABSURL', plugin_dir_url( BETTERDOCS_PLUGIN_FILE ) );
        $this->define( 'BETTERDOCS_PLUGIN_BASENAME', plugin_basename( BETTERDOCS_PLUGIN_FILE ) );
        $this->define( 'BETTERDOCS_BLOCKS_DIRECTORY', BETTERDOCS_ABSPATH . 'assets/blocks/' );
        $this->define( 'BETTERDOCS_ROOT_DIR_PATH', plugin_dir_path( BETTERDOCS_PLUGIN_FILE ) );
        $this->define( 'BETTERDOCS_FSE_TEMPLATES_PATH', BETTERDOCS_ROOT_DIR_PATH . 'views/templates/fse' );

        /**
         * Third Party Constants
         * @since 2.5.0
         *
         * WPML compatibility with Polylang
         */
        if ( Helper::is_plugin_active( 'polylang/polylang.php' ) ) {
            define( 'PLL_WPML_COMPAT', false );
        }
    }

    /**
     * Define constant if not already set.
     *
     * @param string $name Constant name.
     * @param string|bool $value Constant value.
     */
    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    public function setup_container() {
        $config_array = require_once BETTERDOCS_ABSPATH . 'includes/config.php';
        $config       = apply_filters( 'betterdocs_container_config', $config_array );
        $builder      = new ContainerBuilder();

        $builder->addDefinitions( $config );
        $this->container = $builder->build();
    }

    public function initialize() {
        $this->container->get( Scripts::class );
        $this->rewrite = $this->container->get( Rewrite::class );
        $this->request = $this->container->get( Request::class );
        $this->query   = $this->container->get( Query::class );

        $this->rewrite->init();
        $this->request->init();

        $this->assets    = $this->container->get( Enqueue::class );
        $this->views     = $this->container->get( Views::class );
        $this->helper    = $this->container->get( Helper::class );
        $this->kbmigration    = $this->container->get( KBMigration::class );
        $this->admin    = $this->container->get( Admin::class );
        $this->database  = $this->container->get( Database::class );
        $this->settings  = $this->container->get( Settings::class );
        $this->analytics = $this->container->get( Analytics::class );

        $this->template_helper = $this->container->get( TemplateTags::class );
        $this->customizer      = $this->container->get( Customizer::class );
        $this->editor          = $this->container->get( Editor::class );

        /**
         * Initialize all editors.
         * Elementor, Gutenberg/BlockEditor
         */
        add_action( 'init', [ $this->editor, 'init' ] );

        /**
         * Initialize API
         */
        add_action( 'rest_api_init', [ $this, 'api_initialization' ] );
    }

    /**
     * Initialize the BetterDocs Plugin
     *
     * @return void
     * @since 2.5.0
     */
    public function init() {
        /**
         * Setup localization.
         */
        $this->load_plugin_textdomain();

        $this->container->get( Admin::class );
        $this->container->get( Roles::class );
        $this->container->get( ReportEmail::class );

        /**
         * Initialize Shortcode
         * Make sure you have listed out all shortcode in shortcode factory.
         */
        $this->container->get( ShortcodeFactory::class )->init();

        $this->container->get( FrontEnd::class );

        do_action( 'betterdocs_init' );
    }

    /**
     * Load plugins textdomain `betterdocs` into actions.
     * @return void
     */
    public function load_plugin_textdomain( $textdomain = 'betterdocs', $plugin_file = BETTERDOCS_PLUGIN_FILE ) {
        $locale = determine_locale();

        /**
         * Filter to adjust the BetterDocs locale to use for translations.
         */
        $locale = apply_filters( 'plugin_locale', $locale, $textdomain );

        unload_textdomain( $textdomain );
        load_textdomain( $textdomain, WP_LANG_DIR . "/$textdomain-" . $locale . '.mo' );
        load_plugin_textdomain( $textdomain, false, plugin_basename( dirname( $plugin_file ) ) . '/languages' );
    }

    /**
     * For AJAX Only
     * @return void
     */
    public function ajax() {
    }

    /**
     * Create a plugin instance.
     *
     * @param mixed ...$args
     *
     * @return static
     *
     * @suppress PHP0441
     * @since 2.5.0
     */
    public static function get_instance() {
        if ( static::$_instance == null ) {
            static::$_instance = new self();

            do_action( 'betterdocs_loaded' );
        }

        return static::$_instance;
    }

    /**
     * Hooked with `admin_init` action.
     * @return void
     */
    public function admin_init() {
        /**
         * Maybe Redirect
         * for setup related settings.
         */
        $this->maybe_redirect();
    }

    /**
     * Summary of maybe_redirect
     * @return void
     */
    public function maybe_redirect() {
        // Bail if no activation transient is set.
        if ( ! $this->database->get_transient( 'betterdocs_maybe_redirect' ) ) {
            return;
        }

        // Delete the activation transient.
        $this->database->delete_transient( 'betterdocs_maybe_redirect' );

        if ( ! is_multisite() ) {
            $betterdocs_settings = get_option('betterdocs_settings');
            if ( $betterdocs_settings) {
                wp_safe_redirect( add_query_arg( [ 'page' => 'betterdocs-settings' ], admin_url( 'admin.php' ) ) );
            } else {
                wp_safe_redirect( add_query_arg( [ 'page' => 'betterdocs-setup' ], admin_url( 'admin.php' ) ) );
            }
        }
    }

    /**
     * Is Pro Plugin Is Installed?
     * @return bool
     */
    public function is_pro_installed() {
        return $this->helper->get_plugins( 'betterdocs-pro/betterdocs-pro.php' );
    }

    /**
     * Is Pro Plugin Is Active?
     * @return bool
     */
    public function is_pro_active() {
        return $this->helper->is_plugin_active( 'betterdocs-pro/betterdocs-pro.php' );
    }

    /**
     * Get all the API initialized.
     * @return void
     */
    public function api_initialization() {
        $_api_classes = scandir( __DIR__ . DIRECTORY_SEPARATOR . 'REST' );

        if ( ! empty( $_api_classes ) && is_array( $_api_classes ) ) {
            foreach ( $_api_classes as $class ) {
                if ( $class == '.' || $class == '..' ) {
                    continue;
                }

                $classname  = basename( $class, '.php' );
                $classname  = '\\' . __NAMESPACE__ . "\\REST\\$classname";
                $_api_class = $this->container->get( $classname );

                if ( $_api_class instanceof BaseAPI ) {
                    $_api_class->register();
                }
            }
        }
    }
}
