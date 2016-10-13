<ul class="nav nav-tabs-vertical" role="tablist">
    <li class="nav-item"><a href="#overview" data-toggle="tab" role="tab" class="nav-link active"> Overview</a></li>
    <?php if (strpos($course->programme_type, 'taught') !== false || (strpos($course->programme_type, 'research') !== false && !empty($course->programme_overview))): ?>
        <li class="nav-item"><a href="#structure" data-toggle="tab" role="tab" class="nav-link">Course Structure</a></li>
    <?php endif; ?>
    <?php if (!empty($course->key_information_miscellaneous)): ?>
        <li class="nav-item"><a href="#study-support" data-toggle="tab" role="tab" class="nav-link">Study Support</a></li>
    <?php endif; ?>
    <?php if (!empty($course->careers_and_employability) || !empty($course->globals->careersemployability_text) || !empty($course->professional_recognition)): ?>
        <li class="nav-item"><a href="#careers" data-toggle="tab" role="tab" class="nav-link">Careers</a></li>
    <?php endif; ?>
    <li class="nav-item"><a href="#entry-requirements" data-toggle="tab" role="tab" class="nav-link">Entry Requirements</a></li>
    <?php if (!empty($course->research_groups)): ?>
        <li class="nav-item"><a href="#research-areas" data-toggle="tab" role="tab" class="nav-link">Research Areas</a></li>
    <?php endif; ?>
    <li class="nav-item"><a href="#staff-research" data-toggle="tab" role="tab" class="nav-link">Staff Research</a></li>

    <li class='sr-only' ><a href="#fees-tables-link" class="nav-link">Fees</a></li>
    <li class='sr-only'><a href="#enquiries" data-toggle="tab" role="tab" class="nav-link">Enquiries</a></li>
</ul>