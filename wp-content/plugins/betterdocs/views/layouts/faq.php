<?php
$faq_terms = get_terms( betterdocs()->query->faq_terms_query_args() );

if ( $enable && $have_posts && ! empty( $faq_terms ) ) {
    $enable_faq_schema            = betterdocs()->settings->get( 'enable_faq_schema' );
    $shortcode_attr['faq_schema'] = $enable_faq_schema;

    $attributes = betterdocs()->template_helper->get_html_attributes( $shortcode_attr );

    if ( $layout === 'layout-1' ) {
        echo do_shortcode( '[betterdocs_faq_list_modern ' . $attributes . ']' );
    } else if ( $layout === 'layout-2' ) {
        echo do_shortcode( '[betterdocs_faq_list_classic ' . $attributes . ']' );
    }
}
