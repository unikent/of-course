<div class="content-body">


	<div class="content-container">
		<div class="content-full">
			<span class="current-year hidden-lg-up">
				<svg width="2rem" height="3rem" xmlns="http://www.w3.org/2000/svg">
					<path fill="none" stroke="#937227" d="M30, 0L0,100Z" stroke-width="1" opacity="1"></path>
				</svg>
				<span class="entry-year entry-year-single"><?php echo $course->year; ?></span>
			</span>
			<div class="spaced-links-container">
				<div class="spaced-links-inner-container links">
					<span class="text-accent spaced-links-item"><i class="kf-pin"></i> <?php echo $course->locations_str_linked; ?></span>
					<a href="#contact-modal" class="spaced-links-item text-accent" id="contactButton" data-toggle="modal" data-target="#contact-modal" onclick="window.KENT.kat.event('course-page', 'contact-pg-modal', '[<?php echo $course->instance_id ?>] <?php echo $course->programme_title; ?> (<?php echo $course->year ?>)');"><i class="kf-info-circle"></i> Contact Us</a>
					<a href="#prospectus-modal" class="spaced-links-item text-accent" id="prospectusButton" data-toggle="modal" data-target="#prospectus-modal" onclick="window.KENT.kat.event('course-page', 'prospectus-pg-modal', '[<?php echo $course->instance_id ?>] <?php echo $course->programme_title; ?> (<?php echo $course->year ?>)');"><i class="kf-user"></i> Prospectus</a>

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
								onclick="window.KENT.kat.event('course-page', 'apply-pg-modal', '[<?php echo $course->instance_id ?>] <?php echo $course->programme_title; ?> (<?php echo $course->year ?>)');"
						>Apply now</button>
					<?php endif; ?>
				</div>
			</div>

			<div class="lead split">
				<?php
				$syn = trim($course->programme_synopsis);
				if(empty($syn)):
					if (preg_match('%<p[^>]*>(.*?)</p>%i', $course->schoolsubject_overview, $regs)):?>
						<p>
							<?php echo$regs[1] ?>
						</p>
					<?php endif; ?>
				<?php else: ?>
					<?php echo $course->programme_synopsis  ?>
				<?php endif; ?>

				<div class="wrapper">
					<svg width="2rem" height="6rem" xmlns="http://www.w3.org/2000/svg">
						<path fill="none" stroke="#937227" d="M30, 0L0,100Z" stroke-width="2" opacity="1"></path>
					</svg>
					<div class="current-year">
						<span class="entry-year entry-year-single"><?php echo $course->year; ?></span>
					</div>
				</div>
			</div>
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

						if (!empty($course->careers_and_employability) || !empty($course->globals->careersemployability_text) || !empty($course->professional_recognition)) {
							Flight::render("partials/tab",
										   array(
											   "title" => "Careers",
											   "id" => "careers",
											   "selected" => false,
											   "content" => Flight::fetch("pg/tabs/careers")
										   ));
						}

						if (!empty($course->key_information_miscellaneous)) {
							Flight::render("partials/tab",
										   array(
											   "title" => "Study support",
											   "id" => "study-support",
											   "selected" => false,
											   "content" => Flight::fetch("pg/tabs/study-support")
										   ));
						}

						Flight::render("partials/tab", array("title"=>"Entry requirements", "id" => "entry-requirements",  "selected" => false, "content" => Flight::fetch("pg/tabs/entry-requirements")));

						if (!empty($course->research_groups)) {
							Flight::render("partials/tab",
										   array(
											   "title" => "Research areas",
											   "id" => "research-areas",
											   "selected" => false,
											   "content" => Flight::fetch("pg/tabs/research-areas")
										   ));
						}

						Flight::render("partials/tab", array("title"=>"Staff research", "id" => "staff-research",  "selected" => false, "content" => Flight::fetch("pg/tabs/staff-research")));

                        if (!(isset($course->no_fee_output) && $course->no_fee_output === 'true')) {
                            Flight::render("partials/tab",
                                array(
                                    "title" => "Fees and funding",
                                    "id" => "fees",
                                    "selected" => false,
                                    "content" => Flight::fetch("pg/tabs/fees")
                                ));
                        }
					?>
				</div>
		</div>
		<div class="content-aside">
			<?php Flight::render("pg/sidebar"); ?>
		</div>
	</div>
</div>
<?php Flight::render("partials/profile-feature"); ?>
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

<?php Flight::render("pg/contact-modal"); ?>
<?php Flight::render("pg/prospectus-modal"); ?>
<?php Flight::render("pg/apply-modal"); ?>
