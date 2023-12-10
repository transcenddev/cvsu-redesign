<?php
    use WPDeveloper\BetterDocs\Utils\Helper;

    $posts = betterdocs()->query->get_posts( $query_args, true );

    if ( ! $posts->have_posts() ) {
        wp_reset_query();
    }

    $_page_id = null;

    if ( is_single() ) {
        $_page_id = get_the_ID();
    }
?>

<ul class="betterdocs-articles-list">
    <?php
        if ( $query_args['posts_per_page'] === '' ) $query_args['posts_per_page'] = get_option('posts_per_page');

        if ( $query_args['posts_per_page'] == -1 || $query_args['posts_per_page'] > 0 ) {
            $pos = 'left';
            $icon = 'list';
            if( ! empty ( $list_icon_position ) ) {
                if( $list_icon_position == 'right' ) {
                    $pos = 'right';
                }
            }
            if( ! empty ( $list_icon_name ) ) {
                $icon = $list_icon_name;
            }


            while ( $posts->have_posts() ): $posts->the_post();
                $_link_attributes = [
                    'href' => esc_url( get_the_permalink() )
                ];

                if ( $_page_id === get_the_ID() && Helper::get_tax() != 'doc_category' ) {
                    $_link_attributes['class'] = 'active';
                }

                $_link_attributes = betterdocs()->template_helper->get_html_attributes( $_link_attributes );

                echo wp_sprintf(
                    '<li>%4$s<a %1$s><span>%2$s</span> %3$s</a></li>',
                    $_link_attributes,
                    betterdocs()->template_helper->kses( get_the_title() ),
                    $pos == 'right' ? betterdocs()->template_helper->icon( $icon ) : '',
                    $pos == 'left' ? betterdocs()->template_helper->icon( $icon ) : ''
                );
            endwhile;

            wp_reset_postdata();
            wp_reset_query();
        }
        /**
         * Nested Sub Categories
         */
        if ( (bool) $nested_subcategory && $term instanceof \WP_Term ) {
            $_params = get_defined_vars();
            $_params = isset( $_params['params'] ) ? $_params['params'] : [];
            $_params = wp_parse_args( ['term_id' => $term->term_id], $_params );
            $view_object->get( 'template-parts/nested-categories', $_params );
        }
    ?>
</ul>
