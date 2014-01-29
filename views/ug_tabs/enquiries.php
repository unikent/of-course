<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/'); ?>

<h2>Enquiries</h2>

 <?php if(empty($course->subject_to_approval)): ?>
<div class="panel admissions">
	
	<form id="ug_enquiries_form">

		<h2>I would like to...</h2>

		<div class="form-row enquiry-option">
			<div class="enquiry-radio">
				<input type="radio" name="enquire" id="enquire" value="enquiry" checked="checked">
				<label for="enquire" id="enquire-lbl">Make an online enquiry</label>
			</div>
			<div class="prospectus-radio">
				<input type="radio" name="enquire" id="prospectus" value="prospectus">
				<label for="prospectus" id="prospectus-lbl">Order a prospectus <span>(<a href="/courses/undergraduate/prospectus/2014/full-prospectus.pdf" <?php echo "onClick=\"_gaq.push(['t0._trackEvent', 'course-enquiry-download-pdf-ug', 'click', '" . $course->programme_title . "']);\"";?> >PDF - 2MB</a>)</span></label>
			</div>
		</div>
		
		<div class="form-row<?php echo trim($course->mode_of_study) != 'Full-time or part-time' ? ' form-row-study-type' : ''; ?>">
			<label for="enquire-study-type">Type of study</label>
			<select class="input-medium enquiry-select" id="enquire-study-type">
				<option value="ft" <?php echo trim($course->mode_of_study) == 'Full-time only' ? '  selected = "selected"' : ''; ?>>Full-time</option>
				<option value="pt" <?php echo trim($course->mode_of_study) == 'Part-time only' ? '  selected = "selected"' : ''; ?>>Part-time</option>
			</select>
	    </div>
		
		<?php $sits_url = 'https://esd.kent.ac.uk/aspx_shared/newuser.aspx?'; ?>
		<?php $generic_ug_mcr = 'AAGEN101';?>
		<?php if ( trim($course->mode_of_study) == 'Part-time only' || trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			<?php
			$text = 'Part time';
			$enquire = $sits_url . 'CCTC=KENT&UTYP=APP';
			$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CCTC=KENT';

			$event_track_enquire = "onClick=\"_gaq.push(['t0._trackEvent', 'course-enquire-ug', 'click', '" . $course->programme_title . "-" . $course->award[0]->name . "-parttime-" . $course->parttime_mcr_code . "']);\"";
			$event_track_prospectus = "onClick=\"_gaq.push(['t0._trackEvent', 'course-prospectus-ug', 'click', '" . $course->programme_title . "-" . $course->award[0]->name . "-parttime-" . $course->parttime_mcr_code . "']);\"";

			if ($course->parttime_mcr_code != '') {
				$enquire = $sits_url . 'CourseCode=' . $course->parttime_mcr_code . '&CCTC=KENT&UTYP=APP&EnquiryCategoryCode=10';
				$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CourseCode=' . $course->parttime_mcr_code . '&CCTC=KENT';
			}
			else{
				$enquire = $sits_url . 'CCTC=KENT&UTYP=APP&EnquiryCategoryCode=10';
				$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CourseCode=' . $generic_ug_mcr . '&CCTC=KENT';
			}
			?>
			<?php if ( trim($course->mode_of_study) == 'Full-time or part-time' ): ?>
			<div class="courses-sits-enquire courses-sits-enquire-parttime">
			<?php else: ?>
			<div class="courses-sits-enquire courses-sits-enquire-parttime-only">
			<?php endif; ?>
				<a href="<?php echo $enquire ?>" class="apply-link enquire-link parttime-link" <?php echo $event_track_enquire ?>>Enquire about <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link"><?php echo $text ?></span></a>

				<a href="<?php echo $prospectus ?>" class="apply-link prospectus-link parttime-link" <?php echo $event_track_prospectus ?>>Order a prospectus for <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link"><?php echo $text ?></span></a>
			</div>
		<?php endif; ?>

		<?php if ( trim($course->mode_of_study) == 'Full-time only' || trim($course->mode_of_study) == 'Full-time or part-time' ): ?>
			<?php
				$text = 'Full time';
				$enquire = $sits_url . 'CCTC=KENT&UTYP=APP';
				$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CCTC=KENT';
				$event_track_enquire = "onClick=\"_gaq.push(['t0._trackEvent', 'course-enquire-ug', 'click', '" . $course->programme_title . "-" . $course->award[0]->name . "-fulltime-" . $course->fulltime_mcr_code . "']);\"";
				$event_track_prospectus = "onClick=\"_gaq.push(['t0._trackEvent', 'course-prospectus-ug', 'click', '" . $course->programme_title . "-" . $course->award[0]->name . "-fulltime-" . $course->fulltime_mcr_code . "']);\"";
				if ($course->fulltime_mcr_code != '') {
					$enquire = $sits_url . 'CourseCode=' . $course->fulltime_mcr_code . '&CCTC=KENT&UTYP=APP&EnquiryCategoryCode=10';
					$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CourseCode=' . $course->fulltime_mcr_code . '&CCTC=KENT';
				}
				else{
					$enquire = $sits_url . 'CCTC=KENT&UTYP=APP&EnquiryCategoryCode=10';
					$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CourseCode=' . $generic_ug_mcr . '&CCTC=KENT';
				}
			?>
			<div class="courses-sits-enquire courses-sits-enquire-fulltime">
				<a href="<?php echo $enquire ?>" class="apply-link enquire-link fulltime-link" <?php echo $event_track_enquire ?>>Enquire about <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link"><?php echo $text ?></span></a>

				<a href="<?php echo $prospectus ?>" class="apply-link prospectus-link fulltime-link" <?php echo $event_track_prospectus ?>>Order a prospectus for <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link"><?php echo $text ?></span></a>
			</div>
		<?php endif; ?>

	</form>
	
</div><!-- /panel admissions -->
<?php endif; ?>


<section class="info-section">
	<h3>Contacts</h3>
	<section class="info-subsection">
		<h4>Related schools</h4>
		<ul>
			<li><a href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a></li>
			<?php if(!empty($course->additional_school[0])): ?>
			<li><a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a></li>
			<?php endif; ?>
		</ul>
	</section>
	<section class="info-subsection">
		<h4>Enquiries</h4>
		<?php echo $course->enquiries ?>
	</section>
</section>

<section class="info-section">
	<h3>Resources</h3>

	<?php if(!empty($course->subject_leaflet[0])): ?>
	<section class="info-subsection">
		<h4>Download a subject leaflet (pdf)</h4>
		<p>Our subject leaflets provide more detail about individual subjects areas. See:</p>
		<ul>
			<li><a href="<?php echo $course->subject_leaflet[0]->tracking_code ?>"><?php echo $course->subject_leaflet[0]->name ?></a></li>
			<?php if(!empty($course->subject_leaflet_2[0])): ?>
			<li><a href="<?php echo $course->subject_leaflet_2[0]->tracking_code ?>"><?php echo $course->subject_leaflet_2[0]->name ?></a></li>
			<?php endif; ?>
		</ul>
	</section>
	<?php endif; ?>

	<?php if (! empty($course->student_profile) || ! empty($course->student_profile_2) ): ?>
	<section class="info-subsection">
		<h4>Read our student profiles</h4>
		<ul>
			<li><a href="<?php echo $course->student_profile ?>"><?php echo $course->student_profile_1_link_text ?></a></li>
			<?php if(!empty($course->student_profile_2)): ?>
			<li><a href="<?php echo $course->student_profile_2 ?>"><?php echo $course->student_profile_2_link_text ?></a></li>
			<?php endif; ?>
		</ul>
	</section>
	<?php endif; ?>
</section>

<?php if(!empty($course->globals->ug_open_days)): ?>
<section class="info-section">
    <h3>Open days</h3>
    <?php echo $course->globals->ug_open_days ?>
</section>
<?php endif; ?>

<?php if (!empty($course->related_courses)): ?>
<section class="info-section">
	<h3>Related courses</h3>
    <section class="info-subsection">
		<ul>
		  <?php foreach ($course->related_courses as $course_obj): ?>
		  <li><a href="<?php echo Flight::url("{$level}/{$year_for_url}{$course_obj->id}/{$course_obj->slug}"); ?>"><?php echo $course_obj->name ?></a></li>
		  <?php endforeach; ?>
		</ul>
    </section>
</section>
<?php endif; ?>

<?php if ($course->kiscourseid != ''): ?>
<div class="row-fluid kiss-widget-section">
	<div class="span7">
		<div class="panel kis-info">
			<h3>UNISTATS / KIS</h3>
			<h4>Key Information Sets</h4>
			<?php echo $course->kis_explanatory_textarea ?>
		</div>
	</div>
	<div class="span5">
		<?php $ukprn = (isset($course->kis_institution_id) && $course->kis_institution_id != '') ? $course->kis_institution_id : $course->globals->ukprn; ?>
		<iframe class="pull-right" id="unistats-widget-frame" title="Unistats KIS Widget" src="//widget.unistats.ac.uk/Widget/<?php echo $ukprn ?>/<?php echo str_replace(array('/', '|', ':', '&', '.', '>', '+', '#', ';', '?', '@', '='), '_', $course->kiscourseid); ?>/vertical/small/en-GB/Full%20Time" scrolling="no" style="overflow: hidden; border: 0px none transparent; width: 190px; height: 500px;"> </iframe>	
	</div>
</div>
<?php endif; ?>
