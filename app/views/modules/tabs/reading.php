<h2>Indicative reading</h2>
						<?php if (isset($module->preliminary_reading) && !empty($module->preliminary_reading)): ?>
							<p><?php echo $module->preliminary_reading; ?></p>
						<?php endif; ?>

						<?php if(isset($module->reading_lists)): ?>
							<?php foreach ($module->reading_lists as $campus => $url): ?>
								<?php if($url):?>
									<p><a href="<?php echo $url ?>">See the library reading list for this module (<?php echo ucfirst($campus); ?>)</a></p>
								<?php endif;?>
							<?php endforeach; ?>
						<?php endif; ?>