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
	<table class="table">
		<thead>
		<tr>
			<th width="70%">Possible modules may include</th>
			<th class="text-xs-center">Credits</th>
			<th class="text-xs-center">ECTS Credits</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$course->module_list = empty($course->module_list)?array():$course->module_list;
		foreach ($course->module_list as $module): ?>
			<tr class="module-row collapsed" data-toggle="collapse" data-target="#<?php echo $module->sds_code; ?>-more">
				<td><span id="<?php echo $module->sds_code ?>" class="module-title"><?php echo $module->sds_code ?> - <?php echo $module->module_title ?></span></td>
				<td class="text-xs-center"><?php echo $module->credit_amount; ?></td>
				<td class="text-xs-center"><?php echo $module->ects_credit ?></td>
			</tr>
			<tr id="<?php echo $module->sds_code; ?>-more" class="collapse">
				<td class="more" colspan="3">
					<div data-toggle="collapse" data-target="#<?php echo $module->sds_code; ?>-more">
						<p><?php echo preg_replace("/\n/",'</p><p>',preg_replace('/[\r\n]+/', "\n", preg_replace('/<br\s*\/?>/',"\n",$module->synopsis))); ?></p>
					</div>
					<a aria-labelledby="#<?php echo $module->sds_code ?>" class="chevron-link" href="/courses/modules/module/<?php echo $module->sds_code ?>">Read more</a>
				</td>
			</tr>
	<?php endforeach; ?>
		</tbody>
	</table>
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
