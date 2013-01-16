    <div class="tabContent" id="tab1">
      <div class="snippetBox ncright">
        <kentSnippetCallout snippetPack='Chronos' snippetVersion='1.0'>
          <table class="em">
            <tr>
              <th>Width (in pixels)</th>
              <td>260</td>
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
            <h2>Key facts</h2>
            <ul>
              <li><strong>Subject area:</strong> <?php echo $course->subject_area_1[0]->name;?></li>
              <li><strong>Award:</strong> <?php echo $course->award[0]->name;?> </li>
              <li><strong>Honours type:</strong> <?php echo $course->honours_type;?> </li>
              <li><strong>Ucas code:</strong> <?php echo $course->ucas_code;?>  </li>
              <li><strong>Location:</strong> <a href="<?php echo $course->location[0]->url;?>"><?php echo $course->location[0]->name;?></a>  </li>
              <li><strong>Mode of study:</strong> <br>
              
              	<?php echo $course->mode_of_study;?> 
              </li>
              <li><strong>Duration:</strong> <br><?php echo $course->duration;?></li>
              <li><strong>Start: </strong> <?php echo $course->start;?> </li>
              <li><strong>Accredited by</strong>: <?php echo $course->accredited_by;?>  </li>
              <li><strong>Total Kent credits:</strong> <?php echo $course->total_kent_credits_awarded_on_completion;?></li>
              <li><strong>Total ECTS credits:</strong> <?php echo $course->total_ects_credits_awarded_on_completion;?></li>
            </ul>
          </div>
        </kentSnippetCallout>
      </div>
    	<h2>Overview</h2>
      	<p><?php echo $course->programme_overview_text; ?></p>
      <p>&nbsp;</p>
    </div>