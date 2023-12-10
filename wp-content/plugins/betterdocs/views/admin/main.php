<?php
    use WPDeveloper\BetterDocs\Utils\Helper;

    /**
     * This portion will decide which tab will be showed.
     */
    $admin_tab = Helper::admin_tab();
?>
<div class="wrap">
    <hr class="wp-header-end">
    <div class="betterdocs-listing-wrapper">
        <?php do_action( 'betterdocs_listing_header', $admin_tab );?>
    </div>

    <?php
        $view_object->get( 'admin/docs-ui/' . $admin_tab, [] );
    ?>
</div>
