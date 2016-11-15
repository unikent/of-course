<ul class="nav nav-tabs-vertical" role="tablist">
    <li class="nav-item"><a href="#overview" data-toggle="tab" role="tab" class="nav-link active"> Overview</a></li>
    <li class="nav-item"><a href="#structure" data-toggle="tab" role="tab" class="nav-link">Course structure</a></li>
    <li class="nav-item"><a href="#teaching" data-toggle="tab" role="tab" class="nav-link">Teaching and assessment</a></li>
    <li class="nav-item"><a href="#careers" data-toggle="tab" role="tab" class="nav-link">Careers</a></li>
    <?php if ((isset($preview) && $preview == true) || (!defined('CLEARING') || (defined('CLEARING') && !CLEARING)) || (defined('CLEARING') && CLEARING && $course->current_year == $course->year)): ?>
        <li class="nav-item"><a href="#entry" data-toggle="tab" role="tab" class="nav-link">Entry requirements</a></li>
    <?php endif; ?>
    <li class="nav-item"><a href="#funding" data-toggle="tab" role="tab" class="nav-link">Fees and funding</a></li>
</ul>