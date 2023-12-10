<?php

namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks;

use WPDeveloper\BetterDocs\Editors\BlockEditor\Block;

class ArchiveList extends Block {
    public function get_name() {
        return 'doc-archive-list';
    }

    protected $editor_styles = [
        'betterdocs-fontawesome',
        'betterdocs-blocks-editor',
        'betterdocs-doc-archive-list',
        'betterdocs-doc_category'
    ];

    protected $frontend_styles = [
        'betterdocs-fontawesome',
        'betterdocs-doc-archive-list',
        'betterdocs-doc_category'
    ];

    public function get_default_attributes() {
        return [
            'blockId'            => '',
            'nested_subcategory' => false,
            'order'              => 'asc',
            'orderby'            => 'title'
        ];
    }

    public function render( $attributes, $content ) {
        $this->views( 'widgets/block-archive-list' );
    }

    public function view_params() {
        global $wp_query;

        $_term_slug = '';
        if ( isset( $wp_query->query ) && array_key_exists( 'doc_category', $wp_query->query ) ) {
            $_term_slug = $wp_query->query['doc_category'];
        }

        $term = get_term_by( 'slug', $_term_slug, 'doc_category' );

        $_docs_query = [
            'term_id'        => isset( $term->term_id ) ? $term->term_id : 0,
            'orderby'        => $this->attributes['orderby'],
            'order'          => $this->attributes['order'],
            'postsOrderBy'   => $this->attributes['orderby'],
            'postsOrder'     => $this->attributes['order'],
            'kb_slug'        => '',
            'posts_per_page' => $term == false ? 5 : -1,
            'term_slug'      => isset( $term->slug ) ? $term->slug : ''
        ];

        return [
            'term'               => $term,
            'nested_subcategory' => (bool) $this->attributes['nested_subcategory'],
            'query_args'         => betterdocs()->query->docs_query_args( $_docs_query ),
            'title_tag'          => 'h2'
        ];
    }
}
