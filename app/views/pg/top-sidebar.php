<ul class="nav nav-tabs-vertical" role="tablist">
    <li class="nav-item"><a href="#overview" data-toggle="tab" role="tab" class="nav-link active"> Overview</a></li>
    <?php if (strpos($course->programme_type, 'taught') !== false || (strpos($course->programme_type, 'research') !== false && !empty($course->programme_overview))): ?>
        <li class="nav-item"><a href="#structure" data-toggle="tab" role="tab" class="nav-link">Course structure</a></li>
    <?php endif; ?>
    <?php if (!empty($course->key_information_miscellaneous)): ?>
        <li class="nav-item"><a href="#study-support" data-toggle="tab" role="tab" class="nav-link">Study support</a></li>
    <?php endif; ?>
	<?php if (!(isset($course->no_fee_output) && $course->no_fee_output === 'true')){ ?>
		<li class="nav-item"><a href="#fees" data-toggle="tab" role="tab" class="nav-link">Fees and funding</a></li>
	<?php } ?>
    <?php if (!empty($course->careers_and_employability) || !empty($course->globals->careersemployability_text) || !empty($course->professional_recognition)): ?>
        <li class="nav-item"><a href="#careers" data-toggle="tab" role="tab" class="nav-link">Careers</a></li>
    <?php endif; ?>
    <li class="nav-item"><a href="#entry-requirements" data-toggle="tab" role="tab" class="nav-link">Entry requirements</a></li>
    <?php if (!empty($course->research_groups)): ?>
        <li class="nav-item"><a href="#research-areas" data-toggle="tab" role="tab" class="nav-link">Research areas</a></li>
    <?php endif; ?>
    <li class="nav-item"><a href="#staff-research" data-toggle="tab" role="tab" class="nav-link">Staff research</a></li>
</ul>