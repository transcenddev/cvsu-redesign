<?php
    use WPDeveloper\BetterDocs\Admin\PostsTable;

    // return;
    global $wpdb;

    set_current_screen( 'edit-docs' );
    add_filter( 'screen_options_show_screen', '__return_true' );
    global $post_type, $post_type_object, $typenow, $per_page;
    $post_type        = 'docs';
    $wp_list_table    = _get_list_table( 'WP_List_Table' );
    $wp_list_table    = _get_list_table( 'WP_Posts_List_Table' );
    $wp_list_table    = new PostsTable();
    $pagenum          = $wp_list_table->get_pagenum();
    $post_type_object = get_post_type_object( $post_type );

    if ( 'post' !== $post_type ) {
        $parent_file   = "edit.php?post_type=$post_type";
        $submenu_file  = "edit.php?post_type=$post_type";
        $post_new_file = "post-new.php?post_type=$post_type";
    } else {
        $parent_file   = 'edit.php';
        $submenu_file  = 'edit.php';
        $post_new_file = 'post-new.php';
    }

    $doaction = $wp_list_table->current_action();

    if ( $doaction ) {
        check_admin_referer( 'bulk-posts' );

        $sendback = remove_query_arg( ['trashed', 'untrashed', 'deleted', 'locked', 'ids'], wp_get_referer() );
        if ( ! $sendback ) {
            $sendback = admin_url( $parent_file );
        }
        $sendback = add_query_arg( 'paged', $pagenum, $sendback );
        if ( strpos( $sendback, 'post.php' ) !== false ) {
            $sendback = admin_url( $post_new_file );
        }

        if ( 'delete_all' === $doaction ) {
            // Prepare for deletion of all posts with a specified post status (i.e. Empty Trash).
            $post_status = preg_replace( '/[^a-z0-9_-]+/i', '', $_REQUEST['post_status'] );
            // Validate the post status exists.
            if ( get_post_status_object( $post_status ) ) {
                $post_ids = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type=%s AND post_status = %s", $post_type, $post_status ) );
            }
            $doaction = 'delete';
        } elseif ( isset( $_REQUEST['media'] ) ) {
            $post_ids = $_REQUEST['media'];
        } elseif ( isset( $_REQUEST['ids'] ) ) {
            $post_ids = explode( ',', $_REQUEST['ids'] );
        } elseif ( ! empty( $_REQUEST['post'] ) ) {
            $post_ids = array_map( 'intval', $_REQUEST['post'] );
        }

        if ( ! isset( $post_ids ) ) {
            wp_redirect( $sendback );
            exit;
        }

        switch ( $doaction ) {
            case 'trash':
                $trashed = 0;
                $locked  = 0;

                foreach ( (array) $post_ids as $post_id ) {
                    if ( ! current_user_can( 'delete_post', $post_id ) ) {
                        wp_die( __( 'Sorry, you are not allowed to move this item to the Trash.' ) );
                    }

                    if ( wp_check_post_lock( $post_id ) ) {
                        $locked++;
                        continue;
                    }

                    if ( ! wp_trash_post( $post_id ) ) {
                        wp_die( __( 'Error in moving the item to Trash.' ) );
                    }

                    $trashed++;
                }

                $sendback = add_query_arg(
                    [
                        'trashed' => $trashed,
                        'ids'     => implode( ',', $post_ids ),
                        'locked'  => $locked
                    ],
                    $sendback
                );
                break;
            case 'untrash':
                $untrashed = 0;

                if ( isset( $_GET['doaction'] ) && ( 'undo' === $_GET['doaction'] ) ) {
                    add_filter( 'wp_untrash_post_status', 'wp_untrash_post_set_previous_status', 10, 3 );
                }

                foreach ( (array) $post_ids as $post_id ) {
                    if ( ! current_user_can( 'delete_post', $post_id ) ) {
                        wp_die( __( 'Sorry, you are not allowed to restore this item from the Trash.' ) );
                    }

                    if ( ! wp_untrash_post( $post_id ) ) {
                        wp_die( __( 'Error in restoring the item from Trash.' ) );
                    }

                    $untrashed++;
                }
                $sendback = add_query_arg( 'untrashed', $untrashed, $sendback );

                remove_filter( 'wp_untrash_post_status', 'wp_untrash_post_set_previous_status', 10 );

                break;
            case 'delete':
                $deleted = 0;
                foreach ( (array) $post_ids as $post_id ) {
                    $post_del = get_post( $post_id );

                    if ( ! current_user_can( 'delete_post', $post_id ) ) {
                        wp_die( __( 'Sorry, you are not allowed to delete this item.' ) );
                    }

                    if ( 'attachment' === $post_del->post_type ) {
                        if ( ! wp_delete_attachment( $post_id ) ) {
                            wp_die( __( 'Error in deleting the attachment.' ) );
                        }
                    } else {
                        if ( ! wp_delete_post( $post_id ) ) {
                            wp_die( __( 'Error in deleting the item.' ) );
                        }
                    }
                    $deleted++;
                }
                $sendback = add_query_arg( 'deleted', $deleted, $sendback );
                break;
            case 'edit':
                if ( isset( $_REQUEST['bulk_edit'] ) ) {
                    $done = bulk_edit_posts( $_REQUEST );

                    if ( is_array( $done ) ) {
                        $done['updated'] = count( $done['updated'] );
                        $done['skipped'] = count( $done['skipped'] );
                        $done['locked']  = count( $done['locked'] );
                        $sendback        = add_query_arg( $done, $sendback );
                    }
                }
                break;
            default:
                $screen = get_current_screen()->id;

                /**
                 * Fires when a custom bulk action should be handled.
                 *
                 * The redirect link should be modified with success or failure feedback
                 * from the action to be used to display feedback to the user.
                 *
                 * The dynamic portion of the hook name, `$screen`, refers to the current screen ID.
                 *
                 * @since 4.7.0
                 *
                 * @param string $sendback The redirect URL.
                 * @param string $doaction The action being taken.
                 * @param array  $items    The items to take the action on. Accepts an array of IDs of posts,
                 *                         comments, terms, links, plugins, attachments, or users.
                 */
                $sendback = apply_filters( "handle_bulk_actions-{$screen}", $sendback, $doaction, $post_ids ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
                break;
        }

        $sendback = remove_query_arg( ['action', 'action2', 'tags_input', 'post_author', 'comment_status', 'ping_status', '_status', 'post', 'bulk_edit', 'post_view'], $sendback );

        wp_redirect( $sendback );
        exit;
    } elseif ( ! empty( $_REQUEST['_wp_http_referer'] ) ) {
        wp_redirect( remove_query_arg( ['_wp_http_referer', '_wpnonce'], wp_unslash( $_SERVER['REQUEST_URI'] ) ) );
        exit;
    }

    $wp_list_table->prepare_items();

    wp_enqueue_script( 'inline-edit-post' );
    wp_enqueue_script( 'heartbeat' );

    if ( 'wp_block' === $post_type ) {
        wp_enqueue_script( 'wp-list-reusable-blocks' );
        wp_enqueue_style( 'wp-list-reusable-blocks' );
    }

    $title = $post_type_object->labels->name;

    get_current_screen()->set_screen_reader_content(
        [
            'heading_views'      => $post_type_object->labels->filter_items_list,
            'heading_pagination' => $post_type_object->labels->items_list_navigation,
            'heading_list'       => $post_type_object->labels->items_list
        ]
    );

    add_screen_option(
        'per_page',
        [
            'default' => 20,
            'option'  => 'edit_' . $post_type . '_per_page'
        ]
    );

    $bulk_counts = [
        'updated'   => isset( $_REQUEST['updated'] ) ? absint( $_REQUEST['updated'] ) : 0,
        'locked'    => isset( $_REQUEST['locked'] ) ? absint( $_REQUEST['locked'] ) : 0,
        'deleted'   => isset( $_REQUEST['deleted'] ) ? absint( $_REQUEST['deleted'] ) : 0,
        'trashed'   => isset( $_REQUEST['trashed'] ) ? absint( $_REQUEST['trashed'] ) : 0,
        'untrashed' => isset( $_REQUEST['untrashed'] ) ? absint( $_REQUEST['untrashed'] ) : 0
    ];

    $bulk_messages         = [];
    $bulk_messages['post'] = [
        /* translators: %s: Number of posts. */
        'updated'   => _n( '%s post updated.', '%s posts updated.', $bulk_counts['updated'] ),
        'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 post not updated, somebody is editing it.' ) :
        /* translators: %s: Number of posts. */
        _n( '%s post not updated, somebody is editing it.', '%s posts not updated, somebody is editing them.', $bulk_counts['locked'] ),
        /* translators: %s: Number of posts. */
        'deleted'   => _n( '%s post permanently deleted.', '%s posts permanently deleted.', $bulk_counts['deleted'] ),
        /* translators: %s: Number of posts. */
        'trashed'   => _n( '%s post moved to the Trash.', '%s posts moved to the Trash.', $bulk_counts['trashed'] ),
        /* translators: %s: Number of posts. */
        'untrashed' => _n( '%s post restored from the Trash.', '%s posts restored from the Trash.', $bulk_counts['untrashed'] )
    ];
    $bulk_messages['page'] = [
        /* translators: %s: Number of pages. */
        'updated'   => _n( '%s page updated.', '%s pages updated.', $bulk_counts['updated'] ),
        'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 page not updated, somebody is editing it.' ) :
        /* translators: %s: Number of pages. */
        _n( '%s page not updated, somebody is editing it.', '%s pages not updated, somebody is editing them.', $bulk_counts['locked'] ),
        /* translators: %s: Number of pages. */
        'deleted'   => _n( '%s page permanently deleted.', '%s pages permanently deleted.', $bulk_counts['deleted'] ),
        /* translators: %s: Number of pages. */
        'trashed'   => _n( '%s page moved to the Trash.', '%s pages moved to the Trash.', $bulk_counts['trashed'] ),
        /* translators: %s: Number of pages. */
        'untrashed' => _n( '%s page restored from the Trash.', '%s pages restored from the Trash.', $bulk_counts['untrashed'] )
    ];
    $bulk_messages['wp_block'] = [
        /* translators: %s: Number of blocks. */
        'updated'   => _n( '%s block updated.', '%s blocks updated.', $bulk_counts['updated'] ),
        'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 block not updated, somebody is editing it.' ) :
        /* translators: %s: Number of blocks. */
        _n( '%s block not updated, somebody is editing it.', '%s blocks not updated, somebody is editing them.', $bulk_counts['locked'] ),
        /* translators: %s: Number of blocks. */
        'deleted'   => _n( '%s block permanently deleted.', '%s blocks permanently deleted.', $bulk_counts['deleted'] ),
        /* translators: %s: Number of blocks. */
        'trashed'   => _n( '%s block moved to the Trash.', '%s blocks moved to the Trash.', $bulk_counts['trashed'] ),
        /* translators: %s: Number of blocks. */
        'untrashed' => _n( '%s block restored from the Trash.', '%s blocks restored from the Trash.', $bulk_counts['untrashed'] )
    ];

    /**
     * Filters the bulk action updated messages.
     *
     * By default, custom post types use the messages for the 'post' post type.
     *
     * @since 3.7.0
     *
     * @param array[] $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
     *                               keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
     * @param int[]   $bulk_counts   Array of item counts for each message, used to build internationalized strings.
     */
    $bulk_messages = apply_filters( 'bulk_post_updated_messages', $bulk_messages, $bulk_counts );
    $bulk_counts   = array_filter( $bulk_counts );

    // If we have a bulk message to issue:
    $messages = [];
    foreach ( $bulk_counts as $message => $count ) {
        if ( isset( $bulk_messages[$post_type][$message] ) ) {
            $messages[] = sprintf( $bulk_messages[$post_type][$message], number_format_i18n( $count ) );
        } elseif ( isset( $bulk_messages['post'][$message] ) ) {
            $messages[] = sprintf( $bulk_messages['post'][$message], number_format_i18n( $count ) );
        }

        if ( 'trashed' === $message && isset( $_REQUEST['ids'] ) ) {
            $ids        = preg_replace( '/[^0-9,]/', '', $_REQUEST['ids'] );
            $messages[] = '<a href="' . esc_url( wp_nonce_url( "admin.php?page=betterdocs-admin&doaction=undo&action=untrash&ids=$ids", 'bulk-posts' ) ) . '">' . __( 'Undo' ) . '</a>';
        }

        if ( 'untrashed' === $message && isset( $_REQUEST['ids'] ) ) {
            $ids = explode( ',', $_REQUEST['ids'] );

            if ( 1 === count( $ids ) && current_user_can( 'edit_post', $ids[0] ) ) {
                $messages[] = sprintf(
                    '<a href="%1$s">%2$s</a>',
                    esc_url( get_edit_post_link( $ids[0] ) ),
                    esc_html( get_post_type_object( get_post_type( $ids[0] ) )->labels->edit_item )
                );
            }
        }
    }

    if ( $messages ) {
        echo '<div id="message" class="updated notice is-dismissible"><p>' . implode( ' ', $messages ) . '</p></div>';
    }
    unset( $messages );

    $_SERVER['REQUEST_URI'] = remove_query_arg( ['locked', 'skipped', 'updated', 'deleted', 'trashed', 'untrashed'], $_SERVER['REQUEST_URI'] );

    $wp_list_table->display();

    if ( $wp_list_table->has_items() ) {
        $wp_list_table->inline_edit();
    }
?>
<div id="ajax-response"></div>
<div class="clear"></div>
