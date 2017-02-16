<?php
$evision_url = "evision";
if(strpos($_SERVER['SERVER_NAME'], 'www-dev')!==false){
	$evision_url = "evision-dev";
}
if(strpos($_SERVER['SERVER_NAME'], 'www-test')!==false){
	$evision_url = "evision-test";
}
$schoolName = $course->administrative_school[0]->name;
$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);
?>

	<h2>Apply</h2>

	<?php if(!empty($course->how_to_apply)): ?>
		<?php echo $course->how_to_apply; ?>

	<?php endif; ?>

<?php if(empty($course->subject_to_approval)): ?>
	<?php if ( !empty($course->deliveries) ): ?>

		<?php
		$sits_url = 'https://'.$evision_url.'.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?';

		$apply_link = array();
		$apply_event = array();
		$awards = array();
		$descriptions = array();

		foreach($course->deliveries as $delivery){

			$mode = $delivery->attendance_pattern;
			$award = $delivery->award_name;
			$mcr = $delivery->mcr;

			// skip if no mcr
			if($mcr == '') continue;

			// Generate unqiue grouping key from MCR code
			$key = substr($mcr,0,strpos($mcr,"-"));

			// create vars
			if(!isset($apply_link[$key])){
				$apply_link[$key] = array();
				$apply_event[$key] = array();
			}

			// Generate Links
			$apply_link[$key][$mode] = $sits_url . 'process=siw_ipp_app&code1=' . $mcr . '&code2=0001';

		 	$awards[$key] = $award;

		 	$description = str_replace($course->programme_title,'', $delivery->description);
			$description = substr($description ,0, strpos($description, '-'));
		 	$descriptions[$key] = $description;

		 	// Generate event trackers
		 	$tracking_name = "[{$course->instance_id} in {$course->year}] {$course->programme_title} - {$award} {$description} - {$mode} [{$mcr}] at {$schoolName}";
			$apply_event[$key][$mode] = 'onClick="window.KENT.kat.event(\'course-page\', \'apply-pg\', \''.$tracking_name .'\');"';
		}
		?>

		<div class='enquire-block'>

		<?php foreach($apply_link as $key => $details): ?>

			<h3><?php echo $awards[$key]. ' '.$descriptions[$key]; ?></h3>

			<ul>
			<?php if($has_fulltime && isset($apply_event[$key]['full-time'])): ?>
				<li>
				<strong>Full-time </strong> -
				<a title="Apply online - <?php echo $awards[$key]. ' '.$descriptions[$key];?> Full time" href='<?php echo $apply_link[$key]['full-time'];?>' <?php echo $apply_event[$key]['full-time'];?> >Apply online</a>

				</li>
			<?php endif; ?>

			<?php if($has_parttime && isset($apply_event[$key]['part-time'])): ?>
				<li>
				<strong>Part-time</strong> -
				<a title="Apply online - <?php echo $awards[$key]. ' '.$descriptions[$key];?> Part time" href='<?php echo $apply_link[$key]['part-time'];?>' <?php echo $apply_event[$key]['part-time'];?> >Apply online</a>
				</li>
			<?php endif; ?>
			</ul>

		<?php endforeach;?>
		</div>


	<?php endif; ?>
<?php endif; ?>
