<?php
	global $theme_option;

	echo '<div id="gdlr-header-substitute" ></div>';
	echo '<div class="gdlr-navigation-wrapper">';
	echo '<div class="gdlr-navigation-container container">';

	// navigation
	if( has_nav_menu('main_menu') ){
		if( class_exists('gdlr_menu_walker') ){
			echo '<nav class="gdlr-navigation" id="gdlr-main-navigation" role="navigation">';
			wp_nav_menu( array(
				'theme_location'=>'main_menu',
				'container'=> '',
				'menu_class'=> 'sf-menu gdlr-main-menu',
				'walker'=> new gdlr_menu_walker()
			) );
		}else{
			echo '<nav class="gdlr-navigation" role="navigation">';
			wp_nav_menu( array('theme_location'=>'main_menu') );
		}
?>
<?php
		echo '</nav>'; // gdlr-navigation
	}

	echo '<div class="clear"></div>';
	echo '</div>'; // gdlr-navigation-container
	echo '</div>'; // gdlr-navigation-wrapper
?>
