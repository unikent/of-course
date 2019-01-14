	<h2>Details</h2>
	<?php if (isset($module->collections) && !empty($module->collections)): ?>
							<h3>This module appears in:</h3>
							<ul>
								<?php foreach ($module->collections as $collection): ?>
									<li><a href="<?php echo Flight::url("modules/collection/{$collection->code}"); ?>" /><?php echo $collection->title ?></a></li>
								<?php endforeach ?>
							</ul>
							<br>
						<?php endif; ?>

						<?php if (isset($module->contact_hours) && !empty($module->contact_hours)): ?>
							<h3>Contact hours</h3>
							<p><?php echo $module->contact_hours ?></p>
						<?php endif; ?>


						<?php if (isset($module->availability) && !empty($module->availability)): ?>
							<h3>Availability</h3>
							<p><?php echo $module->availability ?></p>
						<?php endif; ?>

						<?php if (isset($module->cost) && !empty($module->cost)): ?>
							<h3>Cost</h3>
							<p><?php echo $module->cost ?></p>
						<?php endif; ?>