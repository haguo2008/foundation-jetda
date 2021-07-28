 <?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Foundation
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if(is_singular() && pings_open()) { ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' )); ?>">
<?php } ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	//wp_body_open hook from WordPress 5.2
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
?>
<a class="skip-link screen-reader-text" href="#main-container">
	<?php _e( 'Skip to content', 'foundations' ); ?>
</a>
    
<header id="header">
	<div class="header-inner grid-container">	
		<div class="site-branding logo">
			<?php the_custom_logo(); ?>
				<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_attr(bloginfo( 'name' )); ?></a></h1>
			<?php $description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p><?php echo esc_html($description); ?></p>
			<?php endif; ?>
		</div>
		<div class="toggle">
			<a class="toggleMenu" href="#"><?php esc_html_e('Menu','foundations'); ?></a>
		</div>					
		<div class="header-right-wrapper main-nav">
			<?php wp_nav_menu( 
					array(
						'theme_location' 	   => 'primary',
						'container' 	 	   => 'ul',
						'menu_id'              => 'primary'
					) 
			); 
			?>							
		</div>						
		<div class="clear"></div>				
	</div><!-- header-inner -->               
</header><!-- header -->
<div id="main-container" class="grid-container">  