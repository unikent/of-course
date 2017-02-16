<?php
use \unikent\kent_theme\kentThemeHelper;

KentThemeHelper::header(
	array(
		'title' => "Module Catalogue",
		'menu' => array(
			'Modules' => '/courses/modules/',
			'Choosing your modules' => '/gettingstarted/modules.html',
			'How to apply' => '/courses/undergraduate/how-to-apply/',
			'Planning your career' => 'https://www.kent.ac.uk/ces/',
			'Student profiles' => '/courses/profiles/',

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
