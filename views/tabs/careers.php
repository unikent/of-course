<div class="alert alert-info">
	<h4>Did you know...</h4>
	<p><?php echo $course->did_you_know_fact_box ?></p>
</div>

<h2>Careers</h2>

<p><?php echo $course->careers_overview; ?></p>

<h3>Professional recognition</h3>
<p><?php echo $course->professional_recognition; ?></p>
<p>For more information on the services Kent provides you to improve your career prospects visit <a href="http://www.kent.ac.uk/employability.">www.kent.ac.uk/employability.</a></p>

<?php if(!empty($course->careersemployability_text)): ?>
<p><?php echo $course->careersemployability_text; ?></p>
<?php endif; ?>
