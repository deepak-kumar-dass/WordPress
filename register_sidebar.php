<!-- This example creates a sidebar named “Main Sidebar” with and before and after the title. -->

/**
 * Add a sidebar.
 */

function wpdocs_theme_slug_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Main Sidebar', 'textdomain' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );

<!-- To output registered sidebar: -->

<?php if ( is_active_sidebar( 'your-sidebar-slug' ) ) { ?>
    <ul id="sidebar">
        <?php dynamic_sidebar('your-sidebar-slug'); ?>
    </ul>
<?php } ?>
