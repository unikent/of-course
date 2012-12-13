
<div class="tabContent" id="tab2">
  <h2>Course structure</h2>
    <div class="tabs"> 
        <ul class="tabsFallBackNav">    
            
            <li><a href="#tab1">Stage 1</a></li>
            <li><a href="#tab2">Stage 2</a></li>
            <li><a href="#tab3">Stage 3</a></li>
            <li><a href="#tab4">Year Abroad</a></li>
            <li><a href="#tab5">Year in Industry</a></li>
            <li><a href="#tab6">Foundation Year</a></li>
        </ul>
               
        <div class="tabContent" id="tab1">  
          <h3>Stage 1</h3>
          <h4>Compulsory modules</h4>
          <ul>
              <?php foreach ($course->modules->compulsory_modules->module as $module): ?>
              <li><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->{'-code'} ?>"><?php echo $module->{'-title'} ?></a> (<?php echo $module->{'-credits'} ?> credits)</li>
              <?php endforeach; ?>
          </ul>
          
          <h4>Optional modules</h4>
          <?php if ( $course->modules->optional_modules->{'-maximum_required'} > $course->modules->optional_modules->{'-required'} ): ?>
              <p>You must take between <?php echo $course->modules->optional_modules->{'-required'} ?> and <?php echo $course->modules->optional_modules->{'-maximum_required'} ?> credits from the following modules.</p>
          <?php else: ?>
              <p>You must take a total of <?php echo $course->modules->optional_modules->{'-required'} ?> credits from the following modules.</p>
          <?php endif; ?>
          <ul>
              <?php foreach ($course->modules->optional_modules->module as $module): ?>
              <li><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->{'-code'} ?>"><?php echo $module->{'-title'} ?></a> (<?php echo $module->{'-credits'} ?> credits)</li>
              <?php endforeach; ?>
          </ul>
          
          <h4>Wildcard modules</h4>
                    <?php if ( $course->modules->wildcard->{'-maximum_required'} > $course->modules->wildcard->{'-required'} ): ?>
              <p>You must take between <?php echo $course->modules->wildcard->{'-required'} ?> and <?php echo $course->modules->wildcard->{'-maximum_required'} ?> credits from wildcard modules.</p>
          <?php else: ?>
              <p>You must take a total of <?php echo $course->modules->wildcard->{'-required'} ?> credits from wildcard modules.</p>
          <?php endif; ?>
          
          <h5>Disclaimer</h5>
          <?php echo $course->module_disclaimer ?>
        </div>
        
        
        <div class="tabContent" id="tab2">  
          <h3>Stage 2</h3>
          <h4>Compulsory modules</h4>
          <ul>
              <?php foreach ($course->modules->compulsory_modules->module as $module): ?>
              <li><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->{'-code'} ?>"><?php echo $module->{'-title'} ?></a> (<?php echo $module->{'-credits'} ?> credits)</li>
              <?php endforeach; ?>
          </ul>
          
          <h4>Optional modules</h4>
          <?php if ( $course->modules->optional_modules->{'-maximum_required'} > $course->modules->optional_modules->{'-required'} ): ?>
              <p>You must take between <?php echo $course->modules->optional_modules->{'-required'} ?> and <?php echo $course->modules->optional_modules->{'-maximum_required'} ?> credits from the following modules.</p>
          <?php else: ?>
              <p>You must take a total of <?php echo $course->modules->optional_modules->{'-required'} ?> credits from the following modules.</p>
          <?php endif; ?>
          <ul>
              <?php foreach ($course->modules->optional_modules->module as $module): ?>
              <li><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->{'-code'} ?>"><?php echo $module->{'-title'} ?></a> (<?php echo $module->{'-credits'} ?> credits)</li>
              <?php endforeach; ?>
          </ul>
          
          <h4>Wildcard modules</h4>
                    <?php if ( $course->modules->wildcard->{'-maximum_required'} > $course->modules->wildcard->{'-required'} ): ?>
              <p>You must take between <?php echo $course->modules->wildcard->{'-required'} ?> and <?php echo $course->modules->wildcard->{'-maximum_required'} ?> credits from wildcard modules.</p>
          <?php else: ?>
              <p>You must take a total of <?php echo $course->modules->wildcard->{'-required'} ?> credits from wildcard modules.</p>
          <?php endif; ?>
          
          <h5>Disclaimer</h5>
          <?php echo $course->module_disclaimer ?>
        </div>
         
        <div class="tabContent" id="tab3">  
          <h3>Stage 3</h3>
          <h4>Compulsory modules</h4>
          <ul>
              <?php foreach ($course->modules->compulsory_modules->module as $module): ?>
              <li><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->{'-code'} ?>"><?php echo $module->{'-title'} ?></a> (<?php echo $module->{'-credits'} ?> credits)</li>
              <?php endforeach; ?>
          </ul>
          
          <h4>Optional modules</h4>
          <?php if ( $course->modules->optional_modules->{'-maximum_required'} > $course->modules->optional_modules->{'-required'} ): ?>
              <p>You must take between <?php echo $course->modules->optional_modules->{'-required'} ?> and <?php echo $course->modules->optional_modules->{'-maximum_required'} ?> credits from the following modules.</p>
          <?php else: ?>
              <p>You must take a total of <?php echo $course->modules->optional_modules->{'-required'} ?> credits from the following modules.</p>
          <?php endif; ?>
          <ul>
              <?php foreach ($course->modules->optional_modules->module as $module): ?>
              <li><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->{'-code'} ?>"><?php echo $module->{'-title'} ?></a> (<?php echo $module->{'-credits'} ?> credits)</li>
              <?php endforeach; ?>
          </ul>
          
          <h4>Wildcard modules</h4>
                    <?php if ( $course->modules->wildcard->{'-maximum_required'} > $course->modules->wildcard->{'-required'} ): ?>
              <p>You must take between <?php echo $course->modules->wildcard->{'-required'} ?> and <?php echo $course->modules->wildcard->{'-maximum_required'} ?> credits from wildcard modules.</p>
          <?php else: ?>
              <p>You must take a total of <?php echo $course->modules->wildcard->{'-required'} ?> credits from wildcard modules.</p>
          <?php endif; ?>
          
          <h5>Disclaimer</h5>
          <?php echo $course->module_disclaimer ?>
        </div>
        
        <div class="tabContent" id="tab4">  
            <h3>Year abroad</h3>
            <p><?php echo $course->year_abroad; ?></p>
        </div>
        <div class="tabContent" id="tab5">  
            <h3>Year in industry</h3>
            <p><?php echo $course->year_in_industry; ?></p>
        </div>
                    
        <div class="tabContent" id="tab6">
          <h3>Foundation year</h3>
          <p><?php echo $course->foundation_year; ?></p>
        </div>
        
    </div><!--/tabs-->
</div><!--/tab2-->