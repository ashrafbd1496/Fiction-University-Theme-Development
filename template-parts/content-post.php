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
  </div>