<?php
    if ( ! $show_count ) {
        return;
    }

    $prefix = $suffix = $suffix_singular = '';

    if ( is_array( $counts ) ) {
        $prefix          = $counts['prefix'];
        $_count          = $counts['counts'];
        $suffix          = $counts['suffix'];
        $suffix_singular = $counts['suffix_singular'];
        $counts          = $_count;
    }

    $prefix          = apply_filters( 'betterdocs_category_items_counts_prefix', $prefix, get_defined_vars() );
    $suffix          = apply_filters( 'betterdocs_category_items_counts_suffix', $suffix, get_defined_vars() );
    $suffix_singular = apply_filters( 'betterdocs_category_items_counts_suffix_singular', $suffix_singular, get_defined_vars() );
?>

<div data-count="<?php esc_attr_e( $counts );?>" class="betterdocs-category-items-counts">
    <span>
        <?php
            echo sprintf(
                _n( "$prefix %s $suffix_singular", "$prefix %s $suffix", $counts, 'betterdocs' ),
                $counts
            );
        ?>
    </span>
</div>
