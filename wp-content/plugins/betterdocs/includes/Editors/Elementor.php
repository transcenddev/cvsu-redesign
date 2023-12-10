<?php

namespace WPDeveloper\BetterDocs\Editors;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use Elementor\Controls_Manager;
use Elementor\Api as ElementorAPI;
use Elementor\Plugin as ElementorPlugin;
use WPDeveloper\BetterDocs\Core\Settings;
use WPDeveloper\BetterDocs\Utils\Enqueue;
use WPDeveloper\BetterDocs\Editors\Elementor\Helper;
use WPDeveloper\BetterDocs\Editors\Elementor\SingleDocs;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\ToC;
use WPDeveloper\BetterDocs\Editors\Elementor\DocsArchive;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\Title;
use WPDeveloper\BetterDocs\Editors\Elementor\Tags\TitleTag;
use WPDeveloper\BetterDocs\Editors\Elementor\TemplateSource;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\Content;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\DocDate;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\Sidebar;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\DocShare;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\Feedback;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\Basic\FAQ;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\Reactions;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\Navigation;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\ArchiveList;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\Breadcrumbs;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\Basic\SearchForm;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\Basic\CategoryBox;
use WPDeveloper\BetterDocs\Editors\Elementor\Widget\Basic\CategoryGrid;
use WPDeveloper\BetterDocs\Editors\Elementor\Conditions\ArchiveCondition;

class Elementor extends BaseEditor {
    protected $is_elementor_active       = false;
    protected $is_elementor_pro_active   = false;
    protected static $is_templates_added = false;

    /**
     * Elementor plugin class
     * @var ElementorPlugin
     */
    protected $elementor;

    /**
     * Elementor Helper class
     * @var Helper
     */
    protected $helper;

    public function __construct( Settings $settings, Enqueue $enqueue, Helper $helper ) {
        parent::__construct( $settings, $enqueue );

        $this->helper                  = $helper;
        $this->is_elementor_active     = betterdocs()->helper->is_plugin_active( 'elementor/elementor.php' );
        $this->is_elementor_pro_active = betterdocs()->helper->is_plugin_active( 'elementor-pro/elementor-pro.php' );

        if ( ! $this->is_elementor_active || ! class_exists( ElementorPlugin::class ) ) {
            return;
        }

        $this->elementor = ElementorPlugin::instance();
    }

    public function init() {
        if ( ! $this->is_elementor_active || $this->elementor == null ) {
            return;
        }

        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );

        add_action( 'elementor/elements/categories_registered', [$this, 'register_widget_category'] );
        add_action( 'elementor/widgets/register', [$this, 'register_basic_widgets'] );

        add_action( 'elementor/editor/before_enqueue_scripts', [$this, 'editor_enqueue_scripts'] );
        add_filter( 'elementor/editor/localize_settings', [$this, 'promote_pro_elements'] );

        add_filter( 'elementor/theme/need_override_location', [$this, 'override_location'], 10, 2 );
        add_action( 'betterdocs/elementor/widgets/query', [$this, 'betterdocs_query'], 10, 2 );

        if ( $this->is_elementor_pro_active ) {
            add_action( 'elementor/dynamic_tags/register', [$this, 'register_basic_tags'] );
            add_action( 'elementor/widgets/register', [$this, 'register_theme_builder_widgets'] );
            add_action( 'elementor/theme/register_conditions', [$this, 'register_conditions'] );

            //(Conflict Fix)Solves the issue with plugin - Sticky Header Effects for Elementor(Plugin)
            if ( ! did_action( 'elementor/documents/register' ) ) {
                add_action( 'elementor/documents/register', [$this, 'register_documents'] );
            } else {
                $this->elementor->documents->register_document_type( 'docs', SingleDocs::get_class_full_name() );
                $this->elementor->documents->register_document_type( 'doc-archive', DocsArchive::get_class_full_name() );
            }
        }

        $this->betterdocs_init();
    }

    public function editor_enqueue_scripts() {
        betterdocs()->assets->enqueue( 'betterdocs-el-icon', 'elementor/css/betterdocs-el-icon.css' );
    }

    public function register_documents( $documents_manager ) {
        $documents_manager->register_document_type( 'docs', SingleDocs::get_class_full_name() );
        $documents_manager->register_document_type( 'doc-archive', DocsArchive::get_class_full_name() );
    }

    public function override_location( $need_override_location, $location ) {
        if ( is_singular( ['docs'] ) && 'single' === $location ) {
            $need_override_location = true;
        }

        return $need_override_location;
    }

    /**
     * Query Controls
     *
     */
    public function betterdocs_query( $wb, $taxonomy ) {
        $wb->start_controls_section(
            'eael_section_post__filters',
            [
                'label' => __( 'Query', 'betterdocs' )
            ]
        );

        $default_multiple_kb = $this->multiple_kb_status();

        if ( $default_multiple_kb && $taxonomy != 'knowledge_base' ) {
            $multiple_kb_terms = $this->get_kb_terms( true, false );
            $default_slug      = count( $multiple_kb_terms ) > 0 ? array_keys( $multiple_kb_terms )[0] : '';

            $wb->add_control(
                'selected_knowledge_base',
                [
                    'label'          => __( 'Knowledge Bases', 'betterdocs' ),
                    'label_block'    => true,
                    'type'           => Controls_Manager::SELECT2,
                    'options'        => $multiple_kb_terms,
                    'multiple'       => false,
                    'default'        => '',
                    'select2options' => [
                        'placeholder' => __( 'All Knowledge Base', 'betterdocs' ),
                        'allowClear'  => true
                    ]
                ]
            );
        }

        if ( $wb->get_name() === 'betterdocs-category-grid' ) {
            $wb->add_control(
                'grid_query_heading',
                [
                    'label' => __( 'Category Grid', 'betterdocs' ),
                    'type'  => Controls_Manager::HEADING
                ]
            );
        }

        $wb->add_control(
            'include',
            [
                'label'       => __( 'Include', 'betterdocs' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->helper->get_terms( $taxonomy, 'term_id' ),
                'multiple'    => true,
                'default'     => []
            ]
        );

        $wb->add_control(
            'exclude',
            [
                'label'       => __( 'Exclude', 'betterdocs' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->helper->get_terms( $taxonomy, 'term_id' ),
                'label_block' => true,
                'post_type'   => '',
                'multiple'    => true
            ]
        );

        if ( $wb->get_name() === 'betterdocs-category-grid' ) {
            $wb->add_control(
                'grid_per_page',
                [
                    'label'   => __( 'Grid Per Page', 'betterdocs' ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => '8'
                ]
            );
        } else if ( $wb->get_name() !== 'betterdocs-sidebar' ) {
            $wb->add_control(
                'box_per_page',
                [
                    'label'   => __( 'Box Per Page', 'betterdocs' ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => '8'
                ]
            );
        }

        $wb->add_control(
            'offset',
            [
                'label'   => __( 'Offset', 'betterdocs' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '0'
            ]
        );

        // difference between betterdocs-sidebar and betterdocs-category-grid is the default order
        if ( $wb->get_name() === 'betterdocs-sidebar' ) {
            $wb->add_control(
                'orderby',
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
                    'default' => $this->settings->get( 'terms_orderby', 'betterdocs_order' )
                ]
            );

            $wb->add_control(
                'order',
                [
                    'label'     => __( 'Order', 'betterdocs' ),
                    'type'      => Controls_Manager::SELECT,
                    'options'   => [
                        'ASC'  => 'Ascending',
                        'DESC' => 'Descending'
                    ],
                    'default'   => $this->settings->get( 'terms_order', 'ASC' ),
                    'condition' => [
                        'orderby!' => 'betterdocs_order'
                    ]

                ]
            );
        } else {
            $wb->add_control(
                'orderby',
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

            $wb->add_control(
                'order',
                [
                    'label'     => __( 'Order', 'betterdocs' ),
                    'type'      => Controls_Manager::SELECT,
                    'options'   => [
                        'ASC'  => 'Ascending',
                        'DESC' => 'Descending'
                    ],
                    'default'   => 'asc',
                    'condition' => [
                        'orderby!' => 'betterdocs_order'
                    ]

                ]
            );
        }

        if ( $wb->get_name() === 'betterdocs-category-grid' ) {
            $wb->add_control(
                'grid_posts_query_heading',
                [
                    'label'     => __( 'Grid List Posts', 'betterdocs' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );

            $wb->add_control(
                'post_per_page',
                [
                    'label'   => __( 'Post Per Page', 'betterdocs' ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => '6'
                ]
            );

            $wb->add_control(
                'post_orderby',
                [
                    'label'   => __( 'Order By', 'betterdocs' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => $this->helper->orderby_options(),
                    'default' => 'date'
                ]
            );

            $wb->add_control(
                'post_order',
                [
                    'label'   => __( 'Order', 'betterdocs' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        'asc'  => 'Ascending',
                        'desc' => 'Descending'
                    ],
                    'default' => 'desc'
                ]
            );

            $wb->add_control(
                'nested_subcategory',
                [
                    'label'        => __( 'Enable Nested Subcategory', 'betterdocs' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Yes', 'betterdocs' ),
                    'label_off'    => __( 'No', 'betterdocs' ),
                    'return_value' => 'true',
                    'default'      => false
                ]
            );

            $wb->add_control(
                'post_per_subcat',
                [
                    'label'     => __( 'Post Per Subcategory', 'betterdocs' ),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => '6',
                    'condition' => [
                        'nested_subcategory' => 'true'
                    ]
                ]
            );
        }

        if ( $wb->get_name() === 'betterdocs-category-box' ) {
            $wb->add_control(
                'nested_subcategory',
                [
                    'label'        => __( 'Nested Subcategory', 'betterdocs' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Yes', 'betterdocs' ),
                    'label_off'    => __( 'No', 'betterdocs' ),
                    'return_value' => 'true',
                    'default'      => false
                ]
            );
        }

        if ( $wb->get_name() === 'betterdocs-sidebar' ) {
            $wb->add_control(
                'nested_subcategory',
                [
                    'label'        => __( 'Nested Subcategory', 'betterdocs' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Yes', 'betterdocs' ),
                    'label_off'    => __( 'No', 'betterdocs' ),
                    'return_value' => 'true',
                    'default'      => ( $this->settings->get( 'archive_nested_subcategory' ) == 1 ) ? 'true' : ''
                ]
            );
        }

        if ( $wb->get_name() === 'betterdocs-tab-view-list' ) {
            $wb->add_control(
                'tab_posts_query_heading',
                [
                    'label'     => __( 'Tab List Posts', 'betterdocs' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );

            $wb->add_control(
                'post_per_tab',
                [
                    'label'   => __( 'Posts Per Tab', 'betterdocs' ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => '10'
                ]
            );

            $wb->add_control(
                'tab_list_posts_orderby',
                [
                    'label'   => __( 'Posts Order By', 'betterdocs' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
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

            $wb->add_control(
                'tab_list_order',
                [
                    'label'   => __( 'Order', 'betterdocs' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        'ASC'  => 'Ascending',
                        'DESC' => 'Descending'
                    ],
                    'default' => 'ASC'

                ]
            );

            $wb->add_control(
                'nested_subcategory_tab_list',
                [
                    'label'        => __( 'Nested Subcategory', 'betterdocs' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Yes', 'betterdocs' ),
                    'label_off'    => __( 'No', 'betterdocs' ),
                    'return_value' => 'true',
                    'default'      => 'true'
                ]
            );

            $wb->add_control(
                'nested_posts_per_page',
                [
                    'label'     => __( 'Posts Per Page', 'betterdocs' ),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => '-1',
                    'condition' => [
                        'nested_subcategory_tab_list' => 'true'
                    ]
                ]
            );

            $wb->add_control(
                'nested_sub_cat_order',
                [
                    'label'     => __( 'Nested Subcategory Order', 'betterdocs' ),
                    'type'      => Controls_Manager::SELECT,
                    'options'   => [
                        'ASC'  => 'Ascending',
                        'DESC' => 'Descending'
                    ],
                    'default'   => 'ASC',
                    'condition' => [
                        'nested_subcategory_tab_list' => 'true'
                    ]
                ]
            );

            $wb->add_control(
                'nested_sub_cat_orderby',
                [
                    'label'     => __( 'Nested Subcategory Order By', 'betterdocs' ),
                    'type'      => Controls_Manager::SELECT,
                    'options'   => [
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
                    'default'   => 'name',
                    'condition' => [
                        'nested_subcategory_tab_list' => 'true'
                    ]
                ]
            );
        }

        $wb->end_controls_section();
    }

    public function multiple_kb_status() {
        if ( $this->settings->get( 'multiple_kb' ) == 1 ) {
            return 'true';
        }

        return '';
    }

    public function get_kb_terms( $prettify = false, $term_id = true ) {
        $args = [
            'taxonomy'   => 'knowledge_base',
            'hide_empty' => true,
            'parent'     => 0
        ];

        $terms = get_terms( $args );

        if ( is_wp_error( $terms ) ) {
            return [];
        }

        if ( $prettify ) {
            $pretty_taxonomies = [];

            foreach ( $terms as $term ) {
                $pretty_taxonomies[$term_id ? $term->term_id : $term->slug] = $term->name;
            }

            return $pretty_taxonomies;
        }

        return $terms;
    }

    public function register_basic_tags( $module ) {
        $module->register( new TitleTag );
    }

    public function register_basic_widgets( $widgets_manager ) {
        foreach ( $this->basic_widget_lists() as $value ) {
            $widgets_manager->register( new $value );
        }
    }

    /**
     *
     * Mange all widget for single docs
     *
     * @return string[]
     * @since  1.3.0
     */
    private function basic_widget_lists() {
        $widget_arr = [
            'betterdocs-elementor-search-form'   => SearchForm::class,
            'betterdocs-elementor-category-grid' => CategoryGrid::class,
            'betterdocs-elementor-category-box'  => CategoryBox::class,
            'betterdocs-faq-widget'              => FAQ::class
        ];

        return $widget_arr;
    }

    public function register_widget_category( $elements_manager ) {
        $elements_manager->add_category( 'betterdocs-elements', [
            'title' => __( 'BetterDocs', 'betterdocs' ),
            'icon'  => 'font'
        ], 1 );
    }

    public function promote_pro_elements( $config ) {
        if ( $this->is_pro_active ) {
            return $config;
        }

        $promotion_widgets = [];

        if ( isset( $config['promotionWidgets'] ) ) {
            $promotion_widgets = $config['promotionWidgets'];
        }

        $combine_array = array_merge( $promotion_widgets, [
            [
                'name'       => 'betterdocs-multiple-kb',
                'title'      => __( 'BetterDocs Multiple KB', 'betterdocs' ),
                'icon'       => 'betterdocs-icon-category-box',
                'categories' => '["docs-archive"]'
            ]
        ] );

        $config['promotionWidgets'] = $combine_array;

        return $config;
    }

    public function is_templates() {
        if ( $this->is_elementor_active && $this->is_elementor_pro_active ) {
            $post_id = get_the_ID();
            if ( $this->elementor->editor->is_edit_mode() || (
                get_post_meta( $post_id, '_elementor_template_type', true )
                && $this->elementor->documents->get( $post_id )->is_built_with_elementor()
            ) ) {
                return true;
            }
        }

        return null;
    }

    public function enqueue_scripts() {
        $assets = betterdocs()->assets;

        /**
         * Widget's CSS
         */
        $assets->register( 'betterdocs-el-category-grid', 'elementor/css/category-grid.css' );
        $assets->register( 'betterdocs-el-category-box', 'elementor/css/category-box.css' );
        $assets->register( 'betterdocs-el-articles-list', 'elementor/css/articles-list.css' );
        $assets->register( 'betterdocs-el-navigation', 'elementor/css/navigation.css' );

        /**
         * Widget's JS
         */
        $assets->register( 'betterdocs-el-category-grid', 'elementor/js/category-grid.js', ['jquery', 'betterdocs-category-toggler'] );

        if ( betterdocs()->helper->is_el_templates() == true ) {
            $assets->enqueue( 'betterdocs-elementor-editor', 'elementor/css/betterdocs-el-edit.css' );

            if ( ! $this->is_pro_active ) {
                $assets->enqueue( 'betterdocs-elementor-editor', 'elementor/js/editor.js', ['jquery'] );
            }
        }

        do_action( 'betterdocs_elementor_enqueue_scripts', $this );
    }

    public function register_theme_builder_widgets( $widgets_manager ) {
        foreach ( $this->builder_widget_list() as $value ) {
            if ( class_exists( $value ) ) {
                $widgets_manager->register( new $value );
            }
        }
    }

    /**
     * Mange all widget for single docs
     *
     * @return array<string>
     * @since  1.3.0
     */
    public function builder_widget_list() {
        return apply_filters( 'betterdocs_elementor_pro_widgets', [
            'betterdocs-elementor-toc'                   => ToC::class,
            'betterdocs-elementor-title'                 => Title::class,
            'betterdocs-elementor-sidebar'               => Sidebar::class,
            'betterdocs-elementor-content'               => Content::class,
            'betterdocs-elementor-doc-date'              => DocDate::class,
            'betterdocs-elementor-doc-share'             => DocShare::class,
            'betterdocs-elementor-feedback'              => Feedback::class,
            'betterdocs-elementor-reactions'             => Reactions::class,
            'betterdocs-elementor-navigation'            => Navigation::class,
            'betterdocs-elementor-breadcrumbs'           => Breadcrumbs::class,
            'betterdocs-elementor-category-archive-list' => ArchiveList::class
        ] );
    }

    /**
     * @param \ElementorPro\Modules\ThemeBuilder\Classes\Conditions_Manager $conditions_manager
     */
    public function register_conditions( $conditions_manager ) {
        $betterdocs_condition = betterdocs()->container->get( ArchiveCondition::class );
        $conditions_manager->get_condition( 'general' )->register_sub_condition( $betterdocs_condition );
    }

    public function betterdocs_init() {
        add_action( 'elementor/init', [$this, 'register_template_instance'], 20 );

        static $is_done = false;
        if ( defined( 'Elementor\Api::LIBRARY_OPTION_KEY' ) && ! $is_done ) {
            $is_done = true;
            add_filter( 'option_' . ElementorAPI::LIBRARY_OPTION_KEY, [$this, 'prepend_categories'] );
        }

        add_action( 'elementor/ajax/register_actions', [$this, 'modified_ajax_action'], 20 );

        if ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, '3.10.0', '>=' ) && ! self::$is_templates_added ) {
            self::$is_templates_added = true;
            add_filter( 'http_response', [$this, 'http_response_modify_for_bd_template'], 10, 3 );
        } elseif ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, '3.5.0', '>=' ) && ! self::$is_templates_added ) {
            self::$is_templates_added = true;
            add_filter( 'option_' . ElementorAPI::LIBRARY_OPTION_KEY, [$this, 'added_bd_template'] );
        }
    }

    /**
     * Added BetterDocs template with Elementor core templates list
     *
     * @param $response
     * @param $parsed_args
     * @param $url
     *
     * @return mixed
     * @since  2.3.5
     */
    public function http_response_modify_for_bd_template( $response, $parsed_args, $url ) {
        if ( $url === \Elementor\TemplateLibrary\Source_Remote::API_TEMPLATES_URL ) {
            $templates_list = json_decode( wp_remote_retrieve_body( $response ), true );
            $bd_templates   = $this->get_templates();

            if ( ! empty( $bd_templates ) ) {
                $templates_list = array_merge( (array) $templates_list, (array) $bd_templates );
            }

            $response['body'] = json_encode( $templates_list );
        }

        return $response;
    }

    public function register_template_instance() {
        $this->elementor->templates_manager->register_source( TemplateSource::class );
    }

    public function prepend_categories( $library_data ) {
        $categories = $this->template_categories();
        if ( ! empty( $categories ) ) {
            $library_data['types_data']['block']['categories'] = array_merge(
                $categories,
                $library_data['types_data']['block']['categories']
            );
        }
        return $library_data;
    }

    public function template_categories() {
        return [
            'Single Docs',
            'Docs Archive'
        ];
    }

    /**
     * Added BetterDocs template with Elementor core templates list
     *
     * added_template
     *
     * @param $templates_list array elementor template list
     *
     * @return array
     * @since  2.0.7
     *
     */
    public function added_bd_template( array $templates_list ) {
        $templates = $this->get_templates();

        if ( ! empty( $templates ) ) {
            $templates_list['templates'] = array_merge( $templates_list['templates'], $templates );
        }

        return $templates_list;
    }

    /**
     * get_templates
     *
     * Get Better docs template list and cache this list
     *
     * @return array|mixed
     * @since 2.0.0
     */
    public function get_templates() {
        $_cache_key = 'betterdocs_template_library_' . betterdocs()->version;
        $templates  = get_transient( $_cache_key );

        if ( ! $templates ) {
            $source    = new TemplateSource;
            $templates = $source->get_items();

            if ( ! empty( $templates ) ) {
                $templates = array_map( function ( $template ) {
                    $template['id']                = $template['template_id'];
                    $template['tmpl_created']      = $template['date'];
                    $template['tags']              = json_encode( $template['tags'] );
                    $template['is_pro']            = $template['isPro'];
                    $template['access_level']      = $template['accessLevel'];
                    $template['popularity_index']  = $template['popularityIndex'];
                    $template['trend_index']       = $template['trendIndex'];
                    $template['has_page_settings'] = $template['hasPageSettings'];

                    return $template;
                }, $templates );

                set_transient( $_cache_key, $templates, WEEK_IN_SECONDS );
            } else {
                $templates = [];
            }
        }

        return $templates;
    }

    public function modified_ajax_action( $ajax ) {
        if ( ! isset( $_REQUEST['actions'] ) ) {
            return;
        }

        $actions = json_decode( stripslashes( $_REQUEST['actions'] ), true );
        $data    = false;

        foreach ( $actions as $id => $action_data ) {
            if ( ! isset( $action_data['get_template_data'] ) ) {
                $data = $action_data;
            }
        }

        if ( ! $data ) {
            return;
        }

        if ( ! isset( $data['data'] ) ) {
            return;
        }

        $data = $data['data'];

        if ( empty( $data['template_id'] ) ) {
            return;
        }

        if ( false === strpos( $data['template_id'], 'betterdocs_' ) ) {
            return;
        }
        $ajax->register_ajax_action( 'get_template_data', [$this, 'get_template_data'] );
    }

    public function get_template_data( $args ) {
        $source = new TemplateSource;
        return $source->get_data( $args );
    }
}
