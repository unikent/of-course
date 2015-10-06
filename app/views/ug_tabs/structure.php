<?php
$show_modules = (strtolower($course->module_session) != 'none');
$modules = $course->modules;
if(!empty($modules)) {
	$modules = $modules[0];
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
	<h3>Foundation year</h3>
	<?php endif; ?>
	<?php Flight::render('partials/stage', array('stage' => $modules->stages->{"foundation"}, 'stage_id' => '0')); ?>
<?php endif; ?>

<?php if (isset($modules->stages->{1})  && $show_modules ): ?>
<section class="info-section">
	<h3>Stage 1</h3>
	<?php Flight::render('partials/stage', array('stage' => $modules->stages->{1}, 'stage_id' => '1')); ?>
</section>
<br />
<?php endif; ?>

<?php if (isset($modules->stages->{2})  && $show_modules ): ?>
<section class="info-section">
	<h3>Stage 2</h3>
	<?php Flight::render('partials/stage', array('stage' => $modules->stages->{2}, 'stage_id' => '2')); ?>
</section>
<br />
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
				<h3>Year in industry</h3>
			<?php endif; ?>
			<?php Flight::render('partials/stage', array('stage' => $modules->stages->{"S"}, 'stage_id' => 's')); ?>
		<?php endif; ?>
	</section>
	<br />
<?php endif; ?>

<?php if (! empty($course->year_abroad)): ?>
	<section class="info-section">
		<h3>Year abroad</h3>
		<section class="info-subsection">
			<?php echo $course->year_abroad ?>
			<?php echo $course->globals->year_abroad ?>
		</section>

		<?php if($show_modules):			?>
			<?php if (isset($modules->stages->{"A"})): ?>
				<?php if (empty($course->year_abroad)): ?>
				<h3>Year abroad</h3>
				<?php endif; ?>
				<?php Flight::render('partials/stage', array('stage' => $modules->stages->{"A"}, 'stage_id' => 'a')); ?>
			<?php endif; ?>
			<?php if (isset($modules->stages->{"A1"})): ?>
				<h3>1st year abroad</h3>
				<?php Flight::render('partials/stage', array('stage' => $modules->stages->{"A1"}, 'stage_id' => 'a1')); ?>
			<?php endif; ?>
			<?php if (isset($modules->stages->{"A2"})): ?>
				<h3>2nd year abroad</h3>
				<?php Flight::render('partials/stage', array('stage' => $modules->stages->{"A2"}, 'stage_id' => 'a2')); ?>
			<?php endif; ?>
		<?php endif; ?>
	</section>
<?php endif; ?>

<?php if($show_modules): ?>

	<?php if (isset($modules->stages->{3})): ?>
	<section class="info-section">
		<h3>Stage 3</h3>
		<?php Flight::render('partials/stage', array('stage' => $modules->stages->{3}, 'stage_id' => '3')); ?>
	</section>
	<?php endif; ?>

	<?php if (isset($modules->stages->{4})): ?>
	<section class="info-section">
		<h3>Stage 4</h3>
		<?php Flight::render('partials/stage', array('stage' => $modules->stages->{4}, 'stage_id' => '4')); ?>
	</section>
	<?php endif; ?>

	<?php if (isset($modules->stages->{5})): ?>
	<section class="info-section">
		<h3>Stage 5</h3>
		<?php Flight::render('partials/stage', array('stage' => $modules->stages->{5}, 'stage_id' => '5')); ?>
	</section>
	<br />
	<?php endif; ?>

<?php endif; ?>

