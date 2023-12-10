<?php

namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks;

use WPDeveloper\BetterDocs\Editors\BlockEditor\Block;

class BetterdocsPrint extends Block {
    protected $editor_styles = [
        'betterdocs-single'
    ];

    protected $frontend_styles = [
        'betterdocs-single'
    ];

    protected $frontend_scripts = [
        'betterdocs'
    ];

    public function get_name() {
        return 'betterdocs-print';
    }

    public function get_default_attributes() {
        return [
            'blockId' => ''
        ];
    }

    public function render($attributes, $content) {
        $this->views('widgets/print-icon');
    }
}
