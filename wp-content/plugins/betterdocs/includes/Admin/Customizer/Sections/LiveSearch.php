<?php

namespace WPDeveloper\BetterDocs\Admin\Customizer\Sections;

use WP_Customize_Control;
use WP_Customize_Image_Control;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\TitleControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\SelectControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\ToggleControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\DimensionControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\SeparatorControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\AlphaColorControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\RangeValueControl;

class LiveSearch extends Section {
    /**
     * Section Priority
     * @var int
     */
    protected $priority = 500;

    /**
     * Get the section id.
     * @return string
     */
    public function get_id() {
        return 'betterdocs_live_search_settings';
    }

    /**
     * Get the title of the section.
     * @return string
     */
    public function get_title() {
        return __( 'Live Search', 'betterdocs' );
    }

    public function search_heading_switch() {
        $this->customizer->add_setting( 'betterdocs_live_search_heading_switch', [
            'default'    => $this->defaults['betterdocs_live_search_heading_switch'],
            'capability' => 'edit_theme_options'

        ] );

        $this->customizer->add_control( new ToggleControl(
            $this->customizer, 'betterdocs_live_search_heading_switch', [
                'label'    => __( 'Search Heading', 'betterdocs' ),
                'section'  => 'betterdocs_live_search_settings',
                'settings' => 'betterdocs_live_search_heading_switch',
                'type'     => 'light', // light, ios, flat
                'priority' => 501
            ] )
        );
    }

    public function search_heading() {
        $this->customizer->add_setting( 'betterdocs_live_search_heading', [
            'default'           => $this->defaults['betterdocs_live_search_heading'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control(
            new SelectControl(
                $this->customizer,
                'betterdocs_live_search_heading',
                [
                    'label'    => __( 'Heading', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_live_search_heading',
                    'type'     => 'text',
                    'priority' => 502
                ]
            )
        );
    }

    public function heading_tag() {
        $this->customizer->add_setting( 'betterdocs_live_search_heading_tag', [
            'default'           => $this->defaults['betterdocs_live_search_heading_tag'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'select']
        ] );

        $this->customizer->add_control(
            new WP_Customize_Control(
                $this->customizer,
                'betterdocs_live_search_heading_tag',
                [
                    'label'    => __( 'Heading Tags', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_live_search_heading_tag',
                    'type'     => 'select',
                    'choices'  => [
                        'h1' => 'h1',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6'
                    ],
                    'priority' => 502
                ]
            )
        );
    }

    public function heading_font_size() {
        $this->customizer->add_setting( 'betterdocs_live_search_heading_font_size', [
            'default'           => $this->defaults['betterdocs_live_search_heading_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_live_search_heading_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_heading_font_size',
                'label'       => __( 'Heading Font Size', 'betterdocs' ),
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 100,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ],
                'priority'    => 503
            ] )
        );
    }

    public function heading_font_color() {
        $this->customizer->add_setting( 'betterdocs_live_search_heading_font_color', [
            'default'           => $this->defaults['betterdocs_live_search_heading_font_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_live_search_heading_font_color',
                [
                    'label'    => __( 'Heading Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_live_search_heading_font_color',
                    'priority' => 504
                ]
            )
        );
    }

    public function heading_margin() {
        $this->customizer->add_setting( 'betterdocs_search_heading_margin', [
            'default'           => $this->defaults['betterdocs_search_heading_margin'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_search_heading_margin', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_heading_margin',
                'label'       => __( 'Heading Margin', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_search_heading_margin',
                    'class' => 'betterdocs-dimension'
                ],
                'priority'    => 505
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_heading_margin_top', [
            'default'           => $this->defaults['betterdocs_search_heading_margin_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_heading_margin_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_heading_margin_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_heading_margin betterdocs-dimension'
                ],
                'priority'    => 505
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_heading_margin_right', [
            'default'           => $this->defaults['betterdocs_search_heading_margin_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_heading_margin_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_heading_margin_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_heading_margin betterdocs-dimension'
                ],
                'priority'    => 505
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_heading_margin_bottom', [
            'default'           => $this->defaults['betterdocs_search_heading_margin_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_heading_margin_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_heading_margin_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_heading_margin betterdocs-dimension'
                ],
                'priority'    => 505
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_heading_margin_left', [
            'default'           => $this->defaults['betterdocs_search_heading_margin_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_heading_margin_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_heading_margin_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_heading_margin betterdocs-dimension'
                ],
                'priority'    => 505
            ] )
        );
    }

    public function search_subheading() {
        $this->customizer->add_setting( 'betterdocs_live_search_subheading', [
            'default'           => $this->defaults['betterdocs_live_search_subheading'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control(
            new SelectControl(
                $this->customizer,
                'betterdocs_live_search_subheading',
                [
                    'label'    => __( 'Sub Heading', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_live_search_subheading',
                    'type'     => 'text',
                    'priority' => 506
                ]
            )
        );
    }

    public function subheading_tag() {
        $this->customizer->add_setting( 'betterdocs_live_search_subheading_tag', [
            'default'           => $this->defaults['betterdocs_live_search_subheading_tag'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'select']
        ] );

        $this->customizer->add_control(
            new WP_Customize_Control(
                $this->customizer,
                'betterdocs_live_search_subheading_tag',
                [
                    'label'    => __( 'Sub Heading Tags', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_live_search_subheading_tag',
                    'type'     => 'select',
                    'choices'  => [
                        'h1' => 'h1',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6'
                    ],
                    'priority' => 507
                ]
            )
        );
    }

    public function subheading_font_size() {
        $this->customizer->add_setting( 'betterdocs_live_search_subheading_font_size', [
            'default'           => $this->defaults['betterdocs_live_search_subheading_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_live_search_subheading_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_subheading_font_size',
                'label'       => __( 'Sub Heading Font Size', 'betterdocs' ),
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 100,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ],
                'priority'    => 507
            ] )
        );
    }

    public function subheading_font_color() {
        $this->customizer->add_setting( 'betterdocs_live_search_subheading_font_color', [
            'default'           => $this->defaults['betterdocs_live_search_subheading_font_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_live_search_subheading_font_color',
                [
                    'label'    => __( 'Sub Heading Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_live_search_subheading_font_color',
                    'priority' => 508
                ]
            )
        );
    }

    public function subheading_margin() {
        $this->customizer->add_setting( 'betterdocs_search_subheading_margin', [
            'default'           => $this->defaults['betterdocs_search_subheading_margin'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_search_subheading_margin', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_subheading_margin',
                'label'       => __( 'Sub Heading Margin', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_search_subheading_margin',
                    'class' => 'betterdocs-dimension'
                ],
                'priority'    => 509
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_subheading_margin_top', [
            'default'           => $this->defaults['betterdocs_search_subheading_margin_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_subheading_margin_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_subheading_margin_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_subheading_margin betterdocs-dimension'
                ],
                'priority'    => 509
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_subheading_margin_right', [
            'default'           => $this->defaults['betterdocs_search_subheading_margin_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_subheading_margin_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_subheading_margin_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_subheading_margin betterdocs-dimension'
                ],
                'priority'    => 509
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_subheading_margin_bottom', [
            'default'           => $this->defaults['betterdocs_search_subheading_margin_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_subheading_margin_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_subheading_margin_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_subheading_margin betterdocs-dimension'
                ],
                'priority'    => 509
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_subheading_margin_left', [
            'default'           => $this->defaults['betterdocs_search_subheading_margin_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_subheading_margin_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_subheading_margin_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_subheading_margin betterdocs-dimension'
                ],
                'priority'    => 509
            ] )
        );
    }

    public function background_color() {
        $this->customizer->add_setting( 'betterdocs_live_search_background_color', [
            'default'           => $this->defaults['betterdocs_live_search_background_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_live_search_background_color',
                [
                    'label'    => __( 'Background Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_live_search_background_color',
                    'priority' => 510
                ]
            )
        );
    }

    public function background_image() {
        $this->customizer->add_setting( 'betterdocs_live_search_background_image', [
            'default'    => $this->defaults['betterdocs_live_search_background_image'],
            'capability' => 'edit_theme_options',
            'transport'  => 'postMessage'

        ] );

        $this->customizer->add_control( new WP_Customize_Image_Control(
            $this->customizer, 'betterdocs_live_search_background_image', [
                'section'  => 'betterdocs_live_search_settings',
                'settings' => 'betterdocs_live_search_background_image',
                'label'    => __( 'Background Image', 'betterdocs' ),
                'priority' => 511
            ] )
        );
    }

    public function background_property() {
        $this->customizer->add_setting( 'betterdocs_live_search_background_property', [
            'default'           => $this->defaults['betterdocs_live_search_background_property'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'select']
        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_live_search_background_property', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_background_property',
                'label'       => __( 'Background Property', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_live_search_background_property',
                    'class' => 'betterdocs-select'
                ],
                'priority'    => 512
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_live_search_background_size', [
            'default'           => $this->defaults['betterdocs_live_search_background_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'select']

        ] );

        $this->customizer->add_control( new SelectControl(
            $this->customizer, 'betterdocs_live_search_background_size', [
                'type'        => 'betterdocs-select',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_background_size',
                'label'       => __( 'Size', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_live_search_background_property betterdocs-select'
                ],
                'choices'     => [
                    'auto'    => __( 'auto', 'betterdocs' ),
                    'length'  => __( 'length', 'betterdocs' ),
                    'cover'   => __( 'cover', 'betterdocs' ),
                    'contain' => __( 'contain', 'betterdocs' ),
                    'initial' => __( 'initial', 'betterdocs' ),
                    'inherit' => __( 'inherit', 'betterdocs' )
                ],
                'priority'    => 513
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_live_search_background_repeat', [
            'default'           => $this->defaults['betterdocs_live_search_background_repeat'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'select']

        ] );

        $this->customizer->add_control( new SelectControl(
            $this->customizer, 'betterdocs_live_search_background_repeat', [
                'type'        => 'betterdocs-select',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_background_repeat',
                'label'       => __( 'Repeat', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_live_search_background_property betterdocs-select'
                ],
                'choices'     => [
                    'no-repeat' => __( 'no-repeat', 'betterdocs' ),
                    'initial'   => __( 'initial', 'betterdocs' ),
                    'inherit'   => __( 'inherit', 'betterdocs' ),
                    'repeat'    => __( 'repeat', 'betterdocs' ),
                    'repeat-x'  => __( 'repeat-x', 'betterdocs' ),
                    'repeat-y'  => __( 'repeat-y', 'betterdocs' )
                ],
                'priority'    => 513
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_live_search_background_attachment', [
            'default'           => $this->defaults['betterdocs_live_search_background_attachment'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'select']

        ] );

        $this->customizer->add_control( new SelectControl(
            $this->customizer, 'betterdocs_live_search_background_attachment', [
                'type'        => 'betterdocs-select',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_background_attachment',
                'label'       => __( 'Attachment', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_live_search_background_property betterdocs-select'
                ],
                'choices'     => [
                    'initial' => __( 'initial', 'betterdocs' ),
                    'inherit' => __( 'inherit', 'betterdocs' ),
                    'scroll'  => __( 'scroll', 'betterdocs' ),
                    'fixed'   => __( 'fixed', 'betterdocs' ),
                    'local'   => __( 'local', 'betterdocs' )
                ],
                'priority'    => 513
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_live_search_background_position', [
            'default'           => $this->defaults['betterdocs_live_search_background_position'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'esc_html'

        ] );

        $this->customizer->add_control( new SelectControl(
            $this->customizer, 'betterdocs_live_search_background_position', [
                'type'        => 'betterdocs-select',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_background_position',
                'label'       => __( 'Position', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_live_search_background_property betterdocs-select'
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
                ],
                'priority'    => 513
            ] )
        );
    }

    public function custom_background_switch() {
        $this->customizer->add_setting( 'betterdocs_live_search_custom_background_switch', [
            'default'    => $this->defaults['betterdocs_live_search_custom_background_switch'],
            'capability' => 'edit_theme_options'

        ] );

        $this->customizer->add_control( new ToggleControl(
            $this->customizer, 'betterdocs_live_search_custom_background_switch', [
                'label'    => __( 'Custom Background Image Size', 'betterdocs' ),
                'section'  => 'betterdocs_live_search_settings',
                'settings' => 'betterdocs_live_search_custom_background_switch',
                'type'     => 'light', // light, ios, flat
                'priority' => 515
            ] )
        );
    }

    public function custom_background_width() {
        $this->customizer->add_setting( 'betterdocs_live_search_custom_background_width', [
            'default'           => $this->defaults['betterdocs_live_search_custom_background_width'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_live_search_custom_background_width', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_custom_background_width',
                'label'       => __( 'Background Image Width', 'betterdocs' ),
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 200,
                    'step'   => 1,
                    'suffix' => '%' //optional suffix
                ],
                'priority'    => 516
            ] )
        );
    }

    public function custom_background_height() {
        $this->customizer->add_setting( 'betterdocs_live_search_custom_background_height', [
            'default'           => $this->defaults['betterdocs_live_search_custom_background_height'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_live_search_custom_background_height', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_custom_background_height',
                'label'       => __( 'Background Image Height', 'betterdocs' ),
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 200,
                    'step'   => 1,
                    'suffix' => '%' //optional suffix
                ],
                'priority'    => 517
            ] )
        );
    }

    public function search_margin() {
        $this->customizer->add_setting( 'betterdocs_live_search_margin', [
            'default'           => $this->defaults['betterdocs_live_search_margin'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_live_search_margin', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_margin',
                'label'       => __( 'Margin', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_live_search_margin',
                    'class' => 'betterdocs-dimension'
                ],
                'priority'    => 518
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_live_search_margin_top', [
            'default'           => $this->defaults['betterdocs_live_search_margin_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_live_search_margin_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_margin_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_live_search_margin betterdocs-dimension'
                ],
                'priority'    => 518
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_live_search_margin_right', [
            'default'           => $this->defaults['betterdocs_live_search_margin_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_live_search_margin_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_margin_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_live_search_margin betterdocs-dimension'
                ],
                'priority'    => 518
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_live_search_margin_bottom', [
            'default'           => $this->defaults['betterdocs_live_search_margin_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_live_search_margin_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_margin_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_live_search_margin betterdocs-dimension'
                ],
                'priority'    => 518
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_live_search_margin_left', [
            'default'           => $this->defaults['betterdocs_live_search_margin_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_live_search_margin_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_margin_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_live_search_margin betterdocs-dimension'
                ],
                'priority'    => 518
            ] )
        );
    }

    public function search_padding() {
        $this->customizer->add_setting( 'betterdocs_live_search_padding', [
            'default'           => $this->defaults['betterdocs_live_search_padding'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_live_search_padding', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_padding',
                'label'       => __( 'Padding', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_live_search_padding',
                    'class' => 'betterdocs-dimension'
                ],
                'priority'    => 519
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_live_search_padding_top', [
            'default'           => $this->defaults['betterdocs_live_search_padding_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_live_search_padding_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_padding_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_live_search_padding betterdocs-dimension'
                ],
                'priority'    => 519
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_live_search_padding_right', [
            'default'           => $this->defaults['betterdocs_live_search_padding_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_live_search_padding_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_padding_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_live_search_padding betterdocs-dimension'
                ],
                'priority'    => 519
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_live_search_padding_bottom', [
            'default'           => $this->defaults['betterdocs_live_search_padding_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_live_search_padding_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_padding_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_live_search_padding betterdocs-dimension'
                ],
                'priority'    => 519
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_live_search_padding_left', [
            'default'           => $this->defaults['betterdocs_live_search_padding_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_live_search_padding_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_live_search_padding_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_live_search_padding betterdocs-dimension'
                ],
                'priority'    => 519
            ] )
        );
    }

    public function field_settings() {
        $this->customizer->add_setting( 'betterdocs_search_field_settings', [
            'default'           => $this->defaults['betterdocs_search_field_settings'],
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control( new SeparatorControl(
            $this->customizer, 'betterdocs_search_field_settings', [
                'label'    => __( 'Search Field Settings', 'betterdocs' ),
                'settings' => 'betterdocs_search_field_settings',
                'section'  => 'betterdocs_live_search_settings',
                'priority' => 530
            ] )
        );
    }

    public function field_background_color() {
        $this->customizer->add_setting( 'betterdocs_search_field_background_color', [
            'default'           => $this->defaults['betterdocs_search_field_background_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_field_background_color',
                [
                    'label'    => __( 'Search Field Background Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_field_background_color',
                    'priority' => 531
                ]
            )
        );
    }

    public function field_font_size() {
        $this->customizer->add_setting( 'betterdocs_search_field_font_size', [
            'default'           => $this->defaults['betterdocs_search_field_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_search_field_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_field_font_size',
                'label'       => __( 'Search Field Font Size', 'betterdocs' ),
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ],
                'priority'    => 532
            ] )
        );
    }

    public function field_color() {
        $this->customizer->add_setting( 'betterdocs_search_field_color', [
            'default'           => $this->defaults['betterdocs_search_field_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_field_color',
                [
                    'label'    => __( 'Search Text Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_field_color',
                    'priority' => 533
                ]
            )
        );
    }

    public function placeholder_color() {
        $this->customizer->add_setting( 'betterdocs_search_placeholder_color', [
            'default'           => $this->defaults['betterdocs_search_placeholder_color'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_placeholder_color',
                [
                    'label'    => __( 'Search Placeholder Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_placeholder_color',
                    'priority' => 533
                ]
            )
        );
    }

    public function field_padding() {
        $this->customizer->add_setting( 'betterdocs_search_field_padding', [
            'default'           => $this->defaults['betterdocs_search_field_padding'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_search_field_padding', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_field_padding',
                'label'       => __( 'Search Field Padding', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_search_field_padding',
                    'class' => 'betterdocs-dimension'
                ],
                'priority'    => 534
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_field_padding_top', [
            'default'           => $this->defaults['betterdocs_search_field_padding_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_field_padding_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_field_padding_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_field_padding betterdocs-dimension'
                ],
                'priority'    => 534
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_field_padding_right', [
            'default'           => $this->defaults['betterdocs_search_field_padding_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_field_padding_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_field_padding_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_field_padding betterdocs-dimension'
                ],
                'priority'    => 534
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_field_padding_bottom', [
            'default'           => $this->defaults['betterdocs_search_field_padding_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_field_padding_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_field_padding_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_field_padding betterdocs-dimension'
                ],
                'priority'    => 534
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_field_padding_left', [
            'default'           => $this->defaults['betterdocs_search_field_padding_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_field_padding_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_field_padding_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_field_padding betterdocs-dimension'
                ],
                'priority'    => 534
            ] )
        );
    }

    public function field_border_radius() {
        $this->customizer->add_setting( 'betterdocs_search_field_border_radius', [
            'default'           => $this->defaults['betterdocs_search_field_border_radius'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_search_field_border_radius', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_field_border_radius',
                'label'       => __( 'Search Field Border Radius', 'betterdocs' ),
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 100,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ],
                'priority'    => 539
            ] )
        );
    }

    public function icon_size() {
        $this->customizer->add_setting( 'betterdocs_search_icon_size', [
            'default'           => $this->defaults['betterdocs_search_icon_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_search_icon_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_icon_size',
                'label'       => __( 'Search Icon Size', 'betterdocs' ),
                'input_attrs' => [
                    'min'    => 0,
                    'max'    => 100,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ],
                'priority'    => 540
            ] )
        );
    }

    public function icon_color() {
        $this->customizer->add_setting( 'betterdocs_search_icon_color', [
            'default'           => $this->defaults['betterdocs_search_icon_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_icon_color',
                [
                    'label'    => __( 'Search Icon Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_icon_color',
                    'priority' => 541
                ]
            )
        );
    }

    public function icon_hover_color() {
        $this->customizer->add_setting( 'betterdocs_search_icon_hover_color', [
            'default'           => $this->defaults['betterdocs_search_icon_hover_color'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_icon_hover_color',
                [
                    'label'    => __( 'Search Icon Hover Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_icon_hover_color',
                    'priority' => 542
                ]
            )
        );
    }

    public function close_icon_color() {
        $this->customizer->add_setting( 'betterdocs_search_close_icon_color', [
            'default'           => $this->defaults['betterdocs_search_close_icon_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_close_icon_color',
                [
                    'label'    => __( 'Close Icon Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_close_icon_color',
                    'priority' => 543
                ]
            )
        );
    }

    public function close_icon_border_color() {
        $this->customizer->add_setting( 'betterdocs_search_close_icon_border_color', [
            'default'           => $this->defaults['betterdocs_search_close_icon_border_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_close_icon_border_color',
                [
                    'label'    => __( 'Close Icon Border Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_close_icon_border_color',
                    'priority' => 544
                ]
            )
        );
    }

    public function result_settings() {
        $this->customizer->add_setting( 'betterdocs_search_result_settings', [
            'default'           => $this->defaults['betterdocs_search_result_settings'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control( new SeparatorControl(
            $this->customizer, 'betterdocs_search_result_settings', [
                'label'    => __( 'Search Result Settings', 'betterdocs' ),
                'settings' => 'betterdocs_search_result_settings',
                'section'  => 'betterdocs_live_search_settings',
                'priority' => 545
            ] )
        );
    }

    public function result_width() {
        $this->customizer->add_setting( 'betterdocs_search_result_width', [
            'default'           => $this->defaults['betterdocs_search_result_width'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_search_result_width', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_result_width',
                'label'       => __( 'Search Result Box Width', 'betterdocs' ),
                'input_attrs' => [
                    'min'    => 0,
                    'max'    => 100,
                    'step'   => 1,
                    'suffix' => '%' //optional suffix
                ],
                'priority'    => 546
            ] )
        );
    }

    public function result_max_width() {
        $this->customizer->add_setting( 'betterdocs_search_result_max_width', [
            'default'           => $this->defaults['betterdocs_search_result_max_width'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_search_result_max_width', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_result_max_width',
                'label'       => __( 'Search Result Box Maximum Width', 'betterdocs' ),
                'input_attrs' => [
                    'min'    => 0,
                    'max'    => 1000,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ],
                'priority'    => 547
            ] )
        );
    }

    public function result_background_color() {
        $this->customizer->add_setting( 'betterdocs_search_result_background_color', [
            'default'           => $this->defaults['betterdocs_search_result_background_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_result_background_color',
                [
                    'label'    => __( 'Search Result Box Background Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_result_background_color',
                    'priority' => 548
                ]
            )
        );
    }

    public function result_border_color() {
        $this->customizer->add_setting( 'betterdocs_search_result_border_color', [
            'default'           => $this->defaults['betterdocs_search_result_border_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_result_border_color',
                [
                    'label'    => __( 'Search Result Box Border Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_result_border_color',
                    'priority' => 549
                ]
            )
        );
    }

    public function result_item_font_size() {
        $this->customizer->add_setting( 'betterdocs_search_result_item_font_size', [
            'default'           => $this->defaults['betterdocs_search_result_item_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_search_result_item_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_result_item_font_size',
                'label'       => __( 'Search Result Item Font Size', 'betterdocs' ),
                'input_attrs' => [
                    'class'  => '',
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ],
                'priority'    => 550
            ] )
        );
    }

    public function result_item_font_color() {
        $this->customizer->add_setting( 'betterdocs_search_result_item_font_color', [
            'default'           => $this->defaults['betterdocs_search_result_item_font_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_result_item_font_color',
                [
                    'label'    => __( 'Search Result Item Font Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_result_item_font_color',
                    'priority' => 551
                ]
            )
        );
    }

    public function result_item_cat_font_color() {
        $this->customizer->add_setting( 'betterdocs_search_result_item_cat_font_color', [
            'default'           => $this->defaults['betterdocs_search_result_item_cat_font_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_result_item_cat_font_color',
                [
                    'label'    => __( 'Search Result Item Category Font Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_result_item_cat_font_color',
                    'priority' => 552
                ]
            )
        );
    }

    public function result_item_padding() {
        $this->customizer->add_setting( 'betterdocs_search_result_item_padding', [
            'default'           => $this->defaults['betterdocs_search_result_item_padding'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_search_result_item_padding', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_result_item_padding',
                'label'       => __( 'Search Result Item Padding', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_search_result_item_padding',
                    'class' => 'betterdocs-dimension'
                ],
                'priority'    => 553
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_result_item_padding_top', [
            'default'           => $this->defaults['betterdocs_search_result_item_padding_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_result_item_padding_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_result_item_padding_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_result_item_padding betterdocs-dimension'
                ],
                'priority'    => 553
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_result_item_padding_right', [
            'default'           => $this->defaults['betterdocs_search_result_item_padding_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_result_item_padding_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_result_item_padding_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_result_item_padding betterdocs-dimension'
                ],
                'priority'    => 553
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_result_item_padding_bottom', [
            'default'           => $this->defaults['betterdocs_search_result_item_padding_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_result_item_padding_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_result_item_padding_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_result_item_padding betterdocs-dimension'
                ],
                'priority'    => 553
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_search_result_item_padding_left', [
            'default'           => $this->defaults['betterdocs_search_result_item_padding_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_search_result_item_padding_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_live_search_settings',
                'settings'    => 'betterdocs_search_result_item_padding_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_search_result_item_padding betterdocs-dimension'
                ],
                'priority'    => 553
            ] )
        );
    }

    public function result_item_border_color() {
        $this->customizer->add_setting( 'betterdocs_search_result_item_border_color', [
            'default'           => $this->defaults['betterdocs_search_result_item_border_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_result_item_border_color',
                [
                    'label'    => __( 'Search Result Item Border Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_result_item_border_color',
                    'priority' => 558
                ]
            )
        );
    }

    public function result_item_hover_font_color() {
        $this->customizer->add_setting( 'betterdocs_search_result_item_hover_font_color', [
            'default'           => $this->defaults['betterdocs_search_result_item_hover_font_color'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_result_item_hover_font_color',
                [
                    'label'    => __( 'Search Result Item Font Hover Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_result_item_hover_font_color',
                    'priority' => 559
                ]
            )
        );
    }

    public function result_item_hover_background_color() {
        $this->customizer->add_setting( 'betterdocs_search_result_item_hover_background_color', [
            'default'           => $this->defaults['betterdocs_search_result_item_hover_background_color'],
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_search_result_item_hover_background_color',
                [
                    'label'    => __( 'Item Background Hover Color', 'betterdocs' ),
                    'section'  => 'betterdocs_live_search_settings',
                    'settings' => 'betterdocs_search_result_item_hover_background_color',
                    'priority' => 560
                ]
            )
        );
    }
}
