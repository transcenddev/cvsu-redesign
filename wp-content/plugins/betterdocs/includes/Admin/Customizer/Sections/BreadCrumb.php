<?php

namespace WPDeveloper\BetterDocs\Admin\Customizer\Sections;

use WPDeveloper\BetterDocs\Admin\Customizer\Controls\AlphaColorControl;
use WPDeveloper\BetterDocs\Admin\Customizer\Controls\RangeValueControl;

class BreadCrumb extends Section {

    protected $priority = 400;

    public function get_id() {
        return 'betterdocs_breadcrumb_settings';
    }

    public function get_title() {
        return __( 'Breadcrumb', 'betterdocs' );
    }

    public function single_doc_breadcrumbs_font_size() {
        $this->customizer->add_setting( 'betterdocs_single_doc_breadcrumbs_font_size', [
            'default'           => $this->defaults['betterdocs_single_doc_breadcrumbs_font_size'],
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'integer']

        ] );

        $this->customizer->add_control( new RangeValueControl(
            $this->customizer, 'betterdocs_single_doc_breadcrumbs_font_size', [
                'type'        => 'betterdocs-range-value',
                'section'     => 'betterdocs_breadcrumb_settings',
                'settings'    => 'betterdocs_single_doc_breadcrumbs_font_size',
                'label'       => __( 'Font Size', 'betterdocs' ),
                'priority'    => 128,
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

    public function single_doc_breadcrumb_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_breadcrumb_color', [
            'capability'        => 'edit_theme_options',
            'default'           => $this->defaults['betterdocs_single_doc_breadcrumb_color'],
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_breadcrumb_color',
                [
                    'label'    => __( 'Color', 'betterdocs' ),
                    'priority' => 129,
                    'section'  => 'betterdocs_breadcrumb_settings',
                    'settings' => 'betterdocs_single_doc_breadcrumb_color'
                ]
            )
        );
    }

    public function single_doc_breadcrumb_hover_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_breadcrumb_hover_color', [
            'capability'        => 'edit_theme_options',
            'default'           => $this->defaults['betterdocs_single_doc_breadcrumb_hover_color'],
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_breadcrumb_hover_color',
                [
                    'label'    => __( 'Hover Color', 'betterdocs' ),
                    'priority' => 129,
                    'section'  => 'betterdocs_breadcrumb_settings',
                    'settings' => 'betterdocs_single_doc_breadcrumb_hover_color'
                ]
            )
        );
    }

    public function single_doc_breadcrumb_speretor_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_breadcrumb_speretor_color', [
            'capability'        => 'edit_theme_options',
            'default'           => $this->defaults['betterdocs_single_doc_breadcrumb_speretor_color'],
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_breadcrumb_speretor_color',
                [
                    'label'    => __( 'Seperator Color', 'betterdocs' ),
                    'priority' => 130,
                    'section'  => 'betterdocs_breadcrumb_settings',
                    'settings' => 'betterdocs_single_doc_breadcrumb_speretor_color'
                ]
            )
        );
    }

    public function single_doc_breadcrumb_active_item_color() {
        $this->customizer->add_setting( 'betterdocs_single_doc_breadcrumb_active_item_color', [
            'capability'        => 'edit_theme_options',
            'default'           => $this->defaults['betterdocs_single_doc_breadcrumb_active_item_color'],
            'transport'         => 'postMessage',
            'sanitize_callback' => [$this->sanitizer, 'rgba']
        ] );

        $this->customizer->add_control(
            new AlphaColorControl(
                $this->customizer,
                'betterdocs_single_doc_breadcrumb_active_item_color',
                [
                    'label'    => __( 'Active Item Color', 'betterdocs' ),
                    'priority' => 131,
                    'section'  => 'betterdocs_breadcrumb_settings',
                    'settings' => 'betterdocs_single_doc_breadcrumb_active_item_color'
                ]
            )
        );
    }
}
