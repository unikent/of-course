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
							 <h2 class="modal-title">Contact us</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body container-fluid">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<h3>United Kingdon/EU enquiries</h3>
						<?php
						$year_for_url = empty($year) ? '' : ((strcmp($year, CoursesController::$current_year) == 0) ? '' : $year . '/');
						$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
						$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);
						// Tracking name
						$course_name_fortracking = "[{$course->instance_id} in {$course->year}] {$course->programme_title} - {$course->award[0]->name} [{$course->pos_code}]";
						$eventjs = "onClick=\"window.KENT.kat.event('course-page', '%s', '%s');\"";
						?>
						<?php if (empty($course->subject_to_approval) && (!empty($course->deliveries))) :
							$sits_url = 'https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?';
							$enquire_link = array();
							$enquire_event = array();
							foreach($course->deliveries as $delivery){
								$mode = str_replace('-','', $delivery->attendance_pattern);
								$link = $sits_url . 'process=siw_ipp_enq&code1=%s&code2=&code4=ipr_ipp5=%s';
								$enquire_link[$mode] = sprintf($link, $delivery->ari_code, '10');
								$enquire_event[$mode] = sprintf($eventjs, 'enquire-ug', $course_name_fortracking.'-'.$mode);
							}
							?>
							<h4><?php echo $course->award[0]->name; ?></h4>
							<ul>
							<?php if ($has_fulltime): ?>
								<li>
									<strong>Full-time</strong> - <a
										title="Enquire online - <?php echo $course->award[0]->name;?> Full time"
										href='<?php echo $enquire_link['fulltime'];?>'
										<?php echo $enquire_event['fulltime'];?>
									>Enquire online
									</a>
								</li>
							<?php endif; ?>

							<?php if($has_parttime): ?>
								<li>
									<strong>Part-time</strong> - <a
										title="Enquire online - <?php echo $course->award[0]->name;?> Part time"
										href='<?php echo $enquire_link['parttime'];?>'
										<?php echo $enquire_event['parttime'];?>
									>Enquire online
									</a>
								</li>
							<?php endif; ?>
							</ul>
						<?php endif; ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<h4>Admissions enquiries</h4>
						<?php echo $course->enquiries ?>
					</div>
				</div>

				<hr>

				<h3>International student enquiries</h3>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<p><a href="https://www.kent.ac.uk/internationalstudent/countries/enquire.html">Enquire online</a></p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<p>
							T: +44 (0)1227 823254 <br>
							E: <a href="mailto:internationalstudent@kent.ac.uk">internationalstudent@kent.ac.uk</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>