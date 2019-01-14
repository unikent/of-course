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
