<h2>Overview</h2>

<?php echo $course->schoolsubject_overview; ?>

<?php if( !empty($course->about_school) ): ?>
	<?php echo $course->about_school; ?>
<?php endif; ?>

<?php if( ! empty($course->did_you_know_fact_box) ): ?>
	<div class="panel content-highlight">
		<h3>National ratings</h3>
		<?php echo $course->did_you_know_fact_box ?>
	</div>
<?php endif; ?>
<ul>
	<li>
		<a href="#!enquiries" class="only" role="tab" aria-controls="enquire">
			<span>Contact us or order a prospectus</span>
		</a>
	</li>
</ul>
