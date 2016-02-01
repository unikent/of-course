<?php if ( ! empty($stage->clusters->compulsory) || ! empty($stage->clusters->optional) ): ?> 
<?php $module_codes = array(); ?>
<p>Possible modules may include: </p>

    <?php if(isset($stage->clusters->compulsory)): ?>
        <?php foreach ($stage->clusters->compulsory as $cluster): ?>
            <?php foreach ($cluster->modules->module as $module): ?>
                <?php if ( ! empty($module->module_code) && ! empty($module->module_title) && ! in_array($module->module_code, $module_codes) ): ?>
                    <?php $module_codes[$module->module_code] = $module->module_code ?>
                    <div class="daedalus-show-hide show-hide minimal">
                        <p class="show-hide-title"><?php echo $module->module_code ?> - <?php echo $module->module_title ?> (<?php echo $module->credit_amount; ?> credits)</p>
                        
                        <div class="show-hide-content">
                            <p><?php echo $module->synopsis ?></p>
							<p><strong>Also Known as:</strong> <?php echo $module->sds_code; ?></p>
                            <p><strong>Credits:</strong> <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS credits).</p>
                            <p class="module-read-more"><a href="http://www.kent.ac.uk/courses/modules/module/<?php echo $module->module_code ?>">Read more <i class="icon-arrow-right"></i></a></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if(isset($stage->clusters->optional)): ?>
        <?php foreach ($stage->clusters->optional as $cluster): ?>
            <?php foreach ($cluster->modules->module as $module): ?>
                <?php if ( ! empty($module->module_code) && ! in_array($module->module_code, $module_codes) ): ?>
                    <?php $module_codes[$module->module_code] = $module->module_code ?>
                    <div class="daedalus-show-hide show-hide minimal">
                        <p class="show-hide-title"><?php echo $module->module_code ?> - <?php echo $module->module_title ?> (<?php echo $module->credit_amount; ?> credits)</p>
                        
                        <div class="show-hide-content">
                            <p><?php echo $module->synopsis ?></p>
							<p><strong>Also Known as:</strong> <?php echo $module->sds_code; ?></p>
                            <p><strong>Credits:</strong> <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS credits).</p>
                            <p class="module-read-more"><a href="http://www.kent.ac.uk/courses/modules/module/<?php echo $module->module_code ?>">Read more <i class="icon-arrow-right"></i></a></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>

<?php if ( ! empty($stage->clusters->wildcard) ): ?>
    <p>You have the opportunity to select wild modules in this stage</p>
<?php endif; ?>