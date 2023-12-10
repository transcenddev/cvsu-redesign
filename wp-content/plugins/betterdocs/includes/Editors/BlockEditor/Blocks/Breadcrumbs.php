<?php

namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks;

use WPDeveloper\BetterDocs\Editors\BlockEditor\Block;

class Breadcrumbs extends Block {
    public function get_name() {
        return 'breadcrumb';
    }

    public function get_default_attributes() {
        return [
            'blockId' => ''
        ];
    }

    public function render( $attributes, $content ) {
        $this->views( 'widgets/breadcrumbs' );
    }

    public function view_params() {

    }
}
