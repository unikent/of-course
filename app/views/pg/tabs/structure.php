<?php 
/* 
this deals with the display of the PG Course Structure Section

Note: we are deliberatly using modified logic for the display of courses 2019 and onwards 
to be more CMA compliant without affecting the display of course information for courses
which are already in progress or complete
*/

$show_modules = (strtolower($course->module_session) != 'none'); 

?>

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
	<?php if ($show_modules): ?>

		<?php
		// pre 2019 display the modules in $course->module_list
		// otherwise construct a list of compulsory and optional modules
		if ($course->year >= '2019') {

			$sets_of_modules = $course->modules;

			// default to showing no structure
			$modules = false;

			// search the sets of modules to find a match
			foreach ($sets_of_modules as $modules_set) {
				// mcr override - if value is set then we only want things that match that mcr
				if ($course->display_course_structure_mcr) {
					if ($course->display_course_structure_mcr === $modules_set->mcr) {
						$modules = $modules_set;
						break;
					}
				}
				else {
					// match attendance_pattern and award_name
					if (($course->display_course_structure_award === $modules_set->award_name)
						&& ($course->display_course_structure_attendance_pattern === $modules_set->attendance_pattern)
					) {
						$modules = $modules_set;
						break;
					}
				}
				// otherwise we have no modules selected
			}

			if (isset($course->module_description)) {
				echo $course->module_description;
			}
			
			// is it possible that the chosen delivery does not actually have any modules
			// so check that $modules is what we expect
			if ($modules && is_object($modules) && isset($modules->stages) && is_object($modules->stages)) {
				foreach ($modules->stages as $stage_id => $stage) {
					Flight::render(
						'partials/stage-2019-onwards',
						array('stage' => $stage,
							'stage_id' => $stage_id)
					);
				}
			} else {
				?>
				<p>No modules information available for this delivery.</p>
				<?php
			}
		} else {
			// pre-2019 display logic
			// TODO make this mixture of php styles here more consistent
			?>
				<table class="table">
				<thead>
					<tr>
						<th width="70%">Modules may include</th>
						<th class="text-xs-center">Credits</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$course->module_list = empty($course->module_list)?array():$course->module_list;
					foreach ($course->module_list as $module): ?>

						<tr class="module-row">
							<td class="module-text">
								<span data-toggle="collapse" data-target="#<?php echo $module->sds_code; ?>-more" id="<?php echo $module->sds_code ?>" class="module-row collapsed module-title"><?php echo $module->sds_code ?> - <?php echo $module->module_title ?></span>
								<div class="collapse" id="<?php echo $module->sds_code; ?>-more">
									<div class="more">
										<p><?php echo preg_replace("/\n/",'</p><p>',preg_replace('/[\r\n]+/', "\n", preg_replace('/<br\s*\/?>/',"\n",$module->synopsis))); ?></p>
										<a aria-labelledby="#<?php echo $module->sds_code ?>" class="chevron-link" href="/courses/modules/module/<?php echo $module->sds_code ?>">View full module details</a>
									</div>
								</div>
							</td>
							<td class="text-xs-center"><?php echo $module->credit_amount; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<?php
		}
	?>


	<?php endif; // show modules ?>
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
