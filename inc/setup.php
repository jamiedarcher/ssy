<?php
/**
 * Theme basic setup.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

add_action( 'after_setup_theme', 'understrap_setup' );

if ( ! function_exists ( 'understrap_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function understrap_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on understrap, use a find and replace
		 * to change 'understrap' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'understrap', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * GUTENBERG THEME SUPPORT
		 * Add GUTENBERG specific theme settings
		 */
		 add_theme_support( 'align-wide' );
		 add_theme_support('editor-styles');
		 add_theme_support( 'wp-block-styles' );
		 add_theme_support( 'responsive-embeds' );
		 add_editor_style( '/css/custom-editor-style.css' );
		 add_theme_support( 'editor-color-palette', array(
		    array(
		        'name' => __( 'strong magenta', 'themeLangDomain' ),
		        'slug' => 'strong-magenta',
		        'color' => '#a156b4',
		    ),
		    array(
		        'name' => __( 'light grayish magenta', 'themeLangDomain' ),
		        'slug' => 'light-grayish-magenta',
		        'color' => '#d0a5db',
		    ),
		    array(
		        'name' => __( 'very light gray', 'themeLangDomain' ),
		        'slug' => 'very-light-gray',
		        'color' => '#eee',
		    ),
		    array(
		        'name' => __( 'very dark gray', 'themeLangDomain' ),
		        'slug' => 'very-dark-gray',
		        'color' => '#444',
		    ),
		) );

		add_theme_support( 'editor-font-sizes', array(
		    array(
		        'name' => __( 'small', 'themeLangDomain' ),
		        'shortName' => __( 'S', 'themeLangDomain' ),
		        'size' => 12,
		        'slug' => 'small'
		    ),
		    array(
		        'name' => __( 'regular', 'themeLangDomain' ),
		        'shortName' => __( 'M', 'themeLangDomain' ),
		        'size' => 16,
		        'slug' => 'regular'
		    ),
		    array(
		        'name' => __( 'large', 'themeLangDomain' ),
		        'shortName' => __( 'L', 'themeLangDomain' ),
		        'size' => 36,
		        'slug' => 'large'
		    ),
		    array(
		        'name' => __( 'larger', 'themeLangDomain' ),
		        'shortName' => __( 'XL', 'themeLangDomain' ),
		        'size' => 50,
		        'slug' => 'larger'
		    )
		) );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'understrap' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'understrap_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );

		// Check and setup theme default settings.
		understrap_setup_theme_default_settings();

	}
}


add_filter( 'excerpt_more', 'understrap_custom_excerpt_more' );

if ( ! function_exists( 'understrap_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function understrap_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}
}

add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );

if ( ! function_exists( 'understrap_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function understrap_all_excerpts_get_more_link( $post_excerpt ) {
		if ( ! is_admin() ) {
			$post_excerpt = $post_excerpt . ' <p><a class="btn btn-secondary understrap-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Read More',
			'understrap' ) . '</a></p>';
		}
		return $post_excerpt;
	}
}

// Simply remove anything that looks like an archive title prefix ("Archive:", "Foo:", "Bar:").
add_filter('get_the_archive_title', function ($title) {
    return preg_replace('/^\w+: /', '', $title);
});
