<style>
	.filter-box {
		margin-top:2rem;
	}
	.filter-box .row{
		padding: 1rem;
		margin:0 0.2rem;
	}
	.filter-box .row div{
		display:inline;
	}
	.filter-box .row div select{
		width: 16%;
	}
	.course-listing {
		padding-top:1rem;
	}
	.card-panel.cards-list .card-panel-body .card {
		margin-top: 0;
	}
	.card-panel.cards-list .card-panel-body .selected .card {
	    background: #eae9e9;
	}
	.tag {
		font-size:0.7rem;
		display:inline;
		background: #E8EBF2;
		padding: .2rem .4rem;
		margin: 0 .2rem;
	}
	.quickspot-output.quickspot-results-container {
		width:100%;
	}
</style>

<div class="container filter-box">
		<div class="row form-inline panel-primary-tint">
			<div class="search-filter">
				<span>Filter by: </span> <input id="course-filter" class="advanced-text-search form-control" type="text" placeholder="keyword" />
			</div>
			<div class="search-select" >
				<select class="campus-search form-control <?php if(strcmp($search_type, 'campus')  == 0) echo 'highlighted'; ?>" data-filter-col="campus">
					<option value="">All locations</option>
					<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Canterbury'))  == 0) echo 'selected'; ?>>Canterbury</option>
					<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Medway'))  == 0) echo 'selected'; ?>>Medway</option>
				</select>
			</div>
			<div class="search-select"  >
				<select class="attendance-mode-search form-control <?php if ( $search_type == 'study_mode' || $search_type == 'attendance_mode' ) echo 'highlighted'; ?>" data-filter-col="mode_of_study">
					<option value="">All attendance modes</option>
					<option <?php if ( ($search_type == 'study_mode' || $search_type == 'attendance_mode') && urldecode(strtolower($search_string)) == strtolower('Full-time') ) echo 'selected'; ?>>Full-time</option>
					<option value="art-time" <?php if ( ($search_type == 'study_mode' || $search_type == 'attendance_mode') && urldecode(strtolower($search_string)) == strtolower('Part-time') ) echo 'selected'; ?>>Part-time</option>

				</select>
			</div>
			<div class="search-select subject-categories-search-div">
				<select class="subject-categories-search form-control <?php if(strcmp($search_type, 'subject_category')  == 0) echo 'highlighted'; ?>" data-filter-col="__subjects">
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
			<select class="course-options-search form-control <?php if ( $search_type == 'programme_type' || $search_type == 'course_options' ) echo 'highlighted'; ?>" data-filter-col="programme_type">
				<option value="">All course options</option>
				<option value="year abroad" <?php if ( ($search_type == 'programme_type' || $search_type == 'course_options') && urldecode(strtolower(trim($search_string))) == 'year abroad' ) echo 'selected'; ?>>Year abroad</option>
				<option value="year in industry" <?php if ( ($search_type == 'programme_type' || $search_type == 'course_options') && urldecode(strtolower(trim($search_string))) == 'year in industry' ) echo 'selected'; ?>>Year in industry</option>
				<option value="foundation year" <?php if ( ($search_type == 'programme_type' || $search_type == 'course_options') && (urldecode(strtolower(trim($search_string))) == 'foundation year' || urldecode(strtolower(trim($search_string))) == 'IFP') ) echo 'selected'; ?>>Foundation year</option>
			</select>
		</div>
	</div>
</div>
<?php 
$programmes = (array)$programmes;
usort($programmes, function($a,$b){ return $a->name > $b->name;});
?>
<div class="card-panel cards-list cards-backed cards-backed-secondary course-listing">
	<div class="card-panel-body quickspot-output">
	</div>
	<div class="card-panel-body standard-output">
		<?php foreach($programmes as $p):?>
			<div class="card card-linked">
				<?php foreach($p->subject_categories as $s):?>
					<div class="tag tag-primary" style="float:right"><?php echo $s;?></div>
				<?php endforeach; ?>
				<a href="<?php echo Flight::url("{$level}/{$year_for_url}{$p->id}/{$p->slug}"); ?>" class="card-title-link chevron-link">
					<h3 style="display:inline;"><?php echo $p->name;?> <?php echo $p->programmme_status_text; ?> - <span class="advanced-search-award"><?php echo $p->award;?></span></h3>
				</a>

				<p class="card-meta"><?php echo $p->mode_of_study;?> / <?php echo $p->campus;?></p>
				<a href="<?php echo Flight::url("{$level}/{$year_for_url}{$p->id}/{$p->slug}"); ?>" class="faux-link-overlay" aria-hidden="true">May 2016 – July 2016</a>
			</div>
		<?php endforeach; ?>
	</div>					 
</div>

<script>
window.addEventListener("load", function(){

	// Create config for QS instance, extend courses_inline
	var qs = window.KENT.modules.quickspot.attach(
		$.extend({}, window.KENT.quickspot.config.ug_courses_inline, {
			target: "course-filter",
			results_container: document.querySelector(".quickspot-output"),
			// Add searchable subjects
			"data_pre_parse": function(courses){
				for(var c in courses){
					courses[c].__subjects = '';
					for(var s in courses[c].subject_categories){
						courses[c].__subjects += ' ' + courses[c].subject_categories[s];
					}
				}
				return courses;
			},
			"ready": function(qs){
				apply_filters();
				qs.showAll();
				$(".standard-output").hide();
			}
		})
	);

	// Apply search filters
	function apply_filters(){
		// remove previous filters
		qs.clearFilters();
		$(".filter-box select").each(function(select){
			if($(this).val() !== ''){
				var col = $(this).data("filter-col");
				qs.filter($(this).val(), col);
			}
		});
		qs.refresh();
	};

	// apply filter on change.
	$(".filter-box select").change(apply_filters);

}, false);
</script>