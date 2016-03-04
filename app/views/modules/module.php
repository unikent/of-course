<article class="container module">
	<header>
		
		<div class="qs-search-box pull-right">
			<select id="subject-search" class=" input-large">
				<option value="">All subjects</option>
				<?php foreach ($subjects as $k => $v){
					?>
					<option value="<?php echo $k; ?>"><?php echo $v; ?></option>
					<?php
				}?>
			</select>
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
			<?php echo $module->title; ?> - <?php echo $module->sds_code; ?>
		</h1>

	</header>
	<?php if(!empty($module->deliveries)){
	?>
	<div class="clearfix"></div>
	<table class="deliveries table table-striped">
	<thead>
		<tr>
			<th><span class="hidden-phone">Location</span><span class="visible-phone">Details</span></th>
			<th class="hidden-phone">Term</th>
			<th class="hidden-phone">Level</th>
			<th class="hidden-phone">Credits <a class="credits-help" href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="ECTS credits are recognised throughout the EU and allow you to transfer credit easily from one university to another">(ECTS)</a></th>
			<th class="hidden-phone">Current Convenor</th>
			<th><?php echo $module->year-1 . '-' . substr($module->year, 2);  ?></th>
			<th><?php echo $module->year . '-' . substr($module->year+1, 2);  ?></th>
		</tr>
	</thead>
		<tbody>
		<?php
		foreach ($module->deliveries as $delivery){
			if (!empty($delivery->delivery_sessions)){
				?>
				<tr class="delivery">
					<td><span class="hidden-phone"><?php echo $delivery->campus; ?><?php if ($delivery->module_version > 1 ){ ?><br>(version <?php echo $delivery->module_version; ?>)<?php } ?></span>
						<div class="visible-phone">
							<strong>Location: </strong><?php echo $delivery->campus; ?><?php if ($delivery->module_version > 1 ){ ?> (version <?php echo $delivery->module_version; ?>)<?php } ?><br>
							<strong>Term: </strong><?php echo $delivery->term; ?> <a href="<?php echo $delivery->delivery_url; ?>" title="View Timetable"><small>View Timetable</small></a><br>
							<strong>Level: </strong><a href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="<?php echo $delivery->credit_level_desc; ?>" id="level-info"><?php echo $delivery->credit_level; ?></a><br>
							<strong>Credits <a class="credits-help" href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="ECTS credits are recognised throughout the EU and allow you to transfer credit easily from one university to another">(ECTS)</a>: </strong><?php echo $delivery->credit_amount; ?><br>
							<strong>Current Convenor: </strong><?php echo $delivery->convenor; ?><br>
						</div>
					</td>
					<td class="hidden-phone"><?php echo $delivery->term; ?><br><a href="<?php echo $delivery->delivery_url; ?>" title="View Timetable"><small>View Timetable</small></a></td>
					<td class="hidden-phone"><a href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="<?php echo $delivery->credit_level_desc; ?>" id="level-info"><?php echo $delivery->credit_level; ?></a></td>
					<td class="hidden-phone"><?php echo $delivery->credit_amount; ?></td>
					<td class="hidden-phone"><?php echo $delivery->convenor; ?></td>
					<td class="text-center"><i class="kf-<?php echo in_array($module->year,$delivery->delivery_sessions)?'check':'close';?>"></i></td>
					<td class="text-center"><i class="kf-<?php echo in_array($module->year+1,$delivery->delivery_sessions)?'check':'close';?>"></i></td>
				</tr>
				<?php
			}
		}
		?>
		</tbody>
	</table>

		<p><em>Information below is for the <strong><?php echo $module->year-1 . '-' . substr($module->year, 2);  ?></strong> session.</em></p>
	<?php
	}
	?>
	<?php if (!empty($module->deliveries)): ?>
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

				</div>
			</div> <!-- /span -->
			<div class="span5">

				<div class="side-panel">
					<div class="key-facts-block tertiary-tier highlighted no-border">
						<aside class="key-facts-container">
							<h2>Pre-requisites</h2>
							<p><?php echo empty($module->pre_requisite)?'None':$module->pre_requisite; ?></p>
						</aside>
					</div>
					<div class="key-facts-block tertiary-tier highlighted no-border">
						<aside class="key-facts-container">
							<h2>Restrictions</h2>
							<p><?php echo empty($module->restrictions)?'None':$module->restrictions; ?></p>
						</aside>
					</div>
				</div>
			</div><!-- /span -->
		</div><!-- /row -->
	</div><!-- /tabs -->

	<br>
	<small>The University of Kent makes every effort to ensure that module information is accurate for the relevant academic session and to provide educational services as described. However, courses, services and other matters may be subject to change. <a href="https://www.kent.ac.uk/termsandconditions/">Please read our full disclaimer</a>.</small>


	<?php else: ?>
	<p>Sorry, this module isn't running currently.</p>
	<?php endif; ?>
</article>
<kentScripts>
	<script src='//static.kent.ac.uk/pantheon/javascript/daedalus/quickspot.min.js' type='text/javascript'></script>
	<script>
		/** Quick search  */
		var qs = quickspot.attach({
			// Basic
			"url":"<?php echo KENT_API_URL; ?>v1/modules/collection/all",
			"target":"modulesearch",
			"search_on": ["title", "sds_code"],
			"disable_occurrence_weighting": true,
			"prevent_headers":              true,
			"key_value": "title",
			"screenreader": true,
			"auto_highlight":true,
			"max_results": 60,
			// Extend
			"click_handler":function(itm){
				//Send em to page
				document.location = '<?php echo Flight::url("modules/module/"); ?>'+itm.sds_code;
			},
			"display_handler": function(itm,qs){
				// Highlight searched word
				return itm.title + "<br/><span>" + itm.sds_code +"</span>";
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
			},
			"loaded":function(){
				var val = $('#subject-search').val();

				qs.datastore.filter(function(o){return o.running===true && (val.length > 0 ? o.sds_code.indexOf(val) === 0 : true ) });
				$('#subject-search').change(function(){
					var val = $('#subject-search').val();
					qs.datastore.clear_filters();
					qs.datastore.filter(function(o){return o.running===true && (val.length > 0 ? o.sds_code.indexOf(val) === 0 : true ) });
				});

			}
		});

		// Handle button
		$('.quickspot-container button.btn').click(function(){
		  window.location.href = "<?php echo Flight::url('modules/');?>?search=" + $("#modulesearch").val();
		});

		$('#level-info, .credits-help').popover({
		    placement:'top',
		    html:true
		}).click(function(e){
			e.preventDefault();
			$('#level-info, .credits-help').not(this).popover('hide');
		});


	</script>
</kentScripts>


