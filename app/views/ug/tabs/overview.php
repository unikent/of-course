<h2>Overview</h2>

<?php

	if(empty(trim($course->programme_synopsis))){
		preg_match('%<p[^>]*>(.*?)</p>%i', $course->programme_overview_text, $regs);
		echo str_replace($regs[0], '', $course->programme_overview_text);
	} else {
		echo $course->programme_overview_text;
	}
?>

<?php if( !empty($course->about_school) ): ?>
	<?php echo $course->about_school; ?>
<?php endif; ?>

<?php if( ! empty($course->did_you_know_fact_box) ): ?>
<div class="panel panel-tertiary">
	<h4>Independent rankings</h4>
	<?php echo $course->did_you_know_fact_box ?>
</div>
<?php endif; ?>
