
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
		<li><a href="#">Link 1</a></li>
		<li><a href="#">Link 2</a></li>
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

					<div class="key-facts-block">
						<aside class="key-facts-container">
							<h2>Key facts</h2>
							<div class="key-facts">
								<ul>
									<li>
										
									</li>
									<?php
									// If there a second subject area?
									$second_subject = (isset($course->subject_area_2[0]) && $course->subject_area_2[0] != null);
									?>
									<li><strong>Subject area<?php if ($second_subject) echo 's'; ?>:</strong>
										<?php
										echo $course->subject_area_1[0]->name;
										echo ($second_subject) ? ' | ' . $course->subject_area_2[0]->name : '';
										?>
									</li>
									<li><strong>Award:</strong> <?php echo $course->award[0]->name; ?> </li>
									<li><strong>Award type:</strong> <?php echo $course->honours_type; ?> </li>


									<li><strong>Location:</strong>
										<?php
										$locations = (empty($course->location[0]->url)?'':"<a href='{$course->location[0]->url}'>") . $course->location[0]->name . (empty($course->location[0]->url)?'':"</a>");
										$additional_locations = '';

										if ($course->additional_locations != "") {
											foreach ($course->additional_locations as $key => $additional_location) {
												if ($additional_location != '') {
													if ($key == (sizeof($course->additional_locations) - 1)) {
														$additional_locations .= " and <a href='$additional_location->url'>$additional_location->name</a>";
													} else {
														$additional_locations .= ", <a href='$additional_location->url'>$additional_location->name</a>";
													}
												}
											}
										}
										echo $locations . $additional_locations
										?>
									</li>

									<li><strong>Mode of study:</strong> <?php echo $course->mode_of_study; ?></li>

									<?php if (!empty($course->duration)): ?>
										<li><strong>Duration:</strong> <?php echo $course->duration; ?></li>
									<?php endif; ?>

									<?php if (!empty($course->start)): ?>
										<li><strong>Start: </strong> <?php echo $course->start; ?> </li>
									<?php endif; ?>

									<?php if (!empty($course->accredited_by)): ?>
										<li><strong>Accredited by</strong>: <?php echo $course->accredited_by; ?></li>
									<?php endif; ?>

									<?php if (!empty($course->total_kent_credits_awarded_on_completion)): ?>
										<li><strong>Total Kent credits:</strong> <?php echo $course->total_kent_credits_awarded_on_completion; ?></li>
									<?php endif; ?>

									<?php if (!empty($course->total_ects_credits_awarded_on_completion)): ?>
										<li><strong>Total ECTS credits:</strong> <?php echo $course->total_ects_credits_awarded_on_completion; ?></li>
									<?php endif; ?>

									<?php if (strpos($course->programme_type, "year abroad") !== false): ?>
										<li><strong>Year abroad:</strong> Yes</li>
									<?php endif; ?>

									<?php if (strpos($course->programme_type, "year in industry") !== false): ?>
										<li><strong>Year in Industry:</strong> Yes</li>
									<?php endif; ?>
								</ul>
							</div><!-- /.key-facts -->
						</aside>
					</div><!-- /.key-facts-block -->
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

							<?php if(!empty($course->subject_leaflet[0])):

								$file = $course->subject_leaflet[0]->tracking_code;
								$pathParts = pathinfo($file);
								$fileType = strtoupper($pathParts['extension']);
								?>
								<div class="subject-leaflets-block">
									<aside class="subject-leaflets-container">
										<h2>Subject leaflets</h2>
										<div class="subject-leaflets">
											<ul>
												<li>
													<a href="<?php echo $course->subject_leaflet[0]->tracking_code ?>">
														<?php echo $course->subject_leaflet[0]->name ?> (<?php echo $fileType ?>)
													</a>
												</li>
												<?php if(!empty($course->subject_leaflet_2[0])):
													$file = $course->subject_leaflet_2[0]->tracking_code;
													$pathParts = pathinfo($file);
													$fileType = strtoupper($pathParts['extension']);
													?>
													<li>
														<a href="<?php echo $course->subject_leaflet_2[0]->tracking_code ?>">
															<?php echo $course->subject_leaflet_2[0]->name ?> (<?php echo $fileType ?>)
														</a>
													</li>
												<?php endif; ?>
											</ul>
										</div>
									</aside>
								</div><!-- /.subject-leaflets-block -->

							<?php endif; ?>

						</div><!-- /.side-panel -->