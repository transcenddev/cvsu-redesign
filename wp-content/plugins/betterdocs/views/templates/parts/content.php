<?php

$content = apply_filters( 'the_content', get_the_content() );

$_htags = $_enable_toc = null;

if( isset( $htags ) ) {
    $_htags = $htags;
}
if( isset( $enable_toc ) ) {
    $_enable_toc = $enable_toc;
}

echo betterdocs()->template_helper->content( $content, $_htags, $_enable_toc );
