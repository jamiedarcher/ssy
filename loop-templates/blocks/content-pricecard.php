<?php
/**
 * Block Name: Testimonial
 *
 * This is the template that displays the testimonial block.
 */

// get image field (array)
$avatar = get_field('avatar');

// create id attribute for specific styling
$id = 'price-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<blockquote id="<?php echo $id; ?>" class="price <?php echo $align_class; ?>">
    <p><?php the_field('price_card'); ?></p>
    <cite>
    	<img src="<?php echo $avatar['url']; ?>" alt="<?php echo $avatar['alt']; ?>" />
    	<span><?php the_field('author'); ?></span>
    </cite>
</blockquote>
<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php the_field('background_color'); ?>;
		color: <?php the_field('text_color'); ?>;
	}
</style>
