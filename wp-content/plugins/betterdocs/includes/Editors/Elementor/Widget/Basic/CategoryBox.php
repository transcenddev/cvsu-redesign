<?php
namespace WPDeveloper\BetterDocs\Editors\Elementor\Widget\Basic;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Plugin as ElementorPlugin;
use WPDeveloper\BetterDocs\Editors\Elementor\BaseWidget;
use WPDeveloper\BetterDocs\Editors\Elementor\Traits\TemplateQuery;
use WPDeveloper\BetterDocs\Traits\CategoryBox as CategoryBoxTraits;

class CategoryBox extends BaseWidget {
    use CategoryBoxTraits;
    use TemplateQuery;

    public function get_name() {
        return 'betterdocs-category-box';
    }

    public function get_title() {
        return __( 'BetterDocs Category Box', 'betterdocs' );
    }

    public function get_icon() {
        return 'betterdocs-icon-category-box';
    }

    public function get_categories() {
        return ['docs-archive', 'betterdocs-elements'];
    }

    public function get_style_depends() {
        return [
            'betterdocs-category-box',
            'betterdocs-el-category-box'
        ];
    }

    public function get_keywords() {
        return [
            'knowledgebase',
            'knowledge Base',
            'documentation',
            'doc',
            'kb',
            'betterdocs',
            'docs',
            'category-box'
        ];
    }

    public function get_custom_help_url() {
        return 'https://betterdocs.co/docs/betterdocs-category-box';
    }

    protected function layout_options() {
        $this->start_controls_section(
            'section_layout_options',
            [
                'label' => __( 'Layout Options', 'betterdocs' )
            ]
        );

        $this->add_control(
            'layout_template',
            [
                'label'       => __( 'Select Layout', 'betterdocs' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => betterdocs()->views->get_layouts( 'category-box' ),
                'default'     => betterdocs()->views->get_default_layout( 'category-box' ),
                'label_block' => true
            ]
        );

        $this->add_responsive_control(
            'box_column',
            [
                'label'              => __( 'Box Column', 'betterdocs' ),
                'type'               => Controls_Manager::SELECT,
                'default'            => '3',
                'tablet_default'     => '2',
                'mobile_default'     => '1',
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4'
                ],
                'prefix_class'       => 'elementor-grid%s-',
                'frontend_available' => true,
                'label_block'        => true,
                'condition'          => [
                    'layout_template' => ['layout-2', 'default']
                ],
                'selectors'          => [
                    '{{WRAPPER}} .betterdocs-elementor .betterdocs-category-box-inner-wrapper' => "--column: {{VALUE}};"
                ]
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label'        => __( 'Show Icon', 'betterdocs' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'betterdocs' ),
                'label_off'    => __( 'Hide', 'betterdocs' ),
                'return_value' => 'true',
                'default'      => 'true'
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label'        => __( 'Show Title', 'betterdocs' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'betterdocs' ),
                'label_off'    => __( 'Hide', 'betterdocs' ),
                'return_value' => 'true',
                'default'      => 'true'
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => __( 'Select Tag', 'betterdocs' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h2',
                'options'   => [
                    'h1'   => __( 'H1', 'betterdocs' ),
                    'h2'   => __( 'H2', 'betterdocs' ),
                    'h3'   => __( 'H3', 'betterdocs' ),
                    'h4'   => __( 'H4', 'betterdocs' ),
                    'h5'   => __( 'H5', 'betterdocs' ),
                    'h6'   => __( 'H6', 'betterdocs' ),
                    'span' => __( 'Span', 'betterdocs' ),
                    'p'    => __( 'P', 'betterdocs' ),
                    'div'  => __( 'Div', 'betterdocs' )
                ],
                'condition' => [
                    'show_title' => 'true'
                ]
            ]
        );

        $this->add_control(
            'show_count',
            [
                'label'        => __( 'Show Count', 'betterdocs' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'betterdocs' ),
                'label_off'    => __( 'Hide', 'betterdocs' ),
                'return_value' => 'true',
                'default'      => 'true'
            ]
        );

        $this->add_control(
            'listview-show-description',
            [
                'label'        => __( 'Show Category Description', 'betterdocs' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'betterdocs' ),
                'label_off'    => __( 'Hide', 'betterdocs' ),
                'return_value' => 'true',
                'default'      => 'true',
                'condition'    => [
                    'layout_template' => 'layout-3'
                ]
            ]
        );

        $this->add_control(
            'count_prefix',
            [
                'label'     => __( 'Prefix', 'betterdocs' ),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => ['active' => true],
                'condition' => [
                    'show_count'      => 'true',
                    'layout_template' => ['default', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'count_suffix',
            [
                'label'     => __( 'Suffix', 'betterdocs' ),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => ['active' => true],
                'default'   => __( 'articles', 'betterdocs' ),
                'condition' => [
                    'show_count'      => 'true',
                    'layout_template' => ['default', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'count_suffix_singular',
            [
                'label'     => __( 'Suffix Singular', 'betterdocs' ),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => ['active' => true],
                'default'   => __( 'article', 'betterdocs' ),
                'condition' => [
                    'show_count'      => 'true',
                    'layout_template' => ['default', 'layout-3']
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function box_style() {
        $this->start_controls_section(
            'section_card_settings',
            [
                'label'     => __( 'Box', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_template' => [
                        'layout-2',
                        'default'
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'column_space', // Legacy control id but new control
            [
                'label'      => __( 'Box Margin', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'column_padding',
            [
                'label'      => __( 'Box Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'layout_template!' => 'layout-2'
                ]
            ]
        );

        $this->start_controls_tabs( 'card_settings_tabs' );

        // Normal State Tab
        $this->start_controls_tab(
            'card_normal',
            ['label' => esc_html__( 'Normal', 'betterdocs' )]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'card_bg_normal',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'card_border_normal',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper'
            ]
        );

        $this->add_responsive_control(
            'card_border_radius_normal',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'card_box_shadow_normal',
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper'
            ]
        );

        $this->end_controls_tab();

        //Add Border Bottom Normal State
        $this->add_control(
            'category_box_border_bottom',
            [
                'label'        => __( 'Border Bottom', 'betterdocs' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'betterdocs' ),
                'label_off'    => __( 'Hide', 'betterdocs' ),
                'return_value' => 'true',
                'default'      => 'false',
                'condition'    => [
                    'layout_template' => 'default'
                ]
            ]
        );

        $this->add_control(
            'category_box_border_bottom_size',
            [
                'label'      => __( 'Border Bottom Size', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ]
                ],
                'default'    => [
                    'size' => 10,
                    'unit' => 'px'
                ],
                'condition'  => [
                    'category_box_border_bottom' => 'true',
                    'layout_template'            => 'default'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper' => 'border-bottom:{{SIZE}}{{UNIT}} solid #880380D4;'
                ]
            ]
        );

        $this->add_control(
            'category_box_border_color',
            [
                'label'     => __( 'Border Bottom Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => ' #880380D4',
                'condition' => [
                    'category_box_border_bottom' => 'true',
                    'layout_template'            => 'default'
                ],
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper' => 'border-bottom-color:{{VALUE}};'
                ]
            ]
        );

        // Hover State Tab
        $this->start_controls_tab(
            'card_hover',
            ['label' => esc_html__( 'Hover', 'betterdocs' )]
        );

        $this->add_control(
            'card_transition',
            [
                'label'      => __( 'Transition', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 300,
                    'unit' => '%'
                ],
                'size_units' => ['%'],
                'range'      => [
                    '%' => [
                        'max'  => 2500,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper' => 'transition: {{SIZE}}ms;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'card_bg_hover',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'card_border_hover',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper:hover'
            ]
        );

        $this->add_responsive_control(
            'card_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'card_box_shadow_hover',
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper:hover'
            ]
        );

        //Add Border Bottom On Hover
        $this->add_control(
            'category_box_border_bottom_hover',
            [
                'label'        => __( 'Border Bottom Hover', 'betterdocs' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'betterdocs' ),
                'label_off'    => __( 'Hide', 'betterdocs' ),
                'return_value' => 'true',
                'default'      => 'false',
                'condition'    => [
                    'layout_template' => 'default'
                ]
            ]
        );

        $this->add_control(
            'category_box_border_bottom_size_hover',
            [
                'label'      => __( 'Border Bottom Size Hover', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ]
                ],
                'default'    => [
                    'size' => 10,
                    'unit' => 'px'
                ],
                'condition'  => [
                    'category_box_border_bottom_hover' => 'true',
                    'layout_template'                  => 'default'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper:hover' => 'border-bottom:{{SIZE}}{{UNIT}} solid #880380D4;'
                ]
            ]
        );

        $this->add_control(
            'category_box_border_color_hover',
            [
                'label'     => esc_html__( 'Border Color Hover', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'category_box_border_bottom_hover' => 'true',
                    'layout_template'                  => 'default'
                ],
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper:hover' => 'border-bottom-color:{{VALUE}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section(); # end of 'Card Settings'
    }

    protected function icon_style() {
        $this->start_controls_section(
            'section_box_icon_style',
            [
                'label'     => __( 'Icon', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_template' => [
                        'layout-2',
                        'default'
                    ]
                ]
            ]
        );

        $this->add_control(
            'category_settings_area',
            [
                'label' => __( 'Area', 'betterdocs' ),
                'type'  => Controls_Manager::HEADING
            ]
        );

        $this->add_responsive_control(
            'category_settings_icon_area_size_normal',
            [
                'label'      => esc_html__( 'Size', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'max' => 500
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-elementor:not(.layout-2) .betterdocs-category-icon, .betterdocs-elementor:not(.layout-3) .betterdocs-category-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .layout-2 .betterdocs-category-icon, .layout-3 .betterdocs-category-icon'                                                       => 'flex-basis: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'category_settings_icon',
            [
                'label'     => __( 'Icon', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'category_settings_icon_size_normal',
            [
                'label'      => esc_html__( 'Size', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'max' => 500
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-elementor:not(.layout-2) .betterdocs-category-icon, .betterdocs-elementor:not(.layout-3) .betterdocs-category-icon .betterdocs-category-icon-img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.layout-2 .betterdocs-category-icon .betterdocs-category-icon-img, .layout-3 .betterdocs-category-icon .betterdocs-category-icon-img'                          => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'box_icon_styles_tab' );

        // Normal State Tab
        $this->start_controls_tab(
            'icon_normal',
            ['label' => esc_html__( 'Normal', 'betterdocs' )]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'icon_background_normal',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-elementor .betterdocs-category-icon',
                'exclude'  => [
                    'image'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border_normal',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-elementor .betterdocs-category-icon'
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius_normal',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-elementor .betterdocs-category-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'layout_template' => 'default'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-elementor .betterdocs-category-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'layout_template' => 'default'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'              => esc_html__( 'Spacing', 'betterdocs' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => ['px', 'em', '%'],
                'allowed_dimensions' => [
                    'top',
                    'bottom'
                ],
                'selectors'          => [
                    '{{WRAPPER}} .betterdocs-elementor .betterdocs-category-icon' => 'margin: {{TOP}}{{UNIT}} auto {{BOTTOM}}{{UNIT}} auto;'
                ],
                'condition'          => [
                    'layout_template' => 'default'
                ]
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab(
            'icon_hover',
            ['label' => esc_html__( 'Hover', 'betterdocs' )]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'icon_background_hover',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .el-betterdocs-category-box-post .el-betterdocs-cb-inner:hover .el-betterdocs-cb-cat-icon,
                {{WRAPPER}} .el-betterdocs-category-box-post .el-betterdocs-cb-inner:hover .el-betterdocs-cb-cat-icon__layout-2'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border_hover',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .el-betterdocs-category-box-post .el-betterdocs-cb-inner:hover .el-betterdocs-cb-cat-icon,
                {{WRAPPER}} .el-betterdocs-category-box-post .el-betterdocs-cb-inner:hover .el-betterdocs-cb-cat-icon__layout-2'
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .el-betterdocs-category-box-post .el-betterdocs-cb-inner:hover .el-betterdocs-cb-cat-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'layout_template' => 'default'
                ]
            ]
        );

        $this->add_control(
            'category_settings_icon_size_transition',
            [
                'label'      => __( 'Transition', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 300,
                    'unit' => '%'
                ],
                'size_units' => ['%'],
                'range'      => [
                    '%' => [
                        'max'  => 2500,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .el-betterdocs-category-box-post .el-betterdocs-cb-inner .el-betterdocs-cb-cat-icon'     => 'transition: {{SIZE}}ms;',
                    '{{WRAPPER}} .el-betterdocs-category-box-post .el-betterdocs-cb-inner .el-betterdocs-cb-cat-icon img' => 'transition: {{SIZE}}ms;',
                    '{{WRAPPER}} .el-betterdocs-category-box-post .el-betterdocs-cb-cat-icon__layout-2'                   => 'transition: {{SIZE}}ms;',
                    '{{WRAPPER}} .el-betterdocs-category-box-post .el-betterdocs-cb-cat-icon__layout-2 img'               => 'transition: {{SIZE}}ms;'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section(); # end of 'Icon Styles'
    }

    protected function title_style() {
        $this->start_controls_section(
            'section_box_title_styles',
            [
                'label'     => __( 'Title', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_template' => [
                        'layout-2',
                        'default'
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cat_title_typography_normal',
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-title'
            ]
        );

        $this->start_controls_tabs( 'box_title_styles_tab' );

        // Normal State Tab
        $this->start_controls_tab(
            'title_normal',
            ['label' => esc_html__( 'Normal', 'betterdocs' )]
        );

        $this->add_control(
            'cat_title_color_normal',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label'      => __( 'Spacing', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab(
            'title_hover',
            ['label' => esc_html__( 'Hover', 'betterdocs' )]
        );

        $this->add_control(
            'cat_title_color_hover',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-title:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'category_title_transition',
            [
                'label'      => __( 'Transition', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 300,
                    'unit' => '%'
                ],
                'size_units' => ['%'],
                'range'      => [
                    '%' => [
                        'max'  => 2500,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-title' => 'transition: {{SIZE}}ms;'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section(); # end of 'Icon Styles'
    }

    protected function count_style() {
        $this->start_controls_section(
            'section_box_count_styles',
            [
                'label'     => __( 'Count', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_template' => [
                        'layout-2'
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'count_typography_normal',
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span'
            ]
        );

        $this->add_responsive_control(
            'count_area_size',
            [
                'label'      => esc_html__( 'Size', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'max' => 500
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'count_spacing',
            [
                'label'      => __( 'Spacing', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'count_box_bg',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts'
            ]
        );

        $this->start_controls_tabs( 'box_count_styles_tab' );

        // Normal State Tab
        $this->start_controls_tab(
            'count_normal',
            ['label' => esc_html__( 'Normal', 'betterdocs' )]
        );

        $this->add_control(
            'count_color_normal',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'count_box_border',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts'
            ]
        );

        $this->add_responsive_control(
            'count_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'count_box_box_shadow',
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts'
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab(
            'count_hover',
            ['label' => esc_html__( 'Hover', 'betterdocs' )]
        );

        $this->add_control(
            'category_count_transition',
            [
                'label'      => __( 'Transition', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 300,
                    'unit' => '%'
                ],
                'size_units' => ['%'],
                'range'      => [
                    '%' => [
                        'max'  => 2500,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts' => 'transition: {{SIZE}}ms;'
                ]
            ]
        );

        $this->add_control(
            'count_color_hover',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts:hover span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'count_box_bg_hover',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'count_box_border_hover',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts:hover'
            ]
        );

        $this->add_responsive_control(
            'count_box_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts:hover'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'count_box_box_shadow_hover',
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper.betterdocs-elementor.el-layout-2 .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts:hover'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section(); # end of 'Count Styles'
    }

    protected function register_controls() {
        /**
         * Query  Controls!
         * @source BaseWidget
         */
        $this->betterdocs_do_action();

        /**
         * ----------------------------------------------------------
         * Section: Layout Options
         * ----------------------------------------------------------
         */
        $this->layout_options();

        /**
         * ----------------------------------------------------------
         * Section: Box Styles
         * ----------------------------------------------------------
         */
        $this->box_style();

        /**
         * ----------------------------------------------------------
         * Section: Icon Styles
         * ----------------------------------------------------------
         */
        $this->icon_style();

        /**
         * ----------------------------------------------------------
         * Section: Title Styles
         * ----------------------------------------------------------
         */
        $this->title_style();

        /**
         * ----------------------------------------------------------
         * Section: Count Styles
         * ----------------------------------------------------------
         */
        $this->count_style();

        /**
         * Layout 3 Controls (List View Category)
         */
        $this->layout3_wrapper();
        $this->layout3_texonomy();
        $this->icon_setting_style();
        $this->category_title_style();
        $this->category_article_count();
    }

    protected function render_callback() {
        $settings = &$this->attributes;

        if ( $settings['layout_template'] == 'Layout_Default' ) {
            $settings['layout_template'] = 'default';
        }

        if ( $settings['layout_template'] == 'Layout_2' ) {
            $settings['layout_template'] = 'layout-2';
        }

        if ( $settings['layout_template'] == 'Layout_3' ) {
            $settings['layout_template'] = 'layout-3';
        }

        $_filter_added = ( $this->attributes['layout_template'] === 'layout-2' || $this->attributes['layout_template'] === 'layout-3' );

        $this->add_filter( $_filter_added );
        $this->views( 'layouts/base' );
        $this->remove_filter( $_filter_added );
    }

    public function view_params() {
        $settings = &$this->attributes;

        $wrapper_class = 'el-layout-defualt';

        if ( $settings['layout_template'] == 'layout-2' ) {
            $wrapper_class = 'el-layout-2 layout-3';
        } else if ( $settings['layout_template'] == 'layout-3' ) {
            $wrapper_class = 'el-layout-3 layout-3 betterdocs-category-list-view-wrapper';
        }

        $this->add_render_attribute(
            'bd_category_box_wrapper',
            [
                'id'    => 'el-betterdocs-cat-box-' . esc_attr( $this->get_id() ),
                'class' => [
                    'betterdocs-category-box-wrapper',
                    $wrapper_class
                ]
            ]
        );

        $this->add_render_attribute(
            'bd_category_box_inner',
            [
                'class' => [
                    'betterdocs-category-box-inner-wrapper'
                ]
            ]
        );

        $is_edit_mode = ElementorPlugin::instance()->editor->is_edit_mode();

        $show_description = $settings['layout_template'] == 'layout-3' ? (bool) $settings['listview-show-description'] : false;

        $terms_query = [
            'hide_empty'         => true,
            'taxonomy'           => 'doc_category',
            'order'              => $settings['order'],
            'orderby'            => $settings['orderby'],
            'offset'             => $settings['offset'],
            'number'             => $settings['box_per_page'],
            'nested_subcategory' => isset( $settings['nested_subcategory'] ) ? $settings['nested_subcategory'] : false
        ];

        if ( $settings['include'] ) {
            $terms_query['include'] = array_diff( $settings['include'], (array) $settings['exclude'] );
        }

        if ( $settings['exclude'] ) {
            $terms_query['exclude'] = $settings['exclude'];
        }

        $default_multiple_kb = (bool) betterdocs()->editor->get( 'elementor' )->multiple_kb_status();

        if ( $default_multiple_kb ) {
            $object = get_queried_object();

            if ( empty( $settings['selected_knowledge_base'] ) && is_tax( 'knowledge_base' ) ) {
                $meta_value = $object->slug;
            } else {
                $meta_value = ! empty( $settings['selected_knowledge_base'] ) ? $settings['selected_knowledge_base'] : '';
            }

            $terms_query['meta_query'] = [
                'relation' => 'OR',
                [
                    'key'     => 'doc_category_knowledge_base',
                    'value'   => $meta_value,
                    'compare' => 'LIKE'
                ]
            ];
        }

        $kb_slug = isset( $settings['selected_knowledge_base'] ) ? $settings['selected_knowledge_base'] : '';

        $params = wp_parse_args( [
            'wrapper_attr'            => $this->get_render_attributes( 'bd_category_box_wrapper' ),
            'inner_wrapper_attr'      => $this->get_render_attributes( 'bd_category_box_inner' ),
            'layout'                  => $settings['layout_template'],
            'widget_type'             => 'category-box',
            'multiple_knowledge_base' => $default_multiple_kb,
            'kb_slug'                 => $kb_slug,
            'is_edit_mode'            => $is_edit_mode,
            'term_icon_meta_key'      => 'doc_category_image-id',
            'terms_query_args'        => $this->betterdocs( 'query' )->terms_query( $terms_query ),
            'show_description'        => $show_description
        ], $settings );

        return $params;
    }

    public function layout3_wrapper() {
        /**
         * ----------------------------------------------------------
         * Section: Box Styles
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'listview_wrapper_secion',
            [
                'label'     => __( 'Wrapper', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_template' => 'layout-3'
                ]
            ]
        );

        $this->start_controls_tabs( 'box_background_color_tabs' );

        /** Normal State Tab Start **/
        $this->start_controls_tab(
            'box_background_color_normal',
            [
                'label' => esc_html__( 'Normal', 'betterdocs' )
            ]
        );

        $this->add_responsive_control(
            'listview_wholebox_margin_normal',
            [
                'label'      => __( 'Margin', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'listview_wholebox_padding_normal',
            [
                'label'      => __( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'box_background_color_normal_heading',
            [
                'label'     => __( 'Background', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'box_background_color_1',
                'types'    => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper'
            ]
        );

        $this->add_control(
            'box_border_color_normal_heading',
            [
                'label'     => __( 'Border', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'box_border_normal',
                'label'    => __( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow_normal',
                'label'    => __( 'Box Shadow', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper'
            ]
        );

        $this->end_controls_tab();
        /** Normal State Tab End **/

        /** Hover State Tab Start **/
        $this->start_controls_tab(
            'box_background_color_hover',
            [
                'label' => esc_html__( 'Hover', 'betterdocs' )
            ]
        );

        $this->add_responsive_control(
            'listview_wholebox_margin_hover',
            [
                'label'      => __( 'Margin', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'listview_wholebox_padding_hover',
            [
                'label'      => __( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'box_background_color_hover_heading',
            [
                'label'     => __( 'Background', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'box_background_color_2',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper:hover'
            ]
        );

        $this->add_control(
            'box_border_color_hover_heading',
            [
                'label'     => __( 'Border', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'box_border_hover',
                'label'    => __( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow_hover',
                'label'    => __( 'Box Shadow', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper:hover'
            ]
        );

        $this->end_controls_tab();
        /** Hover State Tab End **/

        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    public function layout3_texonomy() {

        /**
         * ----------------------------------------------------------
         * Section: Box Styles
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'listview_box_secion',
            [
                'label'     => __( 'Taxonomy', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_template' => 'layout-3'
                ]
            ]
        );

        $this->start_controls_tabs( 'taxonomy_box_background_color_tabs' );

        /** Normal State Tab Start **/
        $this->start_controls_tab(
            'taxonomy_box_background_color_normal',
            [
                'label' => esc_html__( 'Normal', 'betterdocs' )
            ]
        );

        $this->add_responsive_control(
            'listview_inner_boxes_margin_normal',
            [
                'label'      => __( 'Margin', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'listview_inner_boxes_padding_normal',
            [
                'label'      => __( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'all_box_background_heading',
            [
                'label'     => __( 'Background', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'all_box_background_color_normal',
            [
                'label'     => esc_html__( 'Background Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        // $this->add_group_control(
        //     Group_Control_Background::get_type(),
        //     [
        //         'name'     => 'all_box_background_color_normal',
        //         'types'    => ['classic', 'gradient'],
        //         'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper'
        //     ]
        // );

        $this->add_control(
            'all_box_border_heading',
            [
                'label'     => __( 'Border', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'all_box_border_normal',
                'label'    => __( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'all_box_shadow_normal',
                'label'    => __( 'Box Shadow', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper'
            ]
        );

        $this->end_controls_tab();
        /** Normal State Tab End **/

        /** Hover State Tab Start **/
        $this->start_controls_tab(
            'taxonomy_box_background_color_hover',
            [
                'label' => esc_html__( 'Hover', 'betterdocs' )
            ]
        );

        $this->add_responsive_control(
            'listview_inner_boxes_margin_hover',
            [
                'label'      => __( 'Margin', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'listview_inner_boxes_padding_hover',
            [
                'label'      => __( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'all_box_background_hover_heading',
            [
                'label'     => __( 'Background', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'all_box_background_color_hover',
            [
                'label'     => esc_html__( 'Background Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper:hover' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'all_box_border_hover_heading',
            [
                'label'     => __( 'Border', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'all_box_border_hover',
                'label'    => __( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'all_box_shadow_hover',
                'label'    => __( 'Box Shadow', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper:hover'
            ]
        );
        $this->end_controls_tab();
        /** Hover State Tab End **/

        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    public function icon_setting_style() {
        /**
         * ----------------------------------------------------------
         * Section: Icon Styles
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'cat_boxes_icon_style',
            [
                'label'     => __( 'Category Icon', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_template' => 'layout-3'
                ]
            ]
        );

        $this->add_responsive_control(
            'cat_boxes_icon_height',
            [
                'label'      => esc_html__( 'Size', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'max' => 500
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-icon .betterdocs-category-icon-img' => 'width: {{SIZE}}{{UNIT}}; height: auto;'
                ]
            ]
        );

        $this->start_controls_tabs( 'cat_boxes_icon_tabs' );

        /** Normal State Tab Start **/
        $this->start_controls_tab(
            'cat_boxes_icon_normal',
            ['label' => esc_html__( 'Normal', 'betterdocs' )]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'box_icon_background_colors',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-category-icon',
                'exclude'  => [
                    'image'
                ]
            ]
        );

        $this->add_responsive_control(
            'box_icon_padding',
            [
                'label'      => esc_html__( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'layout_template' => 'default'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'cat_boxes_icon_border',
                'label'    => __( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-icon'
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius_normal_layout_3',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_tab();
        /** Normal State Tab End **/

        /** Hover State Tab Start **/
        $this->start_controls_tab(
            'cat_boxes_icon_hover',
            [
                'label' => esc_html__( 'Hover', 'betterdocs' )
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'box_icon_background_colors_hover',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-category-icon:hover',
                'exclude'  => [
                    'image'
                ]
            ]
        );

        $this->add_responsive_control(
            'box_icon_padding_hover',
            [
                'label'      => esc_html__( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'layout_template' => 'default'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'cat_boxes_icon_border_hover',
                'label'    => __( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-icon:hover'
            ]
        );

        $this->add_responsive_control(
            'cat_boxes_icon_border_radius_hover',
            [
                'label'      => esc_html__( 'Icon Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-icon:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        /** Hover State Tab End **/
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    public function category_title_style() {
        /**
         * ----------------------------------------------------------
         * Section: Category Title Styles
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'cat_boxes_title_style',
            [
                'label'     => __( 'Title', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_template' => 'layout-3'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cat_boxes_title_typo_normal',
                'selector' => '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-title'
            ]
        );

        $this->start_controls_tabs( 'cat_boxes_title_icon_tabs' );

        /** Normal State Tab Start **/
        $this->start_controls_tab(
            'cat_boxes_title_icon_normal',
            [
                'label' => esc_html__( 'Normal', 'betterdocs' )
            ]
        );

        $this->add_control(
            'cat_boxes_title_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'cat_boxes_title_spacing_normal',
            [
                'label'      => __( 'Spacing', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_tab();
        /** Normal State Tab End **/

        /** Hover State Tab Start **/
        $this->start_controls_tab(
            'cat_boxes_title_icon_hover',
            [
                'label' => esc_html__( 'Hover', 'betterdocs' )
            ]
        );

        $this->add_control(
            'cat_boxes_title_color_hover',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-title:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'cat_boxes_title_spacing_hover',
            [
                'label'      => __( 'Spacing', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-title:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_tab();
        /** Hover State Tab End **/

        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    public function category_article_count() {
        /**
         * ----------------------------------------------------------
         * Section: Category Articles Styles
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'cat_boxes_articles_style',
            [
                'label'     => __( 'Content', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_template' => ['default', 'layout-3']
                ]
            ]
        );

        $this->start_controls_tabs( 'cat_articles_tabs' );

        /** Normal State Tab Start **/
        $this->start_controls_tab(
            'cat_articles_normal',
            [
                'label' => esc_html__( 'Normal', 'betterdocs' )
            ]
        );

        $this->add_control(
            'cat_boxes_articles_color',
            [
                'label'     => esc_html__( 'Article Count Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-items-counts span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cat_boxex_articles_typo_normal',
                'selector' => '{{WRAPPER}} .betterdocs-category-items-counts span'
            ]
        );

        $this->add_control(
            'cat_boxex_articles_show_desc_color_normal',
            [
                'label'     => esc_html__( 'Description Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-description' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'layout_template' => [
                        'layout-3'
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'cat_boxex_articles_show_desc_typo_normal',
                'selector'  => '{{WRAPPER}} .betterdocs-category-description',
                'condition' => [
                    'layout_template' => [
                        'layout-3'
                    ]
                ]
            ]
        );

        $this->end_controls_tab();
        /** Normal State Tab End **/

        /** Hover State Tab Start **/
        $this->start_controls_tab(
            'cat_articles_hover',
            [
                'label' => esc_html__( 'Hover', 'betterdocs' )
            ]
        );

        $this->add_control(
            'cat_boxes_articles_color_hover',
            [
                'label'     => esc_html__( 'Article Count Hover Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-items-counts:hover span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cat_boxex_articles_typo_hover',
                'selector' => '{{WRAPPER}} .betterdocs-category-items-counts:hover span'
            ]
        );

        $this->add_control(
            'cat_boxex_articles_show_desc_color_hover',
            [
                'label'     => esc_html__( 'Description Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-description:hover' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'layout_template' => [
                        'layout-3'
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'cat_boxex_articles_show_desc_typo_hover',
                'selector'  => '{{WRAPPER}} .betterdocs-category-description:hover',
                'condition' => [
                    'layout_template' => [
                        'layout-3'
                    ]
                ]
            ]
        );

        $this->end_controls_tab();
        /** Hover State Tab End **/

        $this->end_controls_tabs();
        $this->end_controls_section();
    }
}
