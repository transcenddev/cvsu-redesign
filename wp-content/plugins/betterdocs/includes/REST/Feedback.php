<?php

namespace WPDeveloper\BetterDocs\REST;
use WP_REST_Request;
use WPDeveloper\BetterDocs\Core\BaseAPI;

class Feedback extends BaseAPI {
    /**
     * @return mixed
     */
    public function register() {
        $this->post( '/feedback/(?P<id>\d+)', [$this, 'save'], [
            'id'       => [
                'type'              => 'integer',
                'validate_callback' => function ( $param, $request, $key ) {
                    return ! empty( $param ) && is_numeric( $param ) && get_post( $param ) !== null;
                },
                'required'          => false,
                'default'           => null
            ],
            'feelings' => [
                'type'              => 'string',
                'validate_callback' => function ( $param, $request, $key ) {
                    $allowed_feelings = [ 'happy', 'sad', 'normal' ];
                    return in_array( $param, $allowed_feelings );
                },
                'required'          => true
            ]
        ] );
    }

    public function save( WP_REST_Request $request ) {
        global $wpdb;
        $docs_id  = isset( $request['id'] ) ? esc_sql( intval( $request['id'] ) ) : null;
        $feelings = isset( $request['feelings'] ) ? esc_sql( $request['feelings'] ) : 'happy';
        if ( $docs_id !== null && get_post( $docs_id ) && get_option( 'betterdocs_pro_db_version' ) == true ) {
            $post_id = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT *
                    FROM {$wpdb->prefix}betterdocs_analytics
                    WHERE created_at = %s AND post_id = %d",
                    date( 'Y-m-d' ),
                    $docs_id
                )
            );

            if ( ! empty( $post_id ) ) {
                $feelings_increment = $post_id[0]->{$feelings}+1;

                $insert = $wpdb->query(
                    $wpdb->prepare(
                        "UPDATE {$wpdb->prefix}betterdocs_analytics
                    SET " . $feelings . " = " . $feelings_increment . "
                    WHERE created_at = %s AND post_id = %d",
                        [
                            date( 'Y-m-d' ),
                            $docs_id
                        ]
                    )
                );
            } else {
                $insert = $wpdb->query(
                    $wpdb->prepare(
                        "INSERT INTO {$wpdb->prefix}betterdocs_analytics
                        ( post_id, " . $request['feelings'] . ", created_at )
                        VALUES ( %d, %d, %s )",
                        [
                            $docs_id,
                            1,
                            date( 'Y-m-d' )
                        ]
                    )
                );
            }

            if ( $insert == true ) {
                return true;
            }
        }
        return false;
    }
}
