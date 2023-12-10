<?php
    $current_term = ( isset( $_GET['doc_category'] ) ) ? $_GET['doc_category'] : '';

    $terms_object = [
        'taxonomy'   => 'doc_category',
        'hide_empty' => false
    ];

    $terms = get_terms( apply_filters( 'betterdocs_category_terms_object', $terms_object ) );
?>
<select
    id="dashboard-select-doc_category"
    class="dashboard-search-field dashboard-select-category" name="doc_category">
    <option value="all"><?php _e( 'All Categories', 'betterdocs' )?></option>
    <?php
        foreach ( $terms as $term ) {
            echo betterdocs()->template_helper->option_kses( $term->slug, $term->name, $current_term );
        }
    ?>
</select>
