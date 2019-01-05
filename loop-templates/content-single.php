<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php /* grab the url for the full size featured image */
	$postCover = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	?>
	<?php
		echo '<header class="entry-header alignfull" style="background-image:url('.$postCover[0].')">';
	?>



	</header><!-- .entry-header -->

	<div class="offset-container">
	<div class="entry-meta">

		<?php understrap_posted_on(); ?>

	</div><!-- .entry-meta -->

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>



	<div class="entry-content">

		<?php
			$link = get_field('cta_link');
			if( $link ):
			$link_url = $link['url'];
			$link_title = $link['title'];
			$link_target = $link['target'] ? $link['target'] : '_self';
			?>
			<a class="btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
		<?php endif; ?>
		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->
</div>
</article><!-- #post-## -->
