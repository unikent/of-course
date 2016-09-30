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

.tag {
	font-size:0.7rem;
	display:inline;
	background: #E8EBF2;
	padding: .2rem .4rem;
	margin: 0 .2rem;
}


</style>

<div class="container filter-box">
		<div class="row form-inline panel-primary-tint">
			<div class="search-filter">
				<span>Filter by: </span> <input id="course-filter" class="advanced-text-search form-control" type="text" placeholder="keyword" />
			</div>
			<div class="search-select campus-search-div">
				<select class="campus-search form-control <?php if(strcmp($search_type, 'campus')  == 0) echo 'highlighted'; ?>">
					<option value="">All locations</option>
					<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Canterbury'))  == 0) echo 'selected'; ?>>Canterbury</option>
					<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Medway'))  == 0) echo 'selected'; ?>>Medway</option>
				</select>
			</div>
			<div class="search-select attendance-mode-search-div">
				<select class="attendance-mode-search form-control <?php if ( $search_type == 'study_mode' || $search_type == 'attendance_mode' ) echo 'highlighted'; ?>">
					<option value="">All attendance modes</option>
					<option <?php if ( ($search_type == 'study_mode' || $search_type == 'attendance_mode') && urldecode(strtolower($search_string)) == strtolower('Full-time') ) echo 'selected'; ?>>Full-time</option>
					<option <?php if ( ($search_type == 'study_mode' || $search_type == 'attendance_mode') && urldecode(strtolower($search_string)) == strtolower('Part-time') ) echo 'selected'; ?>>Part-time</option>

				</select>
			</div>
			<div class="search-select subject-categories-search-div">
				<select class="subject-categories-search form-control <?php if(strcmp($search_type, 'subject_category')  == 0) echo 'highlighted'; ?>">
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
			<select class="course-options-search form-control <?php if ( $search_type == 'programme_type' || $search_type == 'course_options' ) echo 'highlighted'; ?>">
				<option value="">All course options</option>
				<option <?php if ( ($search_type == 'programme_type' || $search_type == 'course_options') && urldecode(strtolower(trim($search_string))) == 'year abroad' ) echo 'selected'; ?>>Year abroad</option>
				<option <?php if ( ($search_type == 'programme_type' || $search_type == 'course_options') && urldecode(strtolower(trim($search_string))) == 'year in industry' ) echo 'selected'; ?>>Year in industry</option>
				<option <?php if ( ($search_type == 'programme_type' || $search_type == 'course_options') && (urldecode(strtolower(trim($search_string))) == 'foundation year' || urldecode(strtolower(trim($search_string))) == 'IFP') ) echo 'selected'; ?>>Foundation year</option>
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
<script  id="course-template" type="text/x-handlebars-template">
 {{name}}
</script>
<script>


var qs;
window.addEventListener("load", function(){
	//var template = Handlebars.compile($("course-template").html());

	qs = window.KENT.modules.quickspot.attach({
			target: "course-filter",
			url: 'https://api.kent.ac.uk/api/programmes/current/undergraduate/programmes',
 			hide_on_blur: false,
			'disable_occurrence_weighting': true,
			'prevent_headers': true,
			results_container: document.querySelector(".quickspot-output"),
			'max_results': 150,
			'search_on': ['name', 'award', 'subject', 'main_school', 'ucas_code', 'search_keywords'],
			'no_results': function (qs, val) {
				return '<a class=\'quickspot-result selected\'>No matching results</a>';
			},
			'no_results_click': function (value, qs) {
				window.location.href = 'https://www.kent.ac.uk/search/?q=' + value;
			},
			'display_handler': function(itm, qs){
				return "<div>"+itm.name+"</div>";
	
			},
			"ready": function(){
				console.log("ready");
			},
			"click_handler": function(){
				console.log("click");
			}
	});

	qs.on("quickspot:hideresults", function(){ $(".standard-output").show(); })
	qs.on("quickspot:showresults", function(){ $(".standard-output").hide();})
	console.log("!");
	console.log(qs);
}, false);
</script>