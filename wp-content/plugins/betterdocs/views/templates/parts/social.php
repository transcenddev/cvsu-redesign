<?php
do_action( 'betterdocs_docs_before_social' );

$mods = betterdocs()->customizer->defaults->generate_defaults();

if ( ! $mods['betterdocs_post_social_share'] ) {
    return;
}

$social_sharing_text = $mods['betterdocs_social_sharing_text'];
$facebook_sharing    = $mods['betterdocs_post_social_share_facebook'];
$twitter_sharing     = $mods['betterdocs_post_social_share_twitter'];
$linkedin_sharing    = $mods['betterdocs_post_social_share_linkedin'];
$pinterest_sharing   = $mods['betterdocs_post_social_share_pinterest'];

$attributes = betterdocs()->template_helper->get_html_attributes( [
    'title'     => "{$social_sharing_text}",
    'facebook'  => "{$facebook_sharing}",
    'twitter'   => "{$twitter_sharing}",
    'linkedin'  => "{$linkedin_sharing}",
    'pinterest' => "{$pinterest_sharing}"
] );

echo do_shortcode( "[betterdocs_social_share " . $attributes . "]" );
