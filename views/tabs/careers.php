<div class="alert alert-info">
	<h4>Did you know...</h4>
	<p><?php echo $course->did_you_know_fact_box ?></p>
</div>

<h2>Careers</h2>

<?php echo $course->careers_overview; ?>

<h3>Professional recognition</h3>
<?php echo $course->professional_recognition; ?>

<p>For more information on the services Kent provides you to improve your career prospects visit <a href="http://www.kent.ac.uk/employability.">www.kent.ac.uk/employability.</a></p>

<?php if(!empty($course->careersemployability_text)): ?>
<?php echo $course->careersemployability_text; ?>
<?php endif; ?>
