<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>

<?php

	// get content vars for use in templating below
	$content_link = drupal_get_path_alias('node/' . $row->nid);
	$month = date('M', strtotime($row->field_field_date[0]['raw']['value']));
	$day = date('j', strtotime($row->field_field_date[0]['raw']['value']));
	$start_time = date('g:iA', strtotime($row->field_field_date[0]['raw']['value']));
	$end_time = date('g:iA', strtotime($row->field_field_date[0]['raw']['value2']));
	$img_url = image_style_url('large', $row->field_field_heading_image[0]['rendered']['#item']['uri']);

?>

<?php print "<div class='event'>"; ?>
	<?php print "<a href='$content_link'><div class='banner'>"; ?>
		<?php print "<div class='content' style='background: url($img_url) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;'>"; ?>
			<?php print "<div class='date'>"; ?>
				<?php print "<span class='month'>$month</span>"; ?>
				<?php print "<span class='day'>$day</span>"; ?>
			<?php print "</div>"; ?>
		<?php print "</div>"; // end .content ?>
	<?php print "</div></a>"; // end .banner ?>
	<?php print "<div class='details'>"; ?>
		<?php print "<a href='$content_link'>" . ($row->node_title) . "</a>"; ?>
		<?php if($start_time != $end_time): ?>
			<?php print "<span>" . $start_time . " - " . $end_time . "</span>"; ?>
		<?php else: ?>
			<?php print "<span>" . $start_time . "</span>"; ?>
		<?php endif; ?>
		<?php print "<a class='more-info' href='$content_link'>Learn More</a>"; ?>
	<?php print "</div>"; // end .details ?>
<?php print "</div>"; // end .event ?>

<!-- default views templating left in place in order to use contextual links -->
<?php foreach ($fields as $id => $field): ?>
  <?php if (!empty($field->separator)): ?>
    <?php print $field->separator; ?>
  <?php endif; ?>

  <?php print $field->wrapper_prefix; ?>
    <?php print $field->label_html; ?>
    <?php print $field->content; ?>
  <?php print $field->wrapper_suffix; ?>
<?php endforeach; ?>
