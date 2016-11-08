<?php
/**
 * Grupo Supricel functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Grupo_Supricel
 */

if ( ! function_exists( 'grupo_supricel_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function grupo_supricel_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Grupo Supricel, use a find and replace
	 * to change 'grupo-supricel' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'grupo-supricel', get_template_directory() . '/languages' );

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
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header' => esc_html__( 'Topo', 'grupo-supricel' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'grupo_supricel_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'grupo_supricel_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function grupo_supricel_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'grupo_supricel_content_width', 640 );
}
add_action( 'after_setup_theme', 'grupo_supricel_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function grupo_supricel_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'grupo-supricel' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Adicione widgets aqui.', 'grupo-supricel' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'grupo_supricel_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function grupo_supricel_scripts() {
	wp_enqueue_style( 'grupo-supricel-style', get_stylesheet_uri() );

	wp_enqueue_script( 'grupo-supricel-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'grupo-supricel-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'grupo_supricel_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Register "footer" custom post type with "Categoria" custom taxonomy
 */
add_action("init", "footerPostType");
function footerPostType() {
	
	// Registering new Custom Post Type
	$labels_post = array( 
		"name" => "Conteúdo Footer",
		"singular_name" => "Conteúdo Footer",
		
	);
	$args_post = array(
		"labels" => $labels_post,
		"supports" => array("title", "editor", "thumbnail"),
		"menu_position" => 20,
		"menu_icon" => "dashicons-media-default",
		"public"	=> true,
		"show_in_menu"	=> true,
	);
	register_post_type("footer", $args_post);
	
	// Registering new Taxonomy
	$labels_taxonomy = array( "name" => "Categorias do Footer", "singular_name" => "Categoria do Footer");
	$args_taxonomy = array(
		"labels"	=> $labels_taxonomy,
		"show_ui"	=> true,
		"show_in_menu"	=> true,
		"show_tagcloud"	=> false,
		'show_admin_column' => true,
		"hierarchical"	=> true,
		"capabilities"	=> array("manage_terms", "edit_terms", "delete_terms", "assign_terms"),
	);
	register_taxonomy("footer-categorias", "footer", $args_taxonomy);
	
}

/**
 * Register "home" custom post type with "Categoria" custom taxonomy
 */
add_action("init", "homePostType");
function homePostType() {
	
	// Registering new Custom Post Type
	$labels_post = array( 
		"name" => "Conteúdo Home",
		"singular_name" => "Conteúdo Home",
		
	);
	$args_post = array(
		"labels" => $labels_post,
		"supports" => array("title", "editor", "thumbnail"),
		"menu_position" => 21,
		"menu_icon" => "dashicons-media-default",
		"public"	=> true,
		"show_in_menu"	=> true,
	);
	register_post_type("home", $args_post);
	
	// Registering new Taxonomy
	$labels_taxonomy = array( "name" => "Categorias da Home", "singular_name" => "Categoria da Home");
	$args_taxonomy = array(
		"labels"	=> $labels_taxonomy,
		"show_ui"	=> true,
		"show_in_menu"	=> true,
		"show_tagcloud"	=> false,
		'show_admin_column' => true,
		"hierarchical"	=> true,
		"capabilities"	=> array("manage_terms", "edit_terms", "delete_terms", "assign_terms"),
	);
	register_taxonomy("home-categorias", "home", $args_taxonomy);
	
}

/**
 * Register "Complementos" custom post type with "Categoria" custom taxonomy
 */
add_action("init", "complementosPostType");
function complementosPostType() {
	
	// Registering new Custom Post Type
	$labels_post = array( 
		"name" => "Complementos",
		"singular_name" => "Complemento",
		
	);
	$args_post = array(
		"labels" => $labels_post,
		"supports" => array("title", "editor", "thumbnail"),
		"menu_position" => 22,
		"menu_icon" => "dashicons-plus",
		"public"	=> true,
		"show_in_menu"	=> true,
	);
	register_post_type("complementos", $args_post);
	
	// Registering new Taxonomy
	$labels_taxonomy = array( "name" => "Categorias de Complementos", "singular_name" => "Categoria de Complementos");
	$args_taxonomy = array(
		"labels"	=> $labels_taxonomy,
		"show_ui"	=> true,
		"show_in_menu"	=> true,
		'show_admin_column' => true,
		"show_tagcloud"	=> false,
		"hierarchical"	=> true,
		"capabilities"	=> array("manage_terms", "edit_terms", "delete_terms", "assign_terms"),
	);
	register_taxonomy("complementos-categorias", "complementos", $args_taxonomy);
	
}

/**
 * Register "Carrossel" custom post type with "Categoria" custom taxonomy
 */
add_action("init", "carrosselPostType");
function carrosselPostType() {
	
	// Registering new Custom Post Type
	$labels_post = array( 
		"name" => "Carrosséis",
		"singular_name" => "Carrossel",
		
	);	
	$args_post = array(
		"labels" => $labels_post,
		"supports" => array("title", "editor", "thumbnail"),
		"menu_position" => 23,
		"menu_icon" => "dashicons-format-gallery",
		"public"	=> true,
		"publicly_queryable" => true,
		"show_in_menu"	=> true,
	);
	register_post_type("carrossel", $args_post);
	
	// Registering new Taxonomy
	$labels_taxonomy = array(
		"name" => "Categorias de Carrosséis",
		"singular_name" => "Categoria de Carrosséis",
	);
	$args_taxonomy = array(
		"labels"	=> $labels_taxonomy,
		"show_ui"	=> true,
		"show_in_menu"	=> true,
		"show_tagcloud"	=> false,
		'show_admin_column' => true,
		"hierarchical"	=> true,
		"capabilities"	=> array("manage_terms", "edit_terms", "delete_terms", "assign_terms"),
	);
	register_taxonomy("carrossel-categorias", "carrossel", $args_taxonomy);
	
}