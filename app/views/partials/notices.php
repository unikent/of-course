<?php if(isset($preview) && $preview == true):?>
	<div class="alert alert-warning">
		You are currently viewing a preview of revision <?php echo $course->revision_id; ?>. This is preview data ONLY and is not representative of any course offered by this institution.
	</div>
<?php endif; ?>
<?php if ( defined('CLEARING') && CLEARING && $level == 'undergraduate' ): ?>
	<?php if ( !isset($course) && $year == 'current' ): ?>
		<div class="alert alert-warning">
		  <strong>These pages are for undergraduate programmes starting in September <?php echo date('Y') + 1;?>.</strong>
		  <br>If you are a <strong>Clearing</strong>, <strong>Adjustment</strong> or <strong>part-time</strong> applicant wishing to start this September, go to our <a href="/courses/undergraduate/<?php echo date('Y');?>/search/"><?php echo date('Y');?> search page</a>.
		</div>
	<?php elseif ( isset($course) && $course->current_year > $course->year ): ?>
		<div class="card card-backed-tertiary">
			<div class="clearing-banner-container card-block">
				<h2 class="col-lg-3 clearing-banner-title">CLEARING <?php echo $course->year;?></h2>
				<?php if (defined('CLEARING_EMBARGO') && CLEARING_EMBARGO):?>
					<div class="col-lg-8 clearing-banner-text">Planning to start this September? Our updated Clearing vacancy list will be available from 06.00 on Thursday 15 August, A-Level results publication day, following the end of the exam board embargo period.</div>
				<?php else:?>
					<div class="col-lg-5 clearing-banner-text">We may still have full-time vacancies available for this course.</div>
					<a class="col-lg-3" href="https://evision.kent.ac.uk/ipp/ClearingVacancyList.htm"><button type="button" class="btn btn-primary clearing-banner-search-button">Search Vacancies</button></a>
				<?php endif; ?>
			</div>
		</div>
	<?php elseif(isset($course) && $course->current_year == $course->year):
		$previous_year = $course->year-1;

		?>
		<div class="card card-backed-tertiary">
			<div class="clearing-banner-container card-block">
				<h2 class="col-lg-3 clearing-banner-title">CLEARING <?php echo $previous_year;?></h2>
				<?php if (defined('CLEARING_EMBARGO') && CLEARING_EMBARGO):?>
					<div class="col-lg-8 clearing-banner-text">Planning to start this September? Our updated Clearing vacancy list will be available from 06.00 on Thursday 15 August, A-Level results publication day, following the end of the exam board embargo period.</div>
				<?php else:?>
					<div class="col-lg-8 clearing-banner-text">Planning to start this September? We may still have full-time vacancies available for this course. <a href="<?php echo "/courses/$level/$previous_year/$course->instance_id"; ?>">View 2019 course details.</a></div>
				<?php endif; ?>
			</div>
		</div>

	<?php endif; ?>

<?php endif;?>
<?php if(isset($course) && $course->current_year < $course->year): ?>
	<div class="alert alert-warning">
		You are currently viewing a programme for an upcoming academic year. This data is preview ONLY and may not be representative of any course offered by this institution.
	</div>
<?php endif;?>
<?php
	/*
	 * If current course year being viewed is over 2 years ago then display a message saying that it is archived.
	 */
	if (isset($course) && $course->year < $years->current -1) :?>
	<div class="card card-backed-tertiary">
		<div class="card-block">
			<h2 class=" clearing-banner-title">This is an archived page and for reference purposes only</h2>
		</div>
	</div>
	
	<?php
	/*
	 * If current course year being viewed is 1 year ago and that course is not avaliable in the current academic year
	*/
	elseif (isset($course) && !in_array($course->current_year, $course->years) && ($course->year == $years->current -1)): ?>
	<div class="card card-backed-tertiary">
		<div class="card-block">
			<h2 class="clearing-banner-title">
				This is a programme page for the academic year <?php echo format_academic_year($course->year)?>.
			</h2>
			<h2 class="clearing-banner-title">
				We are not accepting applications for this programme for the academic year <?php echo format_academic_year($years->current) ?>.
			</h2>
		</div>
	</div>
<?php endif;?>

<?php if (defined('SHOW_UG_PREVIOUS_YEAR_BANNER') && SHOW_UG_PREVIOUS_YEAR_BANNER && $level == 'undergraduate' && isset($course) && $course->year > ($course->current_year)): ?>
	<div class="alert alert-warning">
		<?php $previousYear = Flight::url("undergraduate/" . ($course->current_year - 1) . "/" . $course->instance_id); ?>
		This is a <?php echo $course->year;?> entry programme. Would you like to <a href='<?php echo $previousYear; ?>'> view <?php echo $course->programme_title;?> for <?php echo $course->current_year-1;?> entry?</a>
	</div>
<?php endif;?>

<?php if (isset($course) && ("true" == $course->globals->open_day_banner_display_banner)) : ?>
	<div class="card card-backed-tertiary">
		<div class="card-block open-days-banner-container">
			<h2 class="open-days-banner-title"><?php echo $course->globals->open_day_banner_heading?></h2>
			
			<div class="open-days-banner-text"><?php echo $course->globals->open_day_banner_text ?></div>
			
			<a href="<?php echo $course->globals->open_day_banner_target_url?>">
				<button type="button" class="btn btn-primary open-days-banner-button">
					<?php echo $course->globals->open_day_banner_call_to_action_button_text?>
				</button>
			</a>
		</div>
	</div>
<?php endif; ?>
