<h2>Further information</h2>

<div class="info-section">
	<h3>Contacts</h3>
	<div class="info-subsection">
		<h4>Related schools</h4>
		<ul>
			<li><a href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a></li>
			<?php if(!empty($course->additional_school[0])): ?>
			<li><a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a></li>
			<?php endif; ?>
		</ul>
	</div>
	<div class="info-subsection">
		<h4>Enquiries</h4>
		<?php echo $course->enquiries ?>
	</div>
</div>

<div class="info-section">
	<h3>Resources</h3>
	<div class="info-subsection">
		<h4>Download a subject leaflet (pdf)</h4>
		<p>Our subject leaflets provide more detail about individual subjects areas. See:</p>
		<ul>
		<li><a href="<?php echo $course->subject_leaflet[0]->tracking_code ?>"><?php echo $course->subject_leaflet[0]->name ?></a></li>
		<?php if(!empty($course->subject_leaflet_2[0])): ?>
		<li><a href="<?php echo $course->subject_leaflet_2[0]->tracking_code ?>"><?php echo $course->subject_leaflet_2[0]->name ?></a></li>
		<?php endif; ?>
		</ul>
	</div>
	<?php if (! empty($course->student_profile) || ! empty($course->student_profile_2) ): ?>
	<div class="info-subsection">
		<h4>Read our student profiles</h4>
		<ul>
		<li><a href="<?php echo $course->student_profile ?>"><?php echo $course->student_profile_1_link_text ?></a></li>
		<?php if(!empty($course->student_profile_2)): ?>
		<li><a href="<?php echo $course->student_profile_2 ?>"><?php echo $course->student_profile_2_link_text ?></a></li>
		<?php endif; ?>
		</ul>
	</div>
	<?php endif; ?>
	<?php if(!empty($course->globals->open_days)): ?>
	<div class="info-subsection">
	    <h4>Open days</h4>
	    <?php echo $course->globals->open_days ?>
	</div>
	<?php endif; ?>
</div>

<?php if (!empty($course->related_courses)): ?>
<div class="info-section">
	<h3>Related courses</h3>
    <div class="info-subsection">
		<ul>
		  <?php foreach ($course->related_courses as $course_obj): ?>
		  <li><a href="<?php echo Flight::url("{$type}/{$year}/{$course_obj->id}/{$course_obj->slug}"); ?>"><?php echo $course_obj->name ?></a></li>
		  <?php endforeach; ?>
		</ul>
    </div>
</div>
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
<iframe id="unistats-widget-frame" title="Unistats KIS Widget"
src="http://widget.unistats.ac.uk/Widget/<?php echo $course->globals->ukprn ?>/<?php echo str_replace(array('/', '|', ':', '&', '.', '>', '+', '#', ';', '?', '@', '='), '_', $course->kiscourseid); ?>/vertical/small/en-GB" scrolling="no" style="overflow: hidden; border: 0px none transparent; width: 190px; height: 500px;"> </iframe>
</div>
</div>