<header class="banner navbar navbar-default navbar-fixed-top" role="banner">
	<div class="container mainnav-container">
    	<div class="language-menu clearfix">
            <div class="subscribe-container" style=""><a id="toggle_connect" href="javascript:;">STAY CONNECTED</a><span>|</span><a href="#">Enquiries/Order</a></div>
            <div class="" style="float:left;">ENG<span>|</span>繁<span>|</span>簡</div>
        </div>
    	<div class="navbar-header">
        	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            	<span class="sr-only">Toggle navigation</span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            </button>
          	<a href="javascript:;" class="menu-label hidden-xs hidden-sm hidden-md hidden-lg" data-toggle="collapse" data-target=".navbar-collapse">menu</a>
            <a class="navbar-brand" href="<?php echo home_url(); ?>/"><img class="img-responsive" src="<?=get_stylesheet_directory_uri()?>/assets/img/logo-top.png"></a>
         </div>
         <div class="nav-container clearfix">
         	<?
            	//new Roots_Nav_Walker()
			?>
            <nav class="collapse navbar-collapse main-menu hidden-md hidden-lg mobile-menu row" role="navigation">
				<?php //Main menu
					if (has_nav_menu('primary_navigation')) :
						wp_nav_menu(array(
							'theme_location' => 'primary_navigation', 
							'menu_class' => 'nav navbar-nav', 
							'depth' => 3,
							'walker' => new Roots_Nav_Walker()
						));
					endif;
				?>
            </nav>
         	<nav class="collapse navbar-collapse main-menu desktop-menu hidden-xs hidden-sm" role="navigation">
				<?php //Main menu
					if (has_nav_menu('primary_navigation')) :
					wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav', 'depth' => 3));
					endif;
				?>
            </nav>
            <div class="searchBox-container clearfix">
	            <?php get_search_form(); ?>
            </div>
         </div>
	</div>
</header>
