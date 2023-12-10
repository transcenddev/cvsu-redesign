<?php

namespace WPDeveloper\BetterDocs\Shortcodes;
use WPDeveloper\BetterDocs\Core\Shortcode;

class Reactions extends Shortcode {
    public $view_wrapper = 'betterdocs-article-reactions';

    public function get_name() {
        return 'betterdocs_article_reactions';
    }

    public function get_style_depends() {
        return ['betterdocs-reactions'];
    }

    public function get_script_depends() {
        return ['betterdocs-reactions'];
    }

    /**
     * Summary of default_attributes
     * @return array
     */
    public function default_attributes() {
        return [
            'text' => ''
        ];
    }

    /**
     * Summary of render
     *
     * @param mixed $atts
     * @param mixed $content
     * @return mixed
     */
    public function render( $atts, $content = null ) {
        $this->views( 'widgets/reactions' );
    }

    public function view_params() {
        $reactions_text = ! empty( $this->attributes['text'] ) ? $this->attributes['text'] : $this->customizer->get(
            'betterdocs_post_reactions_text', __( 'What are your Feelings', 'betterdocs' )
        );

        return [
            'reactions_text' => $reactions_text
        ];
    }
}
