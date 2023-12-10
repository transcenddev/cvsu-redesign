<?php
    /**
     * Template archive docs
     *
     * @link       https://wpdeveloper.com
     * @since      1.0.0
     *
     * @package    WPDeveloper/BetterDocs
     * @subpackage BetterDocs/public
     */

    get_header();

    $live_search         = betterdocs()->settings->get( 'live_search', false );
    $terms_orderby       = betterdocs()->settings->get( 'terms_orderby' );
    $terms_order         = betterdocs()->settings->get( 'terms_order' );
    $order_term          = betterdocs()->settings->get( 'alphabetically_order_term', false );
    $title_tag           = betterdocs()->customizer->defaults->get( 'betterdocs_category_title_tag' );
    $title_tag           = betterdocs()->template_helper->is_valid_tag( $title_tag );
    $category_title_link = betterdocs()->settings->get( 'category_title_link' );

    if ( $order_term ) {
        $terms_orderby = 'name';
    }
?>

<div class="betterdocs-wrapper betterdocs-docs-archive-wrapper betterdocs-category-layout-1 betterdocs-grid-layout betterdocs-wraper">
    <?php betterdocs()->template_helper->search();?>

    <div class="betterdocs-content-wrapper betterdocs-content-wrapper betterdocs-archive-wrap betterdocs-archive-main">
        <?php
            $attributes = betterdocs()->template_helper->shortcode_atts([
                'title_tag'           => $title_tag,
                'terms_order'         => $terms_order,
                'terms_orderby'       => esc_html( $terms_orderby ),
                'category_title_link' => $category_title_link
            ], 'betterdocs_category_grid', 'layout-1');

            echo do_shortcode( '[betterdocs_category_grid ' . $attributes . ']' );
        ?>
    </div>
    <?php betterdocs()->views->get( 'templates/faq' );?>
</div>

<?php
    /**
     * Footer
     */
get_footer();
