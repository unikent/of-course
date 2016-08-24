
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

		<?php if (isset($course->staff_profile) && !empty(trim($course->staff_profile)) ){ ?>
			<li><a href="<?php echo $course->staff_profile; ?>">Staff profiles</a></li>
		<?php } ?>

	</ul>
</nav>


<?php /*
<div class="side-panel">


<div class="admission-links">
	<?php if(defined('CLEARING') && CLEARING){
		?>
		<div class="clearing-panel">
			<h2>Clearing <?php echo ($course->current_year - 1); ?> - Full-time applicants</h2>
			<a href="https://www.kent.ac.uk/clearing/" class="btn btn-large apply-adm-link"
			   type="button"
			   role="button"
			   aria-controls="apply">Check clearing vacancies</a>
		</div>
		<?php
		$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
		if($has_parttime){
		?>
		<a href="<?php echo Flight::request()->base; ?>/undergraduate/<?php echo $course->year != $course->current_year ? $course->year . '/' : '' ?>apply-online/<?php echo $course->instance_id ?>?part_time=1"
		   class=""
		   onclick="_pat.event('course-page', 'apply-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $course->programme_title ?> at <?php echo $schoolName ?>');">Part-time applicants</a>
		<br><br>
		<?php } ?>
		<a href="#!enquiries"
		   class="enquire-adm-link"
		   role="tab"
		   aria-controls="enquiries">Contact us</a>
		or <a href="#!enquiries" class="pros-adm-link" role="tab" aria-controls="enquiries">order a prospectus
		</a>
		<?php
	}else{?>
	<?php if (isset($course->globals->disable_apply) && $course->globals->disable_apply=='true'): ?>
		<a href="<?php echo Flight::request()->base; ?>/undergraduate/<?php echo $course->instance_id ?>/"
			class="btn btn-large apply-adm-link"
			type="button"
			role="button"
			>View <?php echo $course->current_year ?> programme</a>
	<?php else:?>
		<a href="<?php echo Flight::request()->base; ?>/undergraduate/<?php echo $course->year != $course->current_year ? $course->year . '/' : '' ?>apply-online/<?php echo $course->instance_id ?>"
			class="btn btn-large apply-adm-link"
			type="button"
			role="button"
			aria-controls="apply"
			onclick="_pat.event('course-page', 'apply-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $course->programme_title ?> at <?php echo $schoolName ?>');">Apply</a>
	<?php endif; ?>
	<a href="#!enquiries"
		class="enquire-adm-link"
		role="tab"
		aria-controls="enquiries">Contact us</a>
		or <a href="#!enquiries" class="pros-adm-link" role="tab" aria-controls="enquiries">order a prospectus
	</a>
	<?php } ?>
</div><!-- /.admission-links -->



*/ ?>
				