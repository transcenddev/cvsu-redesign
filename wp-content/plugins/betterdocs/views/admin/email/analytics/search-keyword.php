<?php
    if ( empty( $keywords ) || ! is_array( $keywords ) ) {
        return;
    }
?>

<tr>
    <td style="text-align: left; font-size: 20px; padding-top: 40px;">
        <?php _e( 'Most Searched Keywords', 'betterdocs' );?>
    </td>
</tr>
<tr>
    <td>
        <table style="width: 100%; border-collapse: separate; border-spacing: 2px; padding-top: 20px;">
            <tr style="background: #fff;">
                <th style="text-align: left; font-size: 14px; font-weight: 600; color:#6e6e73; text-transform: capitalize; padding: 8px 15px; width: 50%;">
                    <?php _e( 'Search Keyword', 'betterdocs' );?>
                </th>
                <th style="text-align: center; font-size: 14px; font-weight: 600; color:#6e6e73; text-transform: capitalize; padding: 8px 15px">
                    <?php _e( 'Total Search', 'betterdocs' );?>
                </th>
                <th style="text-align: center; font-size: 14px; font-weight: 600; color:#6e6e73; text-transform: capitalize; padding: 8px 15px">
                    <?php _e( 'Result Found', 'betterdocs' );?>
                </th>
            </tr>
            <?php
                foreach ( $keywords as $keyword ) {
                    betterdocs()->views->get( 'admin/email/analytics/parts/single-keyword', [
                        'keyword' => $keyword
                    ] );
                }
            ?>
        </table>
    </td>
</tr>
