<h2>Course structure</h2>

<p>Currently there is no course structure information available for this programme.</p>

<?php if (! empty($course->foundation_year)): ?>
<section class="info-section">
	<h3>Foundation year</h3>
	<section class="info-subsection">
		<?php echo $course->foundation_year ?>
		<?php echo $course->globals->foundation_year ?>
	</section>
</section>
<?php endif; ?>

<?php if (! empty($course->year_in_industry)): ?>
<section class="info-section">
	<h3>Year in industry</h3>
	<section class="info-subsection">
		<?php echo $course->year_in_industry ?>
		<?php echo $course->globals->year_in_industry ?>
	</section>
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
</section>
<?php endif; ?>