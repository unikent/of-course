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
					<a href='<?php echo $meta['active_instance']; ?>'> See <?php echo $course->current_year;?> entry</a>
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
	<li><i class="kf-university"></i> Subject website
		<ul>
			<li><a href="<?php echo $course->url_for_administrative_school?>"><?php echo $course->administrative_school[0]->name ?></a> </li>
			<?php if(!empty($course->url_for_additional_school)): ?>
				<li><a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a></li>
			<?php endif; ?>
		</ul>
	</li>

	<?php if(!empty($course->subject_leaflet[0])):
		$file = $course->subject_leaflet[0]->tracking_code;
		$pathParts = pathinfo($file);
		$fileType = strtoupper($pathParts['extension']);
		?>

		<li><i class="kf-download"></i> Subject leaflets
			<ul>

			<li>
				<a href="<?php echo $course->subject_leaflet[0]->tracking_code ?>"
				<?php echo sprintf($eventjs, 'download-subject-leaflet-ug', $course_name_fortracking); ?>>
				<?php echo $course->subject_leaflet[0]->name ?>
				subject leaflet (<?php echo $fileType ?>)
				</a>
			</li>

			<?php if(!empty($course->subject_leaflet_2[0])):
			$file = $course->subject_leaflet_2[0]->tracking_code;
			$pathParts = pathinfo($file);
			$fileType = strtoupper($pathParts['extension']);
			?>
			<li>
				<a href="<?php echo $course->subject_leaflet_2[0]->tracking_code ?>"
					<?php echo sprintf($eventjs, 'download-subject-leaflet-ug', $course_name_fortracking); ?>>
					<?php echo $course->subject_leaflet_2[0]->name ?>
					subject leaflet (<?php echo $fileType ?>)
				</a>
			</li>
			<?php endif; ?>

			</ul>
		</li>

	<?php endif; ?>


	<?php if(!empty($course->accredited_by)):?>
		<li><i class="kf-kent-vision"></i> Accreditation
			<ul>
				<li><?php echo $course->accredited_by ;?></li>
			</ul>
		</li>
	<?php endif; ?>
</ul>
