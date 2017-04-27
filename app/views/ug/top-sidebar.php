<?php $course_name_fortracking = "[{$course->instance_id} in {$course->year}] {$course->programme_title} - {$course->award[0]->name} [{$course->pos_code}]"; ?>
<ul class="nav nav-tabs-vertical" role="tablist">
    <li class="nav-item"><a href="#overview" data-toggle="tab" role="tab" class="nav-link active" onclick="window.KENT.kat.event('course-page', 'overview-ug', '<?php echo $course_name_fortracking ?>')">Overview</a></li>
    <li class="nav-item"><a href="#structure" data-toggle="tab" role="tab" class="nav-link" onclick="window.KENT.kat.event('course-page', 'course-structure-ug', '<?php echo $course_name_fortracking ?>')">Course structure</a></li>
    <li class="nav-item"><a href="#teaching" data-toggle="tab" role="tab" class="nav-link" onclick="window.KENT.kat.event('course-page', 'teaching-assessment-ug', '<?php echo $course_name_fortracking ?>')">Teaching and assessment</a></li>
    <li class="nav-item"><a href="#careers" data-toggle="tab" role="tab" class="nav-link" onclick="window.KENT.kat.event('course-page', 'careers-ug', '<?php echo $course_name_fortracking ?>')">Careers</a></li>
    <?php if ((isset($preview) && $preview == true) || (!defined('CLEARING') || (defined('CLEARING') && !CLEARING)) || (defined('CLEARING') && CLEARING && $course->current_year == $course->year)): ?>
        <li class="nav-item"><a href="#entry" data-toggle="tab" role="tab" class="nav-link" onclick="window.KENT.kat.event('course-page', 'entry-requirements-ug', '<?php echo $course_name_fortracking ?>')">Entry requirements</a></li>
    <?php endif; ?>
    <li class="nav-item"><a href="#funding" data-toggle="tab" role="tab" class="nav-link" onclick="window.KENT.kat.event('course-page', 'fees-funding-ug', '<?php echo $course_name_fortracking ?>')">Fees and funding</a></li>
</ul>
