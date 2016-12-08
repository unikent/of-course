<?php if ( !empty($course->careers_and_employability) || !empty($course->globals->careersemployability_text) ): ?>
	<section class="info-subsection">
		<h2>Careers</h2>
		<?php echo $course->careers_and_employability ?>
		<?php echo $course->globals->careersemployability_text ?>
	</section>
<?php endif; ?>

<?php if(!empty($course->careers_profile) && is_array($course->careers_profile)){
	Flight::render("partials/profile-quote");
} ?>

<?php if(!empty($course->professional_recognition)): ?>
	<section class="info-subsection">
		<h3>Professional recognition</h3>
		<?php echo $course->professional_recognition ?>
	</section>
<?php endif; ?>