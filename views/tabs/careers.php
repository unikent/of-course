<div class="alert alert-info">
	<h4>Did you know...</h4>
	<p><?php echo $course->did_you_know_fact_box ?></p>
</div>

<h2>Careers</h2>
<?php echo $course->careers_overview; ?>
	<?php if(!empty($course->careersemployability_text)): ?>
	<?php echo $course->careersemployability_text; ?>
	<?php endif; ?>
	
	<?php if(!empty($course->professional_recognition)): ?>
<section class="info-section">
	<h3>Professional recognition</h3>
	<?php echo $course->professional_recognition; ?>	
	
</section>
<?php endif; ?>
