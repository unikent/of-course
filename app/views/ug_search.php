<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesController::$current_year) == 0) ? '' : $year . '/'); ?>

<?php if($year !== CoursesController::$current_year): ?>
	<meta name="robots" content="noindex, nofollow" />
	<div class='alert alert-daedalus'>
		This course search is for undergraduate programmes starting in September <?php echo $year; ?>. <a href="<?php echo Flight::request()->base; ?>/undergraduate/search">Search for programmes starting in September 2017 here.</a>
	</div>
<?php endif; ?>

<div class="advanced-search">
	<h1>Courses A-Z</h1>
	<a id="showMore">Choose a course that's right for you. Learn more <i class="icon-chevron-right"></i></a>
	<div id="more" class="clearfix" style="display: none;" aria-expanded="false"></div>
	<div class="row-fluid">
		<div class="span12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="<?php echo Flight::request()->base; ?>/undergraduate/search">Undergraduate</a></li>
				<li><a href="<?php echo Flight::request()->base; ?>/postgraduate/search">Postgraduate</a></li>
			</ul>
		</div><!-- /span -->
	</div><!-- /row -->

	<div class="row advanced-search-boxes">

		<div class="advanced-search-filters">

			<div id="advanced-text-search-hint-box" class="visible-phone"><span id="advanced-text-search-hint" class="hide"><a href="#programme-list">Results filtered below...</a></span></div>
			<div class="row">
				<div class="search-filter">
					<span>Filter by: </span><input class="advanced-text-search" type="text" placeholder="keyword" />
				</div>
				<div class="search-select campus-search-div">
					<select class="campus-search input-large <?php if(strcmp($search_type, 'campus')  == 0) echo 'highlighted'; ?>">
						<option value="">All locations</option>
						<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Canterbury'))  == 0) echo 'selected'; ?>>Canterbury</option>
						<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Medway'))  == 0) echo 'selected'; ?>>Medway</option>
					</select>
				</div>
				<div class="search-select attendance-mode-search-div">
					<select class="attendance-mode-search input-large <?php if ( $search_type == 'study_mode' || $search_type == 'attendance_mode' ) echo 'highlighted'; ?>">
						<option value="">All attendance modes</option>
						<option <?php if ( ($search_type == 'study_mode' || $search_type == 'attendance_mode') && urldecode(strtolower($search_string)) == strtolower('Full-time') ) echo 'selected'; ?>>Full-time</option>
						<option <?php if ( ($search_type == 'study_mode' || $search_type == 'attendance_mode') && urldecode(strtolower($search_string)) == strtolower('Part-time') ) echo 'selected'; ?>>Part-time</option>

					</select>
				</div>
				<div class="search-select subject-categories-search-div">
					<select class="subject-categories-search input-large <?php if(strcmp($search_type, 'subject_category')  == 0) echo 'highlighted'; ?>">
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
						<option <?php if(strcmp($search_type, 'subject_category')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower(pantheon_escape($sc->name)))  == 0) echo 'selected'; ?>><?php echo $sc->name?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="search-select course-options-search-div">
				<select class="course-options-search input-large <?php if ( $search_type == 'programme_type' || $search_type == 'course_options' ) echo 'highlighted'; ?>">
					<option value="">All course options</option>
					<option <?php if ( ($search_type == 'programme_type' || $search_type == 'course_options') && urldecode(strtolower(trim($search_string))) == 'year abroad' ) echo 'selected'; ?>>Year abroad</option>
					<option <?php if ( ($search_type == 'programme_type' || $search_type == 'course_options') && urldecode(strtolower(trim($search_string))) == 'year in industry' ) echo 'selected'; ?>>Year in industry</option>
					<option <?php if ( ($search_type == 'programme_type' || $search_type == 'course_options') && urldecode(strtolower(trim($search_string))) == 'foundation year' ) echo 'selected'; ?>>Foundation year</option>
				</select>
			</div>
		</div>
	</div>

</div>



<table id="programme-list" class="table table-striped-search advanced-search-table">
	<thead>
		<tr>
			<th>Name <i class="icon-resize-vertical"></i></th>
			<th style="width:100px">UCAS code <i class="icon-resize-vertical"></i></th>
			<th style="width:80px" class="hidden-phone">Campus <i class="icon-resize-vertical"></i></th>
			<th style="width:150px" class="hidden-phone">Full-time/Part-time <i class="icon-resize-vertical"></i></th>
			<th class="hide">Subject categories</th>
			<th class="hide">Search keywords</th>
			<th class="hide">Course options</th>
			<th class="hide">Sort-key</th>
			<th class="hide">Sort</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach($programmes as $p):?>
			<tr>
				<td>
					<a href='<?php echo Flight::url("{$level}/{$year_for_url}{$p->id}/{$p->slug}"); ?>'><?php echo $p->name;?> <?php echo $p->programmme_status_text; ?></a><br /><span class="advanced-search-award"><?php echo $p->award;?></span>
				</td>
				<td>
					<?php echo $p->ucas_code;?>
				</td>
				<td class="hidden-phone">
					<?php echo $p->campus;?>
				</td>
				<td class="hidden-phone">
					<?php /* mode_of_study aka 'attendance modes' eg full-time */ echo $p->mode_of_study;?>
				</td>
				<td class="hide">
					<?php foreach((array)$p->subject_categories as $key => $sc): ?>
						<?php
						if(!empty($sc)){
							echo $sc;
							// dont echo a seperator if its the last subject category
							if($key !== count($p->subject_categories) - 1) echo ';';
						}
						?>
					<?php endforeach; ?>
				</td>
				<td class="hide">
					<?php echo $p->search_keywords;?>
				</td>
				<td class="hide">
					<?php /* programme_type aka 'course options' eg year abroad */ echo trim($p->programme_type);?>
				</td>
				<td class="hide"><?php echo strtolower($p->name);?> <?php echo strtolower($p->award);?></td>
				<td class="hide"></td>
			</tr>
		<?php endforeach; ?>


	</tbody>
</table>
</div>



<kentScripts>
<script type='text/javascript'>

$(document).ready(function(){

	var programme_list = new CourseFilterTable({
		table: $('#programme-list'),
		globalFilter: $('input.advanced-text-search'),
		columnFilters: {
			"2": $('select.campus-search'),
			"3": $('select.attendance-mode-search'),
			"4" : $('select.subject-categories-search'),
			"6": $('select.course-options-search')
		}
	});

	pantheon.load_section('#more', '/courses/menu/top/index.html');
});

</script>

</kentScripts>
