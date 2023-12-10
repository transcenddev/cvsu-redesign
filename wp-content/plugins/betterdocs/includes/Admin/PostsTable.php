<?php
    namespace WPDeveloper\BetterDocs\Admin;

    use DateTime;
    use WP_Post;
use WP_Query;
use WP_Posts_List_Table;

    class PostsTable extends WP_Posts_List_Table {

        public function __construct( $args = [] ) {
            parent::__construct( $args );

            $screen       = get_current_screen();
            $this->screen = convert_to_screen( $screen );

            add_filter( 'post_column_taxonomy_links', [$this, 'column_taxonomy_links'], 11, 3 );
        }

        public function column_taxonomy_links( $term_links, $taxonomy, $terms ) {

            if ( $taxonomy !== 'doc_category' ) {
                return $term_links;
            }

            $term_links = [];

            if ( ! empty( $terms ) ) {
                $taxonomy_object = get_taxonomy( $taxonomy );

                foreach ( $terms as $t ) {
                    $posts_in_term_qv = [];

                    if ( $taxonomy_object->query_var ) {
                        $posts_in_term_qv[$taxonomy_object->query_var] = $t->slug;
                    } else {
                        $posts_in_term_qv['taxonomy'] = $taxonomy;
                        $posts_in_term_qv['term']     = $t->slug;
                    }

                    $label = esc_html( sanitize_term_field( 'name', $t->name, $t->term_id, $taxonomy, 'display' ) );

                    $term_links[] = $this->get_edit_link( $posts_in_term_qv, $label );
                }
            }

            return $term_links;
        }

        /**
         * Helper to create links to edit.php with params.
         *
         * @since 4.4.0
         *
         * @param string[] $args  Associative array of URL parameters for the link.
         * @param string   $label Link text.
         * @param string   $class Optional. Class attribute. Default empty string.
         * @return string The formatted link string.
         */
        protected function get_edit_link( $args, $label, $class = '' ) {
            global $current;

            $url = add_query_arg( $args, 'admin.php?page=betterdocs-admin' );

            $class_html   = '';
            $aria_current = '';

            if ( ! empty( $class ) ) {
                $class_html = sprintf(
                    ' class="%s"',
                    esc_attr( $class )
                );

                if ( 'current' === $class ) {
                    $aria_current = ' aria-current="page"';
                }
            }

            return sprintf(
                '<a href="%s"%s%s>%s</a>',
                esc_url( $url ),
                $class_html,
                $aria_current,
                $label
            );
        }

        public function docs_wp_query( $per_page ) {
            $paged = isset( $_REQUEST['paged'] ) ? $_REQUEST['paged'] : 1;
            $args  = [
                'post_type'      => 'docs',
                'posts_per_page' => $per_page,
                'orderby'        => 'date',
                'paged'          => $paged
            ];

            if ( isset( $_GET['s'] ) && strlen( $_GET['s'] ) ) {
                $args['s'] = $_GET['s'];
            }

            if ( isset( $_GET['order'] ) && $_GET['order'] === 'ASC' ) {
                $args['order'] = 'ASC';
            } else {
                $args['order'] = 'DESC';
            }

            if ( isset( $_GET['author'] ) && $_GET['author'] != 'all' ) {
                $args['author'] = $_GET['author'];
            }

            if ( isset( $_GET['post_status'] ) ) {
                $args['post_status'] = $_GET['post_status'];
            }

            if ( isset( $_GET['view'] ) && ! empty( $_GET['view'] ) ) {
                $args['meta_key'] = '_betterdocs_meta_views';
                $args['orderby']  = 'meta_value_num';
                if ( $_GET['view'] === 'most_viewed' ) {
                    $args['order'] = 'DESC';
                } else if ( $_GET['view'] === 'least_viewed' ) {
                    $args['order'] = 'ASC';
                }
            }

            if ( isset( $_GET['date'] ) && ! empty( $_GET['date'] ) ) {
                $args['orderby'] = $_GET['date'];
                if ( $_GET['date'] === 'most_recent' ) {
                    $args['order'] = 'DESC';
                } else if ( $_GET['date'] === 'least_recent' ) {
                    $args['order'] = 'ASC';
                } else if ( $_GET['date'] === 'custom_date' ) {
                    $after      = $before      = '';
                    $date_range = explode( '-', $_GET['date_range'] );

                    if ( is_array( $date_range ) && array_key_exists( 0, $date_range ) ) {
                        $after = rtrim( $date_range[0] );
                    }

                    if ( is_array( $date_range ) && array_key_exists( 1, $date_range ) ) {
                        $before = ltrim( $date_range[1] );
                    }

                    $start_date = new DateTime( $after );
                    $end_date   = new DateTime( $before );

                    if ( $after === $before ) {
                        $start_date         = $start_date->format( 'Ymd' );
                        $args['date_query'] = [
                            [
                                'year'  => substr( $start_date, 0, 4 ),
                                'month' => substr( $start_date, 4, 2 ),
                                'day'   => substr( $start_date, 6, 2 )
                            ]
                        ];
                    } else {
                        $start_date         = $start_date->modify( '-1 day' );
                        $end_date           = $end_date->modify( '+1 day' );
                        $args['date_query'] = [
                            [
                                'after'     => $start_date->format( 'M d, Y' ),
                                'before'    => $end_date->format( 'M d, Y' ),
                                'inclusive' => true
                            ]
                        ];
                    }
                }
            }

            $args['tax_query'] = [
                'relation' => 'AND'
            ];

            if ( isset( $_GET['doc_category'] ) && ! empty( $_GET['doc_category'] ) && ( $_GET['doc_category'] != 'all' ) ) {
                $args['tax_query'][] = [
                    'taxonomy'         => 'doc_category',
                    'field'            => 'slug',
                    'operator'         => 'IN',
                    'terms'            => [$_GET['doc_category']],
                    'include_children' => true
                ];
            }

            if ( isset( $_GET['knowledgebase'] ) && ! empty( $_GET['knowledgebase'] ) && ( $_GET['knowledgebase'] != 'all' ) ) {
                $args['tax_query'][] = [
                    'taxonomy'         => 'knowledge_base',
                    'field'            => 'slug',
                    'terms'            => [$_GET['knowledgebase']],
                    'operator'         => 'IN',
                    'include_children' => true
                ];
            }

            return new WP_Query( $args );
        }

        /**
         * @global string   $mode             List table view mode.
         * @global array    $avail_post_stati
         * @global WP_Query $wp_query         WordPress Query object.
         * @global int      $per_page
         */
        public function prepare_items() {
            global $mode, $avail_post_stati, $wp_query, $per_page;

            $wp_query = $this->docs_wp_query( $per_page );
            if ( ! empty( $_REQUEST['mode'] ) ) {
                $mode = 'excerpt' === $_REQUEST['mode'] ? 'excerpt' : 'list';
                set_user_setting( 'posts_list_mode', $mode );
            } else {
                $mode = get_user_setting( 'posts_list_mode', 'list' );
            }

            // Is going to call wp().
            $avail_post_stati = wp_edit_posts_query();

            $this->set_hierarchical_display( is_post_type_hierarchical( $this->screen->post_type ) && 'menu_order title' === $wp_query->query['orderby'] );

            $post_type = $this->screen->post_type;
            $per_page  = $this->get_items_per_page( 'edit_' . $post_type . '_per_page' );

            /** This filter is documented in wp-admin/includes/post.php */
            $per_page = apply_filters( 'edit_posts_per_page', $per_page, $post_type );

            if ( $this->hierarchical_display ) {
                $total_items = $wp_query->post_count;
            } elseif ( $wp_query->found_posts || $this->get_pagenum() === 1 ) {
                $total_items = $wp_query->found_posts;
            } else {
                $post_counts = (array) wp_count_posts( $post_type, 'readable' );

                if ( isset( $_REQUEST['post_status'] ) && in_array( $_REQUEST['post_status'], $avail_post_stati, true ) ) {
                    $total_items = $post_counts[$_REQUEST['post_status']];
                } elseif ( isset( $_REQUEST['show_sticky'] ) && $_REQUEST['show_sticky'] ) {
                    $total_items = $this->sticky_posts_count;
                } elseif ( isset( $_GET['author'] ) && get_current_user_id() == $_GET['author'] ) {
                    $total_items = $this->user_posts_count;
                } else {
                    $total_items = array_sum( $post_counts );

                    // Subtract post types that are not included in the admin all list.
                    foreach ( get_post_stati( ['show_in_admin_all_list' => false] ) as $state ) {
                        $total_items -= $post_counts[$state];
                    }
                }
            }

            $this->is_trash = isset( $_REQUEST['post_status'] ) && 'trash' === $_REQUEST['post_status'];

            $this->set_pagination_args(
                [
                    'total_items' => $total_items,
                    'per_page'    => $per_page
                ]
            );
        }

        /**
         * Displays the table.
         *
         */
        public function display() {
            $singular = $this->_args['singular'];
            $this->screen->render_screen_reader_content( 'heading_list' );
        ?>
        <table class="<?php echo implode( ' ', $this->get_table_classes() ); ?> wp-list-table">
            <thead>
            <tr>
                <?php $this->print_column_headers();?>
            </tr>
            </thead>

            <tbody id="the-list"
                <?php
                    if ( $singular ) {
                                echo " data-wp-lists='list:$singular'";
                            }
                        ?>
            >
            <?php $this->display_rows_or_placeholder();?>
            </tbody>

        </table>
        <?php
            $this->display_tablenav( 'bottom' );
                }

                /**
                 * Generates the table navigation above or below the table
                 *
                 * @param string $which
                 */
                protected function display_tablenav( $which ) {
                    if ( 'top' === $which ) {
                        wp_nonce_field( 'bulk-' . $this->_args['plural'] );
                    }
                ?>
        <div class="tablenav <?php echo esc_attr( $which ); ?>">
            <?php
                $this->extra_tablenav( $which );
                        $this->pagination( $which );
                    ?>
            <br class="clear" />
        </div>
        <?php
            }

                /**
                 * @global WP_Query $wp_query WordPress Query object.
                 * @global int $per_page
                 * @param array $posts
                 * @param int   $level
                 */
                public function display_rows( $posts = [], $level = 0 ) {
                    global $wp_query, $per_page;
                    $wp_query = $this->docs_wp_query( $per_page );

                    $posts = $wp_query->posts;

                    add_filter( 'the_title', 'esc_html' );

                    if ( $this->hierarchical_display ) {
                        $this->_display_rows_hierarchical( $posts, $this->get_pagenum(), $per_page );
                    } else {
                        $this->_display_rows( $posts, $level );
                    }
                }

                /**
                 * @param array $posts
                 * @param int   $level
                 */
                private function _display_rows( $posts, $level = 0 ) {
                    $post_type = 'docs';

                    // Create array of post IDs.
                    $post_ids = [];

                    foreach ( $posts as $a_post ) {
                        $post_ids[] = $a_post->ID;
                    }

                    if ( post_type_supports( $post_type, 'comments' ) ) {
                        $this->comment_pending_count = get_pending_comments_num( $post_ids );
                    }

                    foreach ( $posts as $post ) {
                        $this->single_row( $post, $level );
                    }
                }

                /**
                 * @since 4.3.0
                 *
                 * @param WP_Post $post
                 */
                public function custom_column_title( $post ) {
                    echo $this->column_title( $post );
                }

                /**
                 * Generates and displays row action links.
                 *
                 * @since 4.3.0
                 *
                 * @param WP_Post $post        Post being acted upon.
                 * @return string Row actions output for posts, or an empty string
                 *                if the current column is not the primary column.
                 */
                public function custom_row_actions( $post ) {
                    $post_type_object = get_post_type_object( 'docs' );
                    $can_edit_post    = current_user_can( 'edit_post', $post->ID );
                    $actions          = [];
                    $title            = _draft_or_post_title();

                    if ( $can_edit_post && 'trash' !== $post->post_status ) {
                        $actions['edit'] = sprintf(
                            '<a href="%s" aria-label="%s">%s</a>',
                            get_edit_post_link( $post->ID ),
                            /* translators: %s: Post title. */
                            esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;' ), $title ) ),
                            __( 'Edit' )
                        );

                        if ( 'wp_block' !== $post->post_type ) {
                            $actions['inline hide-if-no-js'] = sprintf(
                                '<button type="button" class="button-link editinline" aria-label="%s" aria-expanded="false">%s</button>',
                                /* translators: %s: Post title. */
                                esc_attr( sprintf( __( 'Quick edit &#8220;%s&#8221; inline' ), $title ) ),
                                __( 'Quick&nbsp;Edit' )
                            );
                        }
                    }

                    if ( current_user_can( 'delete_post', $post->ID ) ) {
                        if ( 'trash' === $post->post_status ) {
                            $actions['untrash'] = sprintf(
                                '<a href="%s" aria-label="%s">%s</a>',
                                wp_nonce_url( admin_url( sprintf( $post_type_object->_edit_link . '&amp;action=untrash', $post->ID ) ), 'untrash-post_' . $post->ID ),
                                /* translators: %s: Post title. */
                                esc_attr( sprintf( __( 'Restore &#8220;%s&#8221; from the Trash' ), $title ) ),
                                __( 'Restore' )
                            );
                        } elseif ( EMPTY_TRASH_DAYS ) {
                            $actions['trash'] = sprintf(
                                '<a href="%s" class="submitdelete" aria-label="%s">%s</a>',
                                get_delete_post_link( $post->ID ),
                                /* translators: %s: Post title. */
                                esc_attr( sprintf( __( 'Move &#8220;%s&#8221; to the Trash' ), $title ) ),
                                _x( 'Trash', 'verb' )
                            );
                        }
                        if ( 'trash' === $post->post_status || ! EMPTY_TRASH_DAYS ) {
                            $actions['delete'] = sprintf(
                                '<a href="%s" class="submitdelete" aria-label="%s">%s</a>',
                                get_delete_post_link( $post->ID, '', true ),
                                /* translators: %s: Post title. */
                                esc_attr( sprintf( __( 'Delete &#8220;%s&#8221; permanently' ), $title ) ),
                                __( 'Delete Permanently' )
                            );
                        }
                    }

                    if ( is_post_type_viewable( $post_type_object ) ) {
                        if ( in_array( $post->post_status, ['pending', 'draft', 'future'], true ) ) {
                            if ( $can_edit_post ) {
                                $preview_link    = get_preview_post_link( $post );
                                $actions['view'] = sprintf(
                                    '<a href="%s" rel="bookmark" aria-label="%s">%s</a>',
                                    esc_url( $preview_link ),
                                    /* translators: %s: Post title. */
                                    esc_attr( sprintf( __( 'Preview &#8220;%s&#8221;' ), $title ) ),
                                    __( 'Preview' )
                                );
                            }
                        } elseif ( 'trash' !== $post->post_status ) {
                            $actions['view'] = sprintf(
                                '<a href="%s" rel="bookmark" aria-label="%s">%s</a>',
                                get_permalink( $post->ID ),
                                /* translators: %s: Post title. */
                                esc_attr( sprintf( __( 'View &#8220;%s&#8221;' ), $title ) ),
                                __( 'View' )
                            );
                        }
                    }

                    if ( 'wp_block' === $post->post_type ) {
                        $actions['export'] = sprintf(
                            '<button type="button" class="wp-list-reusable-blocks__export button-link" data-id="%s" aria-label="%s">%s</button>',
                            $post->ID,
                            /* translators: %s: Post title. */
                            esc_attr( sprintf( __( 'Export &#8220;%s&#8221; as JSON' ), $title ) ),
                            __( 'Export as JSON' )
                        );
                    }

                    if ( is_post_type_hierarchical( $post->post_type ) ) {
                        /**
                         * Filters the array of row action links on the Pages list table.
                         *
                         * The filter is evaluated only for hierarchical post types.
                         *
                         * @since 2.8.0
                         *
                         * @param string[] $actions An array of row action links. Defaults are
                         *                          'Edit', 'Quick Edit', 'Restore', 'Trash',
                         *                          'Delete Permanently', 'Preview', and 'View'.
                         * @param WP_Post  $post    The post object.
                         */
                        $actions = apply_filters( 'page_row_actions', $actions, $post );
                    } else {

                        /**
                         * Filters the array of row action links on the Posts list table.
                         *
                         * The filter is evaluated only for non-hierarchical post types.
                         *
                         * @since 2.8.0
                         *
                         * @param string[] $actions An array of row action links. Defaults are
                         *                          'Edit', 'Quick Edit', 'Restore', 'Trash',
                         *                          'Delete Permanently', 'Preview', and 'View'.
                         * @param WP_Post  $post    The post object.
                         */
                        $actions = apply_filters( 'post_row_actions', $actions, $post );
                    }

                    return $this->row_actions( $actions );
                }
        }
