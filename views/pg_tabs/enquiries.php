<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/'); ?>

<div class="panel admissions">

	<h2>I would like to...</h2>
	
	<form>
		<div class="form-row enquiry-option">
			<input type="radio" name="enquire" id="enquire" value="enquiry" checked="checked">
			<label for="enquire" id="enquire-lbl">Make an online enquiry</label>

			<input type="radio" name="enquire" id="prospectus" value="prospectus">
			<label for="prospectus" id="prospectus-lbl">Order a prospectus <span style="display: inline-block; font-size: 0.8em; font-family: arial;line-height: 0.5em; color:#333333">(<a href="#">Download PDF version - 2MB</a>)</span></label>
		</div>

		<div class="form-row<?php echo trim($course->mode_of_study) == 'Full-time or part-time' ? '' : ' hide'; ?>">	
			<label for="enquire-study-type">Type of study</label>
			<select id="enquire-study-type">
				<option value="ft">Full-time</option>
				<option value="pt">Part-time</option>
			</select>
	    </div>
			
		<div class="form-row">
			<label for="enquire-study-award">Award</label>
			<select id="enquire-study-award">
				<option>MA</option>
				<option>MSc</option>
		        <option>PhD</option>
			</select>
		</div>
		



		<?php $sits_url = 'https://esd.kent.ac.uk/aspx_shared/newuser.aspx?'; ?>
		<?php if ( trim($course->mode_of_study) == 'Part-time only' || trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			<?php $text = 'Part time'; ?>
			<?php if ( trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			<div class="courses-sits-ug-enquire-parttime hide">
			<?php else: ?>
			<div class="courses-sits-ug-enquire-parttime">
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( trim($course->mode_of_study) == 'Full-time only' || trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			<?php $text = 'Full time'; ?>
			<div class="courses-sits-ug-enquire-fulltime">
		<?php endif; ?>

			<?php foreach ($course->deliveries as $delivery): ?>
				<?php
				$enquire = $sits_url . 'CCTC=KENT&UTYP=APP';
				$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CCTC=KENT';
				if ($delivery->mcr != '') {
					$enquire = $sits_url . 'CourseCode=' . $delivery->mcr . '&CCTC=KENT&UTYP=APP&EnquiryCategoryCode=10';
					$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CourseCode=' . $delivery->mcr . '&CCTC=KENT';
				}
				?>
				<a href="<?php echo $enquire ?>" class="apply-link enquire-link award-link-<?php echo $delivery->award_name ?>">Enquire about <strong><?php echo $course->programme_title; ?> <?php echo $delivery->award_name; ?></strong> - <span class="apply-type-link"><?php echo $text ?></span></a>

				<a href="<?php echo $prospectus ?>" class="apply-link prospectus-link award-link-<?php echo $delivery->award_name ?>" style="display:none;">Order a prospectus for <strong><?php echo $course->programme_title; ?> <?php echo $delivery->award_name; ?></strong> - <span class="apply-type-link"><?php echo $text ?></span></a>
			<?php endforeach; ?>
			</div>

	</form>
	
</div><!-- /panel admissions -->


<section class="info-section">
	<h3>Contacts</h3>

	<?php if(!empty($course->globals->enquiries)): ?>
		<h4>Admissions enquiries</h4>
		<?php echo $course->globals->enquiries ?>
	<?php endif; ?>

	<?php if( ! empty($course->enquiries) ): ?>
		<h4>Subject enquiries</h4>
		<?php echo $course->enquiries ?>
	<?php endif; ?>
</section>

<section class="info-section">
	<h3>Resources</h3>

	<section class="info-subsection">
		<h4>Related schools</h4>
		<ul>
			<li><a href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a></li>
			<?php if(!empty($course->additional_school[0])): ?>
			<li><a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a></li>
			<?php endif; ?>
		</ul>
		<h4>Graduate school</h4>
		<ul>
			<li><a href="<?php echo trim(strip_tags($course->globals->graduate_school)) ?>"><?php echo trim(strip_tags($course->globals->graduate_school)) ?></a></li>
		</ul>
	</section>

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








