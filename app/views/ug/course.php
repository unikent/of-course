<?php
$has_foundation = (strpos(strtolower($course->programme_type), 'foundation year') !== false);

// Make pos available
$course->pos_code = isset($course->deliveries[0]) ? $course->deliveries[0]->pos_code : '';
?>
		<div class="content-body">
			<div class="content-container">
				<div class="content-full">

					<?php Flight::render("partials/notices"); ?>

					<span class="current-year hidden-lg-up">
						<svg width="2em" height="3em" xmlns="http://www.w3.org/2000/svg">
							<path fill="none" stroke="#937227" d="M30, 0L0,100Z" stroke-width="1" opacity="1"></path>
						</svg>
							<?php

							if(!defined("SHOW_UG_PREVIOUS_YEAR_BANNER") || SHOW_UG_PREVIOUS_YEAR_BANNER == false ): ?>
								<span class="entry-year entry-year-single"><?php echo $course->year; ?></span>
							<?php else: ?>
								<div class="entry-year"> <?php echo $course->year ?></div>
							<?php endif;

							//If it's the current year
							if($course->year == $years->current):
								$previous_year = $course->year-1;
								// If the course existed in the previous year and if you are still able to apply for the previous year
								if(in_array($previous_year, $course->years) && in_array($previous_year, $years->years)) :?>
									<div class="current">
										<a href='<?php echo "/courses/$level/$previous_year/$course->instance_id"; ?>'>See <?php echo $course->year-1?> entry</a>
									</div>
								<?php endif;
							else:
								// If the year being looked at is before the current year and the course is running in the current year
								if($course->year < $years->current && in_array($years->current, $course->years)) :?>
									<div class="current">
										<a href='<?php echo $meta['active_instance']; ?>'>See <?php echo $years->current;?> entry</a>
									</div>
								<?php endif;
							endif; ?>
					</span>
					<div class="spaced-links-container">
						<div class="spaced-links-inner-container links">
							<span class="text-accent spaced-links-item"><i class="kf-pin"></i> <?php echo $course->locations_str_linked; ?></span>
							<a href="#contact-modal" class="spaced-links-item text-accent" id="contactButton" data-toggle="modal" data-target="#contact-modal" onclick="window.KENT.kat.event('course-page', 'contact-ug-modal', '[<?php echo $course->instance_id ?>] <?php echo $course->programme_title; ?> (<?php echo $course->year ?>)');"><i class="kf-comment"></i> Contact Us</a>
							<a href="#prospectus-modal" class="spaced-links-item text-accent" id="prospectusButton" data-toggle="modal" data-target="#prospectus-modal" onclick="window.KENT.kat.event('course-page', 'prospectus-ug-modal', '[<?php echo $course->instance_id ?>] <?php echo $course->programme_title; ?> (<?php echo $course->year ?>)');"><i class="kf-book"></i> Prospectus</a>
						</div>
						<div class="spaced-links-inner-container buttons">
							<a href="<?php echo $course->globals->open_days_button_link; ?>" class="btn btn-tertiary spaced-links-item-btn"><?php echo $course->globals->open_days_button_text; ?></a>
							<?php if (isset($course->globals->disable_apply) && $course->globals->disable_apply=='true'): ?>
								<?php if($course->year < $years->current && in_array($years->current, $course->years)) :?>
								<a href="<?php echo Flight::request()->base; ?>/<?php echo $level; ?>/<?php echo $course->instance_id ?>/"
								   class="btn btn-primary pull-right spaced-links-item-btn"
								   type="button"
								   role="button"
								>View <?php echo $course->current_year ?> programme</a>
								<?php endif; ?>
							<?php elseif( defined('CLEARING') && CLEARING && $course->year < $years->current):?>
								<?php if ($has_parttime): ?>

								<?php foreach ($course->deliveries as $delivery): ?>

									<?php if ($delivery->attendance_pattern == 'part-time'): ?>
									<a
											id="apply-link-<?php echo strtolower(str_replace(array('/', ' ', '(', ')'), '', $delivery->award_name)) ?>-<?php echo $delivery->attendance_pattern ?>-<?php echo $course->year ?>"
											class="btn btn-secondary spaced-links-item-btn"
											tabindex="0" role="button"
											title="Part-time applicants"
											href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->current_ipo ?>"
											onclick="window.KENT.kat.event('course-page', 'apply-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>] at <?php echo $schoolName ?>');">
											Part-time applicants
									</a>
									<?php endif; ?>

								<?php endforeach; ?>


								<?php endif; ?>
							<?php else:?>
								<button class="btn btn-primary spaced-links-item-btn"
										type="button"
										role="button"
										aria-controls="apply"
										id="applyButton"
										data-toggle="modal"
										data-target="#apply-modal"
										onclick="window.KENT.kat.event('course-page', 'apply-ug-modal', '[<?php echo $course->instance_id ?>] <?php echo $course->programme_title; ?> (<?php echo $course->year ?>)');"
								>Apply now</button>
							<?php endif; ?>
						</div>
					</div>

					<div class="lead split">
						<?php
						$syn = trim($course->programme_synopsis);
						if(empty($syn)):
							if (preg_match('%<p[^>]*>(.*?)</p>%i', $course->programme_overview_text, $regs)):?>
								<p>
									<?php echo$regs[1] ?>
								</p>
							<?php endif; ?>
						<?php else: ?>
							<?php echo $course->programme_synopsis  ?>
						<?php endif; ?>
						<div class="wrapper">
							<svg width="2em" height="6em" xmlns="http://www.w3.org/2000/svg">
								<path fill="none" stroke="#937227" d="M30, 0L0,100Z" stroke-width="2" opacity="1"></path>
							</svg>
							<div class="current-year">
									<?php

									if(!defined("SHOW_UG_PREVIOUS_YEAR_BANNER") || SHOW_UG_PREVIOUS_YEAR_BANNER == false ): ?>
										<span class="entry-year entry-year-single"><?php echo $course->year; ?></span>
									<?php else: ?>
										<div class="entry-year"> <?php echo $course->year ?></div>
									<?php endif;

										//If it's the current year
									if($course->year == $years->current):
										$previous_year = $course->year-1;
										// If the course existed in the previous year and if you are still able to apply for the previous year
										if(in_array($previous_year, $course->years) && in_array($previous_year, $years->years)) :?>
											<div class="current">
												<a href='<?php echo "/courses/$level/$previous_year/$course->instance_id"; ?>'>See <?php echo $course->year-1?> entry</a>
											</div>
										<?php endif;
									else:
										// If the year being looked at is before the current year and the course is running in the current year
										if($course->year < $years->current && in_array($years->current, $course->years)) :?>
											<div class="current">
												<a href='<?php echo $meta['active_instance']; ?>'>See <?php echo $years->current;?> entry</a>
											</div>
										<?php endif;
									endif; ?>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="content-container relative">
				<div class="content-aside top-sidebar">
					<?php Flight::render("ug/top-sidebar"); ?>
				</div>
				<div class="content-main">
					<div class="tab-content vertical-nav">
						<?php
						Flight::render("partials/tab", array("title"=>"Overview", "id" => "overview", "selected" => true, "content" => Flight::fetch("ug/tabs/overview")));
						Flight::render("partials/tab", array("title"=>"Course structure", "id" => "structure", "selected" => false, "content" => Flight::fetch("ug/tabs/structure")));
						Flight::render("partials/tab", array("title"=>"Teaching &amp; Assessment", "id" => "teaching", "selected" => false, "content" => Flight::fetch("ug/tabs/teaching")));
						Flight::render("partials/tab", array("title"=>"Careers", "id" => "careers",  "selected" => false, "content" => Flight::fetch("ug/tabs/careers")));
						Flight::render("partials/tab", array("title"=>"Entry requirements", "id" => "entry",  "selected" => false, "content" => Flight::fetch("ug/tabs/entry")));
						Flight::render("partials/tab", array("title"=>"Funding", "id" => "funding",  "selected" => false, "content" => Flight::fetch("ug/tabs/fees")));
						?>
					</div>
				</div>
				<div class="content-aside">
					<?php Flight::render("ug/sidebar"); ?>
				</div>
			</div>
		</div>

<?php Flight::render("partials/profile-feature"); ?>
	<div class="content-container">
		<div class="content-full">
			<?php if ($course->kiscourseid != '' && $course->programme_suspended != 'true' && (SHOW_UNISTATS_WIDGET == true)): ?>
				<section class="panel tertiary-tier highlighted no-border kiss-widget-section">
					<div class="row">
					<?php if ($has_fulltime){ ?>


						<div class="col-xs-12 col-sm-12 col-lg-12">
							<?php if ($has_parttime){ ?>
								<h4>Full-time</h4>
							<?php } ?>
							<?php $ukprn = (isset($course->kis_institution_id) && $course->kis_institution_id != '') ? $course->kis_institution_id : $course->globals->ukprn; ?>
							
							<iframe id="unistats-widget-frame" title="Unistats KIS Widget" src="https://discoveruni.gov.uk/widget/<?php echo $ukprn ?>/<?php echo str_replace(array('/', '|', ':', '&', '.', '>', '+', '#', ';', '?', '@', '='), '_', $course->kiscourseid); ?>/responsive/small/en-GB/FullTime" scrolling="no" style="overflow: hidden; border: 0px none transparent; width: 100%;"></iframe>
								
						</div>
					<?php } ?>
					<?php if ($has_parttime){ ?>
						<div class="col-xs-12 col-sm-12 col-lg-12">
							<?php if ($has_fulltime){ ?>
								<h4>Part-time</h4>
							<?php } ?>
							<?php $ukprn = (isset($course->kis_institution_id) && $course->kis_institution_id != '') ? $course->kis_institution_id : $course->globals->ukprn; ?>
							
							<iframe id="unistats-widget-frame" title="Unistats KIS Widget" src="https://discoveruni.gov.uk/widget/<?php echo $ukprn ?>/<?php echo str_replace(array('/', '|', ':', '&', '.', '>', '+', '#', ';', '?', '@', '='), '_', $course->kiscourseid); ?>/responsive/small/en-GB/PartTime" scrolling="no" style="overflow: hidden; border: 0px none transparent; width: 100%;"></iframe>
						</div>

					<?php } ?>
					<div class="col-xs-12 pt-1 small">
							<?php echo $course->kis_explanatory_textarea ?>

							<?php if (!empty($course->globals->general_contact_blurb)): ?>
								<?php echo $course->globals->general_contact_blurb; ?>
							<?php endif ?>
					</div>
					</div>
				</section>
			<?php endif; ?>
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
<?php Flight::render("ug/contact-modal"); ?>
<?php Flight::render("ug/prospectus-modal"); ?>
<?php Flight::render("ug/apply-modal"); ?>
