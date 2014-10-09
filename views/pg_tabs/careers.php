<?php if ( !empty($course->careers_and_employability) || !empty($course->globals->careersemployability_text) ): ?>
	
	<section class="info-subsection">
		<h3>Careers and employability</h3>
		<?php echo $course->careers_and_employability ?>
		<?php echo $course->globals->careersemployability_text ?>
	</section>
	<?php endif; ?>

	<?php if(!empty($course->professional_recognition)): ?>
	<section class="info-subsection">
		<h3>Professional recognition</h3>
		<?php echo $course->professional_recognition ?>
	</section>
	<?php endif; ?>

	<?php if( ! empty($course->did_you_know_fact_box) ): ?>
	<div class="panel content-highlight">
		<h3>National ratings</h3>
		<?php echo $course->did_you_know_fact_box ?>
	</div>
<?php endif; ?>
