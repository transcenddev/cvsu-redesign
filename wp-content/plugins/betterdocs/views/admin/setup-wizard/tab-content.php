<div class="tab-content" id="<?php print( isset( $section['id'] ) ? $section['id'] : 'default-nav' );?>">
    <table class="form-table" role="presentation">
        <tbody>
            <?php
                if ( isset( $section['fields'] ) && is_array( $section['fields'] ) ) {
                    foreach ( $section['fields'] as $field ) {
                        $methodName = 'callback_' . $field['type'];
                        $self::$methodName( $field );
                    }
                }
            ?>
        </tbody>
    </table>
</div>
