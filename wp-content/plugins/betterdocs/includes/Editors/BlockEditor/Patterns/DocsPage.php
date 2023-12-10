<?php
namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Patterns;


class DocsPage extends BasePattern {

    public function register() {
        register_block_pattern(
            'betterdocs/doc-category-archive',
            array(
                'title'         => __( 'Docs Page', 'betterdocs' ),
                'description'   => _x( 'Docs Category Archive Layout', 'Block pattern description', 'betterdocs' ),
                'content'       => '<!-- wp:group {"layout":{"inherit":true,"contentSize":"1400px","type":"constrained"}} -->
                <div class="wp-block-group">
                    <!-- wp:betterdocs/searchbox {"template":"archive-docs"} /-->
                    <!-- wp:betterdocs/categorygrid {"template":"archive-docs"} /-->
                </div>
                <!-- /wp:group -->',
                'categories'    => array( 'betterdocs-docs-page' ),
                'keywords'      => array( 'betterdocs', 'docs page', 'category grid layout' ),
                'viewportWidth' => 800,
            )
        );
    }
}
