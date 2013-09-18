<?php if ( ! empty($stage->clusters->compulsory) || ! empty($stage->clusters->optional) ): ?> 
<p>Possible modules may include: </p>

<div class="daedalus-show-hide show-hide minimal">
    <?php foreach ($stage->clusters->compulsory as $cluster): ?>
        <?php foreach ($cluster->modules->module as $module): ?>
            <?php if ( ! empty($module->module_code) && ! empty($module->module_title) ): ?>
                
                    <p class="show-hide-title"><?php echo $module->module_code ?> - <?php echo $module->module_title ?></p>
                    
                    <div class="show-hide-content">
                        <p><?php echo $module->synopsis ?></p>
                        <p><strong>Credits:</strong> <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS credits).</p>
                        <p class="module-read-more"><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->module_code ?>">Read more <i class="icon-arrow-right"></i></a></p>
                    </div>
                
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
    
    <?php foreach ($stage->clusters->optional as $cluster): ?>
        <?php foreach ($cluster->modules->module as $module): ?>
            <?php if ( ! empty($module->module_code) && ! empty($module->module_title) ): ?>
                
                    <p class="show-hide-title"><?php echo $module->module_code ?> - <?php echo $module->module_title ?></p>
                    
                    <div class="show-hide-content">
                        <p><?php echo $module->synopsis ?></p>
                        <p><strong>Credits:</strong> <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS credits).</p>
                        <p class="module-read-more"><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->module_code ?>">Read more <i class="icon-arrow-right"></i></a></p>
                    </div>
                
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
    
</div>
<?php endif; ?>

<?php if ( ! empty($stage->clusters->wildcard) ): ?>
    <p>You have the opportunity to select wild modules in this stage</p>
<?php endif; ?>