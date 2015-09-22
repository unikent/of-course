<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/'); ?>

<?php if($year !== CoursesFrontEnd::$current_year): ?>
  <meta name="robots" content="noindex, nofollow" />
  <div class='alert alert-daedalus'>
	This course search is for undergraduate programmes starting in September <?php echo $year; ?>. <a href="<?php echo BASE_URL != '/' ? BASE_URL : ''; ?>/undergraduate/search">Search for programmes starting in September 2016 here.</a>
  </div>
<?php endif; ?>

<div class="advanced-search">
	<h1>Courses A-Z</h1>

	  <div class="row-fluid">
		<div class="span12">
		  <ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo BASE_URL != '/' ? BASE_URL : ''; ?>/undergraduate/search">Undergraduate</a></li>
			<li><a href="<?php echo BASE_URL != '/' ? BASE_URL : ''; ?>/postgraduate/search">Postgraduate</a></li>
		  </ul>
		</div><!-- /span -->
	  </div><!-- /row -->

	<div class="row advanced-search-boxes">

		<h2>Filter course list</h2>

		<input class="advanced-text-search" type="text" placeholder="Filter by keyword" />

		<div id="advanced-text-search-hint-box" class="visible-phone"><span id="advanced-text-search-hint" class="hide"><a href="#programme-list">Results filtered below...</a></span></div>

		<div class="advanced-search-filters">

		  <select class="campus-search input-large <?php if(strcmp($search_type, 'campus')  == 0) echo 'highlighted'; ?>">
			<option value="">All locations</option>
			<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Canterbury'))  == 0) echo 'selected'; ?>>Canterbury</option>
			<option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Medway'))  == 0) echo 'selected'; ?>>Medway</option>
		  </select>

		  <select class="attendance-mode-search input-large <?php if ( $search_type == 'study_mode' || $search_type == 'attendance_mode' ) echo 'highlighted'; ?>">
			<option value="">All attendance modes</option>
			<option <?php if ( ($search_type == 'study_mode' || $search_type == 'attendance_mode') && urldecode(strtolower($search_string)) == strtolower('Full-time') ) echo 'selected'; ?>>Full-time</option>
			<option <?php if ( ($search_type == 'study_mode' || $search_type == 'attendance_mode') && urldecode(strtolower($search_string)) == strtolower('Part-time') ) echo 'selected'; ?>>Part-time</option>

		  </select>

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
			<option <?php if(strcmp($search_type, 'subject_category')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower($sc->name))  == 0) echo 'selected'; ?>><?php echo $sc->name?></option>
			<?php endforeach; ?>
		  </select>

		  <select class="course-options-search input-large <?php if ( $search_type == 'programme_type' || $search_type == 'course_options' ) echo 'highlighted'; ?>">
			<option value="">All course options</option>
			<option <?php if ( ($search_type == 'programme_type' || $search_type == 'course_options') && urldecode(strtolower(trim($search_string))) == 'year abroad' ) echo 'selected'; ?>>Year abroad</option>
			<option <?php if ( ($search_type == 'programme_type' || $search_type == 'course_options') && urldecode(strtolower(trim($search_string))) == 'year in industry' ) echo 'selected'; ?>>Year in industry</option>
			<option <?php if ( ($search_type == 'programme_type' || $search_type == 'course_options') && urldecode(strtolower(trim($search_string))) == 'foundation year' ) echo 'selected'; ?>>Foundation year</option>
		  </select>

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
		  </tr>
		<?php endforeach; ?>


		</tbody>
	</table>
</div>



<kentScripts>
<script type='text/javascript'>

$(document).ready(function(){

  //put our custom search items into variables
  var advanced_text_search = $('input.advanced-text-search');
  var campus_search = $('select.campus-search');
  var attendance_mode_search = $('select.attendance-mode-search');
  var subject_categories_search = $('select.subject-categories-search');
  var course_options_search = $('select.course-options-search');


  /* Custom filtering function which will filter data using our advanced search fields */
  $.fn.dataTableExt.afnFiltering.push(
  function( oSettings, aData, iDataIndex ) {

  // get each column out
  var name = $(aData[0]).html();
  var ucas_code = aData[1];
  var campus = aData[2];
  var attendance_mode = aData[3];
  var subject_categories = aData[4];
  var search_keywords = aData[5];
  var course_options = aData[6];

  if(advanced_text_search && campus_search && attendance_mode_search && subject_categories_search && course_options_search){

	// search both the Name, UCAS code and Search keywords fields if our search box is filled
	var advanced_text_search_result = (advanced_text_search.val() == '') ? true :
		(
		  (name.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) ||
		  (search_keywords.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) ||
		  (attendance_mode.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) ||
		  (campus.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) ||
		  (subject_categories.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) ||
		  (ucas_code.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) ||
		  (course_options.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1)
		  ? true : false
		);

	// search the campus field if a campus is selected
	var campus_search_result = (campus_search.val() == '') ? true : (( campus.toLowerCase().indexOf( campus_search.val().toLowerCase() ) !== -1 ) ? true : false );

	// search the study mode field if a study mode is selected
	var attendance_mode_search_result = (attendance_mode_search.val() == '') ? true : (( attendance_mode.toLowerCase().indexOf( attendance_mode_search.val().toLowerCase() ) !== -1 ) ? true : false );

	// search the programme type field if a programme type is selected
	var course_options_search_result = (course_options_search.val() == '') ? true : (( course_options.toLowerCase().indexOf( course_options_search.val().toLowerCase() ) !== -1 ) ? true : false );

	// lets split subject categories up so we can search then individually
	var subject_categories_vals = subject_categories.split(';');

	// check to see if we find our searched subject category in the array
	var subject_categories_search_result = false;
	if (subject_categories_search.val() == ''){
	  subject_categories_search_result = true;
	}
	else{
	  for (var i = 0; i < subject_categories_vals.length; i++) {
		subject_categories_vals[i] = $.trim(subject_categories_vals[i]);
		if(subject_categories_search.val().toLowerCase() == subject_categories_vals[i].toLowerCase()){
		  subject_categories_search_result = true;
		  break;
		}
	  }
	}


	// return our results
	return advanced_text_search_result && campus_search_result && attendance_mode_search_result && subject_categories_search_result && course_options_search_result;
  }

  return true;
  }
  );

  /**
  *
  * data tables for programme index page
  *
  */
  $(document).ready(function(){
  var programme_list = $('#programme-list').dataTable({
		"sDom": "t<'muted pull-right'i><'clearfix'>p", // no need for this since we're implementing our own search: "<'navbar'<'navbar-inner'<'navbar-search pull-left'f>>r>t<'muted pull-right'i><'clearfix'>p",
		"sPaginationType": "bootstrap",
		"iDisplayLength": 50,
		"oLanguage": {
			"sSearch": ""
		},
		"aoColumns": [
		  { "bSortable": true },
		  { "bSortable": true },
		  { "bSortable": true },
		  { "bSortable": true },
		  { "bSortable": false },
		  { "bSortable": false },
		  { "bSortable": false }
		  ]
	});

	//now add appropriate event listeners to our custom search items
	if(advanced_text_search && campus_search && attendance_mode_search && subject_categories_search){

	  advanced_text_search.keyup(function() {
		programme_list.fnDraw();
		/* show/hide the search hint when the input box is empty */
		$("#advanced-text-search-hint").show();
		if( $(this).val().length == 0 ) {
		  $("#advanced-text-search-hint").hide();
		}
	  });

	  campus_search.change(function(){
		programme_list.fnDraw();
		highlight($(this));
	  });

	  attendance_mode_search.change(function(){
		programme_list.fnDraw();
		highlight($(this));
	  });

	  course_options_search.change(function(){
		programme_list.fnDraw();
		highlight($(this));
	  });

	  subject_categories_search.change(function(){
		programme_list.fnDraw();
		highlight($(this));
	  });

	  function highlight(obj) {
		if ( obj.children().first().text() != $("option:selected", obj).text() ) {
		   obj.addClass("highlighted");
		}
		else {
		  obj.removeClass("highlighted");
		}
		return true;
	  }

	}
	/* fades the scroll to top button in and out as you scroll away from/near to the top of the page */
	$(window).bind('scroll', function(){
	  if($(this).scrollTop() > 650) {
		  $(".scroll-to-top").fadeIn();
	  }
	  if($(this).scrollTop() < 650) {
		  $(".scroll-to-top").fadeOut();
	  }
	});

  });

});
</script>

</kentScripts>
