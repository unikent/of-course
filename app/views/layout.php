<?php
use \unikent\kent_theme\kentThemeHelper;

KentThemeHelper::header(
	array(
		'title' => "Kent Theme Demo",
		'menu' => array(
			'Home' => '#',
			'Course Listing' => '#',
			'Chooseing your course' => '#',
			'How to apply' => '#',
			'Planning your career' => '#',
			'Student Profiles' => '#',

		),
		'meta' => array(
			'title' => (isset($meta) && isset($meta['title']) ? $meta['title'] : 'University of kent courses'),
			'description' => $meta['description'],
		),
		'head_markup'=> '<link rel="feed" type="application/xcri+xml" href="/courses/xcri"/><link rel="canonical" href="'.$meta['canonical'].'" />',
		'home_page' => false,
		'slim'=> true,
		'brand_header' => true
	)
);

?>
<?php echo $content; ?>



			  <a href="#bodycontent" tabindex="0" class='scroll-to-top' style="cursor: pointer;">
				<i class="icon-chevron-up icon-white"></i>
			  </a>


<!--
	<link media='screen' type='text/css' rel='stylesheet' href='<?php echo Flight::asset('css/courses.css'); ?>' />
	<link media='screen' type='text/css' rel='stylesheet' href='<?php echo Flight::asset('css/courses-form.css'); ?>' />
	<link media='print' type='text/css' rel='stylesheet' href='<?php echo Flight::asset('css/print.css'); ?>' />

	<script type="text/javascript" charset="utf8" src="<?php echo Flight::asset('js/build/coursetable.min.js'); ?>"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo Flight::asset('js/build/of-course.min.js'); ?>"></script>
-->

<?php KentThemeHelper::footer(); ?>