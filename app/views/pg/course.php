<div class="content-body">
	<div class="content-container">
		<div class="content-full">
			<div class="spaced-links-container">
				<div class="spaced-links-inner-container links">
					<a href="https://www.kent.ac.uk/locations/<?php echo $course->location_str ?>" class="text-accent spaced-links-item"><i class="kf-pin"></i> <?php echo $course->locations_str; ?></a>
					<a href="#contact-modal" class="spaced-links-item text-accent" id="prospectusButton" data-toggle="modal" data-target="#contact-modal"><i class="kf-info-circle"></i> Contact Us</a>
					<a href="#prospectus-modal" class="spaced-links-item text-accent" id="prospectusButton" data-toggle="modal" data-target="#prospectus-modal"><i class="kf-user"></i> Prospectus</a>
				</div>
				<div class="spaced-links-inner-container buttons">
					<a href="<?php echo $course->globals->open_days_button_link; ?>" class="btn btn-tertiary spaced-links-item-btn"><?php echo $course->globals->open_days_button_text; ?></a>
					<?php if (isset($course->globals->disable_apply) && $course->globals->disable_apply=='true'): ?>
						<a href="<?php echo Flight::request()->base; ?>/<?php echo $level; ?>/<?php echo $course->instance_id ?>/"
						   class="btn btn-primary pull-right spaced-links-item-btn"
						   type="button"
						   role="button"
						>View <?php echo $course->current_year ?> programme</a>
					<?php else:?>
						<button class="btn btn-primary spaced-links-item-btn"
								type="button"
								role="button"
								aria-controls="apply"
								id="applyButton"
								data-toggle="modal"
								data-target="#apply-modal"
						>Apply now</button>
					<?php endif; ?>
				</div>
			</div>

			<p class="lead">
				<?php
				// @todo - This is a new field that will be added to the PP in the near future. To demo the behavior
				// I'm currently just hacking in a "correct-ish" looking value by grabbing the first p of the overview if i can
				if (preg_match('%<p[^>]*>(.*?)</p>%i', $course->schoolsubject_overview, $regs)) {
					echo $regs[1];
				} ?>
			</p>

			<?php Flight::render("partials/notices"); ?>
		</div>
	</div>

	<div class="content-container relative">
		<div class="content-aside top-sidebar">
			<?php Flight::render("pg/top-sidebar"); ?>
		</div>
		<div class="content-main">
				<div class="tab-content vertical-nav">
					<?php
						Flight::render("partials/tab", array("title"=>"Overview", "id" => "overview", "selected" => true, "content" => Flight::fetch("pg/tabs/overview")));

						 if (strpos($course->programme_type, 'research') !== false){
							if(!empty($course->programme_overview)){
								Flight::render("partials/tab", array("title"=>"Course structure", "id" => "structure", "selected" => false, "content" => Flight::fetch("pg/tabs/structure_research")));
							}
						}else{
							Flight::render("partials/tab", array("title"=>"Course structure", "id" => "structure", "selected" => false, "content" => Flight::fetch("pg/tabs/structure")));
						}

						Flight::render("partials/tab", array("title"=>"Careers", "id" => "careers",  "selected" => false, "content" => Flight::fetch("pg/tabs/careers")));
						Flight::render("partials/tab", array("title"=>"Study support", "id" => "study-support", "selected" => false, "content" => Flight::fetch("pg/tabs/study-support")));
						Flight::render("partials/tab", array("title"=>"Entry requirements", "id" => "entry-requirements",  "selected" => false, "content" => Flight::fetch("pg/tabs/entry-requirements")));

						Flight::render("partials/tab", array("title"=>"Research areas", "id" => "research-areas",  "selected" => false, "content" => Flight::fetch("pg/tabs/research-areas")));

						Flight::render("partials/tab", array("title"=>"Staff research", "id" => "staff-research",  "selected" => false, "content" => Flight::fetch("pg/tabs/staff-research")));


						Flight::render("partials/tab", array("title"=>"Enquiries", "id" => "enquiries", "selected" => false, "content" => Flight::fetch("pg/tabs/enquiries")));
					?>
				</div>
		</div>
		<div class="content-aside">
			<?php Flight::render("pg/sidebar"); ?>
		</div>
	</div>
</div>

<div class="card card-overlay"">
	<div class="card-body">
		<div class="card-title-wrap card-title-wrap-link">
			<a href="https://www.kent.ac.uk/research/" class="card-title-link"><h2 class="card-title">Student Profile</h2></a>
			<h2 class="card-title" style="color:#fff">Helen Shrew</h2>
			<p class="card-text">Some text here about the student profile etc..</p>
		</div>
		<div class="card-media-wrap">
			<img src="/media/images/undergrad-discussion-library-16x9.jpg" class="card-img" alt="Students chatting in the library">
		</div>
	<div class="card-img-overlay-bottom text-xs-right">
		<h3 class="card-subtitle"><?php echo $course->programme_title; ?> - <?php echo $course->award_list; ?></h3>
	</div>

	</div>
</div>

<?php
$schoolName = $course->administrative_school[0]->name;
$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);
$full_type = 'ucas';
if (empty($course->deliveries)) {
	$has_fulltime = $has_parttime = FALSE;
} else {
	foreach ($course->deliveries as $delivery) {
		if ($delivery->attendance_pattern == 'part-time') {
			$has_parttime = $has_parttime && true;
		} else {
			$has_fulltime = $has_fulltime && true;
			$full_type = (substr($delivery->mcr, -2) == 'FD') ? 'direct' : 'ucas';
		}
	}
}
?>

<?php Flight::render("partials/modals/contact"); ?>
<?php Flight::render("partials/modals/prospectus"); ?>
<?php Flight::render("pg/apply-modal"); ?>
