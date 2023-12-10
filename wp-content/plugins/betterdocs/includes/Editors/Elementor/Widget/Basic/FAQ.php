<?php

namespace WPDeveloper\BetterDocs\Editors\Elementor\Widget\Basic;
use Elementor\Widget_Base;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Group_Control_Background;
use Elementor\Plugin as ElementorPlugin;
use Elementor\Controls_Manager as Controls_Manager;
use WPDeveloper\BetterDocs\Editors\Elementor\Helper;
use Elementor\Group_Control_Border as Group_Control_Border;
use Elementor\Group_Control_Typography as Group_Control_Typography;

class FAQ extends Widget_Base {

    public function get_name() {
        return 'betterdocs-faq';
    }

    public function get_title() {
        return __( 'BetterDocs FAQ', 'betterdocs' );
    }

    public function get_custom_help_url() {
        return 'http://betterdocs.co/docs/betterdocs-faq-builder-in-elementor/';
    }

    public function get_icon() {
        return 'betterdocs-icon-faq';
    }

    public function get_categories() {
        return ['betterdocs-elements'];
    }

    public function get_keywords() {
        return ['betterdocs-elements', 'betterdocs', 'docs', 'faq', 'FAQ', 'betterdocs-faq'];
    }

    public function get_style_depends() {
        return ['betterdocs-faq'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'faq_section_controls',
            [
                'label' => __( 'Layout Options', 'betterdocs' )
            ]
        );

        $this->add_control(
            'faq_layout_selection',
            [
                'label'       => __( 'Select Layout', 'betterdocs' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => [
                    'layout-1' => __( 'Modern Layout', 'betterdocs' ),
                    'layout-2' => __( 'Classic Layout', 'betterdocs' )
                ],
                'default'     => 'layout-1',
                'label_block' => true
            ]
        );

        $this->add_control(
            'faq_layout_section',
            [
                'label'   => __( 'FAQ Section', 'betterdocs' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true
                ],
                'default' => __( 'Frequently Asked Questions', 'betterdocs' )
            ]
        );

        $terms = betterdocs()->container->get( Helper::class )->get_faq_terms();

        $this->add_control(
            'select_specific_faq',
            [
                'label'          => __( 'Include FAQ Groups', 'betterdocs' ),
                'label_block'    => true,
                'type'           => Controls_Manager::SELECT2,
                'options'        => $terms,
                'multiple'       => true,
                'default'        => '',
                'select2options' => [
                    'placeholder' => __( 'Include FAQ Groups', 'betterdocs' ),
                    'allowClear'  => true
                ]
            ]
        );

        $this->add_control(
            'exclude_specific_faq',
            [
                'label'          => __( 'Exclude FAQ Groups', 'betterdocs' ),
                'label_block'    => true,
                'type'           => Controls_Manager::SELECT2,
                'options'        => $terms,
                'multiple'       => true,
                'default'        => '',
                'select2options' => [
                    'placeholder' => __( 'Exclude FAQ Groups', 'betterdocs' ),
                    'allowClear'  => true
                ]
            ]
        );

        $this->end_controls_section();

        /******* Common Section Style For Both Layouts *******/

        $this->start_controls_section(
            'faq_section_style',
            [
                'label' => __( 'FAQ Section Title', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'faq_layout_section_title_color',
            [
                'label'     => esc_html__( 'Text Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-section-title' => 'color:{{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'faq_layout_section_title_typography',
                'selector' => '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-section-title'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'faq_box_title_section',
            [
                'label'     => __( 'FAQ Group Title', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'faq_box_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-title h2' => 'color:{{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'faq_box_title_color_hover',
            [
                'label'     => esc_html__( 'Title Hover Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-title h2:hover' => 'color:{{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'faq_box_title_typography',
                'selector' => '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-title h2'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'faq_box_style_section',
            [
                'label'     => __( 'FAQ List', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'faq_box_padding',
            [
                'label'      => __( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'faq_box_margin',
            [
                'label'      => __( 'Margin', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'faq_box_typography',
                'selector' => '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-post-name'
            ]
        );

        $this->add_control(
            'faq_box_term_title_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-post-name' => 'color:{{VALUE}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'faq_tabs' );

        // Normal State Tab
        $this->start_controls_tab(
            'faq_box_normal',
            ['label' => esc_html__( 'Normal', 'betterdocs' )]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'faq_box_border_normal',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'faq_box_background_normal',
                'label'    => esc_html__( 'Background', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post'
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab(
            'faq_box_hover',
            ['label' => esc_html__( 'Hover', 'betterdocs' )]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'faq_box_border_hover',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'faq_box_background_hover',
                'label'    => esc_html__( 'Background', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post:hover'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'faq_box_content_section',
            [
                'label'     => __( 'FAQ Content', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'faq_box_content_section_padding',
            [
                'label'      => __( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-main-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'faq_box_content_section_margin',
            [
                'label'      => __( 'Margin', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-main-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'faq_box_content_section_background',
                'label'    => esc_html__( 'Background', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-main-content'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'faq_box_content_section_typography',
                'selector' => '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-main-content'
            ]
        );

        $this->add_control(
            'faq_box_content_section_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-main-content' => 'color:{{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'faq_box_content_icon',
            [
                'label'     => __( 'FAQ List Icon', 'betterdocs' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'faq_box_content_icon_height',
            [
                'label'      => esc_html__( 'Icon Height', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'max' => 500
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-iconplus' => 'height:{{SIZE}}{{UNIT}}; max-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-iconminus'  => 'height:{{SIZE}}{{UNIT}}; max-height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'faq_box_content_icon_width',
            [
                'label'      => esc_html__( 'Icon Width', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'max' => 500
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-iconplus' => 'width:{{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-iconminus'  => 'width:{{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'faq_box_content_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-iconplus path' => 'fill:{{VALUE}} ! important;',
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-iconminus path'  => 'fill:{{VALUE}} ! important;',
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-iconplus g' => 'stroke:{{VALUE}} ! important;',
                    '{{WRAPPER}} .betterdocs-faq-wrapper .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-iconminus g'  => 'stroke:{{VALUE}} ! important;'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $control_values = $this->get_settings_for_display();

        $specific_faqs = ! empty( $control_values['select_specific_faq'] ) ? implode( ',', $control_values['select_specific_faq'] ) : '';

        $faqs_exclude = ! empty( $control_values['exclude_specific_faq'] ) ? implode( ',', $control_values['exclude_specific_faq'] ) : '';

        betterdocs()->views->get( 'layouts/faq', [
            'enable'         => true,
            'have_posts'     => true,
            'layout'         => $control_values['faq_layout_selection'],
            'shortcode_attr' => [
                'group_exclude' => $faqs_exclude,
                'class'         => 'betterdocs-faq-' . $control_values['faq_layout_selection'],
                'groups'        => $specific_faqs,
                'faq_heading'   => $control_values['faq_layout_section']
            ]
        ] );

        if ( ElementorPlugin::instance()->editor->is_edit_mode() ) {
            $this->render_editor_script();
        }
    }

    protected function render_editor_script()
    {
        ?>
            <script>
                jQuery(document).ready(function($) {
                    $('.betterdocs-faq-post').on('click', function(e) {
                        var current_node = $(this);
                        var active_list  = $('.betterdocs-faq-group.active');

                        if( ! current_node.parent().hasClass('active') ) {
                            current_node.parent().addClass('active');
                            current_node.children('svg').toggle();
                            current_node.next().slideDown();
                        }

                        for( let node of active_list ) {
                            if( $(node).hasClass('active') ) {
                                $(node).removeClass('active');
                                $(node).children('.betterdocs-faq-post').children('svg').toggle();
                                $(node).children('.betterdocs-faq-main-content').slideUp();
                            }
                        }
                    });

                    $('.betterdocs-faq-post-layout-2').on('click', function(e) {
                        var current_node = $(this);

                        if( ! current_node.parent().hasClass('active') ) {
                            current_node.parent().addClass('active');
                            current_node.children('.betterdocs-faq-post-layout-2-icon-group').children('svg').toggle();
                            current_node.next().slideDown();
                        } else {
                            current_node.parent().removeClass('active');
                            current_node.children('.betterdocs-faq-post-layout-2-icon-group').children('svg').toggle();
                            current_node.next().slideUp();
                        }

                    });
                });
            </script>
        <?php
    }
}
