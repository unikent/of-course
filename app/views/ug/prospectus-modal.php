<!-- prospectus modal -->
<div class="modal modal-course fade" id="prospectus-modal" tabindex="-1" role="dialog" aria-labelledby="#prospectusButton" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h3 class="modal-title">Order a prospectus</h3>
            </div>
            <div class="modal-body">
				<div class="content-container">
					<div class="content-full">
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
							$prospectus_link = array();
							$prospectus_event = array();
							foreach($course->deliveries as $delivery){
								$mode = str_replace('-','', $delivery->attendance_pattern);
								$link = $sits_url . 'process=siw_ipp_enq&code1=%s&code2=&code4=ipr_ipp5=%s';
								$prospectus_link[$mode] = sprintf($link, $delivery->ari_code, 'PRO');
								$prospectus_event[$mode] = sprintf($eventjs, 'order-prospectus-ug', $course_name_fortracking.'-'.$mode);
							}
							?>


							<h3><?php echo $course->award[0]->name; ?></h3>
							<ul>
								<?php if ($has_fulltime): ?>
									<li>
										<strong>Full-time</strong> - <a
											title="Order prospectus for <?php echo $course->award[0]->name;?> Full time"
											href='<?php echo $prospectus_link['fulltime'];?>'
											<?php echo $prospectus_event['fulltime'];?>
										>Order a prospectus
										</a>
									</li>
								<?php endif; ?>

								<?php if($has_parttime): ?>
									<li>
										<strong>Part-time</strong> - <a
											title="Order prospectus for <?php echo $course->award[0]->name;?> Part time"
											href='<?php echo $prospectus_link['parttime'];?>'
											<?php echo $prospectus_event['parttime'];?>
										>Order a prospectus
										</a>
									</li>
								<?php endif; ?>
							</ul>

						<?php endif; ?>


						<div class="panel panel-outline-primary">
							<h3>Resources</h3>
							<?php
							$file = 'https://www.kent.ac.uk/courses/undergraduate/prospectus/' . $course->year . '/prospectus-full.pdf';
							?>
							<nav class="download-links">
								
									<a class="kf-download" href="https://www.kent.ac.uk/courses/undergraduate/prospectus/<?php echo $course->year; ?>/prospectus-full.pdf"
										<?php echo sprintf($eventjs, 'download-prospectus-ug', $course_name_fortracking); ?>>
										Download a prospectus (PDF)
									</a>
									<?php if (!empty($course->delveries)): ?>
										or order one below.
									<?php endif; ?>
								

								<?php if(!empty($course->subject_leaflet[0])):
									$file = $course->subject_leaflet[0]->tracking_code;
									$pathParts = pathinfo($file);
									$fileType = strtoupper($pathParts['extension']);
									?>
									
										<a class="kf-download" href="<?php echo $course->subject_leaflet[0]->tracking_code ?>"> Download a
											<?php echo $course->subject_leaflet[0]->name ?>
											subject leaflet (<?php echo $fileType ?>)
										</a>
									
									<?php if(!empty($course->subject_leaflet_2[0])):
									$file = $course->subject_leaflet_2[0]->tracking_code;
									$pathParts = pathinfo($file);
									$fileType = strtoupper($pathParts['extension']);
									?>
									
										<a class="kf-download" href="<?php echo $course->subject_leaflet_2[0]->tracking_code ?>"> Download a
											<?php echo $course->subject_leaflet_2[0]->name ?>
											subject leaflet (<?php echo $fileType ?>)
										</a>
									
								<?php endif; ?>

								<?php endif; ?>
							</nav>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>


