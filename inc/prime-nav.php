<h1 class="assistive-text"><?php _e( 'Menu', '_s' ); ?></h1>
<div class="assistive-text skip-link">
		<a href="#content" title="<?php esc_attr_e( 'Skip to content', '_s' ); ?>"><?php _e( 'Skip to content', '_s' ); ?></a>
</div>
<nav role="navigation"  class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
  	<div class="container">
  	  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand hidden-desktop" href="#">Main Menu</a>
      <div class="nav-collapse collapse">
		<?php wp_nav_menu( array( 
			'container' => 'div',
			'container_class' => 'nav-collapse collapse',
			'theme_location' => 'primary',
			'menu_class' => 'nav',
			'depth'				=>	3,
			'fallback_cb'		=>	false,
			'walker' => new The_Bootstrap_Nav_Walker,									
			) );
			
			include (TEMPLATEPATH . '/inc/navbar-searchform.php');
		?>
      </div>
  	</div>
  </div>
</nav>
