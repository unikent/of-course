<div class="content-page">
	<div class="content-body">
		<div class="content-header">

			<p class="lead">
			<?php
			// @todo - This is a new field that will be added to the PP in the near future. To demo the behavior
			// I'm currently just hacking in a "correct-ish" looking value by grabbing the first p of the overview if i can
			if (preg_match('%<p[^>]*>(.*?)</p>%i', $course->schoolsubject_overview, $regs)) {
				echo $regs[1];
			} ?>
			</p>

			<?php Flight::render("partials/notices"); ?>
			<?php Flight::render("pg/key-features"); ?>

		</div>

	<div class="content-header" style="margin-top:3rem; margin-bottom:3rem;">
			<ul class="nav nav-tabs hidden-sm-down" role="tablist">
				<li class="nav-item"><a href="#overview" data-toggle="tab" role="tab" class="nav-link active">Overview</a></li>
				<?php if (strpos($course->programme_type, 'taught') !== false || (strpos($course->programme_type, 'research') !== false && !empty($course->programme_overview))): ?>
					<li class="nav-item"><a href="#structure" data-toggle="tab" role="tab" class="nav-link">Course structure</a></li>
				<?php endif; ?>

				<?php if (!empty($course->key_information_miscellaneous)): ?>
					<li class="nav-item"><a href="#study-support" data-toggle="tab" role="tab" class="nav-link">Study support</a></li>
				<?php endif; ?>

				<?php if (!empty($course->careers_and_employability) || !empty($course->globals->careersemployability_text) || !empty($course->professional_recognition)): ?>
					<li class="nav-item"><a href="#careers" data-toggle="tab" role="tab" class="nav-link">Careers</a></li>
				<?php endif; ?>

				<li class="nav-item"><a href="#entry-requirements" data-toggle="tab" role="tab" class="nav-link">Entry requirements</a></li>

				<?php if (!empty($course->research_groups)): ?>
					<li class="nav-item"><a href="#research-areas" data-toggle="tab" role="tab" class="nav-link">Research areas</a></li>
				<?php endif; ?>

				<li class="nav-item"><a href="#staff-research" data-toggle="tab" role="tab" class="nav-link">Staff research</a></li>
				<li class='sr-only'><a href="#fees-tables-link" data-toggle="tab" role="tab" class="nav-link">Fees</a></li>
				<li class='sr-only'><a href="#enquiries" data-toggle="tab" role="tab" class="nav-link">Enquiries</a></li>
			</ul>
		</div>


		<div class="content-container">
			<div class="content-main">
					<div class="tab-content">
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
</div>


<?php if (isset($course->no_fee_output) && $course->no_fee_output === 'true'): ?>
	<!-- Do nothing -->
<?php else: ?>
<!-- fees panel -->
<div class="card-panel card-panel-tertiary p-b-0 m-b-0">
    <div class="card-panel-body" style="margin-top:2rem;margin-bottom:2rem;">


	    <?php if (isset($course->globals->fees_override_pgr) && !empty($course->globals->fees_override_pgr) && strpos($course->programme_type, 'research') !== false) {
				echo '<div class="card-panel-single">'.$course->globals->fees_override_pgr.'</div>';
			} else {
		?>
	        <div class="card-panel-single">
	            <?php if (isset($course->globals->fees_caveat_text_pg) && !empty($course->globals->fees_caveat_text_pg)) echo ' <h3 class="card-title">'.$course->globals->fees_caveat_text_pg.'</h3>' ?>
	          
	            <?php $pos_codes = array(); foreach ($course->deliveries as $delivery): ?>
					<?php if (!in_array($delivery->pos_code, $pos_codes)): ?>
						<table class="table">
							<thead>
							<tr>
								<td colspan="3"><i
										class="icon icon-bullet"></i> <?php echo preg_replace('/- (\w){4}-time/', '', $delivery->description) . ':' ?>
								</td>
							</tr>
							<tr>
								<th></th>
								<th>UK/EU</th>
								<th>Overseas</th>
							</tr>
							</thead>
							<tbody>
							<?php if ($has_fulltime): ?>
								<tr>
									<td><strong>Full-time</strong></td>
									<td><?php echo (is_numeric($delivery->fees->home_full_time) ? '&'.$delivery->fees->currency.';' : '') . $delivery->fees->home_full_time; ?></td>
									<td><?php echo (is_numeric($delivery->fees->int_full_time) ? '&'.$delivery->fees->currency.';' : '') . $delivery->fees->int_full_time; ?></td>
								</tr>
							<?php endif; ?>
							<?php if ($has_parttime): ?>
								<tr>
									<td><strong>Part-time</strong></td>
									<td><?php echo (is_numeric($delivery->fees->home_part_time) ? '&'.$delivery->fees->currency.';' : '') . $delivery->fees->home_part_time; ?></td>
									<td><?php echo (is_numeric($delivery->fees->int_part_time) ? '&'.$delivery->fees->currency.';' : '') . $delivery->fees->int_part_time; ?></td>
								</tr>
							<?php endif; ?>
							</tbody>
						</table>
						<?php $pos_codes[] = $delivery->pos_code; endif; ?>
				<?php endforeach; ?>


	        </div>
	        <div class="card-panel-single">
	            <div class="card" style="font-size:0.7rem;">
	            			<?php
							if (
								isset($course->globals->fees_year_in_industryabroad_text_pg) && // If YII/YA text is set AND
								(
									(!empty($course->year_in_industry)) || // YII or YA has some text
									(!empty($course->year_abroad))
								) // then
							) {
								echo $course->globals->fees_year_in_industryabroad_text_pg;
							}

							if (isset($course->globals->fees_exception_text_pg)) echo $course->globals->fees_exception_text_pg;
							?>
	            </div>
	        </div>
        <?php } ?>
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
			<img src="/media/images/undergrad-discussion-library-16x9.jpg" class="card-img" alt="Students chatting in the library">
		</div>
	<div class="card-img-overlay-bottom text-xs-right">
		<h3 class="card-subtitle"><?php echo $course->programme_title; ?> - <?php echo $course->award_list_linked; ?></h3>
	</div>

	</div>
</div>




<div class="card card-overlay m-b-0 p-b-0" >
	<div class="card-body">
		<div class="card-media-wrap">
			<img class="card-img" src="/media/images/students.jpg">
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
