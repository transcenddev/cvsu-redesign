<?php
    if ( ! $show_button ) {
        return;
    }

    $show_button_icon = isset( $show_button_icon ) ? $show_button_icon : false;
    $button_icon_position = isset( $button_icon_position ) ? $button_icon_position : '';
?>

<a class="docs-cat-link-btn betterdocs-category-link-btn" href="<?php esc_attr_e( esc_url( $permalink ) );?>">
    <?php
        if ( $show_button_icon && ( $button_icon_position === 'before' || $button_icon_position === 'left' ) ) {
            betterdocs()->template_helper->icon( $button_icon, true );
        }

        echo wp_kses_post( $button_text );

        if ( $show_button_icon && ( $button_icon_position === 'after' || $button_icon_position === 'right' ) ) {
            betterdocs()->template_helper->icon( $button_icon, true );
        }
    ?>
</a>
