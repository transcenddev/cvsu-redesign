<?php
namespace WPDeveloper\BetterDocs\Editors\Elementor\Widget;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use ElementorPro\Base\Base_Widget_Trait;
use WPDeveloper\BetterDocs\Editors\Elementor\BaseWidget;

class ArchiveList extends BaseWidget {

    use Base_Widget_Trait;

    public function get_name() {
        return 'betterdocs-category-archive-list';
    }

    public function get_title() {
        return __( 'Doc Category Archive List', 'betterdocs' );
    }

    public function get_icon() {
        return 'eicon-post-list betterdocs-eicon-post-list';
    }

    public function get_categories() {
        return ['betterdocs-elements', 'docs-archive'];
    }

    public function get_style_depends() {
        return ['betterdocs-el-articles-list'];
    }

    public function get_keywords() {
        return ['betterdocs-elements', 'title', 'heading', 'betterdocs', 'docs', 'doc-category', 'doc-category-archive'];
    }

    public function get_custom_help_url() {
        return 'https://betterdocs.co/docs/docs-archive-in-elementor/';
    }

    protected function register_controls() {
        $this->section_content();
        $this->list_settings();
        $this->subcat_list_settings();
    }

    public function section_content() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Controls', 'betterdocs' )
            ]
        );

        $this->add_control(
            'alphabetic_order',
            [
                'label'   => __( 'Order By', 'betterdocs' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'none'             => __( 'No order', 'betterdocs' ),
                    'name'             => __( 'Name', 'betterdocs' ),
                    'slug'             => __( 'Slug', 'betterdocs' ),
                    'term_group'       => __( 'Term Group', 'betterdocs' ),
                    'term_id'          => __( 'Term ID', 'betterdocs' ),
                    'id'               => __( 'ID', 'betterdocs' ),
                    'description'      => __( 'Description', 'betterdocs' ),
                    'parent'           => __( 'Parent', 'betterdocs' ),
                    'betterdocs_order' => __( 'BetterDocs Order', 'betterdocs' )
                ],
                'default' => 'name'
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => __( 'Order', 'betterdocs' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'asc'  => 'Ascending',
                    'desc' => 'Descending'
                ],
                'default' => 'asc'

            ]
        );

        $this->add_control(
            'nested_subcategory',
            [
                'label'        => __( 'Nested Subcategory', 'betterdocs' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'betterdocs' ),
                'label_off'    => __( 'Hide', 'betterdocs' ),
                'return_value' => '1',
                'default'      => '1'
            ]
        );

        $this->add_control(
            'important_note',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __( 'Note: This is the preview only for Elementor Editor. You will see the real view in the archive page itself.', 'betterdocs' ),
                'content_classes' => 'betterdocs-elementor-note elementor-panel-alert elementor-panel-alert-info'
            ]
        );

        $this->end_controls_section();
    }

    public function list_settings() {
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
                'selector' => '{{WRAPPER}} .betterdocs-articles-list li a'
            ]
        );

        $this->add_control(
            'list_word_wrap',
            [
                'label'     => __( 'Word Wrap', 'betterdocs' ),
                'type'      => Controls_Manager::SELECT2,
                'multiple'  => false,
                'options'   => [
                    'normal'     => 'normal',
                    'break-word' => 'break-word',
                    'initial'    => 'initial',
                    'inherit'    => 'inherit'
                ],
                'default'   => 'normal',
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-articles-list li a' => 'word-wrap: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'list_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-articles-list li a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'list_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-articles-list li a:hover' => 'color: {{VALUE}};'
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
                    '{{WRAPPER}} .betterdocs-articles-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'icon_settings_heading',
            [
                'label'     => esc_html__( 'List Icon', 'betterdocs' ),
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
                    '{{WRAPPER}} .betterdocs-articles-list li svg' => 'fill: {{VALUE}};'
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
                    '{{WRAPPER}} .betterdocs-articles-list li svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .betterdocs-articles-list .betterdocs-nested-category-title svg' => 'font-size: {{SIZE}}{{UNIT}};'
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
                    '{{WRAPPER}} .betterdocs-articles-list li svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section(); # end of 'Column Settings'
    }

    public function subcat_list_settings() {
        /**
         * ----------------------------------------------------------
         * Section: List Settinggs
         * ----------------------------------------------------------
         */
        $this->start_controls_section(
            'section_sub_category_settings',
            [
                'label' => __( 'Sub Category', 'betterdocs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'subcat_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3f5876',
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-articles-list li .betterdocs-nested-category-title > a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'subcat_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3f5876',
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-articles-list li .betterdocs-nested-category-title > a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'subcat_font_size',
            [
                'label'      => __( 'Font Size', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    '%' => [
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-articles-list li .betterdocs-nested-category-title > a' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'subcat_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3f5876',
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-articles-list li .betterdocs-nested-category-title > svg.toggle-arrow' => 'fill: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'subcat_icon_size',
            [
                'label'      => __( 'Icon Size', 'betterdocs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    '%' => [
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-articles-list li .betterdocs-nested-category-title > svg.toggle-arrow' => 'font-size: {{SIZE}}{{UNIT}}; width: auto;'
                ]
            ]
        );

        $this->add_control(
            'subcategory_list_heading',
            [
                'label'     => esc_html__( 'Subcategory List', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subcat_list_item_typography',
                'selector' => '{{WRAPPER}} .betterdocs-articles-list .betterdocs-nested-category-list li:not(.betterdocs-nested-category-wrapper) a'
            ]
        );

        $this->add_control(
            'subcat_list_word_wrap',
            [
                'label'     => __( 'Word Wrap', 'betterdocs' ),
                'type'      => Controls_Manager::SELECT2,
                'multiple'  => false,
                'options'   => [
                    'normal'     => 'normal',
                    'break-word' => 'break-word',
                    'initial'    => 'initial',
                    'inherit'    => 'inherit'
                ],
                'default'   => 'normal',
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-articles-list .betterdocs-nested-category-list li:not(.betterdocs-nested-category-wrapper) a' => 'word-wrap: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'subcat_list_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-articles-list .betterdocs-nested-category-list li:not(.betterdocs-nested-category-wrapper) a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'subcat_list_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-articles-list li:not(.betterdocs-nested-category-wrapper) a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'subcat_list_margin',
            [
                'label'      => esc_html__( 'List Item Spacing', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-articles-list .betterdocs-nested-category-list li:not(.betterdocs-nested-category-wrapper)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'subcat_icon_settings_heading',
            [
                'label'     => esc_html__( 'List Icon', 'betterdocs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'subcat_list_icon_color',
            [
                'label'     => esc_html__( 'Color', 'betterdocs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .betterdocs-articles-list .betterdocs-nested-category-list li svg:not(.toggle-arrow)' => 'fill: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'subcat_list_icon_size',
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
                    '{{WRAPPER}} .betterdocs-articles-list .betterdocs-nested-category-list li svg:not(.toggle-arrow)' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'subcat_list_icon_spacing',
            [
                'label'      => esc_html__( 'Spacing', 'betterdocs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .betterdocs-articles-list .betterdocs-nested-category-list li svg:not(.toggle-arrow)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section(); # end of 'Column Settings'
    }

    public function reset_attributes(){
        $this->attributes['orderby']      = $this->attributes['alphabetic_order'];
        $this->attributes['post_orderby'] = $this->attributes['alphabetic_order'];
        $this->attributes['post_order']   = $this->attributes['order'];
    }

    protected function render_callback() {
        $this->views( 'widgets/archive-list' );
    }

    public function view_params() {
        global $wp_query;

        $_term_slug = '';
        if ( isset( $wp_query->query ) && array_key_exists( 'doc_category', $wp_query->query ) ) {
            $_term_slug = $wp_query->query['doc_category'];
        }

        $term = get_term_by( 'slug', $_term_slug, 'doc_category' );

        $_docs_query = [
            'term_id'        => isset( $term->term_id ) ? $term->term_id : 0,
            'orderby'        => $this->attributes['alphabetic_order'],
            'order'          => $this->attributes['order'],
            'kb_slug'        => '',
            'posts_per_page' => $term == false ? 5 : -1,
            'term_slug'      => isset( $term->slug ) ? $term->slug : ''
        ];

        return [
            'term'                   => $term,
            'nested_subcategory'     => (bool) $this->attributes['nested_subcategory'],
            'query_args'             => betterdocs()->query->docs_query_args( $_docs_query ),
            'nested_docs_query_args' => [
                'orderby' => $this->attributes['alphabetic_order'],
                'order'   => $this->attributes['order']
            ],
            'nested_terms_query'     => [
                'orderby' => $this->attributes['alphabetic_order'],
                'order'   => $this->attributes['order']
            ]
        ];
    }

    public function render_plain_content() {}
}
