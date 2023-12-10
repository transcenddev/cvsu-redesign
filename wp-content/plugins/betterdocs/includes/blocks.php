<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\ToC;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\DocDate;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\Sidebar;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\Reactions;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\DocContent;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\Navigation;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\SearchForm;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\ArchiveList;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\Breadcrumbs;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\CategoryBox;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\SocialShare;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\CategoryGrid;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\FeedbackForm;
use WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks\BetterdocsPrint;

return [
    'categorygrid'      => [
        'label'      => __( 'BetterDocs Category Grid', 'betterdocs' ),
        'value'      => 'categorygrid',
        'visibility' => true,
        'object'     => CategoryGrid::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'categorybox'       => [
        'label'      => __( 'BetterDocs Category Box', 'betterdocs' ),
        'value'      => 'categorybox',
        'visibility' => true,
        'object'     => CategoryBox::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'searchform'        => [
        'label'      => __( 'BetterDocs Search Form', 'betterdocs' ),
        'value'      => 'searchform',
        'visibility' => true,
        'object'     => SearchForm::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'breadcrumbs'       => [
        'label'      => __( 'BetterDocs Breadcrumb', 'betterdocs' ),
        'value'      => 'breadcrumbs',
        'visibility' => true,
        'object'     => Breadcrumbs::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'doc-archive-list'  => [
        'label'      => __( 'Doc Archive List', 'betterdocs' ),
        'value'      => 'doc-archive-list',
        'visibility' => true,
        'object'     => ArchiveList::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'doc-content'       => [
        'label'      => __( 'Doc Content', 'betterdocs' ),
        'value'      => 'doc-content',
        'visibility' => true,
        'object'     => DocContent::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'doc-date'          => [
        'label'      => __( 'Doc Date', 'betterdocs' ),
        'value'      => 'doc-date',
        'visibility' => true,
        'object'     => DocDate::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'doc-navigation'    => [
        'label'      => __( 'Doc Navigation', 'betterdocs' ),
        'value'      => 'doc-navigation',
        'visibility' => true,
        'object'     => Navigation::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'reactions'         => [
        'label'      => __( 'Reactions', 'betterdocs' ),
        'value'      => 'reactions',
        'visibility' => true,
        'object'     => Reactions::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'sidebar'           => [
        'label'      => __( 'Sidebar', 'betterdocs' ),
        'value'      => 'sidebar',
        'visibility' => true,
        'object'     => Sidebar::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'socialshare'       => [
        'label'      => __( 'Social Share', 'betterdocs' ),
        'value'      => 'socialshare',
        'visibility' => true,
        'object'     => SocialShare::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'table-of-contents' => [
        'label'      => __( 'Table of Contents', 'betterdocs' ),
        'value'      => 'table-of-contents',
        'visibility' => true,
        'object'     => ToC::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'feedback-form'     => [
        'label'      => __( 'Feedback Form', 'betterdocs' ),
        'value'      => 'feedback-form',
        'visibility' => true,
        'object'     => FeedbackForm::class,
        'demo'       => '',
        'docs'       => ''
    ],
    'betterdocs-print'  => [
        'label'      => __( 'Betterdocs Print', 'betterdocs' ),
        'value'      => 'betterdocs-print',
        'visibility' => true,
        'object'     => BetterdocsPrint::class,
        'demo'       => '',
        'docs'       => ''
    ]
];
