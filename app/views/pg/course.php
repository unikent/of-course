<div class="content-body">

	<span class="spaced-links-item text-accent hidden-lg-up">
		<svg class="year-of-entry-slash" width="2rem" height="3rem" xmlns="http://www.w3.org/2000/svg">
			<path fill="none" stroke="#937227" d="M30, 0L0,100Z" stroke-width="1" opacity="1"></path>
		</svg>
		<span class="year-of-entry"><?php echo $course->year; ?></span>
		<?php
		if(sizeof($years->years) > 1):
			if(isset($course) && $course->current_year > $course->year):
				?>
				<span class="current">
					<a href='<?php echo $meta['active_instance']; ?>'>See <?php echo $course->current_year;?> entry</a>
				</span>
			<?php else: ?>
				<span class="current">
				 <?php
				 $y = array_diff($years->years, array($course->current_year));
				 $y = $y[0]?>
					<a href="<?php echo "/courses/$y/$course->level/$course->id"; ?>">See <?php echo $y; ?> entry</a>

				</span>
			<?php endif?>
		<?php endif ?>
		</span>
	</span>

	<div class="content-container">
		<div class="content-full">
			<div class="spaced-links-container">
				<div class="spaced-links-inner-container links">
					<span class="text-accent spaced-links-item"><i class="kf-pin"></i> <?php echo $course->locations_str_linked; ?></span>
					<a href="#contact-modal" class="spaced-links-item text-accent" id="contactButton" data-toggle="modal" data-target="#contact-modal"><i class="kf-info-circle"></i> Contact Us</a>
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
						<div class="entry-year"> <?php echo $course->year ?></div>
						<?php
						$other_year = array_diff($years->years, array($course->current_year));
                        $other_year = $other_year[0];
						if(sizeof($years->years) > 1):
							if(isset($course) && $course->current_year > $course->year):
								?>
								<div class="current">
									<a href='<?php echo $meta['active_instance']; ?>'> See <?php echo $course->current_year;?> entry</a>
								</div>
							<?php else: ?>
								<div class="current">
									<a href='<?php echo "/courses/$level/$other_year/$course->instance_id"; ?>'> See <?php echo $other_year?> entry</a>
								</div>
							<?php endif?>
						<?php endif ?>
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
