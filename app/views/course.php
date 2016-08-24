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

			<?php if (isset($course->globals->disable_apply) && $course->globals->disable_apply=='true'): ?>
				<a href="<?php echo Flight::request()->base; ?>/<?php echo $level; ?>/<?php echo $course->instance_id ?>/"
					class="btn btn-primary pull-right"
					type="button"
					role="button"
					>View <?php echo $course->current_year ?> programme</a>
			<?php else:?>
				<a href="<?php echo Flight::request()->base; ?>/<?php echo $level; ?>/<?php echo $course->year != $course->current_year ? $course->year . '/' : '' ?>apply-online/<?php echo $course->instance_id ?>"
					class="btn btn-primary pull-right"
					type="button"
					role="button"
					aria-controls="apply"
					>Apply now</a>
			<?php endif; ?>

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


<?php if (!empty($course->related_courses)): ?>

	<div class="card-panel card-panel-primary-tint cards-backed m-t-0">
		<div class="card-panel-header">
			<h2 class="card-panel-title">Related to this course</h2>
		</div>
		<div class="card-panel-body">
			<?php foreach ($course->related_courses as $related_course): ?>

				<div class="card card-linked">
					<a href="<?php echo Flight::url("{$level}/{$related_course->id}/{$related_course->slug}"); ?>" class="card-title-link"><h3 class="card-title"><?php echo $related_course->name ?> <?php echo !empty($related_course->programmme_status_text) ? $related_course->programmme_status_text : ''; ?> <?php echo $related_course->award; ?></h3></a>
					<p class="card-meta"><?php echo $related_course->mode_of_study; ?></p>
					<p class="card-meta"><?php echo $related_course->campus; ?></p>
					<hr>
					<p class="card-text">Economics examines some of the profound issues in our life and times, including: economic...</p>
					<a href="<?php echo Flight::url("{$level}/{$related_course->id}/{$related_course->slug}"); ?>" class="faux-link-overlay" aria-hidden="true"><?php echo $related_course->name ?> <?php echo !empty($related_course->programmme_status_text) ? $related_course->programmme_status_text : ''; ?> <?php echo $related_course->award; ?></a>
				</div>
			<?php endforeach; ?>

		</div>
	</div>
<?php endif; ?>


<div class="container">
	<?php if (!empty($course->globals->general_disclaimer)): ?>
		<footer class="general_disclaimer" style='font-size:0.8em;'>
			<?php echo $course->globals->general_disclaimer; ?>
		</footer>
	<?php endif; ?>
</div>
