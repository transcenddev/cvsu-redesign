<div class="betterdocs-single-listing">
    <div class="betterdocs-single-listing-inner">
        <h4 class="betterdocs-single-listing-title">
            <?php echo wp_kses_post( $term->name ); ?>
        </h4>

        <ul class="docs-droppable" data-category_id="<?php esc_attr_e( $term->term_id );?>">
            <?php
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();

                        $post_id = get_the_ID();

                        $view_object->get( 'admin/docs-ui/grid-partials/single-list-item', [
                            'post_id'          => $post_id,
                            'permalink'        => get_permalink( $post_id ),
                            'post_status'      => get_post_status( $post_id ),
                            'edit_post_link'   => get_edit_post_link( $post_id, '' ),
                            'delete_post_link' => get_delete_post_link( $post_id, '' )
                        ] );
                    }
                } else {
                    $view_object->get( 'admin/docs-ui/grid-partials/no-content-list-item' );
                }
            ?>
        </ul>
    </div>

    <?php $view_object->get( 'admin/docs-ui/grid-partials/add-item' ); ?>
</div>
