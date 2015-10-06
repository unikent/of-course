<!-- InstanceBegin template="/Templates/daedalus_v1.dwt" codeOutsideHTMLIsLocked="false" -->
<!-- TEMPLATE_VERSION="Daedalus v1.0" -->
<kentWrapper type="<?php if(isset($disable_search_bar) && $disable_search_bar === true){ echo 'courses-no-bar'; }else{ echo 'courses';}?>" siteroot="<?php echo Flight::request()->base; ?>/" mode="<?php echo $level;?>" year="<?php echo $year;?>" currentyear="current">

  <kentMeta>
	<!-- InstanceBeginEditable name="metadata" -->
	<?php if(isset($meta) && isset($meta['title'])): ?>
	<title><?php echo $meta['title']; ?></title>
	<?php endif; ?>

	<?php if(isset($meta) && isset($meta['description'])): ?>
	<meta name="description" content="<?php echo $meta['description']; ?>" />
	<?php endif; ?>

	<?php if(isset($meta) && isset($meta['canonical'])): ?>
	<link rel="canonical" href="<?php echo $meta['canonical']; ?>" />
	<?php endif; ?>
	<link rel="feed" type="application/xcri+xml" href="/courses/xcri"/>

	<link media='screen' type='text/css' rel='stylesheet' href='<?php echo Flight::asset('css/courses.css'); ?>' />
	<link media='screen' type='text/css' rel='stylesheet' href='<?php echo Flight::asset('css/courses-form.css'); ?>' />
	<link media='print' type='text/css' rel='stylesheet' href='<?php echo Flight::asset('css/print.css'); ?>' />
	<!-- InstanceEndEditable -->
  </kentMeta>
  <kentContent>
	<!-- InstanceBeginEditable name="content" -->
	  <kentAttribute name='last_updated' default='<?php echo time(); ?>'><?php echo Flight::last_modified(); ?></kentAttribute>
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
						  <br>Clearing applicants and others planning to start in 2015 should view
						  <a href="/courses/undergraduate/<?php echo $course->current_year - 1;?>/<?php echo $course->instance_id ?>/<?php echo $course->slug ?>"><?php echo $course->programme_title;?> for <?php echo $course->current_year - 1;?> entry.</a>
						</div>
					<?php endif; ?>

				<?php endif;?>
				<?php if(isset($course) && $course->current_year > $course->year): ?>
				  <meta name="robots" content="noindex, nofollow" />
					<div class='alert alert-daedalus'>
						This is a <?php echo $course->year;?> entry programme. Would you like to <a href='<?php echo $meta['active_instance']; ?>'> view <?php echo $course->programme_title;?> for <?php echo $course->current_year;?> entry?</a>
					</div>
					
				<!--?php elseif(!empty($course->current_year) && (CLEARING === false) && (strpos($_SERVER['REQUEST_URI'], "undergraduate") !== false) && $course->current_year === $course->year): ?>
				  <div id="noAlert">
					This is a <?php $previousYear = "http://www.kent.ac.uk/courses/undergraduate/" . ($course->current_year - 1) . "/" . $course->instance_id; echo $course->year;?> entry programme. Would you like to <a href='<?php echo $previousYear; ?>'> view <?php echo $course->programme_title;?> for <?php echo $course->current_year-1;?> entry?</a>
				</div-->

				<?php elseif(isset($course) && $course->current_year < $course->year): ?>
				  <meta name="robots" content="noindex, nofollow" />
					<div class='alert alert-error' style="padding: 10px;margin:10px 0 0 0;">
						You are currently viewing a programme for an upcoming academic year. This data is preview ONLY and may not be representative of any course offered by this institution.
					</div>
				<?php endif;?>

			  <?php echo $content; ?>


			  <a href='#' onclick= "$('html, body').scrollTop();" class='scroll-to-top'>
				<i class="icon-chevron-up icon-white"></i>
			  </a>

	<!-- InstanceEndEditable -->
  </kentContent>
  <kentScripts>
	<script type="text/javascript" charset="utf8" src="<?php echo Flight::asset('js/build/coursetable.min.js'); ?>"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo Flight::asset('js/build/of-course.min.js'); ?>"></script>
  </kentScripts>
</kentWrapper>
<!-- InstanceEnd -->
