<article class="container module">
	<header>
		<h1>
			<?php echo "Module Climate"; ?> - <?php echo "AR545"; ?>
		</h1>
		<h2 class='location-header' ><?php echo 'OtherCode'; ?></h2>
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
					<section
						id="overview"><?php //Flight::render('ug_tabs/overview', array('course' => $course)); ?></section>

					<section
						id="details"><?php //Flight::render('ug_tabs/structure', array('course' => $course)); ?></section>

					<section
						id="method_of_assessment"><?php //Flight::render('ug_tabs/overview', array('course' => $course)); ?></section>

					<section
						id="preliminary_reading"><?php //Flight::render('ug_tabs/structure', array('course' => $course)); ?></section>

					<section
						id="progression"><?php //Flight::render('ug_tabs/overview', array('course' => $course)); ?></section>

					<section
						id="pre_requisits"><?php //Flight::render('ug_tabs/structure', array('course' => $course)); ?></section>

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


