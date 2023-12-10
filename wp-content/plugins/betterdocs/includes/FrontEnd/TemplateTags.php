<?php
namespace WPDeveloper\BetterDocs\FrontEnd;

use Exception;
use WPDeveloper\BetterDocs\Core\Query;
use WPDeveloper\BetterDocs\Utils\Base;
use WPDeveloper\BetterDocs\Utils\Views;
use WPDeveloper\BetterDocs\Core\Settings;
use WPDeveloper\BetterDocs\Admin\Customizer\Defaults;

class TemplateTags extends Base {
    /**
     * BETTERDOCS_KSES_ALLOWED_HTML
     * @var array
     */
    const KSES_ALLOWED_HTML = [
        'span'   => [
            'class' => [],
            'style' => []
        ],
        'p'      => [
            'class' => [],
            'style' => []
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => []
        ],
        'h1'     => [],
        'h2'     => [],
        'h3'     => [],
        'h4'     => [],
        'h5'     => [],
        'h6'     => [],
        'div'    => [
            'class' => [],
            'style' => []
        ]
    ];

    const ALLOWED_HTML_TAGS = [
        'article',
        'aside',
        'div',
        'footer',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
        'header',
        'main',
        'nav',
        'p',
        'section',
        'span'
    ];

    /**
     * Summary of Settings
     * @var Settings
     */
    private $settings;
    /**
     * Summary of Defaults
     * @var Defaults
     */
    private $defaults;
    /**
     * Summary of $mods
     * @var array
     */
    private $mods;
    /**
     * Summary of $query
     * @var Query
     */
    private $query;

    /**
     * Summary of $views
     * @var Views
     */
    private $views;

    public function __construct( Settings $settings, Defaults $defaults, Query $query, Views $views ) {
        $this->settings = $settings;
        $this->defaults = $defaults;
        $this->mods     = $defaults->generate_defaults();
        $this->query    = $query;
        $this->views    = $views;
    }

    public function kses( $value ) {
        return wp_kses( $value, self::KSES_ALLOWED_HTML );
    }

    public function icon( $name = 'list', $echo = false ) {
        if ( is_array( $name ) ) {
            if( $echo ) {
                $this->icon_as_markup( $name, $echo );
                return;
            }

            return $this->icon_as_markup( $name, $echo );
        }

        if ( $echo ) {
            $this->views->get( 'icons/' . $name );
            return;
        }

        ob_start();
        $this->views->get( 'icons/' . $name );
        return ob_get_clean();
    }

    public function icon_as_markup( $icon, $echo = false, $class = [] ) {
        $_original_icon = $icon;
        if ( is_array( $_original_icon ) ) {
            $icon = '';

            if ( ! empty( $_original_icon['value']['url'] ) ) {
                $icon = $_original_icon['value']['url'];
            } elseif ( ! empty( $_original_icon['value'] ) ) {
                $icon = $_original_icon['value'];
            }
        }

        if( empty( $icon ) ) {
            return;
        }

        $_icon_as_url = filter_var( $icon, FILTER_VALIDATE_URL );

        if ( ! $_icon_as_url ) {
            $class[] = $icon;
            $_markup = sprintf(
                '<i class="%s"></i>',
                esc_attr( implode( ' ', $class ) )
            );
        }

        if ( $_icon_as_url ) {
            $_markup = sprintf(
                '<img src="%s" class="%s" />',
                esc_attr( esc_url( $icon ) ),
                esc_attr( implode( ' ', $class ) )
            );
        }

        if( $echo ) {
            echo wp_kses_post( $_markup );
        }

        return wp_kses_post( $_markup );
    }

    public function icon_markup( $icon, $face = 'left', $class = [], $echo = true ) {
        if ( is_array( $icon ) ) {
            if ( ! empty( $icon['value']['url'] ) ) {
                $icon = $icon['value']['url'];
            } elseif ( ! empty( $icon['value'] ) ) {
                $icon = $icon['value'];
            }
        }

        $_icon_as_url = filter_var( $icon, FILTER_VALIDATE_URL );

        if ( empty( $class ) ) {
            $class = [
                'el-betterdocs-cg-button-icon',
                'el-betterdocs-cg-button-icon-' . $face
            ];
        }

        if ( ! $_icon_as_url ) {
            $class[] = $icon;
            $_markup = sprintf(
                '<i class="%s"></i>',
                esc_attr( implode( ' ', $class ) )
            );
        }

        if ( $_icon_as_url ) {
            $_markup = sprintf(
                '<img src="%s" class="%s" />',
                esc_attr( esc_url( $icon ) ),
                esc_attr( implode( ' ', $class ) )
            );
        }

        // it's html
        if ( preg_match( '/^<.*>/', $icon, $matches ) && isset( $matches[0] ) && ! empty( $matches[0] ) ) {
            $_markup = $matches[0];
        }

        if ( ! $echo ) {
            return wp_kses_post( $_markup );
        }

        echo wp_kses_post( $_markup );
    }

    /**
     * Is Valid Tag
     * @param string $tag
     * @return string
     */
    public function is_valid_tag( $tag ) {
        return in_array( strtolower( $tag ), self::ALLOWED_HTML_TAGS ) ? $tag : 'div';
    }

    public function option_kses( $value, $label, $current ) {
        return wp_kses(
            sprintf(
                '<option value="%1$s" %3$s>%2$s</option>',
                $value, $label, selected( $current, $value, false )
            ),
            [
                'option' => [
                    'value'    => [],
                    'selected' => []
                ]
            ]
        );
    }

    public function get_html_attributes( $attributes = [] ) {
        if ( ! is_array( $attributes ) ) {
            if( is_string( $attributes ) ) {
                return $attributes;
            }

            return '';
        }

        $rendered_attributes = [];

        foreach ( $attributes as $attribute_key => $attribute_values ) {
            if ( is_array( $attribute_values ) ) {
                $attribute_values = implode( ' ', $attribute_values );
            }

            $rendered_attributes[] = sprintf( '%1$s="%2$s"', $attribute_key, esc_attr( $attribute_values ) );
        }

        return implode( ' ', $rendered_attributes );
    }

    public function search() {
        if ( ! $this->settings->get( 'live_search' ) ) {
            return;
        }

        $search_heading = $search_subheading = '';
        $heading_tag = 'h2';
        $subheading_tag = 'h3';

        $search_placeholder = $this->settings->get( 'search_placeholder' );

        if ( $this->defaults->get('betterdocs_live_search_heading_switch', false) ) {
            $search_heading        = $this->defaults->get('betterdocs_live_search_heading');
            $search_subheading     = $this->defaults->get('betterdocs_live_search_subheading');
            $heading_tag           = $this->defaults->get('betterdocs_live_search_heading_tag');
            $subheading_tag        = $this->defaults->get('betterdocs_live_search_subheading_tag');
        }

        $_shortcode_license = apply_filters( 'betterdocs_search_shortcode_attributes', [
            'placeholder'    => $search_placeholder,
            'heading'        => $search_heading,
            'subheading'     => $search_subheading,
            'heading_tag'    => $heading_tag,
            'subheading_tag' => $subheading_tag
        ], $this->mods );

        ob_start();

        betterdocs()->views->get( 'layout-parts/search', [
            'attributes' => $this->get_html_attributes( $_shortcode_license )
        ] );

        echo ob_get_clean();
    }

    public function breadcrumbs() {
    }

    public function supported_htags() {
        $_tags          = '';
        $supported_tags = $this->settings->get( 'supported_heading_tag' );

        if ( is_array( $supported_tags ) ) {
            $_tags = implode( ',', $supported_tags );
        }

        return $_tags;
    }

    public function content( $content, $supported_tags = null, $enable_toc = null ) {
        if ( null === $supported_tags ) {
            $supported_tags = $this->supported_htags();
        }

        if ( null === $enable_toc ) {
            $enable_toc = $this->settings->get( 'enable_toc' );
        }

        if ( $enable_toc && $supported_tags != '' ) {
            preg_match_all( '/(<h([' . $supported_tags . ']{1})[^>]*>).*<\/h\2>/msuU', $content, $matches, PREG_SET_ORDER );

            $index   = 0;
            $content = preg_replace_callback( '#<(h[' . $supported_tags . '])(.*?)>(.*?)</\1>#si', function ( $matches ) use ( &$index ) {
                $tag = $matches[1];
                $heading_name = preg_replace('/<[^<]+?>/', '', $matches[0]);
				$heading_name = ! empty( $heading_name ) ? strtolower( str_replace( " ", '-', preg_replace('/<[^>]+>|[^a-zA-Z\s\d]+/', "", html_entity_decode( $heading_name ) ) ) ) : '';
                preg_match('/id="(.+?)"/', $matches[0], $matched_ids);

                if ( isset( $matched_ids[1] ) ) {
                    $id = strtolower( $matched_ids[1] );
                } elseif ( ! empty ($heading_name ) && $this->settings->get('toc_dynamic_title') !== false) {
                    $id = $heading_name;
                } else {
                    $id = $index . '-toc-title';
                }

                $index++;
                $hash_link      = '';
                $title_link_ctc = $this->settings->get( 'title_link_ctc' );
                if ( $title_link_ctc ) {
                    $hash_link = '<a href="#' . $id . '" class="batterdocs-anchor" data-clipboard-text="' . get_permalink() . '#' . $id . '" data-title="' . __( 'Copy URL', 'betterdocs' ) . '">#</a>';
                }

                // Get The Class Names Using REGEX
				preg_match('/class="([^"]*)"/', $matches[2], $class_matches );
				$classes = isset( $class_matches[1] ) ?  strtolower( $class_matches[1] )  : '';

				$class   = ! empty( $classes ) ? $classes . ' betterdocs-content-heading' : 'betterdocs-content-heading';

                return sprintf(
                    '<%1$s class="%2$s" id="%3$s">%4$s %5$s</%1$s>',
                    $tag, $class, $id, $matches[3], $hash_link
                );
            }, $content );
        }

        if( ! empty( $content ) ) {
            return '<div id="betterdocs-single-content" class="betterdocs-content">' . $content . '</div>';
        }

        return '';
    }

    public function sidebar( $layout ) {
        if ( ! $this->settings->get( 'enable_archive_sidebar' ) ) {
            return;
        }

        $_template_path = 'templates/sidebars/sidebar-1';
        if ( $layout == 'layout-4' ) {
            $_template_path = 'templates/sidebars/sidebar-5';
        } else if ( $layout == 'layout-5' ) {
            $_template_path = 'templates/sidebars/sidebar-4';
        } else if ( $layout == 'layout-2' ) {
            $_template_path = 'templates/sidebars/sidebar-2';
        } else if ( $layout == 'layout-3' ) {
            $_template_path = 'templates/sidebars/sidebar-3';
        } else if ( $layout == 'archive-sidebar' ) {
            $_template_path = 'templates/sidebars/archive-sidebar';
        }

        $_template_path = apply_filters( 'betterdocs_archive_sidebar_template', $_template_path, $layout );

        betterdocs()->views->get( $_template_path, [
            'force' => true
        ] );
    }

    public function term_options( $taxonomy = 'doc_category', $current_term = '', $parent = false ) {
        $_args = [
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
            'number'     => 0
        ];

        if ( $parent ) {
            $_args['parent'] = 0;
        }

        $_terms = $this->query->get_terms( $_args );

        if ( is_wp_error( $_terms ) ) {
            return;
        }

        $html = '';

        foreach ( $_terms as $term ) {
            $html .= $this->option_kses( $term->slug, $term->name, $current_term );
        }

        return $html;
    }

    public function category_icon( $params ) {
        if ( ! isset( $params['show_icon'], $params['term'] ) ) {
            return;
        }

        $term = $params['term'];

        $this->views->get( 'template-parts/category-icon', [
            'show_icon' => $params['show_icon'],
            'term_id'   => $term->term_id
        ] );
    }

    public function category_title( $params ) {
        if ( ! isset( $params['show_title'], $params['term'], $params['title_tag'] ) || ! $params['show_title'] ) {
            return;
        }

        $term = $params['term'];

        $this->views->get( 'template-parts/category-title', [
            'title' => $term->name,
            'tag'   => $params['title_tag']
        ] );
    }

    public function category_description( $params ) {
        if ( ! isset( $params['show_description'], $params['term'] ) && empty( $params['term']->description ) ) {
            return;
        }

        $this->views->get( 'template-parts/category-description', [
            'description' => $params['term']->description
        ] );
    }

    public function collapse_icon( $params ) {
        betterdocs()->views->get( 'icons/collapse' );
    }

    public function category_counts( $params ) {
        if ( ! isset( $params['show_count'], $params['counts'] ) ) {
            return;
        }

        $this->views->get( 'template-parts/category-counter', [
            'show_count' => $params['show_count'],
            'counts'     => $params['counts']
        ] );
    }

    public function wrapper_div( $params ) {
        if ( ! isset( $params['sequence'] ) ) {
            return;
        }

        ob_start();
        foreach ( $params['sequence'] as $sequenceName ) {
            $this->{$sequenceName}( $params );
        }
        $sequence_content = ob_get_clean();

        $classNames = isset( $params['class'] ) ? $params['class'] : '';

        echo '<div class="betterdocs-dynamic-wrapper ' . $classNames . '">';
        echo $sequence_content;
        echo '</div>';
    }

    /**
     * Shortcode Attributes
     * @param mixed $atts
     * @param mixed $shortcode
     *
     * @return string
     */
    public function shortcode_atts( $atts, $shortcode, $layout, ...$args ) {
        $tagname = 'betterdocs_archive_template_shortcode_params';
        if( strpos($layout, 'sidebar-') === 0 ) {
            $tagname = 'betterdocs_sidebar_template_shortcode_params';
        }

        $_shortcode_attributes = apply_filters( $tagname, $atts, $shortcode, $layout, $args );
        return betterdocs()->template_helper->get_html_attributes( $_shortcode_attributes );
    }
}
