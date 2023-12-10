<?php

/**
 * This is what output-css.php is in older version. ( 2.x )
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use WPDeveloper\BetterDocs\Utils\CSSGenerator;

$css = new CSSGenerator( $mods );

//Global Docs Wrapper Controls Background Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper', $css->properties( [
    'background-color' => 'betterdocs_doc_page_background_color'
] ) );

//Global Docs Wrapper Controls Background Image/Properties
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper', $css->properties( [
    'background-image' => [
        'id'         => 'betterdocs_doc_page_background_image',
        'properties' => [
            'background-size'       => 'betterdocs_doc_page_background_size',
            'background-repeat'     => 'betterdocs_doc_page_background_repeat',
            'background-attachment' => 'betterdocs_doc_page_background_attachment',
            'background-position'   => 'betterdocs_doc_page_background_position'
        ]
    ]
] ) );

//Global Docs Wrapper Controls Padding
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-content-wrapper', $css->properties( [
    'padding-top'    => 'betterdocs_doc_page_content_padding_top',
    'padding-right'  => 'betterdocs_doc_page_content_padding_right',
    'padding-bottom' => 'betterdocs_doc_page_content_padding_bottom',
    'padding-left'   => 'betterdocs_doc_page_content_padding_left'
], 'px' ) );

//Global Docs Wrapper Controls Width
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-content-wrapper', $css->properties( [
    'width' => 'betterdocs_doc_page_content_width'
], '%' ) );

//Global Docs Wrapper Controls Max Width
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-content-wrapper', $css->properties( [
    'max-width' => 'betterdocs_doc_page_content_max_width'
], 'px' ) );

/* CATEGORY COLUMN SETTINGS */
//Category Title Padding Bottom for only layout 1
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner', $css->properties( [
    'padding-bottom' => 'betterdocs_doc_page_cat_title_padding_bottom'
], 'px' ) );

//Space Between Columns Grid Layout Margin Bottom
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper.masonry > .betterdocs-single-category-wrapper', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_page_column_space'
], 'px' ) );

//Space Between Columns Grid Layout
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper', $css->properties( [
    '--gap' => 'betterdocs_doc_page_column_space'
] ) );

//Space Between Columns Box Layout
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper.layout-flex', $css->properties( [
    '--gap' => 'betterdocs_doc_page_column_space'
] ) );

//Doc Category Background Color for Grid Categories
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper > .betterdocs-single-category-wrapper .betterdocs-single-category-inner', $css->properties( [
    'background-color' => 'betterdocs_doc_page_column_bg_color'
] ) );

//Doc Category Background Color for Grid Categories
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-category-grid-wrapper .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper > .betterdocs-single-category-wrapper', $css->properties( [
    'background-color' => 'betterdocs_doc_page_column_bg_color'
] ) );

//Doc Category Background Color for Box Categories
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper > .betterdocs-single-category-wrapper', $css->properties( [
    'background-color' => 'betterdocs_doc_page_column_bg_color2'
] ) );

//Doc Category Hover Background Color for Box Categories
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper > .betterdocs-single-category-wrapper:hover', $css->properties( [
    'background-color' => '%betterdocs_doc_page_column_hover_bg_color%!important'
] ) );

//Doc Page Grid Category Padding
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper > .betterdocs-single-category-wrapper .betterdocs-category-header', $css->properties( [
    'padding-top'   => 'betterdocs_doc_page_column_padding_top',
    'padding-right' => 'betterdocs_doc_page_column_padding_right',
    'padding-left'  => 'betterdocs_doc_page_column_padding_left'
], 'px' ) );

//Doc Page Category Grid Layout 4 Column Padding ### this layout has padding bottom for 3 boxes only, Please note the grid will not have padding bottom for this layout only
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-category-grid-wrapper .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper.category-box', $css->properties( [
    'padding-top'    => 'betterdocs_doc_page_column_padding_top',
    'padding-right'  => 'betterdocs_doc_page_column_padding_right',
    'padding-left'   => 'betterdocs_doc_page_column_padding_left',
    'padding-bottom' => 'betterdocs_doc_page_column_padding_bottom'
], 'px' ) );

//Doc Page Grid Category Padding
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-body', $css->properties( [
    'padding-top'   => 'betterdocs_doc_page_column_padding_top',
    'padding-right' => 'betterdocs_doc_page_column_padding_right',
    'padding-left'  => 'betterdocs_doc_page_column_padding_left'
], 'px' ) );

$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-body:last-of-type', $css->properties( [
    'padding-bottom' => 'betterdocs_doc_page_column_padding_bottom'
], 'px' ) );

$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-footer', $css->properties( [
    'padding-bottom' => 'betterdocs_doc_page_column_padding_bottom',
    'padding-right'  => 'betterdocs_doc_page_column_padding_right',
    'padding-left'   => 'betterdocs_doc_page_column_padding_left'
], 'px' ) );

//Doc Page Box Category Padding
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper', $css->properties( [
    'padding-top'    => 'betterdocs_doc_page_column_padding_top',
    'padding-bottom' => 'betterdocs_doc_page_column_padding_bottom',
    'padding-right'  => 'betterdocs_doc_page_column_padding_right',
    'padding-left'   => 'betterdocs_doc_page_column_padding_left'
], 'px' ) );

//Grid Category Icon without Layout 4
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper:not(.betterdocs-category-layout-4) .betterdocs-category-grid-wrapper .betterdocs-single-category-wrapper .betterdocs-category-header .betterdocs-category-icon .betterdocs-category-icon-img', $css->properties( [
    'height' => 'betterdocs_doc_page_cat_icon_size_layout1',
], 'px' ) );

//Box Category Icon without Layout 4
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-2 .betterdocs-category-box-wrapper .betterdocs-single-category-wrapper .betterdocs-category-header .betterdocs-category-icon .betterdocs-category-icon-img', $css->properties( [
    'height' => 'betterdocs_doc_page_cat_icon_size_layout2'
], 'px' ) );

// Doc Layout Border Radius For Grid Templates
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper:not(.betterdocs-category-layout-6) .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper > .betterdocs-single-category-wrapper .betterdocs-single-category-inner', $css->properties( [
    'border-top-left-radius'     => 'betterdocs_doc_page_column_borderr_topleft',
    'border-top-right-radius'    => 'betterdocs_doc_page_column_borderr_topright',
    'border-bottom-right-radius' => 'betterdocs_doc_page_column_borderr_bottomright',
    'border-bottom-left-radius'  => 'betterdocs_doc_page_column_borderr_bottomleft'
], 'px' ) );

// Doc Layout Border Radius For Box Templates
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper:not(.betterdocs-category-layout-6) .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper > .betterdocs-single-category-wrapper', $css->properties( [
    'border-top-left-radius'     => 'betterdocs_doc_page_column_borderr_topleft',
    'border-top-right-radius'    => 'betterdocs_doc_page_column_borderr_topright',
    'border-bottom-right-radius' => 'betterdocs_doc_page_column_borderr_bottomright',
    'border-bottom-left-radius'  => 'betterdocs_doc_page_column_borderr_bottomleft'
], 'px' ) );

// Doc Layout Border Radius For Grid Template Body and Footer
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper:not(.betterdocs-category-layout-6) .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper > .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body:last-child,.betterdocs-wrapper.betterdocs-docs-archive-wrapper:not(.betterdocs-category-layout-6) .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper > .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-footer:last-child', $css->properties( [
    'border-bottom-right-radius' => 'betterdocs_doc_page_column_borderr_bottomright',
    'border-bottom-left-radius'  => 'betterdocs_doc_page_column_borderr_bottomleft'
], 'px' ) );

//Doc Category Title Font Size for Layout 1, 2, 3, 5
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper:not(.betterdocs-category-layout-4):not(.betterdocs-category-layout-6) .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-title:not(a)', $css->properties( [
    'font-size' => 'betterdocs_doc_page_cat_title_font_size'
], 'px' ) );

//Doc Category Title Font Size for Layout 1, 2, 3, 5
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper:not(.betterdocs-category-layout-4):not(.betterdocs-category-layout-6) .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-title a', $css->properties( [
    'font-size' => 'betterdocs_doc_page_cat_title_font_size'
], 'px' ) );

//Doc Box Category Title Font Size for Layout 4
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper > .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-title, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-single-category-inner .betterdocs-category-title a, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper > .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-title:has(a)', $css->properties( [
    'font-size' => 'betterdocs_doc_page_cat_title_font_size'
], 'px' ) );

//DocCategory Title Color For Layout 1
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-title:not(a)', $css->properties( [
    'color' => 'betterdocs_doc_page_cat_title_color'
], '' ) );
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-title a', $css->properties( [
    'color' => 'betterdocs_doc_page_cat_title_color'
], '' ) );

// DocCategory Title Border Color For Layout 1
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-category-grid-inner-wrapper .betterdocs-category-header .betterdocs-category-header-inner', $css->properties( [
    'border-bottom' => '2px solid %betterdocs_doc_page_cat_title_border_color%'
], '' ) );

//DocCategory Title Color For Layout 2, 3, 4, 5, 6 || Layout 6 Specfic selector included because defaults are not working on layout 6
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper:not(.betterdocs-category-layout-1) .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-title, .betterdocs-wrapper.betterdocs-docs-archive-wrapper:not(.betterdocs-category-layout-1) .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-title:has(a), .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-single-category-inner .betterdocs-category-title a, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-6 .betterdocs-category-grid-list-wrapper .betterdocs-category-grid-list-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-title-counts .betterdocs-category-title a', $css->properties( [
    'color' => 'betterdocs_doc_page_cat_title_color2'
], '' ) );

//DocCategory Title Hover Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-title:not(a):hover', $css->properties( [
    'color' => 'betterdocs_doc_page_cat_title_hover_color'
], '' ) );
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-title a:hover, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-6 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header-inner .betterdocs-category-title-counts .betterdocs-category-title a:hover', $css->properties( [
    'color' => 'betterdocs_doc_page_cat_title_hover_color'
], '' ) );

//Doc Box Category Description Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-box-wrapper .betterdocs-category-description', $css->properties( [
    'color' => 'betterdocs_doc_page_cat_desc_color'
] ) );

//Doc Box Category Hover Border Width for Layout 2
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-2 .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper.border-bottom .betterdocs-single-category-wrapper:hover', $css->properties( [
    'border-bottom' => '%betterdocs_doc_page_box_border_bottom_size%px solid transparent'
] ) );

//Doc Box Category Hover Border Color for Layout 2
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-2 .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper.border-bottom .betterdocs-single-category-wrapper:hover', $css->properties( [
    'border-bottom-color' => 'betterdocs_doc_page_box_border_bottom_color'
] ) );

//Doc Layout 1 Category Content Background Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-body,.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-footer', $css->properties( [
    'background-color' => 'betterdocs_doc_page_article_list_bg_color'
] ) );

// Item Count Font Size (Doc Page Layout 1, 2, 3, 4, 5)
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper:not(.betterdocs-category-layout-6) .betterdocs-single-category-wrapper .betterdocs-category-items-counts span', $css->properties( [
    'font-size' => 'betterdocs_doc_page_item_count_font_size'
], 'px' ) );

//Doc Layout 1 Item Count Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper > *:not(.betterdocs-grid-top-row-wrapper) .betterdocs-category-items-counts span', $css->properties( [
    'color' => 'betterdocs_doc_page_item_count_color'
] ) );

//Doc Layout 2,3,4,5 Item Count Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper:not(.betterdocs-category-layout-1):not(.betterdocs-category-layout-6) .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-category-items-counts span', $css->properties( [
    'color' => 'betterdocs_doc_page_item_count_color_layout2'
], '' ) );

//Doc Layout 1 Item Count Background
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper > *:not(.betterdocs-grid-top-row-wrapper) .betterdocs-category-items-counts', $css->properties( [
    'background-color' => 'betterdocs_doc_page_item_count_bg_color'
], '' ) );

//Doc Layout 1 Item Count Inner Circle Background, Border Type, Border Color, Border Width
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper > *:not(.betterdocs-grid-top-row-wrapper) .betterdocs-category-items-counts span', $css->properties( [
    'background-color' => 'betterdocs_doc_page_item_count_inner_bg_color',
    'border-style'     => 'betterdocs_doc_page_item_count_border_type',
    'border-color'     => 'betterdocs_doc_page_item_count_border_color'
], '' ) );

//Doc Layout 1 Item Count Inner Circle Border Width
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper > *:not(.betterdocs-grid-top-row-wrapper) .betterdocs-category-items-counts span', $css->properties( [
    'border-top-width'    => 'betterdocs_doc_page_item_count_inner_border_width_top',
    'border-right-width'  => 'betterdocs_doc_page_item_count_inner_border_width_right',
    'border-bottom-width' => 'betterdocs_doc_page_item_count_inner_border_width_bottom',
    'border-left-width'   => 'betterdocs_doc_page_item_count_inner_border_width_left'
], 'px' ) );

//Doc Layout 1 Item Count Inner Circle Width, Height
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper > *:not(.betterdocs-grid-top-row-wrapper) .betterdocs-category-items-counts span', $css->properties( [
    'width'  => 'betterdocs_doc_page_item_counter_size',
    'height' => 'betterdocs_doc_page_item_counter_size'
], 'px' ) );

//Doc Layout 2 Image Space
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-2 .betterdocs-category-icon', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_page_column_content_space_image'
], 'px' ) );

//Doc Layout 3, 5 Content Space Between Image
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-3 .betterdocs-category-icon, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-5 .betterdocs-category-icon', $css->properties( [
    'margin-right' => 'betterdocs_doc_page_column_content_space_image'
], 'px' ) );

//Doc Layout 4 Content Space Between Image
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4:not(.betterdocs-category-layout-2):not(.betterdocs-mkb-layout-1) .betterdocs-category-box-inner-wrapper .betterdocs-category-icon', $css->properties( [
    'margin-right' => 'betterdocs_doc_page_column_content_space_image'
], 'px' ) );

//Doc Layout 2, 3, 4, 5 Item Title Space
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-category-header .betterdocs-category-title', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_page_column_content_space_title'
], 'px' ) );

//Doc Layout 2, 3, 4, 5 Item Description Space
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-category-header .betterdocs-category-description', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_page_column_content_space_desc'
], 'px' ) );

//Doc Layout 2, 3, 4, 5 Item Counter Space
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper .betterdocs-category-box-wrapper .betterdocs-category-box-inner-wrapper .betterdocs-category-header .betterdocs-category-items-counts', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_page_column_content_space_counter'
], 'px' ) );

//Doc Layout 1 Doc List Background Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list,.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list .betterdocs-nested-category-list', $css->properties( [
    'background-color' => 'betterdocs_doc_page_article_list_button_bg_color'
], '' ) );

//Doc Layout 1 Doc List Padding Top/Right/Bottom/Left
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list,.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li.betterdocs-nested-category-wrapper ul', $css->properties( [
    'padding-top'    => 'betterdocs_doc_page_article_list_padding_top_2',
    'padding-bottom' => 'betterdocs_doc_page_article_list_padding_bottom_2',
    'padding-right'  => 'betterdocs_doc_page_article_list_padding_right_2',
    'padding-left'   => 'betterdocs_doc_page_article_list_padding_left_2'
], 'px' ) );

//Doc Layout 1 Doc List Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li a', $css->properties( [
    'color' => 'betterdocs_doc_page_article_list_color'
] ) );

//Doc Layout 4 Docs List Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li a', $css->properties( [
    'color' => 'betterdocs_doc_page_article_list_color'
] ) );

//Doc Layout 1 Doc List Hover Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li a:hover, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li a.active,', $css->properties( [
    'color' => 'betterdocs_doc_page_article_list_hover_color'
] ) );

//Doc Layout 4 Docs List Hover Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li a:hover, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li a.active', $css->properties( [
    'color' => 'betterdocs_doc_page_article_list_hover_color'
] ) );

//Doc Layout 1 Doc List Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li a', $css->properties( [
    'font-size' => 'betterdocs_doc_page_article_list_font_size'
], 'px' ) );

//Doc Layout 4 Docs List Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li a', $css->properties( [
    'font-size' => 'betterdocs_doc_page_article_list_font_size'
], 'px' ) );

//Doc Layout 1 Doc List Icon Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li svg', $css->properties( [
    'fill' => 'betterdocs_doc_page_list_icon_color'
] ) );

//Doc Layout 1 Doc List Icon Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li svg', $css->properties( [
    'font-size' => 'betterdocs_doc_page_list_icon_font_size',
    'min-width' => 'betterdocs_doc_page_list_icon_font_size'
], 'px' ) );

//Doc Layout 1 Doc List Item Margin
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li:not(.betterdocs-nested-category-wrapper)', $css->properties( [
    'margin-top'    => 'betterdocs_doc_page_article_list_margin_top',
    'margin-right'  => 'betterdocs_doc_page_article_list_margin_right',
    'margin-bottom' => 'betterdocs_doc_page_article_list_margin_bottom',
    'margin-left'   => 'betterdocs_doc_page_article_list_margin_left'
], 'px' ) );

//Doc Layout 1 Doc List Item Margin
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li.betterdocs-nested-category-wrapper', $css->properties( [
    'margin-top' => 'betterdocs_doc_page_article_list_margin_top'
], 'px' ) );

//Doc Layout 1 Doc List Item Margin
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li.betterdocs-nested-category-wrapper .betterdocs-nested-category-title', $css->properties( [
    'margin-left'  => 'betterdocs_doc_page_article_list_margin_top',
    'margin-right' => 'betterdocs_doc_page_article_list_margin_top'
], 'px' ) );

//Doc Layout 4 Docs List Item Margin
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li', $css->properties( [
    'margin-top'    => 'betterdocs_doc_page_article_list_margin_top',
    'margin-right'  => 'betterdocs_doc_page_article_list_margin_right',
    'margin-bottom' => 'betterdocs_doc_page_article_list_margin_bottom',
    'margin-left'   => 'betterdocs_doc_page_article_list_margin_left'
], 'px' ) );

//Doc Layout 1 Doc List Item Padding
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li:not(.betterdocs-nested-category-wrapper)', $css->properties( [
    'padding-top'    => 'betterdocs_doc_page_article_list_padding_top',
    'padding-right'  => 'betterdocs_doc_page_article_list_padding_right',
    'padding-bottom' => 'betterdocs_doc_page_article_list_padding_bottom',
    'padding-left'   => 'betterdocs_doc_page_article_list_padding_left'
], 'px' ) );

//Doc Layout 1 Docs Subcategory Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-title a,.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-list .betterdocs-nested-category-title a', $css->properties( [
    'color' => 'betterdocs_doc_page_article_subcategory_color'
] ) );

//Doc Layout 4 Docs Subcategory Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-title a', $css->properties( [
    'color' => 'betterdocs_doc_page_article_subcategory_color'
] ) );

//Doc Layout 1 Docs Subcategory Hover Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-title a:hover', $css->properties( [
    'color' => 'betterdocs_doc_page_article_subcategory_hover_color'
] ) );

//Doc Layout 4 Docs Subcategory Hover Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-title a:hover', $css->properties( [
    'color' => 'betterdocs_doc_page_article_subcategory_hover_color'
] ) );

//Doc Layout 1 Docs Subcategory Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-title a', $css->properties( [
    'font-size' => 'betterdocs_doc_page_article_subcategory_font_size'
], 'px' ) );

//Doc Layout 4 Docs Subcategory Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-title a', $css->properties( [
    'font-size' => 'betterdocs_doc_page_article_subcategory_font_size'
], 'px' ) );

//Doc Layout 1 Subcategory Icon Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-title svg', $css->properties( [
    'fill' => 'betterdocs_doc_page_subcategory_icon_color'
] ) );

//Doc Layout 4 Subcategory Icon Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-title svg,.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-list .betterdocs-nested-category-title svg', $css->properties( [
    'fill' => 'betterdocs_doc_page_subcategory_icon_color'
] ) );

//Doc Layout 1 Subcategory Icon Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-title svg', $css->properties( [
    'font-size' => 'betterdocs_doc_page_subcategory_icon_font_size'
], 'px' ) );

//Doc Layout 4 Subcategory Icon Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-title svg', $css->properties( [
    'font-size' => 'betterdocs_doc_page_subcategory_icon_font_size'
], 'px' ) );

//Doc Layout 1 Subcategory Docs List Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-list li a', $css->properties( [
    'color' => 'betterdocs_doc_page_subcategory_article_list_color'
] ) );

//Doc Layout 4 Subcategory Docs List Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-list li a', $css->properties( [
    'color' => 'betterdocs_doc_page_subcategory_article_list_color'
] ) );

//Doc Layout 1 Subcategory List Hover Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-list li a:hover', $css->properties( [
    'color' => 'betterdocs_doc_page_subcategory_article_list_hover_color'
] ) );

//Doc Layout 4 Subcategory List Hover Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-list li a:hover', $css->properties( [
    'color' => 'betterdocs_doc_page_subcategory_article_list_hover_color'
] ) );

//Doc Layout 1 Subcategory List Icon Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-list li svg', $css->properties( [
    'fill' => 'betterdocs_doc_page_subcategory_article_list_icon_color'
] ) );

//Doc Layout 4 Subcategory List Icon Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-body .betterdocs-articles-list li .betterdocs-nested-category-list li svg', $css->properties( [
    'fill' => 'betterdocs_doc_page_subcategory_article_list_icon_color'
] ) );

//Doc Layout 1 Explore Button BackColor/Color/Border-Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-footer button, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-footer a', $css->properties( [
    'background-color' => 'betterdocs_doc_page_explore_btn_bg_color',
    'color'            => 'betterdocs_doc_page_explore_btn_color',
    'border-color'     => 'betterdocs_doc_page_explore_btn_border_color'
], '' ) );

//Doc Layout 4 Explore Button BackColor/Color/Border-Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-footer button, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-footer a', $css->properties( [
    'background-color' => 'betterdocs_doc_page_explore_btn_bg_color',
    'color'            => 'betterdocs_doc_page_explore_btn_color',
    'border-color'     => 'betterdocs_doc_page_explore_btn_border_color'
] ) );

//Doc Layout 1 Explore Button Hover BackColor/Color/Border-Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-footer button:hover, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-footer a:hover', $css->properties( [
    'background-color' => 'betterdocs_doc_page_explore_btn_hover_bg_color',
    'color'            => 'betterdocs_doc_page_explore_btn_hover_color',
    'border-color'     => 'betterdocs_doc_page_explore_btn_hover_border_color'
], '' ) );

//Doc Layout 4 Explore Button Hover BackColor/Color/Border-Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-footer button:hover, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-footer a:hover', $css->properties( [
    'background-color' => 'betterdocs_doc_page_explore_btn_hover_bg_color',
    'color'            => 'betterdocs_doc_page_explore_btn_hover_color',
    'border-color'     => 'betterdocs_doc_page_explore_btn_hover_border_color'
] ) );

//Doc Layout 1 Explore Button Font Size || Border Width || Padding || Margin || Border Radius
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-footer button, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-footer a', $css->properties( [
    'font-size'                  => 'betterdocs_doc_page_explore_btn_font_size',
    'border-width'               => 'betterdocs_doc_page_explore_btn_border_width',
    'padding-top'                => 'betterdocs_doc_page_explore_btn_padding_top',
    'padding-right'              => 'betterdocs_doc_page_explore_btn_padding_right',
    'padding-bottom'             => 'betterdocs_doc_page_explore_btn_padding_bottom',
    'padding-left'               => 'betterdocs_doc_page_explore_btn_padding_left',
    'margin-top'                 => 'betterdocs_doc_page_explore_btn_margin_top',
    'margin-right'               => 'betterdocs_doc_page_explore_btn_margin_right',
    'margin-bottom'              => 'betterdocs_doc_page_explore_btn_margin_bottom',
    'margin-left'                => 'betterdocs_doc_page_explore_btn_margin_left',
    'border-top-left-radius'     => 'betterdocs_doc_page_explore_btn_borderr_topleft',
    'border-top-right-radius'    => 'betterdocs_doc_page_explore_btn_borderr_topright',
    'border-bottom-right-radius' => 'betterdocs_doc_page_explore_btn_borderr_bottomright',
    'border-bottom-left-radius'  => 'betterdocs_doc_page_explore_btn_borderr_bottomleft'
], 'px' ) );

//Doc Layout 4 Explore Button Font Size || Border Width || Padding || Margin || Border Radius
$css->add_rule( '.betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-footer button, .betterdocs-wrapper.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-footer a', $css->properties( [
    'font-size'                  => 'betterdocs_doc_page_explore_btn_font_size',
    'border-width'               => 'betterdocs_doc_page_explore_btn_border_width',
    'padding-top'                => 'betterdocs_doc_page_explore_btn_padding_top',
    'padding-right'              => 'betterdocs_doc_page_explore_btn_padding_right',
    'padding-bottom'             => 'betterdocs_doc_page_explore_btn_padding_bottom',
    'padding-left'               => 'betterdocs_doc_page_explore_btn_padding_left',
    'margin-top'                 => 'betterdocs_doc_page_explore_btn_margin_top',
    'margin-right'               => 'betterdocs_doc_page_explore_btn_margin_right',
    'margin-bottom'              => 'betterdocs_doc_page_explore_btn_margin_bottom',
    'margin-left'                => 'betterdocs_doc_page_explore_btn_margin_left',
    'border-top-left-radius'     => 'betterdocs_doc_page_explore_btn_borderr_topleft',
    'border-top-right-radius'    => 'betterdocs_doc_page_explore_btn_borderr_topright',
    'border-bottom-right-radius' => 'betterdocs_doc_page_explore_btn_borderr_bottomright',
    'border-bottom-left-radius'  => 'betterdocs_doc_page_explore_btn_borderr_bottomleft'
], 'px' ) );

//Doc Layout 1 Doc List Color Hover
$css->add_rule( '.betterdocs-docs-archive-wrapper.betterdocs-category-layout-1 .betterdocs-content-wrapper .betterdocs-body .betterdocs-articles-list li a:hover', $css->properties( [
    'color' => 'betterdocs_doc_page_article_list_hover_color'
] ) );

/** Single Doc Start **/

//Single Doc Common Controllers Content Area Background Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-single-wrapper .betterdocs-content-wrapper', $css->properties( [
    'background-color' => 'betterdocs_doc_single_content_area_bg_color'
] ) );
//Single Doc Common Controllers Content Area Background Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-content-full', $css->properties( [
    'background-color' => 'betterdocs_doc_single_content_area_bg_color'
] ) );

//Single Doc Common Controllers Background Image, Background Property Attachment | Size | Repeat | Position
$css->add_rule( '.betterdocs-wrapper.betterdocs-single-wrapper .betterdocs-content-wrapper', $css->properties( [
    'background-image' => [
        'id'         => 'betterdocs_doc_single_content_area_bg_image',
        'properties' => [
            'background-size'       => 'betterdocs_doc_single_content_bg_property_size',
            'background-repeat'     => 'betterdocs_doc_single_content_bg_property_repeat',
            'background-attachment' => 'betterdocs_doc_single_content_bg_property_attachment',
            'background-position'   => 'betterdocs_doc_single_content_bg_property_position'
        ]
    ]
] ) );

//Single Doc Common Controllers Background Image, Background Property Attachment | Size | Repeat | Position
$css->add_rule( '.betterdocs-wrapper.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-content-full', $css->properties( [
    'background-image' => [
        'id'         => 'betterdocs_doc_single_content_area_bg_image',
        'properties' => [
            'background-size'       => 'betterdocs_doc_single_content_bg_property_size',
            'background-repeat'     => 'betterdocs_doc_single_content_bg_property_repeat',
            'background-attachment' => 'betterdocs_doc_single_content_bg_property_attachment',
            'background-position'   => 'betterdocs_doc_single_content_bg_property_position'
        ]
    ]
] ) );

//Single Doc Common Controllers Content Area Padding Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-wrapper.betterdocs-single-wrapper .betterdocs-content-wrapper', $css->properties( [
    'padding-top'    => 'betterdocs_doc_single_content_area_padding_top',
    'padding-right'  => 'betterdocs_doc_single_content_area_padding_right',
    'padding-bottom' => 'betterdocs_doc_single_content_area_padding_bottom',
    'padding-left'   => 'betterdocs_doc_single_content_area_padding_left'
], 'px' ) );

//Single Doc Common Controllers Content Area Padding Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-wrapper.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-content-full', $css->properties( [
    'padding-top'    => 'betterdocs_doc_single_content_area_padding_top',
    'padding-bottom' => 'betterdocs_doc_single_content_area_padding_bottom'
], 'px' ) );

//Single Doc Common Controllers Content Area Padding Top | Right | Bottom | Left (Layout-3)
$css->add_rule( '.betterdocs-wrapper.betterdocs-single-wrapper .betterdocs-content-wrapper .betterdocs-content-area .betterdocs-content-inner-area', $css->properties( [
    'padding-top'    => 'betterdocs_doc_single_3_post_content_padding_top',
    'padding-right'  => 'betterdocs_doc_single_3_post_content_padding_right',
    'padding-bottom' => 'betterdocs_doc_single_3_post_content_padding_bottom',
    'padding-left'   => 'betterdocs_doc_single_3_post_content_padding_left'
], 'px' ) );

//Single Doc Common Controllers Content Area Padding Top | Right | Bottom | Left (Layout-3)
$css->add_rule( '.betterdocs-wrapper.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-content-wrapper .betterdocs-content-area .betterdocs-content-inner-area  .betterdocs-breadcrumb', $css->properties( [
    'margin-left' => '-%betterdocs_doc_single_3_post_content_padding_left%'
], 'px' ) );

//Single Doc Common Controllers Doc Content Padding Top | Right | Bottom | Left (Layout-1)
$css->add_rule( '.betterdocs-wrapper.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-content-area', $css->properties( [
    'padding-top'    => 'betterdocs_doc_single_post_content_padding_top',
    'padding-right'  => 'betterdocs_doc_single_post_content_padding_right',
    'padding-bottom' => 'betterdocs_doc_single_post_content_padding_bottom',
    'padding-left'   => 'betterdocs_doc_single_post_content_padding_left'
], 'px' ) );

//Post Content Padding Top | Right | Bottom | Left (Layout-2)(pro)
$css->add_rule( '.betterdocs-wrapper.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-content-inner-area', $css->properties( [
    'padding-top'    => 'betterdocs_doc_single_2_post_content_padding_top',
    'padding-right'  => 'betterdocs_doc_single_2_post_content_padding_right',
    'padding-bottom' => 'betterdocs_doc_single_2_post_content_padding_bottom',
    'padding-left'   => 'betterdocs_doc_single_2_post_content_padding_left'
], 'px' ) );

//Single Doc Text Transform
$css->add_rule( '.betterdocs-single-wrapper .docs-single-title .betterdocs-entry-title', $css->properties( [
    'text-transform' => 'betterdocs_post_title_text_transform'
] ) );

//Single Doc Layout 1 Post Title Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .docs-single-title .betterdocs-entry-title', $css->properties( [
    'font-size' => 'betterdocs_single_doc_title_font_size'
], 'px' ) );

//Single Doc Layout 1 Post Title Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .docs-single-title .betterdocs-entry-title', $css->properties( [
    'color' => 'betterdocs_single_doc_title_color'
] ) );

//Single Doc Layout 1 Breadcrumb Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a, .betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-breadcrumb-item.current span, .betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'font-size' => 'betterdocs_single_doc_breadcrumbs_font_size'
], 'px' ) );

//Archive Page Breadcrumb Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-breadcrumb .betterdocs-breadcrumb-item a, .betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-breadcrumb-item.current span, .betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'font-size' => 'betterdocs_single_doc_breadcrumbs_font_size'
], 'px' ) );

//Single Doc Layout 1 Breadcrumb Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_color'
] ) );

//Archive Page Breadcrumb Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-breadcrumb .betterdocs-breadcrumb-item a', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_color'
] ) );

//Single Doc Layout 1 Breadcrumb Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_hover_color'
] ) );

//Archive Page Breadcrumb Hover Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-breadcrumb .betterdocs-breadcrumb-item a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_hover_color'
] ) );

//Single Doc Layout 1 Breadcrumb Seperator Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_speretor_color'
] ) );

//Archive Page Breadcrumb Seperator Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_speretor_color'
] ) );

//Single Doc Layout 1 Breadcrumb Active Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-breadcrumb-item.current span', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_active_item_color'
] ) );

//Single Doc Sticky TOC Width & Layout 1, 6
$css->add_rule( '.sticky-toc-container', $css->properties( [
    'width' => 'betterdocs_sticky_toc_width'
], 'px' ) );

//Single Doc Sticky TOC z-index & Layout 1, 6
$css->add_rule( '.sticky-toc-container', $css->properties( [
    'z-index' => 'betterdocs_sticky_toc_zindex'
] ) );

//Single Doc Sticky TOC Margin Top & Layout 1, 6
$css->add_rule( '.sticky-toc-container', $css->properties( [
    'margin-top' => 'betterdocs_sticky_toc_margin_top'
], 'px' ) );

//Single Doc Layout 1 TOC Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc', $css->properties( [
    'background-color' => 'betterdocs_toc_bg_color'
] ) );

//Single Doc Layout 1 TOC Content Area Padding Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc', $css->properties( [
    'padding-top' => 'betterdocs_doc_single_toc_padding_top'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc', $css->properties( [
    'padding-right' => 'betterdocs_doc_single_toc_padding_right'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc', $css->properties( [
    'padding-bottom' => 'betterdocs_doc_single_toc_padding_bottom'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc', $css->properties( [
    'padding-left' => 'betterdocs_doc_single_toc_padding_left'
], 'px' ) );

//Single Doc Layout 1 TOC Content Area Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc', $css->properties( [
    'margin-top' => 'betterdocs_doc_single_toc_margin_top'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc', $css->properties( [
    'margin-right' => 'betterdocs_doc_single_toc_margin_right'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_single_toc_margin_bottom'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc', $css->properties( [
    'margin-left' => 'betterdocs_doc_single_toc_margin_left'
], 'px' ) );

//Single Doc Layout 1 TOC Title Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc > .toc-title', $css->properties( [
    'color' => 'betterdocs_toc_title_color'
] ) );

//Single Doc Layout 1 TOC Title Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc > .toc-title', $css->properties( [
    'font-size' => 'betterdocs_toc_title_font_size'
], 'px' ) );

//Single Doc Layout 1 TOC List Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc .toc-list li a', $css->properties( [
    'color' => 'betterdocs_toc_list_item_color'
] ) );

//Single Doc Layout 1 TOC List Item Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc .toc-list li a:hover', $css->properties( [
    'color' => 'betterdocs_toc_list_item_hover_color'
] ) );

//Single Doc Layout 1 TOC Active Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc .toc-list li a.active', $css->properties( [
    'color' => 'betterdocs_toc_active_item_color'
] ) );

//Single Doc Layout 1 TOC List Item Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc .toc-list li a', $css->properties( [
    'font-size' => 'betterdocs_toc_list_item_font_size'
], 'px' ) );

//Single Doc Layout 1 TOC List Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-top' => 'betterdocs_doc_single_toc_list_margin_top'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-right' => 'betterdocs_doc_single_toc_list_margin_right'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_single_toc_list_margin_bottom'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-left' => 'betterdocs_doc_single_toc_list_margin_left'
], 'px' ) );

//Single Doc Layout 1 List Number Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc > .toc-list li a:before', $css->properties( [
    'color' => 'betterdocs_toc_list_number_color'
] ) );

//Single Doc Layout 1 List Number Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-toc > .toc-list li a:before', $css->properties( [
    'font-size' => 'betterdocs_toc_list_number_font_size'
], 'px' ) );

//Single Doc Layout 1 TOC Margin Bottom
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-entry-content .betterdocs-toc', $css->properties( [
    'margin-bottom' => 'betterdocs_toc_margin_bottom'
], 'px' ) );

//Single Doc Layout 1 Entry Content Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-content', $css->properties( [
    'font-size' => 'betterdocs_single_content_font_size'
], 'px' ) );

//Single Doc Layout 1 Entry Content Font Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-content', $css->properties( [
    'color' => 'betterdocs_single_content_font_color'
] ) );

//Single Doc Layout 1 Reactions Text Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-article-reactions .betterdocs-article-reactions-heading h5', $css->properties( [
    'color' => 'betterdocs_post_reactions_text_color'
] ) );

//Single Doc Layout 1 Reactions Icon Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-article-reactions .betterdocs-article-reaction-links li a', $css->properties( [
    'background-color' => 'betterdocs_post_reactions_icon_color'
] ) );

//Single Doc Layout 1 Reactions Icon Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-article-reactions .betterdocs-article-reaction-links li a svg path', $css->properties( [
    'fill' => 'betterdocs_post_reactions_icon_svg_color'
] ) );

//Single Doc Layout 1 Reactions Icon Hover Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-article-reactions .betterdocs-article-reaction-links li a:hover', $css->properties( [
    'background-color' => 'betterdocs_post_reactions_icon_hover_bg_color'
] ) );

//Single Doc Layout 1 Reactions Icon Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-article-reaction-links li a:hover svg path', $css->properties( [
    'fill' => 'betterdocs_post_reactions_icon_hover_svg_color'
] ) );

//Single Doc Layout 1 Social Share Title Text Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-social-share .betterdocs-social-share-heading h5', $css->properties( [
    'color' => 'betterdocs_post_social_share_text_color'
] ) );

//Single Doc Layout 1 Entry Footer Feedback Icon Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .feedback-form-link .feedback-form-icon svg, .betterdocs-single-wrapper.betterdocs-single-layout-1 .feedback-form-link .feedback-form-icon img', $css->properties( [
    'width' => 'betterdocs_single_doc_feedback_icon_font_size'
], 'px' ) );

//Single Doc Layout 1 Entry Footer Feedback Link Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-entry-footer .feedback-form-link', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_link_color'
] ) );

//Single Doc Layout 1 Entry Footer Feedback Link Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-entry-footer .feedback-form-link:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_link_hover_color'
] ) );

//Single Doc Layout 1 Entry Footer Feedback Link Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-entry-footer .feedback-form-link', $css->properties( [
    'font-size' => 'betterdocs_single_doc_feedback_link_font_size'
], 'px' ) );

//Single Doc Layout 1 Entry Footer Feedback Form Title Font Size
$css->add_rule( '#betterdocs-form-modal .modal-inner .modal-content .feedback-form-title', $css->properties( [
    'font-size' => 'betterdocs_single_doc_feedback_title_font_size'
], 'px' ) );

//Single Doc Layout 1 Entry Footer Feedback Form Title Color
$css->add_rule( '#betterdocs-form-modal .modal-inner .modal-content .feedback-form-title', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_title_color'
] ) );

//Single Doc Layout 1 Entry Footer Navigation Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .docs-navigation a', $css->properties( [
    'color' => 'betterdocs_single_doc_navigation_color'
] ) );

//Single Doc Layout 1 Entry Footer Navigation Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .docs-navigation a', $css->properties( [
    'font-size' => 'betterdocs_single_doc_navigation_font_size'
], 'px' ) );

//Single Doc Layout 1 Entry Footer Navigation Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .docs-navigation a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_navigation_hover_color'
] ) );

//Single Doc Layout 1 Entry Footer Navigation Arrow Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .docs-navigation a svg', $css->properties( [
    'fill' => 'betterdocs_single_doc_navigation_arrow_color'
] ) );

//Single Doc Layout 1 Entry Footer Navigation Arrow Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .docs-navigation a svg', $css->properties( [
    'min-width' => 'betterdocs_single_doc_navigation_arrow_font_size',
    'width'     => 'betterdocs_single_doc_navigation_arrow_font_size'
], 'px' ) );

//Single Doc Layout 1 Entry Footer Last Updated Time Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-entry-footer .update-date', $css->properties( [
    'color' => 'betterdocs_single_doc_lu_time_color'
] ) );

//Single Doc Layout 1 Entry Footer Last Updated Time Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-entry-footer .update-date', $css->properties( [
    'font-size' => 'betterdocs_single_doc_lu_time_font_size'
], 'px' ) );

//Single Doc Layout 1 Entry Footer Powered by Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-credit p', $css->properties( [
    'color' => 'betterdocs_single_doc_powered_by_color'
] ) );

//Single Doc Layout 1 Entry Footer Powered By Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-credit p', $css->properties( [
    'font-size' => 'betterdocs_single_doc_powered_by_font_size'
], 'px' ) );

//Single Doc Layout 1 Entry Footer Powered By Link Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-credit p a', $css->properties( [
    'color' => 'betterdocs_single_doc_powered_by_link_color'
] ) );

//Single Doc Layout 4 Post Title Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .docs-single-title .betterdocs-entry-title', $css->properties( [
    'font-size' => 'betterdocs_single_doc_title_font_size'
], 'px' ) );

//Single Doc Layout 4 Post Title Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .docs-single-title .betterdocs-entry-title', $css->properties( [
    'color' => 'betterdocs_single_doc_title_color'
] ) );

//Single Doc Layout 4 Breadcrumb Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a, .betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-breadcrumb-item.current span, .betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'font-size' => 'betterdocs_single_doc_breadcrumbs_font_size'
], 'px' ) );

//Single Doc Layout 4 Breadcrumb Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_color'
] ) );

//Single Doc Layout 4 Breadcrumb Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_hover_color'
] ) );

//Single Doc Layout 4 Breadcrumb Seperator Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_speretor_color'
] ) );

//Single Doc Layout 4 Breadcrumb Active Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-breadcrumb-item.current span', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_active_item_color'
] ) );

//Single Doc Layout 4 TOC Sticky TOC Width
$css->add_rule( '', $css->properties( [
    '' => ''
] ) );

//Single Doc Layout 4 TOC Sticky Toc Z-Index
$css->add_rule( '', $css->properties( [
    '' => ''
] ) );

//Single Doc Layout 4 TOC Sticky Toc Margin Top
$css->add_rule( '', $css->properties( [
    '' => ''
] ) );

//Single Doc Layout 4 TOC Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc', $css->properties( [
    'background-color' => 'betterdocs_toc_bg_color'
] ) );

//Single Doc Layout 4 TOC Content Area Padding Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc', $css->properties( [
    'padding-top' => 'betterdocs_doc_single_toc_padding_top'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc', $css->properties( [
    'padding-right' => 'betterdocs_doc_single_toc_padding_right'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc', $css->properties( [
    'padding-bottom' => 'betterdocs_doc_single_toc_padding_bottom'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc', $css->properties( [
    'padding-left' => 'betterdocs_doc_single_toc_padding_left'
], 'px' ) );

//Single Doc Layout 4 TOC Content Area Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc', $css->properties( [
    'margin-top' => 'betterdocs_doc_single_toc_margin_top'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc', $css->properties( [
    'margin-right' => 'betterdocs_doc_single_toc_margin_right'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_single_toc_margin_bottom'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc', $css->properties( [
    'margin-left' => 'betterdocs_doc_single_toc_margin_left'
] ) );

//Single Doc Layout 4 TOC Title Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc > .toc-title', $css->properties( [
    'color' => 'betterdocs_toc_title_color'
] ) );

//Single Doc Layout 4 TOC Title Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc > .toc-title', $css->properties( [
    'font-size' => 'betterdocs_toc_title_font_size'
], 'px' ) );

//Single Doc Layout 4 TOC List Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc .toc-list li a', $css->properties( [
    'color' => 'betterdocs_toc_list_item_color'
] ) );

//Single Doc Layout 4 TOC List Item Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc .toc-list li a:hover', $css->properties( [
    'color' => 'betterdocs_toc_list_item_hover_color'
] ) );

//Single Doc Layout 4 TOC Active Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc .toc-list li a.active', $css->properties( [
    'color' => 'betterdocs_toc_active_item_color'
] ) );

//Single Doc Layout 4 TOC List Item Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc .toc-list li a', $css->properties( [
    'font-size' => 'betterdocs_toc_list_item_font_size'
], 'px' ) );

//Single Doc Layout 4 TOC List Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-top' => 'betterdocs_doc_single_toc_list_margin_top'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-right' => 'betterdocs_doc_single_toc_list_margin_right'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_single_toc_list_margin_bottom'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-left' => 'betterdocs_doc_single_toc_list_margin_left'
], 'px' ) );

//Single Doc Layout 4 List Number Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc > .toc-list li a:before', $css->properties( [
    'color' => 'betterdocs_toc_list_number_color'
] ) );

//Single Doc Layout 4 List Number Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-toc > .toc-list li a:before', $css->properties( [
    'font-size' => 'betterdocs_toc_list_number_font_size'
], 'px' ) );

//Single Doc Layout 4 TOC Margin Bottom
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-entry-content .betterdocs-toc', $css->properties( [
    'margin-bottom' => 'betterdocs_toc_margin_bottom'
], 'px' ) );

//Single Doc Layout 4 Entry Content Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-content', $css->properties( [
    'font-size' => 'betterdocs_single_content_font_size'
], 'px' ) );

//Single Doc Layout 4 Entry Content Font Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-content', $css->properties( [
    'color' => 'betterdocs_single_content_font_color'
] ) );

//Single Doc Layout 4 Reactions Text Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-article-reactions .betterdocs-article-reactions-heading h5', $css->properties( [
    'color' => 'betterdocs_post_reactions_text_color'
] ) );

//Single Doc Layout 4 Reactions Icon Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-article-reactions .betterdocs-article-reaction-links li a', $css->properties( [
    'background-color' => 'betterdocs_post_reactions_icon_color'
] ) );

//Single Doc Layout 4 Reactions Icon Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-article-reactions .betterdocs-article-reaction-links li a svg path', $css->properties( [
    'fill' => 'betterdocs_post_reactions_icon_svg_color'
] ) );

//Single Doc Layout 4 Reactions Icon Hover Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-article-reactions .betterdocs-article-reaction-links li a:hover', $css->properties( [
    'background-color' => 'betterdocs_post_reactions_icon_hover_bg_color'
] ) );

//Single Doc Layout 4 Reactions Icon Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-article-reaction-links li a:hover svg path', $css->properties( [
    'fill' => 'betterdocs_post_reactions_icon_hover_svg_color'
] ) );

//Single Doc Layout 4 Social Share Title Text Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-social-share .betterdocs-social-share-heading h5', $css->properties( [
    'color' => 'betterdocs_post_social_share_text_color'
] ) );

//Single Doc Layout 4 Entry Footer Feedback Icon Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .feedback-form-link .feedback-form-icon svg, .betterdocs-single-wrapper.betterdocs-single-layout-4 .feedback-form-link .feedback-form-icon img', $css->properties( [
    'width' => 'betterdocs_single_doc_feedback_icon_font_size'
], 'px' ) );

//Single Doc Layout 4 Entry Footer Feedback Link Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-entry-footer .feedback-form-link', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_link_color'
] ) );

//Single Doc Layout 4 Entry Footer Feedback Link Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-entry-footer .feedback-form-link:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_link_hover_color'
] ) );

//Single Doc Layout 4 Entry Footer Feedback Link Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-entry-footer .feedback-form-link', $css->properties( [
    'font-size' => 'betterdocs_single_doc_feedback_link_font_size'
], 'px' ) );

//Single Doc Layout 4 Entry Footer Feedback Form Title Font Size
$css->add_rule( '#betterdocs-form-modal .modal-inner .modal-content .feedback-form-title', $css->properties( [
    'font-size' => 'betterdocs_single_doc_feedback_title_font_size'
], 'px' ) );

//Single Doc Layout 4 Entry Footer Feedback Form Title Color
$css->add_rule( '#betterdocs-form-modal .modal-inner .modal-content .feedback-form-title', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_title_color'
] ) );

//Single Doc Layout 4 Entry Footer Navigation Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .docs-navigation a', $css->properties( [
    'color' => 'betterdocs_single_doc_navigation_color'
] ) );

//Single Doc Layout 4 Entry Footer Navigation Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .docs-navigation a', $css->properties( [
    'font-size' => 'betterdocs_single_doc_navigation_font_size'
], 'px' ) );

//Single Doc Layout 4 Entry Footer Navigation Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .docs-navigation a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_navigation_hover_color'
] ) );

//Single Doc Layout 4 Entry Footer Navigation Arrow Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .docs-navigation a svg', $css->properties( [
    'fill' => 'betterdocs_single_doc_navigation_arrow_color'
] ) );

//Single Doc Layout 4 Entry Footer Navigation Arrow Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .docs-navigation a svg', $css->properties( [
    'min-width' => 'betterdocs_single_doc_navigation_arrow_font_size',
    'width'     => 'betterdocs_single_doc_navigation_arrow_font_size'
], 'px' ) );

//Single Doc Layout 4 Entry Footer Last Updated Time Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-entry-footer .update-date', $css->properties( [
    'color' => 'betterdocs_single_doc_lu_time_color'
] ) );

//Single Doc Layout 4 Entry Footer Last Updated Time Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-entry-footer .update-date', $css->properties( [
    'font-size' => 'betterdocs_single_doc_lu_time_font_size'
], 'px' ) );

//Single Doc Layout 4 Entry Footer Powered by Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-credit p', $css->properties( [
    'color' => 'betterdocs_single_doc_powered_by_color'
] ) );

//Single Doc Layout 4 Entry Footer Powered By Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-credit p', $css->properties( [
    'font-size' => 'betterdocs_single_doc_powered_by_font_size'
], 'px' ) );

//Single Doc Layout 4 Entry Footer Powered By Link Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-credit p a', $css->properties( [
    'color' => 'betterdocs_single_doc_powered_by_link_color'
] ) );

//Single Doc Layout 5 Post Title Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .docs-single-title .betterdocs-entry-title', $css->properties( [
    'font-size' => 'betterdocs_single_doc_title_font_size'
], 'px' ) );

//Single Doc Layout 5 Post Title Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .docs-single-title .betterdocs-entry-title', $css->properties( [
    'color' => 'betterdocs_single_doc_title_color'
] ) );

//Single Doc Layout 5 Breadcrumb Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a, .betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-breadcrumb-item.current span, .betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'font-size' => 'betterdocs_single_doc_breadcrumbs_font_size'
], 'px' ) );

//Single Doc Layout 5 Breadcrumb Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_color'
] ) );

//Single Doc Layout 5 Breadcrumb Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_hover_color'
] ) );

//Single Doc Layout 5 Breadcrumb Seperator Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_speretor_color'
] ) );

//Single Doc Layout 5 Breadcrumb Active Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-breadcrumb-item.current span', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_active_item_color'
] ) );

//Single Doc Layout 5 TOC Content Area Padding Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc', $css->properties( [
    'padding-top' => 'betterdocs_doc_single_toc_padding_top'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc', $css->properties( [
    'padding-right' => 'betterdocs_doc_single_toc_padding_right'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc', $css->properties( [
    'padding-bottom' => 'betterdocs_doc_single_toc_padding_bottom'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc', $css->properties( [
    'padding-left' => 'betterdocs_doc_single_toc_padding_left'
] ) );

//Single Doc Layout 5 TOC Content Area Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc', $css->properties( [
    'margin-top' => 'betterdocs_doc_single_toc_margin_top'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc', $css->properties( [
    'margin-right' => 'betterdocs_doc_single_toc_margin_right'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_single_toc_margin_bottom'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc', $css->properties( [
    'margin-left' => 'betterdocs_doc_single_toc_margin_left'
] ) );

//Single Doc Layout 5 TOC Title Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc > .toc-title', $css->properties( [
    'color' => 'betterdocs_toc_title_color'
] ) );

//Single Doc Layout 5 TOC Title Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc > .toc-title', $css->properties( [
    'font-size' => 'betterdocs_toc_title_font_size'
], 'px' ) );

//Single Doc Layout 5 TOC List Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc .toc-list li a', $css->properties( [
    'color' => 'betterdocs_toc_list_item_color'
] ) );

//Single Doc Layout 5 TOC Active Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc .toc-list li a.active', $css->properties( [
    'color' => 'betterdocs_toc_active_item_color'
] ) );

//Single Doc Layout 5 TOC List Item Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc .toc-list li a', $css->properties( [
    'font-size' => 'betterdocs_toc_list_item_font_size'
], 'px' ) );

//Single Doc Layout 5 TOC List Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-top' => 'betterdocs_doc_single_toc_list_margin_top'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-right' => 'betterdocs_doc_single_toc_list_margin_right'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_single_toc_list_margin_bottom'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-left' => 'betterdocs_doc_single_toc_list_margin_left'
], 'px' ) );

//Single Doc Layout 5 List Number Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc > .toc-list li a:before', $css->properties( [
    'color' => 'betterdocs_toc_list_number_color'
] ) );

//Single Doc Layout 5 List Number Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-toc > .toc-list li a:before', $css->properties( [
    'font-size' => 'betterdocs_toc_list_number_font_size'
], 'px' ) );

//Single Doc Layout 5 TOC Margin Bottom
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-entry-content .betterdocs-toc', $css->properties( [
    'margin-bottom' => 'betterdocs_toc_margin_bottom'
], 'px' ) );

//Single Doc Layout 5 Entry Content Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-content', $css->properties( [
    'font-size' => 'betterdocs_single_content_font_size'
], 'px' ) );

//Single Doc Layout 5 Entry Content Font Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-content', $css->properties( [
    'color' => 'betterdocs_single_content_font_color'
] ) );

//Single Doc Layout 5 Reactions Text Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-article-reactions .betterdocs-article-reactions-heading h5', $css->properties( [
    'color' => 'betterdocs_post_reactions_text_color'
] ) );

//Single Doc Layout 5 Reactions Icon Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-article-reactions .betterdocs-article-reaction-links li a', $css->properties( [
    'background-color' => 'betterdocs_post_reactions_icon_color'
] ) );

//Single Doc Layout 5 Reactions Icon Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-article-reactions .betterdocs-article-reaction-links li a svg path', $css->properties( [
    'fill' => 'betterdocs_post_reactions_icon_svg_color'
] ) );

//Single Doc Layout 5 Reactions Icon Hover Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-article-reactions .betterdocs-article-reaction-links li a:hover', $css->properties( [
    'background-color' => 'betterdocs_post_reactions_icon_hover_bg_color'
] ) );

//Single Doc Layout 5 Reactions Icon Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-article-reaction-links li a:hover svg path', $css->properties( [
    'fill' => 'betterdocs_post_reactions_icon_hover_svg_color'
] ) );

//Single Doc Layout 5 Social Share Title Text Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-social-share .betterdocs-social-share-heading h5', $css->properties( [
    'color' => 'betterdocs_post_social_share_text_color'
] ) );

//Single Doc Layout 5 Entry Footer Feedback Icon Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .feedback-form-link .feedback-form-icon svg, .betterdocs-single-wrapper.betterdocs-single-layout-5 .feedback-form-link .feedback-form-icon img', $css->properties( [
    'width' => 'betterdocs_single_doc_feedback_icon_font_size'
], 'px' ) );

//Single Doc Layout 5 Entry Footer Feedback Link Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-entry-footer .feedback-form-link', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_link_color'
] ) );

//Single Doc Layout 5 Entry Footer Feedback Link Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-entry-footer .feedback-form-link:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_link_hover_color'
] ) );

//Single Doc Layout 5 Entry Footer Feedback Link Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-entry-footer .feedback-form-link', $css->properties( [
    'font-size' => 'betterdocs_single_doc_feedback_link_font_size'
], 'px' ) );

//Single Doc Layout 5 Entry Footer Feedback Form Title Font Size
$css->add_rule( '#betterdocs-form-modal .modal-inner .modal-content .feedback-form-title', $css->properties( [
    'font-size' => 'betterdocs_single_doc_feedback_title_font_size'
], 'px' ) );

//Single Doc Layout 5 Entry Footer Feedback Form Title Color
$css->add_rule( '#betterdocs-form-modal .modal-inner .modal-content .feedback-form-title', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_title_color'
] ) );

//Single Doc Layout 5 Entry Footer Navigation Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .docs-navigation a', $css->properties( [
    'color' => 'betterdocs_single_doc_navigation_color'
] ) );

//Single Doc Layout 5 Entry Footer Navigation Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .docs-navigation a', $css->properties( [
    'font-size' => 'betterdocs_single_doc_navigation_font_size'
], 'px' ) );

//Single Doc Layout 5 Entry Footer Navigation Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .docs-navigation a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_navigation_hover_color'
] ) );

//Single Doc Layout 5 Entry Footer Navigation Arrow Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .docs-navigation a svg', $css->properties( [
    'fill' => 'betterdocs_single_doc_navigation_arrow_color'
] ) );

//Single Doc Layout 5 Entry Footer Navigation Arrow Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .docs-navigation a svg', $css->properties( [
    'min-width' => 'betterdocs_single_doc_navigation_arrow_font_size',
    'width'     => 'betterdocs_single_doc_navigation_arrow_font_size'
], 'px' ) );

//Single Doc Layout 5 Entry Footer Last Updated Time Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-entry-footer .update-date', $css->properties( [
    'color' => 'betterdocs_single_doc_lu_time_color'
] ) );

//Single Doc Layout 5 Entry Footer Last Updated Time Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-entry-footer .update-date', $css->properties( [
    'font-size' => 'betterdocs_single_doc_lu_time_font_size'
], 'px' ) );

//Single Doc Layout 5 Entry Footer Powered by Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-credit p', $css->properties( [
    'color' => 'betterdocs_single_doc_powered_by_color'
] ) );

//Single Doc Layout 5 Entry Footer Powered By Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-credit p', $css->properties( [
    'font-size' => 'betterdocs_single_doc_powered_by_font_size'
], 'px' ) );

//Single Doc Layout 5 Entry Footer Powered By Link Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-credit p a', $css->properties( [
    'color' => 'betterdocs_single_doc_powered_by_link_color'
] ) );

//Single Doc Layout 2 Post Title Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .docs-single-title .betterdocs-entry-title', $css->properties( [
    'font-size' => 'betterdocs_single_doc_title_font_size'
], 'px' ) );

//Single Doc Layout 2 Post Title Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .docs-single-title .betterdocs-entry-title', $css->properties( [
    'color' => 'betterdocs_single_doc_title_color'
] ) );

//Single Doc Layout 2 Breadcrumb Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a, .betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-breadcrumb-item.current span, .betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'font-size' => 'betterdocs_single_doc_breadcrumbs_font_size'
], 'px' ) );

//Single Doc Layout 2 Breadcrumb Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_color'
] ) );

//Single Doc Layout 2 Breadcrumb Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_hover_color'
] ) );

//Single Doc Layout 2 Breadcrumb Seperator Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_speretor_color'
] ) );

//Single Doc Layout 2 Breadcrumb Active Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-breadcrumb-item.current span', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_active_item_color'
] ) );

//Single Doc Layout 2 TOC Content Area Padding Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc', $css->properties( [
    'padding-top' => 'betterdocs_doc_single_toc_padding_top'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc', $css->properties( [
    'padding-right' => 'betterdocs_doc_single_toc_padding_right'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc', $css->properties( [
    'padding-bottom' => 'betterdocs_doc_single_toc_padding_bottom'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc', $css->properties( [
    'padding-left' => 'betterdocs_doc_single_toc_padding_left'
] ) );

//Single Doc Layout 4 TOC Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc', $css->properties( [
    'background-color' => 'betterdocs_toc_bg_color'
] ) );

//Single Doc Layout 2 TOC Content Area Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc', $css->properties( [
    'margin-top' => 'betterdocs_doc_single_toc_margin_top'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc', $css->properties( [
    'margin-right' => 'betterdocs_doc_single_toc_margin_right'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_single_toc_margin_bottom'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc', $css->properties( [
    'margin-left' => 'betterdocs_doc_single_toc_margin_left'
] ) );

//Single Doc Layout 2 TOC Title Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc > .toc-title', $css->properties( [
    'color' => 'betterdocs_toc_title_color'
] ) );

//Single Doc Layout 2 TOC Title Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc > .toc-title', $css->properties( [
    'font-size' => 'betterdocs_toc_title_font_size'
], 'px' ) );

//Single Doc Layout 2 TOC List Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc .toc-list li a', $css->properties( [
    'color' => 'betterdocs_toc_list_item_color'
] ) );

//Single Doc Layout 4 TOC List Item Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc .toc-list li a:hover', $css->properties( [
    'color' => 'betterdocs_toc_list_item_hover_color'
] ) );

//Single Doc Layout 2 TOC Active Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc .toc-list li a.active', $css->properties( [
    'color' => 'betterdocs_toc_active_item_color'
] ) );

//Single Doc Layout 2 TOC List Item Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc .toc-list li a', $css->properties( [
    'font-size' => 'betterdocs_toc_list_item_font_size'
], 'px' ) );

//Single Doc Layout 2 TOC List Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-top' => 'betterdocs_doc_single_toc_list_margin_top'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-right' => 'betterdocs_doc_single_toc_list_margin_right'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_single_toc_list_margin_bottom'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-left' => 'betterdocs_doc_single_toc_list_margin_left'
], 'px' ) );

//Single Doc Layout 2 List Number Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc > .toc-list li a:before', $css->properties( [
    'color' => 'betterdocs_toc_list_number_color'
] ) );

//Single Doc Layout 2 List Number Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-toc > .toc-list li a:before', $css->properties( [
    'font-size' => 'betterdocs_toc_list_number_font_size'
], 'px' ) );

//Single Doc Layout 2 TOC Margin Bottom
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-entry-content .betterdocs-toc', $css->properties( [
    'margin-bottom' => 'betterdocs_toc_margin_bottom'
], 'px' ) );

//Single Doc Layout 2 Entry Content Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-content', $css->properties( [
    'font-size' => 'betterdocs_single_content_font_size'
], 'px' ) );

//Single Doc Layout 2 Entry Content Font Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-content', $css->properties( [
    'color' => 'betterdocs_single_content_font_color'
] ) );

//Single Doc Layout 2 Reactions Text Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-article-reactions .betterdocs-article-reactions-heading h5', $css->properties( [
    'color' => 'betterdocs_post_reactions_text_color'
] ) );

//Single Doc Layout 2 Reactions Icon Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-article-reactions .betterdocs-article-reaction-links li a', $css->properties( [
    'background-color' => 'betterdocs_post_reactions_icon_color'
] ) );

//Single Doc Layout 2 Reactions Icon Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-article-reactions .betterdocs-article-reaction-links li a svg path', $css->properties( [
    'fill' => 'betterdocs_post_reactions_icon_svg_color'
] ) );

//Single Doc Layout 2 Reactions Icon Hover Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-article-reactions .betterdocs-article-reaction-links li a:hover', $css->properties( [
    'background-color' => 'betterdocs_post_reactions_icon_hover_bg_color'
] ) );

//Single Doc Layout 2 Reactions Icon Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-article-reaction-links li a:hover svg path', $css->properties( [
    'fill' => 'betterdocs_post_reactions_icon_hover_svg_color'
] ) );

//Single Doc Layout 2 Social Share Title Text Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-social-share .betterdocs-social-share-heading h5', $css->properties( [
    'color' => 'betterdocs_post_social_share_text_color'
] ) );

//Single Doc Layout 2 Entry Footer Feedback Icon Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .feedback-form-link .feedback-form-icon svg, .betterdocs-single-wrapper.betterdocs-single-layout-2 .feedback-form-link .feedback-form-icon img', $css->properties( [
    'width' => 'betterdocs_single_doc_feedback_icon_font_size'
], 'px' ) );

//Single Doc Layout 2 Entry Footer Feedback Link Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-entry-footer .feedback-form-link', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_link_color'
] ) );

//Single Doc Layout 2 Entry Footer Feedback Link Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-entry-footer .feedback-form-link:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_link_hover_color'
] ) );

//Single Doc Layout 2 Entry Footer Feedback Link Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-entry-footer .feedback-form-link', $css->properties( [
    'font-size' => 'betterdocs_single_doc_feedback_link_font_size'
], 'px' ) );

//Single Doc Layout 2 Entry Footer Feedback Form Title Font Size
$css->add_rule( '#betterdocs-form-modal .modal-inner .modal-content .feedback-form-title', $css->properties( [
    'font-size' => 'betterdocs_single_doc_feedback_title_font_size'
], 'px' ) );

//Single Doc Layout 2 Entry Footer Feedback Form Title Color
$css->add_rule( '#betterdocs-form-modal .modal-inner .modal-content .feedback-form-title', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_title_color'
] ) );

//Single Doc Layout 2 Entry Footer Navigation Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .docs-navigation a', $css->properties( [
    'color' => 'betterdocs_single_doc_navigation_color'
] ) );

//Single Doc Layout 2 Entry Footer Navigation Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .docs-navigation a', $css->properties( [
    'font-size' => 'betterdocs_single_doc_navigation_font_size'
], 'px' ) );

//Single Doc Layout 2 Entry Footer Navigation Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .docs-navigation a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_navigation_hover_color'
] ) );

//Single Doc Layout 2 Entry Footer Navigation Arrow Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .docs-navigation a svg', $css->properties( [
    'fill' => 'betterdocs_single_doc_navigation_arrow_color'
] ) );

//Single Doc Layout 2 Entry Footer Navigation Arrow Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .docs-navigation a svg', $css->properties( [
    'min-width' => 'betterdocs_single_doc_navigation_arrow_font_size',
    'width'     => 'betterdocs_single_doc_navigation_arrow_font_size'
], 'px' ) );

//Single Doc Layout 2 Entry Footer Last Updated Time Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-entry-footer .update-date', $css->properties( [
    'color' => 'betterdocs_single_doc_lu_time_color'
] ) );

//Single Doc Layout 2 Entry Footer Last Updated Time Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-entry-footer .update-date', $css->properties( [
    'font-size' => 'betterdocs_single_doc_lu_time_font_size'
], 'px' ) );

//Single Doc Layout 2 Entry Footer Powered by Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-credit p', $css->properties( [
    'color' => 'betterdocs_single_doc_powered_by_color'
] ) );

//Single Doc Layout 2 Entry Footer Powered By Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-credit p', $css->properties( [
    'font-size' => 'betterdocs_single_doc_powered_by_font_size'
], 'px' ) );

//Single Doc Layout 2 Entry Footer Powered By Link Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-credit p a', $css->properties( [
    'color' => 'betterdocs_single_doc_powered_by_link_color'
] ) );

//Single Doc Layout 3 Post Title Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .docs-single-title .betterdocs-entry-title', $css->properties( [
    'font-size' => 'betterdocs_single_doc_title_font_size'
], 'px' ) );

//Single Doc Layout 3 Post Title Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .docs-single-title .betterdocs-entry-title', $css->properties( [
    'color' => 'betterdocs_single_doc_title_color'
] ) );

//Single Doc Layout 3 Breadcrumb Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a, .betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-breadcrumb-item.current span, .betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'font-size' => 'betterdocs_single_doc_breadcrumbs_font_size'
], 'px' ) );

//Single Doc Layout 3 Breadcrumb Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_color'
] ) );

//Single Doc Layout 3 Breadcrumb Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_hover_color'
] ) );

//Single Doc Layout 3 Breadcrumb Seperator Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_speretor_color'
] ) );

//Single Doc Layout 3 Breadcrumb Active Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-breadcrumb-item.current span', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_active_item_color'
] ) );

//Single Doc Layout 3 TOC Content Area Padding Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc', $css->properties( [
    'padding-top' => 'betterdocs_doc_single_toc_padding_top'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc', $css->properties( [
    'padding-right' => 'betterdocs_doc_single_toc_padding_right'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc', $css->properties( [
    'padding-bottom' => 'betterdocs_doc_single_toc_padding_bottom'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc', $css->properties( [
    'padding-left' => 'betterdocs_doc_single_toc_padding_left'
] ) );

//Single Doc Layout 3 TOC Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc', $css->properties( [
    'background-color' => 'betterdocs_toc_bg_color'
] ) );

//Single Doc Layout 3 TOC Content Area Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc', $css->properties( [
    'margin-top' => 'betterdocs_doc_single_toc_margin_top'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc', $css->properties( [
    'margin-right' => 'betterdocs_doc_single_toc_margin_right'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_single_toc_margin_bottom'
] ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc', $css->properties( [
    'margin-left' => 'betterdocs_doc_single_toc_margin_left'
] ) );

//Single Doc Layout 3 TOC Title Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc > .toc-title', $css->properties( [
    'color' => 'betterdocs_toc_title_color'
] ) );

//Single Doc Layout 3 TOC Title Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc > .toc-title', $css->properties( [
    'font-size' => 'betterdocs_toc_title_font_size'
], 'px' ) );

//Single Doc Layout 3 TOC List Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc .toc-list li a', $css->properties( [
    'color' => 'betterdocs_toc_list_item_color'
] ) );

//Single Doc Layout 3 TOC List Item Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc .toc-list li a:hover', $css->properties( [
    'color' => 'betterdocs_toc_list_item_hover_color'
] ) );

//Single Doc Layout 3 TOC Active Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc .toc-list li a.active', $css->properties( [
    'color' => 'betterdocs_toc_active_item_color'
] ) );

//Single Doc Layout 3 TOC List Item Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc .toc-list li a', $css->properties( [
    'font-size' => 'betterdocs_toc_list_item_font_size'
], 'px' ) );

//Single Doc Layout 3 TOC List Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-top' => 'betterdocs_doc_single_toc_list_margin_top'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-right' => 'betterdocs_doc_single_toc_list_margin_right'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_single_toc_list_margin_bottom'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-left' => 'betterdocs_doc_single_toc_list_margin_left'
], 'px' ) );

//Single Doc Layout 3 List Number Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc > .toc-list li a:before', $css->properties( [
    'color' => 'betterdocs_toc_list_number_color'
] ) );

//Single Doc Layout 3 List Number Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-toc > .toc-list li a:before', $css->properties( [
    'font-size' => 'betterdocs_toc_list_number_font_size'
], 'px' ) );

//Single Doc Layout 3 TOC Margin Bottom
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-entry-content .betterdocs-toc', $css->properties( [
    'margin-bottom' => 'betterdocs_toc_margin_bottom'
], 'px' ) );

//Single Doc Layout 3 Entry Content Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-content', $css->properties( [
    'font-size' => 'betterdocs_single_content_font_size'
], 'px' ) );

//Single Doc Layout 3 Entry Content Font Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-content', $css->properties( [
    'color' => 'betterdocs_single_content_font_color'
] ) );

//Single Doc Layout 3 Reactions Text Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-article-reactions .betterdocs-article-reactions-heading h5', $css->properties( [
    'color' => 'betterdocs_post_reactions_text_color'
] ) );

//Single Doc Layout 3 Reactions Icon Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-article-reactions .betterdocs-article-reaction-links li a', $css->properties( [
    'background-color' => 'betterdocs_post_reactions_icon_color'
] ) );

//Single Doc Layout 3 Reactions Icon Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-article-reactions .betterdocs-article-reaction-links li a svg path', $css->properties( [
    'fill' => 'betterdocs_post_reactions_icon_svg_color'
] ) );

//Single Doc Layout 3 Reactions Icon Hover Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-article-reactions .betterdocs-article-reaction-links li a:hover', $css->properties( [
    'background-color' => 'betterdocs_post_reactions_icon_hover_bg_color'
] ) );

//Single Doc Layout 3 Reactions Icon Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-article-reaction-links li a:hover svg path', $css->properties( [
    'fill' => 'betterdocs_post_reactions_icon_hover_svg_color'
] ) );

//Single Doc Layout 3 Social Share Title Text Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-social-share .betterdocs-social-share-heading h5', $css->properties( [
    'color' => 'betterdocs_post_social_share_text_color'
] ) );

//Single Doc Layout 3 Entry Footer Feedback Icon Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .feedback-form-link .feedback-form-icon svg, .betterdocs-single-wrapper.betterdocs-single-layout-3 .feedback-form-link .feedback-form-icon img', $css->properties( [
    'width' => 'betterdocs_single_doc_feedback_icon_font_size'
], 'px' ) );

//Single Doc Layout 3 Entry Footer Feedback Link Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-entry-footer .feedback-form-link', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_link_color'
] ) );

//Single Doc Layout 3 Entry Footer Feedback Link Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-entry-footer .feedback-form-link:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_link_hover_color'
] ) );

//Single Doc Layout 3 Entry Footer Feedback Link Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-entry-footer .feedback-form-link', $css->properties( [
    'font-size' => 'betterdocs_single_doc_feedback_link_font_size'
], 'px' ) );

//Single Doc Layout 3 Entry Footer Feedback Form Title Font Size
$css->add_rule( '#betterdocs-form-modal .modal-inner .modal-content .feedback-form-title', $css->properties( [
    'font-size' => 'betterdocs_single_doc_feedback_title_font_size'
], 'px' ) );

//Single Doc Layout 3 Entry Footer Feedback Form Title Color
$css->add_rule( '#betterdocs-form-modal .modal-inner .modal-content .feedback-form-title', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_title_color'
] ) );

//Single Doc Layout 3 Entry Footer Navigation Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .docs-navigation a', $css->properties( [
    'color' => 'betterdocs_single_doc_navigation_color'
] ) );

//Single Doc Layout 3 Entry Footer Navigation Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .docs-navigation a', $css->properties( [
    'font-size' => 'betterdocs_single_doc_navigation_font_size'
], 'px' ) );

//Single Doc Layout 3 Entry Footer Navigation Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .docs-navigation a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_navigation_hover_color'
] ) );

//Single Doc Layout 3 Entry Footer Navigation Arrow Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .docs-navigation a svg', $css->properties( [
    'fill' => 'betterdocs_single_doc_navigation_arrow_color'
] ) );

//Single Doc Layout 3 Entry Footer Navigation Arrow Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .docs-navigation a svg', $css->properties( [
    'min-width' => 'betterdocs_single_doc_navigation_arrow_font_size',
    'width'     => 'betterdocs_single_doc_navigation_arrow_font_size'
], 'px' ) );

//Single Doc Layout 3 Entry Footer Last Updated Time Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-entry-footer .update-date', $css->properties( [
    'color' => 'betterdocs_single_doc_lu_time_color'
] ) );

//Single Doc Layout 3 Entry Footer Last Updated Time Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-entry-footer .update-date', $css->properties( [
    'font-size' => 'betterdocs_single_doc_lu_time_font_size'
], 'px' ) );

//Single Doc Layout 3 Entry Footer Powered by Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-credit p', $css->properties( [
    'color' => 'betterdocs_single_doc_powered_by_color'
] ) );

//Single Doc Layout 3 Entry Footer Powered By Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-credit p', $css->properties( [
    'font-size' => 'betterdocs_single_doc_powered_by_font_size'
], 'px' ) );

//Single Doc Layout 3 Entry Footer Powered By Link Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-credit p a', $css->properties( [
    'color' => 'betterdocs_single_doc_powered_by_link_color'
] ) );

//Single Doc Layout 6 Post Title Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .docs-single-title .betterdocs-entry-title', $css->properties( [
    'font-size' => 'betterdocs_single_doc_title_font_size'
], 'px' ) );

//Single Doc Layout 6 Post Title Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .docs-single-title .betterdocs-entry-title', $css->properties( [
    'color' => 'betterdocs_single_doc_title_color'
] ) );

//Single Doc Layout 6 Breadcrumb Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a, .betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-breadcrumb-item.current span, .betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'font-size' => 'betterdocs_single_doc_breadcrumbs_font_size'
], 'px' ) );

//Single Doc Layout 6 Breadcrumb Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_color'
] ) );

//Single Doc Layout 6 Breadcrumb Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-breadcrumb .betterdocs-breadcrumb-item a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_hover_color'
] ) );

//Single Doc Layout 6 Breadcrumb Seperator Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-breadcrumb .breadcrumb-delimiter', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_speretor_color'
] ) );

//Single Doc Layout 6 Breadcrumb Active Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-breadcrumb-item.current span', $css->properties( [
    'color' => 'betterdocs_single_doc_breadcrumb_active_item_color'
] ) );

//Single Doc Layout 6 TOC Content Area Padding Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc', $css->properties( [
    'padding-top' => 'betterdocs_doc_single_toc_padding_top'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc', $css->properties( [
    'padding-right' => 'betterdocs_doc_single_toc_padding_right'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc', $css->properties( [
    'padding-bottom' => 'betterdocs_doc_single_toc_padding_bottom'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc', $css->properties( [
    'padding-left' => 'betterdocs_doc_single_toc_padding_left'
], 'px' ) );

//Single Doc Layout 6 TOC Content Area Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc', $css->properties( [
    'margin-top' => 'betterdocs_doc_single_toc_margin_top'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc', $css->properties( [
    'margin-right' => 'betterdocs_doc_single_toc_margin_right'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_single_toc_margin_bottom'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc', $css->properties( [
    'margin-left' => 'betterdocs_doc_single_toc_margin_left'
], 'px' ) );

//Single Doc Layout 6 TOC Title Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc > .toc-title', $css->properties( [
    'color' => 'betterdocs_toc_title_color'
] ) );

//Single Doc Layout 6 TOC Title Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc > .toc-title', $css->properties( [
    'font-size' => 'betterdocs_toc_title_font_size'
], 'px' ) );

//Single Doc Layout 6 TOC List Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc .toc-list li a', $css->properties( [
    'color' => 'betterdocs_toc_list_item_color'
] ) );

//Single Doc Layout 6 TOC Active Item Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc .toc-list li a.active', $css->properties( [
    'color' => 'betterdocs_toc_active_item_color'
] ) );

//Single Doc Layout 6 TOC List Item Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc .toc-list li a', $css->properties( [
    'font-size' => 'betterdocs_toc_list_item_font_size'
], 'px' ) );

//Single Doc Layout 6 TOC List Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-top' => 'betterdocs_doc_single_toc_list_margin_top'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-right' => 'betterdocs_doc_single_toc_list_margin_right'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-bottom' => 'betterdocs_doc_single_toc_list_margin_bottom'
], 'px' ) );

$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc .toc-list li a', $css->properties( [
    'margin-left' => 'betterdocs_doc_single_toc_list_margin_left'
], 'px' ) );

//Single Doc Layout 6 List Number Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc > .toc-list li a:before', $css->properties( [
    'color' => 'betterdocs_toc_list_number_color'
] ) );

//Single Doc Layout 6 List Number Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-toc > .toc-list li a:before', $css->properties( [
    'font-size' => 'betterdocs_toc_list_number_font_size'
], 'px' ) );

//Single Doc Layout 6 TOC Margin Bottom
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-entry-content .betterdocs-toc', $css->properties( [
    'margin-bottom' => 'betterdocs_toc_margin_bottom'
], 'px' ) );

//Single Doc Layout 6 Entry Content Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-content', $css->properties( [
    'font-size' => 'betterdocs_single_content_font_size'
], 'px' ) );

//Single Doc Layout 6 Entry Content Font Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-content', $css->properties( [
    'color' => 'betterdocs_single_content_font_color'
] ) );

//Single Doc Layout 6 Reactions Text Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-article-reactions .betterdocs-article-reactions-heading h5', $css->properties( [
    'color' => 'betterdocs_post_reactions_text_color'
] ) );

//Single Doc Layout 6 Reactions Icon Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-article-reactions .betterdocs-article-reaction-links li a', $css->properties( [
    'background-color' => 'betterdocs_post_reactions_icon_color'
] ) );

//Single Doc Layout 6 Reactions Icon Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-article-reactions .betterdocs-article-reaction-links li a svg path', $css->properties( [
    'fill' => 'betterdocs_post_reactions_icon_svg_color'
] ) );

//Single Doc Layout 6 Reactions Icon Hover Background Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-article-reactions .betterdocs-article-reaction-links li a:hover', $css->properties( [
    'background-color' => 'betterdocs_post_reactions_icon_hover_bg_color'
] ) );

//Single Doc Layout 6 Reactions Icon Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-article-reaction-links li a:hover svg path', $css->properties( [
    'fill' => 'betterdocs_post_reactions_icon_hover_svg_color'
] ) );

//Single Doc Layout 6 Social Share Title Text Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-social-share .betterdocs-social-share-heading h5', $css->properties( [
    'color' => 'betterdocs_post_social_share_text_color'
] ) );

//Single Doc Layout 6 Entry Footer Feedback Icon Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .feedback-form-link .feedback-form-icon svg, .betterdocs-single-wrapper.betterdocs-single-layout-6 .feedback-form-link .feedback-form-icon img', $css->properties( [
    'width' => 'betterdocs_single_doc_feedback_icon_font_size'
], 'px' ) );

//Single Doc Layout 6 Entry Footer Feedback Link Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-entry-footer .feedback-form-link', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_link_color'
] ) );

//Single Doc Layout 6 Entry Footer Feedback Link Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-entry-footer .feedback-form-link:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_link_hover_color'
] ) );

//Single Doc Layout 6 Entry Footer Feedback Link Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-entry-footer .feedback-form-link', $css->properties( [
    'font-size' => 'betterdocs_single_doc_feedback_link_font_size'
], 'px' ) );

//Single Doc Layout 6 Entry Footer Feedback Form Title Font Size
$css->add_rule( '#betterdocs-form-modal .modal-inner .modal-content .feedback-form-title', $css->properties( [
    'font-size' => 'betterdocs_single_doc_feedback_title_font_size'
], 'px' ) );

//Single Doc Layout 6 Entry Footer Feedback Form Title Color
$css->add_rule( '#betterdocs-form-modal .modal-inner .modal-content .feedback-form-title', $css->properties( [
    'color' => 'betterdocs_single_doc_feedback_title_color'
] ) );

//Single Doc Layout 6 Entry Footer Navigation Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .docs-navigation a', $css->properties( [
    'color' => 'betterdocs_single_doc_navigation_color'
] ) );

//Single Doc Layout 6 Entry Footer Navigation Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .docs-navigation a', $css->properties( [
    'font-size' => 'betterdocs_single_doc_navigation_font_size'
], 'px' ) );

//Single Doc Layout 6 Entry Footer Navigation Hover Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .docs-navigation a:hover', $css->properties( [
    'color' => 'betterdocs_single_doc_navigation_hover_color'
] ) );

//Single Doc Layout 6 Entry Footer Navigation Arrow Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .docs-navigation a svg', $css->properties( [
    'fill' => 'betterdocs_single_doc_navigation_arrow_color'
] ) );

//Single Doc Layout 6 Entry Footer Navigation Arrow Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .docs-navigation a svg', $css->properties( [
    'min-width' => 'betterdocs_single_doc_navigation_arrow_font_size',
    'width'     => 'betterdocs_single_doc_navigation_arrow_font_size'
], 'px' ) );

//Single Doc Layout 6 Entry Footer Last Updated Time Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-entry-footer .update-date', $css->properties( [
    'color' => 'betterdocs_single_doc_lu_time_color'
] ) );

//Single Doc Layout 6 Entry Footer Last Updated Time Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-entry-footer .update-date', $css->properties( [
    'font-size' => 'betterdocs_single_doc_lu_time_font_size'
], 'px' ) );

//Single Doc Layout 6 Entry Footer Powered by Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-credit p', $css->properties( [
    'color' => 'betterdocs_single_doc_powered_by_color'
] ) );

//Single Doc Layout 6 Entry Footer Powered By Font Size
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-credit p', $css->properties( [
    'font-size' => 'betterdocs_single_doc_powered_by_font_size'
], 'px' ) );

//Single Doc Layout 6 Entry Footer Powered By Link Color
$css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-6 .betterdocs-credit p a', $css->properties( [
    'color' => 'betterdocs_single_doc_powered_by_link_color'
] ) );

/** Single Doc End **/

/** SideBar Controls Start **/

//Sidebar Background Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content', $css->properties( [
    'background-color' => 'betterdocs_sidebar_bg_color'
] ) );

// //Sidebar Background Color Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_bg_color'
// ] ) );

//Sidebar Padding Top | Right | Bottom | Left Layout 1
$css->add_rule( '.betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
    'padding-top'    => 'betterdocs_sidebar_padding_top',
    'padding-right'  => 'betterdocs_sidebar_padding_right',
    'padding-bottom' => 'betterdocs_sidebar_padding_bottom',
    'padding-left'   => 'betterdocs_sidebar_padding_left'
], 'px' ) );

// //Sidebar Padding Top | Right | Bottom | Left Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
//     'padding-top'    => 'betterdocs_sidebar_padding_top',
//     'padding-right'  => 'betterdocs_sidebar_padding_right',
//     'padding-bottom' => 'betterdocs_sidebar_padding_bottom',
//     'padding-left'   => 'betterdocs_sidebar_padding_left'
// ], 'px' ) );

//Sidebar Border Radius Top Left | Top Right | Bottom Right | Bottom Left Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content', $css->properties( [
    'border-top-left-radius'     => 'betterdocs_sidebar_borderr_topleft',
    'border-top-right-radius'    => 'betterdocs_sidebar_borderr_topright',
    'border-bottom-right-radius' => 'betterdocs_sidebar_borderr_bottomright',
    'border-bottom-left-radius'  => 'betterdocs_sidebar_borderr_bottomleft'
], 'px' ) );

// //Sidebar Border Radius Top Left | Top Right | Bottom Right | Bottom Left Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
//     'border-top-left-radius'     => 'betterdocs_sidebar_borderr_topleft',
//     'border-top-right-radius'    => 'betterdocs_sidebar_borderr_topright',
//     'border-bottom-right-radius' => 'betterdocs_sidebar_borderr_bottomright',
//     'border-bottom-left-radius'  => 'betterdocs_sidebar_borderr_bottomleft'
// ], 'px' ) );

//Sidebar Icon Size Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-icon .betterdocs-category-icon-img', $css->properties( [
    'height' => 'betterdocs_sidebar_icon_size'
], 'px' ) );

// //Sidebar Icon Size Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-category-icon .betterdocs-category-icon-img', $css->properties( [
//     'height' => 'betterdocs_sidebar_icon_size'
// ], 'px' ) );

//Sidebar Title Background Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
    'background-color' => 'betterdocs_sidebar_title_bg_color'
] ) );

// //Sidebar Title Background Color Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_title_bg_color'
// ] ) );

//Sidebar Active Title Background Color | Border Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
    'background-color' => 'betterdocs_sidebar_active_cat_background_color',
    'border-color'     => 'betterdocs_sidebar_active_cat_border_color'
] ) );

// //Sidebar Active Title Background Color | Border Color Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_active_cat_background_color',
//     'border-color'     => 'betterdocs_sidebar_active_cat_border_color'
// ] ) );

//Sidebar Title Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'color' => 'betterdocs_sidebar_title_color'
] ) );

// //Sidebar Title Color Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'color' => 'betterdocs_sidebar_title_color'
// ] ) );

//Sidebar Title Hover Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a):hover', $css->properties( [
    'color' => 'betterdocs_sidebar_title_hover_color'
] ) );

// //Sidebar Title Hover Color Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a:hover', $css->properties( [
//     'color' => 'betterdocs_sidebar_title_hover_color'
// ] ) );

//Sidebar Active Title Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content.betterdocs-category-sidebar .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content.betterdocs-category-sidebar .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'color' => 'betterdocs_sidebar_active_title_color'
] ) );

// //Sidebar Active Title Color Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'color' => 'betterdocs_sidebar_active_title_color'
// ] ) );

//Sidebar Title Hover Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a):hover', $css->properties( [
    'color' => 'betterdocs_sidebar_title_hover_color'
] ) );

// //Sidebar Title Hover Color Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a:hover', $css->properties( [
//     'color' => 'betterdocs_sidebar_title_hover_color'
// ] ) );

//Sidebar Title Font Size Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'font-size' => 'betterdocs_sidebar_title_font_size'
], 'px' ) );

// //Sidebar Title Font Size Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_title_font_size'
// ], 'px' ) );

//Sidebar Title Padding Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
    'padding-top'    => 'betterdocs_sidebar_title_padding_top',
    'padding-right'  => 'betterdocs_sidebar_title_padding_right',
    'padding-bottom' => 'betterdocs_sidebar_title_padding_bottom',
    'padding-left'   => 'betterdocs_sidebar_title_padding_left'
], 'px' ) );

// //Sidebar Title Padding Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'padding-top'    => 'betterdocs_sidebar_title_padding_top',
//     'padding-right'  => 'betterdocs_sidebar_title_padding_right',
//     'padding-bottom' => 'betterdocs_sidebar_title_padding_bottom',
//     'padding-left'   => 'betterdocs_sidebar_title_padding_left'
// ], 'px' ) );

//Sidebar Title Margin Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper', $css->properties( [
    'margin-top'    => 'betterdocs_sidebar_title_margin_top',
    'margin-right'  => 'betterdocs_sidebar_title_margin_right',
    'margin-bottom' => 'betterdocs_sidebar_title_margin_bottom',
    'margin-left'   => 'betterdocs_sidebar_title_margin_left'
], 'px' ) );

// //Sidebar Title Margin Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper', $css->properties( [
//     'margin-top'    => 'betterdocs_sidebar_title_margin_top',
//     'margin-right'  => 'betterdocs_sidebar_title_margin_right',
//     'margin-bottom' => 'betterdocs_sidebar_title_margin_bottom',
//     'margin-left'   => 'betterdocs_sidebar_title_margin_left'
// ], 'px' ) );

// SIDEBAR ITEM COUNTER Background Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts', $css->properties( [
    'background-color' => 'betterdocs_sidbebar_item_count_bg_color'
] ) );

// // SIDEBAR ITEM COUNTER Background Color Layout 1 (Single Doc)
// $css->add_rule( ' .betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts', $css->properties( [
//     'background-color' => 'betterdocs_sidbebar_item_count_bg_color'
// ] ) );

// SIDEBAR ITEM COUNTER Inner Circle Background Color | Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span', $css->properties( [
    'background-color' => 'betterdocs_sidbebar_item_count_inner_bg_color',
    'color'            => 'betterdocs_sidebar_item_count_color'
] ) );

// // SIDEBAR ITEM COUNTER Inner Circle Background Color | Color Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span', $css->properties( [
//     'background-color' => 'betterdocs_sidbebar_item_count_inner_bg_color',
//     'color'            => 'betterdocs_sidebar_item_count_color'
// ] ) );

// SIDEBAR ITEM COUNTER Size (Height | Width) Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span', $css->properties( [
    'height' => 'betterdocs_sidebar_item_counter_size',
    'width'  => 'betterdocs_sidebar_item_counter_size'
], 'px' ) );

// // SIDEBAR ITEM COUNTER Size (Height | Width) Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span', $css->properties( [
//     'height' => 'betterdocs_sidebar_item_counter_size',
//     'width'  => 'betterdocs_sidebar_item_counter_size'
// ] ) );

// SIDEBAR ITEM COUNTER Font Size Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span', $css->properties( [
    'font-size' => 'betterdocs_sidebat_item_count_font_size'
], 'px' ) );

// // SIDEBAR ITEM COUNTER Font Size Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span', $css->properties( [
//     'font-size' => 'betterdocs_sidebat_item_count_font_size'
// ], 'px' ) );

//Sidebar Content Background Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-sidebar-content .betterdocs-body', $css->properties( [
    'background-color' => 'betterdocs_sidbebar_item_list_bg_color'
] ) );

// //Sidebar Content Background Color Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-body', $css->properties( [
//     'background-color' => 'betterdocs_sidbebar_item_list_bg_color'
// ] ) );

//Sidebar Content List Item Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
    'color' => 'betterdocs_sidebar_list_item_color'
] ) );

// //Sidebar Content List Item Color Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
//     'color' => 'betterdocs_sidebar_list_item_color'
// ] ) );

//Sidebar Content List Item Hover Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a:hover', $css->properties( [
    'color' => 'betterdocs_sidebar_list_item_hover_color'
] ) );

// //Sidebar Content List Item Hover Color Layout 1 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a:hover', $css->properties( [
//     'color' => 'betterdocs_sidebar_list_item_hover_color'
// ] ) );

//Sidebar Content List Item Font Size Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
    'font-size' => 'betterdocs_sidebar_list_item_font_size'
], 'px' ) );

// //Sidebar Content List Item Font Size Layout  (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_list_item_font_size'
// ], 'px' ) );

//Sidebar Content List Item Icon Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
    'fill' => 'betterdocs_sidebar_list_icon_color'
] ) );

// //Sidebar Content List Item Icon Color (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
//     'fill' => 'betterdocs_sidebar_list_icon_color'
// ] ) );

//Sidebar Content List Item Icon Font Size Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
    'font-size' => 'betterdocs_sidebar_list_icon_font_size',
    'min-width' => 'betterdocs_sidebar_list_icon_font_size'
], 'px' ) );

// //Sidebar Content List Item Icon Font Size (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_list_icon_font_size'
// ], 'px' ) );

//Sidebar Content List Item Margin Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li', $css->properties( [
    'margin-top'    => 'betterdocs_sidebar_list_item_margin_top',
    'margin-right'  => 'betterdocs_sidebar_list_item_margin_right',
    'margin-bottom' => 'betterdocs_sidebar_list_item_margin_bottom',
    'margin-left'   => 'betterdocs_sidebar_list_item_margin_left'
], 'px' ) );

// //Sidebar Content List Item Margin (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li', $css->properties( [
//     'margin-top'    => 'betterdocs_sidebar_list_item_margin_top',
//     'margin-right'  => 'betterdocs_sidebar_list_item_margin_right',
//     'margin-bottom' => 'betterdocs_sidebar_list_item_margin_bottom',
//     'margin-left'   => 'betterdocs_sidebar_list_item_margin_left'
// ], 'px' ) );

//Sidebar Content Active List Item Color Layout 1
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-1 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a.active', $css->properties( [
    'color' => 'betterdocs_sidebar_active_list_item_color'
] ) );

// //Sidebar Content Active List Item Color (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-1 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a.active', $css->properties( [
//     'color' => 'betterdocs_sidebar_active_list_item_color'
// ] ) );

//Sidebar Background Color Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
    'background-color' => 'betterdocs_sidebar_bg_color'
] ) );

// //Sidebar Background Color Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_bg_color'
// ] ) );

// //Sidebar Padding Top | Right | Bottom | Left Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
//     'padding-top'    => 'betterdocs_sidebar_padding_top',
//     'padding-right'  => 'betterdocs_sidebar_padding_right',
//     'padding-bottom' => 'betterdocs_sidebar_padding_bottom',
//     'padding-left'   => 'betterdocs_sidebar_padding_left'
// ], 'px' ) );

//Sidebar Title Color Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'color' => 'betterdocs_sidebar_title_color'
] ) );

// //Sidebar Title Color Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'color' => 'betterdocs_sidebar_title_color'
// ] ) );

//Sidebar Title Background Color Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
    'background-color' => 'betterdocs_sidebar_title_bg_color'
] ) );

// //Sidebar Title Background Color Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_title_bg_color'
// ] ) );

//Sidebar Active Title Background Color Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
    'background-color' => 'betterdocs_sidebar_active_cat_background_color'
] ) );

// //Sidebar Active Title Background Color Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_active_cat_background_color'
// ] ) );

//Sidebar Title Hover Color Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a):hover, .betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a):hover', $css->properties( [
    'color' => 'betterdocs_sidebar_title_hover_color'
] ) );

// //Sidebar Title Hover Color Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a:hover, .betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a:hover', $css->properties( [
//     'color' => 'betterdocs_sidebar_title_hover_color'
// ] ) );

//Sidebar Active Title Color Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'color' => 'betterdocs_sidebar_active_title_color'
] ) );

// //Sidebar Active Title Color Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'color' => 'betterdocs_sidebar_active_title_color'
// ] ) );

//Sidebar Title Font Size Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'font-size' => 'betterdocs_sidebar_title_font_size'
], 'px' ) );

// //Sidebar Title Font Size Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_title_font_size'
// ], 'px' ) );

//Sidebar Title Padding Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
    'padding-top'    => 'betterdocs_sidebar_title_padding_top',
    'padding-right'  => 'betterdocs_sidebar_title_padding_right',
    'padding-bottom' => 'betterdocs_sidebar_title_padding_bottom',
    'padding-left'   => 'betterdocs_sidebar_title_padding_left'
], 'px' ) );

// //Sidebar Title Padding Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title', $css->properties( [
//     'padding-top'    => 'betterdocs_sidebar_title_padding_top',
//     'padding-right'  => 'betterdocs_sidebar_title_padding_right',
//     'padding-bottom' => 'betterdocs_sidebar_title_padding_bottom',
//     'padding-left'   => 'betterdocs_sidebar_title_padding_left'
// ], 'px' ) );

//Sidebar Title Margin Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper', $css->properties( [
    'margin-top'    => 'betterdocs_sidebar_title_margin_top',
    'margin-right'  => 'betterdocs_sidebar_title_margin_right',
    'margin-bottom' => 'betterdocs_sidebar_title_margin_bottom',
    'margin-left'   => 'betterdocs_sidebar_title_margin_left'
], 'px' ) );

// //Sidebar Title Margin Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper', $css->properties( [
//     'margin-top'    => 'betterdocs_sidebar_title_margin_top',
//     'margin-right'  => 'betterdocs_sidebar_title_margin_right',
//     'margin-bottom' => 'betterdocs_sidebar_title_margin_bottom',
//     'margin-left'   => 'betterdocs_sidebar_title_margin_left'
// ], 'px' ) );

//Sidebar Content Background Color Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-body', $css->properties( [
    'background-color' => 'betterdocs_sidbebar_item_list_bg_color'
] ) );

// //Sidebar Content Background Color Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-body', $css->properties( [
//     'background-color' => 'betterdocs_sidbebar_item_list_bg_color'
// ] ) );

//Sidebar Content List Item Color Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
    'color' => 'betterdocs_sidebar_list_item_color'
] ) );

// //Sidebar Content List Item Color Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
//     'color' => 'betterdocs_sidebar_list_item_color'
// ] ) );

//Sidebar Content List Item Hover Color Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a:hover', $css->properties( [
    'color' => 'betterdocs_sidebar_list_item_hover_color'
] ) );

// //Sidebar Content List Item Hover Color Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a:hover', $css->properties( [
//     'color' => 'betterdocs_sidebar_list_item_hover_color'
// ] ) );

//Sidebar Content List Item Font Size Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
    'font-size' => 'betterdocs_sidebar_list_item_font_size'
], 'px' ) );

// //Sidebar Content List Item Font Size Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_list_item_font_size'
// ], 'px' ) );

//Sidebar Content List Item Icon Color Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
    'fill' => 'betterdocs_sidebar_list_icon_color'
] ) );

// //Sidebar Content List Item Icon Color Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
//     'fill' => 'betterdocs_sidebar_list_icon_color'
// ] ) );

//Sidebar Content List Item Icon Font Size Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
    'font-size' => 'betterdocs_sidebar_list_icon_font_size',
    'min-width' => 'betterdocs_sidebar_list_icon_font_size'
], 'px' ) );

// //Sidebar Content List Item Icon Font Size Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_list_icon_font_size'
// ], 'px' ) );

//Sidebar Content List Item Margin Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li', $css->properties( [
    'margin-top'    => 'betterdocs_sidebar_list_item_margin_top',
    'margin-bottom' => 'betterdocs_sidebar_list_item_margin_bottom'
], 'px' ) );

//Sidebar Content List Item Margin Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li:not(.betterdocs-nested-category-wrapper)', $css->properties( [
    'margin-right' => 'betterdocs_sidebar_list_item_margin_right',
    'margin-left'  => 'betterdocs_sidebar_list_item_margin_left'
], 'px' ) );

//Sidebar Content List Item Margin Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li.betterdocs-nested-category-wrapper .betterdocs-nested-category-title', $css->properties( [
    'margin-right' => 'betterdocs_sidebar_list_item_margin_right',
    'margin-left'  => 'betterdocs_sidebar_list_item_margin_left'
], 'px' ) );

// //Sidebar Content List Item Margin Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li', $css->properties( [
//     'margin-top'    => 'betterdocs_sidebar_list_item_margin_top',
//     'margin-right'  => 'betterdocs_sidebar_list_item_margin_right',
//     'margin-bottom' => 'betterdocs_sidebar_list_item_margin_bottom',
//     'margin-left'   => 'betterdocs_sidebar_list_item_margin_left'
// ], 'px' ) );

//Sidebar Content Active List Item Color Layout 5
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a.active', $css->properties( [
    'color' => 'betterdocs_sidebar_active_list_item_color'
] ) );

// //Sidebar Content Active List Item Color Layout 5 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-5 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a.active', $css->properties( [
//     'color' => 'betterdocs_sidebar_active_list_item_color'
// ] ) );

//Sidebar Background Color Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
    'background-color' => 'betterdocs_sidebar_bg_color'
] ) );

// //Sidebar Background Color Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_bg_color'
// ] ) );

// //Sidebar Padding Top | Right | Bottom | Left Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
//     'padding-top'    => 'betterdocs_sidebar_padding_top',
//     'padding-right'  => 'betterdocs_sidebar_padding_right',
//     'padding-bottom' => 'betterdocs_sidebar_padding_bottom',
//     'padding-left'   => 'betterdocs_sidebar_padding_left'
// ], 'px' ) );

//Sidebar Title Color Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'color' => 'betterdocs_sidebar_title_color'
] ) );

// //Sidebar Title Color Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'color' => 'betterdocs_sidebar_title_color'
// ] ) );

//Sidebar Title Background Color Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner', $css->properties( [
    'background-color' => 'betterdocs_sidebar_title_bg_color'
] ) );

// //Sidebar Title Background Color Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_title_bg_color'
// ] ) );

//Sidebar Active Title Background Color Layout 4
// $css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_active_cat_background_color'
// ] ) );

// //Sidebar Active Title Background Color Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_active_cat_background_color'
// ] ) );

//Sidebar Title Hover Color Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a):hover, .betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a):hover', $css->properties( [
    'color' => 'betterdocs_sidebar_title_hover_color'
] ) );

// //Sidebar Title Hover Color Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a:hover, .betterdocs-content-wrapper.doc-category-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a:hover', $css->properties( [
//     'color' => 'betterdocs_sidebar_title_hover_color'
// ] ) );

//Sidebar Active Title Color Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'color' => 'betterdocs_sidebar_active_title_color'
] ) );

// //Sidebar Active Title Color Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'color' => 'betterdocs_sidebar_active_title_color'
// ] ) );

//Sidebar Title Font Size Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'font-size' => 'betterdocs_sidebar_title_font_size'
], 'px' ) );

// //Sidebar Title Font Size Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_title_font_size'
// ], 'px' ) );

//Sidebar Title Padding Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
    'padding-top'    => 'betterdocs_sidebar_title_padding_top',
    'padding-right'  => 'betterdocs_sidebar_title_padding_right',
    'padding-bottom' => 'betterdocs_sidebar_title_padding_bottom',
    'padding-left'   => 'betterdocs_sidebar_title_padding_left'
], 'px' ) );

// //Sidebar Title Padding Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'padding-top'    => 'betterdocs_sidebar_title_padding_top',
//     'padding-right'  => 'betterdocs_sidebar_title_padding_right',
//     'padding-bottom' => 'betterdocs_sidebar_title_padding_bottom',
//     'padding-left'   => 'betterdocs_sidebar_title_padding_left'
// ], 'px' ) );

//Sidebar Title Margin Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner', $css->properties( [
    'margin-top'    => 'betterdocs_sidebar_title_margin_top',
    'margin-right'  => 'betterdocs_sidebar_title_margin_right',
    'margin-bottom' => 'betterdocs_sidebar_title_margin_bottom',
    'margin-left'   => 'betterdocs_sidebar_title_margin_left'
], 'px' ) );

// //Sidebar Title Margin Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner', $css->properties( [
//     'margin-top'    => 'betterdocs_sidebar_title_margin_top',
//     'margin-right'  => 'betterdocs_sidebar_title_margin_right',
//     'margin-bottom' => 'betterdocs_sidebar_title_margin_bottom',
//     'margin-left'   => 'betterdocs_sidebar_title_margin_left'
// ], 'px' ) );

//Sidebar Content Background Color Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-sidebar-content .betterdocs-body', $css->properties( [
    'background-color' => 'betterdocs_sidbebar_item_list_bg_color'
] ) );

// //Sidebar Content Background Color Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-body', $css->properties( [
//     'background-color' => 'betterdocs_sidbebar_item_list_bg_color'
// ] ) );

//Sidebar Content List Item Color Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
    'color' => 'betterdocs_sidebar_list_item_color'
] ) );

// //Sidebar Content List Item Color Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
//     'color' => 'betterdocs_sidebar_list_item_color'
// ] ) );

//Sidebar Content List Item Hover Color Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a:hover', $css->properties( [
    'color' => 'betterdocs_sidebar_list_item_hover_color'
] ) );

// //Sidebar Content List Item Hover Color Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a:hover', $css->properties( [
//     'color' => 'betterdocs_sidebar_list_item_hover_color'
// ] ) );

//Sidebar Content List Item Font Size Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
    'font-size' => 'betterdocs_sidebar_list_item_font_size'
], 'px' ) );

// //Sidebar Content List Item Font Size Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_list_item_font_size'
// ], 'px' ) );

//Sidebar Content List Item Icon Color Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
    'fill' => 'betterdocs_sidebar_list_icon_color'
] ) );

// //Sidebar Content List Item Icon Color Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
//     'fill' => 'betterdocs_sidebar_list_icon_color'
// ] ) );

//Sidebar Content List Item Icon Font Size Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
    'font-size' => 'betterdocs_sidebar_list_icon_font_size',
    'min-width' => 'betterdocs_sidebar_list_icon_font_size'
], 'px' ) );

// //Sidebar Content List Item Icon Font Size Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_list_icon_font_size'
// ], 'px' ) );

//Sidebar Content List Item Margin Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li', $css->properties( [
    'margin-top'    => 'betterdocs_sidebar_list_item_margin_top',
    'margin-right'  => 'betterdocs_sidebar_list_item_margin_right',
    'margin-bottom' => 'betterdocs_sidebar_list_item_margin_bottom',
    'margin-left'   => 'betterdocs_sidebar_list_item_margin_left'
], 'px' ) );

// //Sidebar Content List Item Margin Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li', $css->properties( [
//     'margin-top'    => 'betterdocs_sidebar_list_item_margin_top',
//     'margin-right'  => 'betterdocs_sidebar_list_item_margin_right',
//     'margin-bottom' => 'betterdocs_sidebar_list_item_margin_bottom',
//     'margin-left'   => 'betterdocs_sidebar_list_item_margin_left'
// ], 'px' ) );

//Sidebar Content Active List Item Color Layout 4
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a.active', $css->properties( [
    'color' => 'betterdocs_sidebar_active_list_item_color'
] ) );

// //Sidebar Content Active List Item Color Layout 4 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-4 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a.active', $css->properties( [
//     'color' => 'betterdocs_sidebar_active_list_item_color'
// ] ) );

//Sidebar Background Color Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-category-list-wrapper', $css->properties( [
    'background-color' => 'betterdocs_sidebar_bg_color'
] ) );

// //Sidebar Background Color Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-category-list-wrapper', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_bg_color'
// ] ) );

// //Sidebar Padding Top | Right | Bottom | Left Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-category-list-wrapper', $css->properties( [
//     'padding-top'    => 'betterdocs_sidebar_padding_top',
//     'padding-right'  => 'betterdocs_sidebar_padding_right',
//     'padding-bottom' => 'betterdocs_sidebar_padding_bottom',
//     'padding-left'   => 'betterdocs_sidebar_padding_left'
// ], 'px' ) );

//Sidebar Title Color Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'color' => 'betterdocs_sidebar_title_color'
] ) );

// //Sidebar Title Color Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'color' => 'betterdocs_sidebar_title_color'
// ] ) );

//Sidebar Title Hover Color Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a):hover, .betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a):hover', $css->properties( [
    'color' => 'betterdocs_sidebar_title_hover_color'
] ) );

// //Sidebar Title Hover Color Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a:hover, .betterdocs-content-wrapper.doc-category-layout-5 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a:hover', $css->properties( [
//     'color' => 'betterdocs_sidebar_title_hover_color'
// ] ) );

//Sidebar Active Title Color Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'color' => 'betterdocs_sidebar_active_title_color'
] ) );

// //Sidebar Active Title Color Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'color' => 'betterdocs_sidebar_active_title_color'
// ] ) );

//Sidebar Title Background Color Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
    'background-color' => 'betterdocs_sidebar_title_bg_color'
] ) );

// //Sidebar Title Background Color Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_title_bg_color'
// ] ) );

//Sidebar Title Font Size Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'font-size' => 'betterdocs_sidebar_title_font_size'
], 'px' ) );

// //Sidebar Title Font Size Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_title_font_size'
// ], 'px' ) );

//Sidebar Title Padding Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
    'padding-top'    => 'betterdocs_sidebar_title_padding_top',
    'padding-right'  => 'betterdocs_sidebar_title_padding_right',
    'padding-bottom' => 'betterdocs_sidebar_title_padding_bottom',
    'padding-left'   => 'betterdocs_sidebar_title_padding_left'
], 'px' ) );

// //Sidebar Title Padding Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'padding-top'    => 'betterdocs_sidebar_title_padding_top',
//     'padding-right'  => 'betterdocs_sidebar_title_padding_right',
//     'padding-bottom' => 'betterdocs_sidebar_title_padding_bottom',
//     'padding-left'   => 'betterdocs_sidebar_title_padding_left'
// ], 'px' ) );

//Sidebar Title Margin Layout 2
// $css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'margin-top'    => 'betterdocs_sidebar_title_margin_top',
//     'margin-right'  => 'betterdocs_sidebar_title_margin_right',
//     'margin-bottom' => 'betterdocs_sidebar_title_margin_bottom',
//     'margin-left'   => 'betterdocs_sidebar_title_margin_left'
// ], 'px' ) );

// //Sidebar Title Margin Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'margin-top'    => 'betterdocs_sidebar_title_margin_top',
//     'margin-right'  => 'betterdocs_sidebar_title_margin_right',
//     'margin-bottom' => 'betterdocs_sidebar_title_margin_bottom',
//     'margin-left'   => 'betterdocs_sidebar_title_margin_left'
// ], 'px' ) );

//Sidebar Content Background Color Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-body', $css->properties( [
    'background-color' => 'betterdocs_sidbebar_item_list_bg_color'
] ) );

// //Sidebar Content Background Color Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-body', $css->properties( [
//     'background-color' => 'betterdocs_sidbebar_item_list_bg_color'
// ] ) );

//Sidebar Content List Item Color Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
    'color' => 'betterdocs_sidebar_list_item_color'
] ) );

// //Sidebar Content List Item Color Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
//     'color' => 'betterdocs_sidebar_list_item_color'
// ] ) );

//Sidebar Content List Item Hover Color Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a:hover', $css->properties( [
    'color' => 'betterdocs_sidebar_list_item_hover_color'
] ) );

// //Sidebar Content List Item Hover Color Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a:hover', $css->properties( [
//     'color' => 'betterdocs_sidebar_list_item_hover_color'
// ] ) );

//Sidebar Content List Item Font Size Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
    'font-size' => 'betterdocs_sidebar_list_item_font_size'
], 'px' ) );

// //Sidebar Content List Item Font Size Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_list_item_font_size'
// ], 'px' ) );

//Sidebar Content List Item Icon Color Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
    'fill' => 'betterdocs_sidebar_list_icon_color'
] ) );

// //Sidebar Content List Item Icon Color Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
//     'fill' => 'betterdocs_sidebar_list_icon_color'
// ] ) );

//Sidebar Content List Item Icon Font Size Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
    'font-size' => 'betterdocs_sidebar_list_icon_font_size',
    'min-width' => 'betterdocs_sidebar_list_icon_font_size'
], 'px' ) );

// //Sidebar Content List Item Icon Font Size Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_list_icon_font_size'
// ], 'px' ) );

//Sidebar Content List Item Margin Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li', $css->properties( [
    'margin-top'    => 'betterdocs_sidebar_list_item_margin_top',
    'margin-right'  => 'betterdocs_sidebar_list_item_margin_right',
    'margin-bottom' => 'betterdocs_sidebar_list_item_margin_bottom',
    'margin-left'   => 'betterdocs_sidebar_list_item_margin_left'
], 'px' ) );

// //Sidebar Content List Item Margin Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li', $css->properties( [
//     'margin-top'    => 'betterdocs_sidebar_list_item_margin_top',
//     'margin-right'  => 'betterdocs_sidebar_list_item_margin_right',
//     'margin-bottom' => 'betterdocs_sidebar_list_item_margin_bottom',
//     'margin-left'   => 'betterdocs_sidebar_list_item_margin_left'
// ], 'px' ) );

//Sidebar Content Active List Item Color Layout 2
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a.active', $css->properties( [
    'color' => 'betterdocs_sidebar_active_list_item_color'
] ) );

// //Sidebar Content Active List Item Color Layout 2 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-2 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a.active', $css->properties( [
//     'color' => 'betterdocs_sidebar_active_list_item_color'
// ] ) );

//Sidebar Background Color Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
    'background-color' => 'betterdocs_sidebar_bg_color'
] ) );

// //Sidebar Background Color Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_bg_color'
// ] ) );

// //Sidebar Padding Top | Right | Bottom | Left Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper', $css->properties( [
//     'padding-top'    => 'betterdocs_sidebar_padding_top',
//     'padding-right'  => 'betterdocs_sidebar_padding_right',
//     'padding-bottom' => 'betterdocs_sidebar_padding_bottom',
//     'padding-left'   => 'betterdocs_sidebar_padding_left'
// ], 'px' ) );

//Sidebar Title Background Color Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
    'background-color' => 'betterdocs_sidebar_title_bg_color'
] ) );

// //Sidebar Title Background Color Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_title_bg_color'
// ] ) );

//Sidebar Active Title Background Color | Border Color Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
    'background-color' => 'betterdocs_sidebar_active_cat_background_color',
    'border-color'     => '#528fff'
] ) );

// //Sidebar Active Title Background Color | Border Color Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'background-color' => 'betterdocs_sidebar_active_cat_background_color',
//     'border'           => 'none'
// ] ) );

//Sidebar Title Color Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'color' => 'betterdocs_sidebar_title_color'
] ) );

// //Sidebar Title Color Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'color' => 'betterdocs_sidebar_title_color'
// ] ) );

//Sidebar Title Hover Color Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a):hover', $css->properties( [
    'color' => 'betterdocs_sidebar_title_hover_color'
] ) );

// //Sidebar Title Hover Color Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a:hover', $css->properties( [
//     'color' => 'betterdocs_sidebar_title_hover_color'
// ] ) );

//Sidebar Active Title Color Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'color' => 'betterdocs_sidebar_active_title_color'
] ) );

// //Sidebar Active Title Color Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'color' => 'betterdocs_sidebar_active_title_color'
// ] ) );

//Sidebar Title Font Size Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a, .betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title:not(a)', $css->properties( [
    'font-size' => 'betterdocs_sidebar_title_font_size'
], 'px' ) );

// //Sidebar Title Font Size Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title a', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_title_font_size'
// ], 'px' ) );

//Sidebar Title Padding Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
    'padding-top'    => 'betterdocs_sidebar_title_padding_top',
    'padding-right'  => 'betterdocs_sidebar_title_padding_right',
    'padding-bottom' => 'betterdocs_sidebar_title_padding_bottom',
    'padding-left'   => 'betterdocs_sidebar_title_padding_left'
], 'px' ) );

// //Sidebar Title Padding Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header', $css->properties( [
//     'padding-top'    => 'betterdocs_sidebar_title_padding_top',
//     'padding-right'  => 'betterdocs_sidebar_title_padding_right',
//     'padding-bottom' => 'betterdocs_sidebar_title_padding_bottom',
//     'padding-left'   => 'betterdocs_sidebar_title_padding_left'
// ], 'px' ) );

//Sidebar Title Margin Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper', $css->properties( [
    'margin-top'    => 'betterdocs_sidebar_title_margin_top',
    'margin-right'  => 'betterdocs_sidebar_title_margin_right',
    'margin-bottom' => 'betterdocs_sidebar_title_margin_bottom',
    'margin-left'   => 'betterdocs_sidebar_title_margin_left'
], 'px' ) );

// //Sidebar Title Margin Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper', $css->properties( [
//     'margin-top'    => 'betterdocs_sidebar_title_margin_top',
//     'margin-right'  => 'betterdocs_sidebar_title_margin_right',
//     'margin-bottom' => 'betterdocs_sidebar_title_margin_bottom',
//     'margin-left'   => 'betterdocs_sidebar_title_margin_left'
// ], 'px' ) );

//Sidebar Content Background Color Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-body', $css->properties( [
    'background-color' => 'betterdocs_sidbebar_item_list_bg_color'
] ) );

// //Sidebar Content Background Color Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-body', $css->properties( [
//     'background-color' => 'betterdocs_sidbebar_item_list_bg_color'
// ] ) );

//Sidebar Content List Item Color Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
    'color' => 'betterdocs_sidebar_list_item_color'
] ) );

// //Sidebar Content List Item Color Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
//     'color' => 'betterdocs_sidebar_list_item_color'
// ] ) );

//Sidebar Content List Item Hover Color Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a:hover', $css->properties( [
    'color' => 'betterdocs_sidebar_list_item_hover_color'
] ) );

// //Sidebar Content List Item Hover Color Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a:hover', $css->properties( [
//     'color' => 'betterdocs_sidebar_list_item_hover_color'
// ] ) );

//Sidebar Content List Item Font Size Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
    'font-size' => 'betterdocs_sidebar_list_item_font_size'
], 'px' ) );

// //Sidebar Content List Item Font Size Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_list_item_font_size'
// ], 'px' ) );

//Sidebar Content List Item Icon Color Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
    'fill' => 'betterdocs_sidebar_list_icon_color'
] ) );

// //Sidebar Content List Item Icon Font Size Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-articles-list li svg', $css->properties( [
//     'font-size' => 'betterdocs_sidebar_list_icon_font_size'
// ], 'px' ) );

//Sidebar Content List Item Margin Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li', $css->properties( [
    'margin-top'    => 'betterdocs_sidebar_list_item_margin_top',
    'margin-right'  => 'betterdocs_sidebar_list_item_margin_right',
    'margin-bottom' => 'betterdocs_sidebar_list_item_margin_bottom',
    'margin-left'   => 'betterdocs_sidebar_list_item_margin_left'
], 'px' ) );

// //Sidebar Content List Item Margin Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li', $css->properties( [
//     'margin-top'    => 'betterdocs_sidebar_list_item_margin_top',
//     'margin-right'  => 'betterdocs_sidebar_list_item_margin_right',
//     'margin-bottom' => 'betterdocs_sidebar_list_item_margin_bottom',
//     'margin-left'   => 'betterdocs_sidebar_list_item_margin_left'
// ], 'px' ) );

//Sidebar Content Active List Item Color Layout 3
$css->add_rule( '.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a.active', $css->properties( [
    'color' => 'betterdocs_sidebar_active_list_item_color'
] ) );

// //Sidebar Content Active List Item Color Layout 3 (Single Doc)
// $css->add_rule( '.betterdocs-single-wrapper.betterdocs-single-layout-3 .betterdocs-sidebar .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li a.active', $css->properties( [
//     'color' => 'betterdocs_sidebar_active_list_item_color'
// ] ) );
/** SideBar Controls End **/

/** Archive Page Controls Start **/

//Archive Page Background Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper.betterdocs-category-archive-wrapper', $css->properties( [
    'background-color' => 'betterdocs_archive_page_background_color'
] ) );

//Archive Page Background Image/Properties
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper.betterdocs-category-archive-wrapper', $css->properties( [
    'background-image' => [
        'id'         => 'betterdocs_archive_page_background_image',
        'properties' => [
            'background-size'       => 'betterdocs_archive_page_background_size',
            'background-repeat'     => 'betterdocs_archive_page_background_repeat',
            'background-attachment' => 'betterdocs_archive_page_background_attachment',
            'background-position'   => 'betterdocs_archive_page_background_position'
        ]
    ]
] ) );

//Archive Content Area Width
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-wrapper', $css->properties( [
    'width' => 'betterdocs_archive_content_area_width'
], '%' ) );

// //Archive Content Area Maximum Width
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-wrapper', $css->properties( [
    'max-width' => 'betterdocs_archive_content_area_max_width'
], 'px' ) );

//Category Archive Padding (since betterdocs revamped version)
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-wrapper', $css->properties( [
    'padding-top'    => 'category_archive_padding_top',
    'padding-right'  => 'category_archive_padding_right',
    'padding-bottom' => 'category_archive_padding_bottom',
    'padding-left'   => 'category_archive_padding_left'
], 'px' ) );

//Archive Content Area Background Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area', $css->properties( [
    'background-color' => 'betterdocs_archive_content_background_color'
] ) );

//Archive Content Area Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area', $css->properties( [
    'margin-top'    => 'betterdocs_archive_content_margin_top',
    'margin-right'  => 'betterdocs_archive_content_margin_right',
    'margin-bottom' => 'betterdocs_archive_content_margin_bottom',
    'margin-left'   => 'betterdocs_archive_content_margin_left'
], 'px' ) );

//Archive Content Area Padding Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area', $css->properties( [
    'padding-top'    => 'betterdocs_archive_content_padding_top',
    'padding-right'  => 'betterdocs_archive_content_padding_right',
    'padding-bottom' => 'betterdocs_archive_content_padding_bottom',
    'padding-left'   => 'betterdocs_archive_content_padding_left'
], 'px' ) );

//Archive Content Border Radius
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area', $css->properties( [
    'border-radius' => 'betterdocs_archive_content_border_radius'
], 'px' ) );

//Archive Title Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-title .betterdocs-entry-heading', $css->properties( [
    'color' => 'betterdocs_archive_title_color'
] ) );

//Archive Title Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-title .betterdocs-entry-heading', $css->properties( [
    'font-size' => 'betterdocs_archive_title_font_size'
], 'px' ) );

//Archive Archive Title Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-title .betterdocs-entry-heading', $css->properties( [
    'margin-top'    => 'betterdocs_archive_title_margin_top',
    'margin-right'  => 'betterdocs_archive_title_margin_right',
    'margin-bottom' => 'betterdocs_archive_title_margin_bottom',
    'margin-left'   => 'betterdocs_archive_title_margin_left'
], 'px' ) );

//Archive Description Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-title p', $css->properties( [
    'color' => 'betterdocs_archive_description_color'
] ) );

//Archive Description Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-title p', $css->properties( [
    'font-size' => 'betterdocs_archive_description_font_size'
], 'px' ) );

//Archive Description Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-title p', $css->properties( [
    'margin-top'    => 'betterdocs_archive_description_margin_top',
    'margin-right'  => 'betterdocs_archive_description_margin_right',
    'margin-bottom' => 'betterdocs_archive_description_margin_bottom',
    'margin-left'   => 'betterdocs_archive_description_margin_left'
], 'px' ) );

//Archive List Icon Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body ul li svg', $css->properties( [
    'fill' => 'betterdocs_archive_list_icon_color'
] ) );

//Archive List Icon Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body ul li svg', $css->properties( [
    'font-size' => 'betterdocs_archive_list_icon_font_size',
    'min-width' => 'betterdocs_archive_list_icon_font_size'
], 'px' ) );

//Archive List Item Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body ul li a', $css->properties( [
    'color' => 'betterdocs_archive_list_item_color'
] ) );

//Archive List Item Hover Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body ul li a:hover', $css->properties( [
    'color' => 'betterdocs_archive_list_item_hover_color'
] ) );

//Archive List Item Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body ul li a', $css->properties( [
    'font-size' => 'betterdocs_archive_list_item_font_size'
], 'px' ) );

//Archive Docs List Margin Top | Right | Bottom | Left
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body ul li', $css->properties( [
    'margin-top'    => 'betterdocs_archive_article_list_margin_top',
    'margin-right'  => 'betterdocs_archive_article_list_margin_right',
    'margin-bottom' => 'betterdocs_archive_article_list_margin_bottom',
    'margin-left'   => 'betterdocs_archive_article_list_margin_left'
], 'px' ) );

//Archive Docs Subcategory Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body .betterdocs-nested-category-wrapper .betterdocs-nested-category-title a', $css->properties( [
    'color' => 'betterdocs_archive_article_subcategory_color'
] ) );

//Archive Docs Subcategory Hover Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body .betterdocs-nested-category-wrapper .betterdocs-nested-category-title a:hover', $css->properties( [
    'color' => 'betterdocs_archive_article_subcategory_hover_color'
] ) );

//Archive Docs Subcategory Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body .betterdocs-nested-category-wrapper .betterdocs-nested-category-title a', $css->properties( [
    'font-size' => 'betterdocs_archive_article_subcategory_font_size'
], 'px' ) );

//Archive Subcategory Icon Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body .betterdocs-nested-category-wrapper .betterdocs-nested-category-title svg', $css->properties( [
    'fill' => 'betterdocs_archive_subcategory_icon_color'
] ) );

//Archive Subcategory Icon Font Size
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body .betterdocs-nested-category-wrapper .betterdocs-nested-category-title svg', $css->properties( [
    'font-size' => 'betterdocs_archive_subcategory_icon_font_size'
], 'px' ) );

//Archive Subcategory Docs List Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body .betterdocs-nested-category-wrapper .betterdocs-nested-category-list li a', $css->properties( [
    'color' => 'betterdocs_archive_subcategory_article_list_color'
] ) );

//Archive Subcategory List Hover Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body .betterdocs-nested-category-wrapper .betterdocs-nested-category-list li a:hover', $css->properties( [
    'color' => 'betterdocs_archive_subcategory_article_list_hover_color'
] ) );

//Archive Subcategory List Icon Color
$css->add_rule( '.betterdocs-wrapper.betterdocs-taxonomy-wrapper .betterdocs-content-area .betterdocs-content-inner-area .betterdocs-entry-body .betterdocs-nested-category-wrapper .betterdocs-nested-category-list li svg', $css->properties( [
    'fill' => 'betterdocs_archive_subcategory_article_list_icon_color'
] ) );

//Archive Title Hover Color
$css->add_rule( '', $css->properties( [
    'color' => ''
] ) );

/** Archive Page Controls End **/

$css->add_rule( '.betterdocs-category-box.single-kb .docs-single-cat-wrap .docs-cat-title:hover', $css->properties( [
    'color' => 'betterdocs_doc_page_cat_title_hover_color'
], 'px' ) );

$css->add_rule( '.betterdocs-category-grid-layout-6 .betterdocs-term-info .betterdocs-term-title', $css->properties( [
    'color' => 'betterdocs_doc_page_cat_title_color2'
], '' ) );

$css->add_rule( '.betterdocs-category-grid-layout-6 .betterdocs-term-info .betterdocs-term-title:hover', $css->properties( [
    'color' => 'betterdocs_doc_page_cat_title_hover_color'
], '' ) );

$css->add_rule( '.betterdocs-categories-wrap.single-kb .docs-item-container li', $css->properties( [
    'margin-top'     => 'betterdocs_doc_page_article_list_margin_top',
    'margin-right'   => 'betterdocs_doc_page_article_list_margin_right',
    'margin-bottom'  => 'betterdocs_doc_page_article_list_margin_bottom',
    'margin-left'    => 'betterdocs_doc_page_article_list_margin_left',
    'padding-top'    => 'betterdocs_doc_page_article_list_padding_top',
    'padding-right'  => 'betterdocs_doc_page_article_list_padding_right',
    'padding-bottom' => 'betterdocs_doc_page_article_list_padding_bottom',
    'padding-left'   => 'betterdocs_doc_page_article_list_padding_left'
], 'px' ) );

$css->add_rule( '.betterdocs-categories-wrap.single-kb .docs-item-container .docs-sub-cat-title', $css->properties( [
    'margin-top'   => 'betterdocs_doc_page_article_list_margin_top',
    'margin-right' => 'betterdocs_doc_page_article_list_margin_right',
    'margin-left'  => 'betterdocs_doc_page_article_list_margin_left'
], 'px' ) );

$css->add_rule( '.betterdocs-popular-list.single-kb ul li', $css->properties( [
    'margin-top'     => 'betterdocs_doc_page_article_list_margin_top',
    'margin-right'   => 'betterdocs_doc_page_article_list_margin_right',
    'margin-bottom'  => 'betterdocs_doc_page_article_list_margin_bottom',
    'margin-left'    => 'betterdocs_doc_page_article_list_margin_left',
    'padding-top'    => 'betterdocs_doc_page_article_list_padding_top',
    'padding-right'  => 'betterdocs_doc_page_article_list_padding_right',
    'padding-bottom' => 'betterdocs_doc_page_article_list_padding_bottom',
    'padding-left'   => 'betterdocs_doc_page_article_list_padding_left'
], 'px' ) );

$css->add_rule( '.betterdocs-categories-wrap.single-kb li a:hover', $css->properties( [
    'color' => 'betterdocs_doc_page_article_list_hover_color'
], '' ) );

$css->add_rule( '.betterdocs-popular-list.single-kb ul li a:hover', $css->properties( [
    'color' => 'betterdocs_doc_page_article_list_hover_color'
], '' ) );

$css->add_rule( '.betterdocs-categories-wrap.single-kb .docs-single-cat-wrap .docs-item-container', $css->properties( [
    'border-bottom-right-radius' => 'betterdocs_doc_page_column_borderr_bottomright',
    'border-bottom-left-radius'  => 'betterdocs_doc_page_column_borderr_bottomleft'
], 'px' ) );

$css->add_rule( '.betterdocs-single-bg .betterdocs-content-area, .betterdocs-single-bg .betterdocs-content-full', $css->properties( [
    'background-color' => 'betterdocs_doc_single_content_area_bg_color',
    'background-image' => [
        'id'         => 'betterdocs_doc_single_content_area_bg_image',
        'properties' => [
            'background-size'       => 'betterdocs_doc_single_content_bg_property_size',
            'background-repeat'     => 'betterdocs_doc_single_content_bg_property_repeat',
            'background-attachment' => 'betterdocs_doc_single_content_bg_property_attachment',
            'background-position'   => 'betterdocs_doc_single_content_bg_property_position'
        ]
    ]
] ) );

$css->add_rule( '.betterdocs-single-layout4 .betterdocs-content-full', $css->properties( [
    'padding-top'    => 'betterdocs_doc_single_content_area_padding_top',
    'padding-right'  => 'betterdocs_doc_single_content_area_padding_right',
    'padding-bottom' => 'betterdocs_doc_single_content_area_padding_bottom',
    'padding-left'   => 'betterdocs_doc_single_content_area_padding_left'
], 'px' ) );

$css->add_rule( '.betterdocs-single-layout4 .betterdocs-content-full', $css->properties( [
    'background-color' => 'betterdocs_doc_single_content_area_bg_color',
    'background-image' => [
        'id'         => 'betterdocs_doc_single_content_area_bg_image',
        'properties' => [
            'background-size'       => 'betterdocs_doc_single_content_bg_property_size',
            'background-repeat'     => 'betterdocs_doc_single_content_bg_property_repeat',
            'background-attachment' => 'betterdocs_doc_single_content_bg_property_attachment',
            'background-position'   => 'betterdocs_doc_single_content_bg_property_position'
        ]
    ]
] ) );

$css->add_rule( '.betterdocs-single-layout5 .betterdocs-content-full', $css->properties( [
    'padding-top'    => 'betterdocs_doc_single_content_area_padding_top',
    'padding-right'  => 'betterdocs_doc_single_content_area_padding_right',
    'padding-bottom' => 'betterdocs_doc_single_content_area_padding_bottom',
    'padding-left'   => 'betterdocs_doc_single_content_area_padding_left'
], 'px' ) );

$css->add_rule( '.betterdocs-single-layout5 .betterdocs-content-full', $css->properties( [
    'background-color' => 'betterdocs_doc_single_content_area_bg_color',
    'background-image' => [
        'id'         => 'betterdocs_doc_single_content_area_bg_image',
        'properties' => [
            'background-size'       => 'betterdocs_doc_single_content_bg_property_size',
            'background-repeat'     => 'betterdocs_doc_single_content_bg_property_repeat',
            'background-attachment' => 'betterdocs_doc_single_content_bg_property_attachment',
            'background-position'   => 'betterdocs_doc_single_content_bg_property_position'
        ]
    ]
] ) );

$css->add_rule( '.betterdocs-single-layout2 .docs-content-full-main .doc-single-content-wrapper', $css->properties( [
    'padding-top'    => 'betterdocs_doc_single_2_post_content_padding_top',
    'padding-right'  => 'betterdocs_doc_single_2_post_content_padding_right',
    'padding-bottom' => 'betterdocs_doc_single_2_post_content_padding_bottom',
    'padding-left'   => 'betterdocs_doc_single_2_post_content_padding_left'
], 'px' ) );

$css->add_rule( '.betterdocs-single-layout3 .docs-content-full-main .doc-single-content-wrapper', $css->properties( [
    'padding-top'    => 'betterdocs_doc_single_3_post_content_padding_top',
    'padding-right'  => 'betterdocs_doc_single_3_post_content_padding_right',
    'padding-bottom' => 'betterdocs_doc_single_3_post_content_padding_bottom',
    'padding-left'   => 'betterdocs_doc_single_3_post_content_padding_left'
], 'px' ) );

$css->add_rule( '.betterdocs-category-wraper.betterdocs-single-wraper', $css->properties( [
    'background-color' => 'betterdocs_archive_page_background_color',
    'background-image' => [
        'id'         => 'betterdocs_archive_page_background_image',
        'properties' => [
            'background-size'       => 'betterdocs_archive_page_background_size',
            'background-repeat'     => 'betterdocs_archive_page_background_repeat',
            'background-attachment' => 'betterdocs_archive_page_background_attachment',
            'background-position'   => 'betterdocs_archive_page_background_position'
        ]
    ]
] ) );

$css->add_rule( '.betterdocs-category-wraper.betterdocs-single-wraper .docs-listing-main .docs-category-listing', $css->properties( [
    'background-color' => 'betterdocs_archive_content_background_color'
] ) );

$css->add_rule( '.betterdocs-category-wraper.betterdocs-single-wraper .docs-listing-main .docs-category-listing', $css->properties( [
    'margin-top'     => 'betterdocs_archive_content_margin_top',
    'margin-right'   => 'betterdocs_archive_content_margin_right',
    'margin-bottom'  => 'betterdocs_archive_content_margin_bottom',
    'margin-left'    => 'betterdocs_archive_content_margin_left',
    'padding-top'    => 'betterdocs_archive_content_padding_top',
    'padding-right'  => 'betterdocs_archive_content_padding_right',
    'padding-bottom' => 'betterdocs_archive_content_padding_bottom',
    'padding-left'   => 'betterdocs_archive_content_padding_left',
    'border-radius'  => 'betterdocs_archive_content_border_radius'
], 'px' ) );

$css->add_rule( '.betterdocs-category-wraper .docs-category-listing .docs-cat-title .docs-cat-heading', $css->properties( [
    'color' => 'betterdocs_archive_title_color'
] ) );

$css->add_rule( '.betterdocs-category-wraper .docs-category-listing .docs-cat-title .docs-cat-heading', $css->properties( [
    'font-size'     => 'betterdocs_archive_title_font_size',
    'margin-top'    => 'betterdocs_archive_title_margin_top',
    'margin-right'  => 'betterdocs_archive_title_margin_right',
    'margin-bottom' => 'betterdocs_archive_title_margin_bottom',
    'margin-left'   => 'betterdocs_archive_title_margin_left'
], 'px' ) );

$css->add_rule( '.betterdocs-category-wraper .docs-category-listing .docs-cat-title p', $css->properties( [
    'color' => 'betterdocs_archive_description_color'
] ) );

$css->add_rule( '.betterdocs-category-wraper .docs-category-listing .docs-cat-title p', $css->properties( [
    'font-size'     => 'betterdocs_archive_description_font_size',
    'margin-top'    => 'betterdocs_archive_description_margin_top',
    'margin-right'  => 'betterdocs_archive_description_margin_right',
    'margin-bottom' => 'betterdocs_archive_description_margin_bottom',
    'margin-left'   => 'betterdocs_archive_description_margin_left'
], 'px' ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list ul li, .betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list .docs-sub-cat-title', $css->properties( [
    'margin-top'    => 'betterdocs_archive_article_list_margin_top',
    'margin-right'  => 'betterdocs_archive_article_list_margin_right',
    'margin-bottom' => 'betterdocs_archive_article_list_margin_bottom',
    'margin-left'   => 'betterdocs_archive_article_list_margin_left'
], 'px' ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list ul li svg', $css->properties( [
    'fill' => 'betterdocs_archive_list_icon_color'
] ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list ul li svg', $css->properties( [
    'font-size' => 'betterdocs_archive_list_icon_font_size',
    'min-width' => 'betterdocs_archive_list_icon_font_size'
], 'px' ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list ul li a', $css->properties( [
    'color' => 'betterdocs_archive_list_item_color'
] ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list ul li a', $css->properties( [
    'font-size' => 'betterdocs_archive_list_item_font_size'
], 'px' ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list ul li a:hover', $css->properties( [
    'color' => 'betterdocs_archive_list_item_hover_color'
] ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list .docs-sub-cat li a', $css->properties( [
    'color' => 'betterdocs_archive_subcategory_article_list_color'
] ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list .docs-sub-cat li a:hover', $css->properties( [
    'color' => 'betterdocs_archive_subcategory_article_list_hover_color'
] ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list .docs-sub-cat li svg', $css->properties( [
    'fill' => 'betterdocs_archive_subcategory_article_list_icon_color'
] ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list .docs-sub-cat-title svg', $css->properties( [
    'fill' => 'betterdocs_archive_subcategory_icon_color'
] ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list .docs-sub-cat-title svg', $css->properties( [
    'font-size' => 'betterdocs_archive_subcategory_icon_font_size'
], 'px' ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list .docs-sub-cat-title a', $css->properties( [
    'color' => 'betterdocs_archive_article_subcategory_color'
] ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list .docs-sub-cat-title a', $css->properties( [
    'font-size' => 'betterdocs_archive_article_subcategory_font_size'
], 'px' ) );

$css->add_rule( '.betterdocs-category-wraper .docs-listing-main .docs-category-listing .docs-list .docs-sub-cat-title a:hover', $css->properties( [
    'color' => 'betterdocs_archive_article_subcategory_hover_color'
] ) );

//Live Search Start

$css->add_rule( '.betterdocs-wrapper .betterdocs-search-form-wrapper:not(.betterdocs-elementor)', $css->properties( [
    'background-color' => 'betterdocs_live_search_background_color',
    'background-image' => [
        'id'         => 'betterdocs_live_search_background_image',
        'properties' => [
            'background-repeat'     => 'betterdocs_live_search_background_repeat',
            'background-attachment' => 'betterdocs_live_search_background_attachment',
            'background-position'   => 'betterdocs_live_search_background_position'
        ]
    ]
] ) );

$css->add_rule( '.betterdocs-wrapper .betterdocs-search-form-wrapper:not(.betterdocs-elementor)', $css->properties( [
    'padding-top'    => 'betterdocs_live_search_padding_top',
    'padding-right'  => 'betterdocs_live_search_padding_right',
    'padding-bottom' => 'betterdocs_live_search_padding_bottom',
    'padding-left'   => 'betterdocs_live_search_padding_left',
    'margin-top'     => 'betterdocs_live_search_margin_top',
    'margin-right'   => 'betterdocs_live_search_margin_right',
    'margin-bottom'  => 'betterdocs_live_search_margin_bottom',
    'margin-left'    => 'betterdocs_live_search_margin_left'
], 'px' ) );

if ( $mods['betterdocs_live_search_custom_background_switch'] ) {
    $css->add_rule( '.betterdocs-wrapper .betterdocs-search-form-wrapper:not(.betterdocs-elementor)', $css->properties( [
        'background-size' => '%betterdocs_live_search_custom_background_width%% %betterdocs_live_search_custom_background_height%%'
    ] ) );
} elseif ( $mods['betterdocs_live_search_background_size'] ) {
    $css->add_rule( '.betterdocs-wrapper .betterdocs-search-form-wrapper:not(.betterdocs-elementor)', $css->properties( [
        'background-size' => 'betterdocs_live_search_background_size'
    ] ) );
}

$css->add_rule( '.betterdocs-search-heading h2.heading, .betterdocs-search-heading h1.heading, .betterdocs-search-heading h3.heading, .betterdocs-search-heading h4.heading, .betterdocs-search-heading h5.heading, .betterdocs-search-heading h6.heading', $css->properties( [
    'line-height' => '1.2',
    'color'       => 'betterdocs_live_search_heading_font_color'
] ) );

$css->add_rule( '.betterdocs-search-heading h2.heading, .betterdocs-search-heading h1.heading, .betterdocs-search-heading h3.heading, .betterdocs-search-heading h4.heading, .betterdocs-search-heading h5.heading, .betterdocs-search-heading h6.heading', $css->properties( [
    'font-size'     => 'betterdocs_live_search_heading_font_size',
    'margin-top'    => 'betterdocs_search_heading_margin_top',
    'margin-right'  => 'betterdocs_search_heading_margin_right',
    'margin-bottom' => 'betterdocs_search_heading_margin_bottom',
    'margin-left'   => 'betterdocs_search_heading_margin_left'
], 'px' ) );

$css->add_rule( '.betterdocs-search-heading h3.subheading, .betterdocs-search-heading h2.subheading, .betterdocs-search-heading h1.subheading, .betterdocs-search-heading h4.subheading, .betterdocs-search-heading h5.subheading, .betterdocs-search-heading h6.subheading', $css->properties( [
    'line-height' => '1.2',
    'color'       => 'betterdocs_live_search_subheading_font_color'
] ) );

$css->add_rule( '.betterdocs-search-heading h3.subheading, .betterdocs-search-heading h2.subheading, .betterdocs-search-heading h1.subheading, .betterdocs-search-heading h4.subheading, .betterdocs-search-heading h5.subheading, .betterdocs-search-heading h6.subheading', $css->properties( [
    'font-size'     => 'betterdocs_live_search_subheading_font_size',
    'margin-top'    => 'betterdocs_search_subheading_margin_top',
    'margin-right'  => 'betterdocs_search_subheading_margin_right',
    'margin-bottom' => 'betterdocs_search_subheading_margin_bottom',
    'margin-left'   => 'betterdocs_search_subheading_margin_left'
], 'px' ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform', $css->properties( [
    'background-color' => 'betterdocs_search_field_background_color'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform', $css->properties( [
    'border-radius'  => 'betterdocs_search_field_border_radius',
    'padding-top'    => 'betterdocs_search_field_padding_top',
    'padding-right'  => 'betterdocs_search_field_padding_right',
    'padding-bottom' => 'betterdocs_search_field_padding_bottom',
    'padding-left'   => 'betterdocs_search_field_padding_left'
], 'px' ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .betterdocs-search-field', $css->properties( [
    'font-size' => 'betterdocs_search_field_font_size'
], 'px' ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .betterdocs-search-field', $css->properties( [
    'color' => 'betterdocs_search_field_color'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .betterdocs-search-field:focus', $css->properties( [
    'color' => 'betterdocs_search_field_color'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .betterdocs-search-field::placeholder', $css->properties( [
    'color' => 'betterdocs_search_placeholder_color'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform svg.docs-search-icon', $css->properties( [
    'fill' => 'betterdocs_search_icon_color'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform svg.docs-search-icon', $css->properties( [
    'height' => 'betterdocs_search_icon_size'
], 'px' ) );

$css->add_rule( '.betterdocs-live-search .docs-search-close path.close-line', $css->properties( [
    'fill' => 'betterdocs_search_close_icon_color'
] ) );

$css->add_rule( '.betterdocs-live-search .docs-search-close path.close-border', $css->properties( [
    'fill' => 'betterdocs_search_close_icon_border_color'
] ) );

$css->add_rule( '.betterdocs-live-search .docs-search-loader', $css->properties( [
    'stroke' => 'betterdocs_search_close_icon_border_color'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform svg.docs-search-icon:hover', $css->properties( [
    'fill' => 'betterdocs_search_icon_hover_color'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .docs-search-result', $css->properties( [
    'width' => 'betterdocs_search_result_width'
], '%' ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .docs-search-result', $css->properties( [
    'max-width' => 'betterdocs_search_result_max_width'
], 'px' ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .docs-search-result', $css->properties( [
    'background-color' => 'betterdocs_search_result_background_color'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .docs-search-result', $css->properties( [
    'border-color' => 'betterdocs_search_result_border_color'
] ) );

$css->add_rule( '.betterdocs-search-result-wrap::before', $css->properties( [
    'border-color' => 'transparent transparent %betterdocs_search_result_background_color%'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .betterdocs-search-result-wrap .docs-search-result li', $css->properties( [
    'border-color' => 'betterdocs_search_result_item_border_color'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .betterdocs-search-result-wrap .docs-search-result li a', $css->properties( [
    'font-size'      => 'betterdocs_search_result_item_font_size',
    'padding-top'    => 'betterdocs_search_result_item_padding_top',
    'padding-right'  => 'betterdocs_search_result_item_padding_right',
    'padding-bottom' => 'betterdocs_search_result_item_padding_bottom',
    'padding-left'   => 'betterdocs_search_result_item_padding_left'
], 'px' ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .betterdocs-search-result-wrap .docs-search-result li', $css->properties( [
    'font-size' => 'betterdocs_search_result_item_font_size'
], 'px' ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .betterdocs-search-result-wrap .docs-search-result li a .betterdocs-search-title', $css->properties( [
    'color' => 'betterdocs_search_result_item_font_color'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .betterdocs-search-result-wrap .docs-search-result li a .betterdocs-search-category', $css->properties( [
    'color' => 'betterdocs_search_result_item_cat_font_color'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .betterdocs-search-result-wrap .docs-search-result li:hover', $css->properties( [
    'background-color' => 'betterdocs_search_result_item_hover_background_color'
] ) );

$css->add_rule( '.betterdocs-live-search .betterdocs-searchform .betterdocs-search-result-wrap .docs-search-result li a span:hover', $css->properties( [
    'color' => 'betterdocs_search_result_item_hover_font_color'
] ) );

//Live Search End
/**
 * For Docs Layout 4 Search Padding Bottom
 */
$css->add_rule( '.betterdocs-docs-archive-wrapper.betterdocs-category-layout-4 .betterdocs-search-form-wrapper:not(.betterdocs-elementor)', $css->properties( [
    'padding-bottom' => 'calc(%betterdocs_live_search_padding_bottom%px + 80px)'
] ) );

//FAQ Common Controls
$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper .betterdocs-faq-section-title', $css->properties( [
    'font-size' => 'betterdocs_faq_title_font_size'
], 'px' ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper .betterdocs-faq-section-title', $css->properties( [
    'color' => 'betterdocs_faq_title_color'
] ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper .betterdocs-faq-section-title', $css->properties( [
    'margin' => 'betterdocs_faq_title_margin'
], 'px' ) );

/**
 * FAQ Layout 1 Customizer CSS
 */
$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-1 .betterdocs-faq-inner-wrapper .betterdocs-faq-title h2', $css->properties( [
    'color' => 'betterdocs_faq_category_title_color'
] ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-1 .betterdocs-faq-inner-wrapper .betterdocs-faq-title h2', $css->properties( [
    'font-size' => 'betterdocs_faq_category_name_font_size'
], 'px' ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-1 .betterdocs-faq-inner-wrapper .betterdocs-faq-title h2', $css->properties( [
    'padding' => 'betterdocs_faq_category_name_padding'
], 'px' ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-1 .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-post-name', $css->properties( [
    'color' => 'betterdocs_faq_list_color'
] ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-1 .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-post-name', $css->properties( [
    'font-size' => 'betterdocs_faq_list_font_size'
], 'px' ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-1 .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post', $css->properties( [
    'background-color' => 'betterdocs_faq_list_background_color'
] ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-1 .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post', $css->properties( [
    'padding' => 'betterdocs_faq_list_padding'
], 'px' ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-1 .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-main-content', $css->properties( [
    'background-color' => 'betterdocs_faq_list_content_background_color',
    'color'            => 'betterdocs_faq_list_content_color'
] ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-1 .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-main-content', $css->properties( [
    'font-size' => 'betterdocs_faq_list_content_font_size'
], 'px' ) );

/**
 * FAQ Layout 2 Customizer CSS
 */

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-2 .betterdocs-faq-inner-wrapper .betterdocs-faq-title h2', $css->properties( [
    'color' => 'betterdocs_faq_category_title_color_layout_2'
] ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-2 .betterdocs-faq-inner-wrapper .betterdocs-faq-title h2', $css->properties( [
    'font-size' => 'betterdocs_faq_category_name_font_size_layout_2'
], 'px' ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-2 .betterdocs-faq-inner-wrapper .betterdocs-faq-title h2', $css->properties( [
    'padding' => 'betterdocs_faq_category_name_padding_layout_2'
], 'px' ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-2 .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-post-name', $css->properties( [
    'color' => 'betterdocs_faq_list_color_layout_2'
] ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-2 .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-post .betterdocs-faq-post-name', $css->properties( [
    'font-size' => 'betterdocs_faq_list_font_size_layout_2'
], 'px' ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-2 .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group', $css->properties( [
    'background-color' => 'betterdocs_faq_list_background_color_layout_2'
] ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-2 .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-main-content', $css->properties( [
    'background-color' => 'betterdocs_faq_list_content_background_color_layout_2',
    'color'            => 'betterdocs_faq_list_content_color_layout_2'
] ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-2 .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group .betterdocs-faq-main-content', $css->properties( [
    'font-size' => 'betterdocs_faq_list_content_font_size_layout_2'
], 'px' ) );

$css->add_rule( '.betterdocs-docs-archive-wrapper .betterdocs-faq-wrapper.betterdocs-faq-layout-2 .betterdocs-faq-inner-wrapper .betterdocs-faq-list > li .betterdocs-faq-group.active .betterdocs-faq-post', $css->properties( [
    'padding' => 'betterdocs_faq_list_padding_layout_2'
], 'px' ) );
