<div class="advanced-search">
    <h1>Advanced course search</h1>
    <div class="row-fluid advanced-search-boxes">

        <input class="advanced-text-search" type="text" placeholder="Search courses" />

        <select class="campus-search input-large">
          <option value="">All campuses</option>
          <option>Canterbury</option>
          <option>Medway</option>
        </select>
      

        <select class="study-mode-search input-large">
          <option value="">All study modes</option>
          <option>Full-time only</option>
          <option>Part-time only</option>
          <option>Full-time or part-time</option>
        </select>
      

        <select class="subject-categories-search input-large">
          <option value="">All subject categories</option>
          <?php foreach($subject_categories as $sc): ?>
          <option <?php if(strcmp($search_type, 'subject_category')  == 0  && strcmp(urldecode($search_string), $sc->name)  == 0) echo 'selected'; ?>><?php echo $sc->name?></option>
          <?php endforeach; ?>
        </select>
      
    </div>

    
           
    <table id="programme-list" class="table table-striped table-bordered advanced-search-table">
        <thead>
          <tr>
            <th>Name <i class="icon-resize-vertical"></i></th>
            <th style="width:100px">UCAS code <i class="icon-resize-vertical"></i></th>
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
                <a href='<?php echo Flight::url("{$level}/{$year}/{$p->id}/{$p->slug}"); ?>'><?php echo $p->name;?> - <?php echo $p->award;?></a>
            </td>
            <td>
                <?php echo $p->ucas_code;?>
            </td>
            <td>
                <?php echo $p->campus;?>
            </td>
            <td>
                <?php echo $p->mode_of_study;?>
            </td>
            <td class="hide">
                <?php foreach((array)$p->subject_categories as $sc): ?>
                  <?php echo $sc;?> <br />
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
<script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo ASSET_URL ?>/js/DT_bootstrap.js"></script>

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
  
  // search the subject category field if a subject category is selected
  var subject_categories_search_result = (subject_categories_search.val() == '') ? true : (( subject_categories.toLowerCase().indexOf( subject_categories_search.val().toLowerCase() ) !== -1 ) ? true : false );

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
@import url('<?php echo ASSET_URL ?>/css/DT_bootstrap.css');
</style>