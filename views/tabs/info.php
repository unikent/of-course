<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/'); ?>

<h2>Further information</h2>

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

<div class="row-fluid">
	<div class="span7">
		<div class="well">
			<h3>UNISTATS / KIS</h3>
			<h4>Key Information Sets</h4>
			<?php echo $course->kis_explanatory_textarea ?>
		</div>
	</div>
	<div class="span5">
		<iframe id="unistats-widget-frame" title="Unistats KIS Widget" src="http://widget.unistats.ac.uk/Widget/<?php echo $course->globals->ukprn ?>/<?php echo str_replace(array('/', '|', ':', '&', '.', '>', '+', '#', ';', '?', '@', '='), '_', $course->kiscourseid); ?>/vertical/small/en-GB" style="overflow: hidden; border: 0px none transparent; width: 190px; height: 500px;"> </iframe>
	</div>
</div>