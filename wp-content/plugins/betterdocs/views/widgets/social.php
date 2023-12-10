<div
    <?php echo $wrapper_attr; ?>>
    <div class="betterdocs-social-share-heading">
        <?php
            if ( $title ) {
                echo wp_sprintf( '<h5>%s</h5>', esc_html( $title ) );
            }
        ?>
    </div>

    <ul class="betterdocs-social-share-links">
        <?php
            if ( ! empty( $links ) ) {
                foreach ( $links as $key => $social ) {
                    echo wp_sprintf(
                        '<li><a href="%s" target="_blank"><img src="%s" alt="%s"></a></li>',
                        esc_url( $social['link'] ),
                        esc_html( $social['icon'] ),
                        esc_attr( $social['alt'] )
                    );
                }
            }
        ?>
    </ul>
</div>
