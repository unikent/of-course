<?php $course_name_fortracking = "[{$course->instance_id} in {$course->year}] {$course->programme_title}"; ?>
<ul class="nav nav-tabs-vertical" role="tablist">
    <li class="nav-item"><a href="#overview" data-toggle="tab" role="tab" class="nav-link active" onclick="window.KENT.kat.event('course-page', 'overview-pg', '<?php echo $course_name_fortracking ?>')">Overview</a></li>
    <?php if (strpos($course->programme_type, 'taught') !== false || (strpos($course->programme_type, 'research') !== false && !empty($course->programme_overview))): ?>
        <li class="nav-item"><a href="#structure" data-toggle="tab" role="tab" class="nav-link" onclick="window.KENT.kat.event('course-page', 'course-structure-pg', '<?php echo $course_name_fortracking ?>')">Course structure</a></li>
    <?php endif; ?>
    <?php if (!empty($course->key_information_miscellaneous)): ?>
        <li class="nav-item"><a href="#study-support" data-toggle="tab" role="tab" class="nav-link" onclick="window.KENT.kat.event('course-page', 'study-support-pg', '<?php echo $course_name_fortracking ?>')">Study support</a></li>
    <?php endif; ?>
    <?php if (!empty($course->careers_and_employability) || !empty($course->globals->careersemployability_text) || !empty($course->professional_recognition)): ?>
        <li class="nav-item"><a href="#careers" data-toggle="tab" role="tab" class="nav-link" onclick="window.KENT.kat.event('course-page', 'careers-pg', '<?php echo $course_name_fortracking ?>')">Careers</a></li>
    <?php endif; ?>
    <li class="nav-item"><a href="#entry-requirements" data-toggle="tab" role="tab" class="nav-link" onclick="window.KENT.kat.event('course-page', 'entry-requirements-pg', '<?php echo $course_name_fortracking ?>')">Entry requirements</a></li>
    <?php if (!empty($course->research_groups)): ?>
        <li class="nav-item"><a href="#research-areas" data-toggle="tab" role="tab" class="nav-link" onclick="window.KENT.kat.event('course-page', 'research-areas-pg', '<?php echo $course_name_fortracking ?>')">Research areas</a></li>
    <?php endif; ?>
    <li class="nav-item"><a href="#staff-research" data-toggle="tab" role="tab" class="nav-link" onclick="window.KENT.kat.event('course-page', 'staff-research-pg', '<?php echo $course_name_fortracking ?>')">Staff research</a></li>
    <li class="nav-item"><a href="#fees" data-toggle="tab" role="tab" class="nav-link" onclick="window.KENT.kat.event('course-page', 'fees-funding-pg', '<?php echo $course_name_fortracking ?>')">Fees and funding</a></li>
</ul>
