<?php
    $image_url = '';
    if ( ! $is_pro ):
        $image_url = 'https://betterdocs.co/wp-content/uploads/2022/11/Analytics.gif';
    ?>
    <tr>
        <td style="padding-top: 40px;">
            <table style="width: 100%; background: rgba(38, 214, 125, 0.1); padding: 20px 20px 20px 20px; border-radius: 5px; border-spacing: 0;">
                <tr>
                    <td style="display: flex; gap: 10px;">
                        <span style="margin-top: 4px; margin-right: 3px;">💡</span>
                        <p style="float: right; font-size: 14px; line-height: 1.7em; font-weight: 400; text-align: justify; margin: 0;">
                            This advanced <span style="font-weight: 700; color: #1d1d1f; text-decoration: none;">Email Reporting</span> feature is part of our premium built in Analytics tool available only with BetterDocs PRO, but you
                            are getting it for <span style="font-weight: 700; color: #1d1d1f; text-decoration: none;">FREE!</span>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding-top: 40px;">
            <table style="width: 100%; background: #fff; padding: 10px; border-spacing: 0;">
                <tr>
                    <td>
                        <img style="display: block; max-width: 100%;" src="<?php esc_attr_e( esc_url( $image_url ) );?>" alt="View Analytics">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding-top: 30px;">
            <a href="https://betterdocs.co/upgrade" style="text-decoration: none; font-size: 12px; font-weight: 600; color: #fff; padding: 16px 22px; border: none; background: #26d67d; border-radius: 10px; cursor: pointer; display: inline-block; letter-spacing: 1px;">
                <?php _e( 'Unlock BetterDocs Analytics', 'betterdocs' );?> <span style="padding-left: 5px;">🔐</span>
            </a>
        </td>
    </tr>
<?php else: ?>
	<tr>
		<td style="padding-top: 40px;" align="center">
			<a style="display:inline-block; text-decoration: none; font-size: 12px; font-weight: 600; color: #fff; padding: 16px 22px; border: none; background: #26d67d; border-radius: 10px; cursor: pointer; display: inline-block; letter-spacing: 1px;" href="<?php esc_attr_e( esc_url( $analytics_url ) );?>" target="_blank">
				<?php _e( 'View Analytics', 'betterdocs' );?>
			</a>
		</td>
	</tr>
<?php endif;?>
<tr>
    <td style="padding-top: 20px;">
        <table style="border-spacing: 0;">
            <tr>
                <td style="display: flex;">
                    <span style="margin-right: 10px; margin-top: 5px;">📚</span>
                    <p style="text-align: justify; font-size: 14px; line-height: 1.7em; font-weight: 400; margin: 0;"> Want to know what more you can do with BetterDocs? Check out these tutorials:
                        <a href="https://betterdocs.co/blog/improved-betterdocs-analytics/" style="font-weight: 500; color: #1d1d1f; font-style: italic;">Complete Guide To BetterDocs Analytics,</a>
                        <a href="https://betterdocs.co/blog/key-customer-service-metrics/" style="font-weight: 500; color: #1d1d1f; font-style: italic;">Key Customer Service Metrics To Measure Performance</a> &
                        <a href="https://betterdocs.co/blog/internal-documentation-wordpress/" style="font-weight: 500; color: #1d1d1f; font-style: italic;">How To Use BetterDocs Internal Knowledge Base.</a>
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>
