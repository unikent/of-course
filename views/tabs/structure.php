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
          <?php foreach ($course->modules->clusters->compulsory as $cluster): ?>
          <ul>
              <?php foreach ($cluster->modules->module as $module): ?>
              <?php if ($module->credit_amount > 0): ?>
              <li><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->module_code ?>"><?php echo $module->module_code ?> - <?php echo $module->module_title ?></a> - <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS) <span id="module-more-info-<?php echo $module->module_code ?>"><a href="#">summary</a></span>
              <div class="module-synopsis"><?php echo $module->synopsis ?></div>
              </li>
              <?php endif; ?>
              <?php endforeach; ?>
          </ul>
          <?php endforeach; ?>
          
          <h4>Optional modules</h4>
          <?php foreach ($course->modules->clusters->optional as $cluster): ?>
          <?php if ( $cluster->modules_required >= $cluster->modules_required ): ?>
              <p>You must take between <?php echo $cluster->modules_required ?> and <?php echo $cluster->modules_required ?> credits from the following modules.</p>
          <?php else: ?>
              <p>You must take a total of <?php echo $cluster->modules_required ?> credits from the following modules.</p>
          <?php endif; ?>
          <ul>
              <?php foreach ($cluster->modules->module as $module): ?>
              <?php if ($module->credit_amount > 0): ?>
              <li><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->module_code ?>"><?php echo $module->module_code ?> - <?php echo $module->module_title ?></a> - <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS) <span id="module-more-info-<?php echo $module->module_code ?>"><a href="#">summary</a></span>
              <div class="module-synopsis"><?php echo $module->synopsis ?></div>
              </li>
              <?php endif; ?>
              <?php endforeach; ?>
          </ul>
          <?php endforeach; ?>
          
          <h4>Wildcard modules</h4>
          <?php foreach ($course->modules->clusters->optional as $cluster): ?>
          <?php if ( $cluster->modules_required >= $cluster->modules_required ): ?>
              <p>You must take between <?php echo $cluster->modules_required ?> and <?php echo $cluster->modules_required ?> credits from wildcard modules.</p>
          <?php else: ?>
              <p>You must take a total of <?php echo $cluster->modules_required ?> credits from wildcard modules.</p>
          <?php endif; ?>
          <?php endforeach; ?>
          
        </div>
        
    </div><!--/tabs-->
</div><!--/tab2-->

<script>
$(document).ready(function (){

	$('span[id^=module-more-info-]').each(function(){
		$(this).click(function(event){
			event.preventDefault();
			$(this).parent().children('.module-synopsis').slideToggle();
		});
	});
});

</script>
<style>
.module-synopsis {
	display: none;
	padding:10px 0px 10px 0px;
}
a .module-more-info-link {
	cursor: hand;
}
</style>