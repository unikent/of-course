<?php 
use \unikent\kent_theme\kentThemeHelper; 
?>

<div class="card card-overlay header-card-overlay">
	<div class="card-body">
		<div class="card-media-wrap">
			<?php if(isset($course->banner_image) && !empty($course->banner_image)){
				$banner_image = $course->banner_image->sizes->full->url;
				$banner_image_alt = $course->banner_image->alt_text;
			}else{
				$banner_image = Flight::asset('images/default-profile-feature.jpg');
				$banner_image_alt = 'Students preparing for their graduation ceremony at Canterbury Cathedral';
			}?>
			<img class="card-img<?php echo (isset($course->banner_image) && !empty($course->banner_image) && in_array($course->banner_image->focus, array('top','bottom')))? '-' . $course->banner_image->focus : ''; ?>" src="<?php echo $banner_image; ?>" alt="<?php echo $banner_image_alt; ?>">
		</div>
		<div class="card-title-overlap overlap-content-container">
			<?php
			KentThemeHelper::breadcrumb(array(
				'Courses'=>'/courses',
				ucfirst($level).' '. $course->year =>'/courses/'.$level,
				$course->programme_title =>''
			));
			?>
			<h1>
				<?php echo $course->programme_title; ?> - <?php echo $course->award_list; ?>
				<?php echo $course->programmme_status_text; ?>
			</h1>
			<?php if($course->programme_level == 'ug'): ?>
				<p class="card-subtitle">UCAS code <?php echo $course->ucas_code?></p>
			<?php endif; ?>
		</div>
        <div class="card-img-overlay-bottom card-img-overlay-link card-overlay-inline-sm card-overlay-inline-nopad header-card-overlap-search">
            <form class="quickspot-container" action="/search">
                <div class="form-group">
                    <label for="course-search" class="sr-only">Search courses</label>
                    <div class="input-group input-group-lg">
                        <input type="search" name="q" class="form-control" id="course-search" placeholder="Search courses..." autocomplete="off" data-quickspot-config="<?php if($level == 'postgraduate'){echo 'pg';}else{echo'ug';} ?>_courses" data-quickspot-target="quickspot-results-container">
                        <span class="input-group-btn">
							<button type="submit" class="btn btn-accent btn-icon">
								<span class="sr-only">Search courses</span>
								<span class="kf-fw kf-search"></span>
							</button>
						</span>
                    </div>
                    <div id="quickspot-results-container" tabindex="100" class="quickspot-results-container" style="display: none;">
						<div class="quickspot-results"></div>
						<div>
							<div class="course-links">
								<a class="chevron-link" href="/courses/undergraduate/search">All undergraduate</a>
								<a class="chevron-link" href="/courses/postgraduate/search">All postgraduate </a>
								<a class="chevron-link" href="/courses/part-time/index.html">Short courses</a>
							</div>
						</div>
					</div>
				</div>
            </form>
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
	<div class="card-panel card-panel-primary-tint cards-backed mt-0">
		<div class="card-panel-header">
			<h2 class="card-panel-title">Related to this course</h2>
		</div>
		<div class="card-panel-body kent-slider" data-slider-config="card_panel">
			<?php foreach ($course->related_courses as $related_course): ?>

				<div class="card card-linked kent-slide ">
					<a href="<?php echo Flight::url("{$level}/{$related_course->id}/{$related_course->slug}"); ?>" class="card-title-link"><h3 class="card-title"><?php echo $related_course->name ?> <?php echo !empty($related_course->programmme_status_text) ? $related_course->programmme_status_text : ''; ?> <?php echo $related_course->award; ?></h3></a>
					<a href="<?php echo Flight::url("{$level}/{$related_course->id}/{$related_course->slug}"); ?>" class="faux-link-overlay" aria-hidden="true"><?php echo $related_course->name ?> <?php echo !empty($related_course->programmme_status_text) ? $related_course->programmme_status_text : ''; ?> <?php echo $related_course->award; ?></a>
					<p class="card-meta text-accent"><i class="kf-clock kf-fw"></i> <?php echo $related_course->mode_of_study; ?></p>
					<p class="card-meta text-accent"><i class="kf-pin kf-fw"></i> <?php echo $related_course->campus; ?></p>
				</div>
			<?php endforeach; ?>

		</div>
	</div>
<?php endif; ?>



<?php if (!empty($course->globals->general_disclaimer)): ?>
<footer class="content-container mt-1">
	<div class="content-full">
		<div class="small">
			<?php echo $course->globals->general_disclaimer; ?>
		</div>
	</div>
</footer>
<?php endif; ?>

