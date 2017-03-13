<div class="container">
	<?php \unikent\kent_theme\kentThemeHelper::breadcrumb(array("Courses"=>"/courses/", "Postgraduate" . ($year!=='current'? ' ' . $year : '')=>"")); ?>

	<h1>Postgraduate courses</h1>

	<ul class="nav nav-tabs  pt-1">
		<li class="nav-item">
			<a class="nav-link" href="<?php echo Flight::url("undergraduate/search"); ?>">Undergraduate</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  active">Postgraduate</a>
		</li>
	</ul>
</div>
<div class="panel-secondary ">
		<div class="container form-inline pt-2 pb-2 filter-box" id="filter_box">
				<div class="search-select campus-search-div">
					<select class="custom-select campus-search form-control <?php if(strcmp($search_type, 'campus')  == 0) echo 'highlighted'; ?>" data-filter-col="locations">
						<option value="">All locations</option>
						<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Canterbury'))  == 0) echo 'selected'; ?>>Canterbury</option>
						<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Medway'))  == 0) echo 'selected'; ?>>Medway</option>
						<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Paris'))  == 0) echo 'selected'; ?>>Paris</option>
						<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Rome'))  == 0) echo 'selected'; ?>>Rome</option>
						<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Brussels'))  == 0) echo 'selected'; ?>>Brussels</option>
						<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Athens'))  == 0) echo 'selected'; ?>>Athens</option>
						<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('HEKSS Dental Deanery'))  == 0) echo 'selected'; ?>>HEKSS Dental Deanery</option>
						<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Mauritius'))  == 0) echo 'selected'; ?>>Mauritius</option>
						<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Moscow'))  == 0) echo 'selected'; ?>>Moscow</option>
						<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Tonbridge'))  == 0) echo 'selected'; ?>>Tonbridge</option>
					</select>
				</div>
				<div class="search-select attendance-mode-search-div">
					<select class="custom-select study-mode-search form-control <?php if(strcmp($search_type, 'study_mode')  == 0) echo 'highlighted'; ?>" data-filter-col="mode_of_study">
						<option value="">All study modes</option>
						<option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Full-time'))  == 0) echo 'selected'; ?>>Full-time</option>
						<option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Part-time'))  == 0) echo 'selected'; ?>>Part-time</option>
						<option value="Distance" data-filter-col="attendance_mode" <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Distance learning'))  == 0) echo 'selected'; ?>>Distance learning</option>
					</select>
				</div>
				<div class="search-select subject-categories-search-div">
					<select class="custom-select subject-categories-search form-control <?php if(strcmp($search_type, 'subject_category')  == 0) echo 'highlighted'; ?>" data-filter-col="__subjects">
						<option value="">All subject categories</option>
						<?php

						$subject_categories = (array) $subject_categories;
						usort($subject_categories, function ($a, $b){
							if ($a->name == $b->name) {
								return 0;
							}
							return ($a->name < $b->name) ? -1 : 1;
						});

						foreach($subject_categories as $sc): ?>
						<option <?php if(strcmp($search_type, 'subject_category')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower(slug_escape($sc->name))) == 0) echo 'selected'; ?>><?php echo $sc->name?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="search-select award-search-div">
				<select class="custom-select award-search form-control <?php if(strcmp($search_type, 'award')  == 0) echo 'highlighted'; ?>" data-filter-col="award">
					<option value="">All awards</option>
					<?php foreach($awards as $award): ?>
						<option <?php if(strcmp($search_type, 'award')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower($award))  == 0) echo 'selected'; ?>><?php echo $award ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="search-select programme-type-search-div">
				<select class="custom-select programme-type-search form-control <?php if(strcmp($search_type, 'programme_type')  == 0) echo 'highlighted'; ?>" data-filter-col="programme_type">
					<option value="">All course types</option>
					<option value="research" <?php if(strcmp($search_type, 'programme_type') == 0  && strcmp(urldecode(strtolower($search_string)), 'research') == 0) echo 'selected'; ?>>Research</option>
					<option value="taught" <?php if(strcmp($search_type, 'programme_type') == 0  && strcmp(urldecode(strtolower($search_string)), 'taught') == 0) echo 'selected'; ?>>Taught</option>
					<option value="taught-research" <?php if(strcmp($search_type, 'programme_type') == 0  && strcmp(urldecode(strtolower($search_string)), 'taught-research') == 0) echo 'selected'; ?>>Taught-research</option>
				</select>
			</div>

			<input type="hidden" name="quickspot_result_count" />
			<input type="hidden" name="qucikspot_return_to_scroll_position" />

	</div>

	<div class="search-filter container form-inline">
		<h2><span id="filter_title">All</span> courses</h2>

		<div id="course-filter-container">
			<input
				id="course-filter"
				class="advanced-text-search form-control"
				type="text"
				placeholder="Search courses"
				data-quickspot-config="pg_courses_inline"
				data-quickspot-target="quickspot-output"
				data-quickspot-filters="filter_box"
				data-quickspot-filter-text-target="filter_title"
			 />
		 </div>
	</div>


</div>



<?php
$programmes = (array)$programmes;
usort($programmes, function($a,$b){ return $a->name > $b->name;});
?>
<div class="card-panel cards-list cards-backed card-panel-secondary course-listing">
	<div class="card-panel-body standard-output" id="quickspot-output">
		<?php foreach($programmes as $p):?>
			<div class="card card-linked chevron-link">

				<a href="<?php echo Flight::url("{$level}/{$year_for_url}{$p->id}/{$p->slug}"); ?>" class="card-title-link ">
					<h3 style="display:inline;"><?php echo $p->name;?> <?php echo $p->programmme_status_text; ?> - <span class="advanced-search-award"><?php echo $p->award;?></span></h3>
				</a>

				<span class="kf-clock tag text-accent"> <?php echo $p->mode_of_study;?></span>
				<span class="kf-pin tag text-accent"> <?php echo $p->campus . ( $p->additional_locations != '' ? ', ' . $p->additional_locations : '' );?></span>

				<a href="<?php echo Flight::url("{$level}/{$year_for_url}{$p->id}/{$p->slug}"); ?>" class="faux-link-overlay" aria-hidden="true"><?php echo $p->name;?></a>
			</div>
		<?php endforeach; ?>
	</div>
</div>
