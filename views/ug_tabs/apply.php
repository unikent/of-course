<div class="panel admissions">
	<h2>Apply</h2>

	<?php if(!empty($course->how_to_apply)): ?>
		<div class="apply-details">
			<?php echo $course->how_to_apply; ?>
		</div>
  	<?php endif; ?>
    
	<form id="ug_apply_form">
		<div class="form-row<?php echo trim($course->mode_of_study) == 'Full-time or part-time' ? '' : ' hide'; ?>">	
			<label for="apply-study-type">Type of study</label>
			<select id="apply-study-type">
				<option value="ft">Full-time</option>
				<option value="pt">Part-time</option>
			</select>
	    </div>
		
		<?php if ( trim($course->mode_of_study) == 'Part-time only' || trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			<?php
			$apply_parttime = 'https://evision.kent.ac.uk/ipp/';
			if ($course->parttime_mcr_code != '') {
				$apply_parttime = 'https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&code1=' . $course->parttime_mcr_code . '&code2=0001';
			}
			?>
			<?php if ( trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			<div class="courses-sits-ug-apply-parttime hide">
			<?php else: ?>
			<div class="courses-sits-ug-apply-parttime">
			<?php endif; ?>
				<a href="<?php echo $apply_parttime ?>" class="apply-link">Apply for <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link">Part time</span></a>
			</div>
		<?php endif; ?>

		<?php if ( trim($course->mode_of_study) == 'Full-time only' || trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			<div class="courses-sits-ug-apply-fulltime">
				<a href="http://www.ucas.com/apply" class="apply-link">Apply for <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link">Full time</span></a>
			</div>
		<?php endif; ?>

	</form>
	

</div>