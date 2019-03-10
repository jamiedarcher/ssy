<?php
/**
 * Therapy bio partial template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php /* grab the url for the full size featured image */
$bioImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<?php
	echo '<header class="bio-header alignfull" style="background-image:url('.$bioImg[0].')">';
?>



	<?php	the_title( '<h2 class="bio-title">', '</h2>' ); ?>

	<a class="bio-link" href=""></a>
	</header><!-- .entry-header -->



	<div class="entry-content">

		<?php if ( is_post_type_archive() ) {
				  // Default Listing page
					the_excerpt();
				} else {
				  //everything else
					the_content();
				}  ?>

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

</article><!-- #post-## -->
