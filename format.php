<?php
	$custom_fields = get_post_custom();
	
	if ( has_post_format( 'gallery' ) ) :

		the_content(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blohmcp_s' ));

		$gallery_shortcode = '[gallery id="' . intval( $post->post_parent ) . '"]';?>
		<section class="content-gallery">
			<?php print apply_filters( 'the_content', $gallery_shortcode );?>
		</section>
		
    <?php elseif ( has_post_format( 'video' ) ) :
    
		$video_custom_field = $custom_fields['_format_video_embed'];
		foreach ( $video_custom_field as $key => $value )
		$vidurl = $value;

		if($vidurl):
		    $shortcode = '[embed]'.$vidurl.'[/embed]';
		    global $wp_embed;
		    echo $wp_embed->run_shortcode($shortcode);
		endif;
		
		the_content(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blohmcp_s' ));
        
    elseif ( has_post_format( 'image' ) ) :

		echo get_the_post_thumbnail($page->ID, 'large');
		
		the_content(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blohmcp_s' ));
		
    elseif ( has_post_format( 'quote' ) ) :

		$source_custom_field = $custom_fields['_format_quote_source_name'];
		foreach ( $source_custom_field as $key => $value )
		$source = $value;
		$sourceurl_custom_field = $custom_fields['_format_quote_source_url'];
		foreach ( $sourceurl_custom_field as $key => $value )
		$sourceurl = $value;?>
		
		<quote class="entry-quote">
		<?php the_content(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blohmcp_s' ));
		
		if($source):
			echo '<cite class="entry-cite">';
				if($sourceurl):?>
					<a href="<?php echo $sourceurl;?>" title="<?php echo $source;?>"><?php echo $source; ?></a>
				<?php else:
					echo $source;
				endif;
			echo '</cite>';
		endif;?>
		
		</quote>
    <?php else :
    
		the_content(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blohmcp_s' ));
    
        // big block of similar HTML to format other posts
    endif;
    
?>