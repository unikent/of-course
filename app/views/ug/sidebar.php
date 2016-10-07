

<ul class="nav nav-tabs-vertical" role="tablist">
	<li class="nav-item"><a href="#overview" data-toggle="tab" role="tab" class="nav-link active"> Overview</a></li>
	<li class="nav-item"><a href="#structure" data-toggle="tab" role="tab" class="nav-link">Course structure</a></li>
	<li class="nav-item"><a href="#teaching" data-toggle="tab" role="tab" class="nav-link">Teaching &amp; Assessment</a></li>
	<li class="nav-item"><a href="#careers" data-toggle="tab" role="tab" class="nav-link">Careers</a></li>
	<?php if ((isset($preview) && $preview == true) || (!defined('CLEARING') || (defined('CLEARING') && !CLEARING)) || (defined('CLEARING') && CLEARING && $course->current_year == $course->year)): ?>
		<li class="nav-item"><a href="#entry" data-toggle="tab" role="tab" class="nav-link">Entry requirements</a></li>
	<?php endif; ?>
	<li class="nav-item"><a href="#funding" data-toggle="tab" role="tab" class="nav-link">Funding</a></li>

	<li class='sr-only' ><a href="#fees-tables-link" class="nav-link">Fees</a></li>


	<li class='sr-only'><a href="#enquiries" data-toggle="tab" role="tab" class="nav-link">Enquiries</a></li>
</ul>
<br/>
<ul class="sidebar">
	<?php if(!empty($course->programme_type)): ?>
	<li><i class="kf-book"></i> Study options
		<ul>
			<li><?php echo ucfirst(trim($course->programme_type)) ?></li>
		</ul>
	</li>
	<?php endif;?>
	<li><i class="kf-calendar"></i> Start Date
		<ul>
			<li><?php echo $course->start ?></li>
		</ul>
	</li>
	<li><i class="kf-clock"></i> Duration
		<ul>
			<?php foreach(explode(',', $course->duration) as $duration): ?>
				<li><?php echo trim($duration) ?></li>
			<?php endforeach; ?>
		</ul>
	</li>
	<li><i class="kf-chevron-right"></i> Subject Website
		<ul>
			<li><a href="<?php echo $course->url_for_administrative_school?>"><?php echo $course->administrative_school[0]->name ?></a> </li>
			<?php if(!empty($course->url_for_additional_school)): ?>
				<li><a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a></li>
			<?php endif; ?>
		</ul>
	</li>
</ul>

