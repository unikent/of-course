<h2>Teaching and assessment</h2>
<?php echo $course->teaching_and_assessment; ?>

<?php if(!empty($course->contact_hours)): ?>
    <section class="info-section">
        <h3>Contact Hours</h3>
		<?php echo $course->contact_hours; ?>
    </section>
<?php endif; ?>

<?php if(!empty($course->programme_aims)): ?>
<section class="info-section">
	<h3>Programme aims</h3>
	<?php echo $course->programme_aims; ?>
</section>
<?php endif; ?>

<?php if(!empty($course->learning_outcomes) ||
			!empty($course->intellectual_skills_learning_outcomes) ||
			!empty($course->subjectspecific_skills_learning_outcomes) ||
			!empty($course->transferable_skills_learning_outcomes)
			): ?>

<section class="info-section">
	<h3>Learning outcomes</h3>
	
	<?php if(!empty($course->learning_outcomes)): ?>
	<section class="info-subsection">
		<h4>Knowledge and understanding</h4>
		<?php echo $course->learning_outcomes; ?>
	</section>
	<?php endif; ?>
	
	<?php if(!empty($course->intellectual_skills_learning_outcomes)): ?>
	<section class="info-subsection">
		<h4>Intellectual skills</h4>
		<?php echo $course->intellectual_skills_learning_outcomes; ?>
	</section>
	<?php endif; ?>
	
	<?php if(!empty($course->subjectspecific_skills_learning_outcomes)): ?>
	<section class="info-subsection">
		<h4>Subject-specific skills</h4>
		<?php echo $course->subjectspecific_skills_learning_outcomes; ?>
	</section>
	<?php endif; ?>
	
	<?php if(!empty($course->transferable_skills_learning_outcomes)): ?>
	<section class="info-subsection">
		<h4>Transferable skills</h4>
		<?php echo $course->transferable_skills_learning_outcomes; ?>
	</section>
	<?php endif; ?>
	
</section>

<?php endif; ?>