                      

                        <h1>Advanced course search</h1>
                        <div class="row-fluid">

                            <input class="advanced_text_search input-xlarge" type="text" placeholder="Search courses" />

                            <select class="campus_search input-large">
                              <option value="">All campuses</option>
                              <?php foreach($campuses as $c): ?>
                              <option><?php echo $c->name ?></option>
                              <?php endforeach; ?>
                            </select>
                          

                            <select class="study_mode_search input-large">
                              <option value="">All study modes</option>
                              <option>Full-time only</option>
                              <option>Part-time only</option>
                              <option>Full-time or part-time</option>
                            </select>
                          

                            <select class="subject_categories_search input-large">
                              <option value="">All subject categories</option>
                              <?php foreach($subject_categories as $sc): ?>
                              <option><?php echo $sc->name ?></option>
                              <?php endforeach; ?>
                            </select>
                          
                        </div>

                        <br />
                               
                        <table id="programme-list" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>UCAS code</th>
                                <th>Campus</th>
                                <th>Full-time/Part-time</th>
                                <th class="hide">Subject categories</th>
                                <th class="hide">Search keywords</th>
                              </tr>
                            </thead>
                            <tbody>
                            
                            <?php foreach($programmes as $p): ?>
        
                              <tr>
                                <td>
                                    <a href='<?php echo Flight::url("{$type}/{$year}/{$p->id}/{$p->slug}"); ?>'><?php echo $p->name;?> - <?php echo $p->award;?></a>
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
                                    <?php foreach($p->subject_categories as $sc): ?>
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
                   
<kentScripts>

 <script type="text/javascript" charset="utf8" src="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.1/jquery.dataTables.min.js"></script>
 <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo BASE_URL ?>js/DT_bootstrap.js"></script>

<script type='text/javascript'>

        //put our custom search items into variables
    var advanced_text_search = $('input.advanced_text_search');
    var campus_search = $('select.campus_search');
    var study_mode_search = $('select.study_mode_search');
    var subject_categories_search = $('select.subject_categories_search');


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
          "sDom": "", // no need for this since we're implementing our own search: "<'navbar'<'navbar-inner'<'navbar-search pull-left'f>>r>t<'muted pull-right'i><'clearfix'>p",
          "sPaginationType": "bootstrap",
          "iDisplayLength": 30,
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
    if(advanced_text_search && campus_search && study_mode_search){
      
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
    @import url('<?php echo BASE_URL ?>css/DT_bootstrap.css');
</style>