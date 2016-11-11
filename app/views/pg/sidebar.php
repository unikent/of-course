<ul class="sidebar pg">
	<?php if(!empty($course->programme_type)): ?>
	<li><i class="kf-book"></i> Study options
		<ul>
			<li><?php echo ucfirst(trim($course->programme_type)) ?></li>
		</ul>
	</li>
	<?php endif;?>
	<li><i class="kf-calendar"></i> Start date
		<ul>
			<li><?php echo $course->start ?></li>
		</ul>
	</li>
	<li><i class="kf-clock"></i> Duration
		<ul>
			<li><?php echo $course->attendance_text ?></li>
		</ul>
	</li>
	<li><i class="kf-chevron-right"></i> Subject website
		<ul>
			<li><a href="<?php echo $course->url_for_administrative_school?>"><?php echo $course->administrative_school[0]->name ?></a> </li>
			<?php if(!empty($course->url_for_additional_school)): ?>
				<li><a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a></li>
			<?php endif; ?>
		</ul>
	</li>
</ul>

