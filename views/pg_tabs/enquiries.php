<?php
	$year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/');
	$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
	$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);

	// Tracking name
	$course_name_fortracking = "[{$course->instance_id} in {$course->year}] {$course->programme_title} ";
	$sits_url = 'https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?';

	$enquire_link = array();
	$prospectus_link = array();
	$enquire_event = array();
	$prospectus_event = array();
	$awards = array();
	$descriptions = array();

	foreach($course->deliveries as $delivery){

		$mode = $delivery->attendance_pattern;
		$award = $delivery->award_name;
		// pos is used to group pt/ft deliveries together for each award

		$pos = $delivery->pos_code;
		$mcr = trim($delivery->mcr) != '' ? $delivery->mcr : 'AAGEN102';

		//work out the key from the first part of the MCR code
		$mcr_split = split('-', $delivery->mcr);
		$key = $mcr_split[0];

		// create vars
		if (!isset($enquire_link[$key])) {
			$enquire_link[$key] = array();
			$prospectus_link[$key] = array();
			$enquire_event[$key] = array();
			$prospectus_event[$key] = array();
		}

		if (isset($delivery->ari_code)) {
			$ari_code = $delivery->ari_code;
			$show[$key] = true;
		} else {
			$ari_code = (string)null;
			$show[$key] = false;
		}

	 	$description = str_replace($course->programme_title, '', $delivery->description);
		$description = substr($description, 0, strpos($description, '-'));

	 	$descriptions[$key] = $description;
	 	$awards[$key] = $award;

	 	// Generate links
		$link = $sits_url . 'process=siw_ipp_enq&code1=%s&code2=&code4=ipr_ipp5=%s';
		$enquire_link[$key][$mode] = sprintf($link, $ari_code, '10');
		$prospectus_link[$key][$mode] = sprintf($link, $ari_code, 'PRO');

		// Generate event trackers
		$eventjs = "onClick=\"_pat.event('course-page', '%s', '%s');\"";
		$event = "$course_name_fortracking - $award" . "$description - $mode [$mcr]";
		$enquire_event[$key][$mode] = sprintf($eventjs, 'enquire-pg', $event);
		$prospectus_event[$key][$mode] = sprintf($eventjs, 'order-prospectus-pg', $event);
	}
?>

	<h2>Enquire or order a prospectus</h2>

	<p>
		<a
			href="/courses/postgraduate/pdf/prospectus.pdf"
			<?php echo sprintf($eventjs, 'download-prospectus-pg', $course_name_fortracking); ?>
		>
			Download a prospectus (PDF - 2MB)
		</a>

		<?php if (in_array(true, $show)): // if any of the prospectus order links at all are visible below… ?>
			or order one below.
		<?php endif; ?>
	</p>

	<?php if (in_array(true, $show)): ?>

	<div class='enquire-block'>

		<?php foreach($enquire_link as $key => $details):
			if ($show[$key]): ?>

			<h3><?php echo $awards[$key]. ' '.$descriptions[$key]; ?></h3>

			<ul>
			<?php if($has_fulltime): ?>
				<li>
					<strong>Full-time</strong> -
					<a
						title="Enquire online - <?php echo $awards[$key]. ' '.$descriptions[$key];?> Full time"
						href='<?php echo $enquire_link[$key]['full-time'];?>'
						<?php echo $enquire_event[$key]['full-time'];?>
					>
						Enquire online
					</a> |
					<a
						title="Order prospectus for <?php echo $awards[$key]. ' '.$descriptions[$key];?> Full time"
						href='<?php echo $prospectus_link[$key]['full-time'];?>'
						<?php echo $prospectus_event[$key]['full-time'];?>
					>
						Order a prospectus
					</a>
				</li>
			<?php endif; ?>

			<?php if($has_parttime): ?>
				<li>
					<strong>Part-time</strong> -
					<a
						title="Enquire online - <?php echo $awards[$key]. ' '.$descriptions[$key];?> Part time"
						href='<?php echo $enquire_link[$key]['part-time'];?>'
						<?php echo $enquire_event[$key]['part-time'];?>
					>
						Enquire online
					</a> |
					<a
						title="Order prospectus for <?php echo $awards[$key]. ' '.$descriptions[$key];?> Part time"
						href='<?php echo $prospectus_link[$key]['part-time'];?>'
						<?php echo $prospectus_event[$key]['part-time'];?>
					>
						Order a prospectus
					</a>
				</li>
			<?php endif; ?>
			</ul>
		<?php endif;
			endforeach;
		?>
	</div>
	<?php endif; ?>



<section class="info-section">
	<h3>Contacts</h3>

	<?php if(!empty($course->admissions_enquiries)): ?>
		<div class="contacts-enquiries">
		<h4>Admissions enquiries</h4>
		<?php echo $course->admissions_enquiries ?>
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








