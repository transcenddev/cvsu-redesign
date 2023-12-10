<?php
    $_defined_vars = get_defined_vars();
    $_params       = isset( $_defined_vars['params'] ) ? $_defined_vars['params'] : [];
    $view_object->get( 'template-parts/category-list', $_params );
?>
