<?php

namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks;

use WPDeveloper\BetterDocs\Editors\BlockEditor\Block;
use WPDeveloper\BetterDocs\Traits\SocialShare as SocialShareTrait;

class SocialShare extends Block {
    use SocialShareTrait;
    protected $map_view_vars = [
        'share_title' => 'title'
    ];

    protected $editor_styles = [
        'betterdocs-social-share'
    ];

    protected $frontend_styles = [
        'betterdocs-social-share'
    ];

    public function get_name() {
        return 'social-share';
    }

    public function get_default_attributes() {
        return [
            'show_facebook_icon'  => true,
            'show_twitter_icon'   => true,
            'show_linkedin_icon'  => true,
            'show_pinterest_icon' => true,
            'share_title'         => __( 'Share This Article: ', 'betterdocs' )
        ];
    }

    protected $deprecated_attributes = [
        'show_facebook_icon'  => 'facebook',
        'show_pinterest_icon' => 'pinterest',
        'show_twitter_icon'   => 'twitter',
        'show_linkedin_icon'  => 'linkedin'
    ];

    public function render( $attributes, $content ) {
        $this->views( 'widgets/social' );
    }
}
