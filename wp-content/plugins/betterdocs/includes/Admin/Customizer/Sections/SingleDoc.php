<?php

namespace WPDeveloper\BetterDocs\Admin\Customizer\Sections;

use WP_Customize_Control;
use WP_Customize_Image_Control;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\TitleControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\NumberControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\SelectControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\ToggleControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\DimensionControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\SeparatorControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\AlphaColorControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\RadioImageControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\RangeValueControl;

class SingleDoc extends Section {
    /**
     * Section Priority
     * @var int
     */
    protected $priority = 101;

    /**
     * Get the section id.
     * @return string
     */
    public function get_id() {
        return 'betterdocs_single_docs_settings';
    }

    /**
     * Get the title of the section.
     * @return string
     */
    public function get_title() {
        return __( 'Single Doc', 'betterdocs' );
    }

    public function single_layout_select() {
        $this->customizer->add_setting( 'betterdocs_single_layout_select', [
            'default'           => $this->defaults['betterdocs_single_layout_select'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'select']
        ] );

        $this->customizer->add_control(
            new RadioImageControl(
                $this->customizer,
                'betterdocs_single_layout_select',
                [
                    'type'     => 'betterdocs-radio-image',
                    'settings' => 'betterdocs_single_layout_select',
                    'section'  => 'betterdocs_single_docs_settings',
                    'label'    => __( 'Select Layout', 'betterdocs' ),
                    'priority' => 102,
                    'choices'  => apply_filters( 'betterdocs_single_layout_select_choices', [
                        'layout-1' => [
                            'label' => __( 'Classic Layout', 'betterdocs' ),
                            'image' => $this->assets->icon( 'customizer/single/layout-1.png', true )
                        ],
                        'layout-4' => [
                            'label' => __( 'Abstract Layout', 'betterdocs' ),
                            'image' => $this->assets->icon( 'customizer/single/layout-4.png', true ),
                            'pro'   => false
                        ],
                        'layout-5' => [
                            'label' => __( 'Modern Layout', 'betterdocs' ),
                            'image' => $this->assets->icon( 'customizer/single/layout-5.png', true ),
                            'pro'   => false
                        ],
                        'layout-2' => [
                            'label' => __( 'Minimalist Layout', 'betterdocs' ),
                            'image' => $this->assets->icon( 'customizer/single/layout-2.png', true ),
                            'pro'   => true,
                            'url'   => 'https://betterdocs.co/upgrade'
                        ],
                        'layout-3' => [
                            'label' => __( 'Artisan Layout', 'betterdocs' ),
                            'image' => $this->assets->icon( 'customizer/single/layout-3.png', true ),
                            'pro'   => true,
                            'url'   => 'https://betterdocs.co/upgrade'
                        ],
                        'layout-6' => [
                            'label' => __( 'Bohemian Layout', 'betterdocs' ),
                            'image' => $this->assets->icon( 'customizer/single/layout-6.png', true ),
                            'pro'   => true,
                            'url'   => 'https://betterdocs.co/upgrade'
                        ]
                    ] )
                ]
            )
        );
    }

    public function doc_single_content_area_bg_color() {
        $this->customizer->add_setting( 'betterdocs_doc_single_content_area_bg_color', [
            'default'           => $this->defaults['betterdocs_doc_single_content_area_bg_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_doc_single_content_area_bg_color',
                [
                    'label'    => __( 'Content Area Background Color', 'betterdocs' ),
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_doc_single_content_area_bg_color',
                    'priority' => 103
                ]
            )
        );
    }

    public function doc_single_content_area_bg_image() {
        $this->customizer->add_setting( 'betterdocs_doc_single_content_area_bg_image', [
            'default'    => $this->defaults['betterdocs_doc_single_content_area_bg_image'],
            'capability' => 'edit_theme_options',
            'transport'  => 'postMessage'
        ] );

        $this->customizer->add_control(
            new WP_Customize_Image_Control(
                $this->customizer,
                'betterdocs_doc_single_content_area_bg_image',
                [
                    'label'    => __( 'Background Image', 'betterdocs' ),
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_doc_single_content_area_bg_image',
                    'priority' => 103
                ] )
        );
    }

    public function doc_single_content_bg_property() {
        $this->customizer->add_setting( 'betterdocs_doc_single_content_bg_property', [
            'default'           => $this->defaults['betterdocs_doc_single_content_bg_property'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'select']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_doc_single_content_bg_property', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_content_bg_property',
                'priority'    => 103,
                'label'       => __( 'Background Property', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_doc_single_content_bg_property',
                    'class' => 'betterdocs-select'
                ]
            ] )
        );
    }

    public function doc_single_content_bg_property_size() {
        $this->customizer->add_setting( 'betterdocs_doc_single_content_bg_property_size', [
            'default'           => $this->defaults['betterdocs_doc_single_content_bg_property_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'select']

        ] );

        $this->customizer->add_control( new SelectControl(
            $this->customizer, 'betterdocs_doc_single_content_bg_property_size', [
                'type'        => 'betterdocs-select',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_content_bg_property_size',
                'priority'    => 103,
                'label'       => __( 'Size', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_content_bg_property betterdocs-select'
                ],
                'choices'     => [
                    'auto'    => __( 'auto', 'betterdocs' ),
                    'length'  => __( 'length', 'betterdocs' ),
                    'cover'   => __( 'cover', 'betterdocs' ),
                    'contain' => __( 'contain', 'betterdocs' ),
                    'initial' => __( 'initial', 'betterdocs' ),
                    'inherit' => __( 'inherit', 'betterdocs' )
                ]
            ] )
        );
    }

    public function doc_single_content_bg_property_repeat() {
        $this->customizer->add_setting( 'betterdocs_doc_single_content_bg_property_repeat', [
            'default'           => $this->defaults['betterdocs_doc_single_content_bg_property_repeat'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'select']
        ] );

        $this->customizer->add_control( new SelectControl(
            $this->customizer, 'betterdocs_doc_single_content_bg_property_repeat', [
                'type'        => 'betterdocs-select',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_content_bg_property_repeat',
                'priority'    => 103,
                'label'       => __( 'Repeat', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_content_bg_property betterdocs-select'
                ],
                'choices'     => [
                    'no-repeat' => __( 'no-repeat', 'betterdocs' ),
                    'initial'   => __( 'initial', 'betterdocs' ),
                    'inherit'   => __( 'inherit', 'betterdocs' ),
                    'repeat'    => __( 'repeat', 'betterdocs' ),
                    'repeat-x'  => __( 'repeat-x', 'betterdocs' ),
                    'repeat-y'  => __( 'repeat-y', 'betterdocs' )
                ]
            ] )
        );
    }

    public function doc_single_content_bg_property_attachment() {
        $this->customizer->add_setting( 'betterdocs_doc_single_content_bg_property_attachment', [
            'default'           => $this->defaults['betterdocs_doc_single_content_bg_property_attachment'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'select']

        ] );

        $this->customizer->add_control( new SelectControl(
            $this->customizer, 'betterdocs_doc_single_content_bg_property_attachment', [
                'type'        => 'betterdocs-select',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_content_bg_property_attachment',
                'priority'    => 103,
                'label'       => __( 'Attachment', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_content_bg_property betterdocs-select'
                ],
                'choices'     => [
                    'initial' => __( 'initial', 'betterdocs' ),
                    'inherit' => __( 'inherit', 'betterdocs' ),
                    'scroll'  => __( 'scroll', 'betterdocs' ),
                    'fixed'   => __( 'fixed', 'betterdocs' ),
                    'local'   => __( 'local', 'betterdocs' )
                ]
            ] )
        );
    }

    public function doc_single_content_bg_property_position() {
        $this->customizer->add_setting( 'betterdocs_doc_single_content_bg_property_position', [
            'default'           => $this->defaults['betterdocs_doc_single_content_bg_property_position'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'esc_html'

        ] );

        $this->customizer->add_control( new SelectControl(
            $this->customizer, 'betterdocs_doc_single_content_bg_property_position', [
                'type'        => 'betterdocs-select',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_content_bg_property_position',
                'priority'    => 103,
                'label'       => __( 'Position', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_content_bg_property betterdocs-select'
                ],
                'choices'     => [
                    'left top'      => __( 'left top', 'betterdocs' ),
                    'left center'   => __( 'left center', 'betterdocs' ),
                    'left bottom'   => __( 'left bottom', 'betterdocs' ),
                    'right top'     => __( 'right top', 'betterdocs' ),
                    'right center'  => __( 'right center', 'betterdocs' ),
                    'right bottom'  => __( 'right bottom', 'betterdocs' ),
                    'center top'    => __( 'center top', 'betterdocs' ),
                    'center center' => __( 'center center', 'betterdocs' ),
                    'center bottom' => __( 'center bottom', 'betterdocs' )
                ]
            ] )
        );
    }

    public function doc_single_content_area_padding() {
        $this->customizer->add_setting( 'betterdocs_doc_single_content_area_padding', [
            'default'           => $this->defaults['betterdocs_doc_single_content_area_padding'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_doc_single_content_area_padding', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_content_area_padding',
                'label'       => __( 'Content Area Padding', 'betterdocs' ),
                'priority'    => 104,
                'input_attrs' => [
                    'id'    => 'betterdocs_doc_single_content_area_padding',
                    'class' => 'betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_content_area_padding_top', [
            'default'           => $this->defaults['betterdocs_doc_single_content_area_padding_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_content_area_padding_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_content_area_padding_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'priority'    => 104,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_content_area_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_content_area_padding_right', [
            'default'           => $this->defaults['betterdocs_doc_single_content_area_padding_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_content_area_padding_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_content_area_padding_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'priority'    => 104,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_content_area_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_content_area_padding_bottom', [
            'default'           => $this->defaults['betterdocs_doc_single_content_area_padding_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_content_area_padding_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_content_area_padding_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'priority'    => 104,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_content_area_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_content_area_padding_left', [
            'default'           => $this->defaults['betterdocs_doc_single_content_area_padding_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_content_area_padding_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_content_area_padding_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'priority'    => 104,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_content_area_padding betterdocs-dimension'
                ]
            ] )
        );
    }

    public function doc_single_post_content_padding() {
        $this->customizer->add_setting( 'betterdocs_doc_single_post_content_padding', [
            'default'           => $this->defaults['betterdocs_doc_single_post_content_padding'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_doc_single_post_content_padding', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_post_content_padding',
                'label'       => __( 'Doc Content Padding', 'betterdocs' ),
                'priority'    => 109,
                'input_attrs' => [
                    'id'    => 'betterdocs_doc_single_post_content_padding',
                    'class' => 'betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_post_content_padding_top', [
            'default'           => $this->defaults['betterdocs_doc_single_post_content_padding_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_post_content_padding_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_post_content_padding_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'priority'    => 109,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_post_content_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_post_content_padding_right', [
            'default'           => $this->defaults['betterdocs_doc_single_post_content_padding_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_post_content_padding_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_post_content_padding_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'priority'    => 109,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_post_content_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_post_content_padding_bottom', [
            'default'           => $this->defaults['betterdocs_doc_single_post_content_padding_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_post_content_padding_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_post_content_padding_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'priority'    => 109,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_post_content_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_post_content_padding_left', [
            'default'           => $this->defaults['betterdocs_doc_single_post_content_padding_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_post_content_padding_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_post_content_padding_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'priority'    => 109,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_post_content_padding betterdocs-dimension'
                ]
            ] )
        );
    }

    public function doc_single_2_post_content_padding() {
        $this->customizer->add_setting( 'betterdocs_doc_single_2_post_content_padding', [
            'default'           => $this->defaults['betterdocs_doc_single_2_post_content_padding'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_doc_single_2_post_content_padding', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_2_post_content_padding',
                'label'       => __( 'Post Content Padding', 'betterdocs' ),
                'priority'    => 114,
                'input_attrs' => [
                    'id'    => 'betterdocs_doc_single_2_post_content_padding',
                    'class' => 'betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_2_post_content_padding_top', [
            'default'           => $this->defaults['betterdocs_doc_single_2_post_content_padding_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_2_post_content_padding_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_2_post_content_padding_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'priority'    => 114,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_2_post_content_padding  betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_2_post_content_padding_right', [
            'default'           => $this->defaults['betterdocs_doc_single_2_post_content_padding_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_2_post_content_padding_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_2_post_content_padding_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'priority'    => 114,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_2_post_content_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_2_post_content_padding_bottom', [
            'default'           => $this->defaults['betterdocs_doc_single_2_post_content_padding_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_2_post_content_padding_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_2_post_content_padding_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'priority'    => 114,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_2_post_content_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_2_post_content_padding_left', [
            'default'           => $this->defaults['betterdocs_doc_single_2_post_content_padding_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_2_post_content_padding_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_2_post_content_padding_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'priority'    => 114,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_2_post_content_padding betterdocs-dimension'
                ]
            ] )
        );
    }

    public function doc_single_3_post_content_padding() {
        $this->customizer->add_setting( 'betterdocs_doc_single_3_post_content_padding', [
            'default'           => $this->defaults['betterdocs_doc_single_3_post_content_padding'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_doc_single_3_post_content_padding', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_3_post_content_padding',
                'label'       => __( 'Content Area Inner Padding', 'betterdocs' ),
                'priority'    => 119,
                'input_attrs' => [
                    'id'    => 'betterdocs_doc_single_3_post_content_padding',
                    'class' => 'betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_3_post_content_padding_top', [
            'default'           => $this->defaults['betterdocs_doc_single_3_post_content_padding_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_3_post_content_padding_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_3_post_content_padding_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'priority'    => 119,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_3_post_content_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_3_post_content_padding_right', [
            'default'           => $this->defaults['betterdocs_doc_single_3_post_content_padding_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_3_post_content_padding_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_3_post_content_padding_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'priority'    => 119,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_3_post_content_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_3_post_content_padding_bottom', [
            'default'           => $this->defaults['betterdocs_doc_single_3_post_content_padding_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_3_post_content_padding_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_3_post_content_padding_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'priority'    => 119,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_3_post_content_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_3_post_content_padding_left', [
            'default'           => $this->defaults['betterdocs_doc_single_3_post_content_padding_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_3_post_content_padding_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_3_post_content_padding_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'priority'    => 119,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_3_post_content_padding betterdocs-dimension'
                ]
            ] )
        );
    }

    public function single_doc_title() {
        $this->customizer->add_setting( 'betterdocs_single_doc_title', [
            'default'           => $this->defaults['betterdocs_single_doc_title'],
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control( new SeparatorControl(
            $this->customizer, 'betterdocs_single_doc_title', [
                'label'    => __( 'Post Title', 'betterdocs' ),
                'priority' => 124,
                'settings' => 'betterdocs_single_doc_title',
                'section'  => 'betterdocs_single_docs_settings'
            ] )
        );
    }

    public function post_title_tag() {
        $this->customizer->add_setting( 'betterdocs_post_title_tag', [
            'default'           => $this->defaults['betterdocs_post_title_tag'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'select']
        ] );

        $this->customizer->add_control(
            new WP_Customize_Control(
                $this->customizer,
                'betterdocs_post_title_tag',
                [
                    'label'    => __( 'Title Tag', 'betterdocs' ),
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_post_title_tag',
                    'type'     => 'select',
                    'choices'  => [
                        'h1' => 'h1',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6'
                    ],
                    'priority' => 124
                ]
            )
        );
    }

    public function post_title_text_transform() {
        $this->customizer->add_setting( 'betterdocs_post_title_text_transform', [
            'default'           => $this->defaults['betterdocs_post_title_text_transform'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'select']
        ] );

        $this->customizer->add_control(
            new WP_Customize_Control(
                $this->customizer,
                'betterdocs_post_title_text_transform',
                [
                    'label'    => __( 'Text Transform', 'betterdocs' ),
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_post_title_text_transform',
                    'type'     => 'select',
                    'choices'  => [
                        'uppercase' => 'Uppercase',
                        'lowercase' => 'Lowercase',
                        'capitalize' => 'Capitalize',
                        'none' => 'Normal'
                    ],
                    'priority' => 124
                ]
            )
        );
    }

    public function single_doc_title_font_size() {
        $this->customizer->add_setting( 'betterdocs_single_doc_title_font_size', [
            'default'           => $this->defaults['betterdocs_single_doc_title_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_single_doc_title_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_single_doc_title_font_size',
                'label'       => __( 'Font Size', 'betterdocs' ),
                'priority'    => 125,
                'input_attrs' => [
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function single_doc_title_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_title_color', [
            'capability'        => 'edit_theme_options',
            'default'           => $this->defaults['betterdocs_single_doc_title_color'],
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_title_color',
                [
                    'label'    => __( 'Color', 'betterdocs' ),
                    'priority' => 126,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_single_doc_title_color'
                ]
            )
        );
    }

    public function doc_single_toc_title() {
        $this->customizer->add_setting( 'betterdocs_doc_single_toc_title', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_title'],
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control( new SeparatorControl(
            $this->customizer, 'betterdocs_doc_single_toc_title', [
                'label'    => __( 'Table of Contents', 'betterdocs' ),
                'priority' => 132,
                'settings' => 'betterdocs_doc_single_toc_title',
                'section'  => 'betterdocs_single_docs_settings'
            ] )
        );
    }

    public function sticky_toc_width() {
        $this->customizer->add_setting( 'betterdocs_sticky_toc_width', [
            'default'           => $this->defaults['betterdocs_sticky_toc_width'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_sticky_toc_width', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_sticky_toc_width',
                'label'       => __( 'Sticky Toc Width', 'betterdocs' ),
                'priority'    => 133,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 100,
                    'max'    => 500,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function sticky_toc_zindex() {
        $this->customizer->add_setting( 'betterdocs_sticky_toc_zindex', [
            'default'           => $this->defaults['betterdocs_sticky_toc_zindex'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new NumberControl(
            $this->customizer, 'betterdocs_sticky_toc_zindex', [
                'type'     => 'betterdocs-number',
                'section'  => 'betterdocs_single_docs_settings',
                'settings' => 'betterdocs_sticky_toc_zindex',
                'label'    => __( 'Sticky Toc z-index', 'betterdocs' ),
                'priority' => 134
            ] )
        );
    }

    public function sticky_toc_margin_top() {
        $this->customizer->add_setting( 'betterdocs_sticky_toc_margin_top', [
            'default'           => $this->defaults['betterdocs_sticky_toc_margin_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_sticky_toc_margin_top', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_sticky_toc_margin_top',
                'label'       => __( 'Sticky Toc Margin Top', 'betterdocs' ),
                'priority'    => 135,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 500,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function toc_bg_color() {
        $this->customizer->add_setting( 'betterdocs_toc_bg_color', [
            'capability'        => 'edit_theme_options',
            'default'           => $this->defaults['betterdocs_toc_bg_color'],
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_toc_bg_color',
                [
                    'label'    => __( 'Background Color', 'betterdocs' ),
                    'priority' => 136,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_toc_bg_color'
                ]
            )
        );
    }

    public function doc_single_toc_padding() {
        $this->customizer->add_setting( 'betterdocs_doc_single_toc_padding', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_padding'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_doc_single_toc_padding', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_padding',
                'label'       => __( 'Content Area Padding', 'betterdocs' ),
                'priority'    => 137,
                'input_attrs' => [
                    'id'    => 'betterdocs_doc_single_toc_padding',
                    'class' => 'betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_toc_padding_top', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_padding_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_toc_padding_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_padding_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'priority'    => 137,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_toc_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_toc_padding_right', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_padding_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_toc_padding_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_padding_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'priority'    => 137,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_toc_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_toc_padding_bottom', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_padding_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_toc_padding_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_padding_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'priority'    => 137,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_toc_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_toc_padding_left', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_padding_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_toc_padding_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_padding_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'priority'    => 137,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_toc_padding betterdocs-dimension'
                ]
            ] )
        );
    }

    public function doc_single_toc_margin() {
        $this->customizer->add_setting( 'betterdocs_doc_single_toc_margin', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_margin'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_doc_single_toc_margin', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_margin',
                'label'       => __( 'Content Area Margin', 'betterdocs' ),
                'priority'    => 141,
                'input_attrs' => [
                    'id'    => 'betterdocs_doc_single_toc_margin',
                    'class' => 'betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_toc_margin_top', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_margin_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_toc_margin_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_margin_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'priority'    => 141,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_toc_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_toc_margin_right', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_margin_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_toc_margin_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_margin_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'priority'    => 141,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_toc_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_toc_margin_bottom', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_margin_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_toc_margin_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_margin_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'priority'    => 141,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_toc_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_toc_margin_left', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_margin_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_toc_margin_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_margin_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'priority'    => 141,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_toc_margin betterdocs-dimension'
                ]
            ] )
        );
    }

    public function toc_title_color() {
        $this->customizer->add_setting( 'betterdocs_toc_title_color', [
            'capability'        => 'edit_theme_options',
            'default'           => $this->defaults['betterdocs_toc_title_color'],
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_toc_title_color',
                [
                    'label'    => __( 'Title Color', 'betterdocs' ),
                    'priority' => 142,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_toc_title_color'
                ]
            )
        );
    }

    public function toc_title_font_size() {
        $this->customizer->add_setting( 'betterdocs_toc_title_font_size', [
            'default'           => $this->defaults['betterdocs_toc_title_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_toc_title_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_toc_title_font_size',
                'label'       => __( 'Title Font Size', 'betterdocs' ),
                'priority'    => 143,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function toc_list_item_color() {
        $this->customizer->add_setting( 'betterdocs_toc_list_item_color', [
            'default'           => $this->defaults['betterdocs_toc_list_item_color'],
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_toc_list_item_color',
                [
                    'label'    => __( 'List Item Color', 'betterdocs' ),
                    'priority' => 144,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_toc_list_item_color'
                ]
            )
        );
    }

    public function toc_list_item_hover_color() {
        $this->customizer->add_setting( 'betterdocs_toc_list_item_hover_color', [
            'capability'        => 'edit_theme_options',
            'default'           => $this->defaults['betterdocs_toc_list_item_hover_color'],
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_toc_list_item_hover_color',
                [
                    'label'    => __( 'List Item Hover Color', 'betterdocs' ),
                    'priority' => 145,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_toc_list_item_hover_color'
                ]
            )
        );
    }

    public function toc_active_item_color() {
        $this->customizer->add_setting( 'betterdocs_toc_active_item_color', [
            'capability'        => 'edit_theme_options',
            'default'           => $this->defaults['betterdocs_toc_active_item_color'],
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_toc_active_item_color',
                [
                    'label'    => __( 'Active Item Color', 'betterdocs' ),
                    'priority' => 146,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_toc_active_item_color'
                ]
            )
        );
    }

    public function toc_list_item_font_size() {
        $this->customizer->add_setting( 'betterdocs_toc_list_item_font_size', [
            'default'           => $this->defaults['betterdocs_toc_list_item_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_toc_list_item_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_toc_list_item_font_size',
                'label'       => __( 'List Item Font Size', 'betterdocs' ),
                'priority'    => 147,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function doc_single_toc_list_margin() {
        $this->customizer->add_setting( 'betterdocs_doc_single_toc_list_margin', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_list_margin'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_doc_single_toc_list_margin', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_list_margin',
                'label'       => __( 'TOC List Margin', 'betterdocs' ),
                'priority'    => 148,
                'input_attrs' => [
                    'id'    => 'betterdocs_doc_single_toc_list_margin',
                    'class' => 'betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_toc_list_margin_top', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_list_margin_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_toc_list_margin_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_list_margin_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'priority'    => 148,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_toc_list_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_toc_list_margin_right', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_list_margin_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_toc_list_margin_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_list_margin_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'priority'    => 148,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_toc_list_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_toc_list_margin_bottom', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_list_margin_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_toc_list_margin_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_list_margin_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'priority'    => 148,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_toc_list_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_doc_single_toc_list_margin_left', [
            'default'           => $this->defaults['betterdocs_doc_single_toc_list_margin_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_doc_single_toc_list_margin_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_doc_single_toc_list_margin_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'priority'    => 148,
                'input_attrs' => [
                    'class' => 'betterdocs_doc_single_toc_list_margin betterdocs-dimension'
                ]
            ] )
        );
    }

    public function toc_list_number_color() {
        $this->customizer->add_setting( 'betterdocs_toc_list_number_color', [
            'default'           => $this->defaults['betterdocs_toc_list_number_color'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_toc_list_number_color',
                [
                    'label'    => __( 'List Number Color', 'betterdocs' ),
                    'priority' => 153,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_toc_list_number_color'
                ]
            )
        );
    }

    public function toc_list_number_font_size() {
        $this->customizer->add_setting( 'betterdocs_toc_list_number_font_size', [
            'default'           => $this->defaults['betterdocs_toc_list_number_font_size'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_toc_list_number_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_toc_list_number_font_size',
                'label'       => __( 'List Number Font Size', 'betterdocs' ),
                'priority'    => 154,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function toc_margin_bottom() {
        $this->customizer->add_setting( 'betterdocs_toc_margin_bottom', [
            'default'           => $this->defaults['betterdocs_toc_margin_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_toc_margin_bottom', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_toc_margin_bottom',
                'label'       => __( 'TOC Margin Bottom', 'betterdocs' ),
                'priority'    => 155,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 500,
                    'step'   => 1,
                    'suffix' => 'px' // optional suffix
                ]
            ] )
        );
    }

    public function doc_single_entry_content() {
        $this->customizer->add_setting( 'betterdocs_doc_single_entry_content', [
            'default'           => $this->defaults['betterdocs_doc_single_entry_content'],
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control( new SeparatorControl(
            $this->customizer, 'betterdocs_doc_single_entry_content', [
                'label'    => __( 'Entry Content', 'betterdocs' ),
                'priority' => 156,
                'settings' => 'betterdocs_doc_single_entry_content',
                'section'  => 'betterdocs_single_docs_settings'
            ] )
        );
    }

    public function single_content_font_size() {
        $this->customizer->add_setting( 'betterdocs_single_content_font_size', [
            'default'           => $this->defaults['betterdocs_single_content_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_single_content_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_single_content_font_size',
                'label'       => __( 'Font Size', 'betterdocs' ),
                'priority'    => 157,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' // optional suffix
                ]
            ] )
        );
    }

    public function single_content_font_color() {
        $this->customizer->add_setting( 'betterdocs_single_content_font_color', [
            'default'           => $this->defaults['betterdocs_single_content_font_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_content_font_color',
                [
                    'label'    => __( 'Font Color', 'betterdocs' ),
                    'priority' => 158,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_single_content_font_color'
                ]
            )
        );
    }

    public function social_share_title() {
        $this->customizer->add_setting( 'betterdocs_social_share_title', [
            'default'           => '',
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control(
            new SeparatorControl(
                $this->customizer, 'betterdocs_social_share_title', [
                    'label'    => __( 'Social Share', 'betterdocs' ),
                    'priority' => 164,
                    'settings' => 'betterdocs_social_share_title',
                    'section'  => 'betterdocs_single_docs_settings'
                ]
            )
        );
    }

    public function post_social_share() {
        $this->customizer->add_setting( 'betterdocs_post_social_share', [
            'default'           => $this->defaults['betterdocs_post_social_share'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'checkbox']
        ] );

        $this->customizer->add_control(
            new ToggleControl(
                $this->customizer, 'betterdocs_post_social_share', [
                    'label'    => __( 'Enable Social Sharing?', 'betterdocs' ),
                    'priority' => 165,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_post_social_share',
                    'type'     => 'light' // light, ios, flat
                ]
            )
        );
    }

    public function social_sharing_text() {
        $this->customizer->add_setting( 'betterdocs_social_sharing_text', [
            'default'           => $this->defaults['betterdocs_social_sharing_text'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control(
            new SelectControl(
                $this->customizer,
                'betterdocs_social_sharing_text',
                [
                    'label'    => __( 'Social Sharing Title', 'betterdocs' ),
                    'priority' => 166,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_social_sharing_text',
                    'type'     => 'text'
                ]
            )
        );
    }

    public function post_social_share_text_color() {
        $this->customizer->add_setting( 'betterdocs_post_social_share_text_color', [
            'default'           => $this->defaults['betterdocs_post_social_share_text_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_post_social_share_text_color',
                [
                    'label'    => __( 'Title Text Color', 'betterdocs' ),
                    'priority' => 167,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_post_social_share_text_color'
                ]
            )
        );
    }

    public function post_social_share_facebook() {
        $this->customizer->add_setting( 'betterdocs_post_social_share_facebook', [
            'default'           => $this->defaults['betterdocs_post_social_share_facebook'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'checkbox']
        ] );

        $this->customizer->add_control( new ToggleControl(
            $this->customizer, 'betterdocs_post_social_share_facebook', [
                'label'    => __( 'Facebook Sharing', 'betterdocs' ),
                'priority' => 168,
                'section'  => 'betterdocs_single_docs_settings',
                'settings' => 'betterdocs_post_social_share_facebook',
                'type'     => 'light' // light, ios, flat
            ] )
        );
    }

    public function post_social_share_twitter() {
        $this->customizer->add_setting( 'betterdocs_post_social_share_twitter', [
            'default'           => $this->defaults['betterdocs_post_social_share_twitter'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'checkbox']
        ] );

        $this->customizer->add_control( new ToggleControl(
            $this->customizer, 'betterdocs_post_social_share_twitter', [
                'label'    => __( 'Twitter Sharing', 'betterdocs' ),
                'priority' => 169,
                'section'  => 'betterdocs_single_docs_settings',
                'settings' => 'betterdocs_post_social_share_twitter',
                'type'     => 'light' // light, ios, flat
            ] )
        );
    }

    public function post_social_share_linkedin() {
        $this->customizer->add_setting( 'betterdocs_post_social_share_linkedin', [
            'default'           => $this->defaults['betterdocs_post_social_share_linkedin'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'checkbox']
        ] );

        $this->customizer->add_control( new ToggleControl( $this->customizer, 'betterdocs_post_social_share_linkedin', [
            'label'    => __( 'Linkedin Sharing', 'betterdocs' ),
            'priority' => 170,
            'section'  => 'betterdocs_single_docs_settings',
            'settings' => 'betterdocs_post_social_share_linkedin',
            'type'     => 'light' // light, ios, flat
        ] ) );
    }

    public function post_social_share_pinterest() {
        $this->customizer->add_setting( 'betterdocs_post_social_share_pinterest', [
            'default'           => $this->defaults['betterdocs_post_social_share_pinterest'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'checkbox']
        ] );

        $this->customizer->add_control( new ToggleControl( $this->customizer, 'betterdocs_post_social_share_pinterest', [
            'label'    => __( 'Pinterest Sharing', 'betterdocs' ),
            'priority' => 171,
            'section'  => 'betterdocs_single_docs_settings',
            'settings' => 'betterdocs_post_social_share_pinterest',
            'type'     => 'light' // light, ios, flat
        ] ) );
    }

    public function doc_single_entry_footer() {
        $this->customizer->add_setting( 'betterdocs_doc_single_entry_footer', [
            'default'           => $this->defaults['betterdocs_doc_single_entry_footer'],
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control( new SeparatorControl(
            $this->customizer, 'betterdocs_doc_single_entry_footer', [
                'label'    => __( 'Entry Footer', 'betterdocs' ),
                'priority' => 172,
                'settings' => 'betterdocs_doc_single_entry_footer',
                'section'  => 'betterdocs_single_docs_settings'
            ] )
        );
    }

    public function single_doc_feedback_icon_font_size() {
        $this->customizer->add_setting( 'betterdocs_single_doc_feedback_icon_font_size', [
            'default'           => $this->defaults['betterdocs_single_doc_feedback_icon_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_single_doc_feedback_icon_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_single_doc_feedback_icon_font_size',
                'label'       => __( 'Feedback Icon Size', 'betterdocs' ),
                'priority'    => 173,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 100,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function single_doc_feedback_icon() {
        $this->customizer->add_setting( 'betterdocs_single_doc_feedback_icon', [
            'default'    => $this->defaults['betterdocs_single_doc_feedback_icon'],
            'capability' => 'edit_theme_options'
        ] );

        $this->customizer->add_control( new WP_Customize_Image_Control(
            $this->customizer, 'betterdocs_single_doc_feedback_icon', [
                'section'  => 'betterdocs_single_docs_settings',
                'settings' => 'betterdocs_single_doc_feedback_icon',
                'label'    => __( 'Feedback Icon', 'betterdocs' ),
                'priority' => 173
            ] )
        );
    }

    public function single_doc_feedback_link_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_feedback_link_color', [
            'default'           => $this->defaults['betterdocs_single_doc_feedback_link_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_feedback_link_color',
                [
                    'label'    => __( 'Feedback Link Color', 'betterdocs' ),
                    'priority' => 174,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_single_doc_feedback_link_color'
                ]
            )
        );
    }

    public function single_doc_feedback_link_hover_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_feedback_link_hover_color', [
            'default'           => $this->defaults['betterdocs_single_doc_feedback_link_hover_color'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_feedback_link_hover_color',
                [
                    'label'    => __( 'Feedback Link Hover Color', 'betterdocs' ),
                    'priority' => 175,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_single_doc_feedback_link_hover_color'
                ]
            )
        );
    }

    public function single_doc_feedback_link_font_size() {
        $this->customizer->add_setting( 'betterdocs_single_doc_feedback_link_font_size', [
            'default'           => $this->defaults['betterdocs_single_doc_feedback_link_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_single_doc_feedback_link_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_single_doc_feedback_link_font_size',
                'label'       => __( 'Feedback Link Font Size', 'betterdocs' ),
                'priority'    => 175,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function feedback_form_title_tag() {
        $this->customizer->add_setting( 'betterdocs_feedback_form_title_tag', [
            'default'           => $this->defaults['betterdocs_feedback_form_title_tag'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'select']
        ] );

        $this->customizer->add_control(
            new WP_Customize_Control(
                $this->customizer,
                'betterdocs_feedback_form_title_tag',
                [
                    'label'    => __( 'Feedback Form Title Tag', 'betterdocs' ),
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_feedback_form_title_tag',
                    'priority' => 175,
                    'type'     => 'select',
                    'choices'  => [
                        'h1' => 'h1',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6'
                    ]
                ]
            )
        );
    }

    public function single_doc_feedback_title_font_size() {
        $this->customizer->add_setting( 'betterdocs_single_doc_feedback_title_font_size', [
            'default'           => $this->defaults['betterdocs_single_doc_feedback_title_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_single_doc_feedback_title_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_single_doc_feedback_title_font_size',
                'label'       => __( 'Feedback Form Title Font Size', 'betterdocs' ),
                'priority'    => 175,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 100,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function single_doc_feedback_title_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_feedback_title_color', [
            'default'           => $this->defaults['betterdocs_single_doc_feedback_title_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_feedback_title_color',
                [
                    'label'    => __( 'Feedback Form Title Color', 'betterdocs' ),
                    'priority' => 175,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_single_doc_feedback_title_color'
                ]
            )
        );
    }

    public function single_doc_navigation_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_navigation_color', [
            'default'           => $this->defaults['betterdocs_single_doc_navigation_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_navigation_color',
                [
                    'label'    => __( 'Navigation Color', 'betterdocs' ),
                    'priority' => 177,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_single_doc_navigation_color'
                ]
            )
        );
    }

    public function single_doc_navigation_font_size() {
        $this->customizer->add_setting( 'betterdocs_single_doc_navigation_font_size', [
            'default'           => $this->defaults['betterdocs_single_doc_navigation_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_single_doc_navigation_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_single_doc_navigation_font_size',
                'label'       => __( 'Navigation Font Size', 'betterdocs' ),
                'priority'    => 178,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function single_doc_navigation_hover_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_navigation_hover_color', [
            'default'           => $this->defaults['betterdocs_single_doc_navigation_hover_color'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_navigation_hover_color',
                [
                    'label'    => __( 'Navigation Hover Color', 'betterdocs' ),
                    'priority' => 179,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_single_doc_navigation_hover_color'
                ]
            )
        );
    }

    public function single_doc_navigation_arrow_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_navigation_arrow_color', [
            'default'           => $this->defaults['betterdocs_single_doc_navigation_arrow_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_navigation_arrow_color',
                [
                    'label'    => __( 'Navigation Arrow Color', 'betterdocs' ),
                    'priority' => 180,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_single_doc_navigation_arrow_color'
                ]
            )
        );
    }

    public function single_doc_navigation_arrow_font_size() {
        $this->customizer->add_setting( 'betterdocs_single_doc_navigation_arrow_font_size', [
            'default'           => $this->defaults['betterdocs_single_doc_navigation_arrow_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_single_doc_navigation_arrow_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_single_doc_navigation_arrow_font_size',
                'label'       => __( 'Navigation Arrow Font Size', 'betterdocs' ),
                'priority'    => 181,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function betterdocs_single_doc_lu_time_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_lu_time_color', [
            'default'           => $this->defaults['betterdocs_single_doc_lu_time_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_lu_time_color',
                [
                    'label'    => __( 'Last Updated Time Color', 'betterdocs' ),
                    'priority' => 182,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_single_doc_lu_time_color'
                ]
            )
        );
    }

    public function single_doc_lu_time_font_size() {
        $this->customizer->add_setting( 'betterdocs_single_doc_lu_time_font_size', [
            'default'           => $this->defaults['betterdocs_single_doc_lu_time_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_single_doc_lu_time_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_single_doc_lu_time_font_size',
                'label'       => __( 'Last Updated Time Font Size', 'betterdocs' ),
                'priority'    => 183,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function single_doc_powered_by_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_powered_by_color', [
            'default'           => $this->defaults['betterdocs_single_doc_powered_by_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_powered_by_color',
                [
                    'label'    => __( 'Powered by Color', 'betterdocs' ),
                    'priority' => 184,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_single_doc_powered_by_color'
                ]
            )
        );
    }

    public function single_doc_powered_by_font_size() {
        $this->customizer->add_setting( 'betterdocs_single_doc_powered_by_font_size', [
            'default'           => $this->defaults['betterdocs_single_doc_powered_by_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_single_doc_powered_by_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_single_docs_settings',
                'settings'    => 'betterdocs_single_doc_powered_by_font_size',
                'label'       => __( 'Powered By Font Size', 'betterdocs' ),
                'priority'    => 185,
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function single_doc_powered_by_link_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_powered_by_link_color', [
            'default'           => $this->defaults['betterdocs_single_doc_powered_by_link_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_powered_by_link_color',
                [
                    'label'    => __( 'Powered By Link Color', 'betterdocs' ),
                    'priority' => 186,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_single_doc_powered_by_link_color'
                ]
            )
        );
    }

    public function reactions_title() {
        $this->customizer->add_setting( 'betterdocs_reactions_title', [
            'default'           => '',
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control( new SeparatorControl(
            $this->customizer, 'betterdocs_reactions_title', [
                'label'    => __( 'Reactions', 'betterdocs' ),
                'priority' => 159,
                'settings' => 'betterdocs_reactions_title',
                'section'  => 'betterdocs_single_docs_settings'
            ] )
        );
    }

    public function post_reactions() {
        $this->customizer->add_setting( 'betterdocs_post_reactions', [
            'default'           => $this->defaults['betterdocs_post_reactions'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'checkbox']
        ] );

        $this->customizer->add_control( new ToggleControl(
            $this->customizer, 'betterdocs_post_reactions', [
                'label'    => __( 'Enable Reactions?', 'betterdocs' ),
                'priority' => 160,
                'section'  => 'betterdocs_single_docs_settings',
                'settings' => 'betterdocs_post_reactions',
                'type'     => 'light' // light, ios, flat
            ] )
        );
    }

    public function post_reactions_text() {
        $this->customizer->add_setting( 'betterdocs_post_reactions_text', [
            'default'           => $this->defaults['betterdocs_post_reactions_text'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control(
            new SelectControl(
                $this->customizer,
                'betterdocs_post_reactions_text',
                [
                    'label'    => __( 'Reactions Title', 'betterdocs' ),
                    'priority' => 161,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_post_reactions_text',
                    'type'     => 'text'
                ]
            )
        );
    }

    public function post_reactions_text_color() {
        $this->customizer->add_setting( 'betterdocs_post_reactions_text_color', [
            'default'           => $this->defaults['betterdocs_post_reactions_text_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_post_reactions_text_color',
                [
                    'label'    => __( 'Reactions Text Color', 'betterdocs' ),
                    'priority' => 162,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_post_reactions_text_color'
                ]
            )
        );
    }

    public function post_reactions_icon_color() {
        $this->customizer->add_setting( 'betterdocs_post_reactions_icon_color', [
            'default'           => $this->defaults['betterdocs_post_reactions_icon_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_post_reactions_icon_color',
                [
                    'label'    => __( 'Reactions Icon Background Color', 'betterdocs' ),
                    'priority' => 163,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_post_reactions_icon_color'
                ]
            )
        );
    }

    public function post_reactions_icon_svg_color() {
        $this->customizer->add_setting( 'betterdocs_post_reactions_icon_svg_color', [
            'default'           => $this->defaults['betterdocs_post_reactions_icon_svg_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_post_reactions_icon_svg_color',
                [
                    'label'    => __( 'Reactions Icon Color', 'betterdocs' ),
                    'priority' => 163,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_post_reactions_icon_svg_color'
                ]
            )
        );
    }

    public function post_reactions_icon_hover_bg_color() {
        $this->customizer->add_setting( 'betterdocs_post_reactions_icon_hover_bg_color', [
            'default'           => $this->defaults['betterdocs_post_reactions_icon_hover_bg_color'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_post_reactions_icon_hover_bg_color',
                [
                    'label'    => __( 'Reactions Icon Hover Background Color', 'betterdocs' ),
                    'priority' => 163,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_post_reactions_icon_hover_bg_color'
                ]
            )
        );
    }

    public function post_reactions_icon_hover_svg_color() {
        $this->customizer->add_setting( 'betterdocs_post_reactions_icon_hover_svg_color', [
            'default'           => $this->defaults['betterdocs_post_reactions_icon_hover_svg_color'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_post_reactions_icon_hover_svg_color',
                [
                    'label'    => __( 'Reactions Icon Hover Color', 'betterdocs' ),
                    'priority' => 163,
                    'section'  => 'betterdocs_single_docs_settings',
                    'settings' => 'betterdocs_post_reactions_icon_hover_svg_color'
                ]
            )
        );
    }

}
