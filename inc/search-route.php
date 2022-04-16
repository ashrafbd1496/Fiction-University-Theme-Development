<?php 
add_action('rest_api_init','funiversityRegisterSearch');
function funiversityRegisterSearch(){
	register_rest_route('funiversity/v1','search', array(
		'methods'	=> WP_REST_SERVER::READABLE, //'GET'
		'callback'	=> 'funiversitySearchResults'
	));
}
function funiversitySearchResults(){
	return 'Congrates ! You created a route';
}