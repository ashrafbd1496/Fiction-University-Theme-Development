<?php
  
  get_header();

  while(have_posts()) {
    the_post();
    pageBanner();
     ?>

    <div class="container container--narrow page-section">
          <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i class="fa fa-home" aria-hidden="true"></i><?php echo __('All Campuses','funiversity'); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
      </div>

      <div class="generic-content"><?php the_content(); ?></div>
     

      <?php 
      $mapLocation = get_field('mapbox_map');
      
     
      ?>
  
      <div id="map" class="acf-map">
          <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
            <h3><?php the_title(); ?></h3>
            <?php echo $mapLocation['address']; ?>
          </div>
      </div>

      <?php 
        $relatedPrograms = new WP_Query(array(
          'posts_per_page' => -1,
          'post_type' => 'program',
          'orderby' => 'title',
          'order' => 'ASC',
          'meta_query' => array(
            array(
              'key' => 'related_campus',
              'compare' => 'LIKE',
              'value' => '"' . get_the_ID() . '"'
            )
          )
        ));

        if ($relatedPrograms->have_posts()) {
          echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium"><?php echo __("Programs Available At This Campus","funiversity") ?></h2>';

        echo '<ul class="min-list link-list">';
        while($relatedPrograms->have_posts()) {
          $relatedPrograms->the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </li>
        <?php }
        echo '</ul>';
        }

        wp_reset_postdata();

        echo "<script>
              mapboxgl.accessToken = 'pk.eyJ1IjoiYXNocmFmYmQiLCJhIjoiY2wxbG5sYXUyMGJxODNvbzY4bjNoZWJ2aCJ9.FZ4t2ic8dJNs50vY5XIseA';

              const map = new mapboxgl.Map({
                container: 'map', // HTML container id
                style: 'mapbox://styles/ashrafbd/cl1loa1tj000t14r2l9lszw0p', // style URL
                center: [91.815536, 22.341900], // starting position as [lng, lat]
                zoom: 13
              });

              const popup = new mapboxgl.Popup().setHTML(
                `<h3>Reykjavik Roasters</h3><p>A good coffee shop</p>`
              );

              const marker = new mapboxgl.Marker()
                .setLngLat([91.815536, 22.341900])
                .setPopup(popup)
                .addTo(map);
          </script>";

    

      ?>

    </div>
    

    
  <?php }

  get_footer();

?>