<?php
namespace WPDeveloper\BetterDocs\Editors\Elementor\Widget;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use WPDeveloper\BetterDocs\Editors\Elementor\BaseWidget;
use Elementor\Group_Control_Border as Group_Control_Border;
use Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use Elementor\Plugin;

class Sidebar extends BaseWidget {

    public function get_name() {
        return 'betterdocs-sidebar';
    }

    public function get_title() {
        return __( 'Doc Sidebar', 'betterdocs' );
    }

    public function get_icon() {
        return 'betterdocs-icon-Sidebar';
    }

    public function get_categories() {
        return ['betterdocs-elements', 'docs-archive'];
    }

    public function get_keywords() {
        return ['betterdocs-elements', 'sidebar', 'betterdocs', 'docs'];
    }

    public function get_style_depends() {
        return ['betterdocs-sidebar'];
    }

    public function get_script_depends() {
        return ['betterdocs-category-grid'];
    }

    public function get_custom_help_url() {
        return 'https://betterdocs.co/docs/single-doc-in-elementor';
    }

    protected function register_controls() {
        /**
         * Query  Controls!
         * @source BaseWidget
         */
        $this->betterdocs_do_action();

        do_action( 'betterdocs_elementor_sidebar_layout_select', $this );

        $this->sidebar_layout_select();

        if ( ! is_plugin_active( 'betterdocs-pro/betterdocs-pro.php' ) ) {
            $this->start_controls_section(
                'betterdocs_section_pro',
                [
                    'label' => __( 'Go Premium for More Features', 'betterdocs' )
                ]
            );

            $this->add_control(
                'betterdocs_control_get_pro',
                [
                    'label'       => __( 'Unlock more possibilities', 'betterdocs' ),
                    'type'        => Controls_Manager::CHOOSE,
                    'options'     => [
                        '1' => [
                            'title' => '',
                            'icon'  => 'fa fa-unlock-alt'
                        ]
                    ],
                    'default'     => '1',
                    'description' => '<span class="pro-feature"> Get the  <a href="https://betterdocs.co/upgrade" target="_blank">Pro version</a> for more stunning layouts and customization options.</span>'
                ]
            );

            $this->end_controls_section();
        }

        $this->wraper_setting_style();

        $this->category_items_setting_style();

        $this->icon_style();

        $this->title_style();

        $this->count_style();

        $this->list_setting();

        $this->sub_list_setting();

        $this->sticky_toc();
    }

    public function sidebar_layout_select() {
        /**
         * ----------------------------------------------------------
         * Section: Select Layout
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'section_layout_settings',
            [
                'label' => __( 'Layout', 'betterdocs' )
            ]
        );

        $this->add_control(
            'betterdocs_sidebar_layout',
            [
                'label'       => esc_html__( 'Select layout', 'betterdocs' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'layout-1',
                'label_block' => false,
                'options'     => [
                    'layout-1' => esc_html__( 'Layout 1', 'betterdocs' ),
                    'layout-2' => esc_html__( 'Layout 2', 'betterdocs' ),
                    'layout-3' => esc_html__( 'Layout 3', 'betterdocs' ),
                    'layout-4' => esc_html__( 'Layout 4', 'betterdocs' )
                ]
            ]
        );

        if ( ! is_plugin_active( 'betterdocs-pro/betterdocs-pro.php' ) ) {
            $this->add_control(
                'betterdocs_sidebar_layout_warning_text',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => __( 'This layout is available in pro version only!', 'betterdocs' ),
                    'content_classes' => 'betterdocs-ea-warning',
                    'condition'       => [
                        'betterdocs_sidebar_layout' => ['layout-2', 'layout-3']
                    ]
                ]
            );
        }

        $this->add_control(
            'category_title_tag',
            [
                'label'   => __( 'Category Title Tag', 'betterdocs' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => __( 'H1', 'betterdocs' ),
                    'h2' => __( 'H2', 'betterdocs' ),
                    'h3' => __( 'H3', 'betterdocs' ),
                    'h4' => __( 'H4', 'betterdocs' ),
                    'h5' => __( 'H5', 'betterdocs' ),
                    'h6' => __( 'H6', 'betterdocs' )
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
                'default'      => 'true',
                'condition'    => [
                    'betterdocs_sidebar_layout' => ['layout-1']
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
                'default'      => 'true',
                'condition'    => [
                    'betterdocs_sidebar_layout' => ['layout-1']
                ]
            ]
        );

        $this->end_controls_section(); # end of 'Select Layout'
    }

    public function sticky_toc() {
        /**
         * ----------------------------------------------------------
         * Section: Box Styles
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'section_sticky_toc',
            [
                'label' => __( 'Sticky TOC', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'enable_sticky_toc',
            [
                'label'        => __( 'Enable Sticky TOC', 'betterdocs' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'betterdocs' ),
                'label_off'    => __( 'Hide', 'betterdocs' ),
                'return_value' => '1',
                'default'      => ''
            ]
        );

        $this->add_responsive_control(
            'toc_width',
            [
                'label'      => __( 'TOC Width', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'max'  => 1000,
                        'step' => 1
                    ],
                    '%'  => [
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sticky-toc-container' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'toc_zindex', // Legacy control id but new control
            [
                'label'     => __( 'Z index', 'betterdocs' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'max'       => 1000,
                'step'      => 5,
                'default'   => 320,
                'selectors' => [
                    '{{WRAPPER}} .sticky-toc-container' => 'z-index: {{VALUE}}%;'
                ]
            ]
        );

        $this->end_controls_section(); # end of 'Card Settings'
    }

    public function wraper_setting_style() {
        $this->start_controls_section(
            'section_card_settings',
            [
                'label' => __( 'Wraper', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'column_space', // Legacy control id but new control
            [
                'label'      => __( 'Margin', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'column_padding',
            [
                'label'      => __( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_control(
            'column_height',
            [
                'label'      => __( 'Height', 'plugin-domain' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 5
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'box_seperator_color',
            [
                'label'     => esc_html__( 'Background Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper' => 'background-color: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_section(); # end of 'Card Settings'
    }

    public function category_items_setting_style() {
        $this->start_controls_section(
            'category_items_settings',
            [
                'label' => __( 'Category Items', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs( 'category_items_settings_tabs' );

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
                'selector' => '{{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-single-category-wrapper .betterdocs-body, {{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-list-wrapper .betterdocs-single-category-inner .betterdocs-body'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'card_border_normal',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-single-category-wrapper .betterdocs-body, {{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-list-wrapper .betterdocs-single-category-inner .betterdocs-body'
            ]
        );

        $this->add_responsive_control(
            'card_border_radius_normal',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-single-category-wrapper .betterdocs-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-list-wrapper .betterdocs-single-category-inner .betterdocs-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'card_box_shadow_normal',
                'selector' => '{{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-single-category-wrapper .betterdocs-body, {{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-list-wrapper .betterdocs-single-category-inner .betterdocs-body'
            ]
        );

        $this->end_controls_tab();

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
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .docs-single-cat-wrap' => 'transition: {{SIZE}}ms;'
                ]
            ]
        );


        $this->add_control(
            'box_section_body_hover',
            [
                'label'     => __( 'Body', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'card_bg_hover',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-single-category-wrapper .betterdocs-body:hover, {{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-list-wrapper .betterdocs-single-category-inner .betterdocs-body:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'card_border_hover',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-single-category-wrapper .betterdocs-body:hover, {{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-list-wrapper .betterdocs-single-category-inner .betterdocs-body:hover'
            ]
        );

        $this->add_responsive_control(
            'card_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-single-category-wrapper .betterdocs-body:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-list-wrapper .betterdocs-single-category-inner .betterdocs-body:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'card_box_shadow_hover',
                'selector' => '{{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-single-category-wrapper .betterdocs-body:hover, {{WRAPPER}} .betterdocs-sidebar-content .betterdocs-category-list-wrapper .betterdocs-single-category-inner .betterdocs-body:hover'
            ]
        );


        $this->end_controls_tabs();
        $this->end_controls_section(); # end of 'Card Settings'
    }

    public function icon_style() {
        /**
         * ----------------------------------------------------------
         * Section: Icon Styles
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'section_box_icon_style',
            [
                'label' => __( 'Icon', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
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
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper:not(.layout-2) .betterdocs-category-icon' => 'height: {{SIZE}}{{UNIT}}; width: auto;',
                    '{{WRAPPER}} .betterdocs-category-icon img' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'category_settings_arrow_width_normal',
            [
                'label'      => esc_html__( 'Arrow Width', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'max' => 500
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-collapse' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition'          => [
                    'betterdocs_sidebar_layout' => ['layout-4']
                ]
            ]
        );

        $this->add_responsive_control(
            'category_settings_arrow_height_normal',
            [
                'label'      => esc_html__( 'Arrow Height', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'max' => 500
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-collapse' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition'          => [
                    'betterdocs_sidebar_layout' => ['layout-4']
                ]
            ]
        );

        $this->start_controls_tabs( 'box_icon_styles_tab' );

        // Normal State Tab
        $this->start_controls_tab(
            'icon_normal',
            ['label' => esc_html__( 'Normal', 'betterdocs' )]
        );

        $this->add_control(
            'arrow_color',
            [
                'label'     => __( 'Arrow Color', 'plugin-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-collapse' => 'color: {{VALUE}}'
                ],
                'condition'          => [
                    'betterdocs_sidebar_layout' => ['layout-4']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'icon_background_normal',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-icon',
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
                'selector' => '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-icon'
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius_normal',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-icon' => 'margin: {{TOP}}{{UNIT}} auto {{BOTTOM}}{{UNIT}} auto;'
                ]
            ]
        );

        $this->add_responsive_control(
            'arrow_padding_normal',
            [
                'label'      => esc_html__( 'Arrow Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-collapse' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'          => [
                    'betterdocs_sidebar_layout' => ['layout-4']
                ]
            ]
        );

        $this->add_responsive_control(
            'arrow_margin_normal',
            [
                'label'      => esc_html__( 'Arrow Margin', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-collapse' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'          => [
                    'betterdocs_sidebar_layout' => ['layout-4']
                ]
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab(
            'icon_hover',
            ['label' => esc_html__( 'Hover', 'betterdocs' )]
        );

        $this->add_control(
            'arrow_color_hover',
            [
                'label'     => __( 'Arrow Color', 'plugin-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-header:hover .betterdocs-category-arrow' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'icon_background_hover',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-header:hover .betterdocs-category-icon'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border_hover',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-header:hover .betterdocs-category-icon'
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-header:hover .betterdocs-category-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .docs-single-cat-wrap .docs-cat-icon:hover' => 'transition: {{SIZE}}ms;'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section(); # end of 'Icon Styles'
    }

    public function title_style() {
        /**
         * ----------------------------------------------------------
         * Section: Title Styles
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'section_box_title_styles',
            [
                'label' => __( 'Title', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
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
                    '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, {{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a), {{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-list-wrapper .betterdocs-category-list-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'card_bg_normal_header',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-header, {{WRAPPER}} .betterdocs-category-list-wrapper .betterdocs-category-list-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cat_title_typography_normal',
                'selector' => '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, {{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a), {{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-list-wrapper .betterdocs-category-list-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label'      => __( 'Margin', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-title a, {{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-title:not(a), {{WRAPPER}} .betterdocs-category-list-wrapper .betterdocs-category-title:not(a)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-title a, {{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-title:not(a), {{WRAPPER}} .betterdocs-category-list-wrapper .betterdocs-category-title:not(a)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                    '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header:hover .betterdocs-category-title a, {{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header:hover .betterdocs-category-title:not(a),  {{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-list-wrapper .betterdocs-category-list-inner-wrapper .betterdocs-category-header:hover .betterdocs-category-title:not(a)' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'card_bg_hover_header',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-header:hover, {{WRAPPER}} .betterdocs-category-list-wrapper .betterdocs-category-list-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header:hover'
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
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-header' => 'transition: {{SIZE}}ms;'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tab();

        $this->start_controls_tab(
            'card_active',
            ['label' => esc_html__( 'Active', 'betterdocs' )]
        );

        $this->add_control(
            'cat_title_active_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper.active .betterdocs-category-header .betterdocs-category-title a, {{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper.active .betterdocs-category-header .betterdocs-category-title:not(a),  {{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-list-wrapper .betterdocs-category-list-inner-wrapper .betterdocs-category-header .betterdocs-category-title:not(a)' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'card_bg_active_header',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper.active .betterdocs-category-header',
                'exclude'  => [
                    'image'
                ]
            ]
        );

        $this->add_control(
            'cat_title_active_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'default' => '#5a94ff',
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header' => 'border-color: {{VALUE}};'
                ],
                'condition' => [
                    'betterdocs_sidebar_layout' => 'layout-1'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section(); # end of 'Icon Styles'
    }

    public function count_style() {
        /**
         * ----------------------------------------------------------
         * Section: Count Styles
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'section_box_count_styles',
            [
                'label' => __( 'Count', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'count_typography_normal',
                'selector' => '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span'
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
                'label'     => esc_html__( 'Text Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'count_box_bg',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts',
                'exclude'  => [
                    'image'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'count_box_border',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts'
            ]
        );

        $this->add_responsive_control(
            'count_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'count_box_box_shadow',
                'selector' => '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts'
            ]
        );

        $this->add_responsive_control(
            'count_box_size',
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
                    '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
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
                    '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
			'second_color_seperator',
			[
				'label' => esc_html__( 'Second Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                    'betterdocs_sidebar_layout' => 'layout-1'
                ]
			]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'count_box_bg_second',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span',
                'exclude'  => [
                    'image'
                ],
                'condition' => [
                    'betterdocs_sidebar_layout' => 'layout-1'
                ]
            ],
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab(
            'count_hover',
            ['label' => esc_html__( 'Hover', 'betterdocs' )]
        );

        $this->add_control(
            'count_color_hover',
            [
                'label'     => esc_html__( 'Text Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts:hover span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'count_box_bg_hover',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts:hover',
                'exclude'  => [
                    'image'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'count_box_border_hover',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts:hover'

            ]
        );

        $this->add_responsive_control(
            'count_box_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]

            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'count_box_box_shadow_hover',
                'selector' => '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts:hover'
            ]
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
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-category-items-counts:hover' => 'transition: {{SIZE}}ms;'

                ]
            ]
        );

        $this->add_control(
			'hover_second_color_seperator',
			[
				'label' => esc_html__( 'Second Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                    'betterdocs_sidebar_layout' => 'layout-1'
                ]
			]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'count_box_bg_second_hover',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts:hover span',
                'exclude'  => [
                    'image'
                ],
                'condition' => [
                    'betterdocs_sidebar_layout' => 'layout-1'
                ]
            ],
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section(); # end of 'Count Styles'
    }

    public function list_setting() {
        /**
         * ----------------------------------------------------------
         * Section: List Settinggs
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'section_article_settings',
            [
                'label' => __( 'Category List', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'list_item_typography',
                'selector' => '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a'
            ]
        );

        $this->add_control(
            'list_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'list_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'list_margin',
            [
                'label'      => esc_html__( 'List Item Spacing', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'list_area_padding',
            [
                'label'              => esc_html__( 'List Area Padding', 'betterdocs' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units'         => ['px', 'em', '%'],
                'selectors'          => [
                    '{{WRAPPER}} .betterdocs-category-grid-wrapper .betterdocs-single-category-wrapper .betterdocs-body' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'icon_settings_heading',
            [
                'label'     => esc_html__( 'Icon', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'list_icon_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li svg' => 'fill: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'list_icon_size',
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
                    '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li .betterdocs-nested-category-title svg' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'list_icon_spacing',
            [
                'label'      => esc_html__( 'Spacing', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section(); # end of 'Column Settings'
    }

    /**
     * ----------------------------------------------------------
     * Section: Sub List Settinggs
     * ----------------------------------------------------------
     */
    public function sub_list_setting() {

        $this->start_controls_section(
            'section_sub_list_settings',
            [
                'label' => __( 'Sub-Category List', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_list_item_typography',
                'selector' => '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list .betterdocs-nested-category-list li a'
            ]
        );

        $this->add_control(
            'sub_list_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list .betterdocs-nested-category-list a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'sub_list_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list .betterdocs-nested-category-list a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'sub_list_margin',
            [
                'label'      => esc_html__( 'List Item Spacing', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list .betterdocs-nested-category-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'sub_list_area_padding',
            [
                'label'              => esc_html__( 'List Area Padding', 'betterdocs' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units'         => ['px', 'em', '%'],
                'selectors'          => [
                    '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list .betterdocs-nested-category-list li' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'sub_list_icon_spacing',
            [
                'label'      => esc_html__( 'Spacing', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list .betterdocs-nested-category-list li svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section(); # end of 'Column Settings'
    }

    protected function render_callback() {
        $settings         = $this->get_settings_for_display();
        $this->attributes = &$settings;

        $layout = isset( $settings['betterdocs_sidebar_layout'] ) ? $settings['betterdocs_sidebar_layout'] : 'layout-1';
        $layout = str_replace( 'layout-', '', $layout );

        $sidebar_layout = $layout;

        if ( ! betterdocs()->is_pro_active() && ( $sidebar_layout == 2 || $sidebar_layout == 3 ) ) {
            $sidebar_layout = 1;
        }

        $this->views( 'templates/sidebars/sidebar-' . $sidebar_layout );

        if ( $settings['enable_sticky_toc'] == 1 && $layout == 1 ) {
            betterdocs()->views->get( 'templates/parts/sticky-toc' );
        }

        if( Plugin::instance()->editor->is_edit_mode() ) {
            $this->render_editor_script();
        }
    }

    public function view_params() {
        $settings = &$this->attributes;
        $default_multiple_kb = (bool) betterdocs()->editor->get( 'elementor' )->multiple_kb_status();
        $kb_slug = isset( $settings['selected_knowledge_base'] ) ? $settings['selected_knowledge_base'] : '';

        $params = [
            'wrapper_attr'  => [
                'class' => [ 'betterdocs-elementor-single-sidebar' ]
            ],
            'shortcode_attr' => [
                'terms_order'              => $settings['order'],
                'terms_orderby'            => $settings['orderby'],
                'terms_include'            => array_diff( $settings['include'], (array) $settings['exclude'] ),
                'terms_exclude'            => $settings['exclude'],
                'terms_offset'             => $settings['offset'],
                'nested_subcategory'       => $settings['nested_subcategory'],
                'multiple_knowledge_base'  => $default_multiple_kb,
                'kb_slug'                  => $kb_slug,
                'sidebar_list'             => true,
                'disable_customizer_style' => true,
                'posts_per_page'           => -1,
                'title_tag'                => $settings['category_title_tag']
            ],
        ];

        if( $settings['betterdocs_sidebar_layout'] == 'layout-1') {
            $params['shortcode_attr'][ 'show_icon' ] = $settings['show_icon'];
            $params['shortcode_attr'][ 'show_count' ] = $settings['show_count'];
        }

        if( $settings['betterdocs_sidebar_layout'] == 'layout-4' || $settings['betterdocs_sidebar_layout'] == 'layout-3' ) {
            $params['shortcode_attr'][ 'show_icon' ] = false;
            $params['shortcode_attr'][ 'show_count' ] = false;
        }

        return $params;
    }

    public function render_editor_script() {
        $this->views( 'templates/sidebars/editor' );
    }
}
