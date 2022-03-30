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

<!-- Complete code :: start -->

add_action( 'admin_init',  'deep_register_setting' );

function misha_register_setting(){

	register_setting(
		'deep_settings', // settings group name
		'homepage_text', // option name
		'sanitize_text_field' // sanitization function
	);

	add_settings_section(
		'some_settings_section_id', // section ID
		'', // title (if needed)
		'', // callback function (if needed)
		'deep-slug' // page slug
	);

	add_settings_field(
		'homepage_text',
		'Homepage text',
		'deep_text_field_html', // function which prints the field
		'deep-slug', // page slug
		'some_settings_section_id', // section ID
		array( 
			'label_for' => 'homepage_text',
			'class' => 'deep-class', // for <tr> element
		)
	);

}

function deep_text_field_html(){

	$text = get_option( 'homepage_text' );

	printf(
		'<input type="text" id="homepage_text" name="homepage_text" value="%s" />',
		esc_attr( $text )
	);

}
<!-- Complete code :: End -->
