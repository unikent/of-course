<?php
use \unikent\kent_theme\kentThemeHelper;

KentThemeHelper::header(
	array(
		'title' => "Kent Theme Demo",
		'menu' => array(
			'Home' => 'https://beta-test.kent.ac.uk/courses/',
			'Course Listing' => 'https://beta-test.kent.ac.uk/courses/undergraduate/search',
			'Chooseing your course' => 'https://beta-test.kent.ac.uk',
			'How to apply' => 'https://beta-test.kent.ac.uk',
			'Planning your career' => 'https://beta-test.kent.ac.uk',
			'Student Profiles' => 'https://beta-test.kent.ac.uk',

		),
		'meta' => array(
			'title' => (isset($meta) && isset($meta['title']) ? $meta['title'] : 'University of kent courses'),
			'description' => $meta['description'],
		),
		'head_markup'=> '<link rel="feed" type="application/xcri+xml" href="/courses/xcri"/><link rel="canonical" href="'.$meta['canonical'].'" />',
		'home_page' => false,
		'slim'=> true,
		'brand_header' => true,
		'theme' => $level == 'postgraduate' ? 'postgraduate' : false
	)
);

?>
<?php echo $content; ?>

	  <a href="#bodycontent" tabindex="0" class='scroll-to-top' style="cursor: pointer;">
		<i class="icon-chevron-up icon-white"></i>
	  </a>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo Flight::asset('js/build/coursetable.min.js'); ?>"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo Flight::asset('js/build/of-course.min.js'); ?>"></script>



<?php KentThemeHelper::footer(); ?>