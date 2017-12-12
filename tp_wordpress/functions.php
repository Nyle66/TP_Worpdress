<?php
/**
 * TP_Wordpress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TP_Wordpress
 */

if ( ! function_exists( 'tp_wordpress_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tp_wordpress_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on TP_Wordpress, use a find and replace
		 * to change 'tp_wordpress' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tp_wordpress', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'tp_wordpress' ),
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
		add_theme_support( 'custom-background', apply_filters( 'tp_wordpress_custom_background_args', array(
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
add_action( 'after_setup_theme', 'tp_wordpress_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tp_wordpress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tp_wordpress_content_width', 640 );
}
add_action( 'after_setup_theme', 'tp_wordpress_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tp_wordpress_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tp_wordpress' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tp_wordpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Right Sidebar',
		'id'            => 'right_sidebar',
		'description'   => 'sidebar de droite',
		'before_widget' => '<div class="right-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="right-widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'tp_wordpress_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

// add_action("wp_enqueue_scripts", "fct");
// function fct(){
//     wp_enqueue_script('script', plugin_dir_url('../') . '/plugins/pop/script.js', array('jquery'));
//     wp_enqueue_style( 'avis_style', plugin_dir_url( '../' ) . '/plugins/pop/style.css');
// }
function tp_wordpress_scripts() {
	wp_enqueue_style( 'tp_wordpress-style', get_stylesheet_uri() );

	wp_enqueue_script( 'tp_wordpress-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'tp_wordpress-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tp_wordpress_scripts' );

function color_theme_scripts() {
	wp_enqueue_style( 'color_theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'color_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'color_theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'color_theme_scripts' );

function load_js(){
    wp_enqueue_script("colorjs", get_template_directory_uri()."/js/jscolor.js");
}

add_action("wp_enqueue_scripts", "load_js");

function load_js2(){
    wp_enqueue_script("colorjs", get_template_directory_uri()."/js/jscolor.js");
}

add_action("admin_enqueue_scripts", "load_js2");

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


// CHANGE PAGE

add_action("admin_menu", "generate_theme_menu");
add_action("admin_init", "add_option_home_category");

function add_option_home_category(){
	add_option("custom_colors", []);
	
}


function generate_theme_menu(){
	add_menu_page(
		"Jeremy Theme",
		"Jeremy Theme",
		"administrator",
		"jeremy_theme_menu",
		"generate_theme_menu_page",
		"dashicons-admin-generic",
		50
	);
}

function generate_theme_menu_page(){

	if(isset($_POST["color_h"]) && isset($_POST["color_c"]) && isset($_POST["color_f"])){
		$colors = [
			"headers" => $_POST["color_h"],
			"body" => $_POST["color_c"],
			"page" => $_POST["color_p"],
			"background" => $_POST["color_f"],
		];
		update_option("custom_colors", $colors);
	}

	$colors_val = [
		"headers" => [],
		"body" => "",
		"page" => "",
		"background" => "",
	];
	if(get_option("custom_colors")){
		$colors_val = get_option("custom_colors");
		
	}
	?>
	
	<h1> Administration de Jeremy </h1>

	<form method="post">

		<label>
			<span> <strong>Choix de la couleur à afficher : </strong></span><br><br>

			<?php 
				for($i=0; $i < 6; $i++){ ?>
					<label>
						<span> Couleur h<?= $i+1 ?> </span>
						<input class="jscolor" name="color_h[]" value="<?= $colors_val["headers"][$i] ?>" >
					</label><br>
				<?php } ?>

				<label>
					<span> Couleur paragraphe </span>
					<input class="jscolor" name="color_c" value="<?= $colors_val["body"] ?>">
				</label><br>

				<label>
					<span> Couleur fond Page</span>
					<input class="jscolor" name="color_p" value="<?= $colors_val["page"] ?>">
				</label><br>

				<label>
					<span> Couleur fond Html</span>
					<input class="jscolor" name="color_f" value="<?= $colors_val["background"] ?>">
				</label><br>
			
				
		</label>
		<input type="submit" value="Valider"><br><br>
	</form>
	
	


	
	<?php

	// function isSelected($value){
	// 	if($value == get_option("color_h")){
	// 		echo "selected";
	// 	}
	// }
	
	

	
}
function get_custom_styles(){
	$custom_colors = get_option("custom_colors");
	?>
	
	<style>
		<?php
            for ($i = 0 ; $i < 6 ; $i++){

                    echo "h".($i + 1)."{color: #".$custom_colors['headers'][$i]."}";
            }
        ?>
		p{
			color: #<?= $custom_colors["body"]?>;
		}
		#page{
			background-color: #<?= $custom_colors["page"]?>;
		}
		html{
			background-color: #<?= $custom_colors["background"]?>;
		}
	</style><?php
}

// SLIDER

add_action("wp_enqueue_scripts", "scriptJS");
function scriptJS(){
    wp_enqueue_script('my_custom_script', get_template_directory_uri() . '/js/script.js', array('jquery'));
}

add_action( "init", "slide_post_type");

function slide_post_type(){
    register_post_type("slide", [
        "label" => "Slide",
        "description" => "Un Slider Home Page",
        "show_in_menu" => true,
        "public" => true,
        "menu_position" => 2,
        "supports" => [
            "title",
            "thumbnail"
        ]
    ]);
}

add_shortcode("slider", "display_slider");

function display_slider($atts){
    $slide = new WP_Query( [
        "post_type" => "slide"
    ]);
    $slide_html = "<div id='slide'>";
    if($slide->have_posts()){
        while($slide->have_posts()){

            $slide->the_post();
            $thumbnail = get_the_post_thumbnail_url(null, "medium");

            $slide_html .= "<div class='all_slide'><img src='" . $thumbnail . "' />";
            $slide_html .= "</div>";
            
        }
	}
    $slide_html .= "</div>";
    return $slide_html;
}

