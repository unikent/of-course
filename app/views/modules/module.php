<article class="container module">
	<header>
		<div class="row-fluid">
			<div class="span7">
				<h1>
					<?php echo $module->title; ?> - <?php echo $module->code; ?> (<?php echo $module->sds_code; ?>)
				</h1>
			</div>
			<div class="span5">
				<div class="search_box pull-left">
					<div class="quickspot-container panel">
						<label for="modulesearch" class="screenreader-only">Search modules by code or keyword</label>
						<input class="input-xlarge" id="modulesearch" type="text" name="search" placeholder="Search modules by code or keyword" autocomplete="off" tabindex="0">
						<button class="btn" name="quick-spot-search">search</button>
						<div class="quickspot-results" tabindex="100" style="display: none;"></div>
					</div>  

				</div>
			</div>
		</div>
	</header>

	<div class="daedalus-tabs">
		<div class="row-fluid">
			<div class="span12">
				<ul class="nav nav-tabs">
					<li><a href="#overview">Overview</a></li>
					<li><a href="#details">Details</a></li>
					<?php if (isset($module->method_of_assessment) && !empty($module->method_of_assessment)): ?>
					<li><a href="#method_of_assessment">Method of assessment</a></li>
					<?php endif; ?>
					<?php if (isset($module->preliminary_reading) && !empty($module->preliminary_reading)): ?>
					<li><a href="#preliminary_reading">Preliminary reading</a></li>
					<?php endif; ?>
					<?php if (isset($module->learning_outcome) && !empty($module->learning_outcome)): ?>
					<li><a href="#learning_outcomes">Learning outcomes</a></li>
					<?php endif; ?>
					<?php if (isset($module->progression) && !empty($module->progression)): ?>
					<li><a href="#progression">Progression</a></li>
					<?php endif; ?>
					<?php if (isset($module->pre_requisite) && !empty($module->pre_requisite)): ?>
					<li><a href="#pre_requisits">Pre-requisits</a></li>
					<?php endif; ?>
				</ul>
			</div>
			<!-- /span -->
		</div><!-- /row -->

		<div class="row-fluid">
			<div class="span7">
				<div class="tab-content">
					<section id="overview">
						<h2>Overview</h2>
						<?php if (isset($module->synopsis) && !empty($module->synopsis)): ?>
							<?php echo $module->synopsis; ?>
						<?php else: ?>
							<?php echo 'No overview available' ?>
						<?php endif; ?>
					</section>

					<section id="details">
						<h2>Details</h2>
						<?php if (isset($module->collections) && !empty($module->collections)): ?>
							<h3>This module appears in:</h3>
							<ul>
								<?php foreach ($module->collections as $collection): ?>
									<li><a href="<?php echo Flight::url("modules/collection/{$collection->code}"); ?>" /><?php echo $collection->title ?></a></li>
								<?php endforeach ?>
							</ul>
						<?php endif; ?>

						<?php if (isset($module->restrictions) && !empty($module->restrictions)): ?>
							<h3>Restrictions</h3>
							<p>
								<?php echo $module->restrictions ?>
							</p>
						<?php endif; ?>


						<?php if (isset($module->contact_hours) && !empty($module->contact_hours)): ?>
							<h3>Contact hours</h3>
							<p>
								<?php echo $module->contact_hours ?>
							</p>
						<?php endif; ?>


						<?php if (isset($module->availability) && !empty($module->availability)): ?>
							<h3>Availability</h3>
							<p>
								<?php echo $module->availability ?>
							</p>
						<?php endif; ?>

						<?php if (isset($module->cost) && !empty($module->cost)): ?>
							<h3>Cost</h3>
							<p>
								<?php echo $module->cost ?>
							</p>
						<?php endif; ?>
					</section>

					<section id="method_of_assessment">
						<h2>Method of assessment</h2>
						<p>
							<?php if (isset($module->method_of_assessment) && !empty($module->method_of_assessment)): ?>
								<?php echo $module->method_of_assessment ?>
							<?php else: ?>
								<?php echo 'No information available' ?>
							<?php endif; ?>
						</p>
					</section>

					<section id="preliminary_reading">
						<h2>Preliminary reading</h2>
						<?php if (isset($module->preliminary_reading) && !empty($module->preliminary_reading)): ?>
							<p>
								<?php echo $module->preliminary_reading; ?>
							</p>
						<?php else: ?>
							<p>No preliminary reading available</p>
						<?php endif; ?>

						<?php if(isset($module->reading_lists)): ?>
							<?php foreach ($module->reading_lists as $campus => $url): ?>
								<p><a href="<?php echo $url ?>">See the library reading list for this module (<?php echo ucfirst($campus); ?>)</a></p>
							<?php endforeach; ?>
						<?php endif; ?>
					</section>

					<section id="learning_outcomes">
						<h2>Learning outcomes</h2>
						<?php if (isset($module->learning_outcome) && !empty($module->learning_outcome)): ?>
									<p><?php echo $module->learning_outcome; ?></p>
						<?php else: ?>
							<?php echo 'No information available' ?>
						<?php endif; ?>
					</section>

					<section id="progression">
						<h2>Progression</h2>
						<?php if (isset($module->progression) && !empty($module->progression)): ?>
							<p>
								<?php echo $module->progression ?>
							</p>
						<?php else: ?>
							<?php echo 'No progression information available' ?>
						<?php endif; ?>
					</section>

					<section id="pre_requisits">
						<h2>Pre-requisites</h2>
						<p>
							<?php if (isset($module->pre_requisite) && !empty($module->pre_requisite)): ?>
								<?php echo $module->pre_requisite ?>
							<?php else: ?>
								<?php echo 'No pre-requisites' ?>
							<?php endif; ?>
						</p>
					</section>

				</div>
			</div> <!-- /span -->
			<div class="span5">

				<div class="side-panel">
					<?php foreach ($module->deliveries as $delivery): ?>
						<?php if (array_reduce((array)$delivery->delivery_sessions, function ($carry, $session){
							return $carry || $session->running;
						}, false)): ?>
							<div class="key-facts-block">
								<aside class="key-facts-container">
									<h2><?php echo $delivery->campus; ?></h2>

									<div class="key-facts">
										<ul>
											<li>
												<strong>Term:</strong> <?php echo $delivery->term; ?> - <a href="<?php echo $delivery->delivery_url; ?>">View timetable</a>
											</li>
											<li><strong>Level:</strong> <?php echo $delivery->credit_level; ?> </li>
											<li><strong>Credits (ECTS):</strong> <?php echo $delivery->credit_amount; ?></li>
											<?php if (isset($delivery->convenor) && !empty(trim($delivery->convenor))): ?>
												<li><strong>Convenor:</strong> <?php echo $delivery->convenor; ?></li>
											<?php endif; ?>
											<li><strong>Years:</strong> <?php echo implode(', ', array_map(function ($session){
												$to_year = intval($session->session_code) + 1;
												return $session->session_code . '-' . substr($to_year, strlen($to_year)-2); 
											}, (array)$delivery->delivery_sessions));?></li>
										</ul>
									</div>
								</aside>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div><!-- /span -->
		</div><!-- /row -->
	</div><!-- /tabs -->

</article>
<kentScripts>
	<script>
		// any scripts
	</script>
</kentScripts>


