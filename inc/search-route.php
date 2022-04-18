<?php 
add_action('rest_api_init','funiversityRegisterSearch');
function funiversityRegisterSearch(){
	register_rest_route('funiversity/v1','search', array(
		'methods'	=> WP_REST_SERVER::READABLE, //'GET'
		'callback'	=> 'funiversitySearchResults'
	));
}
function funiversitySearchResults(){
	$professors = new WP_Query(array(
		'post_type'	=> 'professor', 
	));
	$professorResults = array();

	while($professors -> have_posts()){
		$professors->the_post();
		array_push($professorResults, array(
			'title'	=> get_the_title(),
			'permalink'	=> get_the_permalink(),
		));
	}

	return $professorResults; 
}