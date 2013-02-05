<h2>Teaching &amp; Assessment</h2>
<?php echo $course->teaching_and_assessment; ?>

<?php if(!empty($course->programme_aims)): ?>
<section class="info-section">
	<h3>Programme aims</h3>
	<?php echo $course->programme_aims; ?>
</section>
<?php endif; ?>

<?php if(!empty($course->learning_outcomes)): ?>
<section class="info-section">
	<h3>Learning outcomes</h3>
	<?php echo $course->learning_outcomes; ?>
</section>
<?php endif; ?>