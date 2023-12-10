<?php
    $date = ( isset( $_GET['date'] ) ) ? $_GET['date'] : '';

    $_date_options = apply_filters( 'betterdocs_admin_post_filter', [
        ''             => __( 'All Dates', 'betterdocs' ),
        'most_recent'  => __( 'Most Recent', 'betterdocs' ),
        'least_recent' => __( 'Least Recent', 'betterdocs' ),
        'custom_date'  => __( 'Custom', 'betterdocs' )
    ], 'date' );
?>
<select
    id="dashboard-select-date"
    class="dashboard-search-field dashboard-select-date"
    name="date">
    <?php
        foreach ( $_date_options as $date_value => $date_label ) {
            echo betterdocs()->template_helper->option_kses( $date_value, $date_label, $date );
        }
    ?>
</select>
<input
    id="reportrange"
    class="dashboard-select-date-custom"
    type="text"
    name="date_range"
    title="<?php echo ( isset( $_GET['date_range'] ) ) ? esc_attr( $_GET['date_range'] ) : ''; ?>"
    value="<?php echo ( isset( $_GET['date_range'] ) ) ? esc_attr( $_GET['date_range'] ) : ''; ?>" />
