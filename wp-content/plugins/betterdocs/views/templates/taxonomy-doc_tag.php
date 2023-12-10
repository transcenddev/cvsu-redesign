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

    $view_object      = betterdocs()->views;
    $layout           = betterdocs()->customizer->defaults->get( 'betterdocs_archive_layout_select', 'layout-1' );
    $title_tag        = betterdocs()->customizer->defaults->get( 'betterdocs_archive_title_tag', 'h2' );
    $title_tag        = betterdocs()->template_helper->is_valid_tag( $title_tag );
    $current_category = get_queried_object();
    $content_area_classes = [
        'betterdocs-content-wrapper betterdocs-display-flex',
        "doc-category-$layout"
    ];
?>

<div class="betterdocs-wrapper betterdocs-taxonomy-wrapper betterdocs-category-archive-wrapper betterdocs-wraper">
    <?php betterdocs()->template_helper->search();?>

    <div class="<?php esc_attr_e( implode( ' ', $content_area_classes ) ); ?>">
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
                    <?php echo wp_sprintf( '<%1$s class="docs-cat-heading">%2$s</%1$s>', 'h3', $current_category->name ); ?>
                </div>

                <div class="betterdocs-entry-body betterdocs-taxonomy-doc-category">
                    <?php
                        $_tax_query = [
                            [
                                'taxonomy' => 'doc_tag',
                                'field'    => 'slug',
                                'terms'    => $current_category->slug
                            ]
                        ];
                        $post_query = betterdocs()->query->get_posts( [
                            'term_id'        => $current_category->term_id,
                            'term_slug'      => $current_category->slug,
                            'posts_per_page' => -1,
                            'tax_query'      => apply_filters( 'betterdocs_tag_tax_query', $_tax_query, $current_category )
                        ] );

                        if ( $post_query->have_posts() ) :
                    ?>
                    <ul>
                        <?php
                            while ( $post_query->have_posts() ): $post_query->the_post();
                                echo wp_sprintf(
                                    '<li>%s<a href="%s">%s</a></li>',
                                    betterdocs()->template_helper->icon(),
                                    esc_attr( esc_url( get_the_permalink() ) ),
                                    betterdocs()->template_helper->kses( get_the_title() )
                                );
                            endwhile;
                            wp_reset_query();
                        ?>
                    </ul>
                    <?php
                        else:
                            echo '<p class="nothing-here">' . __( 'Sorry, no docs were found.', 'betterdocs' ) . '</p>';
                        endif; // $post_query->have_posts()
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
