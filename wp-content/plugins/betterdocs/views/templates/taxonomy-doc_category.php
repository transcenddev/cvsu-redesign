<?php

    /**
     * Template archive docs
     *
     * @link       https://wpdeveloper.com
     * @since      1.0.0
     *
     * @package    BetterDocs
     * @subpackage BetterDocs/public
     */

    get_header();

    $view_object = betterdocs()->views;
    $layout      = betterdocs()->customizer->defaults->get( 'betterdocs_archive_layout_select', 'layout-1' );
    $title_tag   = betterdocs()->customizer->defaults->get( 'betterdocs_archive_title_tag', 'h2' );
    $title_tag   = betterdocs()->template_helper->is_valid_tag( $title_tag );

    $content_area_classes = [
        'betterdocs-content-wrapper betterdocs-display-flex',
        "doc-category-$layout"
    ];

    $current_category = get_queried_object();
?>

<div class="betterdocs-wrapper betterdocs-taxonomy-wrapper betterdocs-category-archive-wrapper betterdocs-wraper">
    <?php betterdocs()->template_helper->search();?>

    <div class="<?php esc_attr_e( implode( ' ', $content_area_classes ) );?>">
        <?php betterdocs()->template_helper->sidebar( $layout );?>

        <div id="main" class="betterdocs-content-area">
            <div class="betterdocs-content-inner-area">
                <?php
                    /**
                     * Breadcrumbs
                     */
                    $view_object->get( 'templates/parts/breadcrumbs' );
                ?>

                <div class="betterdocs-entry-title">
                    <?php
                        echo wp_sprintf(
                            '<%1$s class="betterdocs-entry-heading">%2$s</%1$s>',
                            $title_tag,
                            $current_category->name
                        );
                        echo wp_sprintf( '<p>%s</p>', wp_kses_post( $current_category->description ) );
                    ?>
                </div>

                <div class="betterdocs-entry-body betterdocs-taxonomy-doc-category">
                    <ul>
                        <?php
                            $args = betterdocs()->query->docs_query_args( [
                                'term_id'        => $current_category->term_id,
                                'term_slug'      => $current_category->slug,
                                'posts_per_page' => -1,
                                'orderby'        => betterdocs()->settings->get( 'alphabetically_order_post', 'betterdocs_order' ),
                                'order'          => betterdocs()->settings->get( 'docs_order', 'ASC' ),
                            ] );

                            $post_query = new WP_Query( $args );

                            if ( $post_query->have_posts() ):
                                while ( $post_query->have_posts() ): $post_query->the_post();
                                    echo wp_sprintf(
                                        '<li>%s<a href="%s">%s</a></li>',
                                        betterdocs()->template_helper->icon(),
                                        esc_attr( esc_url( get_the_permalink() ) ),
                                        betterdocs()->template_helper->kses( get_the_title() )
                                    );
                                endwhile;
                                wp_reset_query();
                            endif; // $post_query->have_posts()

                            betterdocs()->views->get( 'template-parts/nested-categories', [
                                'term_id'            => $current_category->term_id,
                                'widget'             => null,
                                'nested_subcategory' => betterdocs()->settings->get( 'archive_nested_subcategory' ),
                                'nested_docs_query_args' => [
                                    'orderby'        => betterdocs()->settings->get( 'alphabetically_order_post', 'betterdocs_order' ),
                                    'order'          => betterdocs()->settings->get( 'docs_order', 'ASC' ),
                                ],
                                'nested_terms_query' => [
                                    'orderby'        => betterdocs()->settings->get( 'terms_orderby', 'betterdocs_order' ),
                                    'order'          => betterdocs()->settings->get( 'terms_order', 'ASC' ),
                                ],
                            ] );
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
