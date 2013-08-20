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

	    <div class="form-row">
		<label for="apply-study-award">Award</label>
		<select id="apply-study-award">
			<option>MA</option>
			<option>MSc</option>
	        <option>PhD</option>
		</select>
		</div>
		
		<?php $sits_url = 'https://esd.kent.ac.uk/aspx_shared/newuser.aspx?'; ?>
		<?php if ( trim($course->mode_of_study) == 'Part-time only' || trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			<?php $text = 'Part time'; ?>
			<?php if ( trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			<div class="courses-sits-ug-apply-parttime hide">
			<?php else: ?>
			<div class="courses-sits-ug-apply-parttime">
			<?php endif; ?>
		<?php endif; ?>
		<?php if ( trim($course->mode_of_study) == 'Full-time only' || trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			<?php $text = 'Full time'; ?>
			<div class="courses-sits-ug-apply-fulltime">
		<?php endif; ?>

			<?php foreach ($course->deliveries as $delivery): ?>
				<?php
				$apply = 'https://evision.kent.ac.uk/ipp/';
				if ($delivery->mcr != '') {
					$apply = 'https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&code1=' . $delivery->mcr . '&code2=0001';
				}
				?>
				<a href="<?php echo $apply ?>" class="apply-link">Apply for <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link"><?php echo $text ?></span></a>
			<?php endforeach; ?>

			</div>

	</form>

	
</div>