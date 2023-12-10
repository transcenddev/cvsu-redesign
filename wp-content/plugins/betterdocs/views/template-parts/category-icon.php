<?php
    if ( ! $show_icon ) {
        return;
    }

    $category_icon_meta_key = empty( $term_icon_meta_key ) ? 'doc_category_image-id' : $term_icon_meta_key;
    $cat_icon_id            = get_term_meta( $term_id, $category_icon_meta_key, true );

    $attr = [
        'alt'   => 'betterdocs-category-icon',
        'class' => ['betterdocs-category-icon-img']
    ];

    if ( $cat_icon_id ) {
        $icon_url    = wp_get_attachment_image_url( $cat_icon_id, 'thumbnail' );
        $attr['alt'] = get_post_meta( $cat_icon_id, '_wp_attachment_image_alt', true );
    } else {
        $icon_url = betterdocs()->assets->icon( 'betterdocs-cat-icon.svg', true );
    }

    $attr['src']      = esc_url( $icon_url );
    $image_attributes = betterdocs()->template_helper->get_html_attributes( $attr );
?>

<div class="betterdocs-category-icon">
    <?php echo wp_kses_post( '<img ' . $image_attributes . ' />' ); ?>
</div>
