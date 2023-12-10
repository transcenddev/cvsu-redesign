<?php

namespace WPDeveloper\BetterDocs\Shortcodes;

use WPDeveloper\BetterDocs\Core\Shortcode;

class FaqList extends Shortcode {
    protected $layout = 'modern';
    protected $icon_hook = 'betterdocs_faq_post_after';

    public function get_name() {
        return 'betterdocs_faq_list_modern';
    }

    public function get_style_depends() {
        return ['betterdocs-faq'];
    }

    public function get_script_depends() {
        return ['betterdocs-faq'];
    }

    protected $map_view_vars = [
        'class' => 'faq_heading_class'
    ];

    /**
     * Summary of default_attributes
     * @return array
     */
    public function default_attributes() {
        return [
            'groups'        => '',
            'class'         => '',
            'group_exclude' => '',
            'faq_heading'   => __( 'Frequently Asked Questions', 'betterdocs' ),
            'faq_schema'	=> false
        ];
    }

    public function icons() {
        $faq_markup = '<svg class="betterdocs-faq-iconminus" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2"><g fill="none" stroke="#528ffe" stroke-linecap="round" stroke-miterlimit="10" stroke-linejoin="round"><path d="M17 12H7"></path><circle cx="12" cy="12" r="11"></circle></g></svg>';
        $faq_markup .= '<svg class="betterdocs-faq-iconplus" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-width="2" fill="none" stroke="#528ffe" stroke-linecap="square" stroke-miterlimit="10"><path d="M12 7v10M17 12H7"></path><circle cx="12" cy="12" r="11"></circle></g></svg>';

        echo $faq_markup;
    }

    public function render( $atts, $content = null ) {
        add_action( $this->icon_hook, [$this, 'icons'] );

        $this->views( 'shortcodes/faq' );

        remove_action( $this->icon_hook, [$this, 'icons'] );
    }

    public function view_params() {
        $terms_query = $this->query->faq_terms_query_args( $this->attributes['groups'], $this->attributes['group_exclude'] );

        $wrapper_attr = [
            'class' => [
                'betterdocs-faq-wrapper',
                'layout-' . $this->layout,
                $this->attributes['class'],
            ]
        ];

        return wp_parse_args( [
            'wrapper_attr'     => $wrapper_attr,
            'widget'           => $this,
            'layout'           => 'list',
            'terms_query_args' => $terms_query
        ] );
    }
}
