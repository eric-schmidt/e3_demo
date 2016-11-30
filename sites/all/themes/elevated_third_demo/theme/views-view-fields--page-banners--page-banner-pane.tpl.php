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

	$title = $row->node_title;
	$tagline = $row->field_field_tagline[0]['rendered']['#markup'];
	$img_url = image_style_url('x-large', $row->field_field_heading_image[0]['rendered']['#item']['uri']);

?>

<?php print "<div class='page-heading'>"; ?>
	<?php print "<div class='text-container'>"; ?>
		<?php print "<div class='text'>"; ?>
			<?php print "<h1>" . $title . "</h1>"; ?>
			<?php print "<p>" . $tagline . "</p>"; ?>
		<?php print "</div>"; // end .text ?>
	<?php print "</div>"; // end .text-container ?>
	<?php print "<div class='image' style='background: url($img_url) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;min-height:300px;display:block;'></div>"; ?>
<?php print "</div>"; // end .page-heading ?>

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
