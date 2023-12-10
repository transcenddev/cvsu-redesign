<?php

namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks;

use WPDeveloper\BetterDocs\Editors\BlockEditor\Block;

class FeedbackForm extends Block {

    public $view_wrapper = 'feedback-form';

    protected $editor_styles = [
        'betterdocs-fontawesome',
        'betterdocs-feedback-form',
        'betterdocs-feedback-form-editor'
    ];

    protected $frontend_styles = [
        'betterdocs-fontawesome',
        'betterdocs-feedback-form'
    ];

    public function get_name() {
        return 'feedback-form';
    }

    public function get_default_attributes() {
        return [
            'blockId'     => '',
            'buttonText'  => __( 'Submit', 'betterdocs' ),
            'formContent' => __( 'Still stuck? How can we help?', 'betterdocs' ),
            'formTitle'   => __( 'How can we help?', 'betterdocs' )
        ];
    }

    public function render( $attributes, $content ) {
        $this->views( 'widgets/feedback-form' );
    }
}
