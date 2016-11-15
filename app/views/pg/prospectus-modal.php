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
					$eventjs = "onClick=\"_pat.event('course-page', '%s', '%s');\"";
					$event = "$course_name_fortracking - $award" . "$description - $mode [$mcr]";
					$prospectus_event[$key][$mode] = sprintf($eventjs, 'order-prospectus-pg', $event);
				}
				if ($show !== null && in_array(true, $show)):
					foreach($enquire_link as $key => $details):
						if ($show[$key]): ?>

							<h3><?php echo $awards[$key]. ' '.$descriptions[$key]; ?></h3>

							<ul>
								<?php if($has_fulltime): ?>
									<li>
										<strong>Full-time</strong> - <a
											title="Order prospectus for <?php echo $awards[$key]. ' '.$descriptions[$key];?> Full time"
											href='<?php echo $prospectus_link[$key]['full-time'];?>'
											<?php echo $prospectus_event[$key]['full-time'];?>
										>Order a prospectus
										</a>
									</li>
								<?php endif; ?>

								<?php if($has_parttime): ?>
									<li>
										<strong>Part-time</strong> - <a
											title="Order prospectus for <?php echo $awards[$key]. ' '.$descriptions[$key];?> Part time"
											href='<?php echo $prospectus_link[$key]['part-time'];?>'
											<?php echo $prospectus_event[$key]['part-time'];?>
										>Order a prospectus
										</a>
									</li>
								<?php endif; ?>
							</ul>
						<?php endif;
					endforeach;
				endif; ?>
				<?php
				$file = 'https://www.kent.ac.uk/courses/postgraduate/pdf/prospectus.pdf';
				?>
				<h3>Resources</h3>
				<ul>
					<li>
						<a href="https://www.kent.ac.uk/courses/postgraduate/pdf/prospectus.pdf"
							<?php echo sprintf($eventjs, 'download-prospectus-pg', $course_name_fortracking); ?>
						>
							Download a full prospectus (PDF)
						</a>
					</li>
					<?php if(!empty($course->programme_leaflet)): ?>
				<?php foreach ($course->programme_leaflet as $leaflet):
					$file = $leaflet->tracking_code;
					$pathParts = pathinfo($file);
					$fileType = strtoupper($pathParts['extension']);
					?>
					<li>
						<a href="<?php echo $leaflet->tracking_code ?>">Download a <?php echo $leaflet->name ?> subject leaflet (<?php echo $fileType ?>)</a>
					</li>
					<?php endforeach; ?>
				<?php endif; ?>
				</ul>
			</div>
			</div>
			</div>
		</div>
	</div>
</div>
