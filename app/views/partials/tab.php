<h3 class="tab-title hidden-md-up" data-toggle="collapse_responsive" data-target="#<?php echo $id; ?>" aria-controls="<?php echo $id; ?>" data-parent=".tab-content"><?php echo $title; ?></h3>
<section id="<?php echo $id; ?>" class="p-a-0 tab-pane fade <?php if(isset($selected) && $selected === true): ?>in active<?php endif; ?> collapse-sm-down" role="tabpanel"><?php echo $content; ?></section>