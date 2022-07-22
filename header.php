<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
 <?php wp_head(); //HOOK. required for plugins to work with the theme ?>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body <?php body_class(); ?>>
   <?php wp_body_open(); //hook. required for plugins to work ?>
   <div class="site">
    <header class="header" style="background-image:url(<?php echo header_image(); ?>)">
     <div class="branding"> 
      <?php the_custom_logo(); ?>
      <h1 class="site-title">
        <a href="<?php echo esc_url( home_url() ); ?>">
         <?php bloginfo( 'name' ); ?>
      </a>
   </h1>
   <h2><?php bloginfo( 'description' ); ?></h2>
</div>
<div class="navigation">
 <?php 
        //display one of our registered menu areas
 wp_nav_menu( array(
          'theme_location'  => 'main_nav',  //from functions.php
          'container'       => 'nav',       //div, nav or false
          'container_class' => 'main-menu', //<nav class="main-menu">
       ) ); ?>
    </div>
    <div class="utilities">
      <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> – <?php echo WC()->cart->get_cart_total(); ?></a>
       <?php dynamic_sidebar( 'header_utility' ); ?>
    </div>
    <?php get_search_form(); ?>
 </header>