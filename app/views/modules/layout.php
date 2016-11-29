<?php
use \unikent\kent_theme\kentThemeHelper;

KentThemeHelper::header(
	array(
		'title' => "Module Catalogue",
		'menu' => array(
			'Home' => 'https://beta-test.kent.ac.uk/courses/',
			'Modules listing' => 'https://beta-test.kent.ac.uk/courses/modules',
			'Choosing your modules' => 'https://beta-test.kent.ac.uk',
			'How to apply' => 'https://beta-test.kent.ac.uk',
			'Planning your career' => 'https://beta-test.kent.ac.uk',
			'Student Profiles' => 'https://beta-test.kent.ac.uk',

		),
		'meta' => array(
			'title' => (isset($meta) && isset($meta['title']) ? $meta['title'] : 'University of Kent modules'),
			'description' => $meta['description'],
		),
		'head_markup'=> '<link media="screen" type="text/css" rel="stylesheet" href="'.Flight::asset("css/module-catalogue.css").'" />',
		'home_page' => false,
		'slim'=> true,
		'brand_header' => true,
		'theme' => $level == 'postgraduate' ? 'postgraduate' : false
	)
);

?>
		<?php echo $content; ?>

	
<?php KentThemeHelper::footer('  <a href="#bodycontent" tabindex="0" class="scroll-to-top" style="cursor: pointer;">
		<i class="icon-chevron-up icon-white"></i>
	  </a>
'); ?>