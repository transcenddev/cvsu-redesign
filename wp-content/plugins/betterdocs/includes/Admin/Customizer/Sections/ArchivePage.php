<?php

namespace WPDeveloper\BetterDocs\Admin\Customizer\Sections;
use WP_Customize_Media_Control;
use WP_Customize_Control;
use WP_Customize_Image_Control;
use WPDeveloper\BetterDocs\Admin\Customizer\Customizer;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\TitleControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\SelectControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\DimensionControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\SeparatorControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\AlphaColorControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\RadioImageControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\RangeValueControl;

class ArchivePage extends Section {
    /**
     * Section Priority
     * @var int
     */
    protected $priority = 400;

    /**
     * Get the section id.
     * @return string
     */
    public function get_id() {
        return 'betterdocs_archive_page_settings';
    }

    /**
     * Get the title of the section.
     * @return string
     */
    public function get_title() {
        return __( 'Category Archive', 'betterdocs' );
    }

    public function layout_select() {
        $this->customizer->add_setting( 'betterdocs_archive_layout_select', [
            'default'           => $this->defaults['betterdocs_archive_layout_select'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'select']
        ] );

        $this->customizer->add_control(
            new RadioImageControl(
                $this->customizer,
                'betterdocs_archive_layout_select',
                [
                    'type'     => 'betterdocs-radio-image',
                    'settings' => 'betterdocs_archive_layout_select',
                    'section'  => 'betterdocs_archive_page_settings',
                    'label'    => __( 'Select Category Archive Layout', 'betterdocs' ),
                    'choices'  => apply_filters( 'betterdocs_archive_layout_choices', [
                        'layout-1' => [
                            'label' => __( 'Classic Layout', 'betterdocs' ),
                            'image' => $this->assets->icon( 'customizer/archive/layout-1.png', true )
                        ],
                        'layout-4' => [
                            'label' => __( 'Abstract Layout', 'betterdocs' ),
                            'image' => $this->assets->icon( 'customizer/archive/layout-4.png', true )
                        ],
                        'layout-5' => [
                            'label' => __( 'Modern Layout', 'betterdocs' ),
                            'image' => $this->assets->icon( 'customizer/archive/layout-5.png', true )
                        ],
                        'layout-2' => [
                            'label' => __( 'Memphis Layout', 'betterdocs' ),
                            'image' => $this->assets->icon( 'customizer/archive/layout-2.png', true ),
                            'pro'   => true,
                            'url'   => 'https://betterdocs.co/upgrade'
                        ],
                        'layout-3' => [
                            'label' => __( 'Neoclassic Layout', 'betterdocs' ),
                            'image' => $this->assets->icon( 'customizer/archive/layout-3.png', true ),
                            'pro'   => true,
                            'url'   => 'https://betterdocs.co/upgrade'
                        ],
                        'layout-6' => [
                            'label' => __( 'Handbook Layout', 'betterdocs' ),
                            'image' => $this->assets->icon( 'customizer/archive/layout-6.png', true ),
                            'pro'   => true,
                            'url'   => 'https://betterdocs.co/upgrade'
                        ]
                    ] )
                ]
            )
        );
    }

    public function background_color() {
        $this->customizer->add_setting( 'betterdocs_archive_page_background_color', [
            'default'           => $this->defaults['betterdocs_archive_page_background_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_page_background_color',
                [
                    'label'    => __( 'Page Background Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_page_background_color'
                ]
            )
        );
    }

    public function background_image() {
        $this->customizer->add_setting( 'betterdocs_archive_page_background_image', [
            'default'    => $this->defaults['betterdocs_archive_page_background_image'],
            'capability' => 'edit_theme_options',
            'transport'  => 'postMessage'

        ] );

        $this->customizer->add_control( new WP_Customize_Image_Control(
            $this->customizer, 'betterdocs_archive_page_background_image', [
                'section'  => 'betterdocs_archive_page_settings',
                'settings' => 'betterdocs_archive_page_background_image',
                'label'    => __( 'Background Image', 'betterdocs' )
            ] )
        );
    }

    public function background_properties() {
        $this->customizer->add_setting( 'betterdocs_archive_page_background_property', [
            'default'           => $this->defaults['betterdocs_archive_page_background_property'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'select']
        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_archive_page_background_property', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_page_background_property',
                'label'       => __( 'Background Property', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_archive_page_background_property',
                    'class' => 'betterdocs-select'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_page_background_size', [
            'default'           => $this->defaults['betterdocs_archive_page_background_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'select']

        ] );

        $this->customizer->add_control( new SelectControl(
            $this->customizer, 'betterdocs_archive_page_background_size', [
                'type'        => 'betterdocs-select',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_page_background_size',
                'label'       => __( 'Size', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_page_background_property betterdocs-select'
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

        $this->customizer->add_setting( 'betterdocs_archive_page_background_repeat', [
            'default'           => $this->defaults['betterdocs_archive_page_background_repeat'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'select']

        ] );

        $this->customizer->add_control( new SelectControl(
            $this->customizer, 'betterdocs_archive_page_background_repeat', [
                'type'        => 'betterdocs-select',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_page_background_repeat',
                'label'       => __( 'Repeat', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_page_background_property betterdocs-select'
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

        $this->customizer->add_setting( 'betterdocs_archive_page_background_attachment', [
            'default'           => $this->defaults['betterdocs_archive_page_background_attachment'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'select']

        ] );

        $this->customizer->add_control( new SelectControl(
            $this->customizer, 'betterdocs_archive_page_background_attachment', [
                'type'        => 'betterdocs-select',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_page_background_attachment',
                'label'       => __( 'Attachment', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_page_background_property betterdocs-select'
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

        $this->customizer->add_setting( 'betterdocs_archive_page_background_position', [
            'default'           => $this->defaults['betterdocs_archive_page_background_position'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'esc_html'

        ] );

        $this->customizer->add_control( new SelectControl(
            $this->customizer, 'betterdocs_archive_page_background_position', [
                'type'        => 'betterdocs-select',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_page_background_position',
                'label'       => __( 'Position', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_page_background_property betterdocs-select'
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

    public function content_area_width() {
        $this->customizer->add_setting( 'betterdocs_archive_content_area_width', [
            'default'           => $this->defaults['betterdocs_archive_content_area_width'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_archive_content_area_width', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_area_width',
                'label'       => __( 'Category Archive Width', 'betterdocs' ), //Renamed From 'Content Area Width' to 'Category Archive Width' @since betterdocs revamp version
                'input_attrs' => [
                    'min'    => 0,
                    'max'    => 100,
                    'step'   => 1,
                    'suffix' => '%' //optional suffix
                ]
            ]
        ) );
    }

    public function content_area_max_width() {
        $this->customizer->add_setting( 'betterdocs_archive_content_area_max_width', [
            'default'           => $this->defaults['betterdocs_archive_content_area_max_width'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_archive_content_area_max_width', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_area_max_width',
                'label'       => __( 'Category Archive Maximum Width', 'betterdocs' ), //Renamed From 'Content Area Maximum Width' to 'Category Archive Maximum Width' @since betterdocs revamp version
                'input_attrs' => [
                    'min'    => 0,
                    'max'    => 3000,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ]
        ) );
    }

    /**
     * Since Betterdocs Revamped Version
     */
    public function category_archive_padding() {
        $this->customizer->add_setting( 'category_archive_padding', [
            'default'           => $this->defaults['category_archive_padding'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'category_archive_padding', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'category_archive_padding',
                'label'       => __( 'Category Archive Padding', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'category_archive_padding',
                    'class' => 'betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'category_archive_padding_top', [
            'default'           => $this->defaults['category_archive_padding_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'category_archive_padding_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'category_archive_padding_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_content_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'category_archive_padding_right', [
            'default'           => $this->defaults['category_archive_padding_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'category_archive_padding_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'category_archive_padding_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_content_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'category_archive_padding_bottom', [
            'default'           => $this->defaults['category_archive_padding_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'category_archive_padding_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'category_archive_padding_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_content_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'category_archive_padding_left', [
            'default'           => $this->defaults['category_archive_padding_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'category_archive_padding_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'category_archive_padding_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_content_margin betterdocs-dimension'
                ]
            ] )
        );
    }

    public function content_area_settings() {
        $this->customizer->add_setting( 'betterdocs_archive_content_area_settings', [
            'default'           => $this->defaults['betterdocs_archive_content_area_settings'],
            'sanitize_callback' => 'esc_html'
        ] );

        $this->customizer->add_control( new SeparatorControl(
            $this->customizer, 'betterdocs_archive_content_area_settings', [
                'label'    => __( 'Content Area', 'betterdocs' ),
                'settings' => 'betterdocs_archive_content_area_settings',
                'section'  => 'betterdocs_archive_page_settings'
            ] )
        );
    }

    public function content_background_color() {
        $this->customizer->add_setting( 'betterdocs_archive_content_background_color', [
            'default'           => $this->defaults['betterdocs_archive_content_background_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_content_background_color',
                [
                    'label'    => __( 'Content Area Background Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_content_background_color'
                ]
            )
        );
    }

    public function content_margin() {
        $this->customizer->add_setting( 'betterdocs_archive_content_margin', [
            'default'           => $this->defaults['betterdocs_archive_content_margin'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_archive_content_margin', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_margin',
                'label'       => __( 'Content Area Margin', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_archive_content_margin',
                    'class' => 'betterdocs-dimension'
                ]
            ] ) );

        $this->customizer->add_setting( 'betterdocs_archive_content_margin_top', [
            'default'           => $this->defaults['betterdocs_archive_content_margin_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_content_margin_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_margin_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_content_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_content_margin_right', [
            'default'           => $this->defaults['betterdocs_archive_content_margin_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_content_margin_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_margin_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_content_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_content_margin_bottom', [
            'default'           => $this->defaults['betterdocs_archive_content_margin_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_content_margin_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_margin_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_content_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_content_margin_left', [
            'default'           => $this->defaults['betterdocs_archive_content_margin_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_content_margin_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_margin_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_content_margin betterdocs-dimension'
                ]
            ] )
        );
    }

    public function content_padding() {
        $this->customizer->add_setting( 'betterdocs_archive_content_padding', [
            'default'           => $this->defaults['betterdocs_archive_content_padding'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_archive_content_padding', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_padding',
                'label'       => __( 'Content Area Padding', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_archive_content_padding',
                    'class' => 'betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_content_padding_top', [
            'default'           => $this->defaults['betterdocs_archive_content_padding_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_content_padding_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_padding_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_content_padding betterdocs-dimension'
                ]
            ] ) );

        $this->customizer->add_setting( 'betterdocs_archive_content_padding_right', [
            'default'           => $this->defaults['betterdocs_archive_content_padding_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_content_padding_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_padding_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_content_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_content_padding_bottom', [
            'default'           => $this->defaults['betterdocs_archive_content_padding_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_content_padding_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_padding_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_content_padding betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_content_padding_left', [
            'default'           => $this->defaults['betterdocs_archive_content_padding_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_content_padding_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_padding_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_content_padding betterdocs-dimension'
                ]
            ] )
        );
    }

    public function content_border_radius() {
        $this->customizer->add_setting( 'betterdocs_archive_content_border_radius', [
            'default'           => $this->defaults['betterdocs_archive_content_border_radius'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_archive_content_border_radius', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_content_border_radius',
                'label'       => __( 'Archive Content Border Radius', 'betterdocs' ),
                'input_attrs' => [
                    'min'    => 0,
                    'max'    => 100,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function title_tag() {
        $this->customizer->add_setting( 'betterdocs_archive_title_tag', [
            'default'           => $this->defaults['betterdocs_archive_title_tag'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'select']
        ] );

        $this->customizer->add_control(
            new WP_Customize_Control(
                $this->customizer,
                'betterdocs_archive_title_tag',
                [
                    'label'    => __( 'Category Title Tag', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_title_tag',
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

    public function title_color() {
        $this->customizer->add_setting( 'betterdocs_archive_title_color', [
            'default'           => $this->defaults['betterdocs_archive_title_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_title_color',
                [
                    'label'    => __( 'Title Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_title_color'
                ]
            )
        );
    }

    public function title_font_size() {
        $this->customizer->add_setting( 'betterdocs_archive_title_font_size', [
            'default'           => $this->defaults['betterdocs_archive_title_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_archive_title_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_title_font_size',
                'label'       => __( 'Title Font Size', 'betterdocs' ),
                'input_attrs' => [
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function title_margin() {
        $this->customizer->add_setting( 'betterdocs_archive_title_margin', [
            'default'           => $this->defaults['betterdocs_archive_title_margin'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_archive_title_margin', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_title_margin',
                'label'       => __( 'Archive Title Margin', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_archive_title_margin',
                    'class' => 'betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_title_margin_top', [
            'default'           => $this->defaults['betterdocs_archive_title_margin_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_title_margin_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_title_margin_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_title_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_title_margin_right', [
            'default'           => $this->defaults['betterdocs_archive_title_margin_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_title_margin_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_title_margin_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_title_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_title_margin_bottom', [
            'default'           => $this->defaults['betterdocs_archive_title_margin_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_title_margin_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_title_margin_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_title_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_title_margin_left', [
            'default'           => $this->defaults['betterdocs_archive_title_margin_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_title_margin_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_title_margin_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_title_margin betterdocs-dimension'
                ]
            ] )
        );
    }

    public function description_color() {
        $this->customizer->add_setting( 'betterdocs_archive_description_color', [
            'default'           => $this->defaults['betterdocs_archive_description_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_description_color',
                [
                    'label'    => __( 'Description Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_description_color'
                ]
            )
        );
    }

    public function description_font_size() {
        $this->customizer->add_setting( 'betterdocs_archive_description_font_size', [
            'default'           => $this->defaults['betterdocs_archive_description_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_archive_description_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_description_font_size',
                'label'       => __( 'Description Font Size', 'betterdocs' ),
                'input_attrs' => [
                    'min'    => 0,
                    'max'    => 50,
                    'step'   => 1,
                    'suffix' => 'px' //optional suffix
                ]
            ] )
        );
    }

    public function description_margin() {
        $this->customizer->add_setting( 'betterdocs_archive_description_margin', [
            'default'           => $this->defaults['betterdocs_archive_description_margin'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_archive_description_margin', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_description_margin',
                'label'       => __( 'Archive Description Margin', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_archive_description_margin',
                    'class' => 'betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_description_margin_top', [
            'default'           => $this->defaults['betterdocs_archive_description_margin_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_description_margin_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_description_margin_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_description_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_description_margin_right', [
            'default'           => $this->defaults['betterdocs_archive_description_margin_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_description_margin_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_description_margin_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_description_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_description_margin_bottom', [
            'default'           => $this->defaults['betterdocs_archive_description_margin_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_description_margin_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_description_margin_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_description_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_description_margin_left', [
            'default'           => $this->defaults['betterdocs_archive_description_margin_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_description_margin_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_description_margin_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_description_margin betterdocs-dimension'
                ]
            ] )
        );
    }

    public function list_icon_color() {
        $this->customizer->add_setting( 'betterdocs_archive_list_icon_color', [
            'default'           => $this->defaults['betterdocs_archive_list_icon_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_list_icon_color',
                [
                    'label'    => __( 'List Icon Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_list_icon_color'
                ]
            )
        );
    }

    public function list_icon_font_size() {
        $this->customizer->add_setting( 'betterdocs_archive_list_icon_font_size', [
            'default'           => $this->defaults['betterdocs_archive_list_icon_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_archive_list_icon_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_list_icon_font_size',
                'label'       => __( 'List Icon Font Size', 'betterdocs' ),
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

    public function list_item_color() {
        $this->customizer->add_setting( 'betterdocs_archive_list_item_color', [
            'default'           => $this->defaults['betterdocs_archive_list_item_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_list_item_color',
                [
                    'label'    => __( 'List Item Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_list_item_color'
                ]
            )
        );
    }

    public function list_item_hover_color() {
        $this->customizer->add_setting( 'betterdocs_archive_list_item_hover_color', [
            'default'           => $this->defaults['betterdocs_archive_list_item_hover_color'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_list_item_hover_color',
                [
                    'label'    => __( 'List Item Hover Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_list_item_hover_color'
                ]
            )
        );
    }

    public function list_item_font_size() {
        $this->customizer->add_setting( 'betterdocs_archive_list_item_font_size', [
            'default'           => $this->defaults['betterdocs_archive_list_item_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_archive_list_item_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_list_item_font_size',
                'label'       => __( 'List Item Font Size', 'betterdocs' ),
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

    public function list_margin() {
        $this->customizer->add_setting( 'betterdocs_archive_article_list_margin', [
            'default'           => $this->defaults['betterdocs_archive_article_list_margin'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new TitleControl(
            $this->customizer, 'betterdocs_archive_article_list_margin', [
                'type'        => 'betterdocs-title',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_article_list_margin',
                'label'       => __( 'Docs List Margin', 'betterdocs' ),
                'input_attrs' => [
                    'id'    => 'betterdocs_archive_article_list_margin',
                    'class' => 'betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_article_list_margin_top', [
            'default'           => $this->defaults['betterdocs_archive_article_list_margin_top'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']
        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_article_list_margin_top', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_article_list_margin_top',
                'label'       => __( 'Top', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_article_list_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_article_list_margin_right', [
            'default'           => $this->defaults['betterdocs_archive_article_list_margin_right'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_article_list_margin_right', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_article_list_margin_right',
                'label'       => __( 'Right', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_article_list_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_article_list_margin_bottom', [
            'default'           => $this->defaults['betterdocs_archive_article_list_margin_bottom'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_article_list_margin_bottom', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_article_list_margin_bottom',
                'label'       => __( 'Bottom', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_article_list_margin betterdocs-dimension'
                ]
            ] )
        );

        $this->customizer->add_setting( 'betterdocs_archive_article_list_margin_left', [
            'default'           => $this->defaults['betterdocs_archive_article_list_margin_left'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new DimensionControl(
            $this->customizer, 'betterdocs_archive_article_list_margin_left', [
                'type'        => 'betterdocs-dimension',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_article_list_margin_left',
                'label'       => __( 'Left', 'betterdocs' ),
                'input_attrs' => [
                    'class' => 'betterdocs_archive_article_list_margin betterdocs-dimension'
                ]
            ] )
        );
    }

    public function article_subcategory_color() {
        $this->customizer->add_setting( 'betterdocs_archive_article_subcategory_color', [
            'default'           => $this->defaults['betterdocs_archive_article_subcategory_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_article_subcategory_color',
                [
                    'label'    => __( 'Docs Subcategory Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_article_subcategory_color',
                    'priority' => 44
                ]
            )
        );
    }

    public function article_subcategory_hover_color() {
        $this->customizer->add_setting( 'betterdocs_archive_article_subcategory_hover_color', [
            'default'           => $this->defaults['betterdocs_archive_article_subcategory_hover_color'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_article_subcategory_hover_color',
                [
                    'label'    => __( 'Docs Subcategory Hover Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_article_subcategory_hover_color',
                    'priority' => 44
                ]
            )
        );
    }

    public function article_subcategory_font_size() {
        $this->customizer->add_setting( 'betterdocs_archive_article_subcategory_font_size', [
            'default'           => $this->defaults['betterdocs_archive_article_subcategory_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_archive_article_subcategory_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_article_subcategory_font_size',
                'label'       => __( 'Docs Subcategory Font Size', 'betterdocs' ),
                'priority'    => 44,
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

    public function subcategory_icon_color() {
        $this->customizer->add_setting( 'betterdocs_archive_subcategory_icon_color', [
            'default'           => $this->defaults['betterdocs_archive_subcategory_icon_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_subcategory_icon_color',
                [
                    'label'    => __( 'Subcategory Icon Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_subcategory_icon_color',
                    'priority' => 44
                ]
            )
        );
    }

    public function subcategory_icon_font_size() {
        $this->customizer->add_setting( 'betterdocs_archive_subcategory_icon_font_size', [
            'default'           => $this->defaults['betterdocs_archive_subcategory_icon_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_archive_subcategory_icon_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_archive_page_settings',
                'settings'    => 'betterdocs_archive_subcategory_icon_font_size',
                'label'       => __( 'Subcategory Icon Font Size', 'betterdocs' ),
                'priority'    => 44,
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

    public function subcategory_article_list_color() {
        $this->customizer->add_setting( 'betterdocs_archive_subcategory_article_list_color', [
            'default'           => $this->defaults['betterdocs_archive_subcategory_article_list_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_subcategory_article_list_color',
                [
                    'label'    => __( 'Subcategory Docs List Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_subcategory_article_list_color',
                    'priority' => 44
                ]
            )
        );
    }

    public function article_list_hover_color() {
        $this->customizer->add_setting( 'betterdocs_archive_subcategory_article_list_hover_color', [
            'default'           => $this->defaults['betterdocs_archive_subcategory_article_list_hover_color'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_subcategory_article_list_hover_color',
                [
                    'label'    => __( 'Subcategory List Hover Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_subcategory_article_list_hover_color',
                    'priority' => 44
                ]
            )
        );
    }

    public function subcategory_article_list_icon_color() {
        $this->customizer->add_setting( 'betterdocs_archive_subcategory_article_list_icon_color', [
            'default'           => $this->defaults['betterdocs_archive_subcategory_article_list_icon_color'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_archive_subcategory_article_list_icon_color',
                [
                    'label'    => __( 'Subcategory List Icon Color', 'betterdocs' ),
                    'section'  => 'betterdocs_archive_page_settings',
                    'settings' => 'betterdocs_archive_subcategory_article_list_icon_color',
                    'priority' => 44
                ]
            )
        );
    }
}
