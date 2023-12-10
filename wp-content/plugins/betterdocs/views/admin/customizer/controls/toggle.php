<?php
    // If this file is called directly, abort.
    if ( ! defined( 'WPINC' ) ) {
        die;
    }
?>
<label>
	<div class="betterdocs-customizer-toggle">
		<span class="customize-control-title betterdocs-customize-control-title betterdocs-customizer-toggle-title">
            <?php echo esc_html( $control->label ); ?>
        </span>
		<input
            type="checkbox"
            id="cb<?php echo $control->instance_number ?>"
            data-default-val="<?php echo $control->settings['default']->value(); ?>"
            class="tgl tgl-<?php echo $control->type; ?>"
            value="<?php esc_attr_e( $control->value() );?>"
            <?php
                $control->link();
                checked( $control->value() );
            ?>
        />
		<label for="cb<?php echo $control->instance_number ?>" class="tgl-btn"></label>
	</div>
	<?php if ( ! empty( $control->description ) ): ?>
        <span class="description customize-control-description"><?php echo $control->description; ?></span>
	<?php endif;?>
</label>
