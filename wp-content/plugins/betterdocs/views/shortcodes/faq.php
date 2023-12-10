<div
    <?php echo $wrapper_attr; ?>>
    <h2 class="<?php esc_attr_e( $faq_heading_class );?> betterdocs-faq-section-title">
        <?php echo $faq_heading; ?>
    </h2>

    <div class="betterdocs-faq-inner-wrapper">
        <?php
            $terms    = get_terms( $terms_query_args );
            $faq_json = '';

            if ( ! is_wp_error( $terms ) ) {
                $GLOBALS['betterdocs_faq_schema'] = [];
                if ( $faq_schema ) {
                    $faq_json = [
                        '@context'   => 'https://schema.org',
                        '@type'      => 'FAQPage',
                        'mainEntity' => []
                    ];

                    $GLOBALS['betterdocs_faq_schema_main_entity'] = $faq_json['mainEntity'];
                }

                foreach ( $terms as $term ) {
                    if ( $term->count <= 0 ) {
                        continue;
                    }

                    // title
                    $view_object->get( 'shortcode-parts/faq-term-title', [
                        'title' => $term->name
                    ] );

                    // faq list
                    $view_object->get( 'shortcode-parts/faq-list', [
                        'term'       => $term,
                        'faq_schema' => $faq_schema,
                        'faq_json'   => $faq_schema ? $faq_json['mainEntity'] : ''
                    ] );
                }

                if ( $faq_schema ) {
                    $faq_json['mainEntity'] = $GLOBALS['betterdocs_faq_schema_main_entity'];
                    echo '<script type="application/ld+json">' . wp_json_encode( $faq_json ) . '</script>';
                }
            }
        ?>
    </div>
</div>
