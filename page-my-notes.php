<?php 
if (!is_user_logged_in()) {
	wp_redirect(esc_url(site_url('/')));
	exit;
}

get_header();

  while(have_posts()) {
    the_post();
    pageBanner(array());
     ?>
    

  <div class="container container--narrow page-section">
  	custom code goes here
  </div>
    
  <?php } get_footer();?>