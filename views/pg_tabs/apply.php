<div class="panel admissions">
	<h2>Apply</h2>


	<?php if(!empty($course->how_to_apply)): ?>
		<div class="apply-details">
			<?php echo $course->how_to_apply; ?>
		</div>
	<?php endif; ?>

<?php if(empty($course->subject_to_approval)): ?>
	<?php if ( !empty($course->deliveries) ): ?>
	<form id="ug_apply_form">
		<div class="form-row<?php echo trim($course->mode_of_study) != 'Full-time or part-time' ? ' form-row-study-type' : ''; ?>">
			<label for="apply-study-type">Type of study</label>
			<select id="apply-study-type">
				<option value="ft">Full-time</option>
				<option value="pt">Part-time</option>
			</select>
	    </div>

		<div class="form-row">
			<label for="apply-study-award">Award</label>
			<select class="input-medium apply-select" id="apply-study-award">
				<?php foreach($course->award as $award): ?>
				<option value="<?php echo $award->name ?>"><?php echo $award->name ?></option>
				<?php endforeach; ?>
			</select>
		</div>


		<?php if ( trim($course->mode_of_study) == 'Part-time only' || trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			
			<?php if ( trim($course->mode_of_study) == 'Full-time or part-time' ): ?>
			<div class="courses-sits-apply courses-sits-apply-parttime">
			<?php else: ?>
			<div class="courses-sits-apply courses-sits-apply-parttime-only">
			<?php endif; ?>
			<?php foreach ($course->deliveries as $delivery): ?>
				<?php if ($delivery->attendance_pattern == 'part-time'): ?>
				<?php
				$apply = 'https://evision.kent.ac.uk/ipp/';
				$event_track = "onClick=\"_gaq.push(['t0._trackEvent', 'course-apply-pg', 'click', '" . $course->programme_title . "-" . $delivery->award_name . "-parttime-" . $delivery->mcr . "']);\"";
				if ($delivery->mcr != '') {
					$apply = 'https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&code1=' . $delivery->mcr . '&code2=0001';
				}
				?>
				<a href="<?php echo $apply ?>" class="apply-link parttime-link award-link-<?php echo $delivery->award_name ?>" <?php echo $event_track ?>>Apply for <strong><?php echo $course->programme_title; ?> <?php echo $delivery->award_name; ?></strong> - <span class="apply-type-link">Part time</span></a>
				<?php endif; ?>
			<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php if ( trim($course->mode_of_study) == 'Full-time only' || trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			<?php $event_track = "onClick=\"_gaq.push(['t0._trackEvent', 'course-apply-pg', 'click', '" . $course->programme_title . "-fulltime']);\""; ?>
			<div class="courses-sits-apply courses-sits-apply-fulltime">
			<?php foreach ($course->deliveries as $delivery): ?>
				<?php if ($delivery->attendance_pattern == 'full-time'): ?>
				<?php
				$apply = 'https://evision.kent.ac.uk/ipp/';
				$event_track = "onClick=\"_gaq.push(['t0._trackEvent', 'course-apply-pg', 'click', '" . $course->programme_title . "-" . $delivery->award_name . "-fulltime-" . $delivery->mcr . "']);\"";
				if ($delivery->mcr != '') {
					$apply = 'https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&code1=' . $delivery->mcr . '&code2=0001';
				}
				?>
				<a href="<?php echo $apply ?>" class="apply-link fulltime-link award-link-<?php echo $delivery->award_name ?>" <?php echo $event_track ?>>Apply for <strong><?php echo $course->programme_title; ?> <?php echo $delivery->award_name; ?></strong> - <span class="apply-type-link">Full time</span></a>
				<?php endif; ?>
			<?php endforeach; ?>
			</div>
		<?php endif; ?>

			

	</form>
	<?php endif; ?>
<?php endif; ?>	
</div>