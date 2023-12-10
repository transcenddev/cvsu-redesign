<?php
namespace WPDeveloper\BetterDocs\Editors\Elementor\Widget\Basic;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Group_Control_Background;
use Elementor\Controls_Manager as Controls_Manager;
use WPDeveloper\BetterDocs\Editors\Elementor\BaseWidget;
use Elementor\Group_Control_Border as Group_Control_Border;
use Elementor\Group_Control_Typography as Group_Control_Typography;

class SearchForm extends BaseWidget {
    public $view_wrapper = 'betterdocs-search-form-wrapper';

    public function get_name() {
        return 'betterdocs-search-form';
    }

    public function get_title() {
        return __( 'Doc Search Form', 'betterdocs' );
    }

    public function get_categories() {
        return ['betterdocs-elements', 'docs-archive', 'betterdocs-elements-single'];
    }

    public function get_icon() {
        return 'betterdocs-icon-search';
    }

    public function get_style_depends() {
        return [ 'betterdocs-search' ];
    }

    public function get_script_depends() {
        return [ 'betterdocs-search', 'betterdocs-pro' ];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @return array Widget keywords.
     * @since  3.5.2
     * @access public
     *
     */
    public function get_keywords() {
        return [
            'knowledgebase',
            'knowledge Base',
            'documentation',
            'doc',
            'kb',
            'betterdocs',
            'search',
            'search form'

        ];
    }

    public function get_custom_help_url() {
        return 'https://betterdocs.co/docs/single-doc-in-elementor';
    }

    protected function register_controls() {

        $this->start_controls_section(
            'search_content_placeholders',
            [
                'label' => __( 'Search Content', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'section_search_field_placeholder',
            [
                'label'   => __( 'Placeholder', 'betterdocs' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Search', 'betterdocs' )
            ]
        );

        $this->add_control(
            'section_search_field_heading',
            [
                'label' => __( 'Search Heading', 'betterdocs' ),
                'type'  => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'section_search_field_sub_heading',
            [
                'label' => __( 'Search Subheading', 'betterdocs' ),
                'type'  => Controls_Manager::TEXT
            ]
        );

        do_action( 'betterdocs/elementor/widgets/advanced-search/switcher', $this );

        $this->end_controls_section();
        /**
         * ----------------------------------------------------------
         * Section: Search Box
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'section_search_box_settings',
            [
                'label' => __( 'Search Box', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'search_box_bg',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-search-form-wrapper'
            ]
        );

        $this->add_responsive_control(
            'search_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'    => 50,
                    'right'  => 50,
                    'bottom' => 50,
                    'left'   => 50
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-search-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'search_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'    => 50,
                    'right'  => 50,
                    'bottom' => 50,
                    'left'   => 50
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-search-form-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section(); # end of 'Search Box'

        /**
         * ----------------------------------------------------------
         * Section: Search Field
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'section_search_field_settings',
            [
                'label' => __( 'Search Field', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'search_field_bg',
            [
                'label'     => esc_html__( 'Field Background Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-searchform' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'search_field_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-searchform .betterdocs-search-field' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'search_field_text_typography',
                'selector' => '{{WRAPPER}} .betterdocs-searchform .betterdocs-search-field'
            ]
        );

        $this->add_responsive_control(
            'search_field_padding',
            [
                'label'      => __( 'Field Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-searchform .betterdocs-search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'search_box_outer_margin',
            [
                'label'      => __( 'Search Box Margin', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-searchform' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'search_box_outer_width',
            [
                'label'      => esc_html__( 'Size', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-searchform' => 'width: {{SIZE}}{{UNIT}}; height: auto;'
                ]
            ]
        );

        $this->add_responsive_control(
            'search_field_padding_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-searchform' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'field_search_icon_heading',
            [
                'label'     => esc_html__( 'Search Icon', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'field_search_icon_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-searchform svg.docs-search-icon' => 'fill: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'field_search_icon_size',
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
                    '{{WRAPPER}} .betterdocs-searchform svg.docs-search-icon' => 'width: {{SIZE}}{{UNIT}}; height: auto;'
                ]
            ]
        );

        $this->add_control(
            'field_close_icon_heading',
            [
                'label'     => esc_html__( 'Close Icon', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'search_field_close_icon_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .docs-search-close .close-line' => 'fill: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'search_field_close_icon_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .docs-search-loader, {{WRAPPER}} .docs-search-close .close-border' => 'fill: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section(); # end of 'Search Field'

        /**
         * ----------------------------------------------------------
         * Section: Search Result Box
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'section_search_result_settings',
            [
                'label' => __( 'Search Result Box', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'result_box_width',
            [
                'label'      => __( 'Width', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 100,
                    'unit' => '%'
                ],
                'size_units' => ['%', 'px', 'em'],
                'range'      => [
                    '%' => [
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-live-search .docs-search-result' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'result_box_max_width',
            [
                'label'      => __( 'Max Width', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 1600,
                    'unit' => 'px'
                ],
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'max'  => 1600,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-live-search .docs-search-result' => 'max-width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'result_box_bg',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-live-search .docs-search-result'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'result_box_border',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-live-search .docs-search-result'
            ]
        );

        $this->end_controls_section(); # end of 'Search Result Box'

        /**
         * ----------------------------------------------------------
         * Section: Search Result Item
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'section_search_result_item_settings',
            [
                'label' => __( 'Search Result List', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs( 'item_settings_tab' );

        // Normal State Tab
        $this->start_controls_tab(
            'item_normal',
            ['label' => esc_html__( 'Normal', 'betterdocs' )]
        );

        $this->add_control(
            'result_box_item',
            [
                'label' => esc_html__( 'Item', 'betterdocs' ),
                'type'  => Controls_Manager::HEADING
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'result_box_item_typography',
                'selector' => '{{WRAPPER}} .betterdocs-live-search .docs-search-result li a'
            ]
        );

        $this->add_control(
            'result_box_item_color',
            [
                'label'     => esc_html__( 'Item Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-live-search .docs-search-result li a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'result_item_border',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-live-search .docs-search-result li'
            ]
        );

        $this->add_responsive_control(
            'result_box_item_padding',
            [
                'label'      => __( 'Padding', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-live-search .docs-search-result li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'search_result_box_item_category',
            [
                'label'     => esc_html__( 'Category', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'result_box_item_category_typography',
                'selector' => '{{WRAPPER}} .betterdocs-live-search .docs-search-result li span'
            ]
        );

        $this->add_control(
            'result_box_item_category_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-live-search .docs-search-result li span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab(
            'item_hover',
            ['label' => esc_html__( 'Hover', 'betterdocs' )]
        );

        $this->add_responsive_control(
            'result_item_transition',
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
                    '{{WRAPPER}} .betterdocs-live-search .docs-search-result li, {{WRAPPER}} .betterdocs-live-search .docs-search-result li a, {{WRAPPER}} .betterdocs-live-search .docs-search-result li span, {{WRAPPER}} .betterdocs-live-search .docs-search-result' => 'transition: {{SIZE}}ms;'
                ]
            ]
        );

        $this->add_control(
            'result_box_item_hover_heading',
            [
                'label' => esc_html__( 'Item', 'betterdocs' ),
                'type'  => Controls_Manager::HEADING
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'result_box_item_hover_bg',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .betterdocs-live-search .docs-search-result li:hover',
                'exclude'  => [
                    'image'
                ]
            ]
        );

        $this->add_control(
            'result_box_item_hover_color',
            [
                'label'     => esc_html__( 'Item Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-live-search .docs-search-result li:hover a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'result_item_hover_border',
                'label'    => esc_html__( 'Border', 'betterdocs' ),
                'selector' => '{{WRAPPER}} .betterdocs-live-search .docs-search-result li:hover'
            ]
        );

        $this->add_control(
            'result_box_item_hover_count_heading',
            [
                'label'     => esc_html__( 'Count', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'result_box_item_hover_count_color',
            [
                'label'     => esc_html__( 'Item Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-live-search .docs-search-result li:hover span' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section(); # end of 'Search Result Item'

        do_action( 'betterdocs/elementor/widgets/advanced-search/controllers', $this );
    }

    public function render_callback() {
        $this->views( 'widgets/search-form' );
    }

    public function view_params() {
        $settings = &$this->attributes;

        $popular_search_title   = isset( $settings['advance_search_popular_search_title_placeholder'] ) ? $settings['advance_search_popular_search_title_placeholder'] : '';
        $category_search_toggle = isset( $settings['betterdocs_category_search_toogle'] ) ? $settings['betterdocs_category_search_toogle'] : '';
        $search_button_toggle   = isset( $settings['betterdocs_search_button_toogle'] ) ? $settings['betterdocs_search_button_toogle'] : '';
        $popular_search_toggle  = isset( $settings['betterdocs_popular_search_toogle'] ) ? $settings['betterdocs_popular_search_toogle'] : '';

        $_shortcode_attributes = apply_filters( 'betterdocs_elementor_search_form_params', [
            'enable_heading'       => 'true',
            'popular_search_title' => $popular_search_title,
            'category_search'      => $category_search_toggle,
            'search_button'        => $search_button_toggle,
            'popular_search'       => $popular_search_toggle,
            'heading'              => esc_html( $settings['section_search_field_heading'] ),
            'subheading'           => esc_html( $settings['section_search_field_sub_heading'] ),
            'placeholder'          => esc_html( $settings['section_search_field_placeholder'] )
        ], $this->attributes );

        return [
            'shortcode_attr' => $_shortcode_attributes
        ];
    }

    // In plain mode, render without shortcode
    public function render_plain_content() {
        $settings = $this->get_settings_for_display();
        echo '[betterdocs_search_form placeholder="' . $settings['section_search_field_placeholder'] . '"]';
    }
}
