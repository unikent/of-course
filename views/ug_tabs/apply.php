<div class="panel admissions">
	<h2>Apply</h2>


	<?php if(!empty($course->how_to_apply)): ?>
		<div class="apply-details">
			<?php echo $course->how_to_apply; ?>
		</div>
  	<?php endif; ?>
    
	<form id="ug_apply_form">
	
	<div class="form-row <?php echo strcmp($course->mode_of_study, 'Full-time or part-time') == 0 ? '' : 'hide'; ?>">	
		<label for="apply-study-type">Type of study</label>
		<select id="apply-study-type">
			<?php if(strcmp($course->mode_of_study, 'Full-time only') == 0 || strcmp($course->mode_of_study, 'Full-time or part-time') == 0): ?><option>Full time</option><?php endif; ?>
			<?php if(strcmp($course->mode_of_study, 'Part-time only') == 0 || strcmp($course->mode_of_study, 'Full-time or part-time') == 0): ?><option>Part time</option><?php endif; ?>
		</select>
    </div>

	<br>
	
	<a href="#" class="apply-link">Apply for <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link">Full time</span></a>
	<a href="#" class="apply-link">Enquire about <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link">Full time</span></a>
	<a href="#" class="apply-link">Order a prospectus for <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link">Full time</span></a>
	
	</form>
	

</div>