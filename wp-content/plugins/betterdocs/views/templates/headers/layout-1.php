<?php
    if( ! betterdocs()->settings->get( 'enable_breadcrumb' ) && ! betterdocs()->settings->get( 'enable_post_title' ) ) {
        return;
    }
?>

<header class="betterdocs-entry-header">
    <div class="docs-single-title">
        <?php
            /**
             * Breadcrumbs
             */
            $view_object->get( 'templates/parts/breadcrumbs' );

            /**
             * Title
             */
            if ( betterdocs()->settings->get( 'enable_post_title' ) ) {
                $view_object->get(
                    'templates/parts/title', [
                        'tag' => betterdocs()->customizer->defaults->get('betterdocs_post_title_tag')
                    ]
                );
            }
        ?>
    </div>
</header> <!-- .entry-header -->
