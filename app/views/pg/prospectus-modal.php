<!-- prospectus modal -->
<div class="modal modal-course fade" id="prospectus-modal" tabindex="-1" role="dialog" aria-labelledby="#prospectusButton" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-10">
							<h3 class="modal-title">Prospectus</h3>
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

						$prospectus_link = array();
						$prospectus_event = array();
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
							if (!isset($prospectus_link[$key])) {
								$prospectus_link[$key] = array();
								$prospectus_event[$key] = array();
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
							$prospectus_link[$key][$mode] = sprintf($link, $ari_code, 'PRO');

							// Generate event trackers
							$eventjs = "onClick=\"window.KENT.kat.event('course-page', '%s', '%s');\"";
							$event = "$course_name_fortracking - $award" . "$description - $mode [$mcr]";
							$prospectus_event[$key][$mode] = sprintf($eventjs, 'order-prospectus-pg', $event);
						}?>
						<?php if ($show !== null && in_array(true, $show)): ?>



							<?php foreach($enquire_link as $key => $details): ?>
								<?php if ($show[$key]): ?>

									<div class="panel">
									<h3><?php echo $awards[$key]. ' '.$descriptions[$key]; ?></h3>


										<?php if($has_fulltime): ?>
											<p>
												<a
													title="Order prospectus for <?php echo $awards[$key]. ' '.$descriptions[$key];?> (full-time)"
													href='<?php echo $prospectus_link[$key]['full-time'];?>'
													<?php echo $prospectus_event[$key]['full-time'];?>
												>Order a full prospectus (full-time) <i class="kf-external-link"></i>
												</a>
										</p>
										<?php endif; ?>

										<?php if($has_parttime): ?>
											<p>
												<a
													title="Order prospectus for <?php echo $awards[$key]. ' '.$descriptions[$key];?> (part-time)"
													href='<?php echo $prospectus_link[$key]['part-time'];?>'
													<?php echo $prospectus_event[$key]['part-time'];?>
												>Order a full prospectus (part-time) <i class="kf-external-link"></i>
												</a>
											</p>
										<?php endif; ?>

									</div>

								<?php endif; ?>
							<?php endforeach; ?>


						<?php endif; ?>
						<div class="panel">
							<a href="https://www.kent.ac.uk/courses/postgraduate/pdf/prospectus.pdf"
								<?php echo sprintf($eventjs, 'download-prospectus-pg', $course_name_fortracking); ?>>
								Download a full prospectus (PDF) <i class="kf-download"></i>
							</a>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>
