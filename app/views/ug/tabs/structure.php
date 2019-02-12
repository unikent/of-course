<?php
/*
this deals with the display of the UG Course Structure Section

Note: we are deliberatly using modified logic for the display of courses 2019 and onwards 
to be more CMA compliant without affecting the display of course information for courses
which are already in progress or complete
*/
$show_modules = (strtolower($course->module_session) != 'none');

$modules = $course->modules;
if (!empty($modules)) {
	// a course can have multiple deliveries
	// so assume that the first delivery is the true course structure
	$modules = $modules[0];
}

if ($course->year >= '2019') {
	$stage_template = 'partials/stage-2019-onwards';
} else {
	$stage_template = 'partials/stage';
}
?>

<h2>Course structure</h2>

<?php echo (isset($course->module_intro) && !empty($course->module_intro)) ? $course->module_intro : $course->globals->modules_intro; ?>

<?php if (! empty($course->foundation_year)): ?>
<section class="info-section">
	<h3>Foundation year</h3>
	<section class="info-subsection">
		<?php echo $course->foundation_year ?>
		<?php echo $course->globals->foundation_year ?>
	</section>
</section>
<?php endif; ?>

<?php if (isset($modules->stages->{"foundation"}) && $show_modules ): ?>
	<?php if (empty($course->foundation_year)): ?>
	<h3 class="mt-2">Foundation year</h3>
	<?php endif; ?>
		<?php if (($course->year >= '2019') && (isset($course->stage_0_module_description))): ?>
			<?php echo $course->stage_0_module_description ?>
		<?php endif; ?>
	<?php Flight::render($stage_template, array('stage' => $modules->stages->{"foundation"}, 'stage_id' => '0')); ?>
<?php endif; ?>

<?php if (isset($modules->stages->{1})  && $show_modules ): ?>
<section class="info-section">
	<h3 class="mt-2">Stage 1</h3>
		<?php if (($course->year >= '2019') && (isset($course->stage_1_module_description))): ?>
			<?php echo $course->stage_1_module_description ?>
		<?php endif; ?>
	<?php Flight::render($stage_template, array('stage' => $modules->stages->{1}, 'stage_id' => '1')); ?>
</section>
<?php endif; ?>

<?php if (isset($modules->stages->{2})  && $show_modules ): ?>
<section class="info-section">
	<h3 class="mt-2">Stage 2</h3>
	<?php if (($course->year >= '2019') && (isset($course->stage_2_module_description))): ?>
		<?php echo $course->stage_2_module_description ?>
	<?php endif; ?>
	<?php Flight::render($stage_template, array('stage' => $modules->stages->{2}, 'stage_id' => '2')); ?>
</section>
<?php endif; ?>

<?php if (! empty($course->year_in_industry)): ?>
	<section class="info-section">
		<h3>Year in industry</h3>
		<section class="info-subsection">
			<?php echo $course->year_in_industry ?>
			<?php echo $course->globals->year_in_industry ?>
		</section>

		<?php if (isset($modules->stages->{"S"})  && $show_modules ): ?>
			<?php if (empty($course->year_in_industry)): ?>
				<h3 class="mt-2">Year in industry</h3>
			<?php endif; ?>
			<?php Flight::render($stage_template, array('stage' => $modules->stages->{"S"}, 'stage_id' => 's')); ?>
		<?php endif; ?>
	</section>
<?php endif; ?>

<?php if (! empty($course->year_abroad)): ?>
	<section class="info-section">
		<h3 class="mt-2">Year abroad</h3>
		<section class="info-subsection">
			<?php echo $course->year_abroad ?>
			<?php echo $course->globals->year_abroad ?>
		</section>

		<?php if($show_modules):			?>
			<?php if (isset($modules->stages->{"A"})): ?>
				<?php if (empty($course->year_abroad)): ?>
					<h3 class="mt-2">Year abroad</h3>
				<?php endif; ?>
				<?php Flight::render($stage_template, array('stage' => $modules->stages->{"A"}, 'stage_id' => 'a')); ?>
			<?php endif; ?>
			<?php if (isset($modules->stages->{"A1"})): ?>
				<h3 class="mt-2">1st year abroad</h3>
				<?php Flight::render($stage_template, array('stage' => $modules->stages->{"A1"}, 'stage_id' => 'a1')); ?>
			<?php endif; ?>
			<?php if (isset($modules->stages->{"A2"})): ?>
				<h3 class="mt-2">2nd year abroad</h3>
				<?php Flight::render($stage_template, array('stage' => $modules->stages->{"A2"}, 'stage_id' => 'a2')); ?>
			<?php endif; ?>
		<?php endif; ?>
	</section>
<?php endif; ?>

<?php if($show_modules): ?>

	<?php if (isset($modules->stages->{3})): ?>
	<section class="info-section">
		<h3 class="mt-2">Stage 3</h3>
		<?php if (($course->year >= '2019') && (isset($course->stage_3_module_description))): ?>
			<?php echo $course->stage_3_module_description ?>
		<?php endif; ?>
		<?php Flight::render($stage_template, array('stage' => $modules->stages->{3}, 'stage_id' => '3')); ?>
	</section>
	<?php endif; ?>

	<?php if (isset($modules->stages->{4})): ?>
	<section class="info-section">
		<h3 class="mt-2">Stage 4</h3>
		<?php if (($course->year >= '2019') && (isset($course->stage_4_module_description))): ?>
			<?php echo $course->stage_4_module_description ?>
		<?php endif; ?>
		<?php Flight::render($stage_template, array('stage' => $modules->stages->{4}, 'stage_id' => '4')); ?>
	</section>
	<?php endif; ?>

	<?php if (isset($modules->stages->{5})): ?>
	<section class="info-section">
		<h3 class="mt-2">Stage 5</h3>
		<?php if (($course->year >= '2019') && (isset($course->stage_5_module_description))): ?>
			<?php echo $course->stage_5_module_description ?>
		<?php endif; ?>
		<?php Flight::render($stage_template, array('stage' => $modules->stages->{5}, 'stage_id' => '5')); ?>
	</section>
	<br />
	<?php endif; ?>

<?php endif; ?>

