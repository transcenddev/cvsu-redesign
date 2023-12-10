<?php

namespace WPDeveloper\BetterDocs\REST;
use WPDeveloper\BetterDocs\Core\BaseAPI;

class CategoryField extends BaseAPI {
    /**
     * @return mixed
     */
    public function register() {
        $this->register_field( 'doc_category', 'thumbnail', [
            'get_callback' => [$this, 'thumbnail_image']
        ] );
    }

    public function thumbnail_image( $object ) {
        $attachment_id = get_term_meta( $object['id'], 'doc_category_image-id', true );
        if ( ! $attachment_id ) {
            return;
        }

        return wp_get_attachment_url( $attachment_id );
    }
}
