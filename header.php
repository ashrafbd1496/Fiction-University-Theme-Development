<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php bloginfo( 'name' ); ?></title>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header class="site-header">
      <!--
      <h1><?php bloginfo( 'name' ); ?></h1>
      <h4><?php bloginfo( 'description' ); ?></h4>
    -->
      <div class="container">

        <?php 
            if ( function_exists( 'the_custom_logo' ) ) {
                the_custom_logo();
                
                // $custom_logo_id = get_theme_mod( 'custom_logo' );
                // $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                 
                // if ( has_custom_logo() ) {
                //     echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                // } else {
                //     echo '<h1>' . get_bloginfo('name') . '</h1>';
                // }

            }

         ?>

        <!--<h1 class="school-logo-text float-left">
          <a href="<?php// echo site_url(); ?>"><strong><?php //echo __('Fictional','funiversity'); ?></strong><?php //echo __('University','funiversity') ?></a>
        </h1>
      -->

        <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
        <div class="site-header__menu group">
          <nav class="main-navigation">
            <ul>
              <?php 
                  wp_nav_menu(array(
                    'theme_location'  => 'HeaderMenuLocation',
                  ));
                 
               ?>
            </ul>
          </nav>
          <div class="site-header__util">
            <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
            <a href="#" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
            <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
          </div>
        </div>
      </div>
    </header>