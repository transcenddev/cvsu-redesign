<?php
    use WPDeveloper\BetterDocs\Utils\Helper;

    $attributes = [
        'data-id' => isset( $term->term_id ) ? $term->term_id : 0,
        'class'   => ['betterdocs-single-category-wrapper category-grid']
    ];

    if ( is_single() && ( $term->term_id === $current_queried_object_id || ( (bool) $nested_subcategory && in_array( $term->term_id, $ancestors ) ) ) ) {
        $attributes['class'][] = 'active';
    } elseif ( Helper::get_tax() == 'doc_category' && $term->term_id === $current_queried_object_id ) {
        $attributes['class'][] = 'active';
    }

    if ( isset( $wrapper_class ) && is_array( $wrapper_class ) && ! empty( $wrapper_class ) ) {
        $attributes['class'] = array_merge( $attributes['class'], $wrapper_class );
    }

    $attributes = betterdocs()->template_helper->get_html_attributes( $attributes );
?>

<article
    <?php echo $attributes; ?>>
	<div class="betterdocs-single-category-inner">
		<?php
            if ( $show_header ) {
                $view_object->get( 'layout-parts/header' );
            }

            if ( $show_list ) {
                echo '<div class="betterdocs-body">';
                $view_object->get( 'template-parts/category-list' );
                echo '</div>';
            }

            $view_object->get( 'layout-parts/footer' );
        ?>
	</div>
</article>
