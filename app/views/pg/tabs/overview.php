<h2>Overview</h2>

<?php
$syn = trim($course->programme_synopsis);
if(empty($syn)){
	preg_match('%<p[^>]*>(.*?)</p>%i', $course->schoolsubject_overview, $regs);
	echo str_replace($regs[0], '', $course->schoolsubject_overview);
} else {
	echo $course->schoolsubject_overview;
}
?>


<?php if( !empty($course->about_school) ): ?>
	<?php echo $course->about_school; ?>
<?php endif; ?>

<?php if( ! empty($course->did_you_know_fact_box) ): ?>
	<div class="panel panel-tertiary">
		<h3>National ratings</h3>
		<?php echo $course->did_you_know_fact_box ?>
	</div>
<?php endif; ?>

<?php if( $level == 'postgraduate' && !empty($course->globals->research_intensity_title) && !empty($course->globals->research_intensity_text)): ?>
<div class="tef py-2 my-2">
	<div class="tef__text">
		<h2><?php echo $course->globals->research_intensity_title ?></h2>
		<p><?php echo $course->globals->research_intensity_text ?></p>
	</div>
	<img class="tef__image" src="https://kent.ac.uk/courses/images/research-intensity-logo.jpg" alt="Complete University Guide Research Intensity">
</div>
<?php endif; ?>
