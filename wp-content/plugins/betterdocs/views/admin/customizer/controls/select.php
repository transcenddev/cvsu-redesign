<?php
    // If this file is called directly, abort.
    if ( ! defined( 'WPINC' ) ) {
        die;
    }
?>

<select
	<?php $control->link();?>
	data-default-val="<?php echo $control->settings['default']->value(); ?>"
    <?php echo $control->input_attrs(); ?>>
	<?php
        foreach ( $control->choices as $key => $label ) {
            echo '<option value="' . esc_attr( $key ) . '">' . $label . '</option>';
        }
    ?>
</select>

<?php if ( ! empty( $control->label ) ): ?>
	<span class="customize-control-title betterdocs-customize-control-title">
        <?php echo esc_html( $control->label ); ?>
    </span>
<?php endif;?>