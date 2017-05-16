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

							<div class="panel">
								<?php if ($has_fulltime): ?>
								<p><a class=""
									title="Order a prospectus for <?php echo $course->award[0]->name;?> Full time"
									href='<?php echo $prospectus_link['fulltime'];?>'
									<?php echo $prospectus_event['fulltime'];?>
								> Order a printed prospectus (full-time) <i class="kf-external-link"></i>
								</a></p>
								<?php endif; ?>

								<?php if($has_parttime): ?>
									<p><a class=""
										title="Order a prospectus for <?php echo $course->award[0]->name;?> Part time"
										href='<?php echo $prospectus_link['parttime'];?>'
										<?php echo $prospectus_event['parttime'];?>
									> Order a printed prospectus (part-time) <i class="kf-external-link"></i>
								</a></p>
								<?php endif; ?>
							</div>

						<?php endif; ?>


						<div class="panel">
							<p><a class="" href="https://www.kent.ac.uk/courses/undergraduate/prospectus/<?php echo $course->year; ?>/prospectus-full.pdf"
								<?php echo sprintf($eventjs, 'download-prospectus-ug', $course_name_fortracking); ?>>
								Download a prospectus (PDF) <i class="kf-download"></i>
							</a></p>
						</div>


					</div>
				</div>
            </div>
        </div>
    </div>
</div>
