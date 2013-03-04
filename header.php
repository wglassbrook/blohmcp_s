<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package BlohmCP_s
 * @since BlohmCP_s 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<?php  
	if ( substr_count( $_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip' ) ) {  
	    ob_start( "ob_gzhandler" );  
	}  
	else {  
	    ob_start();  
	}  
	?>  
	
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	
	<!-- Google Chrome Frame for IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<!-- mobile meta (hooray!) -->
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
	
		wp_title( '|', true, 'right' );
	
		// Add the blog name.
		bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
		?>
	</title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php include (TEMPLATEPATH . '/inc/prime-nav.php'); ?>

<header class="jumbotron subhead">
	<div class="container">
		<h1>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<?php if(get_bloginfo( 'description' )){?>
		<p class="lead site-description"><?php bloginfo( 'description' ); ?></p>
		<?php }; ?>
	</div>
</header>
<div class="clearfix"></div>
<div id="page" class="hfeed site container">
