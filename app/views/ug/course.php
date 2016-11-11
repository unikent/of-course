<?php
$has_foundation = (strpos(strtolower($course->programme_type), 'foundation year') !== false);

// Make pos available
$course->pos_code = isset($course->deliveries[0]) ? $course->deliveries[0]->pos_code : '';
?>
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
							<a href="https://www.kent.ac.uk/courses/visit/openday/" class="btn btn-tertiary spaced-links-item-btn">Book an open day</a>
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
						if (preg_match('%<p[^>]*>(.*?)</p>%i', $course->programme_overview_text, $regs)) {
							echo $regs[1];
						} ?>
					</p>
					<?php Flight::render("partials/notices"); ?>
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

						if ((isset($preview) && $preview == true) || (!defined('CLEARING') || (defined('CLEARING') && !CLEARING)) || (defined('CLEARING') && CLEARING && $course->current_year == $course->year)){
							Flight::render("partials/tab", array("title"=>"Entry requirements", "id" => "entry",  "selected" => false, "content" => Flight::fetch("ug/tabs/entry")));
						}

						Flight::render("partials/tab", array("title"=>"Funding", "id" => "funding",  "selected" => false, "content" => Flight::fetch("ug/tabs/fees")));
						Flight::render("partials/tab", array("title"=>"Enquiries", "id" => "enquiries", "selected" => false, "content" => Flight::fetch("ug/tabs/enquiries")));
						?>
					</div>
				</div>
				<div class="content-aside">
					<?php Flight::render("ug/sidebar"); ?>
				</div>
			</div>
		</div>

	<div class="card card-overlay"">
	<div class="card-body">
		<div class="card-title-wrap card-title-wrap-link">
			<a href="https://www.kent.ac.uk/research/" class="card-title-link">
				<h2 class="card-title">Student Profile</h2>
			</a>
			<h2 class="card-title" style="color:#fff">Helen Shrew</h2>
			<p class="card-text">Some text here about the student profile etc..</p>
		</div>
		<div class="card-media-wrap">
			<img src="/media/images/undergrad-discussion-library-16x9.jpg" class="card-img" alt="Students chatting in the library">
		</div>
		<div class="card-img-overlay-bottom text-xs-right">
			<h3 class="card-subtitle"><?php echo $course->programme_title; ?> - <?php echo $course->award_list_linked; ?></h3>
		</div>
	</div>
	</div>
	<div class="content-container">
		<div class="content-full">
			<?php if ($course->kiscourseid != '' && $course->programme_suspended != 'true'): ?>
				<section class="panel tertiary-tier highlighted no-border kiss-widget-section">
					<?php if ($has_fulltime){ ?>
						<?php if ($has_parttime){ ?>
							<h4>Full Time</h4>
						<?php } ?>
						<div class="row-fluid">
							<div class="span12">
								<?php $ukprn = (isset($course->kis_institution_id) && $course->kis_institution_id != '') ? $course->kis_institution_id : $course->globals->ukprn; ?>
								<iframe id="unistats-widget-frame" title="Unistats KIS Widget" src="//widget.unistats.ac.uk/Widget/<?php echo $ukprn ?>/<?php echo str_replace(array('/', '|', ':', '&', '.', '>', '+', '#', ';', '?', '@', '='), '_', $course->kiscourseid); ?>/horizontal/small/en-GB/Full%20Time" scrolling="no" style="overflow: hidden; border: 0px none transparent; width: 615px; height: 150px;"> </iframe>
							</div>
						</div>
						<br>
					<?php } ?>
					<?php if ($has_parttime){ ?>
						<?php if ($has_fulltime){ ?>
							<h4>Part Time</h4>
						<?php } ?>
						<div class="row-fluid">
							<div class="span12">
								<?php $ukprn = (isset($course->kis_institution_id) && $course->kis_institution_id != '') ? $course->kis_institution_id : $course->globals->ukprn; ?>
								<iframe id="unistats-widget-frame" title="Unistats KIS Widget" src="//widget.unistats.ac.uk/Widget/<?php echo $ukprn ?>/<?php echo str_replace(array('/', '|', ':', '&', '.', '>', '+', '#', ';', '?', '@', '='), '_', $course->kiscourseid); ?>/horizontal/small/en-GB/Part%20Time" scrolling="no" style="overflow: hidden; border: 0px none transparent; width: 615px; height: 150px;"> </iframe>
							</div>
						</div>
						<br>
					<?php } ?>
					<div class="small">
							<?php echo $course->kis_explanatory_textarea ?>

							<?php if (!empty($course->globals->general_contact_blurb)): ?>
								<?php echo $course->globals->general_contact_blurb; ?>
							<?php endif ?>
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
<?php Flight::render("partials/modals/contact"); ?>
<?php Flight::render("partials/modals/prospectus"); ?>
<?php Flight::render("ug/apply-modal"); ?>