<?php
/**
 * The Template for displaying all single posts.
 *
 * @package BlohmCP_s
 * @since BlohmCP_s 1.0
 */

get_header(); ?>
<!-- single.php -->

<div class="row-fluid">

	<section id="primary" class="content-area span8">
		<div id="content" class="site-content" role="main">
			<?php if ( function_exists('yoast_breadcrumb') ) {
            	$breadcrumbs = yoast_breadcrumb( '<ul class="breadcrumb"><li>', '</li></ul>', false );
            	echo str_replace( '|', '<span class="divider">/</span></li><li>', $breadcrumbs );
            } ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php blohmcp_s_content_nav( 'nav-above' ); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php blohmcp_s_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content .site-content -->
	</section><!-- #primary .content-area -->

	<?php get_sidebar(); ?>
	
</div>
		
<?php get_footer(); ?>