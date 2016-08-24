<?php 
use \unikent\kent_theme\kentThemeHelper; 
?>
<div class="card card-overlay header-card-overlay">
	<div class="card-body">
		<div class="card-media-wrap">
			<img class="card-img" src="<?php echo Flight::url("/images/banner.jpg");?>">
			<div class="card-img-overlay-bottom card-img-overlay-link">
				<div class="attribution">
					<i class="kf-camera"></i>
					<span>Political Studies Association: Picture by <a href="#">Someone</a>. <a href="#">Attribution License</a></span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="content-page">
	<div class="content-body">
		<div class="content-header">
			<?php

			KentThemeHelper::breadcrumb(array(
					'Courses'=>'/',
					ucfirst($level).' '. $year =>'/',
					$course->programme_title =>''
				));
			?>	
			<header>
				<h1>
					<?php echo $course->programme_title; ?> - <?php echo $course->award_list_linked; ?>
					<?php echo $course->programmme_status_text; ?>
				</h1>
				<p class='location-header' ><?php echo $course->locations_str; ?></p>
			</header>
		</div>
	</div>
</div>

<?php if ($course->programme_suspended == 'true' || $course->programme_withdrawn == 'true' || $course->holding_message != ''){
		//suppress content if holding message text filled in
		echo $course->holding_message;
} else{
	Flight::render($layout . "/course");

}
?>

<div class="container">
	<?php if (!empty($course->globals->general_disclaimer)): ?>
		<footer class="general_disclaimer" style='font-size:0.8em;'>
			<?php echo $course->globals->general_disclaimer; ?>
		</footer>
	<?php endif; ?>
</div>
