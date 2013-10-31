<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/'); ?>

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
            <option value="">All campuses</option>
            <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Canterbury'))  == 0) echo 'selected'; ?>>Canterbury</option>
            <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Medway'))  == 0) echo 'selected'; ?>>Medway</option>
          </select>
        
          <select class="study-mode-search input-large <?php if(strcmp($search_type, 'study_mode')  == 0) echo 'highlighted'; ?>">
            <option value="">All study modes</option>
            <option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Full-time only'))  == 0) echo 'selected'; ?>>Full-time only</option>
            <option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Part-time only'))  == 0) echo 'selected'; ?>>Part-time only</option>
            <option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Full-time or part-time'))  == 0) echo 'selected'; ?>>Full-time or part-time</option>
          </select>
        
          <select class="subject-categories-search input-large <?php if(strcmp($search_type, 'subject_category')  == 0) echo 'highlighted'; ?>">
            <option value="">All subject categories</option>
            <?php foreach($subject_categories as $sc): ?>
            <option <?php if(strcmp($search_type, 'subject_category')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower($sc->name))  == 0) echo 'selected'; ?>><?php echo $sc->name?></option>
            <?php endforeach; ?>
          </select>

          <select class="school-search input-large <?php if(strcmp($search_type, 'school')  == 0) echo 'highlighted'; ?>">
            <option value="">All schools</option>
            <?php foreach($schools as $school): ?>
            <option <?php if(strcmp($search_type, 'school')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower($school->name))  == 0) echo 'selected'; ?>><?php echo $school->name?></option>
            <?php endforeach; ?>
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
            <th class="hide">Main school</th>
            <th class="hide">Secondary school</th>
          </tr>
        </thead>
        <tbody>
        
        <?php foreach($programmes as $p):?>
          
          <tr>
            <td>
                <a href='<?php echo Flight::url("{$level}/{$year_for_url}{$p->id}/{$p->slug}"); ?>'><?php echo $p->name;?> <?php if($p->subject_to_approval == 'true'){ echo "(subject to approval)";} ?></a><br /><span class="advanced-search-award"><?php echo $p->award;?></span>
            </td>
            <td>
                <?php echo $p->ucas_code;?>
            </td>
            <td class="hidden-phone">
                <?php echo $p->campus;?>
            </td>
            <td class="hidden-phone">
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
            <td class="hide">
                  <?php echo $p->main_school;?>
            </td>
            <td class="hide">
                  <?php echo $p->secondary_school;?>
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
  var study_mode_search = $('select.study-mode-search');
  var subject_categories_search = $('select.subject-categories-search');
  var school_search = $('select.school-search');


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
  var main_school = aData[6];
  var secondary_school = aData[7];

  if(advanced_text_search && campus_search && study_mode_search && subject_categories_search && school_search){

    // search both the Name, UCAS code and Search keywords fields if our search box is filled
    var advanced_text_search_result = (advanced_text_search.val() == '') ? true : 
        (
          (name.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) || 
          (search_keywords.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) || 
          (main_school.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) || 
          (secondary_school.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) || 
          (study_mode.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) || 
          (campus.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) || 
          (subject_categories.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) || 
          (ucas_code.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1)
          ? true : false 
        );
    
    // search the campus field if a campus is selected
    var campus_search_result = (campus_search.val() == '') ? true : (( campus.toLowerCase().indexOf( campus_search.val().toLowerCase() ) !== -1 ) ? true : false );
    
    // search the study mode field if a study mode is selected
    var study_mode_search_result = (study_mode_search.val() == '') ? true : (( study_mode.toLowerCase().indexOf( study_mode_search.val().toLowerCase() ) !== -1 ) ? true : false );

    // search the school field if a school is selected
    var school_search_result = (school_search.val() == '') ? true : (( main_school.toLowerCase().indexOf( school_search.val().toLowerCase() ) !== -1  || secondary_school.toLowerCase().indexOf( school_search.val().toLowerCase() ) !== -1 ) ? true : false );
    
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
    return advanced_text_search_result && campus_search_result && study_mode_search_result && subject_categories_search_result && school_search_result;
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
          { "bSortable": false },
          { "bSortable": false }
          ]
    });

    //now add appropriate event listeners to our custom search items
    if(advanced_text_search && campus_search && study_mode_search && subject_categories_search && school_search){
      
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

      study_mode_search.change(function(){
        programme_list.fnDraw();
        highlight($(this));
      });

      subject_categories_search.change(function(){
        programme_list.fnDraw();
        highlight($(this));
      });

      school_search.change(function(){
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

