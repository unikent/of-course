
	<h2>Apply</h2>
	<?php
	$evision_url = "evision";
	if(strpos($_SERVER['SERVER_NAME'], 'www-dev')!==false){
		$evision_url = "evision-dev";
	}
	if(strpos($_SERVER['SERVER_NAME'], 'www-test')!==false){
		$evision_url = "evision-test";
	}
	?>

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

 <?php if(empty($course->subject_to_approval)): ?>
    <?php if ( trim($course->mode_of_study) != 'Full-time only' ): ?>
	<form id="ug_apply_form">
		<?php if($course->parttime_mcr_code != ''):?>
			<?php
			$apply = 'https://'.$evision_url.'.kent.ac.uk/ipp/';
			$event_track = "onClick=\"_gaq.push(['t0._trackEvent', 'course-apply-ug', 'click', '" . $course->programme_title . "-" . $course->award[0]->name . "-parttime-" . $course->parttime_mcr_code . "']);\"";
			if ($course->parttime_mcr_code != '') {
				$apply = 'https://'.$evision_url.'.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&code1=' . $course->parttime_mcr_code . '&code2=0001';
			}
			?>
			<a href="<?php echo $apply ?>" class="apply-link" <?php echo $event_track ?>>Apply for <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link">Part time</span></a>
		<?php else:?>
			<p class="apply-link"><strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link">Part time</span><br /><br />This part-time course is not currently open for applications. If you would like to be informed when we are accepting applications, please email <a href="mailto:information@kent.ac.uk">information@kent.ac.uk</a>.</p>
			
		<?php endif;?>
	</form>
	<?php endif; ?>
<?php endif; ?>
