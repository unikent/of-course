<div class="tabContent" id="tab3">
  <h2>Careers</h2>
  <div class="snippetBox ncright">
    <kentSnippetCallout snippetPack='Chronos' snippetVersion='1.0'>
      <table class="em">
        <tr>
          <th>Width (in pixels)</th>
          <td>228</td>
        </tr>
        <tr>
          <th>Side (left or right)</th>
          <td>right</td>
        </tr>
        <tr>
          <th>Background Colour? (default, primary, secondary, highlight, light or transparent)</th>
          <td>secondary</td>
        </tr>
      </table>
      <div class="calloutContent"> 
        <h4>Did you know...</h4>
        <p><?php echo $course->did_you_know_fact_box ?></p>
      </div>
    </kentSnippetCallout>
  </div>
  <p><?php echo $course->careers_overview; ?></p>

  <h4>Professional recognition</h4>
  <p><?php echo $course->professional_recognition; ?></p>
  <p>For more information on the services Kent provides you to improve your career prospects visit <a href="http://www.kent.ac.uk/employability.">www.kent.ac.uk/employability.</a></p>

  <?php if(!empty($course->careersemployability_text)): ?>
  <p><?php echo $course->careersemployability_text; ?></p>
  <?php endif; ?>
</div>