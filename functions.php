<?php 
require get_theme_file_path('/inc/search-route.php');
function funiversity_custom_rest(){
  register_rest_field('post','authorName', array(
    'get_callback' => function(){ return get_the_author();}
  ));
}
add_action('rest_api_init', 'funiversity_custom_rest');
//pageBnner function to display banner image
function pageBanner($args = Null){ 
    if (! $args['title']){
      $args['title']= get_the_title();
      
    }
   if (! $args['subtitle']){
    $args['subtitle'] = get_field('page_banner_subtitle');
   }
    if (! $args['photo']){
    if (get_field('page_banner_background_image')) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    }else{
      $args['photo']= get_theme_file_uri('/images/ocean.jpg');
   }
 }
  ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'];?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>  
  </div>

<?php } 

function funiversity_files (){

//css
wp_enqueue_style('mapbox-css','//api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css');
wp_enqueue_style('funiversity-template-style',get_theme_file_uri('/build/style-index.css'));
wp_enqueue_style('funiversity-template-style2',get_theme_file_uri('/build/index.css'));
wp_enqueue_style('funiversity-main-stylesheet',get_stylesheet_uri());

  //js
  //wp_enqueue_script('gogle-map-api','//maps.googleapis.com/maps/api/js?key=AIzaSyAQR-02hhSHfpnjxmMnh2lid9Ng113eFB4&callback=initMap');
  wp_enqueue_script('mapbox-js','//api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js');
  wp_enqueue_script('funiversity-template-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

  wp_localize_script( 'funiversity-template-js','funiversityData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest'),
    ) );

}

add_action('wp_enqueue_scripts','funiversity_files');


function funiversity_supports(){
  add_theme_support('custom-logo');
  add_theme_support('title-tag');
 add_theme_support( 'post-thumbnails' ); 
 add_image_size( 'professorLandscape', 400, 250, true );
 add_image_size( 'professorPortrait', 480, 650, true );
 add_image_size( 'pageBanner', 1500, 350, true );
  load_theme_textdomain('funiversity', get_template_directory() . '/languages');
  register_nav_menu('HeaderMenuLocation','Header Menu Location');
  register_nav_menu('FooterLocationExplore','Footer Location Explore');
  register_nav_menu('FooterLocationLearn','Footer Location Learn');

}

add_action('after_setup_theme','funiversity_supports');

function funiversity_adjust_queries($query){

  if ( ! is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
      $query->set('orderby', 'title');
      $query->set('order', 'ASC');
      $query->set('posts_per_page', -1);
  }
   if ( ! is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()) {
      $query->set('posts_per_page', -1);
  }


  if ( ! is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
    $today = date('Ymd');
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
              array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
              )
            ));
  }
}
add_action('pre_get_posts','funiversity_adjust_queries');


function acf_mapbox_api( $api ) {

   $api['key'] = 'pk.eyJ1IjoiYXNocmFmYmQiLCJhIjoiY2t3eGI4bTlsMGJwbDJ3cXQ3a3U2NG45eSJ9.ZjEuH5Iy4dB0SXv8gpY1SQ'; 
   return $api;

}
add_filter( 'acf/fields/mapbox/api', 'acf_mapbox_api' );

//Redirect user to homepage after login
add_action('admin_init','redirectSubstoFrntend');
function redirectSubstoFrntend(){
    $ourCurrentUser = wp_get_current_user();
      if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0]== 'subscriber'){
      wp_redirect(site_url('/'));
      exit;
    }
  }
  add_action('wp_loaded','noSubsAdminBar');
    function noSubsAdminBar(){
    $ourCurrentUser = wp_get_current_user();
      if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0]== 'subscriber'){
      show_admin_bar(false);
    }
  }

  //Customize login screen
  add_filter( 'login_headerurl', 'ourCustomizedHeaderUrl' );
  function ourCustomizedHeaderUrl(){
    return esc_url(site_url('/'));
  }

  add_action('login_enqueue_scripts','ourLoginCss');
  function ourLoginCss(){
      wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('funiversity-template-style',get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('funiversity-template-style2',get_theme_file_uri('/build/index.css'));

  }
  add_filter('login_headertitle','ourLoginTitle');
  function ourLoginTitle(){
    return get_bloginfo('name');
  }
// Force note post to be private
add_filter('wp_insert_post_data','makeNotePrivate',10,2);
function makeNotePrivate($data, $postarr){
  if ($data['post_type'] == 'note') {
   if (count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']) {
     die('You have reached your note limit.');
   }
   $data['post_content'] = sanitize_textarea_field( $data['post_content'] );
   $data['post_title'] = sanitize_textarea_field( $data['post_title'] );
  }
  if ($data['post_type'] == 'note' AND $data['post_status'] != 'trash') {
    $data['post_status'] = 'private';
  }
  return $data;
}