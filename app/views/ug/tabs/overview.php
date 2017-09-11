<h2>Overview</h2>

<?php
	$syn = trim($course->programme_synopsis);
	if(empty($syn)){
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


<?php if( $level == 'undergraduate' && !empty($course->globals->tef_title) && !empty($course->globals->tef_text)): ?>
<div class="content-container tef py-2 my-2">
	<div class="tef__text">
		<h2><?php echo $course->globals->tef_title ?></h2>
		<p><?php echo $course->globals->tef_text ?></p>
	</div>
	<img class="tef__image" src="https://kent.ac.uk/courses/images/tef-gold-logo.jpg" alt="TEF Gold logo">
</div>
<?php endif; ?>
