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

<!-- Altenate way to register multiple sidebar widgets -->

/* Better way to add multiple widgets areas */
function widget_registration($name, $id, $description,$beforeWidget, $afterWidget, $beforeTitle, $afterTitle){
    register_sidebar( array(
        'name' => $name,
        'id' => $id,
        'description' => $description,
        'before_widget' => $beforeWidget,
        'after_widget' => $afterWidget,
        'before_title' => $beforeTitle,
        'after_title' => $afterTitle,
    ));
}
 
function multiple_widget_init(){
    widget_registration('Footer widget 1', 'footer-sidebar-1', 'test', '', '', '', '');
    widget_registration('Footer widget 2', 'footer-sidebar-2', 'test', '', '', '', '');
    // ETC...
}
 
add_action('widgets_init', 'multiple_widget_init');
