<?php get_header();
 pageBanner(array(
     // page title and susbtitle can be returnfrom here
      'title' => 'Search Results',
      'subtitle'  => 'You Searched for &ldquo;'.esc_html(get_search_query(false)). '&rdquo;',
      'photo' => 'https://images.unsplash.com/photo-1553851684-3037dd0507c9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MjB8fGZpY3Rpb24lMjB1bml2ZXJzaXR5fGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60',
    ));
    ?>
<!--  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);">
    </div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo __('Welcome to our Blog !','funiversity'); ?></h1>
      <div class="page-banner__intro">
        <p><?php  echo __('Keep up with our latest news','funiversity'); ?></p>
      </div>
    </div>  
  </div> -->
   <div class="container container--narrow page-section">
    <?php 
    if (have_posts()) {
      while (have_posts()) {
        the_post();
        get_template_part('template-parts/content', get_post_type());
        ?>
     <?php } 
     echo paginate_links();
    }else{
      echo '<h2 class="headline headline--samll-plus">No Search Result Match that Search !</h2>';
    }
      
     ?>
<?php get_footer(); ?>