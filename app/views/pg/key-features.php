<div class="panel panel-tertiary row">

	<div class="col-sm-4">
	<strong>Course type: </strong><br />
		<?php if (strpos($course->programme_type, 'research') === false): ?>
			Taught
		<?php elseif (strpos($course->programme_type, 'taught') === false): ?>
			Research
		<?php
		else: ?>
			Taught-research
		<?php endif; ?>
		<br>
		<strong>Mode:</strong><br/> <?php echo $course->mode_of_study; ?> <br/>


	</div>
	<div class="col-sm-4">
		 <strong>Duration an start</strong><br/> 
			 <?php echo $course->attendance_text; ?><br/>
			 Starts <?php echo $course->start; ?>
 			<br/>
			 
 		<?php if(!empty($course->programme_type)): ?>
			 <strong>Study Options</strong><br/> 
			 <?php echo $course->programme_type;?>
		 <br/>
		<?php endif;?>
	</div>
	<div class="col-sm-4">
			
			 <?php if (!empty($course->additional_school[0])): ?>
			<strong>Subject websites:</strong><br/>
			<a href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a>,
			<a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a>
		<?php else: ?>
			<strong>Subject website:</strong><br/>
			<a href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a>
		<?php endif; ?><br/>

		<?php if (!empty($course->accredited_by)): ?>
			<strong>Accredited by</strong><br/> 
			<?php echo $course->accredited_by; ?></li>
		<?php endif; ?>
	</div>
</div>