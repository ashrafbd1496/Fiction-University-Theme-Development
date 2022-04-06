<?php

get_header();
pageBanner(array(
  'title' => 'Our Campuses',
  'subtitle' => 'We have several conveniently located campuses.'
));
 ?>

<div class="container container--narrow page-section">

<div id="map" class="acf-map">

<?php
  while(have_posts()) {
    the_post();
    $mapLocation = get_field('map_location');
   ?>
    <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <?php echo $mapLocation['address']; ?>
    </div>
  <?php } 
  $rlat = 88.6376;
  $rlong  = 24.3683;


   echo "<script>
   var rlat= 88.6376;
   var rlong= 24.3683;

   var dlat = 90.3929;
   var dlong = 23.7338;
            

      mapboxgl.accessToken = 'pk.eyJ1IjoiYXNocmFmYmQiLCJhIjoiY2wxbG5sYXUyMGJxODNvbzY4bjNoZWJ2aCJ9.FZ4t2ic8dJNs50vY5XIseA';

      const geojson = {
        'type': 'FeatureCollection',
        'features': [
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [dlat, dlong]
            },
            'properties': {
              'title': 'Mapbox',
              'description': 'dhaka campus'
            }
          },
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [rlat, rlong]
            },
            'properties': {
              'title': 'Mapbox',
              'description': 'Rajshahi Campus'
            }
          }
        ]
      };

      const map = new mapboxgl.Map({
        container: 'map',
       style: 'mapbox://styles/ashrafbd/cl1loa1tj000t14r2l9lszw0p', // style URL
        center: [dlat, dlong],
        zoom: 13
      });

      // add markers to map
      for (const feature of geojson.features) {
        // create a HTML element for each feature
        const el = document.createElement('div');
        el.className = 'marker';

        // make a marker for each feature and add it to the map
        new mapboxgl.Marker(el)
          .setLngLat(feature.geometry.coordinates)
          .setPopup(
            new mapboxgl.Popup({ offset: 25 }) // add popups
              .setHTML(
                '<h3>${feature.properties.title}</h3><p>${feature.properties.description}</p>'
              )
          )
          .addTo(map);
      }
    

          </script>";

  ?>
</div>

</div>

<?php get_footer();

?>