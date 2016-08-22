<div class="panel panel-tertiary row">
	<div class="col-sm-4">
			<strong>Entry requriments</strong><br/> 
			TBC <br/>
			 
			 <strong>Study Options</strong><br/> 
			 <?php echo $course->programme_type;?>
			 <br/>
			 <strong>Duration an start</strong><br/> 
			 <?php echo $course->duration; ?><br/>
			 Starts <?php echo $course->start; ?>

	</div>
	<div class="col-sm-4">

		<?php if (!empty($course->additional_school[0])): ?>
			<strong>School websites:</strong><br/>
			<a href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a>,
			<a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a>
		<?php else: ?>
			<strong>School website:</strong><br/>
			<a href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a>
		<?php endif; ?><br/>

		<strong>Mode of study:</strong><br/> <?php echo $course->mode_of_study; ?> <br/>

		<?php if (!empty($course->ucas_code)): ?>
			<strong>UCAS code:</strong><br/> <?php echo $course->ucas_code; ?><br/>
		<?php endif; ?>

	</div>
	
	<div class="col-sm-4">
	TBC
	</div>
</div>