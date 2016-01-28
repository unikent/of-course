<article class="container module">
	<header>
		<h1>
			<?php echo "Module Climate"; //$module->module_title; ?> - <?php echo "AR545"; //$module->module_code; ?>
		</h1>
		<h2 class='location-header' ><?php echo 'SITSCode'; //$module->sits_code; ?></h2>
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
							<?php echo nl2br(str_replace(array('…', 'æ'), array('&hellip;', 'ae'), $module->synopsis)); ?>
						<?php else: ?>
							<?php echo 'No overview available' ?>
						<?php endif ?>
					</section>

					<section id="details">
						<h2>Details</h2>
						<?php if (isset($module->collections)): ?>
							<div class="moduleTextBlock">
								<h3>This module appears in:</h3>
								<ul>
									<?php foreach ($module->collections->collection as $collection): ?>
										<li><a href="/courses/modulecatalogue/collections/<?php echo str_replace('.xml', '', $collection->collection_url) ?>" /><?php echo $collection->collection_name ?></a></li>
									<?php endforeach ?>
								</ul>
							</div>
						<?php endif ?>

						<?php if (isset($module->restriction)): ?>
							<div class="moduleTextBlock">
								<h3>Restrictions</h3>
								<div class="moduleText">
									<?php echo $module->restriction ?>
								</div>
							</div>
						<?php endif ?>


						<?php if (isset($module->contact_hours)): ?>
							<div class="moduleTextBlock">
								<h3>Contact hours</h3>
								<div class="moduleText">
									<?php echo $module->contact_hours ?>
								</div>
							</div>
						<?php endif ?>


						<?php if (isset($module->availability)): ?>
							<div class="moduleTextBlock">
								<h3>Availability</h3>
								<div class="moduleText">
									<?php echo $module->availability ?>
								</div>
							</div>
						<?php endif ?>

						<?php if (isset($module->cost)): ?>
							<div class="moduleTextBlock">
								<h3>Cost</h3>
								<div class="moduleText">
									<?php echo $module->cost ?>
								</div>
							</div>
						<?php endif ?>
					</section>

					<section id="method_of_assessment">
						<?php //echo $module-> ; ?>
					</section>

					<section id="preliminary_reading">
						<?php //echo $module-> ; ?>
					</section>

					<section id="progression">
						<?php //echo $module-> ; ?>
					</section>

					<section id="pre_requisits">
						<?php //echo $module-> ; ?>
					</section>

				</div>
			</div> <!-- /span -->
			<div class="span5">

				<div class="side-panel">

					<div class="key-facts-block">
						<aside class="key-facts-container">
							<h2>Key facts</h2>

							<div class="key-facts">
								<ul>
									<li>
										<strong>Term:</strong> Autumn - <a href="<?php echo "//url/to/timetable" ?>">View timetable</a>
									</li>
									<li><strong>Level:</strong> <?php echo "5"; ?> </li>
									<li><strong>Credits (ECTS):</strong> <?php echo "15 (7.5)"; ?></li>
									<li><strong>Convenor:</strong> <?php echo "Dr Herbert Chinchilla"; ?></li>
									<li><strong>Years:</strong> <?php echo "2015-16, 2016-17, 2017-18"; ?></li>
								</ul>
							</div>
						</aside>
					</div>

				</div>
			</div><!-- /span -->
		</div><!-- /row -->
	</div><!-- /tabs -->



	<footer class="general_disclaimer" style='font-size:0.8em;'>
		<?php echo "Some kind of disclaimer?"; ?>
	</footer>

</article>
<kentScripts>
	<script>
		// any scripts
	</script>
</kentScripts>


