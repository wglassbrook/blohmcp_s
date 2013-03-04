<?php
/**
 * The template for displaying navbar search forms in BlohmCP_s
 *
 * @package BlohmCP_s
 * @since BlohmCP_s 1.0
 */
?>

<form class="navbar-search pull-right" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
  <input type="text" class="search-query" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'blohmcp_s' ); ?>" />
</form>