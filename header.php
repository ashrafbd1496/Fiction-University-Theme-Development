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
      <h1><?php //bloginfo( 'name' ); ?></h1>
      <h4><?php //bloginfo( 'description' ); ?></h4>
    -->
      <div class="container">
        <?php if (has_custom_logo()) {
         the_custom_logo();
        }else{ ?>

          <h1 class="school-logo-text float-left">
          <?php echo bloginfo('title');?>
        </h1>
      
        <?php } ?>
        

        <a href="<?php echo esc_url(site_url('/search')); ?>" class="js-search-trigger site-header__search-trigger">
          <i class="fa fa-search" aria-hidden="true"></i>
        </a>
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
            <a href="<?php echo esc_url(site_url('/search')); ?>" class="search-trigger js-search-trigger">
              <i class="fa fa-search" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </header>