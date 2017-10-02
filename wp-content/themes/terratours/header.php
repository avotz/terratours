<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package terratours
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link href='http://fonts.googleapis.com/css?family=ABeeZee|Open+Sans:400,300,700|Roboto+Slab' rel='stylesheet' type='text/css'>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

        <header class="header">
                
                <div class="inner">
					<?php wp_nav_menu( array(
						'theme_location' => 'header',
						'menu_id' => 'header-menu',
						'container'       => 'nav',
						'container_class' => 'header-menu',
						'container_id'    => '',
						'menu_class'      => 'header-menu-ul',
						) 
					); 
					?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo"><img src="<?php echo get_template_directory_uri();  ?>/img/logo.png" alt="Terra Tours" /></a>

                   
                    <button id="btn-menu" class="header-btn-menu"><i class="fa fa-bars"></i></button>
                </div>
            
                
               
            
        </header>