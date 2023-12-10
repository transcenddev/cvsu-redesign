<?php

namespace WPDeveloper\BetterDocs\Admin;
use WPDeveloper\BetterDocs\Utils\Base;
use WPDeveloper\BetterDocs\Utils\Database;

class Analytics extends Base {
    /**
     * Database class
     * @var Database
     */
    protected $database;

    public function __construct( Database $database ) {
        $this->database = $database;

        add_action( 'admin_enqueue_scripts', [$this, 'enqueue'] );

        if ( isset( $_GET['page'] ) && $_GET['page'] === 'betterdocs-analytics' ) {
            add_action( 'betterdocs_settings_header', [$this, 'header'] );
        }
    }

    public function enqueue( $hook ) {
        if ( $hook !== 'betterdocs_page_betterdocs-analytics' ) {
            return;
        }

        betterdocs()->assets->enqueue( 'betterdocs-analytics', 'admin/css/analytics.css' );
    }

    public function header() {
        betterdocs()->views->get( 'admin/template-parts/settings-header', [
            'title' => __( 'BetterDocs Analytics', 'betterdocs' )
        ] );
    }

    public function views() {
        betterdocs()->views->get( 'admin/analytics' );
    }
}
