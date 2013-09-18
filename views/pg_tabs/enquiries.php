<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/'); ?>

<?php if(empty($course->subject_to_approval)): ?>
<div class="panel admissions">

	<h2>I would like to...</h2>
	
	<form id="pg_enquiries_form">
		<div class="form-row enquiry-option">
			<div class="enquiry-radio">
				<input type="radio" name="enquire" id="enquire" value="enquiry" checked="checked">
				<label for="enquire" id="enquire-lbl">Make an online enquiry</label>
			</div>
			<div class="prospectus-radio">
				<input type="radio" name="enquire" id="prospectus" value="prospectus">
				<label for="prospectus" id="prospectus-lbl">Order a prospectus <span>(<a href="#">PDF - 2MB</a>)</span></label>
			</div>
		</div>

		<div style="">
			<div class="form-row<?php echo trim($course->mode_of_study) != 'Full-time or part-time' ? ' form-row-study-type' : ''; ?>">
				<label for="enquire-study-type">Type of study</label>
				<select class="input-medium enquiry-select" id="enquire-study-type">
					<option value="ft" <?php echo trim($course->mode_of_study) == 'Full-time only' ? '  selected = "selected"' : ''; ?>>Full-time</option>
					<option value="pt" <?php echo trim($course->mode_of_study) == 'Part-time only' ? '  selected = "selected"' : ''; ?>>Part-time</option>
				</select>
		    </div>
			
			<?php if ( sizeof($course->award) > 1 ): ?>
			<div class="form-row">
				<label for="enquire-study-award">Award</label>
				<select class="input-medium enquiry-select" id="enquire-study-award">
					<?php foreach($course->award as $award): ?>
					<option value="<?php echo $award->name ?>"><?php echo $award->name ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<?php endif; ?>

			<div style="clear:both"></div>
		</div>

		<?php $sits_url = 'https://esd.kent.ac.uk/aspx_shared/newuser.aspx?'; ?>
		<?php $generic_pg_mcr = 'AAGEN102';?>
			<?php /* part-time links */ if ( trim($course->mode_of_study) == 'Part-time only' || trim($course->mode_of_study) == 'Full-time or part-time'): ?>

			<?php if ( trim($course->mode_of_study) == 'Full-time or part-time' ): ?>
			<div class="courses-sits-enquire courses-sits-enquire-parttime">
			<?php else: ?>
			<div class="courses-sits-enquire courses-sits-enquire-parttime-only">
			<?php endif; ?>
			<?php foreach ($course->deliveries as $delivery): ?>
				<?php if ($delivery->attendance_pattern == 'part-time'): ?>
				<?php
				$enquire = $sits_url . 'CCTC=KENT&UTYP=APP';
				$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CCTC=KENT';
				$event_track_enquire = "onClick=\"_gaq.push(['t0._trackEvent', 'course-enquire-pg', 'click', '" . $course->programme_title . "-" . $delivery->award_name . "-parttime-" . $delivery->mcr . "']);\"";
				$event_track_prospectus = "onClick=\"_gaq.push(['t0._trackEvent', 'course-prospectus-pg', 'click', '" . $course->programme_title . "-" . $delivery->award_name . "-parttime-" . $delivery->mcr . "']);\"";
				if ($delivery->mcr != '') {
					$enquire = $sits_url . 'CourseCode=' . $delivery->mcr . '&CCTC=KENT&UTYP=APP&EnquiryCategoryCode=10';
					$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CourseCode=' . $delivery->mcr . '&CCTC=KENT';
				}
				else{
					$enquire = $sits_url .'CCTC=KENT&UTYP=APP&EnquiryCategoryCode=10';
					$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CourseCode='.$generic_pg_mcr.'&CCTC=KENT';
				}
				?>
				<a href="<?php echo $enquire ?>" class="apply-link enquire-link parttime-link award-link-<?php echo $delivery->award_name ?>" <?php echo $event_track_enquire ?>>Enquire about <strong><?php echo $course->programme_title; ?> <?php echo $delivery->award_name; ?><?php echo $delivery->description != '' ? ' - ' . $delivery->description : ''?></strong></a>

				<a href="<?php echo $prospectus ?>" class="apply-link prospectus-link parttime-link award-link-<?php echo $delivery->award_name ?>" <?php echo $event_track_prospectus ?>>Order a prospectus for <strong><?php echo $course->programme_title; ?> <?php echo $delivery->award_name; ?><?php echo $delivery->description != '' ? ' - ' . $delivery->description : ''?></strong></a>
				<?php endif; ?>
			<?php endforeach; ?>

			<?php /* in case there are no deliveries, just show a basic set of links */ if ( empty($course->deliveries) ): ?>
				<?php
				$event_track_enquire = "onClick=\"_gaq.push(['t0._trackEvent', 'course-enquire-pg', 'click', '" . $course->programme_title . "-parttime']);\"";
				$event_track_prospectus = "onClick=\"_gaq.push(['t0._trackEvent', 'course-prospectus-pg', 'click', '" . $course->programme_title . "-parttime']);\"";
				?>
				<?php $enquire = $sits_url . 'CCTC=KENT&UTYP=APP'; $prospectus = $sits_url . 'CourseCode='.$generic_pg_mcr.'&EnquiryCategoryCode=PRO&CCTC=KENT';?>
				<?php foreach($course->award as $award): ?>
				<a href="<?php echo $enquire ?>" class="apply-link enquire-link parttime-link award-link-<?php echo $award->name; ?>" <?php echo $event_track_enquire ?>>Enquire about <strong><?php echo $course->programme_title; ?> <?php echo $award->name; ?></strong></a>

				<a href="<?php echo $prospectus ?>" class="apply-link prospectus-link parttime-link award-link-<?php echo $award->name; ?>" <?php echo $event_track_prospectus ?>>Order a prospectus for <strong><?php echo $course->programme_title; ?> <?php echo $award->name; ?></strong></a>
				<?php endforeach; ?>
			<?php endif; ?>

			</div>
			<?php endif; ?>

			<?php /* full-time links */ if ( trim($course->mode_of_study) == 'Full-time only' || trim($course->mode_of_study) == 'Full-time or part-time'): ?>

			<?php
			$event_track_enquire = "onClick=\"_gaq.push(['t0._trackEvent', 'course-enquire-pg', 'click', '" . $course->programme_title . "-fulltime']);\"";
			$event_track_prospectus = "onClick=\"_gaq.push(['t0._trackEvent', 'course-prospectus-pg', 'click', '" . $course->programme_title . "-fulltime']);\"";
			?>

			<div class="courses-sits-enquire courses-sits-enquire-fulltime">
			<?php foreach ($course->deliveries as $delivery): ?>
				<?php if ($delivery->attendance_pattern == 'full-time'): ?>
				<?php
				$enquire = $sits_url . 'CCTC=KENT&UTYP=APP';
				$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CCTC=KENT';
				$event_track_enquire = "onClick=\"_gaq.push(['t0._trackEvent', 'course-enquire-pg', 'click', '" . $course->programme_title . "-" . $delivery->award_name . "-fulltime-" . $delivery->mcr . "']);\"";
				$event_track_prospectus = "onClick=\"_gaq.push(['t0._trackEvent', 'course-prospectus-pg', 'click', '" . $course->programme_title . "-" . $delivery->award_name . "-fulltime-" . $delivery->mcr . "']);\"";
				if ($delivery->mcr != '') {
					$enquire = $sits_url . 'CourseCode=' . $delivery->mcr . '&CCTC=KENT&UTYP=APP&EnquiryCategoryCode=10';
					$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CourseCode=' . $delivery->mcr . '&CCTC=KENT';
				}
				else{
					$enquire = $sits_url . 'CCTC=KENT&UTYP=APP&EnquiryCategoryCode=10';
					$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CourseCode='.$generic_pg_mcr.'&CCTC=KENT';
				}
				?>
				<a href="<?php echo $enquire ?>" class="apply-link enquire-link fulltime-link award-link-<?php echo $delivery->award_name ?>" <?php echo $event_track_enquire ?>>Enquire about <strong><?php echo $course->programme_title; ?> <?php echo $delivery->award_name; ?><?php echo $delivery->description != '' ? ' - ' . $delivery->description : ''?></strong></a>

				<a href="<?php echo $prospectus ?>" class="apply-link prospectus-link fulltime-link award-link-<?php echo $delivery->award_name ?>" <?php echo $event_track_prospectus ?>>Order a prospectus for <strong><?php echo $course->programme_title; ?> <?php echo $delivery->award_name; ?><?php echo $delivery->description != '' ? ' - ' . $delivery->description : ''?></strong></a>
				<?php endif; ?>
			<?php endforeach; ?>

			<?php /* in case there are no deliveries, just show a basic set of links */ if ( empty($course->deliveries) ): ?>
				<?php $enquire = $sits_url . 'CCTC=KENT&UTYP=APP'; $prospectus = $sits_url . 'CourseCode='.$generic_pg_mcr.'&EnquiryCategoryCode=PRO&CCTC=KENT';?>
				<?php foreach($course->award as $award): ?>
				<a href="<?php echo $enquire ?>" class="apply-link enquire-link fulltime-link award-link-<?php echo $award->name; ?>" <?php echo $event_track_enquire ?>>Enquire about <strong><?php echo $course->programme_title; ?> <?php echo $award->name; ?></strong></a>

				<a href="<?php echo $prospectus ?>" class="apply-link prospectus-link fulltime-link award-link-<?php echo $award->name; ?>" <?php echo $event_track_prospectus ?>>Order a prospectus for <strong><?php echo $course->programme_title; ?> <?php echo $award->name; ?></strong></a>
				<?php endforeach; ?>
			<?php endif; ?>

			</div>
			<?php endif; ?>


			<p class="apply-link fulltime-link courses-sits-enquire-hidden-ft" style="display:none"><strong>No matching courses</strong><br /><br />There are currently no courses matching your selection. Please make a different selection.</p>
		
			<p class="apply-link parttime-link courses-sits-enquire-hidden-pt" style="display:none"><strong>No matching courses</strong><br /><br />There are currently no courses matching your selection. Please make a different selection.</p>

	</form>
	
</div><!-- /panel admissions -->
<?php endif; ?>


<section class="info-section">
	<h3>Contacts</h3>

	<?php if(!empty($course->globals->enquiries)): ?>
		<div class="contacts-enquiries">
		<h4>Admissions enquiries</h4>
		<?php echo $course->globals->enquiries ?>
		</div>
	<?php endif; ?>

	<?php if( ! empty($course->enquiries) ): ?>
		<div class="contacts-enquiries">
		<h4>Subject enquiries</h4>
		<?php echo $course->enquiries ?>
		</div>
	<?php endif; ?>

	<section class="info-subsection">
		
		<?php if(!empty($course->additional_school[0])): ?>
			<h4>School websites</h4>
			<ul>
				<li><a href="<?php echo $course->school_website ?>"><?php echo $course->administrative_school[0]->name ?></a></li>
				<li><a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a></li>
			</ul>
			
		<?php else: ?>
			<h4>School website</h4>
			<ul>
				<li><a href="<?php echo $course->school_website ?>"><?php echo $course->administrative_school[0]->name ?></a></li>
			</ul>
		<?php endif; ?>
	
		<h4>Graduate School</h4>
		<?php echo $course->globals->graduate_school; ?>
		
	</section>

</section>

<section class="info-section">

	<?php if ( !empty($course->student_profile)  || !empty($course->programme_leaflet)): ?>
		<h3>Resources</h3>

		<?php if(!empty($course->programme_leaflet)): ?>
	 	<section class="info-subsection">
	 		<h4>Download a subject leaflet (pdf)</h4>
	 		<p>Our subject leaflets provide more detail about individual subjects areas. See:</p>
	 		<ul>
				<?php foreach ($course->programme_leaflet as $leaflet): ?>
					<li><a href="<?php echo $leaflet->tracking_code ?>"><?php echo $leaflet->name ?></a></li>
				<?php endforeach; ?>
			</ul>
		</section>
		<?php endif; ?>

		<?php if ( ! empty($course->student_profile) ): ?>
		<section class="info-subsection">
			<h4>Read our student profile</h4>
			<ul>
				<li><a href="<?php echo $course->student_profile ?>"><?php echo $course->student_profile_name ?></a></li>
			</ul>
		</section>
		<?php endif; ?>

	<?php endif; ?>
	

	<?php if(!empty($course->globals->pg_open_days)): ?>
	<section class="info-subsection">
	    <div class="panel content-highlight">
			<h4>Open days</h4>
			 <?php echo $course->globals->pg_open_days ?>
		</div>
	</section>
	<?php endif; ?>
	
</section>

<?php if (!empty($course->related_courses)): ?>
<section class="info-section">
	<h3>Related programmes</h3>
    <section class="info-subsection">
		<ul>
		  <?php foreach ($course->related_courses as $course_obj): ?>
		  <li><a href="<?php echo Flight::url("{$level}/{$year_for_url}{$course_obj->id}/{$course_obj->slug}"); ?>"><?php echo $course_obj->name ?> <?php echo $course_obj->award ?></a></li>
		  <?php endforeach; ?>
		</ul>
    </section>
</section>
<?php endif; ?>








