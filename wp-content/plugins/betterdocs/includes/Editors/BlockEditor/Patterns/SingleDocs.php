<?php
namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Patterns;


class SingleDocs extends BasePattern {

    public function register() {
        register_block_pattern(
            'betterdocs/single-docs-layout-1',
            array(
                'title'         => __( 'Single Docs', 'betterdocs' ),
                'description'   => _x( 'Single Docs Layout', 'Block pattern description', 'betterdocs' ),
                'content'       => '<!-- wp:group {"style":{"color":{"background":"#f2f4f7"},"spacing":{"padding":{"bottom":"50px"}}},"layout":{"type":"default"}} -->
                <div
                    class="wp-block-group has-background"
                    style="background-color: #f2f4f7; padding-bottom: 50px"
                >
                    <!-- wp:group {"style":{"color":{"background":"#f7f7f7"}},"layout":{"backgroundColor":"#f2f4f7","inherit":true,"contentSize":"1400px","type":"constrained"}} -->
                    <div
                        class="wp-block-group has-background"
                        style="background-color: #f7f7f7"
                    >
                        <!-- wp:betterdocs/searchbox /-->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"layout":{"backgroundColor":"#f2f4f7","inherit":true,"contentSize":"1400px","type":"constrained"}} -->
                    <div class="wp-block-group">
                        <!-- wp:columns {"align":"wide"} -->
                        <div class="wp-block-columns alignwide">
                            <!-- wp:column {"width":"33.33%"} -->
                            <div class="wp-block-column" style="flex-basis: 33.33%">
                                <!-- wp:betterdocs/sidebar /-->
                            </div>
                            <!-- /wp:column -->

                            <!-- wp:column {"width":"66.66%"} -->
                            <div class="wp-block-column" style="flex-basis: 66.66%">
                                <!-- wp:betterdocs/breadcrumb /-->

                                <!-- wp:post-title {"style":{"spacing":{"margin":{"bottom":"30px"}},"typography":{"fontSize":"36px","textTransform":"uppercase"}}} /-->

                                <!-- wp:betterdocs/betterdocs-print /-->

                                <!-- wp:betterdocs/table-of-contents /-->

                                <!-- wp:betterdocs/single-doc-content /-->

                                <!-- wp:betterdocs/doc-navigation /-->

                                <!-- wp:betterdocs/reactions /-->

                                <!-- wp:betterdocs/social-share /-->

                                <!-- wp:betterdocs/date /-->
                            </div>
                            <!-- /wp:column -->
                        </div>
                        <!-- /wp:columns -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->',
                'categories'    => array( 'betterdocs-single-docs' ),
                'keywords'      => array( 'betterdocs', 'single docs layout 1' ),
                'viewportWidth' => 800,
            )
        );
    }
}
