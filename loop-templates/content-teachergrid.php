<?php
/**
 * Teacher bio partial template for the grid.
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

<?php if ( is_post_type_archive() ) {
	echo '<header class="bio-header" style="background-image:url('.$bioImg[0].')">';
	} else {
	//everything else
	echo '<header class="bio-header">';
	}
?>
<?php if (is_singular( 'teacher_bio' ) ) {
	echo get_the_post_thumbnail( $post->ID, 'full' );
	} ?>

	<?php	the_title( '<h2 class="bio-title">', '</h2>' ); ?>
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
