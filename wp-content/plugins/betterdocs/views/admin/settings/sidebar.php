<?php
    // If this file is called directly, abort.
    if ( ! defined( 'WPINC' ) ) {
        die;
    }
?>

<div class="betterdocs-settings-right">
    <div class="betterdocs-sidebar">
        <div class="betterdocs-sidebar-block">
            <div class="betterdocs-admin-sidebar-logo">
                <img alt="BetterDocs" src="<?php echo betterdocs()->assets->icon( 'betterdocs-icon.svg', true ); ?>">
            </div>
            <div class="betterdocs-admin-sidebar-cta">
                <?php
                    if ( class_exists( 'Betterdocs_Pro' ) ) {
                        printf( __( '<a rel="nofollow" href="%s" target="_blank">Manage License</a>', 'betterdocs' ), 'https://wpdeveloper.com/account' );
                    } else {
                        printf( __( '<a rel="nofollow" href="%s" target="_blank">Upgrade to Pro</a>', 'betterdocs' ), 'https://betterdocs.co/upgrade' );
                    }
                ?>
            </div>
        </div>
        <div class="betterdocs-sidebar-block betterdocs-license-block">
            <?php do_action( 'betterdocs_licensing' );?>
        </div>
    </div>
</div>
