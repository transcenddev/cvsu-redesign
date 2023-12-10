<?php
    $terms_object = [
        'taxonomy'   => 'doc_category',
        'orderby'    => 'meta_value_num',
        'meta_key'   => 'doc_category_order',
        'order'      => 'ASC',
        'hide_empty' => false
    ];

    $kb = '';
    if ( isset( $_GET['knowledgebase'] ) && $_GET['knowledgebase'] !== 'all' ) {
        $kb = $_GET['knowledgebase'];

        $terms_object['meta_query'] = [
            [
                'key'     => 'doc_category_knowledge_base',
                'value'   => $_GET['knowledgebase'],
                'compare' => 'LIKE'
            ]
        ];
    }

    $terms = get_terms( $terms_object );

    global $wpdb;

    $_post__not_in_query = $wpdb->prepare(
        "SELECT ID as post_id from $wpdb->posts WHERE post_type = %s AND post_status != 'trash' AND ID NOT IN ( SELECT object_id as post_id FROM $wpdb->term_relationships WHERE term_taxonomy_id IN ( SELECT term_taxonomy_id FROM $wpdb->term_taxonomy WHERE taxonomy = %s ) )",
        'docs',
        'doc_category'
    );

    $_post__not_in = $wpdb->get_col( $_post__not_in_query );
?>

<div class="betterdocs-tab-content" id="betterdocs-tab-2">
    <div class="betterdocs-listing-content">
        <?php
            if ( ! empty( $terms ) ) {
                foreach ( $terms as $term ) {
                    $query = betterdocs()->query->get_posts( [
                        'post_type'      => 'docs_any',
                        'multiple_kb'    => ! empty( $kb ),
                        'term_id'        => $term->term_id,
                        'term_slug'      => $term->slug,
                        'posts_per_page' => -1,
                        'kb_slug'        => $kb,
                        'orderby'        => 'betterdocs_order'
                    ] );

                    $view_object->get( 'admin/docs-ui/grid-partials/single', [
                        'query' => $query,
                        'term'  => $term
                    ] );
                }
            }

            if( ! empty( $_post__not_in ) ) {
                $_uncategorized_docs_query = new \WP_Query([
                    'post_type' => 'docs',
                    'post_status' => 'any',
                    'post__in' => $_post__not_in
                ]);

                $_term = new stdClass;
                $_term->name = __('Uncategorized', 'betterdocs');
                $_term->term_id = '';

                $view_object->get( 'admin/docs-ui/grid-partials/single', [
                    'query' => $_uncategorized_docs_query,
                    'term'  => $_term
                ] );
            }

            if( empty( $_post__not_in ) && empty( $terms ) ) {
                $view_object->get( 'admin/docs-ui/grid-partials/no-category-item' );
            }
        ?>
    </div>
</div>
