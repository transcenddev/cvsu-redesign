<?php

namespace WPDeveloper\BetterDocs\Core;
use WPDeveloper\BetterDocs\Utils\Base;

class Scripts extends Base {
    protected $settings;

    public function __construct( Settings $settings ) {
        $this->settings = $settings;

        add_action( 'init', [$this, 'init'], 1 );
    }

    public function init(){
        $assets = betterdocs()->assets;

        // Vendor CSS
        $assets->register( 'simplebar', 'vendor/css/simplebar.css' );

        // Vendor JS
        $assets->register( 'simplebar', 'vendor/js/simplebar.js' );
        $assets->register( 'clipboard', 'vendor/js/clipboard.min.js' );


        // Shortcodes Styles Registrations
        $assets->register( 'betterdocs-search', 'public/css/search.css' );
        $assets->register( 'betterdocs-social-share', 'public/css/social-share.css' );
        $assets->register( 'betterdocs-feedback-form', 'public/css/feedback-form.css' );
        $assets->register( 'betterdocs-reactions', 'public/css/reactions.css' );
        $assets->register( 'betterdocs-toc', 'public/css/toc.css' );
        $assets->register( 'betterdocs-faq', 'public/css/faq.css' );
        $assets->register( 'betterdocs-category-tab-grid', 'public/css/category-tab-grid.css' );

        // Template Parts
        $assets->register( 'betterdocs-sidebar', 'public/css/sidebar.css' );
        $assets->register( 'betterdocs-breadcrumb', 'public/css/breadcrumb.css' );
        $assets->register( 'betterdocs-single', 'public/css/single.css' );
        $assets->register( 'betterdocs-docs', 'public/css/docs.css' );
        $assets->register( 'betterdocs-doc_category', 'public/css/tax-doc_category.css', [ 'betterdocs-breadcrumb' ] );


        $assets->register( 'betterdocs-category-grid', 'public/css/category-grid.css', [ 'simplebar' ] );
        $assets->register( 'betterdocs-category-box', 'public/css/category-box.css' );
        $assets->register( 'betterdocs-category-grid-list', 'public/css/category-grid-list.css' );

        // JS
        $assets->register( 'betterdocs', 'public/js/betterdocs.js', [ 'jquery' ] );
        // Shortcode JS
        $assets->register( 'betterdocs-category-toggler', 'public/js/category-toggler.js', [ 'jquery' ] );
        $assets->register( 'betterdocs-category-grid', 'public/js/category-grid.js', [
            'jquery', 'masonry', 'simplebar', 'betterdocs-category-toggler'
        ] );
        $assets->register( 'betterdocs-faq', 'shortcodes/js/faq.js', [ 'jquery' ] );
        $assets->register( 'betterdocs-reactions', 'shortcodes/js/reactions.js', [ 'jquery' ] );
        $assets->register( 'betterdocs-search', 'shortcodes/js/search.js', [ 'jquery' ] );

        $assets->localize( 'betterdocs', 'betterdocsConfig', [
            'ajax_url'            => admin_url( 'admin-ajax.php' ),
            'copy_text'           => __( 'Copied', 'betterdocs' ),
            'sticky_toc_offset'   => $this->settings->get( 'sticky_toc_offset' ),
        ] );

        $assets->localize( 'betterdocs-search', 'betterdocsSearchConfig', [
            'ajax_url'            => admin_url( 'admin-ajax.php' ),
            'search_letter_limit' => $this->settings->get( 'search_letter_limit' )
        ] );


        $this->blocks( $assets );

        return $assets;
    }


    public function blocks( $assets ){
        $assets->register( 'betterdocs-fontawesome', 'vendor/css/font-awesome5.css' );
        $assets->register( 'betterdocs-blocks-category-box', 'blocks/categorybox/default.css' );
        $assets->register( 'betterdocs-blocks-category-grid', 'blocks/categorygrid/default.css' );
        $assets->register( 'betterdocs-feedback-form-editor', 'blocks/feedback-form/style-feedback-editor.css' );
        $assets->register( 'betterdocs-doc-archive-list', 'blocks/doc-archive-list/default.css' );
    }
}
