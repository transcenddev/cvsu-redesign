<?php

namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks;

use WPDeveloper\BetterDocs\Editors\BlockEditor\Block;

class SearchForm extends Block {
    public $view_wrapper = 'betterdocs-search-form-wrapper';

    protected $editor_styles = [
        'betterdocs-search'
    ];

    protected $frontend_styles = [
        'betterdocs-search'
    ];
    protected $frontend_scripts = [
        'betterdocs-search'
    ];

    /**
     * unique name of block
     * @return string
     */
    public function get_name() {
        return 'searchbox';
    }

    public function get_default_attributes() {
        return [
            'blockId'         => '',
            'placeholderText' => __( 'Search', 'betterdocs' )
        ];
    }

    public function render( $attributes, $content ) {
        $this->views( 'widgets/search-form' );
    }

    public function view_params() {
        $settings = &$this->attributes;

        $_shortcode_attributes = apply_filters( 'betterdocs_elementor_search_form_params', [
            'placeholder' => esc_html( $settings['placeholderText'] )
        ], $this->attributes );

        return [
            'shortcode_attr' => $_shortcode_attributes
        ];
    }
}
