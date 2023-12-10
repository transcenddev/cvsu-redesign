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

    $terms_orderby = betterdocs()->settings->get( 'terms_orderby' );
    $terms_order   = betterdocs()->settings->get( 'terms_order' );
    $order_term    = betterdocs()->settings->get( 'alphabetically_order_term', false );
    $title_tag     = betterdocs()->customizer->defaults->get( 'betterdocs_category_title_tag' );
    $title_tag     = betterdocs()->template_helper->is_valid_tag( $title_tag );
    $border_bottom = betterdocs()->customizer->defaults->get( 'betterdocs_doc_page_box_border_bottom' );

    if ( $order_term ) {
        $terms_orderby = 'name';
    }
?>

<div class="betterdocs-wrapper betterdocs-docs-archive-wrapper betterdocs-category-layout-2 betterdocs-box-layout betterdocs-wraper">
    <?php betterdocs()->template_helper->search();?>

    <div class="betterdocs-content-wrapper betterdocs-archive-wrap betterdocs-archive-main">
        <?php
            $attributes = betterdocs()->template_helper->shortcode_atts( [
                'title_tag'     => "$title_tag",
                'terms_order'   => "$terms_order",
                'terms_orderby' => esc_html( $terms_orderby ),
                'border_bottom' => "$border_bottom"
            ], 'betterdocs_category_box', 'layout-2' );

            echo do_shortcode( '[betterdocs_category_box ' . $attributes . ']' );
        ?>
    </div>

    <?php
        /**
         * @todo faq views will here.
         */
        betterdocs()->views->get( 'templates/faq' );
    ?>
</div>

<?php
    /**
     * Footer
     */
get_footer();
