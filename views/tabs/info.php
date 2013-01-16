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
          <strong>TODO: We may want to change this because we only have admin and additional school, and no url for either.</strong>
              <ul>
                <li><a href="/ug/2014/<?php echo $course->administrative_school[0]->name ?>"><?php echo $course->additional_school[0]->name ?></a></li>
                <li><a href="/ug/2014/<?php echo $course->additional_school[0]->name ?>"><?php echo $course->additional_school[0]->name ?></a></li>
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
          <td><h3>Subject leaflet</h3>
              <p>Our subject leaflets provide more detail about individual subjects areas. See:</p>
            <ul>
                <li><a href="<?php echo $course->subject_leaflet[0]->tracking_code ?>"><?php echo $course->subject_leaflet[0]->name ?></a></li>
                <li><a href="<?php echo $course->subject_leaflet_2[0]->tracking_code ?>"><?php echo $course->subject_leaflet_2[0]->name ?></a></li>
            </ul></td>
        </tr>
        <tr>
          <td><h3>Read our student profiles </h3>
          <strong>TODO: This will need fixing because we have no student names.</strong>
              <ul>
                <li><a href="<?php echo $course->student_profile_2 ?>">Student profile 1</a></li>
                <li><a href="<?php echo $course->student_profile_2 ?>">Student profile 2</a></li>
              </ul></td>
        </tr>
        <tr>
          <td><h3>Open days</h3>
              <p><strong>TODO: We don't have any such field? [This will be a global field that applies to all pages]</strong></p>
            <p>Our general open days will give you a flavour of what it is like to be an undergraduate, postgraduate or part-time student at Kent. They include a programme of talks for undergraduate students, with subject lectures and demonstrations, plus self-guided walking tours of the campus and a study bedroom. </p>
            <p>Our next open day are:</p>
            <ul>
                <li>Canterbury - Saturday 6 July 2013</li>
              <li>Medway - Saturday 22 June 2013</li>
            </ul></td>
        </tr>
      </table>
      <table class="em">
        <tr>
          <th scope="col"><span class="showHideTitle">Related courses</span></th>
        </tr>
        <tr>
          <td>
              <ul>
              
                  <?php foreach ($course->related_courses as $course_obj): ?>
                  <li><a href="/ug/2014/<?php echo $course_obj->id ?>/<?php echo $course_obj->slug ?>"><?php echo $course_obj->programme_title ?></a></li>
                  <?php endforeach; ?>
              </ul>
          </td>
        </tr>
      </table>
      <p>&nbsp;</p>
      
      <div>
          <h3>KIS explanatory text</h3>
          <?php echo $course->kis_explanatory_textarea ?>
      </div>
      
    </div>


                            
    <div class="contentRightColumn">
      <p align="right">
        <iframe id="unistats-widget-frame2"
    title="Unistats KIS Widget" src="http://widget.unistats.ac.uk/Widget/<?php echo $course->ukprn ?>/<?php echo $course->kiscourseid ?>/vertical/small/en-GB"
    scrolling="no"
    style="overflow: hidden; border: 0px none transparent; width: 190px; height: 500px;"> </iframe>
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
            <p><?php echo $course->kis_explanatory_text?></p>
          </div>
        </kentSnippetCallout>
      </div>
      <p>&nbsp;</p>
    </div>
    <div style="clear:left"></div>
    
</div>


</div>