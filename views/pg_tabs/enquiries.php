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

	<?php if(!empty($course->globals->enquiries)): ?>
		<h4>Admissions enquiries</h4>
		<?php echo $course->globals->enquiries ?>
	<?php endif; ?>

	<?php if( ! empty($course->enquiries) ): ?>
		<h4>Subject enquiries</h4>
		<?php echo $course->enquiries ?>
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








