
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

			if(!empty($course->programme_leaflet)){
				foreach ($course->programme_leaflet as $leaflet){
					$ext = strtoupper(pathinfo($leaflet->tracking_code,PATHINFO_EXTENSION));
					echo '<li><a href="'.$leaflet->tracking_code.'">'.$leaflet->name.' ('. $ext .')</a></li>';
				}
			}
		?>


	</ul>
</nav>