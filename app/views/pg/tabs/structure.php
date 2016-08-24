<?php $show_modules = (strtolower($course->module_session) != 'none'); ?>

<h2>Course structure</h2>

<?php if (!empty($course->programme_overview)): ?>
	<?php echo $course->programme_overview; ?>
<?php endif; ?>

<?php $emptystages = true; ?>

<?php
foreach ($course->modules as $module) {
	if (!empty($module->stages)) {
		$emptystages = false;
		break;
	}
}
?>

<section class="info-section">
	<h3>Modules</h3>

	<?php echo $course->modules_intro; ?>
	<?php
	if ($show_modules):
		?>

		<?php
		$show_count = 10;
		$course->module_list = empty($course->module_list)?array():$course->module_list;

		$first_modules = array_slice($course->module_list, 0, $show_count);
		$other_modules = array_slice($course->module_list, $show_count);
		?>
		<?php foreach ($first_modules as $module): ?>
		<div class="daedalus-show-hide show-hide minimal">
			<p class="show-hide-title"><?php echo $module->sds_code ?> - <?php echo $module->module_title ?> (<?php echo $module->credit_amount; ?> credits)</p>

			<div class="show-hide-content">
				<p><?php echo $module->synopsis ?></p>
				<p><strong>Credits:</strong> <?php echo $module->credit_amount ?> credits
					(<?php echo $module->ects_credit ?> ECTS credits).</p>
				<p class="module-read-more"><a
						href="http://www.kent.ac.uk/courses/modules/module/<?php echo $module->sds_code ?>">Read
						more <i class="icon-arrow-right"></i></a></p>
			</div>
		</div>
	<?php endforeach; ?>

		<?php if (sizeof($other_modules) != 0): ?>

		<a data-toggle="collapse" href="#more-modules">Show more...</a>
		<br/>
		<div id="more-modules" class="collapse">
			<?php foreach ($other_modules as $module): ?>
				<div class="daedalus-show-hide show-hide minimal">
					<p class="show-hide-title"><?php echo $module->sds_code ?>
						- <?php echo $module->module_title ?> (<?php echo $module->credit_amount; ?> credits)</p>

					<div class="show-hide-content">
						<p><?php echo $module->synopsis ?></p>
						<p><strong>Credits:</strong> <?php echo $module->credit_amount ?> credits
							(<?php echo $module->ects_credit ?> ECTS credits).</p>

						<p class="module-read-more"><a
								href="http://www.kent.ac.uk/courses/modules/module/<?php echo $module->sds_code ?>">Read
								more <i class="icon-arrow-right"></i></a></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php endif; ?>
</section>
<section class="info-section">

	<?php if (!empty($course->assessment)): ?>
		<h3>Teaching and Assessment</h3>
		<section class="info-subsection">
			<?php echo $course->assessment ?>
		</section>
	<?php endif; ?>

	<?php if (!empty($course->programme_aims)): ?>
		<h3>Programme aims</h3>
		<section class="info-subsection">
			<?php echo $course->programme_aims ?>
		</section>
	<?php endif; ?>

	<?php if (!empty($course->knowledge_and_understanding_learning_outcomes)): ?>
		<h3>Learning outcomes</h3>
		<section class="info-subsection">
			<h4>Knowledge and understanding</h4>
			<?php echo $course->knowledge_and_understanding_learning_outcomes ?>
		</section>
	<?php endif; ?>

	<?php if (!empty($course->intellectual_skills_learning_outcomes)): ?>
		<section class="info-subsection">
			<h4>Intellectual skills</h4>
			<?php echo $course->intellectual_skills_learning_outcomes ?>
		</section>
	<?php endif; ?>

	<?php if (!empty($course->subjectspecific_skills_learning_outcomes)): ?>
		<section class="info-subsection">
			<h4>Subject-specific skills</h4>
			<?php echo $course->subjectspecific_skills_learning_outcomes ?>
		</section>
	<?php endif; ?>

	<?php if (!empty($course->transferable_skills_learning_outcomes)): ?>
		<section class="info-subsection">
			<h4>Transferable skills</h4>
			<?php echo $course->transferable_skills_learning_outcomes ?>
		</section>
	<?php endif; ?>
</section>
