<?php
  
// our A to Z array of subject leaflets
$leaflet_atoz = array();

//oreganise the subject leaflets into and A to Z array
foreach ($leaflets as $leaflet) {
  $leaflet_atoz[strtoupper(substr($leaflet->name, 0, 1))][] = $leaflet;
}

// our tab navigation
$tabs_nav = "";

// our tab contents
$tabs_content = "";

// for each letter in our A to Z, build our tabs
foreach(array_keys($leaflet_atoz) as $key => $letter){

  $active = ($key == 0) ? 'active' : '';
  
  // add the letter to our tab navigation
  $tabs_nav .= '<li class="' . $active . '"><a href="#'.$letter.'" data-toggle="tab">'.$letter.'</a></li>';

  // add the subject leaflets to the content
  $tabs_content .= '<section class="tab-pane ' . $active . '" id="'.$letter.'"><ul>';
  foreach ($leaflet_atoz[$letter] as $leaflet) {
    $leaflet_name = $leaflet->name;
    if(!empty($leaflet->tracking_code)){
      $leaflet_name = '<a href="'.$leaflet->tracking_code.'">'.$leaflet_name.'</a>';
    }

    $tabs_content .= '<li>'.$leaflet_name.'</li>';
  }
  $tabs_content .= '</ul></section>';
  
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