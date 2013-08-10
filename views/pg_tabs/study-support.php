<h2>Study support</h2>

<?php echo !empty($course->key_information_miscellaneous) ? $course->key_information_miscellaneous : '' ?>

<?php if(!empty($course->globals->careersemployability_text)): ?>
<section class="info-subsection">
	<h4>Careers and employability</h4>
	<?php echo $course->globals->careersemployability_text ?>
</section>
<?php endif; ?>

<?php if(!empty($course->professional_recognition)): ?>
<section class="info-subsection">
	<h4>Professional recognition</h4>
	<?php echo $course->professional_recognition ?>
</section>
<?php endif; ?>

<?php if( ! empty($course->did_you_know_fact_box) ): ?>
<div class="panel content-highlight">
	<h4>Did you know...</h4>
	<?php echo $course->did_you_know_fact_box ?>
</div>
<?php endif; ?>
