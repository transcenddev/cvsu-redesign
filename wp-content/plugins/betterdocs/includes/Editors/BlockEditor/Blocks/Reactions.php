<?php

namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks;

use WPDeveloper\BetterDocs\Editors\BlockEditor\Block;

class Reactions extends Block {
    public $view_wrapper = 'betterdocs-article-reactions';

    protected $editor_scripts = [
        'betterdocs-reactions'
    ];

    protected $editor_styles = [
        'betterdocs-reactions'
    ];

    protected $frontend_scripts = [
        'betterdocs-reactions'
    ];
    protected $frontend_styles = [
        'betterdocs-reactions'
    ];

    public function get_name() {
        return 'reactions';
    }

    public function get_default_attributes() {
        return [
            'reaction_text' => __( 'What are your feelings', 'betterdocs' )
        ];
    }

    public function render( $attributes, $content ) {
        $this->views( 'widgets/reactions' );
    }

    public function view_params() {
        return [
            'reactions_text' => $this->attributes['reaction_text']
        ];
    }
}
