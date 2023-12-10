<?php
namespace WPDeveloper\BetterDocs\Editors\Elementor\Widget;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use WPDeveloper\BetterDocs\Editors\Elementor\BaseWidget;

class Navigation extends BaseWidget {

    public function get_name() {
        return 'betterdocs-navigation';
    }

    public function get_title() {
        return __( 'Doc Navigation', 'betterdocs' );
    }

    public function get_icon() {
        return 'betterdocs-icon-Navigation';
    }

    public function get_categories() {
        return ['betterdocs-elements-single'];
    }

    public function get_keywords() {
        return ['betterdocs-elements', 'navigation', 'betterdocs', 'docs'];
    }

    public function get_style_depends() {
        return ['betterdocs-el-navigation'];
    }

    public function get_custom_help_url() {
        return 'https://betterdocs.co/docs/single-doc-in-elementor';
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_column_settings',
            [
                'label' => __( 'Style', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'navigation_text_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .docs-navigation a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'navigation_text_typography',
                'selector' => '{{WRAPPER}} .docs-navigation a'
            ]
        );

        $this->add_control(
            'navigation_arrow_size',
            [
                'label'      => __( 'Size', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => 'px',
                    'size' => 35
                ],
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'max'  => 500,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .docs-navigation svg' => 'width: {{SIZE}}px;height: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_control(
            'navigation_arrow_color',
            [
                'label'     => esc_html__( 'Arrow Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .docs-navigation svg' => 'fill: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render_callback() {
        $this->views( 'templates/parts/navigation' );
    }

    public function view_params() {
        return [
            'wrapper_attr' => [
                'class' => ['betterdocs-elementor-navigation']
            ]
        ];
    }
}
