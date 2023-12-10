<?php

namespace WPDeveloper\BetterDocs\Editors;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use Exception;
use WPDeveloper\BetterDocs\Utils\Base;
use WPDeveloper\BetterDocs\Utils\Enqueue;
use WPDeveloper\BetterDocs\Dependencies\DI\Container;

class Editor extends Base {
    /**
     * Container
     * @var Container
     */
    private $container;

    /**
     * List of editors we support. i.e: Elementor, Block Editor (WordPress Default)
     * @var array
     */
    private $editors = [];

    /**
     * Assets Manager
     * @var Enqueue
     */
    private $assets = [];

    public function __construct( Container $container, $editors = [] ) {
        $this->container = $container;
        $this->editors   = $editors;
        $this->assets    = $this->container->get( Enqueue::class );

        // add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue'] );
        // add_action( 'wp_enqueue_scripts', [$this, 'public_enqueue'] );
    }

    public function admin_enqueue( $hook ) {
        $this->register_vendor_assets();
    }

    public function public_enqueue() {
        $this->register_vendor_assets();
    }

    public function register_vendor_assets() {
        $this->assets->register( 'betterdocs-fontawesome', 'vendor/css/font-awesome5.css' );
    }

    public function init() {
        if ( empty( $this->editors ) ) {
            return;
        }

        foreach ( $this->editors as $editor ) {
            $this->container->get( $editor )->init();
        }
    }

    public function admin_init() {
        if ( empty( $this->editors ) ) {
            return;
        }

        foreach ( $this->editors as $editor ) {
            $_editor = $this->container->get( $editor );
            if ( method_exists( $_editor, 'admin_init' ) ) {
                $_editor->admin_init();
            }
        }
    }

    public function get( $editor_id = 'elementor' ) {
        if ( empty( $this->editors[$editor_id] ) ) {
            throw new Exception( sprintf( __( 'Editor: %s not exists.', 'betterdocs' ), $editor_id ) );
        }

        return ( $this->container->get( $this->editors[$editor_id] ) );
    }

    public function get_post_count( $term_count, $term_id, $nested_subcategory = false ) {
        if ( $nested_subcategory == false ) {
            return $term_count;
        }

        $taxonomy = 'doc_category';
        $args = [ 'child_of' => $term_id ];

        $tax_terms = get_terms( $taxonomy, $args );

        if ( $tax_terms ) {
            $term_count = array_reduce( $tax_terms, function( $carry, $term ){
                return $carry + $term->count;
            }, $term_count );
        }

        return $term_count;
    }
}
