<?php
    $order = ( isset( $_GET['order'] ) ) ? $_GET['order'] : '';

    $_order_options = apply_filters( 'betterdocs_admin_post_filter', [
        ''     => __( 'Order', 'betterdocs' ),
        'ASC'  => __( 'Ascending', 'betterdocs' ),
        'DESC' => __( 'Descending', 'betterdocs' )
    ], 'order' );
?>

<select
    id="dashboard-select-order"
    class="dashboard-search-field dashboard-select-order"
    name="order">
    <?php
        foreach ( $_order_options as $order_value => $option_label ) {
            echo betterdocs()->template_helper->option_kses( $order_value, $option_label, $order );
        }
    ?>
</select>
