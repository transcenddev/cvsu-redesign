<?php
    $author = ( isset( $_GET['author'] ) ) ? $_GET['author'] : '';
    $users  = $helper->get_users( ['role__in' => ['administrator', 'editor', 'author', 'contributor']] );
?>
<select
    id="dashboard-select-author"
    class="dashboard-search-field dashboard-select-author"
    name="author">
    <option value="all"><?php _e( 'All Authors', 'betterdocs' )?></option>
    <?php
        foreach ( $users as $user ) {
            echo betterdocs()->template_helper->option_kses( $user->data->ID, $user->data->display_name, $author );
        }
    ?>
</select>
