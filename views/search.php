                     
                        <div style='padding:30px;'>

                        <h1>Advanced Course search</h1>
                        
                        <table id="programme-list" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>name</th>
                                <th>award</th>
                                <th>campus</th>
                                <th>full-time/part-time</th>
                              </tr>
                            </thead>
                            <tbody>
                            
                            <?php foreach($programmes as $p): ?>
        
                              <tr>
                                <td>
                                    <?php echo $p->name;?>
                                </td>
                                <td>
                                    <?php echo $p->award;?>
                                </td>
                                <td>
                                    Canterbury
                                </td>
                                <td>
                                    Full-time
                                </td>
                              </tr>
                            <?php endforeach; ?>
          

                            </tbody>
                        </table>

                        
                    </div>
                   
            
 <script type="text/javascript" charset="utf8" src="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.1/jquery.dataTables.min.js"></script>
 <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo BASE_URL ?>js/DT_bootstrap.js"></script>
<style type='text/css'>
    @import url('<?php echo BASE_URL ?>css/DT_bootstrap.css');
</style>


  <script type='text/javascript'>
  /**
    *
    * data tables for programme index page
    *
    */
   $(document).ready(function(){
      $('#programme-list').dataTable({
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
        $('.dataTables_filter input').attr("placeholder", "Search programmes").wrap($("<div class='input-prepend'></div>")).parent().prepend($('<span class="add-on"><i class="icon-search"></i></span>'));
    });
  </script>