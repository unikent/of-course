<?php if(isset($preview) && $preview == true):?>
	<div class="alert alert-warning">
		You are currently viewing a preview of revision <strong><?php echo $course->revision_id; ?></strong>. This is preview data ONLY and is not representative of any course offered by this institution.
	</div>
<?php endif; ?>
<?php if ( defined('CLEARING') && CLEARING && $level == 'undergraduate' ): ?>
	<?php if ( !isset($course) && $year == 'current' ): ?>
		<div class="alert alert-warning">
		  <strong>These pages are for undergraduate programmes starting in September <?php echo date('Y') + 1;?>.</strong>
		  <br>If you are a <strong>Clearing</strong>, <strong>Adjustment</strong> or <strong>part-time</strong> applicant wishing to start this September, go to our <a href="/courses/undergraduate/<?php echo date('Y');?>/search/"><?php echo date('Y');?> search page</a>.
		</div>
	<?php elseif ( isset($course) && $course->current_year == $course->year ): ?>
		<div class="alert alert-warning">
		  <strong>Applying through clearing?</strong>
		  <br>Clearing applicants and others planning to start in 2016 should view
		  <a href="/courses/undergraduate/<?php echo $course->current_year - 1;?>/<?php echo $course->instance_id ?>/<?php echo $course->slug ?>"><?php echo $course->programme_title;?> for <?php echo $course->current_year - 1;?> entry.</a>
		</div>
	<?php endif; ?>

<?php endif;?>
<?php if(isset($course) && $course->current_year < $course->year): ?>
	<div class="alert alert-warning">
		You are currently viewing a programme for an upcoming academic year. This data is preview ONLY and may not be representative of any course offered by this institution.
	</div>
<?php endif;?>

<?php if (defined('SHOW_UG_PREVIOUS_YEAR_BANNER') && SHOW_UG_PREVIOUS_YEAR_BANNER && $level == 'undergraduate' && isset($course) && $course->year >= ($course->current_year)): ?>
	<div class="alert alert-warning">
		<?php $previousYear = Flight::url("undergraduate/" . ($course->current_year - 1) . "/" . $course->instance_id); ?>
		This is a <?php echo $course->year;?> entry programme. Would you like to <a href='<?php echo $previousYear; ?>'> view <?php echo $course->programme_title;?> for <?php echo $course->current_year-1;?> entry?</a>
	</div>
<?php endif;?>