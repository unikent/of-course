<h2>Careers</h2>

<?php echo $course->careers_overview; ?>
<?php if(!empty($course->globals->careersemployability_text)): ?>
<?php echo $course->globals->careersemployability_text; ?>
<?php endif; ?>

<?php if(!empty($course->professional_recognition)): ?>
<section class="info-section">
	<h3>Professional recognition</h3>
	<?php echo $course->professional_recognition; ?>	
</section>
<?php endif; ?>
