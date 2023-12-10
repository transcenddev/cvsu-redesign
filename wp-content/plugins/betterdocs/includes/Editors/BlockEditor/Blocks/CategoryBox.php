<?php

namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks;

use WPDeveloper\BetterDocs\Editors\BlockEditor\Block;
use WPDeveloper\BetterDocs\Traits\CategoryBox as CategoryBoxTraits;

class CategoryBox extends Block {
    use CategoryBoxTraits;

    protected $editor_styles = [
        'betterdocs-fontawesome',
        'betterdocs-blocks-editor',
        'betterdocs-blocks-category-box'
    ];

    protected $frontend_styles = [
        'betterdocs-fontawesome',
        'betterdocs-blocks-category-box'
    ];

    /**
     * unique name of block
     * @return string
     */
    public function get_name() {
        return 'categorybox';
    }

    public function get_default_attributes() {
        return [
            'blockId'           => '',
            'categories'        => [],
            'includeCategories' => '',
            'excludeCategories' => '',
            'boxPerPage'        => 9,
            'orderBy'           => 'name',
            'order'             => 'asc',
            'layout'            => 'default',
            'showIcon'          => true,
            'showTitle'         => true,
            'titleTag'          => 'h2',
            'showCount'         => true,
            'prefix'            => '',
            'suffix'            => __( 'articles', 'betterdocs' ),
            'suffixSingular'    => __( 'article', 'betterdocs' ),
            'colRange'          => 3,
            'TABcolRange'       => 2,
            'MOBcolRange'       => 1
        ];
    }

    public function view_params() {
        $attributes = &$this->attributes;

        $terms_object = [
            'taxonomy'   => 'doc_category',
            'order'      => $attributes['order'],
            'orderby'    => $attributes['orderBy'],
            'number'     => isset( $attributes['boxPerPage'] ) ? $attributes['boxPerPage'] : 5,
            'hide_empty' => true
        ];

        if ( 'doc_category_order' === $attributes['orderBy'] ) {
            $terms_object['meta_key'] = 'doc_category_order';
            $terms_object['orderby']  = 'meta_value_num';
        }

        $includes = $this->string_to_array( $attributes['includeCategories'] );
        $excludes = $this->string_to_array( $attributes['excludeCategories'] );

        if ( ! empty( $includes ) ) {
            $terms_object['include'] = array_diff( $includes, (array) $excludes );
        }

        if ( ! empty( $excludes ) ) {
            $terms_object['exclude'] = $excludes;
        }

        $_wrapper_classes = [
            'betterdocs-category-box-wrapper',
            'betterdocs-blocks-grid',
            'betterdocs-box-' . $attributes['layout']
        ];

        $_inner_wrapper_classes = [
            'betterdocs-category-box-inner-wrapper',
            'layout-flex',
            $attributes['layout'] === 'default' ? 'layout-1' : $attributes['layout'],
            "betterdocs-column-" . $attributes['colRange'],
            "betterdocs-column-tablet-" . $attributes['TABcolRange'],
            "betterdocs-column-mobile-" . $attributes['MOBcolRange']
        ];

        $wrapper_attr = [
            'class' => $_wrapper_classes
        ];
        $inner_wrapper_attr = [
            'class'               => $_inner_wrapper_classes,
            'data-column_desktop' => $attributes['colRange'],
            'data-column_tab'     => $attributes['TABcolRange'],
            'data-column_mobile'  => $attributes['MOBcolRange']
        ];

        $default_multiple_kb = betterdocs()->settings->get( 'multiple_kb' );
        if ( is_tax( 'knowledge_base' ) && $default_multiple_kb == 1 ) {
            $object = get_queried_object();
            $terms_object['meta_query'] = [
                'relation' => 'OR',
                [
                    'key'     => 'doc_category_knowledge_base',
                    'value'   => $object->slug,
                    'compare' => 'LIKE'
                ]
            ];
        }

        $_params = [
            'wrapper_attr'       => $wrapper_attr,
            'inner_wrapper_attr' => $inner_wrapper_attr,
            'terms_query_args'   => $terms_object,
            'widget_type'        => 'category-box',
            'multiple_knowledge_base' => $default_multiple_kb,
            'kb_slug'                 => '',
            'nested_subcategory' => false,
            'show_header'        => true
        ];

        if ( $attributes['layout'] === 'layout-2' ) {
            $_params['count_prefix']          = '';
            $_params['count_suffix']          = '';
            $_params['count_suffix_singular'] = '';
        }

        return $_params;
    }

    public function render( $attributes, $content ) {
        $_eligible = ( $attributes['layout'] == 'layout-2' || $attributes['layout'] == 'layout-3' );

        $this->add_filter( $_eligible );
        $this->views( 'layouts/base' );
        $this->remove_filter( $_eligible );
    }
}
