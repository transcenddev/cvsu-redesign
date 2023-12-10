<?php

namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks;

use WPDeveloper\BetterDocs\Editors\BlockEditor\Block;

class Sidebar extends Block {

    protected $editor_styles = [
        'betterdocs-sidebar'
    ];

    protected $frontend_styles = [
        'betterdocs-sidebar'
    ];

    public function get_name() {
        return 'sidebar';
    }

    public function get_default_attributes() {
        return [
            'blockId'                 => '',
            'sidebar_layout'          => 'layout-1',
            'includeCategories'       => '',
            'excludeCategories'       => '',
            'terms_per_page'          => -1,
            'terms_order'             => 'asc',
            'terms_orderby'           => 'doc_category_order',
            'docs_per_page'           => -1,
            'docs_orderby'            => 'title',
            'docs_order'              => 'asc',
            'enableNestedSubcategory' => false,
            'docs_per_subcategory'    => 10,
            'titleTag'                => 'h1'
        ];
    }

    public function render( $attributes, $content ) {
        $layout = isset( $this->attributes['sidebar_layout'] ) ? $this->attributes['sidebar_layout'] : 'layout-1';
        $layout = str_replace( 'layout-', '', $layout );

        $sidebar_layout = $layout;

        if ( ! betterdocs()->is_pro_active() && ( $sidebar_layout == 2 || $sidebar_layout == 3 ) ) {
            $sidebar_layout = 1;
        }

        add_filter( 'betterdocs_base_terms_args', [$this, 'filter_base_args'], 10, 1 );
        $this->views( 'templates/sidebars/sidebar-' . $sidebar_layout );
        remove_filter( 'betterdocs_base_terms_args', [$this, 'filter_base_args'], 10 );
    }

    public function filter_base_args( $term_args ) {
        if ( $term_args['orderby'] == 'doc_category_order' ) {
            $term_args['meta_key'] = 'doc_category_order';
            $term_args['orderby']  = 'meta_value_num';
        }
        return $term_args;
    }

    public function view_params() {
        $settings = &$this->attributes;

        $default_multiple_kb = betterdocs()->settings->get( 'multiple_kb' );
        $kb_slug             = isset( $settings['selected_knowledge_base'] ) ? $settings['selected_knowledge_base'] : '';
        return [
            'shortcode_attr' => [
                'terms_order'              => $settings['terms_order'],
                'terms_orderby'            => $settings['terms_orderby'],
                'terms_include'            => array_diff( $this->string_to_array( $settings['includeCategories'] ), $this->string_to_array( $settings['excludeCategories'] ) ),
                'terms_exclude'            => isset( $settings['excludeCategories'] ) ? $this->string_to_array( $settings['excludeCategories'] ) : '',
                'nested_subcategory'       => $settings['enableNestedSubcategory'],
                'multiple_knowledge_base'  => $default_multiple_kb,
                'kb_slug'                  => $kb_slug,
                'sidebar_list'             => true,
                'disable_customizer_style' => true,
                'posts_per_page'           => -1,
                'title_tag'                => $settings['titleTag']
            ]
        ];
    }
}
