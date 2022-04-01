<!-- Adding custom columns to custom post types (Note: Add this code in functions.php)  -->

<!-- manage_[post_type]_posts_custom_column (Note:Replace post type with your own post type) -->

<?php
// Add the custom columns to the book post type:
add_filter( 'manage_book_posts_columns', 'set_custom_edit_book_columns' );
function set_custom_edit_book_columns($columns) {
    unset( $columns['author'] );
    $columns['book_author'] = __( 'Author', 'your_text_domain' );
    $columns['publisher'] = __( 'Publisher', 'your_text_domain' );

    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_book_posts_custom_column' , 'custom_book_column', 10, 2 );
function custom_book_column( $column, $post_id ) {
    switch ( $column ) {

        case 'book_author' :
            $terms = get_the_term_list( $post_id , 'book_author' , '' , ',' , '' );
            if ( is_string( $terms ) )
                echo $terms;
            else
                _e( 'Unable to get author(s)', 'your_text_domain' );
            break;

        case 'publisher' :
            echo get_post_meta( $post_id , 'publisher' , true ); 
            break;

    }
}
?>
