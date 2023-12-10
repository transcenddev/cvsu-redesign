<?php
    $post_status = ( isset( $_GET['post_status'] ) ) ? $_GET['post_status'] : '';

    $_options_statuses = [
        'any'        => __( 'Doc Status', 'betterdocs' ),
        'publish'    => __( 'Publish', 'betterdocs' ),
        'pending'    => __( 'Pending', 'betterdocs' ),
        'draft'      => __( 'Draft', 'betterdocs' ),
        'auto-draft' => __( 'Auto Draft', 'betterdocs' ),
        'future'     => __( 'Future', 'betterdocs' ),
        'private'    => __( 'Private', 'betterdocs' ),
        'inherit'    => __( 'Inherit', 'betterdocs' )
    ];

?>
<select
    id="dashboard-select-status"
    class="dashboard-search-field dashboard-select-status"
	name="post_status">
    <?php
        foreach ( $_options_statuses as $option_value => $option_label ) {
            echo betterdocs()->template_helper->option_kses( $option_value, $option_label, $post_status );
        }
    ?>
</select>
