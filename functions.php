<?php 

function funiversity_files (){

//css
wp_enqueue_style('funiversity-template-style',get_theme_file_uri('/build/style-index.css'));
wp_enqueue_style('funiversity-template-style2',get_theme_file_uri('/build/index.css'));
wp_enqueue_style('funiversity-main-stylesheet',get_stylesheet_uri());

  //js
  wp_enqueue_script('funiversity-template-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

  //wp_enqueue_script('bootstrap-bundle-js',get_theme_file_uri('/bootstrap.bundle.min.js'),['jquery'],'default',true);
}

add_action('wp_enqueue_scripts','funiversity_files');


function funiversity_supports(){
  add_theme_support( 'custom-logo' );
  load_theme_textdomain('funiversity', get_template_directory() . '/languages');
  register_nav_menu('HeaderMenuLocation','Header Menu Location');
  register_nav_menu('FooterLocationExplore','Footer Location Explore');
  register_nav_menu('FooterLocationLearn','Footer Location Learn');

}

add_action('after_setup_theme','funiversity_supports');