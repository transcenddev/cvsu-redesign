<?php

if ( betterdocs()->settings->get( 'show_last_update_time' ) ) {
    echo wp_sprintf( '<div class="update-date">%s %s</div>', __( 'Updated on', 'betterdocs' ), get_the_modified_date() );
}
