<?php
/**
 * BlohmCP_s functions and definitions
 *
 * @package BlohmCP_s
 * @since BlohmCP_s 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since BlohmCP_s 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'blohmcp_s_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since BlohmCP_s 1.0
 */
function blohmcp_s_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on BlohmCP_s, use a find and replace
	 * to change 'blohmcp_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'blohmcp_s', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'blohmcp_s' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // blohmcp_s_setup
add_action( 'after_setup_theme', 'blohmcp_s_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function blohmcp_s_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'blohmcp_s_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'blohmcp_s_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since BlohmCP_s 1.0
 */
function blohmcp_s_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'blohmcp_s' ),
		'id' => 'default-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'blohmcp_s_widgets_init' );


/**
 * Add Open Graph Metadata to head
 */

add_action('wp_head', 'add_fb_open_graph_tags');
function add_fb_open_graph_tags() {
	if (is_single()) {
		global $post;
		if(get_the_post_thumbnail($post->ID, 'thumbnail')) {
			$thumbnail_id = get_post_thumbnail_id($post->ID);
			$thumbnail_object = get_post($thumbnail_id);
			$image = $thumbnail_object->guid;
		} else {
			$image = get_template_directory_uri() . '/screenshot.png'; // Change this to the URL of the logo you want beside your links shown on Facebook
		}
		//$description = get_bloginfo('description');
		$description = my_excerpt( $post->post_content, $post->post_excerpt );
		$description = strip_tags($description);
		$description = str_replace("\"", "'", $description);
?>
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php echo $image; ?>" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<meta property="og:description" content="<?php echo $description ?>" />
<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
<?php 	}
}
/*
 * End FB Opengraph
 */

function my_excerpt($text, $excerpt){
    if ($excerpt) return $excerpt;
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', 55);
    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $words = preg_split("/[\n
	 ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
    } else {
            $text = implode(' ', $words);
    }
    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

/**
 * Add slide image size
 */
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'post-feature-img', 770, 120, true ); //(cropped)
}

/**
 * Enqueue scripts and styles
 */
function blohmcp_s_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/layouts/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-responsive', get_template_directory_uri() . '/layouts/bootstrap-responsive.min.css' );
	wp_enqueue_style( 'layout', get_template_directory_uri() . '/layouts/layout.css' );

	wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js','','',true);
    wp_enqueue_script( 'jquery' );

    wp_register_script( 'bootjs', get_template_directory_uri() . '/js/bootstrap.min.js','','',true);
    wp_enqueue_script( 'bootjs' );

    //wp_register_script( 'customizer', get_template_directory_uri() . '/js/customizer.js');
    //wp_enqueue_script( 'customizer' );

	//wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply','','',true );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202',true );
	}
}

add_action( 'wp_enqueue_scripts', 'blohmcp_s_scripts' );


/**
 * Adds old ass IE scripts
 */
function blohm_s_print_ie_scripts() {
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/selectivizr-min.js" type="text/javascript"></script>
	<![endif]-->
	<?php
}
add_action( 'wp_head', 'blohm_s_print_ie_scripts', 11 );

/**
 * Adds gzip compression
 
function blohm_s_gzip(){  
if ( substr_count( $_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip' ) ) {  
    ob_start( "ob_gzhandler" );  
}  
else {  
    ob_start();  
}  
}
add_action('wp_head', 'blohm_s_gzip',0);
*/
/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );

include (TEMPLATEPATH . '/inc/nav-menu-walker.php');



add_filter( 'embed_oembed_html', 'tdd_oembed_filter', 10, 4 ) ;
 
function tdd_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<figure class="video-container">'.$html.'</figure>';
    return $return;
}