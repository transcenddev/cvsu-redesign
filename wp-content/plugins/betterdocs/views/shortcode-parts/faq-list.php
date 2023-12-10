<?php

$faqs = betterdocs()->query->get_faq_by_term( $term->term_id );

if ( $faqs->have_posts() ) {
    echo '<ul class="betterdocs-faq-list">';

    $faq_markup = '';
    while ( $faqs->have_posts() ): $faqs->the_post();
        echo '<li>';
        echo '<div class="betterdocs-faq-group">';
        $view_object->get( 'shortcode-parts/faq-title' );
        $view_object->get( 'shortcode-parts/faq-content' );
        echo '</div>';
        echo '</li>';

        if ( $faq_schema ) {
            $faq_json = [
                '@type'          => 'Question',
                'name'           => get_the_title(),
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => get_the_content()
                ]
            ];
            $GLOBALS['betterdocs_faq_schema_main_entity'][] = $faq_json;
        }
    endwhile;
    wp_reset_postdata();
    wp_reset_query();
    echo $faq_markup;
    echo '</ul>';
} else {
    echo '<p>' . __( 'Sorry, no FAQ matched your criteria.', 'betterdocs' ) . '</p>';
}
