<?php

namespace WPDeveloper\BetterDocs\Admin\Customizer;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use WPDeveloper\BetterDocs\Utils\Base;
use WPDeveloper\BetterDocs\Admin\Customizer\Sections\Sidebar;
use WPDeveloper\BetterDocs\Admin\Customizer\Sections\DocsPage;
use WPDeveloper\BetterDocs\Admin\Customizer\Sections\SingleDoc;
use WPDeveloper\BetterDocs\Admin\Customizer\Sections\BreadCrumb;
use WPDeveloper\BetterDocs\Admin\Customizer\Sections\FaqBuilder;
use WPDeveloper\BetterDocs\Admin\Customizer\Sections\LiveSearch;
use WPDeveloper\BetterDocs\Admin\Customizer\Sections\ArchivePage;

class Customizer extends Base {
    /**
     * Defaults
     *
     * @var Defaults
     */
    public $defaults;

    /**
     * Enqueue
     *
     * @var \WPDeveloper\BetterDocs\Utils\Enqueue
     */
    private $assets;

    public function __construct( Defaults $defaults ) {
        $this->defaults = $defaults;

        add_action( 'customize_register', [$this, 'register'] );

        add_action( 'customize_controls_enqueue_scripts', [$this, 'enqueue'] );
        add_action( 'customize_preview_init', [$this, 'customize_preview_init'] );

        add_action( 'customize_controls_print_styles', [$this, 'controls_print_styles'], 999 );
        add_action( 'wp_head', [$this, 'dynamic_css'] );
    }

    /**
     * Register all customizer options here.
     * Devided into classes for better readability.
     *
     * This methods refers to old customizer.php in admin/customizer
     * @param mixed $wp_customize
     * @return void
     */
    public function register( $wp_customize ) {
        $this->assets = betterdocs()->assets;
        $defaults     = $this->defaults->defaults();

        // Create custom panels
        $wp_customize->add_panel( 'betterdocs_customize_options', [
            'priority'       => 30,
            'theme_supports' => '',
            'title'          => __( 'BetterDocs', 'betterdocs' ),
            'description'    => __( 'Controls the design settings for the theme.', 'betterdocs' )
        ] );

        $_settings_sections = apply_filters( 'betterdocs_customizer_settings', [
            DocsPage::class,
            SingleDoc::class,
            Sidebar::class,
            ArchivePage::class,
            LiveSearch::class,
            FaqBuilder::class,
            BreadCrumb::class
        ] );

        /**
         * Register All Settings
         */
        foreach ( $_settings_sections as $settings ) {
            betterdocs()->container->get( $settings )->register( $wp_customize, $defaults );
        }
    }

    /**
     * Enqueueing styles and scripts for controls and conditions.
     *
     * old functions :
     * * betterdocs_customizer_styles
     * * betterdocs_customizer_condition
     *
     * @return void
     */
    public function enqueue() {
        betterdocs()->assets->enqueue( 'betterdocs-cutomizer-styles', 'customizer/css/customizer-controls.css' );
        betterdocs()->assets->enqueue( 'betterdocs-customize-condition', 'customizer/js/customizer-condition.js' );
    }

    public function customize_preview_init() {
        betterdocs()->assets->enqueue( 'betterdocs-customizer', 'customizer/js/customizer.js', ['customize-preview'] );
    }

    public function controls_print_styles() {
        ob_start();
        include_once __DIR__ . '/controls.css.php';
        echo ob_get_clean();
    }

    /**
     * Generates dynamic css from customizer options.
     * @return void
     */
    public function dynamic_css() {
        if ( ! betterdocs()->helper->is_templates() ) {
            return false;
        }
        /**
         * Don't remove this line, it's used in dynamic.css.php file.
         */
        $mods = $this->defaults->theme_mods();
        require __DIR__ . '/dynamic.css.php';

        ob_start();
        // echo '<-- betterdocs customizer css -->';
        echo '<style type="text/css">';
        echo $css->get_output( true );
        echo '</style>';
        // echo '<-- betterdocs customizer css end -->';
        echo ob_get_clean();
    }
}
