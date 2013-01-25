<div class="tabContent" id="tab2">
  <h2>Course structure</h2>
    <div class="tabs"> 
        
        <?php foreach ($course->modules->stages as $index => $stage): ?>
        <div class="tabContent" id="tab<?php echo $index ?>">
          <h3><?php echo $stage->name ?></h3>
          <?php if ($stage->clusters->compulsory != null): ?>
          <h4>Compulsory modules</h4>
          <?php foreach ($stage->clusters->compulsory as $cluster): ?>
          <ul>
              <?php foreach ($cluster->modules->module as $module): ?>
              <?php if ($module->credit_amount > 0): ?>
              <li><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->module_code ?>"><?php echo $module->module_code ?> - <?php echo $module->module_title ?></a> - <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS) <span id="module-more-info-<?php echo $module->module_code ?>"><a href="#">summary</a></span>
              <div class="module-synopsis"><?php //echo $module->synopsis ?></div>
              </li>
              <?php endif; ?>
              <?php endforeach; ?>
          </ul>
          <?php endforeach; ?>
          <?php endif; ?>
          
          <?php if ($stage->clusters->optional != null): ?>
          <h4>Optional modules</h4>
          <?php foreach ($stage->clusters->optional as $cluster): ?>
          <?php if ( $cluster->maximum_modules_required > $cluster->modules_required ): ?>
              <p>You must take between <?php echo $cluster->modules_required ?> and <?php echo $cluster->maximum_modules_required ?> credits from the following modules.</p>
          <?php else: ?>
              <p>You must take a total of <?php echo $cluster->modules_required ?> credits from the following modules.</p>
          <?php endif; ?>
          <ul>
              <?php foreach ($cluster->modules->module as $module): ?>
              <?php if ($module->credit_amount > 0): ?>
              <li><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->module_code ?>"><?php echo $module->module_code ?> - <?php echo $module->module_title ?></a> - <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS) <span id="module-more-info-<?php echo $module->module_code ?>"><a href="#">summary</a></span>
              <div class="module-synopsis"><?php //echo $module->synopsis ?></div>
              </li>
              <?php endif; ?>
              <?php endforeach; ?>
          </ul>
          <?php endforeach; ?>
          <?php endif; ?>
          
          <?php if ($stage->clusters->wildcard != null): ?>
          <h4>Wildcard modules</h4>
          <?php foreach ($stage->clusters->wildcard as $cluster): ?>
          <?php if ( $cluster->maximum_modules_required > $cluster->modules_required ): ?>
              <p>You must take between <?php echo $cluster->modules_required ?> and <?php echo $cluster->maximum_modules_required ?> credits from wildcard modules.</p>
          <?php else: ?>
              <p>You must take a total of <?php echo $cluster->modules_required ?> credits from wildcard modules.</p>
          <?php endif; ?>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
        
        <?php endforeach; ?>
        
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