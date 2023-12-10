<div class="betterdocs-entry-content">
    <?php
        /**
         * Print Icon
         */
        $view_object->get( 'templates/parts/print-icon', [
            'enable' => betterdocs()->settings->get( 'enable_print_icon', false )
        ] );

        /**
         * TOC
         */
        $view_object->get( 'templates/parts/toc' );

        /**
         * Content
         */
        $view_object->get( 'templates/parts/content' );
    ?>
</div>
