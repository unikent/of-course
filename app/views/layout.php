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
	'title' => "Undergraduate courses " . (isset($course) ? $course->year : ''),
	'menu' => array(
		'Course listing' => '/courses/undergraduate/search',
		'Academic life' => '/courses/undergraduate/academic-life',
		'Student experience' => '/courses/undergraduate/student-experience',
		'How to apply' => '/courses/undergraduate/how-to-apply',
		'Accommodation' => '/courses/undergraduate/accommodation',
		'Visit us' => '/courses/undergraduate/visit-us',
		'Fees and funding' => '/courses/undergraduate/fees-and-funding',

	),
	'theme' => false
);

$postgraduate = array(
	'title' => "Postgraduate courses " . (isset($course) ? $course->year : ''),
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
