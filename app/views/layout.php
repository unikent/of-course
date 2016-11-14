<?php
use \unikent\kent_theme\kentThemeHelper;

$shared = array(
		'meta' => array(
			'title' => (isset($meta) && isset($meta['title']) ? $meta['title'] : 'University of kent courses'),
			'description' => $meta['description'],
		),
		'head_markup'=> '<link rel="feed" type="application/xcri+xml" href="/courses/xcri"/><link rel="canonical" href="'.$meta['canonical'].'" />
		<link media="screen" type="text/css" rel="stylesheet" href="'.Flight::asset("css/courses.css").'" />',
		'home_page' => false,
		'slim'=> true,
		'brand_header' => true,
	);

$undergraduate = array(
	'title' => "Undergraduate courses",
	'menu' => array(
		'Home' => 'https://beta-test.kent.ac.uk/courses/',
		'Course Listing' => 'https://beta-test.kent.ac.uk/courses/undergraduate/search',
		'Choosing your course' => 'https://beta-test.kent.ac.uk',
		'How to apply' => 'https://beta-test.kent.ac.uk',
		'Planning your career' => 'https://beta-test.kent.ac.uk',
		'Student Profiles' => 'https://beta-test.kent.ac.uk',

	),
	'theme' => false
);

$postgraduate = array(
	'title' => "Postgraduate courses",
	'menu' => array(
		'Home' => 'https://beta-test.kent.ac.uk/courses/',
		'Course Listing' => 'https://beta-test.kent.ac.uk/courses/undergraduate/search',
		'Choosing your course' => 'https://beta-test.kent.ac.uk',
		'How to apply' => 'https://beta-test.kent.ac.uk',
		'Planning your career' => 'https://beta-test.kent.ac.uk',
		'Student Profiles' => 'https://beta-test.kent.ac.uk',

	),
	'theme' => 'postgraduate'
);


if($level == 'postgraduate') {
	KentThemeHelper::header(
		array_merge($shared, $postgraduate)
	);
} else {
	KentThemeHelper::header(
		array_merge($shared, $undergraduate)
	);
}

?>

<?php echo $content; ?>

	<a href="#bodycontent" tabindex="0" class='scroll-to-top' style="cursor: pointer;">
		<i class="icon-chevron-up icon-white"></i>
	</a>


<?php KentThemeHelper::footer("<script src=\"" .  Flight::asset('js/courses.js')."\"></script>"); ?>
