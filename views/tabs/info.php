<h2>Further information</h2>
      <table class="table table-striped">
        <tr>
          <th><span>Contacts</span></th>
        </tr>
        <tr>
          <td><strong>Related schools</strong>
              <ul>
                <li><a href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a></li>
                <?php if(!empty($course->additional_school[0])): ?>
                <li><a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a></li>
                <?php endif; ?>
              </ul>
           </td>
        </tr>
        <tr>
          <td><strong>Enquiries</strong>
            <?php echo $course->enquiries ?></td>
        </tr>
      </table>
      
      
      <table class="table table-striped">
        <tr>
          <th><span class="showHideTitle">Resources</span></th>
        </tr>
        <tr>
          <td><strong>Download a subject leaflet (pdf)</strong>
              <p>Our subject leaflets provide more detail about individual subjects areas. See:</p>
            <ul>
                <li><a href="<?php echo $course->subject_leaflet[0]->tracking_code ?>"><?php echo $course->subject_leaflet[0]->name ?></a></li>
                <?php if(!empty($course->subject_leaflet_2[0])): ?>
                <li><a href="<?php echo $course->subject_leaflet_2[0]->tracking_code ?>"><?php echo $course->subject_leaflet_2[0]->name ?></a></li>
                <?php endif; ?>
            </ul></td>
        </tr>
        <tr>
          <td><strong>Read our student profiles</strong>
              <ul>
                <li><a href="<?php echo $course->student_profile ?>"><?php echo $course->student_profile_1_link_text ?></a></li>
                <?php if(!empty($course->student_profile_2)): ?>
                <li><a href="<?php echo $course->student_profile_2 ?>"><?php echo $course->student_profile_2_link_text ?></a></li>
                <?php endif; ?>
              </ul></td>
        </tr>

        <?php if(!empty($course->open_days)): ?>
        <tr>
          <td><strong>Open days</strong>>
              <?php echo $course->open_days ?>
          </td>
        </tr>
        <?php endif; ?>

      </table>
      <table class="table table-striped">
        <tr>
          <th><span class="showHideTitle">Related courses</span></th>
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



<div class="well">
            <h3>UNISTATS / KIS</h3>
            <h4>Key Information Sets</h4>
            <p><?php echo $course->kis_explanatory_textarea ?></p>
          </div>
          
        <iframe id="unistats-widget-frame2"
    title="Unistats KIS Widget" src="http://widget.unistats.ac.uk/Widget/<?php echo $course->ukprn ?>/<?php echo $course->kiscourseid ?>/vertical/small/en-GB"
    scrolling="no"
    style="overflow: hidden; border: 0px none transparent; width: 190px; height: 400px;"> </iframe>
