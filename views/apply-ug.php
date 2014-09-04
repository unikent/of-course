<?php
$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);
?>

<h1>Your application <a href="/courses/undergraduate/<?php echo $course->year != $course->current_year ? $course->year . '/' : '' ?><?php echo $course->instance_id ?>/<?php echo $course->slug ?>"><?php echo $course->programme_title ?></a></h1>

<div class="apply-form hidden">
	<h2>Select your course options.</h2>
	
	<p>To begin your application process, you'll need to select your course options below.</p>

	<p><em class="icon-asterisk required"></em> Required fields.</p>

	<div>
		<fieldset class="highlight-fieldset indent">
		    <legend>Course options</legend>
		    <?php if (!$has_parttime): ?>
		    <p id="type" data-type="full-time-ug" class="hidden" aria-hidden="true">Full-time</p>
		    <?php elseif (!$has_fulltime): ?>
		    <p id="type" data-type="part-time" class="hidden" aria-hidden="true">Part-time</p>
		    <?php else: ?>
		    <div class="form-group type">
		        <label for="type">Full-time or part-time <em class="icon-asterisk required"><span class="collapse-text">(required)</span></em></label>
		        <div class="controls">
		            <select name="type" id="type" required="required">
						<?php if($has_fulltime && $has_parttime): ?>
						<option value="pleaseselect">Please select</option>
						<?php endif; ?>
						<?php if($has_fulltime): ?>
							<option value="full-time-ug">Full-time</option>
						<?php endif; ?>
						<?php if($has_parttime): ?>
							<option value="part-time">Part-time</option>
						<?php endif; ?>
					</select>
		        </div>
		    </div>
		    <?php endif; ?>

		    <div class="full-time-text">
				<?php if ( trim($course->mode_of_study) != 'Part-time only' ): ?>
					<?php echo $course->how_to_apply; ?>
					<?php if ( $course->location[0]->name == 'Medway' ): ?>
						<?php echo $course->how_to_apply_medway_fulltime; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			
			<div class="part-time-text">
				<?php if ( trim($course->mode_of_study) == 'Full-time or part-time' || trim($course->mode_of_study) == 'Part-time only' ): ?>
					<?php echo $course->how_to_apply_parttime; ?>
				<?php endif; ?>
			</div>

	        <p id="award" data-award="<?php echo strtolower(str_replace(array(' ', '(', ')'), '', $course->award[0]->{name})) ?>" class="hidden" aria-hidden="true"><?php echo $course->award[0]->{name}?></p>

	        <p id="year" data-year="<?php echo $course->year; ?>" class="hidden" aria-hidden="true"><?php echo $course->year; ?></p>
	        
		</fieldset>
	</div>


	<p class="btn-indent daedalus-tab-action daedaus-js-display">
		<a type="button" id="apply-link-<?php echo strtolower(str_replace(array(' ', '(', ')'), '', $course->award[0]->name)) ?>-part-time-<?php echo $course->year ?>" class="btn btn-large btn-primary next-btn apply-link-courses" tabindex="0" role="button" title="Apply for <?php echo $course->programme_title ?> part-time for <?php echo $course->year ?> entry" href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $course->parttime_mcr_code ?>&amp;code2=<?php echo $course->current_ipo_pt ?>" onclick="_pat.event('course-page', 'apply-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $course->programme_title ?> [<?php echo $course->parttime_mcr_code ?>]');">Next <i class="icon-chevron-right icon-white"></i></a>

		<a type="button" id="apply-link-<?php echo strtolower(str_replace(array(' ', '(', ')'), '', $course->award[0]->name)) ?>-part-time-<?php echo $course->year-1 ?>" class="btn btn-large btn-primary next-btn apply-link-courses" tabindex="0" role="button" title="Apply for <?php echo $course->programme_title ?> part-time for <?php echo $course->year-1 ?> entry" href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $course->parttime_mcr_code ?>&amp;code2=<?php echo $course->previous_ipo_pt ?>" onclick="_pat.event('course-page', 'apply-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year-1 ?>] <?php echo $course->programme_title ?> [<?php echo $course->parttime_mcr_code ?>]');">Next <i class="icon-chevron-right icon-white"></i></a>

		<a href="http://www.ucas.com/apply" type="button" id="apply-link-ucas" class="btn btn-large btn-primary next-btn" tabindex="0" role="button" title="UCAS">Apply through UCAS <i class="icon-chevron-right icon-white"></i></a>

		<a type="button" id="apply-link-dummy" class="btn btn-large next-btn apply-link-courses disabled" tabindex="0" role="button" data-toggle="tooltip" data-placement="right" title="Please select your course options above">Next <i class="icon-chevron-right icon-white"></i></a>
	</p>

</div>

<noscript>
	<ul>

		<li><a href="http://www.ucas.com/apply" title="For all full-time courses, apply through UCAS">Apply through UCAS for all full-time courses</a></li>

		<li><a title="Apply for <?php echo $course->programme_title ?> part-time for <?php echo $course->year ?> entry" href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $course->parttime_mcr_code ?>&amp;code2=<?php echo $course->current_ipo_pt ?>" onclick="_pat.event('course-page', 'apply-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $course->programme_title ?> [<?php echo $course->parttime_mcr_code ?>]');">Apply for <?php echo $course->programme_title ?> part-time for <?php echo $course->year ?> entry</a></li>

		<li><a title="Apply for <?php echo $course->programme_title ?> part-time for <?php echo $course->year-1 ?> entry" href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $course->parttime_mcr_code ?>&amp;code2=<?php echo $course->previous_ipo_pt ?>" onclick="_pat.event('course-page', 'apply-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year-1 ?>] <?php echo $course->programme_title ?> [<?php echo $course->parttime_mcr_code ?>]');">Apply for <?php echo $course->programme_title ?> part-time for <?php echo $course->year-1 ?> entry</a></li>

		
	</ul>
</noscript>