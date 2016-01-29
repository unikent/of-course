<article class="container module">
	<header>
		<div class="row-fluid">
			<div class="span7">
				<h1>
					<?php echo $module->title; ?> - <?php echo $module->sds_code; ?>
				</h1>
				<h2 class='location-header' ><?php echo $module->code; ?></h2>
			</div>
			<div class="span5">
				Search box
			</div>
		</div>
	</header>

	<div class="daedalus-tabs">
		<div class="row-fluid">
			<div class="span12">
				<ul class="nav nav-tabs">
					<li><a href="#overview">Overview</a></li>
					<li><a href="#details">Details</a></li>
					<li><a href="#method_of_assessment">Method of assessment</a></li>
					<li><a href="#preliminary_reading">Preliminary reading</a></li>
					<li><a href="#progression">Progression</a></li>
					<li><a href="#pre_requisits">Pre-requisits</a></li>
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
						<?php endif ?>
					</section>

					<section id="details">
						<h2>Details</h2>
						<?php if (isset($module->collections)): ?>
							<h3>This module appears in:</h3>
							<ul>
								<?php foreach ($module->collections as $collection): ?>
									<li><a href="<?php echo Flight::url("modules/collections/{$collection->code}"); ?>" /><?php echo $collection->title ?></a></li>
								<?php endforeach ?>
							</ul>
						<?php endif ?>

						<?php if (isset($module->restrictions) && !empty($module->restrictions)): ?>
							<h3>Restrictions</h3>
							<p>
								<?php echo $module->restrictions ?>
							</p>
						<?php endif ?>


						<?php if (isset($module->contact_hours) && !empty($module->contact_hours)): ?>
							<h3>Contact hours</h3>
							<p>
								<?php echo $module->contact_hours ?>
							</p>
						<?php endif ?>


						<?php if (isset($module->availability) && !empty($module->availability)): ?>
							<h3>Availability</h3>
							<p>
								<?php echo $module->availability ?>
							</p>
						<?php endif ?>

						<?php if (isset($module->cost) && !empty($module->cost)): ?>
							<h3>Cost</h3>
							<p>
								<?php echo $module->cost ?>
							</p>
						<?php endif ?>
					</section>

					<section id="method_of_assessment">
						<h2>Method of assessment</h2>
						<p>
							<?php if (isset($module->method_of_assessment) && !empty($module->method_of_assessment)): ?>
								<?php echo $module->method_of_assessment ?>
							<?php else: ?>
								<?php echo 'No information available' ?>
							<?php endif ?>
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

					<section id="progression">
						<h2>Progression</h2>
						<?php if (isset($module->progression) && !empty($module->progression)): ?>
							<p>
								<?php echo $module->progression ?>
							</p>
						<?php else: ?>
							<?php echo 'No progression information available' ?>
						<?php endif ?>
					</section>

					<section id="pre_requisits">
						<h2>Pre-requisites</h2>
						<p>
							<?php if (isset($module->pre_requisite) && !empty($module->pre_requisite)): ?>
								<?php echo $module->pre_requisite ?>
							<?php else: ?>
								<?php echo 'No pre-requisites' ?>
							<?php endif ?>
						</p>
					</section>

				</div>
			</div> <!-- /span -->
			<div class="span5">

				<div class="side-panel">
					<?php foreach ($module->deliveries as $delivery): ?>
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
										<li><strong>Convenor:</strong> <?php echo $delivery->convenor; ?></li>
										<li><strong>Years:</strong> <?php echo implode(', ', array_map((array)$delivery->delivery_sessions, function ($session)
										{
											return $session->session_code; 
										}));?></li>
									</ul>
								</div>
							</aside>
						</div>
					<?php endforeach; ?>
				</div>
			</div><!-- /span -->
		</div><!-- /row -->
	</div><!-- /tabs -->



	<footer class="general_disclaimer" style='font-size:0.8em;'>
		<?php// echo "Some kind of disclaimer?"; ?>
	</footer>

</article>
<kentScripts>
	<script>
		// any scripts
	</script>
</kentScripts>


