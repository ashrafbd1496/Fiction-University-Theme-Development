/**
 * <?php

$names= array('jabed','karim','rahim','jakir','fahim');

$count = 0;

while($count < count($names)){
	echo "<li>his name is $names[$count] </li>";
	$count++;
}

?>
 */


*** course code github link - https://github.com/learnwebcode/university-static/

*** to enqueue script -
wp_enqueue_script('script_name',get_theme_file_uri('file_path',array('jquery'),'1.0',true));

*** here = array('jquery') = jquery dependency
	1.0  = version_number
	true = jquery will place just before the body closing tag.


*** to comment a html block  <!-- divs are  here  	-->

*** we can add menu item link using site_url('/about-us'); and for home only use site_url();

*** to get the id of a post or page <?php echo get_the_ID(); and 
	to get the parent page id - echo wp_get_post_parent_id(get_the_ID());

*** different between the_title() and echo get_the_title(5); is first one show the page title and the second one show title of a page which id inserted. samely the_permalink() and get_permalink();

*** to 100 functions wp comunity use- https://vegibit.com/the-top-100-most-commonly-used-wordpress-functions/

*** to show archive page title <?php the_archive_title(); ?>

*** register_post_type -
	<?php 
      $eventPosts = new WP_Query(array(
        'posts_per_page' => 2,
        'post_type' =>'event',

      ));

      while($eventPosts->have_posts()){
        $eventPosts->the_post(); ?>

          <div class="event-summary">
            <a class="event-summary__date event-summary__date--beige t-center" href="#">
              <span class="event-summary__month"><?php the_time('M') ?></span>
              <span class="event-summary__day"><?php the_time('d'); ?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <p><?php echo wp_trim_words(get_the_content(),18); ?><a href="<?php the_permalink(); ?>" class="nu gray btn btn--blue btn--small">Read more</a></p>
            </div>
          </div>

      <?php } wp_reset_postdata();
       ?>
       

