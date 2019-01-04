<?php
/**
 * The template for displaying Home pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

	<section class="containter hero-carousel">
		<?php get_template_part( 'loop-templates/content', 'carousel' ); ?>
	</section>
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<section>
			<?php get_template_part( 'sidebar-templates/sidebar-herocanvas' ); ?>


			<main class="site-main" id="main">


				<?php while ( have_posts() ) : the_post(); ?>

					<div class="col-md-8 offset-md-2">
					<?php get_template_part( 'loop-templates/content', 'home' ); ?>
					</div>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
			<?php get_template_part( 'sidebar-templates/sidebar-statichero' ); ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
