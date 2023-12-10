<?php
if ( ! betterdocs()->settings->get( 'enable_toc', false ) ) {
    return;
}

$toc_hierarchy          = betterdocs()->settings->get( 'toc_hierarchy' );
$toc_list_number        = betterdocs()->settings->get( 'toc_list_number' );
$collapsible_toc_mobile = betterdocs()->settings->get( 'collapsible_toc_mobile' );
$supported_tag          = betterdocs()->settings->get( 'supported_heading_tag', '' );
$htags                  = $supported_tag ? implode( ',', $supported_tag ) : '';

$attributes = betterdocs()->template_helper->get_html_attributes([
    'htags' => "{$htags}",
    'hierarchy' => "{$toc_hierarchy}",
    'list_number' => "{$toc_list_number}",
    'collapsible_on_mobile' => "{$collapsible_toc_mobile}"
]);

echo do_shortcode( "[betterdocs_toc ". $attributes ."]" );
