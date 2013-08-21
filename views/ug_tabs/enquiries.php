<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/'); ?>

<h2>Enquiries</h2>

<div class="panel admissions">
	
	<form id="ug_enquiries_form">
		<div class="form-row<?php echo trim($course->mode_of_study) != 'Full-time or part-time' ? ' form-row-study-type' : ''; ?>">
			<label for="enquire-study-type">Type of study</label>
			<select id="enquire-study-type">
				<option value="ft">Full-time</option>
				<option value="pt">Part-time</option>
			</select>
	    </div>
		
		<?php $sits_url = 'https://esd.kent.ac.uk/aspx_shared/newuser.aspx?'; ?>
		<?php if ( trim($course->mode_of_study) == 'Part-time only' || trim($course->mode_of_study) == 'Full-time or part-time'): ?>
			<?php
			$text = 'Part time';
			$enquire = $sits_url . 'CCTC=KENT&UTYP=APP';
			$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CCTC=KENT';
			if ($course->parttime_mcr_code != '') {
				$enquire = $sits_url . 'CourseCode=' . $course->parttime_mcr_code . '&CCTC=KENT&UTYP=APP&EnquiryCategoryCode=10';
				$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CourseCode=' . $course->parttime_mcr_code . '&CCTC=KENT';
			}
			?>
			<?php if ( trim($course->mode_of_study) == 'Full-time or part-time' ): ?>
			<div class="courses-sits-enquire-parttime">
			<?php else: ?>
			<div class="courses-sits-enquire-parttime-only">
			<?php endif; ?>
				<a href="<?php echo $enquire ?>" class="apply-link">Enquire about <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link"><?php echo $text ?></span></a>

				<a href="<?php echo $prospectus ?>" class="apply-link">Order a prospectus for <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link"><?php echo $text ?></span></a>
			</div>
		<?php endif; ?>

		<?php if ( trim($course->mode_of_study) == 'Full-time only' || trim($course->mode_of_study) == 'Full-time or part-time' ): ?>
			<?php
				$text = 'Full time';
				$enquire = $sits_url . 'CCTC=KENT&UTYP=APP';
				$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CCTC=KENT';
				if ($course->fulltime_mcr_code != '') {
					$enquire = $sits_url . 'CourseCode=' . $course->fulltime_mcr_code . '&CCTC=KENT&UTYP=APP&EnquiryCategoryCode=10';
					$prospectus = $sits_url . 'EnquiryCategoryCode=PRO&CourseCode=' . $course->fulltime_mcr_code . '&CCTC=KENT';
				}
			?>
			<div class="courses-sits-enquire-fulltime">
				<a href="<?php echo $enquire ?>" class="apply-link">Enquire about <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link"><?php echo $text ?></span></a>

				<a href="<?php echo $prospectus ?>" class="apply-link">Order a prospectus for <strong><?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?></strong> - <span class="apply-type-link"><?php echo $text ?></span></a>
			</div>
		<?php endif; ?>


		

	</form>
	
</div><!-- /panel admissions -->

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
		<iframe class="pull-right" id="unistats-widget-frame" title="Unistats KIS Widget" src="http://stg.unistats.eduserv.org.uk/Widget/<?php echo $ukprn ?>/<?php echo str_replace(array('/', '|', ':', '&', '.', '>', '+', '#', ';', '?', '@', '='), '_', $course->kiscourseid); ?>/vertical/small/en-GB" scrolling="no" style="overflow: hidden; border: 0px none transparent; width: 190px; height: 500px;"> </iframe>
	</div>
</div>