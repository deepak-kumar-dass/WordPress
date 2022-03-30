<!-- Create a custom top-level menu page : Add this code in functions.php  -->

add_action( 'admin_menu', 'deep_menu_page' );

function deep_menu_page() {

	add_menu_page(
		'My Page Title', // page <title>Title</title>
		'My Page', // menu link text
		'manage_options', // capability to access the page
		'deep-slug', // page URL slug
		'deep_page_content', // callback function /w content
		'dashicons-star-half', // menu icon
		5 // priority
	);

}

function deep_page_content(){

	echo 'What is up?';

}
