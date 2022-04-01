<?php 

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
wp_enqueue_style('funiversity-template-style',get_theme_file_uri('/build/style-index.css'));
wp_enqueue_style('funiversity-template-style2',get_theme_file_uri('/build/index.css'));
wp_enqueue_style('funiversity-main-stylesheet',get_stylesheet_uri());

  //js
  wp_enqueue_script('funiversity-template-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

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

function funiversity_map_api($api){
$api['key'] = 'AIzaSyAQR-02hhSHfpnjxmMnh2lid9Ng113eFB4';
return $api;
}
add_filter('acf/fields/google_map/api', 'funiversity_map_api');