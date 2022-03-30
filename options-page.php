<!-- Add this code in functions.php -->

add_action( 'admin_menu', 'deep_options_page' );

function deep_options_page() {

	add_options_page(
		'My Page Title', // page <title>Title</title>
		'My Page', // menu link text
		'manage_options', // capability to access the page
		'deep-slug', // page URL slug
		'deep_page_content', // callback function with content
		2 // priority
	);

}

function deep_page_content(){

	echo 'Welcome to options page!';

}
