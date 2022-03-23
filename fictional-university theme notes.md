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

*** 