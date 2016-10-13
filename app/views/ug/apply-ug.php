<?php
$schoolName = $course->administrative_school[0]->name;
$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);
$full_type = 'ucas';
if (empty($deliveries)) {
    $has_fulltime = $has_parttime = FALSE;
} else {
    foreach ($deliveries as $delivery) {
        if ($delivery->attendance_pattern == 'part-time') {
            $has_parttime = $has_parttime && true;
        } else {
            $has_fulltime = $has_fulltime && true;
            $full_type = (substr($delivery->mcr, -2) == 'FD') ? 'direct' : 'ucas';
        }
    }
}
?>

        <button id="applyButton" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Apply
        </button>


<!-- Modal -->
<div class="modal modal-course fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="content-page">
                <div class="content-header m-t-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">CLOSE &times;</span>
                    </button>
                    <h1><a
                            href="/courses/undergraduate/<?php echo $course->year != $course->current_year ? $course->year . '/' : '' ?><?php echo $course->instance_id ?>/<?php echo $course->slug ?>"><?php echo $course->programme_title ?> <?php echo $course->award[0]->name; ?> <?php echo $course->programmme_status_text; ?></a>
                    </h1>
                </div>
                <div class="content-container">
                    <div class="content-main">
                        <?php if ($course->how_to_apply_atypical_courses != ''){
                            echo $course->how_to_apply_atypical_courses;
                        } elseif (!$has_parttime && !$has_fulltime) {
                            ?>
                            <p>We will be taking applications for this programme soon, please check back shortly.</p>
                            <?php
                        }else{
                        ?>
                        <div class="apply-form apply-form-ug">

                            <div>
                                <fieldset class="highlight-fieldset indent">
                                    <?php
                                    if (!$has_parttime){
                                        ?>
                                        <input type="hidden" id="type" value="full-time-ug-<?php echo $full_type ?>">
                                        <?php
                                    } elseif (!$has_fulltime) {
                                        ?>
                                        <input type="hidden" id="type" value="part-time">
                                        <?php
                                    }else{
                                        ?>
                                        <div class="form-group type">
                                            <label class="sr-only" for="type">Mode of study</label>
                                            <div class="controls">
                                                <select name="type" id="type" required="required">
                                                    <?php if ($has_fulltime && $has_parttime){ ?>
                                                        <option value="pleaseselect">Please select</option>
                                                    <?php } ?>
                                                    <?php if ($has_fulltime){ ?>
                                                        <option value="full-time-ug-<?php echo $full_type ?>">Full-time</option>
                                                    <?php } ?>
                                                    <?php if ($has_parttime){ ?>
                                                        <option value="part-time" <?php if(isset($_GET['part_time'])){ ?>selected<?php }?>>Part-time</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="full-time-text">
                                        <?php
                                        if (trim($course->mode_of_study) != 'Part-time only'){
                                            echo $course->how_to_apply;
                                            if ($course->location[0]->name == 'Medway'){
                                                echo $course->how_to_apply_medway_fulltime;
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="part-time-text">
                                        <?php
                                        if ($has_parttime){
                                            echo $course->how_to_apply_parttime;
                                        }
                                        ?>
                                    </div>
                                    <input type="hidden" id="award" value="<?php echo strtolower(str_replace(array('/', ' ', '(', ')'), '', $course->award[0]->name)); ?>">
                                    <input type="hidden" id="year" value="<?php echo $course->year; ?>">
                                </fieldset>
                            </div>
                            <noscript>
                                <?php
                                if (trim($course->mode_of_study) != 'Part-time only'){
                                    echo $course->how_to_apply;
                                    if ($course->location[0]->name == 'Medway'){
                                        echo $course->how_to_apply_medway_fulltime;
                                    }
                                }
                                if ($has_parttime){
                                    echo $course->how_to_apply_parttime;
                                }
                                ?>
                            </noscript>
                        </div>
                    </div>
                        <aside class="content-aside">
                            <nav>
                                <?php foreach ($deliveries as $delivery){ ?>

                                    <p class="btn-indent daedalus-tab-action daedaus-js-display">
                                        <a type="button"
                                           id="apply-link-<?php echo strtolower(str_replace(array('/', ' ', '(', ')'), '', $delivery->award_name)) ?>-<?php echo $delivery->attendance_pattern ?>-<?php echo $course->year ?>"
                                           class="btn btn-large btn-primary next-btn apply-link-courses" tabindex="0" role="button"
                                           title="Apply for <?php echo $delivery->description ?>"
                                           href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->current_ipo ?>"
                                           onclick="_pat.event('course-page', 'apply-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>] at <?php echo $schoolName ?>');">Application form
                                            <i class="icon-chevron-right icon-white"></i>
                                        </a>
                                    </p>

                                <?php } ?>


                                    <a href="http://www.ucas.com/apply"
                                       type="button"
                                       id="apply-link-ucas"
                                       class="btn btn-large btn-primary next-btn"
                                       tabindex="0"
                                       role="button"
                                       title="UCAS"
                                       onclick="_pat.event('course-page', 'apply-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>] at <?php echo $schoolName ?>');">Apply through UCAS
                                        <i class="icon-chevron-right icon-white"></i>
                                    </a>
                            </nav>
                        </aside>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
}
?>

