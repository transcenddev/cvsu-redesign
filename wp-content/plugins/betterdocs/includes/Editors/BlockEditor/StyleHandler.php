<?php
namespace WPDeveloper\BetterDocs\Editors\BlockEditor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use WPDeveloper\BetterDocs\Utils\Base;

final class StyleHandler extends Base {
    private $media_desktop = [
        'name'        => 'desktop',
        'screen_size' => ''
    ];

    private $media_hover_desktop = [
        'name'        => 'desktopHover',
        'screen_size' => ''
    ];

    private $media_tab = [
        'name'        => 'tab',
        'screen_size' => 1024
    ];

    private $media_hover_tab = [
        'name'        => 'tabHover',
        'screen_size' => 1024
    ];

    private $media_mobile = [
        'name'        => 'mobile',
        'screen_size' => 767
    ];

    private $media_hover_mobile = [
        'name'        => 'mobileHover',
        'screen_size' => 767
    ];

    private $extra_styles = [
        'name'        => 'extraStyles',
        'screen_size' => ''
    ];

    public function __construct() {
        add_action( 'admin_enqueue_scripts', [$this, 'betterdocs_blocks_edit_post'] );
        add_action( 'wp_ajax_betterdocs_write_block_css', [$this, 'write_block_css'] );
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_frontend_css'] );
    }

    /**
     * Enqueue a script in the WordPress admin on edit.php.
     * @param int $hook Hook suffix for the current admin page.
     */
    public function betterdocs_blocks_edit_post( $hook ) {
        if ( 'widgets.php' === $hook ) {
            return;
        }

        if ( $hook != 'post.php' && $hook != 'post-new.php' && $hook != 'site-editor.php' ) {
            return;
        }

        $_style_handler_deps = [
            'lodash',
            'wp-i18n',
            'wp-element',
            'wp-hooks',
            'wp-util',
            'wp-components',
            'wp-blocks',
            'wp-editor',
            'wp-block-editor'
        ];

        $_style_handler_object = [
            'sth_nonce'   => wp_create_nonce( 'betterdocs_style_handler_nonce' ),
            'editor_type' => 'edit-site'
        ];

        if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
            $_style_handler_deps[]                = 'wp-edit-post';
            $_style_handler_object['editor_type'] = 'edit-post';
        } elseif ( $hook == 'site-editor.php' ) {
            $_style_handler_deps[]                = 'wp-edit-site';
            $_style_handler_object['editor_type'] = 'edit-site';
        }

        betterdocs()->assets->enqueue( 'betterdocs-blocks-style-handler', 'vendor/js/style-handler.js', $_style_handler_deps );
        betterdocs()->assets->localize( 'betterdocs-blocks-style-handler', 'betterdocs_style_handler', $_style_handler_object );
    }

    /**
     * Ajax callback to write css in upload directory
     * @retun void
     * @since 1.0.2
     */
    public function write_block_css() {
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'betterdocs_style_handler_nonce' ) || ! current_user_can( 'manage_options' ) ) {
            echo 'Invalid request';
            wp_die();
        }

        $block_styles = (array) json_decode( stripslashes( $_POST['data'] ) );

        if ( isset( $_POST['editorType'] ) && $_POST['editorType'] === "edit-site" ) {
            $upload_dir      = wp_upload_dir()['basedir'] . '/betterdocs-style/';
            $editSiteCssPath = $upload_dir . 'betterdocs-style-' . $_POST['editorType'] . '.min.css';
            if ( file_exists( $editSiteCssPath ) ) {
                $existingCss = file_get_contents( $editSiteCssPath );
                $pattern     = "~\/\*(.*?)\*\/~";
                preg_match_all( $pattern, $existingCss, $result, PREG_PATTERN_ORDER );
                $allComments  = $result[0];
                $seperatedIds = [];
                foreach ( $allComments as $comment ) {
                    $id = preg_replace( '/[^A-Za-z0-9\-]|Ends|Starts/', '', $comment );

                    if ( strpos( $comment, "Starts" ) ) {
                        $seperatedIds[$id]['start'] = $comment;
                    } else if ( strpos( $comment, "Ends" ) ) {
                        $seperatedIds[$id]['end'] = $comment;
                    }
                }

                $seperateStyles = [];
                foreach ( $seperatedIds as $key => $ids ) {
                    $data                 = $this->get_between_data( $existingCss, $ids['start'], $ids['end'] );
                    $seperateStyles[$key] = $data;
                }

                $finalCSSArray = array_merge( $seperateStyles, $block_styles );

                if ( ! empty( $css = $this->build_css( $finalCSSArray ) ) ) {
                    $upload_dir = wp_upload_dir()['basedir'] . '/betterdocs-style/';
                    if ( ! file_exists( $upload_dir ) ) {
                        mkdir( $upload_dir );
                    }

                    file_put_contents( $editSiteCssPath, $css );
                }
            } else {
                if ( ! empty( $css = $this->build_css( $block_styles ) ) ) {
                    $upload_dir = wp_upload_dir()['basedir'] . '/betterdocs-style/';
                    if ( ! file_exists( $upload_dir ) ) {
                        mkdir( $upload_dir );
                    }

                    file_put_contents( $editSiteCssPath, $css );
                }
            }
        } else {
            if ( ! empty( $css = $this->build_css( $block_styles ) ) ) {
                $upload_dir = wp_upload_dir()['basedir'] . '/betterdocs-style/';
                if ( ! file_exists( $upload_dir ) ) {
                    mkdir( $upload_dir );
                }
                file_put_contents( $upload_dir . 'betterdocs-style-' . abs( $_POST['id'] ) . '.min.css', $css );
            }
        }

        wp_send_json_success( 'done' );
    }

    /**
     * Enqueue frontend css for post if have one
     * @return void
     * @since 1.0.2
     */
    public function enqueue_frontend_css() {
        global $post;

        if ( ! empty( $post ) && ! empty( $post->ID ) ) {
            $upload_dir = wp_upload_dir();

            $style_css_path = $upload_dir['basedir'] . '/betterdocs-style/betterdocs-style-' . $post->ID . '.min.css';
            $style_css_url  = $upload_dir['baseurl'] . '/betterdocs-style/betterdocs-style-' . $post->ID . '.min.css';

            if ( file_exists( $style_css_path ) ) {
                wp_enqueue_style(
                    'betterdocs-block-style-' . $post->ID,
                    $style_css_url, [], betterdocs()->version, 'all'
                );
            }
            if ( function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() && file_exists( $upload_dir['basedir'] . '/betterdocs-style/betterdocs-style-edit-site.min.css' ) ) {
                wp_enqueue_style( 'betterdocs-fullsite-style', $upload_dir['baseurl'] . '/betterdocs-style/betterdocs-style-edit-site.min.css', [], substr( md5( microtime( true ) ), 0, 10 ) );
            }
        }
    }

    /**
     * Enqueue frontend css for post if have one
     * @param array
     * @return string
     * @since 1.0.2
     */
    private function build_css( $style_object ) {
        // $block_styles = (array)json_decode(stripslashes($style_object));
        $block_styles = $style_object;

        $css = '';
        foreach ( $block_styles as $block_style_key => $block_style ) {
            if ( ! empty( $block_css = (array) $block_style ) ) {
                $css .= sprintf(
                    '/* %1$s Starts */',
                    $block_style_key
                );
                foreach ( $block_css as $media => $style ) {
                    switch ( $media ) {
                        case $this->media_desktop['name']:
                            $css .= preg_replace( '/\s+/', ' ', $style );
                            break;
                        case $this->media_hover_desktop['name']:
                            $css .= preg_replace( '/\s+/', ' ', $style );
                            break;
                        case $this->media_tab['name']:
                            $css .= ' @media(max-width: 1024px){';
                            $css .= preg_replace( '/\s+/', ' ', $style );
                            $css .= '}';
                            break;
                        case $this->media_hover_tab['name']:
                            $css .= ' @media(max-width: 1024px){';
                            $css .= preg_replace( '/\s+/', ' ', $style );
                            $css .= '}';
                            break;
                        case $this->media_mobile['name']:
                            $css .= ' @media(max-width: 767px){';
                            $css .= preg_replace( '/\s+/', ' ', $style );
                            $css .= '}';
                            break;
                        case $this->media_hover_mobile['name']:
                            $css .= ' @media(max-width: 767px){';
                            $css .= preg_replace( '/\s+/', ' ', $style );
                            $css .= '}';
                            break;
                        case $this->extra_styles['name']:
                            $css .= preg_replace( '/\s+/', ' ', $style );
                            break;
                    }
                }
                $css .= sprintf(
                    '/* =%1$s= Ends */',
                    $block_style_key
                );
            }
        }
        return trim( $css );
    }

    /**
     * Helper function to get string between 2 string
     * @since 3.3.0
     */
    private function get_between_data( $string, $start, $end ) {
        $pos_string   = stripos( $string, $start );
        $substr_data  = substr( $string, $pos_string );
        $string_two   = substr( $substr_data, strlen( $start ) );
        $second_pos   = stripos( $string_two, $end );
        $string_three = substr( $string_two, 0, $second_pos );

        // remove whitespaces from result
        $result_unit = trim( $string_three );

        // return result_unit
        return $result_unit;
    }
}
