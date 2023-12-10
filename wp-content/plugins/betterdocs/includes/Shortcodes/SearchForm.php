<?php

namespace WPDeveloper\BetterDocs\Shortcodes;

use WPDeveloper\BetterDocs\Core\Query;
use WPDeveloper\BetterDocs\Utils\Helper;
use WPDeveloper\BetterDocs\Core\Settings;
use WPDeveloper\BetterDocs\Core\Shortcode;
use WPDeveloper\BetterDocs\Admin\Customizer\Defaults;

class SearchForm extends Shortcode {
    public function __construct( Settings $settings, Query $query, Helper $helper, Defaults $defaults ) {
        parent::__construct( $settings, $query, $helper, $defaults );

        add_action( 'wp_ajax_nopriv_betterdocs_get_search_result', [$this, 'get_search_results'] );
        add_action( 'wp_ajax_betterdocs_get_search_result', [$this, 'get_search_results'] );
    }

    public function get_style_depends() {
        return ['betterdocs-search'];
    }

    public function get_script_depends() {
        return ['betterdocs-search'];
    }

    public function get_search_results() {
        global $wpdb;
        $search_input = isset( $_POST['search_input'] ) ? sanitize_text_field( $_POST['search_input'] ) : '';
        $search_cat   = isset( $_POST['search_cat'] ) ? wp_strip_all_tags( $_POST['search_cat'] ) : '';
        $lang   = isset( $_POST['lang'] ) ? wp_strip_all_tags( $_POST['lang'] ) : '';
        $search_input = preg_replace( '/[^A-Za-z0-9_\- ][]]/', '', strtolower( $search_input ) );

        $tax_query = [];
        if ( $search_cat ) {
            $tax_query = [
                [
                    'taxonomy'         => 'doc_category',
                    'field'            => 'slug',
                    'terms'            => $search_cat,
                    'operator'         => 'AND',
                    'include_children' => true
                ]
            ];
        }

        $term = get_term_by( 'slug', $search_cat );

        $args = [
            'term_id'          => isset( $term->term_id ) ? $term->term_id : 0,
            'post_type'        => 'docs',
            'post_status'      => 'publish',
            'posts_per_page'   => -1,
            'suppress_filters' => true,
            's'                => $search_input,
            'tax_query'        => $tax_query
        ];

        if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
            $args['suppress_filters'] = false;
            $args['lang'] = ICL_LANGUAGE_CODE;
        }

        $search_results = $this->query->get_posts( $args );

        $response = [];

        ob_start();
        betterdocs()->views->get( 'shortcode-parts/search-results', [
            'search_results' => $search_results,
            'search_input'   => $search_input
        ] );

        $_output = ob_get_clean();

        $_input_not_found = '';
        if ( ! $search_results->have_posts() ) {
            $_input_not_found = $search_input;
        }

        $response['post_lists'] = $_output;

        if ( $_output && strlen( $search_input ) >= 3 ) {
            $this->insert( $search_input, $_input_not_found );
        }

        wp_reset_query();
        wp_reset_postdata();

        wp_send_json_success( $response );
    }

    private function insert( $search_input, $input_not_found ) {
        global $wpdb;
        $search = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT *
                FROM {$wpdb->prefix}betterdocs_search_keyword
                WHERE keyword = %s",
                $search_input
            )
        );

        if ( ! empty( $search ) ) {
            $search_log = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT *
                    FROM {$wpdb->prefix}betterdocs_search_log
                    WHERE created_at = %s AND keyword_id = %d",
                    date( 'Y-m-d' ), $search[0]->id
                )
            );

            if ( ! empty( $search_log ) ) {
                if ( ! empty( $input_not_found ) ) {
                    $tbl_field = 'not_found_count';
                    $count     = $search_log[0]->not_found_count + 1;
                } else {
                    $tbl_field = 'count';
                    $count     = $search_log[0]->count + 1;
                }
                $wpdb->query(
                    $wpdb->prepare(
                        "UPDATE {$wpdb->prefix}betterdocs_search_log
                        SET " . $tbl_field . " = " . $count . "
                        WHERE created_at = %s AND keyword_id = %d",
                        $search_log[0]->created_at, $search_log[0]->keyword_id
                    )
                );
            } else {
                if ( ! empty( $input_not_found ) ) {
                    $count           = 0;
                    $not_found_count = 1;
                } else {
                    $count           = 1;
                    $not_found_count = 0;
                }
                $wpdb->query(
                    $wpdb->prepare(
                        "INSERT INTO {$wpdb->prefix}betterdocs_search_log
                        ( keyword_id, count, not_found_count, created_at  )
                        VALUES ( %d, %d, %d, %s )",
                        [
                            $search[0]->id,
                            $count,
                            $not_found_count,
                            date( 'Y-m-d' )
                        ]
                    )
                );
            }
        } else {
            $insert = $wpdb->query(
                $wpdb->prepare(
                    "INSERT INTO {$wpdb->prefix}betterdocs_search_keyword
                    ( keyword )
                    VALUES ( %s )",
                    [
                        $search_input
                    ]
                )
            );

            if ( $insert ) {
                if ( ! empty( $input_not_found ) ) {
                    $count           = 0;
                    $not_found_count = 1;
                } else {
                    $count           = 1;
                    $not_found_count = 0;
                }
                $wpdb->query(
                    $wpdb->prepare(
                        "INSERT INTO {$wpdb->prefix}betterdocs_search_log
                        ( keyword_id, count, not_found_count, created_at )
                        VALUES ( %d, %d, %d, %s )",
                        [
                            $wpdb->insert_id,
                            $count,
                            $not_found_count,
                            date( 'Y-m-d' )
                        ]
                    )
                );
            }
        }
    }

    public function get_name() {
        return 'betterdocs_search_form';
    }

    /**
     * Summary of default_attributes
     * @return array
     */
    public function default_attributes() {
        return apply_filters( 'betterdocs_search_form_attr', [
            'placeholder'    => __( 'Search', 'betterdocs' ),
            'heading'        => '',
            'subheading'     => '',
            'heading_tag'    => 'h2',
            'subheading_tag' => 'h3'
        ] );
    }

    public function render( $atts, $content = null ) {
        $this->views( 'shortcodes/search' );
    }
}
