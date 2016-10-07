<!-- prospectus modal -->
<div class="modal modal-course fade" id="prospectus-modal" tabindex="-1" role="dialog" aria-labelledby="Prospectus Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h3 class="modal-title">Order a Prospectus</h3>
            </div>
            <div class="modal-body">
                            <?php
                                $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesController::$current_year) == 0) ? '' : $year . '/');
                                $has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
                                $has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);
                                // Tracking name
                                $course_name_fortracking = "[{$course->instance_id} in {$course->year}] {$course->programme_title} - {$course->award[0]->name} [{$course->pos_code}]";
                                $eventjs = "onClick=\"_pat.event('course-page', '%s', '%s');\"";
                            ?>

                            <h2>Enquire or order a prospectus</h2>
                            <?php if (empty($course->subject_to_approval) && (!empty($course->deliveries))) :
                                $sits_url = 'https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?';
                                $enquire_link = array();
                                $prospectus_link = array();
                                $enquire_event = array();
                                $prospectus_event = array();
                                foreach($course->deliveries as $delivery){
                                    $mode = str_replace('-','', $delivery->attendance_pattern);
                                    $link = $sits_url . 'process=siw_ipp_enq&code1=%s&code2=&code4=ipr_ipp5=%s';
                                    $enquire_link[$mode] = sprintf($link, $delivery->ari_code, '10');
                                    $prospectus_link[$mode] = sprintf($link, $delivery->ari_code, 'PRO');
                                    $enquire_event[$mode] = sprintf($eventjs, 'enquire-ug', $course_name_fortracking.'-'.$mode);
                                    $prospectus_event[$mode] = sprintf($eventjs, 'order-prospectus-ug', $course_name_fortracking.'-'.$mode);
                                }
                                ?>

                                <div class='enquire-block'>
                                    <h3><?php echo $course->award[0]->name; ?></h3>
                                    <ul>

                                        <?php if ($has_fulltime): ?>
                                            <li>
                                                <strong>Full-time</strong>
                                                <a
                                                    title="Enquire online - <?php echo $course->award[0]->name;?> Full time"
                                                    href='<?php echo $enquire_link['fulltime'];?>'
                                                    <?php echo $enquire_event['fulltime'];?>
                                                >
                                                    Enquire online
                                                </a> |
                                                <a
                                                    title="Order prospectus for <?php echo $course->award[0]->name;?> Full time"
                                                    href='<?php echo $prospectus_link['fulltime'];?>'
                                                    <?php echo $prospectus_event['fulltime'];?>
                                                >
                                                    Order a prospectus
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if($has_parttime): ?>
                                            <li>
                                                <strong>Part-time</strong>
                                                <a
                                                    title="Enquire online - <?php echo $course->award[0]->name;?> Part time"
                                                    href='<?php echo $enquire_link['parttime'];?>'
                                                    <?php echo $enquire_event['parttime'];?>
                                                >
                                                    Enquire online
                                                </a> |
                                                <a
                                                    title="Order prospectus for <?php echo $course->award[0]->name;?> Full time"
                                                    href='<?php echo $prospectus_link['parttime'];?>'
                                                    <?php echo $prospectus_event['parttime'];?>
                                                >
                                                    Order a prospectus
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                    </ul>
                                </div>

                            <?php endif; ?>

                            <section class="info-section resources">
                                <h3>Resources</h3>
                                <?php
                                $file = 'https://www.kent.ac.uk/courses/undergraduate/prospectus/' . $course->year . '/prospectus-full.pdf';
                                ?>
                                <ul>
                                    <li>
                                        <a href="https://www.kent.ac.uk/courses/undergraduate/prospectus/<?php echo $course->year; ?>/prospectus-full.pdf"
                                            <?php echo sprintf($eventjs, 'download-prospectus-ug', $course_name_fortracking); ?>>
                                            Download a prospectus (PDF)
                                        </a>
                                        <?php if (!empty($course->delveries)): ?>
                                            or order one below.
                                        <?php endif; ?>
                                    </li>
                                </ul>

                                <?php if(!empty($course->subject_leaflet[0])):
                                    $file = $course->subject_leaflet[0]->tracking_code;
                                    $pathParts = pathinfo($file);
                                    $fileType = strtoupper($pathParts['extension']);
                                    ?>
                                    <section class="info-subsection">
                                        <ul>
                                            <li>
                                                <a href="<?php echo $course->subject_leaflet[0]->tracking_code ?>">Download a
                                                    <?php echo $course->subject_leaflet[0]->name ?>
                                                    subject leaflet (<?php echo $fileType ?>)
                                                </a>
                                            </li>
                                            <?php if(!empty($course->subject_leaflet_2[0])):
                                                $file = $course->subject_leaflet_2[0]->tracking_code;
                                                $pathParts = pathinfo($file);
                                                $fileType = strtoupper($pathParts['extension']);
                                                ?>
                                                <li>
                                                    <a href="<?php echo $course->subject_leaflet_2[0]->tracking_code ?>">Download a
                                                        <?php echo $course->subject_leaflet_2[0]->name ?>
                                                        subject leaflet (<?php echo $fileType ?>)
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </section>
                                <?php endif; ?>

                                <?php if (! empty($course->student_profile) || ! empty($course->student_profile_2) ): ?>
                                    <section class="info-subsection">
                                        <h4>Read our student profiles</h4>
                                        <ul>
                                            <li><a href="<?php echo $course->student_profile ?>"><?php echo $course->student_profile_1_link_text ?></a></li>
                                            <?php if(!empty($course->student_profile_2)): ?>
                                                <li><a href="<?php echo $course->student_profile_2 ?>"><?php echo $course->student_profile_2_link_text ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </section>
                                <?php endif; ?>
                            </section>
            </div>
        </div>
    </div>
</div>


