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
<header>
    <h1>Your application: <a
            href="/courses/undergraduate/<?php echo $course->year != $course->current_year ? $course->year . '/' : '' ?><?php echo $course->instance_id ?>/<?php echo $course->slug ?>"><?php echo $course->programme_title ?> <?php echo $course->award[0]->name; ?> <?php echo $course->programmme_status_text; ?></a>
    </h1>
    <h2 class='location-header' ><?php echo $course->locations_str; ?></h2>
</header>
<?php if ($course->how_to_apply_atypical_courses != ''){
        echo $course->how_to_apply_atypical_courses;
    } elseif (!$has_parttime && !$has_fulltime) {
    ?>

        <p>We will be taking applications for this programme soon, please check back shortly.</p>

    <?php
    }else{
    ?>

    <div class="apply-form apply-form-ug hidden">
        <p>Learn more about <a href="//www.kent.ac.uk/courses/undergraduate/apply/how.html">the application process</a> or begin your application below by registering.</p>
        <p>You don't need to complete your application all in one go - simply begin by registering.
        You can save and come back to your application at any time. You'll need to select your course options below:</p>

        <div>
            <fieldset class="highlight-fieldset indent">
                <legend>Course options</legend>
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
                        <label for="type">Mode of study</label>

                        <div class="controls">
                            <select name="type" id="type" required="required">
                                <?php if ($has_fulltime && $has_parttime){ ?>
                                    <option value="pleaseselect">Please select</option>
                                <?php } ?>
                                <?php if ($has_fulltime){ ?>
                                    <option value="full-time-ug-<?php echo $full_type ?>">Full-time</option>
                                <?php } ?>
                                <?php if ($has_parttime){ ?>
                                    <option value="part-time">Part-time</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php
                }
                ?>



                <div class="full-time-text">
                    <?php
                    if (defined('CLEARING') && CLEARING && $course->current_year > $course->year){
                    ?>
                        <h3>Full-time applicants</h3>
                        <p><a href="<?php echo $course->globals->clearing_vacancies_link; ?>">Is this course in Clearing?</a></p>
                    <?php
                    } elseif (trim($course->mode_of_study) != 'Part-time only'){
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

        <?php foreach ($deliveries as $delivery){ ?>

            <p class="btn-indent daedalus-tab-action daedaus-js-display">
                <a type="button"
                   id="apply-link-<?php echo strtolower(str_replace(array('/', ' ', '(', ')'), '', $delivery->award_name)) ?>-<?php echo $delivery->attendance_pattern ?>-<?php echo $course->year ?>"
                   class="btn btn-large btn-primary next-btn apply-link-courses" tabindex="0" role="button"
                   title="Apply for <?php echo $delivery->description ?>"
                   href="https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&amp;code1=<?php echo $delivery->mcr ?>&amp;code2=<?php echo $delivery->current_ipo ?>"
                   onclick="_pat.event('course-page', 'apply-ug', '[<?php echo $course->instance_id ?> in <?php echo $course->year ?>] <?php echo $delivery->description ?> [<?php echo $delivery->mcr ?>] at <?php echo $schoolName ?>');">Next
                <i class="icon-chevron-right icon-white"></i></a>
            </p>

        <?php } ?>

        <?php if (!defined('CLEARING') || !CLEARING || !($course->current_year > $course->year)){ ?>
        <p class="btn-indent daedalus-tab-action daedaus-js-display">
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
        </p>
        <?php } ?>

        <p class="btn-indent daedalus-tab-action daedaus-js-display">
            <a type="button" id="apply-link-dummy" class="btn btn-large next-btn apply-link-courses disabled"
               tabindex="0" role="button" data-toggle="tooltip" data-placement="right"
               title="Please select your course options above">Next <i class="icon-chevron-right icon-white"></i></a>
        </p>

    </div>

    <noscript>
            <?php
            if (defined('CLEARING') && CLEARING && $course->current_year > $course->year){
                ?>
                <h3>Full-time applicants</h3>
                <p><a href="<?php echo $course->globals->clearing_vacancies_link; ?>">Is this course in Clearing?</a></p>
                <?php
            } elseif (trim($course->mode_of_study) != 'Part-time only'){
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

<?php
}
?>

