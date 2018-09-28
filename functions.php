<?php
/**
 * alexanne functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package alexanne
 */

if ( ! function_exists( 'alexanne_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function alexanne_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on alexanne, use a find and replace
		 * to change 'alexanne-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'alexanne-theme', get_template_directory() . '/languages' );

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
			'primary' => esc_html__( 'Primary', 'alexanne-theme' ),
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
		add_theme_support( 'custom-background', apply_filters( 'alexanne_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'alexanne_theme_setup' );

function alex_add_editor_style(){
    add_editor_style('dist/css/editor-style.css');
}
add_action('admin_init', 'alex_add_editor_style');


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function alexanne_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'alexanne_theme_content_width', 1140 );
}
add_action( 'after_setup_theme', 'alexanne_theme_content_width', 0 );


function annonce_post_type(){
    $labels = array(
		'name' => _x('Annonces', 'Post Type General Name', 'theme-personnalise'),
		'singular_name' =>_x('Annonce', 'Post Type Singular Name', 'theme-personnalise'),
		'menu_name' => __( 'Annonces', 'theme-personnalise'),
		'parent_item_colon' => __( 'Parent Annonce', 'theme-personnalise'),
		'all_items' => __( 'Toutes les Annonces', 'theme-personnalise'),
		'view_item' => __( 'Voir une Annonce', 'theme-personnalise'),
		'add_new_item' => __( 'Ajouter une nouvelle Annonce', 'theme-personnalise'),
		'add_new' => __( 'Ajouter nouvelle', 'theme-personnalise'),
		'edit_item' => __( 'Editer Annonce', 'theme-personnalise'),
		'update_item' => __( 'Mettre à jour Annonce', 'theme-personnalise'),
		'search_items' => __( 'Rechercher Annonce', 'theme-personnalise'),
		'not_found' => __( 'Non trouvé', 'theme-personnalise'),
		'not_found_in_trash' => __( 'Non trouvé dans la corbeille', 'theme-personnalise'),
		);
		// On définit les autres options pour le post personnalisé
$args = array(
	'label' => __( 'Annonces', 'theme-personnalise'),
	'description' => __('Nouveautés sur le marché immobilié! Ventes et Locations', 'theme-personnalise'),
	'labels' => $labels,
	// On peut l'éditer dans l'éditeur de posts, définir un résumé, des champs personnalisés, ..
	'supports' => array( 'title', 'editor', 'excerpt', 'author',
	'thumbnail', 'comments', 'revisions', 'custom‐fields', ),
	// On l'associe avec une taxonomie (ici genres).
	'taxonomies' => array( 'genres' ),
	/* Un post personnalisé hiérarchique est comme une Page et peut avoir un
	Parent et des enfants. Un PP non‐hiérarchique est comme un article. */
	'hierarchical' => false,
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	'show_in_nav_menus' => true,
	'show_in_admin_bar' => true,
	'menu_position' => 5,
	'can_export' => true,
	'has_archive' => true,
	'exclude_from_search' => false,
	'publicly_queryable' => true,
	'capability_type' => 'page',
	);
	// Enregistrer le Type de Post personnalisé
	register_post_type( 'Annonces', $args );
}
	/* Utiliser le hook 'init' pour exécuter l’action d’enregistrement du
	* Type personnalisé.
	*/

add_action( 'init', 'annonce_post_type', 0 );




	/*
 	*  Taxonomie pour les annonces immobilieres 
	*  
	*/

	function define_type_annonce_taxonomy(){
		
		register_taxonomy(
			'type',
			'annonces',
			array(
				'hierarchical' => true,
				'label' => 'Genre',
				'query_var' => true,
				'rewrite' => true
			)
		);
	}






/**
 * Enqueue scripts and styles.
 */
function alexanne_theme_scripts() {
    
    wp_enqueue_style('alexanne-theme-bs-css', get_template_directory_uri() . '/dist/css/bootstrap.min.css');
    wp_enqueue_style('alexanne-theme-fontawesome', get_template_directory_uri() . '/fonts/fontawesome/css/fontawesome.min.css');
    
	wp_enqueue_style( 'alexanne-theme-style', get_stylesheet_uri() );

    // makes the file come from cdn and the last true arg assures that js loads after footer to prevent load issues
    wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/popper.min.js', false, '', true);
    wp_enqueue_script('popper');
    
    // wp_enqueue_script( 'alexanne-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

    
	wp_enqueue_script( 'alexanne-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'alexanne_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

