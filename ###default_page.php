<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package BlohmCP_s
 * @since BlohmCP_s 1.0
 */
get_header(); ?>
<!-- page.php -->


<div class="row-fluid">

	<section id="primary" class="content-area span8">
		<div id="content" class="site-content" role="main">
			<?php if ( function_exists('yoast_breadcrumb') ) {
            	$breadcrumbs = yoast_breadcrumb( '<ul class="breadcrumb"><li>', '</li></ul>', false );
            	echo str_replace( '|', '<span class="divider">/</span></li><li>', $breadcrumbs );
            } ?>



				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

		</div><!-- #content .site-content -->
	</section><!-- #primary .content-area -->

	<?php get_sidebar(); ?>
	
</div>
		
<?php get_footer(); ?>