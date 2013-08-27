<div class="panel admissions">
	<h2>Apply</h2>

	<?php if(!empty($course->how_to_apply)): ?>
		<div class="apply-details">

		<?php if ( trim($course->mode_of_study) != 'Part-time only' ): ?>
			<?php echo $course->how_to_apply; ?>
			<?php if ( $course->location[0]->name == 'Medway' ): ?>
				<?php echo $course->how_to_apply_medway_fulltime; ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( trim($course->mode_of_study) == 'Full-time or part-time' || trim($course->mode_of_study) == 'Part-time only' ): ?>
			<?php echo $course->how_to_apply_parttime; ?>
		<?php endif; ?>

		</div>
  	<?php endif; ?>
    
    <?php if ( trim($course->mode_of_study) != 'Full-time only' ): ?>
	<form id="ug_apply_form">
			<?php
			$apply = 'https://evision.kent.ac.uk/ipp/';
			if ($course->parttime_mcr_code != '') {
				$apply = 'https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&code1=' . $course->parttime_mcr_code . '&code2=0001';
			}
			?>
			<a href="<?php echo $apply ?>" class="apply-link">Apply for <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link">Part time</span></a>
	</form>
	<?php endif; ?>

</div>