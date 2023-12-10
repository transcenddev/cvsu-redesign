<?php
namespace WPDeveloper\BetterDocs\Editors\Elementor\Widget;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use WPDeveloper\BetterDocs\Editors\Elementor\BaseWidget;

class Breadcrumbs extends BaseWidget {

    public function get_name() {
        return 'betterdocs-breadcrumb';
    }

    public function get_title() {
        return __( 'Doc Breadcrumbs', 'betterdocs' );
    }

    public function get_icon() {
        return 'betterdocs-icon-Breadcrumbs';
    }

    public function get_keywords() {
        return ['betterdocs-elements', 'breadcrumbs', 'internal links', 'docs', 'betterdocs'];
    }

    public function get_custom_help_url() {
        return 'https://betterdocs.co/docs/single-doc-in-elementor';
    }

    public function get_categories() {
        return ['betterdocs-elements', 'betterdocs-elements-single', 'docs-archive'];
    }

    public function get_style_depends() {
        return ['betterdocs-breadcrumb'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_betterdocs_breadcrumbs_style',
            [
                'label' => __( 'Style', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'     => __( 'Text Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-breadcrumb .betterdocs-breadcrumb-item > a' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'selector' => '{{WRAPPER}} .betterdocs-breadcrumb .betterdocs-breadcrumb-item a,{{WRAPPER}} .betterdocs-breadcrumb .betterdocs-breadcrumb-item span'
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'     => __( 'Alignment', 'betterdocs' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => __( 'Left', 'betterdocs' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title' => __( 'Center', 'betterdocs' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'flex-end'   => [
                        'title' => __( 'Right', 'betterdocs' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-breadcrumb .betterdocs-breadcrumb-list' => 'justify-content: {{VALUE}}'
                ]
            ]
        );

        $this->end_controls_section();

        $this->icon_style();
    }

    public function icon_style() {
        /**
         * ----------------------------------------------------------
         * Section: Icon Style
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'section_article_settings',
            [
                'label' => __( 'Icon', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'breadcrumbs_icon_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-breadcrumb .breadcrumb-delimiter' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'breadcrumbs_icon_size',
            [
                'label'      => __( 'Size', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    '%' => [
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-breadcrumb .breadcrumb-delimiter .breadcrumb-delimiter-icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section(); # end of 'Column Settings'
    }

    protected function render_callback() {
        $this->views( 'widgets/breadcrumbs' );
    }

    public function render_plain_content() {}
}
