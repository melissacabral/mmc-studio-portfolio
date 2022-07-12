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
          <a href="<?php echo home_url(); ?>">
            <?php bloginfo( 'name' ); ?>
          </a>
        </h1>
        <h2><?php bloginfo( 'description' ); ?></h2>
      </div>
      <div class="navigation">
        <nav class="main-menu">
          <ul>
            <?php 
            wp_list_pages( array(
              'title_li' => '',
            ) ); 
            ?>
          </ul>
        </nav>
      </div>
      <div class="utilities">
        <!-- Utility menu will go here -->
      </div>
      <?php get_search_form(); ?>
  </header>