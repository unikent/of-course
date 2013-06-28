<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/'); ?>

<div class="advanced-search">
    <h1>Advanced course search</h1>
    <div class="row-fluid advanced-search-boxes">

        <input class="advanced-text-search" type="text" placeholder="Search courses" />

        <select class="campus-search input-large">
          <option value="">All campuses</option>
          <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Canterbury'))  == 0) echo 'selected'; ?>>Canterbury</option>
          <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Medway'))  == 0) echo 'selected'; ?>>Medway</option>
        </select>
      
        <select class="study-mode-search input-large">
          <option value="">All study modes</option>
          <option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Full-time only'))  == 0) echo 'selected'; ?>>Full-time only</option>
          <option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Part-time only'))  == 0) echo 'selected'; ?>>Part-time only</option>
          <option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Full-time or part-time'))  == 0) echo 'selected'; ?>>Full-time or part-time</option>
        </select>
      
        <select class="subject-categories-search input-large">
          <option value="">All subject categories</option>
          <?php foreach($subject_categories as $sc): ?>
          <option <?php if(strcmp($search_type, 'subject_category')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower($sc->name))  == 0) echo 'selected'; ?>><?php echo $sc->name?></option>
          <?php endforeach; ?>
        </select>
      
    </div>

    
           
    <table id="programme-list" class="table table-striped table-bordered advanced-search-table">
        <thead>
          <tr>
            <th>Name <i class="icon-resize-vertical"></i></th>
            <th style="width:80px">Campus <i class="icon-resize-vertical"></i></th>
            <th style="width:150px">Full-time/Part-time <i class="icon-resize-vertical"></i></th>
            <th class="hide">Subject categories</th>
            <th class="hide">Search keywords</th>
          </tr>
        </thead>
        <tbody>
        
        <?php foreach($programmes as $p):?>
          
          <tr>
            <td>
                <a href='<?php echo Flight::url("{$level}/{$year_for_url}{$p->id}/{$p->slug}"); ?>'><?php echo $p->name;?> - <?php echo $p->award;?></a>
            </td>
            <td>
                <?php echo $p->campus;?>
            </td>
            <td>
                <?php echo $p->mode_of_study;?>
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
          </tr>
        <?php endforeach; ?>


        </tbody>
    </table>
</div>


               
<kentScripts>

<script type="text/javascript" charset="utf8" src="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.1/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo ASSET_URL ?>/js/build/of-course.min.js"></script>

<script type='text/javascript'>

//put our custom search items into variables
var advanced_text_search = $('input.advanced-text-search');
var campus_search = $('select.campus-search');
var study_mode_search = $('select.study-mode-search');
var subject_categories_search = $('select.subject-categories-search');


/* Custom filtering function which will filter data using our advanced search fields */
$.fn.dataTableExt.afnFiltering.push(
function( oSettings, aData, iDataIndex ) {

// get each column out
var name = $(aData[0]).html();
var ucas_code = aData[1];
var campus = aData[2];
var study_mode = aData[3];
var subject_categories = aData[4];
var search_keywords = aData[5];

if(advanced_text_search && campus_search && study_mode_search && subject_categories_search){

  // search both the Name, USAC code and Search keywords fields if our search box is filled
  var advanced_text_search_result = (advanced_text_search.val() == '') ? true : 
      (
        (name.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) || 
        (search_keywords.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) || 
        (ucas_code.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) 
        ? true : false 
      );
  
  // search the campus field if a campus is selected
  var campus_search_result = (campus_search.val() == '') ? true : (( campus.toLowerCase().indexOf( campus_search.val().toLowerCase() ) !== -1 ) ? true : false );
  
  // search the study mode field if a study mode is selected
  var study_mode_search_result = (study_mode_search.val() == '') ? true : (( study_mode.toLowerCase().indexOf( study_mode_search.val().toLowerCase() ) !== -1 ) ? true : false );
  
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
  return advanced_text_search_result && campus_search_result && study_mode_search_result && subject_categories_search_result;
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
        { "bSortable": false }
        ]
  });

//now add appropriate event listeners to our custom search items
if(advanced_text_search && campus_search && study_mode_search && subject_categories_search){
  
  advanced_text_search.keyup(function() {
    programme_list.fnDraw();
  });

  campus_search.change(function(){
    programme_list.fnDraw();
  });

  study_mode_search.change(function(){
    programme_list.fnDraw();
  });

  subject_categories_search.change(function(){
    programme_list.fnDraw();
  });

}

});
</script>

</kentScripts>

<style type='text/css'>
@import url('<?php echo ASSET_URL ?>/css/build/of-course.min.css');
</style>