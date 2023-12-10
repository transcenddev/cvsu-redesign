<?php
    /**
     * The template for single doc page
     *
     * @author  WPDeveloper
     * @package Documentation/SinglePage
     */

    // If this file is called directly, abort.
    if ( ! defined( 'WPINC' ) ) {
        die;
    }

    get_header();

    $mods        = betterdocs()->customizer->defaults->generate_defaults();
    $view_object = betterdocs()->views;
?>

<div class="betterdocs-wrapper betterdocs-single-wrapper betterdocs-single-layout-1 betterdocs-single-classic-layout betterdocs-single-wraper">
    <?php betterdocs()->template_helper->search();?>

    <div class="betterdocs-content-wrapper betterdocs-display-flex">
        <?php $view_object->get( 'templates/sidebars/sidebar-1' );?>

        <div id="betterdocs-single-main" class="betterdocs-content-area">
            <?php
                while ( have_posts() ): the_post();
                    $view_object->get( 'templates/headers/layout-1' );
                    $view_object->get( 'templates/contents/layout-1' );
                    $view_object->get( 'templates/footer' );
                endwhile;
                $view_object->get( 'templates/parts/navigation' );
                $view_object->get( 'templates/parts/credit' );
                $view_object->get( 'templates/parts/comment' );
            ?>
        </div> <!-- #main -->
    </div>
</div>
<?php
    /**
     * Footer
     */
get_footer();
