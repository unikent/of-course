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
    'title_link' => Flight::url('undergraduate'),
	'menu' => array(
		'Courses' => '/courses/undergraduate/search',
		'Academic life' => '/courses/undergraduate/academic-life',
		'Student experience' => '/courses/undergraduate/student-experience',
		'How to apply' => '/courses/undergraduate/how-to-apply',
		'Accommodation' => '/courses/undergraduate/accommodation',
		'Visit us' => '/courses/visit',
		'International' => '/courses/international/',
		'Fees and funding' => '/courses/undergraduate/fees-and-funding',

	),
	'theme' => false
);

$postgraduate = array(
	'title' => "Postgraduate courses " . (isset($course) ? $course->year : ''),
	'title_link' => Flight::url('postgraduate'),
	'menu' => array(
		'Courses' => '/courses/postgraduate/search',
		'Why Kent?' => '/courses/postgraduate/why-kent/',
		'Taught / Master\'s' => '/courses/postgraduate/taught-masters/',
		'Research / PhDs' => '/courses/postgraduate/research-phds/',
		'How to apply' => '/courses/postgraduate/how-to-apply',
		'Accommodation' => '/accommodation',
		'International' => '/courses/international/',
		'Funding' => '/courses/postgraduate/fees-and-funding/',
	),
	'theme' => 'postgraduate'
);

if(isset($profile) && !empty($profile)){

	$undergraduate = array(
		'title' => "Undergraduate Student Profiles",
		'title_link' => Flight::url('undergraduate'),
		'menu' => array(
			'Courses' => '/courses/undergraduate/search',
			'Academic life' => '/courses/undergraduate/academic-life',
			'Student experience' => '/courses/undergraduate/student-experience',
			'How to apply' => '/courses/undergraduate/how-to-apply',
			'Accommodation' => '/courses/undergraduate/accommodation',
			'Visit us' => '/courses/visit',
			'Fees and funding' => '/courses/undergraduate/fees-and-funding',

		),
		'theme' => false
	);

	$postgraduate = array(
		'title' => "Postgraduate Student Profiles",
		'title_link' => Flight::url('postgraduate'),
		'menu' => array(
			'Courses' => '/courses/postgraduate/search',
			'Why Kent?' => '/courses/postgraduate/why-kent/',
			'Taught / Master\'s' => '/courses/postgraduate/taught-masters/',
			'Research / PhDs' => '/courses/postgraduate/research-phds/',
			'Funding' => '/courses/postgraduate/fees-and-funding/',
		),
		'theme' => 'postgraduate'
	);
}

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
