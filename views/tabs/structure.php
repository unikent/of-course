<h2>Course structure</h2>

<?php if (! empty($course->foundation_year)): ?>
<section class="info-section">
	<h3>Foundation year</h3>
	<section class="info-subsection">
		<?php echo $course->foundation_year ?>
		<?php echo $course->globals->foundation_year ?>
	</section>
	<?php isset($course->modules->stages->{0}) ? Flight::render('partials/stage', array('stage' => $course->modules->stages->{0})) : ''; ?>
</section>
<?php endif; ?>
<?php if (isset($course->modules->stages->{0})): ?>
	<?php if (empty($course->foundation_year)): ?>
	<h3>Foundation year</h3>
	<?php endif; ?>
	<?php Flight::render('partials/stage', array('stage' => $course->modules->stages->{0})); ?>
<?php endif; ?>



<?php if (isset($course->modules->stages->{1})): ?>
<section class="info-section">
	<h3>Stage 1</h3>
	<?php Flight::render('partials/stage', array('stage' => $course->modules->stages->{1})); ?>
</section>
<?php endif; ?>

<?php if (isset($course->modules->stages->{2})): ?>
<section class="info-section">
	<h3>Stage 2</h3>
	<?php Flight::render('partials/stage', array('stage' => $course->modules->stages->{2})); ?>
</section>
<?php endif; ?>

<?php if (isset($course->modules->stages->{3})): ?>
<section class="info-section">
	<h3>Stage 3</h3>
	<?php Flight::render('partials/stage', array('stage' => $course->modules->stages->{3})); ?>
</section>
<?php endif; ?>

<?php if (isset($course->modules->stages->{4})): ?>
<section class="info-section">
	<h3>Stage 4</h3>
	<?php Flight::render('partials/stage', array('stage' => $course->modules->stages->{4})); ?>
</section>
<?php endif; ?>

<?php if (isset($course->modules->stages->{5})): ?>
<section class="info-section">
	<h3>Stage 5</h3>
	<?php Flight::render('partials/stage', array('stage' => $course->modules->stages->{5})); ?>
</section>
<?php endif; ?>




<?php if (! empty($course->year_abroad)): ?>
<section class="info-section">
	<h3>Year abroad</h3>
	<section class="info-subsection">
		<?php echo $course->year_abroad ?>
		<?php echo $course->globals->year_abroad ?>
	</section>
</section>
<?php endif; ?>
<?php if (isset($course->modules->stages->{"A"})): ?>
	<?php if (empty($course->year_abroad)): ?>
	<h3>Year abroad</h3>
	<?php endif; ?>
	<?php Flight::render('partials/stage', array('stage' => $course->modules->stages->{"A"})); ?>
<?php endif; ?>
<?php if (isset($course->modules->stages->{"A1"})): ?>
	<h3>1st year abroad</h3>
	<?php Flight::render('partials/stage', array('stage' => $course->modules->stages->{"A1"})); ?>
<?php endif; ?>
<?php if (isset($course->modules->stages->{"A2"})): ?>
	<h3>2nd year abroad</h3>
	<?php Flight::render('partials/stage', array('stage' => $course->modules->stages->{"A2"})); ?>
<?php endif; ?>



<?php if (! empty($course->year_in_industry)): ?>
<section class="info-section">
	<h3>Year in industry</h3>
	<section class="info-subsection">
		<?php echo $course->year_in_industry ?>
		<?php echo $course->globals->year_in_industry ?>
	</section>
</section>
<?php endif; ?>

<?php if (isset($course->modules->stages->{"S"})): ?>
	<?php if (empty($course->year_in_industry)): ?>
	<h3>Year in industry</h3>
	<?php endif; ?>
	<?php Flight::render('partials/stage', array('stage' => $course->modules->stages->{S})); ?>
<?php endif; ?>




