<?php
use \unikent\kent_theme\kentThemeHelper;

$schoolName = $course->administrative_school[0]->name;
$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);
$has_foundation = (strpos(strtolower($course->programme_type), 'foundation year') !== false);

// Make pos available
$course->pos_code = isset($course->deliveries[0]) ? $course->deliveries[0]->pos_code : '';

Flight::view()->set('course', $course);

?>

<div class="content-page">
	<div class="content-body">
	<div class="content-header">
<?php
KentThemeHelper::breadcrumb(array(
		'Courses'=>'/',
		'Undergraduate 2016'=>'/',
		$course->programme_title =>''
	));
?>	
</div>

		<div class="content-header">
			<header>
				<h1>
					<?php echo $course->programme_title; ?> - <?php echo $course->award_list_linked; ?>
					<?php echo $course->programmme_status_text; ?>
				</h1>
				<p class='location-header' ><?php echo $course->locations_str; ?></p>
			</header>

			<?php if ($course->programme_suspended == 'true' || $course->programme_withdrawn == 'true' || $course->holding_message != ''):
				//suppress content if holding message text filled in
				echo $course->holding_message;
			else: ?>


			<?php Flight::render("ug/key-features"); ?>

		</div>

		<div class="content-header" style="margin-top:3rem; margin-bottom:3rem;">
			<ul class="nav nav-tabs hidden-sm-down" role="tablist">
				<li class="nav-item"><a href="#overview" data-toggle="tab" role="tab" class="nav-link active"> Overview</a></li>
				<li class="nav-item"><a href="#structure" data-toggle="tab" role="tab" class="nav-link">Course structure</a></li>
				<li class="nav-item"><a href="#teaching" data-toggle="tab" role="tab" class="nav-link">Teaching &amp; Assessment</a></li>
				<li class="nav-item"><a href="#careers" data-toggle="tab" role="tab" class="nav-link">Careers</a></li>
				<?php if ((isset($preview) && $preview == true) || (!defined('CLEARING') || (defined('CLEARING') && !CLEARING)) || (defined('CLEARING') && CLEARING && $course->current_year == $course->year)): ?>
					<li class="nav-item"><a href="#entry" data-toggle="tab" role="tab" class="nav-link">Entry requirements</a></li>
				<?php endif; ?>
					<li class="nav-item"><a href="#funding" data-toggle="tab" role="tab" class="nav-link">Funding</a></li>

					<li class='sr-only' ><a href="#fees-tables-link" data-toggle="tab" role="tab" class="nav-link">Fees</a></li>
					<li class='sr-only'><a href="#enquiries" data-toggle="tab" role="tab" class="nav-link">Enquiries</a></li>
			</ul>
		</div>

		<div class="content-container">
			<div class="content-main">
					<div class="tab-content">
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
</div>




<div class="card card-overlay">
	<div class="card-body">
		<div class="card-title-wrap card-title-wrap-link">
			<a href="https://www.kent.ac.uk/research/" class="card-title-link"><h2 class="card-title">Student Profile</h2></a>
			<h2 class="card-title" style="color:#fff">Helen Shrew</h2>
			<p class="card-text">Some text here about the student profile etc..</p>
		</div>
		<div class="card-media-wrap">
			<img src="<?php echo Flight::url("/images/undergrad-discussion-library-16x9.jpg");?>" class="card-img" alt="Students chatting in the library">
		</div>
	<div class="card-img-overlay-bottom text-xs-right">
		<h3 class="card-subtitle"><?php echo $course->programme_title; ?> - <?php echo $course->award_list_linked; ?></h3>
	</div>

	</div>
</div>



<?php endif; ?>

<div class="content-page">
	<div class="content-body">
		<div class="content-header">


				<?php if ($course->kiscourseid != '' && $course->programme_suspended != 'true'): ?>
					<section class="panel tertiary-tier highlighted no-border kiss-widget-section">
						<h2>Key Information Sets</h2>
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
						<div class="row-fluid">
							<div class="span8">
								<?php echo $course->kis_explanatory_textarea ?>
							</div>
							<div class="span4">
								<!-- A placeholder for now -->
								<?php if (!empty($course->globals->general_contact_blurb)): ?>
									<?php echo $course->globals->general_contact_blurb; ?>
								<?php endif ?>
							</div>
						</div>
					</section>

				<?php endif; ?>

</div></div></div>

<div class="card card-overlay">
				<div class="card-body">
					<div class="card-media-wrap">
						<img class="card-img" src="<?php echo FLight::url("images/students.jpg");?>">
					</div>
					<div class="card-img-overlay-centered card-img-overlay-tinted">
						<div class="text-xs-center">
							<h2 class="card-subtitle">Stunning locations & comfortable accomodation</h2>
							
							<br>
							<p><a href="#dostuff" class="btn btn-primary">Book a visit today</a></p>
						</div>
					</div>
				</div>
			</div>





				<section id="learnmore" class="learnmore-section"></section>

				<?php if (!empty($course->related_courses)): ?>
					<section class="related-course-section">
						<h2>Related to this course</h2>

						<div id="myCarousel" class="carousel slide" data-interval="false">
							<!-- Carousel items -->
							<div class="<?php echo count($course->related_courses) > 4 ? 'carousel-inner' : 'carousel-inner-left'; ?>">
								<?php $count = 0; ?>
								<?php for ($i = 0; $i < (round((count($course->related_courses) / 4) + 0.5, 0, PHP_ROUND_HALF_DOWN)); $i++): ?>
									<?php $related_courses = array_slice($course->related_courses, $i * 4) ?>
									<div class="<?php if ($count == 0) echo 'active ' ?>item">

										<?php foreach ($related_courses as $related_course): ?>
											<div class="span2 related-course">
												<div class="cell">
													<div class="mask">
														<a href="<?php echo Flight::url("{$level}/{$related_course->id}/{$related_course->slug}"); ?>">
															<span><?php echo $related_course->name ?> <?php echo !empty($related_course->programmme_status_text) ? $related_course->programmme_status_text : ''; ?></span>
															<span class="related-award"><?php echo $related_course->award; ?></span>
														</a>
													</div>
												</div>
											</div>
											<?php $count++;
											if ($count % 4 == 0) break; ?>
										<?php endforeach; ?>

									</div>
								<?php endfor; ?>
							</div>
							<!-- Carousel nav -->
							<?php if (count($course->related_courses) > 4): ?>
								<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
								<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
							<?php endif; ?>
						</div>

						<ul class="related-course-list">
							<?php foreach ($course->related_courses as $related_course): ?>
								<li>
									<a href="<?php echo Flight::url("{$level}/{$related_course->id}/{$related_course->slug}"); ?>">
										<span><?php echo $related_course->name ?> <?php echo !empty($related_course->programmme_status_text) ? $related_course->programmme_status_text : ''; ?></span>
										<span class="related-award"><?php echo $related_course->award; ?></span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>

					</section>
				<?php endif; ?>


				<?php if (!empty($course->globals->general_disclaimer)): ?>
					<footer class="general_disclaimer" style='font-size:0.8em;'>
						<?php echo $course->globals->general_disclaimer; ?>
					</footer>
				<?php endif; ?>

			</article>
			<kentScripts>
				<script>
					$("#enquiries .info-section a").click(function () {
						var link = $(this)[0];
						if (link.protocol !== 'mailto:') return;
						_pat.event("course-page", "enquire-by-email-ug", link.pathname + " via <?php echo "[{$course->instance_id} in {$course->year}] {$course->programme_title} ( {$course->award[0]->name} )" ?>");
					});
				</script>
			</kentScripts>
