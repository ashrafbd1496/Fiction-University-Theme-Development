<?php get_header();
 pageBanner(array(
     // page title and susbtitle can be returnfrom here
      'title' => 'Search Results',
      'subtitle'  => 'You Searched for &ldquo;'.get_search_query(). '&rdquo;',
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
      while (have_posts()) {
        the_post();?>

        <div class="post-item">
          <h3 class="headline headline--small-plus headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
        </div>

        <div class="metabox">
         <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
        </div>

        <div class="generic-content">
          <?php echo the_excerpt(); ?>
          <p><a class="btn btn--small btn--blue" href="<?php the_permalink(); ?>">Continue Reading &raquo;</a></p>
        </div>

     <?php } 
     echo paginate_links();
     ?>
   </div>
<?php get_footer(); ?>