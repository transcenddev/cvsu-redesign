<?php

namespace WPDeveloper\BetterDocs\Shortcodes;

use WPDeveloper\BetterDocs\Utils\Node;
use WPDeveloper\BetterDocs\Core\Shortcode;

class ToC extends Shortcode {
    protected $html_attributes = [];

    public function get_name() {
        return 'betterdocs_toc';
    }

    public function get_style_depends() {
        return ['betterdocs-toc'];
    }

    /**
     * Summary of default_attributes
     * @return array
     */
    public function default_attributes() {
        return [
            'post_type'             => 'docs',
            'post_id'               => get_the_ID(),
            'htags'                 => '1,2,3,4,5,6',
            'hierarchy'             => '',
            'list_number'           => '',
            'collapsible_on_mobile' => $this->settings->get( 'collapsible_toc_mobile', false ),
            'toc_title'             => ''
        ];
    }

    public function render( $atts, $content = null ) {
        $this->views( 'shortcodes/toc' );
    }

    public function view_params() {
        return [
            'post' => get_post( $this->attributes['post_id'] )
        ];
    }

    /**
     * This method is responsible for re-arranging the TOC data based on hierarchy or non-hierarchy
     *
     * @param string $post_content
     * @param string $htag_support
     * @return Node|null
     */
    public function format_toc_data( $post_content, $htag_support, $toc_hierarchy ) {
        $matches = [];

        if ( $htag_support != '' ) {
            preg_match_all( '/(<h([' . $htag_support . ']{1})[^>]*>).*<\/h\2>/msuU', $post_content, $matches, PREG_SET_ORDER );
        }

        if ( ! empty( $matches ) ) {
            /*
            |--------------------------------------------------------------------------
            | Backtracking Algorithm Using Iteration | Main Login For Hierarchy TOC
            |--------------------------------------------------------------------------
            |
            | Initially an object with key null and empty item of arrays are inserted into the stack of arrays.
            | When inside the loop condition for the first time, the last stack value is assigned in a variable $last_data.
            | And a new node object $new_data which is instantiated and the tag number is inserted for comparison as key, and empty items
            | as a array are inserted into items property of the new node object. On the 'if' condition it checks, if the current tag number
            | is smaller or equal to the last stack number. If the condition is true, the it enters into the while loop condition, which also
            | checks if the current last stack tag number is greater or equal to the current tag number. It pops values from the stack until and unless the
            | condition becomes false. The while loop condition becomes false only when the last stack value tag number becomes null and the last stack number is not
            | greater or equal to the current node tag number.
            |
            | Backtracking occurs when the current tag_number $number[2] is less than or equal to the stacks last tag_number which is assigned as $last_data
            |
            | And then the last value is inserted as the new last_data, and the new_data node is inserted into the last_data node items.
            | Additionally the $new_data is inserted into the stack to keep track of the used node. Somehow if the if condition becomes false
            | then the stack last data is taken, and the new_data is inserted into the last_data->items and the new_data is inserted into the stack.
            |
             */

            $dynamic_toc_title_switch = $this->settings->get( 'toc_dynamic_title' );
            $stack                    = [];
            $root                     = new Node();
            $root->key                = null;
            $root->items              = [];
            $tag_counter              = 0;

            array_push( $stack, $root );

            foreach ( $matches as $number ) {
                $last_data          = $stack[count( $stack ) - 1];
                $current_tag_number = isset( $number[2] ) ? $number[2] : '';
                $current_title      = isset( $number[0] ) ? $number[0] : '';
                $current_tag        = isset( $number[1] ) ? $number[1] : '';

                $heading_name = preg_replace( '/<[^<]+?>/', '', $current_title );
                $heading_name = ! empty( $heading_name ) ? strtolower( str_replace( " ", '-', preg_replace('/<[^>]+>|[^a-zA-Z\s\d]+/', "", html_entity_decode( $heading_name ) ) ) ) : '';
                preg_match('/id="(.+?)"/', $current_title, $matches_id);
                $heading_id   = isset( $matches_id[1] ) ? strtolower( $matches_id[1] ) : '';
                $tag_number   = ! empty( $heading_id ) ? $heading_id : ( ! empty( $heading_name ) && $this->settings->get( 'toc_dynamic_title' ) ? $heading_name : $tag_counter . '-toc-title' );

                $new_data             = new Node();
                $new_data->key        = $current_tag_number;
                $new_data->tag        = $current_tag;
                $new_data->title      = $current_title;
                $new_data->tag_number = $tag_number;
                $new_data->items      = [];

                if ( $last_data->key != null && $current_tag_number <= $last_data->key ) {
                    while ( $stack[count( $stack ) - 1]->key != null && $stack[count( $stack ) - 1]->key >= $current_tag_number ) {
                        array_pop( $stack );
                    }
                    $last_data = $stack[count( $stack ) - 1];
                }

                array_push( $last_data->items, $new_data );

                if ( $toc_hierarchy != 'off' && $toc_hierarchy != '' ) {
                    array_push( $stack, $new_data );
                }

                $tag_counter++;
            }

            return $root;
        }

        return null;
    }
}
