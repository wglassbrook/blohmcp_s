<?php
/**
 * The template for displaying search forms in BlohmCP_s
 *
 * @package BlohmCP_s
 * @since BlohmCP_s 1.0
 */
?>
	<form class="form-search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'blohmcp_s' ); ?></label>
		<input type="text"  name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'blohmcp_s' ); ?>" />
		<button type="submit" class="btn submit" name="submit" id="searchsubmit">Search</button>
	</form>
