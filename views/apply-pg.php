<?php
$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);
?>

<h1>Your application <a href="/courses/postgraduate/<?php echo $course->year != $course->current_year ? $course->year . '/' : '' ?><?php echo $course->instance_id ?>/<?php echo $course->slug ?>"><?php echo $course->programme_title ?></a></h1>

<div class="apply-form hidden">
	<h2>Select your course options.</h2>

	<p>To begin your application process, you'll need to select your course options below.</p>

	<p><em class="icon-asterisk required"></em> All fields below are required.</p>

	<div>
		<fieldset class="highlight-fieldset indent">
		    <legend>Course options</legend>
		    <?php if (!$has_parttime): ?>
		    <p id="type" data-type="full-time" class="hidden" aria-hidden="true">Full-time</p>
		    <?php elseif (!$has_fulltime): ?>
		    <p id="type" data-type="part-time" class="hidden" aria-hidden="true">Part-time</p>
		    <?php else: ?>
		    <div class="form-group">
		        <label for="type">Full-time or part-time <em class="icon-asterisk required"><span class="collapse-text">(required)</span></em></label>
		        <div class="controls">
		            <select name="type" id="type" required="required">
						<?php if($has_fulltime && $has_parttime): ?>
						<option value="pleaseselect">Please select</option>
						<?php endif; ?>
						<?php if($has_fulltime): ?>
							<option value="full-time">Full-time</option>
						<?php endif; ?>
						<?php if($has_parttime): ?>
							<option value="part-time">Part-time</option>
						<?php endif; ?>
					</select>
		        </div>
		    </div>
		    <?php endif; ?>

		    <?php if (sizeof($course->award) === 1): ?>
	        <p id="award" data-award="<?php echo strtolower(str_replace(' ', '', $course->award[0]->{name})) ?>" class="hidden" aria-hidden="true"><?php echo $course->award[0]->{name}?></p>
	        <?php else: ?>
		    <div class="form-group">
		        <label for="award">Award <em class="icon-asterisk required"><span class="collapse-text">(required)</span></em></label>
		        <div class="controls">
		            <select name="award" id="award" required="required">
		            	
						<option value="pleaseselect">Please select</option>
						<?php foreach ($course->award as $award): ?>
						<option value="<?php echo strtolower(str_replace(' ', '', $award->name)) ?>"><?php echo $award->name?></option>
						<?php endforeach; ?>
						
					</select>
				</div>
		    </div>
		    <?php endif; ?>

		    <div class="form-group coursetwo-row">
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

	<?php foreach ($course->deliveries as $delivery): ?>

	<p class="btn-indent daedalus-tab-action daedaus-js-display">
		<a type="button" id="apply-link-<?php echo strtolower(str_replace(' ', '', $delivery->award_name)) ?>-<?php echo $delivery->attendance_pattern ?>-<?php echo $course->year ?>" class="btn btn-large btn-primary next-btn apply-link-courses" tabindex="0" role="button" title="Apply for <?php echo $delivery->description ?>" href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->current_ipo ?>" onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $delivery->programme_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>]');">Next <i class="icon-chevron-right icon-white"></i></a>
	</p>

	<p class="btn-indent daedalus-tab-action daedaus-js-display">
		<a type="button" id="apply-link-<?php echo strtolower(str_replace(' ', '', $delivery->award_name)) ?>-<?php echo $delivery->attendance_pattern ?>-<?php echo $course->year-1 ?>" class="btn btn-large btn-primary next-btn apply-link-courses" tabindex="0" role="button" title="Apply for <?php echo $delivery->description ?>" href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->previous_ipo ?>" onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $delivery->programme_id ?> in <?php echo $course->year-1 ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>]');">Next <i class="icon-chevron-right icon-white"></i></a>
	</p>

	<?php endforeach; ?>

	<p class="btn-indent daedalus-tab-action daedaus-js-display">
		<a type="button" id="apply-link-dummy" class="btn btn-large next-btn apply-link-courses disabled" tabindex="0" role="button" data-toggle="tooltip" data-placement="right" title="Please select your course options above">Next <i class="icon-chevron-right icon-white"></i></a>
	</p>

</div>

<noscript>
	<ul>
	<?php foreach ($course->deliveries as $delivery): ?>
		<li><p><a title="Apply for <?php echo $delivery->description ?>" href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->current_ipo ?>" onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $delivery->programme_id ?> in <?php echo $course->year ?>] <?php echo description ?> [<?php echo $delivery->mcr ?>]');">Apply for <?php echo $course->year ?> entry to <?php echo $delivery->description ?></a></p></li>

		<li><p><a title="Apply for <?php echo $delivery->description ?>" href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->previous_ipo ?>" onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $delivery->programme_id ?> in <?php echo $course->year ?>] <?php echo description ?> [<?php echo $delivery->mcr ?>]');">Apply for <?php echo $course->year-1 ?> entry to <?php echo $delivery->description ?></a></p></li>

	<?php endforeach; ?>
	</ul>
</noscript>
