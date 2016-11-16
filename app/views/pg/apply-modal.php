<?php
// pull out awards and combine into a comma separated list
$course->award_list = '';
foreach ($course->award as $award) if (!empty($award->name)) $course->award_list .= $award->name . ', ';
$course->award_list = substr($course->award_list, 0, -2); // cuts off the final comma+space
/**
 * Returns what the delivery and the course data say about whether there's a
 * full-time or part-time option for that course, and whether or not they agree
 *
 * @param $deliveries - array of deliveries
 * @param $course - course object
 * @param $needle - search string (typically 'full-time' or 'part-time')
 *
 * @returns boolean:
 *   - false if there *definitely is not* a delivery of that type or the two sources disagree on the matter
 *   - true if there *definitely is* a delivery of that type
 */
$delivery_truth = function ($deliveries, $course, $needle) {
	// Does the delivery data say that there's a delivery of type $needle?
	$delivery_says = function ($deliveries, $needle) {

		foreach ($deliveries as $d) {
			if (stristr($d->attendance_pattern, $needle)) {
				return true;
			}
		}
		return false;
	};
	// Does the course object say that there's a delivery of type $needle?
	$course_says = function ($course, $needle) {
		return (stristr($course->mode_of_study, $needle) !== false);
	};
	return ($delivery_says($deliveries, $needle) && $course_says($course, $needle));
};
$schoolName = $course->administrative_school[0]->name;
$has_parttime = $delivery_truth($course->deliveries, $course, "part-time");
$has_fulltime = $delivery_truth($course->deliveries, $course, "full-time");
// By default the apply page allows users to select a course by filtering on "award" and then "fulltime" or "parttime"
// Some courses contain multiple deliveries which both have the same award & attendance pattern, which would make
// it impossible for a user to apply for these via the standard drop downs.
//
// The below logic detects when a delivery can not be uniquely identify by the filters available.
// When this happens $noneUniqueDeliveryFound is set to true, which triggers the apply page to simply
// list out the available deliveries using their description, which a user can then pick from.
$noneUniqueDeliveries = array();
$noneUniqueDeliveryFound = false;
foreach($course->deliveries as $delivery){
	// Generate unqiue key for each delivery
	$key = strtolower(str_replace(' ', '', $delivery->award_name)).'-'.$delivery->attendance_pattern;
	// Check key is not already in use, if it is, we found a none uniquely identifiable course
	if(array_key_exists($key, $noneUniqueDeliveries)){
		$noneUniqueDeliveryFound = true;
		break;
	}
	// Add key to array
	$noneUniqueDeliveries[$key] = true;
}
?>
<!-- Modal -->
<div class="modal modal-course fade" id="apply-modal" tabindex="-1" role="dialog" aria-labelledby="apply" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<div class="container px-2">
					<div class="row">
						<div class="col-md-10">
							<h2 class="modal-title">Apply Now</h2>
							<?php if (!$noneUniqueDeliveryFound){ ?>
									<?php
									if (!$has_parttime){
										?>
										<input type="hidden" id="type" value="full-time">
										<?php
									} elseif (!$has_fulltime) {
										?>
										<input type="hidden" id="type" value="part-time">
										<?php
									}else{
										?>
										<div class="form-group">
											<div class="controls">
												<select class="custom-select" name="type" id="type" required="required">
													<?php
													if ($has_fulltime && $has_parttime){
														?>
														<option value="pleaseselect">Please select</option>
														<?php
													}
													if($has_fulltime){
														?>
														<option value="full-time selected">Full-time<?php $course->year; ?></option>
														<?php
													}
													if($has_parttime){
														?>
														<option value="part-time">Part-time<?php $course->year; ?></option>
														<?php
													}
													?>
												</select>
											</div>
										</div>
										<?php
									}
									?>
									<?php if (sizeof($course->award) === 1){ ?>
										<input type="hidden" id="award" value="<?php echo strtolower(str_replace(' ', '', $course->award[0]->name)) ?>">
									<?php }else{ ?>
										<div class="form-group">
											<div class="controls">
												<select class="custom-select" name="award" id="award" required="required">
													<option value="pleaseselect">Please select</option>
													<?php foreach ($course->award as $award){ ?>
														<option
															value="<?php echo strtolower(str_replace(' ', '', $award->name)) ?>"><?php echo $award->name ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									<?php } ?>
									<input type="hidden" id="year" value="<?php echo $course->year; ?>">
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body container px-2 py-1">
				<div class="row">
					<div class="col-lg-8">
						<?php
						// How to apply 53 is "How to apply (atypical courses)".
						// When this field is populated, show only its contents, not the standard apply text.
						if (isset($course->how_to_apply) && trim($course->how_to_apply) != '' && !empty($course->how_to_apply)){
							echo $course->how_to_apply;
						} elseif (count($course->deliveries) === 0) {
							?>
							<p>We will be taking applications for this programme soon, please check back shortly.</p>
							<?php
						} else { ?>
							<div class="apply-form apply-form-pg hidden">
								<?php
								if (isset($course->how_to_apply_supplementary)){
									echo $course->how_to_apply_supplementary;
								}
								?>
								<p>Learn more about <a href="//www.kent.ac.uk/courses/postgraduate/apply/">the application process</a> or begin your application below by registering.</p>
								<p>You don't need to complete your application all in one go - simply begin by registering. You can save and come back to your application at any time.
									<?php if (count($course->deliveries) > 1 ){ ?>You'll need to select your course options below:<?php } ?>
								</p>
								<?php /* one award but lots of deliveries - edge case  OR $noneUniqueDeliveries are found which means they could no normally be selected */
								if ($noneUniqueDeliveryFound){ ?>
									<div>
										<fieldset class="highlight-fieldset indent">
											<legend>Course options</legend>
											<div class="form-group">
												<?php foreach ($course->deliveries as $delivery){ ?>
													<div class="form-check">
														<input id="delivery<?php echo $delivery->id; ?>" type="radio" class="form-check-input" name="delivery" value="delivery<?php echo $delivery->id; ?>">
														<?php echo str_ireplace(array('part-time', 'full-time'), array('<strong>part-time</strong>', '<strong>full-time</strong>'), $delivery->description); ?>
													</div>
												<?php } ?>
											</div>
										</fieldset>
									</div>
								<?php } ?>

							</div>
							<noscript>
								<ul>
									<?php
									foreach ($course->deliveries as $delivery){ ?>
										<li>
											<p><a title="Apply for <?php echo $delivery->description ?>"
												  href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->current_ipo ?>"
												  onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>] at <?php echo $schoolName ?>');">Apply
													for <?php echo $course->year ?> entry to <?php echo $delivery->description ?></a>
											</p>
										</li>
										<?php if(!empty($delivery->previous_ipo)){ ?>
											<li>
												<p><a title="Apply for <?php echo $delivery->description ?>"
													  href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->previous_ipo ?>"
													  onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>] at <?php echo $schoolName ?>');">Apply
														for <?php echo $course->year - 1 ?> entry to <?php echo $delivery->description ?></a>
												</p>
											</li>
										<?php }
									}
									?>
								</ul>
							</noscript>
						<?php } ?>
					</div>
					<div class="col-lg-4">
							<a type="button" id="apply-link-dummy" class="btn btn-large btn-secondary chevron-link next-btn apply-link-courses disabled"
							   tabindex="0" role="button" data-toggle="tooltip" data-placement="right"
							   title="Please select your course options above">Apply </a>

						<?php foreach ($course->deliveries as $delivery){ ?>
							<a
								id="apply-link-<?php echo strtolower(str_replace(' ', '', $delivery->award_name)) ?>-<?php echo $delivery->attendance_pattern ?>-<?php echo $course->year ?>"
								class="btn btn-large btn-primary chevron-link next-btn apply-link-courses" tabindex="0" role="button"
								title="Apply for <?php echo $delivery->description ?>"
								href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->current_ipo ?>"
								onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>] at <?php echo $schoolName ?>');">Apply
							</a>
						<?php } ?>

						<?php foreach ($course->deliveries as $delivery){ ?>
							<a id="apply-link-delivery<?php echo $delivery->id ?>"
							   class="btn btn-large btn-primary chevron-link next-btn apply-link-courses" tabindex="0"
							   title="Apply for <?php echo $delivery->description ?>"
							   href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->current_ipo ?>"
							   onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>] at <?php echo $schoolName ?>');">Apply
							</a>
						<?php } ?>

						<p>Our application system (Kent Vision) allows you to save and return to your application at any time.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>