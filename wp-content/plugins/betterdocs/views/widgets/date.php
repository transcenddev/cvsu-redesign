<?php

if ( betterdocs()->settings->get( 'show_last_update_time' ) ) {
    echo wp_sprintf(
        '<div %1$s>%2$s %3$s</div>',
        $wrapper_attr,
        __( 'Updated on', 'betterdocs' ),
        get_the_modified_date()
    );
}
