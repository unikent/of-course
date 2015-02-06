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


$has_parttime = $delivery_truth($deliveries, $course, "part-time");
$has_fulltime = $delivery_truth($deliveries, $course, "full-time");
?>

<h1>Your application: <a
        href="/courses/postgraduate/<?php echo $course->year != $course->current_year ? $course->year . '/' : '' ?><?php echo $course->instance_id ?>/<?php echo $course->slug ?>"><?php echo $course->programme_title ?>
        (<?php echo $course->award_list; ?>) <?php echo $course->programmme_status_text; ?></a></h1>


<?php

// How to apply 53 is "How to apply (atypical courses)".
// When this field is populated, show only its contents, not the standard apply text.

if (isset($course->how_to_apply) && trim($course->how_to_apply) != '' && !empty($course->how_to_apply)): ?>

    <?php echo $course->how_to_apply; ?>

<?php elseif (count($deliveries) === 0) : ?>

    <p>We will be taking applications for this programme soon, please check back shortly.</p>

<?php
else: ?>

    <div class="apply-form hidden">

        <?php if (isset($course->how_to_apply_supplementary)) echo $course->how_to_apply_supplementary; ?>

        <p>To begin your application process, you'll need to select your course options below:</p>

        <?php /* one award but lots of deliveries - edge case */
        if (sizeof($course->award) === 1 && sizeof($deliveries) > 2): ?>

            <div>
                <fieldset class="highlight-fieldset indent">
                    <legend>Course options</legend>
                    <div class="form-group">
                        <div class="controls">
                            <?php foreach ($deliveries as $delivery): ?>
                                <input id="delivery<?php echo $delivery->id ?>" type="radio" class="radioLeft"
                                       name="delivery" value="delivery<?php echo $delivery->id ?>">
                                <div class="textBlock">
                                    <?php echo str_ireplace(array('part-time', 'full-time'), array('<strong>part-time</strong>', '<strong>full-time</strong>'), $delivery->description) ?>
                                </div>
                                <div style="clear:both;"/>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </fieldset>
            </div>

            <?php foreach ($deliveries as $delivery): ?>
                <p class="btn-indent daedalus-tab-action daedaus-js-display">
                    <a type="button" id="apply-link-delivery<?php echo $delivery->id ?>"
                       class="btn btn-large btn-primary next-btn apply-link-courses" tabindex="0" role="button"
                       title="Apply for <?php echo $delivery->description ?>"
                       href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->current_ipo ?>"
                       onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>]');">Next
                        <i class="icon-chevron-right icon-white"></i></a>
                </p>
            <?php endforeach; ?>

        <?php else: ?>

            <div>
                <fieldset class="highlight-fieldset indent">
                    <legend>Course options</legend>
                    <?php if (!$has_parttime): ?>
                        <p id="type" data-type="full-time" class="hidden" aria-hidden="true">Full-time</p>
                    <?php elseif (!$has_fulltime): ?>
                        <p id="type" data-type="part-time" class="hidden" aria-hidden="true">Part-time</p>
                    <?php
                    else: ?>
                        <div class="form-group">
                            <label for="type">Mode of study</label>

                            <div class="controls">
                                <select name="type" id="type" required="required">
                                    <?php if ($has_fulltime && $has_parttime): ?>
                                        <option value="pleaseselect">Please select</option>
                                    <?php endif; ?>
						<?php if($has_fulltime): ?>
                                        <option value="full-time">Full-time</option>
                                    <?php endif; ?>
						<?php if($has_parttime): ?>
                                        <option value="part-time">Part-time</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (sizeof($course->award) === 1): ?>
                        <p id="award"
                           data-award="<?php echo strtolower(str_replace(' ', '', $course->award[0]->{name})) ?>"
                           class="hidden" aria-hidden="true"><?php echo $course->award[0]->{name} ?></p>
                    <?php else: ?>
                        <div class="form-group">
                            <label for="award">Award</label>

                            <div class="controls">
                                <select name="award" id="award" required="required">

                                    <option value="pleaseselect">Please select</option>
                                    <?php foreach ($course->award as $award): ?>
                                        <option
                                            value="<?php echo strtolower(str_replace(' ', '', $award->name)) ?>"><?php echo $award->name ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>
                    <?php endif; ?>


                    <p id="year" data-year="<?php echo $course->year; ?>" class="hidden"
                       aria-hidden="true"><?php echo $course->year; ?></p>

                </fieldset>
            </div>



            <?php foreach ($deliveries as $delivery): ?>

                <p class="btn-indent daedalus-tab-action daedaus-js-display">
                    <a type="button"
                       id="apply-link-<?php echo strtolower(str_replace(' ', '', $delivery->award_name)) ?>-<?php echo $delivery->attendance_pattern ?>-<?php echo $course->year ?>"
                       class="btn btn-large btn-primary next-btn apply-link-courses" tabindex="0" role="button"
                       title="Apply for <?php echo $delivery->description ?>"
                       href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->current_ipo ?>"
                       onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>]');">Next
                        <i class="icon-chevron-right icon-white"></i></a>
                </p>

            <?php endforeach; ?>

        <?php endif; ?>

        <p class="btn-indent daedalus-tab-action daedaus-js-display">
            <a type="button" id="apply-link-dummy" class="btn btn-large next-btn apply-link-courses disabled"
               tabindex="0" role="button" data-toggle="tooltip" data-placement="right"
               title="Please select your course options above">Next <i class="icon-chevron-right icon-white"></i></a>
        </p>

    </div>

    <noscript>
        <ul>
            <?php foreach ($deliveries as $delivery): ?>
                <li><p><a title="Apply for <?php echo $delivery->description ?>"
                          href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->current_ipo ?>"
                          onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>]');">Apply
                            for <?php echo $course->year ?> entry to <?php echo $delivery->description ?></a></p></li>

                <li><p><a title="Apply for <?php echo $delivery->description ?>"
                          href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->previous_ipo ?>"
                          onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>]');">Apply
                            for <?php echo $course->year - 1 ?> entry to <?php echo $delivery->description ?></a></p>
                </li>

            <?php endforeach; ?>
        </ul>
    </noscript>

<?php endif; ?>
