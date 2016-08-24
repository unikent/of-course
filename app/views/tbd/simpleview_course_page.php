title: <?php echo $course->programme_title ?>
<br>
award: <?php echo $course->award[0]->name ?>
<br>
UCAS code: <?php echo $course->ucas_code ?>
<br>
honours type: <?php echo $course->honours_type ?>
<br>
mode of study: <?php echo $course->mode_of_study ?>
<br>
duration: <?php echo $course->duration ?>
<br>
overview: <?php echo $course->programme_overview_text ?>
<br>
teaching and assessment: <?php echo $course->teaching_and_assessment ?>
<br>
careers: <?php echo $course->careers_overview ?>
<br>
professional recognition: <?php echo $course->professional_recognition ?>
<br>
modules:
<br>

<?php foreach ($course->modules as $stages): ?>
	<?php foreach ($stages as $stage): ?>
		<?php foreach ($stage->clusters as $type): ?>
			<?php foreach ($type as $cluster): ?>
				<?php foreach ($cluster as $module): ?>
					<?php foreach ($module->module as $item): ?>
						<?php echo $item->module_code . ' - ' . $item->module_title . ' - ' . $item->synopsis ?><br><br><br><br>
					<?php endforeach; ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
	<?php endforeach; ?>
<?php endforeach; ?>


<br>
Entry requirements:<br>
<?php echo $course->entry_requirements_overriding_text ?>
<br>
<?php echo $course->ug_general_entry_requirements ?>
<br>
<?php echo $course->general_entry_requirements_link ?>
<br>
