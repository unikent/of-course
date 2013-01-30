<div class="tabContent" id="tab3">
<h2>Further information</h2>
<div class="contentTwoColumn">
    <div class="contentLeftColumn">
      <table class="em">
        <tr>
          <th scope="col"><span class="showHideTitle">Contacts</span></th>
        </tr>
        <tr>
          <td><h3>Related schools</h3>
              <ul>
                <li><a href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a></li>
                <?php if(!empty($course->additional_school[0])): ?>
                <li><a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a></li>
                <?php endif; ?>
              </ul></td>
        </tr>
        <tr>
          <td><h3>Enquiries</h3>
            <?php echo $course->enquiries ?></td>
        </tr>
      </table>
      <table class="em">
        <tr>
          <th scope="col"><span class="showHideTitle">Resources</span></th>
        </tr>
        <tr>
          <td><h3>Download a subject leaflet (pdf)</h3>
              <p>Our subject leaflets provide more detail about individual subjects areas. See:</p>
            <ul>
                <li><a href="<?php echo $course->subject_leaflet[0]->tracking_code ?>"><?php echo $course->subject_leaflet[0]->name ?></a></li>
                <?php if(!empty($course->subject_leaflet_2[0])): ?>
                <li><a href="<?php echo $course->subject_leaflet_2[0]->tracking_code ?>"><?php echo $course->subject_leaflet_2[0]->name ?></a></li>
                <?php endif; ?>
            </ul></td>
        </tr>
        <tr>
          <td><h3>Read our student profiles </h3>
              <ul>
                <li><a href="<?php echo $course->student_profile ?>"><?php echo $course->student_profile_1_link_text ?></a></li>
                <?php if(!empty($course->student_profile_2)): ?>
                <li><a href="<?php echo $course->student_profile_2 ?>"><?php echo $course->student_profile_2_link_text ?></a></li>
                <?php endif; ?>
              </ul></td>
        </tr>

        <?php if(!empty($course->open_days)): ?>
        <tr>
          <td><h3>Open days</h3>
              <?php echo $course->open_days ?>
          </td>
        </tr>
        <?php endif; ?>

      </table>
      <table class="em">
        <tr>
          <th scope="col"><span class="showHideTitle">Related courses</span></th>
        </tr>
        <tr>
          <td>
              <ul>
              
                  <?php foreach ($course->related_courses as $course_obj): ?>
                  <li><a href="<?php echo Flight::url("{$type}/{$year}/{$course_obj->id}/{$course_obj->slug}"); ?>"><?php echo $course_obj->name ?></a></li>
                  <?php endforeach; ?>
              </ul>
          </td>
        </tr>
      </table>
      <p>&nbsp;</p>
      
    </div>


                            
    <div class="contentRightColumn">
      <p align="right">
        <iframe id="unistats-widget-frame2"
    title="Unistats KIS Widget" src="http://widget.unistats.ac.uk/Widget/<?php echo $course->ukprn ?>/<?php echo $course->kiscourseid ?>/vertical/small/en-GB"
    scrolling="no"
    style="overflow: hidden; border: 0px none transparent; width: 190px; height: 400px;"> </iframe>
      </p>
      <div class="snippetBox ncright">
        <kentSnippetCallout snippetPack='Chronos' snippetVersion='1.0'>
          <table class="em">
            <tr>
              <th>Width (in pixels)</th>
              <td>190</td>
            </tr>
            <tr>
              <th>Side (left or right)</th>
              <td>right</td>
            </tr>
            <tr>
              <th>Background Colour? (primary,secondary,highlight or transparent)</th>
              <td>default</td>
            </tr>
          </table>
          <div class="calloutContent">
            <h2>UNISTATS / KIS</h2>
            <h4>Key Information Sets</h4>
            <p><?php echo $course->kis_explanatory_textarea ?></p>
          </div>
        </kentSnippetCallout>
      </div>
      <p>&nbsp;</p>
    </div>
    <div style="clear:left"></div>
    
</div>


</div>