<?php

    if ( ! betterdocs()->settings->get( 'enable_credit' ) ) {
        return;
    }

?>

<div class="betterdocs-credit">
    <p>
        <?php
            printf(
                '%s <a href="%s" target="_blank">%s</a>',
                __( 'Powered by ', 'betterdocs' ),
                esc_attr( esc_url( 'https://betterdocs.co' ) ),
                __( 'BetterDocs', 'betterdocs' )
            );
        ?>
    </p>
</div>
