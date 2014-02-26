<h2>Overview</h2>
<?php echo $course->programme_overview_text; ?>

<?php if( ! empty($course->did_you_know_fact_box) ): ?>
<div class="panel content-highlight">
	<h4>Independent rankings</h4>
	<?php echo $course->did_you_know_fact_box ?>
</div>
<?php endif; ?>