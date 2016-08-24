
<nav class="nav-list">
	<h3>Get in touch </h3>
	<ul>
		<li><a href="#">Visit us</a></li>
		<li><a href="#">Contact us</a></li>
		<li>Call: 000 0000000</li>
	</ul>
</nav>

<a href="#" class="btn btn-primary">Live chat</a>

<hr> 

<nav class="nav-list">
	<h3>Resources </h3>
	<ul>
		<li><a href="#">Order a prospectus</a></li>

		<?php 
		if(!empty($course->subject_leaflet[0])){
			$ext = strtoupper(pathinfo($course->subject_leaflet[0]->tracking_code,PATHINFO_EXTENSION));
			echo '<li><a href="'.$course->subject_leaflet[0]->tracking_code.'">'.$course->subject_leaflet[0]->name.' ('. $ext .')</a></li>';
		}
		if(!empty($course->subject_leaflet_2[0])){
			$ext = strtoupper(pathinfo($course->subject_leaflet_2[0]->tracking_code,PATHINFO_EXTENSION));
			echo '<li><a href="'.$course->subject_leaflet_2[0]->tracking_code.'">'.$course->subject_leaflet_2[0]->name.' ('. $ext .')</a></li>';
		}
		?>

	</ul>
</nav>



<div class="side-panel">


					<div class="admission-links">
						<?php if(defined('CLEARING') && CLEARING){
							?>
							<div class="clearing-panel">
								<h2>Clearing <?php echo ($course->current_year - 1); ?> - Full-time applicants</h2>
								<a href="https://www.kent.ac.uk/clearing/" class="btn btn-large apply-adm-link"
								   type="button"
								   role="button"
								   aria-controls="apply">Check clearing vacancies</a>
							</div>
							<?php
							$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
							if($has_parttime){
							?>
							<a href="<?php echo Flight::request()->base; ?>/undergraduate/<?php echo $course->year != $course->current_year ? $course->year . '/' : '' ?>apply-online/<?php echo $course->instance_id ?>?part_time=1"
							   class=""
							   onclick="_pat.event('course-page', 'apply-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $course->programme_title ?> at <?php echo $schoolName ?>');">Part-time applicants</a>
							<br><br>
							<?php } ?>
							<a href="#!enquiries"
							   class="enquire-adm-link"
							   role="tab"
							   aria-controls="enquiries">Contact us</a>
							or <a href="#!enquiries" class="pros-adm-link" role="tab" aria-controls="enquiries">order a prospectus
							</a>
							<?php
						}else{?>
						<?php if (isset($course->globals->disable_apply) && $course->globals->disable_apply=='true'): ?>
							<a href="<?php echo Flight::request()->base; ?>/undergraduate/<?php echo $course->instance_id ?>/"
								class="btn btn-large apply-adm-link"
								type="button"
								role="button"
								>View <?php echo $course->current_year ?> programme</a>
						<?php else:?>
							<a href="<?php echo Flight::request()->base; ?>/undergraduate/<?php echo $course->year != $course->current_year ? $course->year . '/' : '' ?>apply-online/<?php echo $course->instance_id ?>"
								class="btn btn-large apply-adm-link"
								type="button"
								role="button"
								aria-controls="apply"
								onclick="_pat.event('course-page', 'apply-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $course->programme_title ?> at <?php echo $schoolName ?>');">Apply</a>
						<?php endif; ?>
						<a href="#!enquiries"
							class="enquire-adm-link"
							role="tab"
							aria-controls="enquiries">Contact us</a>
							or <a href="#!enquiries" class="pros-adm-link" role="tab" aria-controls="enquiries">order a prospectus
						</a>
						<?php } ?>
					</div><!-- /.admission-links -->




					<?php if (isset($course->staff_profile) && !empty(trim($course->staff_profile)) ){ ?>
					<div class="key-facts-block">
						<div class="key-facts-container">
							<h2><a href="<?php echo $course->staff_profile; ?>">Staff profiles <i class="icon-chevron-right"></i></a></h2>
						</div>
					</div>
					<?php } ?>
					<?php if (isset($course->no_fee_output) && $course->no_fee_output === 'true'): ?>
						<!-- Do nothing -->
					<?php else: ?>
						<div class="key-facts-block">
							<div class="key-facts-container">
								<h2><a id="fees-tables-link" class="fees-toggle" role="button" aria-controls="fees-tables"
										tabindex='0' title='Click to toggle basic fee information'
										onClick="_pat.event('course-page','expand-fees-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $course->programme_title ?> - <?php echo $course->award[0]->name ?>');">Fees
										<i class="icon-chevron-down toggler"></i></a></h2>
										<div id="fees-tables" class="fees-tables" aria-expanded="true"
										aria-labelledby="fees-tables-link">

										<?php if (isset($course->globals->fees_caveat_text_ug) && !empty($course->globals->fees_caveat_text_ug)) echo $course->globals->fees_caveat_text_ug ?>
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

											<?php
											if ($has_foundation && isset($course->globals->fees_foundation_year_exception_text_ug)) {
												echo $course->globals->fees_foundation_year_exception_text_ug;
											}
											?>

											<?php

											if (
											isset($course->globals->fees_year_in_industryabroad_text_ug) && // If YII/YA text is set AND
											(
											(!empty($course->year_in_industry)) || // YII or YA has some text
											(!empty($course->year_abroad))
											) // then
											) {
												echo $course->globals->fees_year_in_industryabroad_text_ug;
											}
											?>

											<?php
											if (isset($course->globals->fees_exception_text_ug)) echo $course->globals->fees_exception_text_ug;
											?>
										</div>
									</div>
								</div>
							<?php endif; ?>

							
						</div><!-- /.side-panel -->