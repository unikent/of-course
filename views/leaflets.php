<?php
  
  $leaflet_atoz = array();
  foreach ($leaflets as $leaflet) {
    $leaflet_atoz[strtoupper(substr($leaflet->name, 0, 1))][] = $leaflet;
  }

  // create the content of our a to z list
$tabs_nav = "";
$tabs_content = "";
$count = 0;
foreach(array_keys($leaflet_atoz) as $key){

  $active = ($count == 0) ? 'active' : '';
    
    $tabs_nav .= '<li class="' . $active . '"><a href="#'.$key.'" data-toggle="tab">'.$key.'</a></li>';

    $tabs_content .= '<section class="tab-pane ' . $active . '" id="'.$key.'"><ul>';
    foreach ($leaflet_atoz[$key] as $leaflet) {
      $leaflet_name = $leaflet->name;
      if(!empty($leaflet->tracking_code)){
        $leaflet_name = '<a href="'.$leaflet->tracking_code.'">'.$leaflet_name.'</a>';
      }

      $tabs_content .= '<li>'.$leaflet_name.'</li>';
    }
    $tabs_content .= '</ul></section>';

    $count++;
  
}
?>
<article class="container">
    <h1>Subject leaflets</h1>
              
            <p>These subject leaflets supplement the information contained in our paper   prospectus and the online subject pages. Though all are slightly different to   reflect the different nature of the subjects we offer, they typically   include:</p>
            <ul>
              <li>Why you should come to Kent to study that subject</li>
              <li>What a degree in that subject will give you</li>
              <li>More information about the degree programmes on offer</li>
              <li>Example information on modules that are typically available each year</li>
              <li>Teaching and assessment methods</li>
              <li>Career opportunities and destinations of Kent graduate students</li>
              <li>Alumni profiles and/or student quotes </li>
            </ul>
            
            <h1>Download PDFs </h1>
            <p>Listed alphabetically by subject</p>

          <div class="row-fluid">
            <div class="span12">
              <ul class="nav nav-tabs">
              <?php echo $tabs_nav ?>
              </ul>
            </div><!-- /span -->
          </div><!-- /row -->

          <div class="row-fluid">
            <div class="span12">
              <div class="tab-content">
                <?php echo $tabs_content ?>
              </div>
            </div><!-- /span -->
              
          </div>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
</article>