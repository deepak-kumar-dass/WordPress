<?php
/**
 * Require a featured image to be set before a post can be published.
 */
add_filter( 'wp_insert_post_data', function ( $data, $postarr ) {
    $post_id              = $postarr['ID'];
    $post_status          = $data['post_status'];
    $original_post_status = $postarr['original_post_status'];
    if ( $post_id && 'publish' === $post_status && 'publish' !== $original_post_status ) {
        $post_type = get_post_type( $post_id );
        if ( post_type_supports( $post_type, 'thumbnail' ) && ! has_post_thumbnail( $post_id ) ) {
            $data['post_status'] = 'draft';
        }
    }
    return $data;
}, 10, 2 );
add_action( 'admin_notices', function () {
    $post = get_post();
    if ( 'publish' !== get_post_status( $post->ID ) && ! has_post_thumbnail( $post->ID ) ) { ?>
        <div id="message" class="error">
            <p>
                <strong><?php _e( 'Please set a Featured Image. This post cannot be published without one.' ); ?></strong>
            </p>
        </div>
    <?php
    }
} );
