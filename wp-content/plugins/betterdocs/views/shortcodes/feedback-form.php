<div class="form-wrapper">
	<div class="response"></div>
    <form id="betterdocs-feedback-form" class="betterdocs-feedback-form" action="" method="post">
        <p>
            <label for="message_name" class="form-name">
				<?php _e( 'Name', 'betterdocs' );?>: <span>*</span> <br>
				<input type="text" id="message_name" name="message_name" value="<?php echo esc_html( $name ) ?>" />
			</label>
		</p>
        <p>
            <label for="message_email" class="form-email">
				<?php _e( 'Email', 'betterdocs' );?>: <span>*</span> <br>
				<input type="text" id="message_email" name="message_email" value="<?php echo esc_html( $email ) ?>" />
			</label>
		</p>
        <p>
            <label for="message_text" class="form-message">
				<?php _e( 'Message', 'betterdocs' );?>: <span>*</span> <br>
				<textarea type="text" id="message_text" name="message_text"></textarea>
			</label>
		</p>
        <div class="feedback-from-button">
			<input type="hidden" name="submitted" value="1">
			<input
                type="submit" name="submit" class="button" id="feedback_form_submit_btn"
                value="<?php esc_attr_e( $button_text );?>"
            />
		</div>
    </form>
</div>
