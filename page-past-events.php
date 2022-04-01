<?php 
get_header(); ?>


 <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">
       <?php echo __(' Past Events','funiversity'); ?>
      </h1>
      <div class="page-banner__intro">
        <p><?php echo __('A recap of our past Events','funiversity'); ?></p>
      </div>
    </div>  
  </div>
   <div class="container container--narrow page-section">
    <?php 
    $today = date('Ymd');
      $pastEvents = new WP_Query(array(
      	'paged'	=> get_query_var('paged', 1 ),
      	'posts_per_page'	=> 2,
        'post_type' =>'event',
        'meta_key' =>'event_date',
        'orderby' =>'meta_value_num',
        'order' =>'ASC',
        'meta_query'  => array(
          array(
            'key' => 'event_date',
            'compare' => '<',
            'value' => $today,
            'type' => 'numaric',
          ),
        ),

      ));

      while ($pastEvents->have_posts()) {
        $pastEvents->the_post();?>

         <div class="event-summary">
	        <a class="event-summary__date event-summary__date--beige t-center" href="#">
	          <span class="event-summary__month"><?php the_time('M') ?></span>
	          <span class="event-summary__day"><?php the_time('d'); ?></span>
	        </a>
	        <div class="event-summary__content">
	          <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
	          <p><?php echo wp_trim_words(get_the_content(),18); ?><a href="<?php the_permalink(); ?>" class="nu gray btn btn--blue btn--small"><?php echo __('Read more','funiversity'); ?></a></p>
	        </div>
	      </div>



     <?php } 

     echo paginate_links(array(
     	'total'	=> $pastEvents->max_num_pages,

     ));
     ?>

   </div>


<?php get_footer();

 ?>