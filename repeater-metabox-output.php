<?php
// Use below code to show metabox values from anywhere
$id = get_the_ID();
$feture_template = get_post_meta($id, 'single_repeter_group', true);
if(!empty($feture_template)) {
	?>
	<table class="plugin-detail-tabl <?php echo $class; ?>" width="100%" cellspacing="0" cellpadding="0">
		<tbody>
			<?php  foreach ($feture_template as $item) { ?>
				<tr>
					<td style="width: 30%;"><?php echo $item['title']; ?></td>
					<td><?php echo $item['tdesc']; ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php
}
