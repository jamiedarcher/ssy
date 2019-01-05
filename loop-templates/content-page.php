<?php
/**
 * Partial template for content in page.php
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
	

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>


	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
