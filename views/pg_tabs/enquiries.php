<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/'); ?>

<div class="panel admissions">

	<h2>I would like to...</h2>
	
	<form>
		<div class="form-row enquiry-option">
			<input type="radio" name="enquire" id="enquire" value="enquiry">
			<label for="enquire" id="enquire-lbl">Make an online enquiry</label>

			<input type="radio" name="enquire" id="prospectus" value="prospectus">
			<label for="prospectus" id="prospectus-lbl">Order a prospectus <span style="display: inline-block; font-size: 0.8em; font-family: arial;line-height: 0.5em; color:#333333">(<a href="#">Download PDF version - 2MB</a>)</span></label>
		</div>

		<div class="form-row">	
			<label for="enquire-study-type">Type of study</label>
			<select id="enquire-study-type">
				<option>Full time</option>
				<option>Part time</option>
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
		<br>
		
		<a href="#" class="apply-link"><span id="enquidry-link">Enquire about</span> <strong>Anthropology</strong> <span id="enquire-award-link">MA</span> - <span id="enquire-type-link">Full time</span></a>
		
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
	<?php if( ! empty($course->enquiries) ): ?>
	<section class="info-subsection">
		<h4>Enquiries</h4>
		<?php echo $course->enquiries ?>
	</section>
<?php endif; ?>
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

	<?php if ( ! empty($course->student_profile) || ! empty($course->student_profile_2) ): ?>
	<section class="info-subsection">
		<h4>Read our student profiles</h4>
		<ul>
			<li><a href="<?php echo $course->student_profile ?>"><?php echo $course->student_profile ?></a></li>
			<?php if(!empty($course->student_profile_2)): ?>
			<li><a href="<?php echo $course->student_profile_2 ?>"><?php echo $course->student_profile_2 ?></a></li>
			<?php endif; ?>
		</ul>
	</section>
	<?php endif; ?>

	<?php if(!empty($course->globals->open_days)): ?>
	<section class="info-subsection">
	    <h4>Open days</h4>
	    <?php echo $course->globals->open_days ?>
	</section>
	<?php endif; ?>
	
</section>

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
