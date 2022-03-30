<?php
// Add Meta Box to post
add_action('admin_init', 'single_rapater_meta_boxes', 2);

function single_rapater_meta_boxes() {
	add_meta_box( 'single-repeter-data', 'Single Rapeter', 'single_repeatable_meta_box_callback', 'post', 'normal', 'default');
}

function single_repeatable_meta_box_callback($post) {

	$single_repeter_group = get_post_meta($post->ID, 'single_repeter_group', true);
	$banner_img = get_post_meta($post->ID,'post_banner_img',true);
	wp_nonce_field( 'repeterBox', 'formType' );
	?>
	<script type="text/javascript">
		jQuery(document).ready(function( $ ){
			$( '#add-row' ).on('click', function() {
				var row = $( '.empty-row.custom-repeter-text' ).clone(true);
				row.removeClass( 'empty-row custom-repeter-text' ).css('display','table-row');
				row.insertBefore( '#repeatable-fieldset-one tbody>tr:last' );
				return false;
			});

			$( '.remove-row' ).on('click', function() {
				$(this).parents('tr').remove();
				return false;
			});
		});

	</script>

	<table id="repeatable-fieldset-one" width="100%">
		<tbody>
			<?php
			if ( $single_repeter_group ) :
				foreach ( $single_repeter_group as $field ) {
					?>
					<tr>
						<td><input type="text"  style="width:98%;" name="title[]" value="<?php if($field['title'] != '') echo esc_attr( $field['title'] ); ?>" placeholder="Heading" /></td>
						<td><input type="text"  style="width:98%;" name="tdesc[]" value="<?php if ($field['tdesc'] != '') echo esc_attr( $field['tdesc'] ); ?>" placeholder="Description" /></td>
						<td><a class="button remove-row" href="#1">Remove</a></td>
					</tr>
					<?php
				}
			else :
				?>
				<tr>
					<td><input type="text"   style="width:98%;" name="title[]" placeholder="Heading"/></td>
					<td><input type="text"  style="width:98%;" name="tdesc[]" value="" placeholder="Description" /></td>
					<td><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
				</tr>
			<?php endif; ?>
			<tr class="empty-row custom-repeter-text" style="display: none">
				<td><input type="text" style="width:98%;" name="title[]" placeholder="Heading"/></td>
				<td><input type="text" style="width:98%;" name="tdesc[]" value="" placeholder="Description"/></td>
				<td><a class="button remove-row" href="#">Remove</a></td>
			</tr>
			
		</tbody>
	</table>
	<p><a id="add-row" class="button" href="#">Add another</a></p>
	<?php
}

// Save Meta Box values.
add_action('save_post', 'single_repeatable_meta_box_save');

function single_repeatable_meta_box_save($post_id) {

	if (!isset($_POST['formType']) && !wp_verify_nonce($_POST['formType'], 'repeterBox'))
		return;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;

	if (!current_user_can('edit_post', $post_id))
		return;

	$old = get_post_meta($post_id, 'single_repeter_group', true);

	$new = array();
	$titles = $_POST['title'];
	$tdescs = $_POST['tdesc'];
	$count = count( $titles );
	for ( $i = 0; $i < $count; $i++ ) {
		if ( $titles[$i] != '' ) {
			$new[$i]['title'] = stripslashes( strip_tags( $titles[$i] ) );
			$new[$i]['tdesc'] = stripslashes( $tdescs[$i] );
		}
	}

	if ( !empty( $new ) && $new != $old ){
		update_post_meta( $post_id, 'single_repeter_group', $new );
	} elseif ( empty($new) && $old ) {
		delete_post_meta( $post_id, 'single_repeter_group', $old );
	}
	$repeter_status= $_REQUEST['repeter_status'];
	update_post_meta( $post_id, 'repeter_status', $repeter_status );
}
