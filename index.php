<?php 
get_header(); ?>


 <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><h1><?php echo __('Welcome to our Blog !','funiversity'); ?></h1></h1>
      <div class="page-banner__intro">
        <p><?php  echo __('Keep up with our latest news','funiversity'); ?></p>
      </div>
    </div>  
  </div>



<?php get_footer();

 ?>