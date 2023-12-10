<tr>
    <td>
        <h2 id="<?php print( isset( $args['id'] ) ? $args['id'] : '' );?>"><?php print( isset( $args['title'] ) ? $args['title'] : '' );?></h2>
        <p class="welcome-sub-title"><?php print( isset( $args['sub_title'] ) ? $args['sub_title'] : '' );?></p>
        <?php
            if ( isset( $args['video_url'] ) ):
                ?>
        <div class="wpscp-getting-started-video">
            <iframe width="620" height="350" src="<?php print( isset( $args['video_url'] ) ? esc_url( $args['video_url'] ) : '' )?>" frameborder="0"></iframe>
        </div>
        <?php
            endif;
            /** @var object $current_user; */
        ?>
    </td>
</tr>
<tr>
    <td>
        <div class="betterdocs_getting_started_form text-center">
            <input type="checkbox" id="betterdocs_user_email_address" name="betterdocs_user_email_address" value="<?php print $current_user->user_email;?>">
            <?php _e( 'Share non-sensitive diagnostic data and plugin usage information.', 'betterdocs' )?>
        </div>
    </td>
</tr>
