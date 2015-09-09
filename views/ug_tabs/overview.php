<h2>Overview</h2>
<?php echo $course->programme_overview_text; ?>

<?php if( ! empty($course->did_you_know_fact_box) ): ?>
<div class="panel content-highlight">
	<h4>Independent rankings</h4>
	<?php echo $course->did_you_know_fact_box ?>
</div>
<?php endif; ?>
<ul>
	<li>
		<a href="#!enquire" class="only" role="tab" aria-controls="enquire">
			<span>Contact us or order a prospectus</span>
		</a>
	</li>
</ul>
