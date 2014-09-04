<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/'); ?>

<?php if($year !== CoursesFrontEnd::$current_year): ?>
  <meta name="robots" content="noindex, nofollow" />
  <div class='alert alert-daedalus'>
    You're not searching for programmes in the current upcoming year. <a href="<?php echo BASE_URL != '/' ? BASE_URL : ''; ?>/postgraduate/search">Search for current programmes here.</a>
  </div>
<?php endif; ?>

<div class="advanced-search">
    <h1>Courses A-Z</h1>

      <div class="row-fluid">
        <div class="span12">
          <ul class="nav nav-tabs">
            <li><a href="<?php echo BASE_URL != '/' ? BASE_URL : ''; ?>/undergraduate/search">Undergraduate</a></li>
            <li class="active"><a href="<?php echo BASE_URL != '/' ? BASE_URL : ''; ?>/postgraduate/search">Postgraduate</a></li>
          </ul>
        </div><!-- /span -->
      </div><!-- /row -->

    <div class="row advanced-search-boxes">

        <h2>Filter course list</h2>

        <input class="advanced-text-search" type="text" placeholder="Filter by keyword" />

        <div id="advanced-text-search-hint-box" class="visible-phone"><span id="advanced-text-search-hint" class="hide"><a href="#programme-list">Results filtered below...</a></span></div>

        <div class="advanced-search-filters">

          <select class="campus-search input-medium <?php if(strcmp($search_type, 'campus')  == 0) echo 'highlighted'; ?>">
            <option value="">All locations</option>
            <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Canterbury'))  == 0) echo 'selected'; ?>>Canterbury</option>
            <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Medway'))  == 0) echo 'selected'; ?>>Medway</option>
            <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Paris'))  == 0) echo 'selected'; ?>>Paris</option>
            <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Rome'))  == 0) echo 'selected'; ?>>Rome</option>
            <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Brussels'))  == 0) echo 'selected'; ?>>Brussels</option>
            <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Athens'))  == 0) echo 'selected'; ?>>Athens</option>
            <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('KSS Dental Deanery'))  == 0) echo 'selected'; ?>>KSS Dental Deanery</option>
            <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Mauritius'))  == 0) echo 'selected'; ?>>Mauritius</option>
            <option <?php if(strcmp($search_type, 'campus')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Moscow'))  == 0) echo 'selected'; ?>>Moscow</option>
          </select>

          <select class="study-mode-search input-medium <?php if(strcmp($search_type, 'study_mode')  == 0) echo 'highlighted'; ?>">
            <option value="">All study modes</option>
            <option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Full-time'))  == 0) echo 'selected'; ?>>Full-time</option>
            <option <?php if(strcmp($search_type, 'study_mode')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('Part-time'))  == 0) echo 'selected'; ?>>Part-time</option>
          </select>

          <select class="subject-categories-search input-large <?php if(strcmp($search_type, 'subject_category')  == 0) echo 'highlighted'; ?>">
            <option value="">All subject categories</option>
            <?php
            sort($subject_categories);
            foreach($subject_categories as $sc): ?>
            <option <?php if(strcmp($search_type, 'subject_category')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower($sc->name))  == 0) echo 'selected'; ?>><?php echo $sc->name?></option>
            <?php endforeach; ?>
          </select>

          <select class="award-search input-medium <?php if(strcmp($search_type, 'award')  == 0) echo 'highlighted'; ?>">
            <option value="">All awards</option>
            <?php foreach($awards as $award): ?>
            <option <?php if(strcmp($search_type, 'award')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower($award))  == 0) echo 'selected'; ?>><?php echo $award ?></option>
            <?php endforeach; ?>
          </select>

          <select class="programme-type-search input-medium <?php if(strcmp($search_type, 'programme_type')  == 0) echo 'highlighted'; ?>">
            <option value="">All course types</option>
            <option <?php if(strcmp($search_type, 'programme_type') == 0  && strcmp(urldecode(strtolower($search_string)), 'research') == 0) echo 'selected'; ?>>Research</option>
            <option <?php if(strcmp($search_type, 'programme_type') == 0  && strcmp(urldecode(strtolower($search_string)), 'taught') == 0) echo 'selected'; ?>>Taught</option>
            <option <?php if(strcmp($search_type, 'programme_type') == 0  && strcmp(urldecode(strtolower($search_string)), 'taught-research') == 0) echo 'selected'; ?>>Taught-research</option>
          </select>

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
          </tr>
        </thead>
        <tbody>

        <?php foreach($programmes as $p):?>
          <?php 
            $statuses = '(';
            if($p->subject_to_approval == 'true'){
              $statuses .= "subject to approval";
            }
            if($p->withdrawn == 'true'){
              $statuses .= $statuses == '(' ? "withdrawn" : ", withdrawn";
            }
            if ($p->suspended == 'true') {
              $statuses .= $statuses == '(' ? "suspended" : ", suspended";
            }
            $statuses = $statuses == '(' ? '' : $statuses . ')';
          ?>

          <tr>
            <td>
                <div class="advanced-search-name-award"><a href='<?php echo Flight::url("{$level}/{$year_for_url}{$p->id}/{$p->slug}"); ?>'><?php echo $p->name;?> <?php echo $statuses; ?></a><br /><span class="advanced-search-award"><?php echo $p->award;?></span></div>
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
  var award_search = $('select.award-search');
  var programme_type_search = $('select.programme-type-search');

  /* Custom filtering function which will filter data using our advanced search fields */
  $.fn.dataTableExt.afnFiltering.push(
  function( oSettings, aData, iDataIndex ) {

  // get each column out
  var name = $(aData[0]).html();
  var award = $(aData[0]).find('span').text();
  var programme_type = aData[1];
  var campus = aData[2];
  var study_mode = aData[3];
  var subject_categories = aData[4];
  var search_keywords = aData[5];

  if(advanced_text_search && campus_search && study_mode_search && subject_categories_search && award_search && programme_type_search){

    // search both the Name, award and Search keywords fields if our search box is filled
    var advanced_text_search_result = (advanced_text_search.val() == '') ? true :
        (
          (name.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) ||
          (search_keywords.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) ||
          (award.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) ||
          (programme_type.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) ||
          (campus.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) ||
          (study_mode.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1) ||
          (subject_categories.toLowerCase().indexOf(advanced_text_search.val().toLowerCase()) !== -1)

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

    // search the award field if an award is selected
    var award_search_result = (award_search.val() == '') ? true : (( award.toLowerCase().indexOf( award_search.val().toLowerCase() ) !== -1 ) ? true : false );

    // search the programme type field if a programme type is selected
    var programme_type_search_result = (programme_type_search.val() == '') ? true : (( programme_type.toLowerCase().indexOf( programme_type_search.val().toLowerCase() ) !== -1 ) ? true : false );

    // return our results
    return advanced_text_search_result && campus_search_result && study_mode_search_result && subject_categories_search_result && award_search_result && programme_type_search_result;
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
        "sDom": "t<'muted pull-right'i><'clearfix'>p",
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
    if(advanced_text_search && campus_search && study_mode_search && subject_categories_search && award_search && programme_type_search){

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

      award_search.change(function(){
        programme_list.fnDraw();
        highlight($(this));
      });

      programme_type_search.change(function(){
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
