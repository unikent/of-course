<!-- contact modal -->
<div class="modal modal-course fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="#contactButton" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-10">
               				 <h3 class="modal-title">Contact us</h3>
							</div>
					</div>
				</div>
            </div>
            <div class="modal-body container-fluid">
					<div class="row">
						<div class="col-md-12">
							<?php
							$year_for_url = empty($year) ? '' : ((strcmp($year, CoursesController::$current_year) == 0) ? '' : $year . '/');
							$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
							$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);

							// Tracking name
							$course_name_fortracking = "[{$course->instance_id} in {$course->year}] {$course->programme_title} ";
							$sits_url = 'https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?';
							$enquire_link = array();
							$enquire_event = array();
							$awards = array();
							$descriptions = array();
							$show= array();
							foreach($course->deliveries as $delivery){

								$mode = $delivery->attendance_pattern;
								$award = $delivery->award_name;
								// pos is used to group pt/ft deliveries together for each award

								$pos = $delivery->pos_code;
								$mcr = trim($delivery->mcr) != '' ? $delivery->mcr : 'AAGEN102';

								//work out the key from the first part of the MCR code
								$mcr_split = split('-', $delivery->mcr);
								$key = $mcr_split[0];

								// create vars
								if (!isset($enquire_link[$key])) {
									$enquire_link[$key] = array();
									$enquire_event[$key] = array();
								}

								if (isset($delivery->ari_code)) {
									$ari_code = $delivery->ari_code;
									$show[$key] = true;
								} else {
									$ari_code = (string)null;
									$show[$key] = false;
								}

								$description = str_replace($course->programme_title, '', $delivery->description);
								$description = substr($description, 0, strpos($description, '-'));

								$descriptions[$key] = $description;
								$awards[$key] = $award;

								// Generate links
								$link = $sits_url . 'process=siw_ipp_enq&code1=%s&code2=&code4=ipr_ipp5=%s';
								$enquire_link[$key][$mode] = sprintf($link, $ari_code, '10');

								// Generate event trackers
								$eventjs = "onClick=\"_pat.event('course-page', '%s', '%s');\"";
								$event = "$course_name_fortracking - $award" . "$description - $mode [$mcr]";
								$enquire_event[$key][$mode] = sprintf($eventjs, 'enquire-pg', $event);

							}
							?>
							<?php if ($show !== null && in_array(true, $show)): ?>

								<div class='enquire-block'>

									<?php foreach($enquire_link as $key => $details):
										if ($show[$key]): ?>
											<h3><?php echo $awards[$key]. ' '.$descriptions[$key]; ?></h3>
											<ul>
												<?php if($has_fulltime): ?>
													<li>
														<strong>Full-time</strong> - <a
															title="Enquire online - <?php echo $awards[$key]. ' '.$descriptions[$key];?> Full time"
															href='<?php echo $enquire_link[$key]['full-time'];?>'
															<?php echo $enquire_event[$key]['full-time'];?>
														>Enquire online
														</a>
													</li>
												<?php endif; ?>
												<?php if($has_parttime): ?>
													<li>
														<strong>Part-time</strong> - <a
															title="Enquire online - <?php echo $awards[$key]. ' '.$descriptions[$key];?> Part time"
															href='<?php echo $enquire_link[$key]['part-time'];?>'
															<?php echo $enquire_event[$key]['part-time'];?>
														>Enquire online
														</a>
													</li>
												<?php endif; ?>
											</ul>
										<?php endif;
									endforeach;
									?>
								</div>
							<?php endif; ?>

							<h3 class="mt-2">General Enquiries</h3>

							<?php if(!empty($course->admissions_enquiries)):
								$enquiries = str_replace('&nbsp;','',$course->admissions_enquiries);
								?>
								<div class="contacts-enquiries">
									<h4>Admissions enquiries</h4>
									<?php echo html_entity_decode($enquiries) ?>
								</div>
							<?php endif; ?>

							<?php if( ! empty($course->enquiries) ): ?>
								<div class="contacts-enquiries">
									<h4>Subject enquiries</h4>
									<?php echo str_replace("h4", "h5", $course->enquiries); ?>
								</div>
							<?php endif; ?>


							<?php if(!empty($course->additional_school[0])): ?>
								<h4>School websites</h4>
								<ul>
									<li><a href="<?php echo $course->school_website ?>"><?php echo $course->administrative_school[0]->name ?></a></li>
									<li><a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a></li>
								</ul>

							<?php else: ?>
								<h4>School website</h4>
								<ul>
									<li><a href="<?php echo $course->school_website ?>"><?php echo $course->administrative_school[0]->name ?></a></li>
								</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
