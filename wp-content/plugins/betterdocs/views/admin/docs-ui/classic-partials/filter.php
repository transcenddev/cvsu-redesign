<?php
    use WPDeveloper\BetterDocs\Utils\Helper;

    /**
     * This portion will decide which tab will be showed.
     */
    $admin_tab   = Helper::admin_tab();
    $form_action = admin_url( 'admin.php' );
?>

<div class="betterdocs-settings-header betterdocs-settings-filter">
    <div class="betterdocs-header-full">
        <div class="betterdocs-header-filter">
            <form method="get" action="<?php esc_attr_e( esc_url( $form_action ) )?>" id="posts-filter">
                <input type="hidden" name="page" class="post_type_page" value="betterdocs-admin" />
                <input type="hidden" name="mode" value="<?php esc_attr_e( $admin_tab );?>" />
                <input
                    id="post-search-input"
                    class="dashboard-search-field"
                    type="text"
                    name="s"
                    placeholder="<?php _e( 'Search', 'betterdocs' );?>"
                    value="<?php echo ( isset( $_REQUEST['s'] ) ) ? esc_attr( $_REQUEST['s'] ) : '' ?>" />

                <?php
                    $view_object->get( 'admin/docs-ui/classic-partials/order' );
                    $view_object->get( 'admin/docs-ui/classic-partials/date' );
                    $view_object->get( 'admin/docs-ui/classic-partials/author' );
                    $view_object->get( 'admin/docs-ui/classic-partials/categories' );
                    do_action( 'betterdocs_admin_filter_after_category' );
                    $view_object->get( 'admin/docs-ui/classic-partials/status' );
                    do_action( 'betterdocs_admin_filter_before_submit' );
                    $view_object->get( 'admin/docs-ui/classic-partials/button' );
                ?>
            </form>
        </div>
    </div>
</div>
