<ul class="sidebar ug">
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
			<?php if(isset($course) && $course->current_year > $course->year): ?>
				<li>
					<a href='<?php echo $meta['active_instance']; ?>'> Starting in <?php echo $course->current_year;?>?</a>
				</li>
			<?php endif ?>
		</ul>
	</li>
	<li><i class="kf-clock"></i> Duration
		<ul>
			<?php foreach(explode(',', $course->duration) as $duration): ?>
				<li><?php echo trim($duration) ?></li>
			<?php endforeach; ?>
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