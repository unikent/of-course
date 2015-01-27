<?php
// pull out awards and combine into a comma separated list
$course->award_list = '';
foreach ($course->award as $award) if (!empty($award->name)) $course->award_list .= $award->name . ', ';
$course->award_list = substr($course->award_list, 0, -2); // cuts off the final comma+space

$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);
?>

<article class="container pg">
<h1>
    <?php echo $course->programme_title; ?> - <?php echo $course->award_list; ?>
    <?php echo $course->programmme_status_text; ?>
</h1>

<?php if ($course->programme_suspended == 'true' || $course->programme_withdrawn == 'true' || $course->holding_message != ''):
    //suppress content if holding message text filled in
    echo $course->holding_message;
else: ?>

    <div class="daedalus-tabs">
    <div class="row-fluid">
        <div class="span12">
            <ul class="nav nav-tabs">
                <li><a href="#overview">Overview</a></li>
                <?php if ((!empty($course->programme_overview)) || (strpos($course->programme_type, 'taught') !== false)): ?>
                    <li><a href="#structure">Course structure</a></li>
                <?php endif; ?>

                <?php if (!empty($course->key_information_miscellaneous)): ?>
                    <li><a href="#study-support">Study support</a></li>
                <?php endif; ?>

                <?php if (!empty($course->careers_and_employability) || !empty($course->globals->careersemployability_text) || !empty($course->professional_recognition)): ?>
                    <li><a href="#careers">Careers</a></li>
                <?php endif; ?>

                <li><a href="#entry-requirements">Entry requirements</a></li>

                <?php if (!empty($course->research_groups)): ?>
                    <li><a href="#research-areas">Research areas</a></li>
                <?php endif; ?>

                <li><a href="#staff-research">Staff research</a></li>
                <li class='screenreader-only'><a href="#enquiries">Enquiries</a></li>
            </ul>
        </div>
        <!-- /span -->
    </div>
    <!-- /row -->

    <div class="row-fluid">
    <div class="span7">
        <div class="tab-content">
            <section id="overview"><?php Flight::render('pg_tabs/overview', array('course' => $course)); ?></section>

            <?php if (strpos($course->programme_type, 'taught') === false):
                if (!empty($course->programme_overview)): ?>
                    <section
                        id="structure"><?php Flight::render('pg_tabs/structure_research', array('course' => $course)); ?></section>
                <?php endif;
            else:
                $stage_found = false;
                foreach ($course->modules as $module) {
                    if (!empty($module->stages)) {
                        $stage_found = true;
                        break;
                    }
                }
                if ((!$stage_found) && (empty($course->programme_overview))) : ?>
                    <section
                        id="structure"><?php Flight::render('pg_tabs/structure_empty', array('course' => $course)); ?></section>
                <?php else: ?>
                    <section
                        id="structure"><?php Flight::render('pg_tabs/structure', array('course' => $course)); ?></section>
                <?php endif;
            endif;?>
            <section id="careers"><?php Flight::render('pg_tabs/careers', array('course' => $course)); ?></section>
            <section
                id="study-support"><?php Flight::render('pg_tabs/study-support', array('course' => $course)); ?></section>
            <section
                id="entry-requirements"><?php Flight::render('pg_tabs/entry-requirements', array('course' => $course)); ?></section>
            <section
                id="research-areas"><?php Flight::render('pg_tabs/research-areas', array('course' => $course)); ?></section>
            <section
                id="staff-research"><?php Flight::render('pg_tabs/staff-research', array('course' => $course)); ?></section>
            <section id="enquiries"><?php Flight::render('pg_tabs/enquiries', array('course' => $course)); ?></section>
        </div>
    </div>
    <!-- /span -->
    <div class="span5">
        <div class="side-panel">
            <div class="panel admission-links">

                <a href="/courses/postgraduate/<?php echo $course->year != $course->current_year ? $course->year . '/' : '' ?>apply-online/<?php echo $course->instance_id ?>"
                   class="apply-adm-link"
                   role="tab"
                   aria-controls="apply"
                   onclick="_pat.event('course-page', 'apply-pg', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $course->programme_title ?>');">Apply</a>,
                <a href="#!enquiries" class="enquire-adm-link" role="tab" aria-controls="enquiries">enquire</a> or <a
                    href="#!enquiries" class="pros-adm-link" role="tab" aria-controls="enquiries">order a prospectus</a>
            </div>

            <?php if (isset($course->no_fee_output) && $course->no_fee_output === 'true'): ?>
                <!-- Do nothing -->
            <?php else: ?>
                <div class="key-facts-block">
                    <div class="key-facts-container">

                        <h2><a id="fees-tables-link" class="fees-link" role="button" aria-controls="fees-tables"
                               tabindex='0' title='Click to toggle basic fee information'
                               onClick='_pat("course-page","expand-fees-pg", "<?php echo "[{$course->instance_id} in {$course->year}] {$course->programme_title} - {$course->award[0]->name}"; ?>");'>Fees
                                <i class="icon-chevron-down toggler"></i></a></h2>

                        <div id="fees-tables" class="fees-tables" style="display: none" aria-expanded="false"
                             aria-labelledby="fees-tables-link">
                            <?php if (isset($course->globals->fees_override_pgr) && !empty($course->globals->fees_override_pgr) && strpos($course->programme_type, 'research') !== false) {
                                echo $course->globals->fees_override_pgr;
                            } else {
                                ?>
                                <?php if (isset($course->globals->fees_caveat_text_pg) && !empty($course->globals->fees_caveat_text_pg)) echo $course->globals->fees_caveat_text_pg ?>
                                <?php foreach ($course->deliveries as $delivery): ?>
                                    <?php if (!in_array($delivery->pos_code, $pos_codes)): ?>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td colspan="3"><i
                                                        class="icon icon-bullet"></i> <?php echo preg_replace('/- (\w){4}-time/', '', $delivery->description) . ':' ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th>UK/EU</th>
                                                <th>Overseas</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if ($has_fulltime): ?>
                                                <tr>
                                                    <td><strong>Full-time</strong></td>
                                                    <td><?php echo empty($delivery->fees->home->{'full-time'}) ? ((empty($delivery->fees->home->{'euro-full-time'})) ? 'TBC' : '&euro;' . number_format($delivery->fees->home->{'euro-full-time'})) : '&pound;' . number_format($delivery->fees->home->{'full-time'}); ?></td>
                                                    <td><?php echo empty($delivery->fees->int->{'full-time'}) ? ((empty($delivery->fees->int->{'euro-full-time'})) ? 'TBC' : '&euro;' . number_format($delivery->fees->int->{'euro-full-time'})) : '&pound;' . number_format($delivery->fees->int->{'full-time'}); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($has_parttime): ?>
                                                <tr>
                                                    <td><strong>Part-time</strong></td>
                                                    <td><?php echo empty($delivery->fees->home->{'part-time'}) ? ((empty($delivery->fees->home->{'euro-part-time'})) ? 'TBC' : '&euro;' . number_format($delivery->fees->home->{'euro-part-time'})) : '&pound;' . number_format($delivery->fees->home->{'part-time'}); ?></td>
                                                    <td><?php echo empty($delivery->fees->int->{'part-time'}) ? ((empty($delivery->fees->int->{'euro-part-time'})) ? 'TBC' : '&euro;' . number_format($delivery->fees->int->{'euro-part-time'})) : '&pound;' . number_format($delivery->fees->int->{'part-time'}); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <?php $pos_codes[] = $delivery->pos_code; endif; ?>
                                <?php endforeach; ?>

                                <?php
                                if (
                                    isset($course->globals->fees_year_in_industryabroad_text_pg) && // If YII/YA text is set AND
                                    (
                                        (!empty($course->year_in_industry)) || // YII or YA has some text
                                        (!empty($course->year_abroad))
                                    ) // then
                                ) {
                                    echo $course->globals->fees_year_in_industryabroad_text_pg;
                                }

                                if (isset($course->globals->fees_exception_text_pg)) echo $course->globals->fees_exception_text_pg;
                                ?>
                            <?php
                            }
                            ?>
                        </div>


                    </div>

                </div>
            <?php endif; ?>
            <div class="key-facts-block">
                <aside class="key-facts-container">
                    <h2>Key facts</h2>

                    <div class="key-facts">
                        <ul>
                            <li>
                                <?php if (!empty($course->additional_school[0])): ?>
                                    <strong>Schools:</strong> <a
                                        href="<?php echo $course->school_website ?>"><?php echo $course->administrative_school[0]->name ?></a>,
                                    <a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a>
                                <?php else: ?>
                                    <strong>School:</strong> <a
                                        href="<?php echo $course->school_website ?>"><?php echo $course->administrative_school[0]->name ?></a>
                                <?php endif; ?>
                            </li>
                            <?php
                            // If there a second subject area?
                            $second_subject = (isset($course->subject_area_2[0]) && $course->subject_area_2[0] != null);
                            ?>
                            <li><strong>Subject area<?php if ($second_subject) echo 's'; ?>:</strong>
                                <?php
                                echo $course->subject_area_1[0]->name;
                                echo ($second_subject) ? ', ' . $course->subject_area_2[0]->name : '';
                                ?>
                            </li>
                            <li><strong>Award:</strong> <?php echo $course->award_list; ?></li>

                            <li><strong>Course type:</strong>
                                <?php if (strpos($course->programme_type, 'research') === false): ?>
                                    Taught
                                <?php elseif (strpos($course->programme_type, 'taught') === false): ?>
                                    Research
                                <?php
                                else: ?>
                                    Taught-research
                                <?php endif; ?>
                            </li>

                            <li><strong>Location:</strong>

                                <?php
                                $locations = "<a href='{$course->location[0]->url}'>" . $course->location[0]->name . "</a>";
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
                                ?>
                                <?php echo $locations . $additional_locations ?>
                            </li>

                            <li><strong>Mode of study:</strong> <?php echo $course->mode_of_study; ?></li>

                            <?php if (!empty($course->attendance_mode)): ?>
                                <li><strong>Attendance mode:</strong> <?php echo $course->attendance_mode; ?></li>
                            <?php endif; ?>

                            <?php if (!empty($course->attendance_text)): ?>
                                <li><strong>Duration:</strong> <?php echo $course->attendance_text; ?></li>
                            <?php endif; ?>

                            <?php if (!empty($course->start)): ?>
                                <li><strong>Start: </strong> <?php echo $course->start; ?> </li>
                            <?php endif; ?>

                            <?php if (!empty($course->accredited_by)): ?>
                                <li><strong>Accredited by</strong>: <?php echo $course->accredited_by ?></li>
                            <?php endif; ?>

                            <?php if (!empty($course->total_kent_credits_awarded_on_completion)): ?>
                                <li><strong>Total Kent
                                        credits:</strong> <?php echo $course->total_kent_credits_awarded_on_completion; ?>
                                </li>
                            <?php endif; ?>

                            <?php if (!empty($course->total_ects_credits_awarded_on_completion)): ?>
                                <li><strong>Total ECTS
                                        credits:</strong> <?php echo $course->total_ects_credits_awarded_on_completion; ?>
                                </li>
                            <?php endif; ?>

                            <?php if (!empty($course->fees_and_funding)): ?>
                                <li>
                                    <strong><?php echo str_replace(array('<p>', '</p>'), '', $course->fees_and_funding); ?></strong>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </div>

                </aside>
            </div>


        </div>
    </div>
    <!-- /span -->
    </div>
    <!-- /row -->

    </div>

<?php endif; ?>

<?php if (!empty($course->related_courses)): ?>
    <section class="related-course-section">
        <h2>Related to this course</h2>

        <div id="myCarousel" class="carousel slide" data-interval="false">
            <!-- Carousel items -->
            <div class="<?php echo count($course->related_courses) > 4 ? 'carousel-inner' : 'carousel-inner-left'; ?>">
                <?php $count = 0; ?>
                <?php for ($i = 0; $i < (round((count($course->related_courses) / 4) + 0.5, 0, PHP_ROUND_HALF_DOWN)); $i++): ?>
                    <?php $related_courses = array_slice($course->related_courses, $i * 4) ?>
                    <div class="<?php if ($count == 0) echo 'active ' ?>item">

                        <?php foreach ($related_courses as $related_course): ?>
                            <div class="span2 related-course">
                                <div class="cell">
                                    <div class="mask">
                                        <a href="<?php echo Flight::url("{$level}/{$related_course->id}/{$related_course->slug}"); ?>">
                                            <span><?php echo $related_course->name ?> <?php echo !empty($related_course->programmme_status_text) ? $related_course->programmme_status_text : ''; ?></span>
                                            <span class="related-award"><?php echo $related_course->award; ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php $count++;
                            if ($count % 4 == 0) break; ?>
                        <?php endforeach; ?>

                    </div>
                <?php endfor; ?>
            </div>
            <!-- Carousel nav -->
            <?php if (count($course->related_courses) > 4): ?>
                <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
            <?php endif; ?>
        </div>

        <ul class="related-course-list">
            <?php foreach ($course->related_courses as $related_course): ?>
                <li>
                    <a href="<?php echo Flight::url("{$level}/{$related_course->id}/{$related_course->slug}"); ?>">
                        <span><?php echo $related_course->name ?> <?php echo !empty($related_course->programmme_status_text) ? $related_course->programmme_status_text : ''; ?></span>
                        <span class="related-award"><?php echo $related_course->award; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>


    </section>
<?php endif; ?>


<?php if (!empty($course->globals->general_disclaimer)): ?>
    <footer class="general_disclaimer" style='font-size:0.8em;'>
        <?php echo $course->globals->general_disclaimer; ?>
    </footer>
<?php endif; ?>

</article>
<kentScripts>
    <script>
        $("#enquiries .contacts-enquiries a").click(function () {
            var link = $(this)[0];
            if (link.protocol !== 'mailto:') return;
            _pat.event("course-page", "enquire-by-email-pg", link.pathname + " via <?php echo "[{$course->instance_id} in {$course->year}] {$course->programme_title} ( {$course->award[0]->name} )" ?>");
        });
    </script>
</kentScripts>
