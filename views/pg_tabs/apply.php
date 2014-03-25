<?php
$evision_url = "evision";
if(strpos($_SERVER['SERVER_NAME'], 'www-dev')!==false){
	$evision_url = "evision-dev";
}
if(strpos($_SERVER['SERVER_NAME'], 'www-test')!==false){
	$evision_url = "evision-test";
}
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
			// pos is used to group pt/ft deliveries together for each award
			$pos = $delivery->pos_code;
			$mcr = $delivery->mcr;

			// skip if no mcr
			if($mcr == '') continue;

			// create vars
			if(!isset($apply_link[$pos])){
				$apply_link[$pos] = array();
				$apply_event[$pos] = array();
			}

			// Generate Links
			$apply_link[$pos][$mode] = $sits_url . 'process=siw_ipp_app&code1=' . $mcr . '&code2=0001';

			// Generate event trackers	
			$apply_event[$pos][$mode]  = "onClick=\"_gaq.push(['t0._trackEvent', 'course-apply-pg', 'click', '" . $course->programme_title . "-" . $award . "-{$mode}-" . $mcr . "']);\"";

		 	$awards[$pos] = $award;

		 	$description = str_replace($course->programme_title,'', $delivery->description);
			$description = substr($description ,0, strpos($description, '-')); 
		 	$descriptions[$pos] = $description;
		}
		?>

		<div class='enquire-block'>

		<?php foreach($apply_link as $pos => $details): ?>

			<h3><?php echo $awards[$pos]. ' '.$descriptions[$pos]; ?></h3>

			<ul>
			<?php if($has_fulltime && isset($apply_event[$pos]['full-time'])): ?>
				<li>
				<strong>Full time</strong> -
				<a title="Apply online - <?php echo $awards[$pos]. ' '.$descriptions[$pos];?> Full time" href='<?php echo $apply_link[$pos]['full-time'];?>' <?php echo $apply_event[$pos]['full-time'];?> >Apply online</a>
				
				</li>
			<?php endif; ?>

			<?php if($has_parttime && isset($apply_event[$pos]['part-time'])): ?>
				<li>
				<strong>Part time</strong> -
				<a title="Apply online - <?php echo $awards[$pos]. ' '.$descriptions[$pos];?> Part time" href='<?php echo $apply_link[$pos]['part-time'];?>' <?php echo $apply_event[$pos]['part-time'];?> >Apply online</a>
				</li>
			<?php endif; ?>
			</ul>

		<?php endforeach;?>
		</div>


	<?php endif; ?>
<?php endif; ?>	
