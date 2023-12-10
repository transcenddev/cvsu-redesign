<?php
namespace WPDeveloper\BetterDocs\Traits;

trait SocialShare {
    public $view_wrapper = 'betterdocs-social-share';

    public function generate_links() {
        $_permalink = get_the_permalink();

        $_defaults = [
            'facebook'  => [
                'alt'  => 'Facebook',
                'icon' => betterdocs()->assets->icon( 'social/facebook.svg' ),
                'link' => 'https://www.facebook.com/sharer/sharer.php?u=' . $_permalink
            ],
            'twitter'   => [
                'alt'  => 'Twitter',
                'icon' => betterdocs()->assets->icon( 'social/twitter.svg' ),
                'link' => 'https://twitter.com/intent/tweet?url=' . $_permalink
            ],
            'linkedin'  => [
                'alt'  => 'LinkedIn',
                'icon' => betterdocs()->assets->icon( 'social/linkedin.svg' ),
                'link' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . $_permalink
            ],
            'pinterest' => [
                'alt'  => 'Pinterest',
                'icon' => betterdocs()->assets->icon( 'social/pinterest.svg' ),
                'link' => 'https://pinterest.com/pin/create/button/?url=' . $_permalink
            ]
        ];

        return array_filter( $_defaults, function ( $key ) {
            return array_key_exists( $key, $this->attributes ) && (bool) filter_var( $this->attributes[$key], FILTER_VALIDATE_BOOLEAN );
        }, ARRAY_FILTER_USE_KEY );
    }

    public function view_params() {
        $links                     = $this->generate_links();
        $this->attributes['links'] = $links;

        return [
            'links' => $links
        ];
    }
}
