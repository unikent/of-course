<?php
$schoolName = $course->administrative_school[0]->name;
$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);
$has_foundation = (strpos(strtolower($course->programme_type), 'foundation year') !== false);

// Make pos available
$course->pos_code = isset($course->deliveries[0]) ? $course->deliveries[0]->pos_code : '';

?>

<article class="container ug">
    <header>
        <h1>
            <?php echo $course->programme_title; ?> - <?php echo $course->award_list_linked; ?>
            <?php echo $course->programmme_status_text; ?>
        </h1>
        <h2 class='location-header' ><?php echo $course->locations_str; ?></h2>
    </header>

<?php if ($course->programme_suspended == 'true' || $course->programme_withdrawn == 'true' || $course->holding_message != ''):
    //suppress content if holding message text filled in
    echo $course->holding_message;
else: ?>

    <div class="daedalus-tabs">
    <div class="row-fluid">
        <div class="span12">
            <ul class="nav nav-tabs">
                <li><a href="#overview">Overview</a></li>
                <li><a href="#structure">Course structure</a></li>
                <li><a href="#teaching">Teaching &amp; Assessment</a></li>
                <li><a href="#careers">Careers</a></li>
                <?php if ((isset($preview) && $preview == true) || (!defined('CLEARING') || (defined('CLEARING') && !CLEARING)) || (defined('CLEARING') && CLEARING && $course->current_year == $course->year)): ?>
                    <li><a href="#entry">Entry requirements</a></li><?php endif; ?>
                <li><a href="#fees">Funding</a></li>
                <li class='screenreader-only'><a href="#enquiries">Enquiries</a></li>
            </ul>
        </div>
        <!-- /span -->
    </div>
    <!-- /row -->

    <div class="row-fluid">
    <div class="span7">
        <div class="tab-content">
            <section
                id="overview"><?php Flight::render('ug_tabs/overview', array('course' => $course)); ?></section>

            <section
                id="structure"><?php Flight::render('ug_tabs/structure', array('course' => $course)); ?></section>

            <section
                id="teaching"><?php Flight::render('ug_tabs/teaching', array('course' => $course)); ?></section>
            <section
                id="careers"><?php Flight::render('ug_tabs/careers', array('course' => $course)); ?></section>
            <?php if ((isset($preview) && $preview == true) || (!defined('CLEARING') || (defined('CLEARING') && !CLEARING)) || (defined('CLEARING') && CLEARING && $course->current_year == $course->year)): ?>
                <section
                    id="entry"><?php Flight::render('ug_tabs/entry', array('course' => $course)); ?></section><?php endif; ?>
            <section id="fees"><?php Flight::render('ug_tabs/fees', array('course' => $course)); ?></section>



            <section id="enquiries"><?php Flight::render('ug_tabs/enquiries', array('course' => $course)); ?></section>
        </div>
    </div>
    <!-- /span -->
    <div class="span5">

        <div class="side-panel">

            <div class="admission-links">


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
                or <a href="#!enquiries" class="pros-adm-link" role="tab" aria-controls="enquiries">order a prospectus</a>
            </div>

            <div class="key-facts-block">
                <aside class="key-facts-container">
                    <h2>Key facts</h2>

                    <div class="key-facts">
                        <ul>
                            <li>
                                <?php if (!empty($course->additional_school[0])): ?>
                                    <strong>Schools:</strong> <a
                                        href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a>,
                                    <a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a>
                                <?php else: ?>
                                    <strong>School:</strong> <a
                                        href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a>
                                <?php endif; ?>
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

                            <?php if (!empty($course->ucas_code)): ?>
                                <li><strong>UCAS code:</strong> <?php echo $course->ucas_code; ?></li>
                            <?php endif; ?>

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
                                <li><strong>Accredited by</strong>: <?php echo $course->accredited_by; ?>
                                </li>
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

                            <?php if (strpos($course->programme_type, "year abroad") !== false): ?>
                                <li><strong>Year abroad:</strong> Yes</li>
                            <?php endif; ?>

                            <?php if (strpos($course->programme_type, "year in industry") !== false): ?>
                                <li><strong>Year in Industry:</strong> Yes</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </aside>
            </div>

            <?php if (isset($course->no_fee_output) && $course->no_fee_output === 'true'): ?>
                <!-- Do nothing -->
            <?php else: ?>
                <div class="key-facts-block">
                    <div class="key-facts-container">
                        <h2><a id="fees-tables-link" class="fees-toggle" role="button" aria-controls="fees-tables"
                               tabindex='0' title='Click to toggle basic fee information'
                               onClick="_pat.event('course-page','expand-fees-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $course->programme_title ?> - <?php echo $course->award[0]->name ?>');">Fees
                                <i class="icon-chevron-down toggler"></i></a></h2>
                        <div id="fees-tables" class="fees-tables" style="display: none" aria-expanded="false"
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
                                        <td><?php echo empty($fees->home->{'full-time'}) ? ((empty($fees->home->{'euro-full-time'})) ? 'TBC' : '&euro;' . number_format($fees->home->{'euro-full-time'})) : '&pound;' . number_format($fees->home->{'full-time'}); ?></td>
                                        <td><?php echo empty($fees->int->{'full-time'}) ? ((empty($fees->int->{'euro-full-time'})) ? 'TBC' : '&euro;' . number_format($fees->int->{'euro-full-time'})) : '&pound;' . number_format($fees->int->{'full-time'}); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if ($has_parttime): ?>
                                    <tr>
                                        <td><strong>Part-time</strong></td>
                                        <td><?php echo empty($fees->home->{'part-time'}) ? ((empty($fees->home->{'euro-part-time'})) ? 'TBC' : '&euro;' . number_format($fees->home->{'euro-part-time'})) : '&pound;' . number_format($fees->home->{'part-time'}); ?></td>
                                        <td>N/A</td>
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

        </div>
    </div>
    <!-- /span -->
    </div>
    <!-- /row -->

    </div>
<?php endif; ?>

<?php if ($course->kiscourseid != ''): ?>
<section class="panel tertiary-tier highlighted no-border kiss-widget-section">
    <h2>Key Information Sets</h2>
    <div class="row-fluid">
        <div class="span8">
            <?php $ukprn = (isset($course->kis_institution_id) && $course->kis_institution_id != '') ? $course->kis_institution_id : $course->globals->ukprn; ?>
            <iframe id="unistats-widget-frame" title="Unistats KIS Widget" src="//widget.unistats.ac.uk/Widget/<?php echo $ukprn ?>/<?php echo str_replace(array('/', '|', ':', '&', '.', '>', '+', '#', ';', '?', '@', '='), '_', $course->kiscourseid); ?>/horizontal/small/en-GB/Full%20Time" scrolling="no" style="overflow: hidden; border: 0px none transparent; width: 615px; height: 150px;"> </iframe>
            <br><br>
            <?php echo $course->kis_explanatory_textarea ?>
        </div>
        <div class="span4">
            
        </div>
    </div>
</section>
    
<?php endif; ?>

<section id="learnmore" class="learnmore-section"></section>

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
        $("#enquiries .info-section a").click(function () {
            var link = $(this)[0];
            if (link.protocol !== 'mailto:') return;
            _pat.event("course-page", "enquire-by-email-ug", link.pathname + " via <?php echo "[{$course->instance_id} in {$course->year}] {$course->programme_title} ( {$course->award[0]->name} )" ?>");
        });
    </script>
</kentScripts>


