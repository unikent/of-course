<?php
$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);
?>

<h1>Your application - <?php echo $course->programme_title ?></h1>

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
				<h3>Full-time applicants</h3>
				<p>Full-time applicants (including international applicants) should apply through the&nbsp;<a href="http://www.ucas.com/apply" onclick="ga('send','event','course-page','ug-apply-ucas')" rel="nofollow" target="_blank">Universities and Colleges Admissions Service (UCAS)</a>&nbsp;system. If you need help or advice on your application, you should speak with your careers advisor or contact <a href="http://www.ucas.com/about-us/contact-us" onclick="ga('send','event','course-page','ug-apply-ucas-customer-contact')" target="_blank">UCAS Customer Contact Centre.</a>&nbsp;You can also write to UCAS at:</p>

				<p>UCAS Customer Contact Centre,<br>
				PO Box 28,<br>
				Cheltenham<br>
				GL52 3LZ</p>

				<p>The institution code number of the University of Kent is K24, and the code name is KENT.</p>

				<h4>Application deadlines</h4>

				<p>See our <a href="http://www.kent.ac.uk/courses/undergraduate/apply/how.html#!ucas">UCAS application timeline</a> for&nbsp;information about deadlines and an outline of the UCAS process.&nbsp;</p>
			</div>
			
			<div class="part-time-text">
				<h3>Part-time applicants</h3>
				<p>If you need more advice on making an application or choosing your programme, please contact the Recruitment and Admissions Office:</p>
				<ul>
					<li>T: +44 (0)1227 827272</li>
					<li>Freephone (UK only): 0800 975 3777</li>
					<li>or make an online enquiry (click on 'enquire' on the right-hand side).</li>
				</ul>
				<p>Part-time students should apply directly to the University. There is no fixed closing date, but you should apply for your programme as early a possible. You can apply online by clicking&nbsp;the link below:</p>
			</div>

	        <p id="award" data-award="<?php echo strtolower(str_replace(array(' ', '(', ')'), '', $course->award[0]->{name})) ?>" class="hidden" aria-hidden="true"><?php echo $course->award[0]->{name}?></p>

		    <div class="form-group year">
		        <label for="year">Year of entry <em class="icon-asterisk required"><span class="collapse-text">(required)</span></em></label>
		        <div class="controls">
		            <select name="year" id="year" required="required">
						<option value="<?php echo $course->year?>"><?php echo $course->year?></option>
						<?php if ($course->current_year == $course->year): ?>
						<option value="<?php echo $course->year-1?>"><?php echo $course->year-1?></option>
						<?php else: ?>
						<option value="<?php echo $course->year+1?>"><?php echo $course->year+1?></option>
						<?php endif; ?>
					</select>
				</div>
		    </div>
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
