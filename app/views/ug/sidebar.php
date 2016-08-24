
<nav class="nav-list">
	<h3>Get in touch </h3>
	<ul>
		<li><a href="#">Visit us</a></li>
		<li><a href="#!enquiries" role="tab" aria-controls="enquiries">Contact us</a></li>
		<li>Call: 000 0000000</li>
	</ul>
</nav>

<a href="#" class="btn btn-primary">Live chat</a>

<hr> 

<nav class="nav-list">
	<h3>Resources </h3>
	<ul>
		<li><a href="#!enquiries" role="tab" aria-controls="enquiries">Order a prospectus</a></li>

		<?php 
		if(!empty($course->subject_leaflet[0])){
			$ext = strtoupper(pathinfo($course->subject_leaflet[0]->tracking_code,PATHINFO_EXTENSION));
			echo '<li><a href="'.$course->subject_leaflet[0]->tracking_code.'">'.$course->subject_leaflet[0]->name.' ('. $ext .')</a></li>';
		}
		if(!empty($course->subject_leaflet_2[0])){
			$ext = strtoupper(pathinfo($course->subject_leaflet_2[0]->tracking_code,PATHINFO_EXTENSION));
			echo '<li><a href="'.$course->subject_leaflet_2[0]->tracking_code.'">'.$course->subject_leaflet_2[0]->name.' ('. $ext .')</a></li>';
		}
		?>

		<?php if (isset($course->staff_profile) && !empty($course->staff_profile) ){ ?>
			<li><a href="<?php echo $course->staff_profile; ?>">Staff profiles</a></li>
		<?php } ?>

	</ul>
</nav>


				