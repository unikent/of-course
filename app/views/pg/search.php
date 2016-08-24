<div class="container">


<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesController::$current_year) == 0) ? '' : $year . '/'); ?>

<?php if($year !== CoursesController::$current_year): ?>
	<meta name="robots" content="noindex, nofollow" />
	<div class='alert alert-daedalus'>
		You're not searching for programmes in the current upcoming year. <a href="<?php echo Flight::request()->base; ?>/postgraduate/search">Search for current programmes here.</a>
	</div>
<?php endif; ?>

<div class="advanced-search">

	<h1><?php echo $title; ?></h1>

	<a id="showMore">Choose a course that's right for you. Learn more <i class="icon-chevron-right"></i></a>
	<div id="more" class="clearfix" style="display: none;" aria-expanded="false"></div>
	<div class="row-fluid">
		<div class="span12">
			<ul class="nav nav-tabs">
				<li><a href="<?php echo Flight::request()->base; ?>/undergraduate/search">Undergraduate</a></li>
				<li class="active"><a href="<?php echo Flight::request()->base; ?>/postgraduate/search">Postgraduate</a></li>
			</ul>
		</div><!-- /span -->
	</div><!-- /row -->

	<div class="row advanced-search-boxes">

		<div class="advanced-search-filters pg">
			<div id="advanced-text-search-hint-box" class="visible-phone"><span id="advanced-text-search-hint" class="hide"><a href="#programme-list">Results filtered below...</a></span></div>
			<div class="row">
				<div class="search-filter">
					<span>Filter by: </span><input class="advanced-text-search" type="text" placeholder="keyword" />
				</div>
				<div class="search-select campus-search-div">
					<select class="campus-search input-medium <?php if(strcmp($search_type, 'campus')  == 0) echo 'highlighted'; ?>">
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
					<select class="study-mode-search input-medium <?php if(strcmp($search_type, 'study_mode')  == 0) echo 'highlighted'; ?>">
						<option value="">All study modes</option>
						<option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Full-time'))  == 0) echo 'selected'; ?>>Full-time</option>
						<option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Part-time'))  == 0) echo 'selected'; ?>>Part-time</option>
						<option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Distance learning'))  == 0) echo 'selected'; ?>>Distance learning</option>
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
						<option <?php if(strcmp($search_type, 'subject_category')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower(pantheon_escape($sc->name))) == 0) echo 'selected'; ?>><?php echo $sc->name?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="search-select award-search-div">
				<select class="award-search input-medium <?php if(strcmp($search_type, 'award')  == 0) echo 'highlighted'; ?>">
					<option value="">All awards</option>
					<?php foreach($awards as $award): ?>
						<option <?php if(strcmp($search_type, 'award')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower($award))  == 0) echo 'selected'; ?>><?php echo $award ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="search-select programme-type-search-div">
				<select class="programme-type-search input-medium <?php if(strcmp($search_type, 'programme_type')  == 0) echo 'highlighted'; ?>">
					<option value="">All course types</option>
					<option <?php if(strcmp($search_type, 'programme_type') == 0  && strcmp(urldecode(strtolower($search_string)), 'research') == 0) echo 'selected'; ?>>Research</option>
					<option <?php if(strcmp($search_type, 'programme_type') == 0  && strcmp(urldecode(strtolower($search_string)), 'taught') == 0) echo 'selected'; ?>>Taught</option>
					<option <?php if(strcmp($search_type, 'programme_type') == 0  && strcmp(urldecode(strtolower($search_string)), 'taught-research') == 0) echo 'selected'; ?>>Taught-research</option>
				</select>
			</div>
		</div>
	</div>

</div>



<table id="programme-list" class="table table-striped-search advanced-search-table">
	<thead>
		<tr>
			<th>Name <i class="icon-resize-vertical"></i></th>
			<th style="width:120px">Course type <i class="icon-resize-vertical"></i></th>
			<th style="width:120px" class="hidden-phone">Campus <i class="icon-resize-vertical"></i></th>
			<th style="width:150px" class="hidden-phone">Full-time/Part-time <i class="icon-resize-vertical"></i></th>
			<th class="hide">Subject categories</th>
			<th class="hide">Search keywords</th>
			<th class="hide">Award</th>
			<th class="hide">Sort-key</th>
			<th class="hide">Sort</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach($programmes as $p):?>
			<?php if(!(isset($only_study_abroad) && $only_study_abroad === true) || $p->study_abroad_option != ''):?>
			<tr>
				<td>
					<div class="advanced-search-name-award"><a href='<?php echo Flight::url("{$level}/{$year_for_url}{$p->id}/{$p->slug}"); ?>'><?php echo $p->name;?> <?php echo $p->programmme_status_text; ?></a><br /><span class="advanced-search-award"><?php echo $p->award;?></span></div>
					</td>
					<td>
					<?php echo ucwords($p->programme_type);?>
				</td>
				<td class="hidden-phone">
					<?php if ($p->additional_locations != ''): ?>
						<?php if ( strstr($p->additional_locations, ',') ): ?>
							<?php echo $p->campus.', '.$p->additional_locations ?>
						<?php else: ?>
							<?php echo $p->campus.' and '.$p->additional_locations ?>
						<?php endif ?>
					<?php else: ?>
						<?php echo $p->campus ?>
					<?php endif ?>
				</td>
				<td class="hidden-phone">
					<?php echo $p->mode_of_study;?>
					<span style="display:none">
						<?php
						$distance = strtok($p->attendance_mode, ' ');
						if (strpos($distance, 'Distance') !== false) {
							$distance = "Distance learning";
						}
						echo $distance;
						?>
					</span>
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
					<?php echo $p->award;?>
				</td>
				<td class="hide"><?php echo strtolower($p->name);?> <?php echo strtolower($p->award);?></td>
				<td class="hide"></td>
			</tr>
			<?php endif;?>
		<?php endforeach; ?>


	</tbody>
</table>
</div>


<script type='text/javascript'>
$(document).ready(function(){

	var programme_list = new CourseFilterTable({
		table: $('#programme-list'),
		globalFilter: $('input.advanced-text-search'),
		columnFilters: {
			"2": $('select.campus-search'),
			"3": $('select.study-mode-search'),
			"4" : $('select.subject-categories-search'),
			"6": $('select.award-search'),
			"1": $('select.programme-type-search')
		}
	});

	pantheon.load_section('#more', '/courses/menu/top/index-pg.html');

});
</script>



</div>