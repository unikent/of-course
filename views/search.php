                     
                        <div style='padding:30px;'>

                        <h1>Advanced Course search</h1>
                        
                        <table id="programme-list" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>name</th>
                                <th>ucas code</th>
                                <th>campus</th>
                                <th>full-time/part-time</th>
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
                              </tr>
                            <?php endforeach; ?>
          

                            </tbody>
                        </table>

                        
                    </div>
                   
<kentScripts>

 <script type="text/javascript" charset="utf8" src="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.1/jquery.dataTables.min.js"></script>
 <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo BASE_URL ?>js/DT_bootstrap.js"></script>

<script type='text/javascript'>
/**
  *
  * data tables for programme index page
  *
  */
 $(document).ready(function(){
    var programme_list = $('#programme-list').dataTable({
          "sDom": "<'navbar'<'navbar-inner'<'navbar-search pull-left'f>>r>t<'muted pull-right'i><'clearfix'>p",
          "sPaginationType": "bootstrap",
          "iDisplayLength": 30,
          "oLanguage": {
              "sSearch": ""
          },
          "aoColumns": [ 
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true }
            ]
      });

    var search_box = $('.dataTables_filter input');

    //hide the default search box
    search_box.hide();

    //now add our custom search items
    search_box.after(
      '<input class="advanced_text_search" type="text" />' +
      '&nbsp; <select class="campus_search"><option value="">Select campus</option><option>Canterbury</option><option>Medway</option></select>' +
      '&nbsp; <select class="study_mode_search"><option value="">Select study mode</option><option>Full-time</option><option>Part-time</option></select>'
      );

    //put our custom search items into variables
    var advanced_text_search = $('.dataTables_filter input.advanced_text_search');
    var campus_search = $('.dataTables_filter select.campus_search');
    var study_mode_search = $('.dataTables_filter select.study_mode_search');

    //now add appropriate event listeners to our custom search items
    if(advanced_text_search && campus_search && study_mode_search){
      
      advanced_text_search.keyup(function() {
        update_search();
      });

      campus_search.change(function(){
        update_search();
      });

      study_mode_search.change(function(){
        update_search();
      });

    }

    // populate the default search box with out custom search items
    function update_search(){

      var search_string = '';

      search_string += (advanced_text_search.val() != '') ? advanced_text_search.val() : '';
      search_string += (campus_search.val() != '') ? ' ' + campus_search.val() : '';
      search_string += (study_mode_search.val() != '') ? ' ' + study_mode_search.val() : '';

      search_box.val(search_string);

      //fire keyup event
      search_box.keyup();
    }

    //style and ass search button to our custom search box
    advanced_text_search.attr("placeholder", "Search programmes").wrap($("<div class='input-prepend'></div>")).parent().prepend($('<span class="add-on"><i class="icon-search"></i></span>'));
    

    
  });
</script>

</kentScripts>



  <style type='text/css'>
    @import url('<?php echo BASE_URL ?>css/DT_bootstrap.css');
</style>