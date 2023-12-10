<?php

    $attributes = [
        'href'    => esc_url( $permalink ),
        'data-id' => isset( $term->term_id ) ? $term->term_id : 0,
        'class'   => ['betterdocs-single-category-wrapper category-box']
    ];

    if ( isset( $wrapper_class ) && is_array( $wrapper_class ) && ! empty( $wrapper_class ) ) {
        $attributes['class'] = array_merge( $attributes['class'], $wrapper_class );
    }

    $attributes = betterdocs()->template_helper->get_html_attributes( $attributes );
?>

<a
    <?php echo $attributes; ?>>
	<div class="betterdocs-single-category-inner">
		<?php $view_object->get( 'layout-parts/header' ); ?>
	</div>
</a>
