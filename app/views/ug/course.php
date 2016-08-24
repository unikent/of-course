<?php


$has_foundation = (strpos(strtolower($course->programme_type), 'foundation year') !== false);

// Make pos available
$course->pos_code = isset($course->deliveries[0]) ? $course->deliveries[0]->pos_code : '';

?>


<div class="content-page">
	<div class="content-body">
		<div class="content-header">

			<p class="lead">
			<?php
			// @todo - This is a new field that will be added to the PP in the near future. To demo the behavior
			// I'm currently just hacking in a "correct-ish" looking value by grabbing the first p of the overview if i can
			if (preg_match('%<p[^>]*>(.*?)</p>%i', $course->programme_overview_text, $regs)) {
				echo $regs[1];
			} ?>
			</p>

			<?php Flight::render("partials/notices"); ?>
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


<?php if (isset($course->no_fee_output) && $course->no_fee_output === 'true'): ?>
	<!-- Do nothing -->
<?php else: ?>
<!-- fees panel -->
<div class="card-panel card-panel-tertiary p-b-0 m-b-0">
    <div class="card-panel-body" style="margin-top:2rem;margin-bottom:2rem;">

        <div class="card-panel-single">
            <?php if (isset($course->globals->fees_caveat_text_ug) && !empty($course->globals->fees_caveat_text_ug)) echo ' <h3 class="card-title">'.$course->globals->fees_caveat_text_ug.'</h3>' ?>
           <table class="table">
				<thead>
					<tr>
						<th></th>
						<th>UK/EU</th>
						<th>Overseas</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$fees = $course->deliveries[0]->fees;
					?>
					<?php if ($has_fulltime): ?>
						<tr>
							<td><strong>Full-time</strong></td>
							<td><?php echo (is_numeric($fees->home_full_time) ? '&'.$fees->currency.';' : '') . $fees->home_full_time; ?></td>
							<td><?php echo (is_numeric($fees->int_full_time) ? '&'.$fees->currency.';' : '') . $fees->int_full_time; ?></td>
						</tr>
					<?php endif; ?>
					<?php if ($has_parttime): ?>
						<tr>
							<td><strong>Part-time</strong></td>
							<td><?php echo (is_numeric($fees->home_part_time) ? '&'.$fees->currency.';' : '') . $fees->home_part_time; ?></td>
							<td><?php echo (is_numeric($fees->int_part_time) ? '&'.$fees->currency.';' : '') . $fees->int_part_time; ?></td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
        </div>
        <div class="card-panel-single">
            <div class="card" style="font-size:0.7rem;">
            			<?php
						if ($has_foundation && isset($course->globals->fees_foundation_year_exception_text_ug)) {
							echo $course->globals->fees_foundation_year_exception_text_ug;
						}
						if (isset($course->globals->fees_year_in_industryabroad_text_ug) && // If YII/YA text is set AND
							(
								(!empty($course->year_in_industry)) || // YII or YA has some text
								(!empty($course->year_abroad))
							) // then
						) {
							echo $course->globals->fees_year_in_industryabroad_text_ug;
						}
										
						if (isset($course->globals->fees_exception_text_ug)) echo $course->globals->fees_exception_text_ug;
						?>
            </div>
        </div>

    </div>
</div>
<?php endif; ?>

<div class="card card-overlay  p-t-0 m-t-0"">
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

<div class="card card-overlay m-b-0 p-b-0" >
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