<h2>Study support</h2>

<?php echo !empty($course->key_information_miscellaneous) ? $course->key_information_miscellaneous : '' ?>

<?php
if(!$course->disable_studysupport_additional) {
    if (strpos($course->programme_type, 'research') === false) { ?>
        <?php if (!empty($course->globals->global_skills_award)) {
            ?>
            <h3>Global Skills Award</h3>
            <?php
            echo $course->globals->global_skills_award;
        }
        ?>
    <?php } elseif (strpos($course->programme_type, 'taught') === false) { ?>
        <?php
        if (!empty($course->globals->researcher_development_programme)) {
            ?>
            <h3>Researcher Development Programme</h3>
            <?php
            echo $course->globals->researcher_development_programme;
        }
        ?>
    <?php }
}
?>