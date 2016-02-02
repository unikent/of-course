<article class="container module">
	<header>
		
		<div class="qs-search-box pull-right">
			<div class="quickspot-container">
				<label for="modulesearch" class="screenreader-only">Search modules by code or keyword</label>
				<input class="input-xlarge" id="modulesearch" type="text" name="search" placeholder="Search modules by code or keyword" autocomplete="off" tabindex="0">
				<button class="btn" name="quick-spot-search">search</button>
			</div> 
			<div class="text-right">
				<a href="<?php echo Flight::url("modules/");?>">Browse all modules</a>
			</div>
		</div>


		<h1>
			<?php echo $module->title; ?> - <?php echo $module->code; ?> (<?php echo $module->sds_code; ?>)
		</h1>

	</header>

	<div class="daedalus-tabs">
		<div class="row-fluid">
			<div class="span12">
				<ul class="nav nav-tabs">
					<?php $data_found = false; if (isset($module->synopsis) && !empty($module->synopsis)){ $data_found = true; } ?>
					<li><a href="#overview">Overview</a></li>
					<?php if ((isset($module->collections) && !empty($module->collections)) ||
								(isset($module->restrictions) && !empty($module->restrictions)) ||
								(isset($module->contact_hours) && !empty($module->contact_hours)) ||
								(isset($module->availability) && !empty($module->availability)) ||
								(isset($module->cost) && !empty($module->cost))){ $data_found = true; ?>
					<li><a href="#details">Details</a></li>
					<?php } ?>
					<?php if (isset($module->method_of_assessment) && !empty($module->method_of_assessment)){ $data_found = true; ?>
					<li><a href="#method_of_assessment">Method of assessment</a></li>
					<?php } ?>
					<?php if (isset($module->preliminary_reading) && !empty($module->preliminary_reading)){ $data_found = true; ?>
					<li><a href="#preliminary_reading">Preliminary reading</a></li>
					<?php } ?>
					<?php if (isset($module->learning_outcome) && !empty($module->learning_outcome)){ $data_found = true; ?>
					<li><a href="#learning_outcomes">Learning outcomes</a></li>
					<?php } ?>
					<?php if (isset($module->progression) && !empty($module->progression)){ $data_found = true; ?>
					<li><a href="#progression">Progression</a></li>
					<?php } ?>
					<?php if (isset($module->pre_requisite) && !empty($module->pre_requisite)){ $data_found = true; ?>
					<li><a href="#pre_requisits">Pre-requisits</a></li>
					<?php } ?>
				</ul>
			</div><!-- /span -->
		</div><!-- /row -->

		<div class="row-fluid">
			<div class="span7">
				<div class="tab-content">
					<section id="overview">
						<?php if (isset($module->synopsis) && !empty($module->synopsis)): ?>
							<h2>Overview</h2>
							<?php echo $module->synopsis; ?>
						<?php endif; ?>
						<?php if (!$data_found): ?>
							<p>Sorry, no data found for this module</p>
						<?php endif; ?>
					</section>
					<?php if ((isset($module->collections) && !empty($module->collections)) ||
								(isset($module->restrictions) && !empty($module->restrictions)) ||
								(isset($module->contact_hours) && !empty($module->contact_hours)) ||
								(isset($module->availability) && !empty($module->availability)) ||
								(isset($module->cost) && !empty($module->cost))): ?>
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
							<p><?php echo $module->restrictions ?></p>
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
					</section>
					<?php endif; ?>

					<?php if (isset($module->method_of_assessment) && !empty($module->method_of_assessment)): ?>
					<section id="method_of_assessment">
						<h2>Method of assessment</h2>
						<p><?php echo $module->method_of_assessment ?></p>
					</section>
					<?php endif; ?>

					<?php if ((isset($module->preliminary_reading) && !empty($module->preliminary_reading)) || (isset($module->reading_lists))): ?>
					<section id="preliminary_reading">
						<h2>Preliminary reading</h2>
						<?php if (isset($module->preliminary_reading) && !empty($module->preliminary_reading)): ?>
							<p><?php echo $module->preliminary_reading; ?></p>
						<?php endif; ?>

						<?php if(isset($module->reading_lists)): ?>
							<?php foreach ($module->reading_lists as $campus => $url): ?>
								<p><a href="<?php echo $url ?>">See the library reading list for this module (<?php echo ucfirst($campus); ?>)</a></p>
							<?php endforeach; ?>
						<?php endif; ?>
					</section>
					<?php endif; ?>

					<?php if (isset($module->learning_outcome) && !empty($module->learning_outcome)): ?>
					<section id="learning_outcomes">
						<h2>Learning outcomes</h2>
						<p><?php echo $module->learning_outcome; ?></p>
					</section>
					<?php endif; ?>

					<?php if (isset($module->progression) && !empty($module->progression)): ?>
					<section id="progression">
						<h2>Progression</h2>
						<p><?php echo $module->progression ?></p>
					</section>
					<?php endif; ?>

					<?php if (isset($module->pre_requisite) && !empty($module->pre_requisite)): ?>
					<section id="pre_requisits">
						<h2>Pre-requisites</h2>
						<p><?php echo $module->pre_requisite ?></p>
					</section>
					<?php endif; ?>

				</div>
			</div> <!-- /span -->
			<div class="span5">

				<div class="side-panel">
					<?php foreach ($module->deliveries as $delivery): ?>
						<?php if (!empty($delivery->delivery_sessions)): ?>
							<div class="key-facts-block tertiary-tier highlighted no-border">
								<aside class="key-facts-container">
									<h2><?php echo $delivery->campus; ?></h2>

									<div class="key-facts">
										<ul>
											<li>
												<strong>Term:</strong> <?php echo $delivery->term; ?> - <a href="<?php echo $delivery->delivery_url; ?>">View timetable</a>
											</li>
											<li><strong>Level:</strong> <a href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="<?php echo $delivery->credit_level_desc; ?>" id="level-info"><?php echo $delivery->credit_level; ?></a></li>
											<li><strong>Credits (ECTS):</strong> <?php echo $delivery->credit_amount; ?></li>
											<?php if (isset($delivery->convenor) && !empty($delivery->convenor)): ?>
												<li><strong>Convenor:</strong> <?php echo $delivery->convenor; ?></li>
											<?php endif; ?>
											<li><strong>Years:</strong> <?php echo implode(', ', array_map(function ($session){
												$to_year = intval($session) + 1;
												return $session . '-' . substr($to_year, strlen($to_year)-2); 
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
	<script src='//static.kent.ac.uk/pantheon/javascript/daedalus/quickspot.min.js' type='text/javascript'></script>
	<script>
		/** Quick search  */
		var qs = quickspot.attach({
			// Basic
			"url":"<?php echo KENT_API_URL; ?>v1/modules/collection/all/limit/9999",
			"target":"modulesearch",
			"search_on": ["title", "code", "sds_code"],
			"disable_occurrence_weighting": true,
			"prevent_headers":              true,
			"key_value": "title",
			"screenreader": true,
			"auto_highlight":true,
			"max_results": 60,
			// Extend
			"click_handler":function(itm){
				//Send em to page
				document.location = '<?php echo Flight::url("modules/module/"); ?>'+itm.code;
			},
			"display_handler": function(itm,qs){
				// Highlight searched word
				return itm.title + "<br/><span>" +itm.code + " / " + itm.sds_code +"</span>";
			},
			"no_results": function (qs, val){
				return "<a class='quickspot-result selected'>Press enter to search...</a>";
			},
			"no_results_click": function (value, qs){
				var url = "<?php echo Flight::url('modules/');?>?search=" + value;
			    window.location.href = url;
			},
			"data_pre_parse": function(data, options){
				return data.modules;
			}
		});
		// Handle button
		$('.quickspot-container button.btn').click(function(){ 
		  window.location.href = "<?php echo Flight::url('modules/');?>?search=" + $("#modulesearch").val();
		});

		$('#level-info').popover({
		    placement:'top',
		    html:true
		}).click(function(e){ e.preventDefault(); });

	</script>
</kentScripts>


