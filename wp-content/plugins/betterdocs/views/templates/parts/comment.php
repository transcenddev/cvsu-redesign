<?php

if ( ! betterdocs()->settings->get( 'enable_comment' ) ) {
    return;
}

if ( comments_open() || get_comments_number() ) {
    if ( function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() ) {
        echo do_blocks( '<!-- wp:post-comments /-->' );
    } else {
        comments_template();
    }
}
