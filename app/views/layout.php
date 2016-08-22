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

<div class="card card-overlay header-card-overlay">
	<div class="card-body">
		<div class="card-media-wrap">
			<img class="card-img" src="<?php echo Flight::url("/images/banner.jpg");?>">
			<div class="card-img-overlay-bottom card-img-overlay-link">
				<div class="attribution">
					<i class="kf-camera"></i>
					<span>Political Studies Association: Picture by <a href="#">Someone</a>. <a href="#">Attribution License</a></span>
				</div>
			</div>
		</div>
	</div>
</div>


				<?php if(isset($preview) && $preview == true):?>
					<meta name="robots" content="noindex, nofollow" />
					<div class='alert alert-error' style="padding: 10px;margin:10px 0 0 0;">
						You are currently viewing a preview of revision <strong><?php echo $course->revision_id; ?></strong>. This is preview data ONLY and is not representative of any course offered by this institution.
					</div>
				<?php endif; ?>
				<?php if ( defined('CLEARING') && CLEARING && $level == 'undergraduate' ): ?>
					<?php if ( !isset($course) && $year == 'current' ): ?>
						<meta name="robots" content="noindex, nofollow" />
						<div class='alert alert-daedalus' style="padding: 20px;margin:10px 0 0 0;">
						  <strong>These pages are for undergraduate programmes starting in September <?php echo date('Y') + 1;?>.</strong>
						  <br>If you are a <strong>Clearing</strong>, <strong>Adjustment</strong> or <strong>part-time</strong> applicant wishing to start this September, go to our <a href="/courses/undergraduate/<?php echo date('Y');?>/search/"><?php echo date('Y');?> search page</a>.
						</div>
					<?php elseif ( isset($course) && $course->current_year == $course->year ): ?>
						<div class='alert alert-daedalus' style="padding: 20px;margin:10px 0 0 0;">
						  <strong>Applying through clearing?</strong>
						  <br>Clearing applicants and others planning to start in 2016 should view
						  <a href="/courses/undergraduate/<?php echo $course->current_year - 1;?>/<?php echo $course->instance_id ?>/<?php echo $course->slug ?>"><?php echo $course->programme_title;?> for <?php echo $course->current_year - 1;?> entry.</a>
						</div>
					<?php endif; ?>

				<?php endif;?>
				<?php if(isset($course) && $course->current_year > $course->year): ?>
				  <meta name="robots" content="noindex, nofollow" />
					<div class='alert alert-daedalus'>
						This is a <?php echo $course->year;?> entry programme. Would you like to <a href='<?php echo $meta['active_instance']; ?>'> view <?php echo $course->programme_title;?> for <?php echo $course->current_year;?> entry?</a>
					</div>
					

				<?php elseif(isset($course) && $course->current_year < $course->year): ?>
				  <meta name="robots" content="noindex, nofollow" />
					<div class='alert alert-error' style="padding: 10px;margin:10px 0 0 0;">
						You are currently viewing a programme for an upcoming academic year. This data is preview ONLY and may not be representative of any course offered by this institution.
					</div>
				<?php endif;?>

				<?php if (defined('SHOW_UG_PREVIOUS_YEAR_BANNER') && SHOW_UG_PREVIOUS_YEAR_BANNER && $level == 'undergraduate' && isset($course) && $course->year >= ($course->current_year)): ?>
					<div class='alert alert-daedalus'>
						<?php $previousYear = Flight::url("undergraduate/" . ($course->current_year - 1) . "/" . $course->instance_id); ?>
						This is a <?php echo $course->year;?> entry programme. Would you like to <a href='<?php echo $previousYear; ?>'> view <?php echo $course->programme_title;?> for <?php echo $course->current_year-1;?> entry?</a>
					</div>
				<?php endif;?>


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