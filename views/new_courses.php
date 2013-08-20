<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/'); ?>

<div class="advanced-search">
    

      <?php if ($level == 'undergraduate'): ?>
        <h1>New Undergraduate Courses A-Z</h1>
      <?php elseif ($level == 'postgraduate'): ?>
        <h1>New Postgraduate Courses A-Z</h1>
      <?php endif; ?>
           
    <table id="programme-list" class="table table-striped-search advanced-search-table">
        <thead>
          <tr>
            <th>Name <i class="icon-resize-vertical"></i></th>
            <th style="width:120px">Course type <i class="icon-resize-vertical"></i></th>
            <th style="width:120px">Campus <i class="icon-resize-vertical"></i></th>
            <th style="width:150px">Full-time/Part-time <i class="icon-resize-vertical"></i></th>
            <th class="hide">Subject categories</th>
            <th class="hide">Search keywords</th>
            <th class="hide">Award</th>
          </tr>
        </thead>
        <tbody>
        
        <?php foreach($programmes as $p):?>
          <?php if ($p->new_programme != ''): ?>
          <tr>
            <td>
                <div class="advanced-search-name-award"><a href='<?php echo Flight::url("{$level}/{$year_for_url}{$p->id}/{$p->slug}"); ?>'><?php echo $p->name;?> <?php if($p->subject_to_approval == 'true'){ echo "(subject to approval)";} ?></a><br /><span class="advanced-search-award"><?php echo $p->award;?></span></div>
            </td>
            <td>
                <?php echo ucwords($p->programme_type);?>
            </td>
            <td>
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
            <td class="hide">
                  <?php echo $p->award;?>
            </td>
          </tr>
          <?php endif; ?>
        <?php endforeach; ?>


        </tbody>
    </table>
</div>


               
<kentScripts>
<script type='text/javascript'>
$(document).ready(function(){ 
  //put our custom search items into variables
  var advanced_text_search = $('input.advanced-text-search');

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

    if(advanced_text_search){

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

      // return our results
      return advanced_text_search_result;
    }

    return true;
  });

  /**
  *
  * data tables for programme index page
  *
  */
  $(document).ready(function(){
  var programme_list = $('#programme-list').dataTable({
        "sDom": "t",
        "sPaginationType": "bootstrap",
        "iDisplayLength": 200,
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
    if(advanced_text_search){
      advanced_text_search.keyup(function() {
        programme_list.fnDraw();
        /* show/hide the search hint when the input box is empty */
        $("#advanced-text-search-hint").show();
        if( $(this).val().length == 0 ) {
          $("#advanced-text-search-hint").hide();
        }
      });
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
