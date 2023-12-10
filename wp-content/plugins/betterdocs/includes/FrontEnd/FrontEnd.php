<?php

namespace WPDeveloper\BetterDocs\FrontEnd;

use WPDeveloper\BetterDocs\Utils\Base;
use WPDeveloper\BetterDocs\Core\Settings;
use WPDeveloper\BetterDocs\Utils\Enqueue;
use WPDeveloper\BetterDocs\Utils\Database;
use WPDeveloper\BetterDocs\Dependencies\DI\Container;

class FrontEnd extends Base {
    private $container;
    private $database;
    /**
     * Enqueue
     * @var Enqueue
     */
    private $assets;
    /**
     * Settings
     * @var Settings
     */
    private $settings;
    private $widget_attributes = [];
    private $widget_type       = '';

    public function __construct( Container $container, Database $database, Settings $settings ) {
        $this->container = $container;
        $this->database  = $database;
        $this->settings  = $settings;

        $this->assets = $this->container->get( Enqueue::class );

        add_action( 'init', [$this, 'init'] );
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );

        add_filter( 'betterdocs_layout_filename', [$this, 'layout_filename'], 10, 2 );

        add_action( 'betterdocs_docs_before_social', [$this, 'article_reactions'] );

        add_action( 'betterdocs_before_render', [$this, 'before_render'], 11, 2 );
        add_action( 'betterdocs_after_render', [$this, 'after_render'], 11, 2 );

        //Removes Divi Script On Betterdocs Single Doc #1130, issue title -> ( Bug Fix | With the DIVI theme copy #Url button doesn't seem to work )
        add_action( 'wp_enqueue_scripts', [$this, 'dequeue_divi_script'], 99999 );
    }

    public function before_render( $widget, $widget_type ) {
        $this->widget_attributes = isset( $widget->attributes ) ? $widget->attributes : [];
        $this->widget_type       = $widget_type;

        /**
         * This line of code will run for reactions shortcode, elementor widget and blocks
         */
        if ( strpos( $widget->get_name(), 'reactions' ) !== false ) {
            $this->localize_reactions_data();
        }

        /**
         * This line of code will run for Feedback form Shortcode, Elementor widget and blocks
         */
        if ( strpos( $widget->get_name(), 'feedback_form' ) ) {
            $this->localize_feedback_form_data();
        }

        add_filter( 'betterdocs_nested_terms_args', [$this, 'terms_args'], 11, 1 );
        add_filter( 'betterdocs_nested_docs_args', [$this, 'docs_args'], 11, 1 );
    }

    public function dequeue_divi_script() {
        if ( is_singular( 'docs' ) ) {
            wp_dequeue_script( 'divi-custom-script' );
        }
    }

    public function after_render( $widget, $widget_type ) {
        remove_filter( 'betterdocs_nested_terms_args', [$this, 'terms_args'], 11 );
        remove_filter( 'betterdocs_nested_docs_args', [$this, 'docs_args'], 11 );

        $this->widget_attributes = [];
        $this->widget_type       = '';
    }

    public function terms_args( $args ) {
        switch ( $this->widget_type ) {
            case 'shortcode':
                if ( isset( $this->widget_attributes['terms_orderby'] ) ) {
                    $args['orderby'] = $this->widget_attributes['terms_orderby'];
                }

                if ( isset( $this->widget_attributes['terms_order'] ) ) {
                    $args['order'] = $this->widget_attributes['terms_order'];
                }
                break;
            case 'blocks':
                if ( isset( $this->widget_attributes['orderBy'] ) ) {
                    if ( $this->widget_attributes['orderBy'] == 'doc_category_order' ) {
                        $args['orderby']  = 'meta_value_num';
                        $args['meta_key'] = $this->widget_attributes['orderBy'];
                    } else {
                        $args['orderby'] = $this->widget_attributes['orderBy'];
                    }
                }
                if ( isset( $this->widget_attributes['order'] ) ) {
                    $args['order'] = $this->widget_attributes['order'];
                }
                break;
            case 'elementor':
                $args['orderby'] = $this->widget_attributes['orderby'];
                $args['order']   = $this->widget_attributes['order'];
                break;
        }

        return $args;
    }

    public function docs_args( $args ) {
        switch ( $this->widget_type ) {
            case 'shortcode':
                if ( isset( $this->widget_attributes['orderby'] ) ) {
                    $args['orderby'] = $this->widget_attributes['orderby'];
                }

                if ( isset( $this->widget_attributes['order'] ) ) {
                    $args['order'] = $this->widget_attributes['order'];
                }
                break;
            case 'blocks':
                if ( isset( $this->widget_attributes['postsOrderBy'] ) ) {
                    $args['orderby'] = $this->widget_attributes['postsOrderBy'];
                }
                if ( isset( $this->widget_attributes['postsOrder'] ) ) {
                    $args['order'] = $this->widget_attributes['postsOrder'];
                }

                //This is for archive category block only
                if ( isset( $this->widget_attributes['orderby'] ) ) {
                    $args['orderby'] = $this->widget_attributes['orderby'];
                }
                if ( isset( $this->widget_attributes['order'] ) ) {
                    $args['order'] = $this->widget_attributes['order'];
                }
                break;
            case 'elementor':
                $args['orderby'] = $this->widget_attributes['post_orderby'];
                $args['order']   = $this->widget_attributes['post_order'];
                break;
        }

        return $args;
    }

    public function article_reactions() {
        if ( $this->database->get_theme_mod( 'betterdocs_post_reactions', true ) ) {
            echo do_shortcode( '[betterdocs_article_reactions]' );
        }
    }

    public function enqueue_scripts() {
        if ( is_singular( 'docs' ) ) {
            wp_enqueue_style( 'betterdocs-single' );
            wp_enqueue_script( 'clipboard' );
        }

        if ( is_post_type_archive( 'docs' ) ) {
            wp_enqueue_style( 'betterdocs-docs' );
        }

        if ( is_tax( 'doc_category' ) || is_tax( 'doc_tag' ) ) {
            wp_enqueue_style( 'betterdocs-doc_category' );
        }

        if ( is_tax( 'doc_category' ) || is_tax( 'doc_tag' ) || is_singular( 'docs' ) ) {
            wp_enqueue_style( 'simplebar' );
            wp_enqueue_script( 'simplebar' );
            wp_enqueue_script( 'betterdocs-category-grid' );
        }

        if ( is_post_type_archive( 'docs' ) || is_singular( 'docs' ) || is_tax( 'doc_category' ) || is_tax( 'doc_tag' ) || is_tax( 'knowledge_base' ) ) {
            wp_enqueue_script( 'betterdocs' );
        }
    }

    public function layout_filename( $filename, $origin_layout ) {
        $filename = ( $origin_layout === 'layout-2' ) ? 'default' : $filename;
        return $filename;
    }

    public function init() {
        $this->container->get( TemplateLoader::class )->init();

        add_filter( 'betterdocs_articles_args', [$this, 'article_args'], 11, 3 );
    }

    public function article_args( $args, $term_id, $_origin_args ) {
        if ( null == $term_id || isset( $args['orderby'] ) ) {
            return $args;
        }

        $post__in = betterdocs()->query->get_docs_order_by_terms( $term_id );

        if ( ! empty( $post__in ) ) {
            $args['orderby']  = 'post__in';
            $args['post__in'] = $post__in;
        }

        return $args;
    }

    public function localize_reactions_data() {
        $this->assets->localize( 'betterdocs-reactions', 'betterdocsReactionsConfig', [
            'post_id'  => get_the_ID(),
            'FEEDBACK' => [
                'DISPLAY' => true,
                'TEXT'    => esc_html__( 'How did you feel?', 'betterdocs' ),
                'SUCCESS' => esc_html__( 'Thanks for your feedback', 'betterdocs' ),
                'URL'     => get_rest_url( null, '/betterdocs/v1/feedback' )
            ]
        ] );
    }

    public function localize_feedback_form_data() {
        $this->assets->localize( 'betterdocs', 'betterdocsSubmitFormConfig', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'post_id'  => get_the_ID(),
            'nonce'    => wp_create_nonce( 'betterdocs_submit_data' )
        ] );
    }
}
