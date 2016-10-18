
	<header class="content-header">
		<?php \unikent\kent_theme\kentThemeHelper::breadcrumb(array("Courses"=>"/courses/", "Modules"=>"/courses/modules", $module->title => "")); ?>

		<h1><?php echo $module->title; ?>&nbsp;-&nbsp;<?php echo $module->sds_code; ?></h1>
	</header>
	<div class="content-body ">
		<?php if(!empty($module->deliveries)){ ?>

			<div class="content-container">
				<div class="content-full">
					<table class="deliveries table ">
						<thead>
							<tr>
								<th><span class="hidden-xs">Location</span><span class="hidden-sm-up">Details</span></th>
								<th class="hidden-xs-down">Term</th>
								<th class="hidden-xs-down">Level</th>
								<th class="hidden-xs-down">Credits <a class="credits-help" href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="ECTS credits are recognised throughout the EU and allow you to transfer credit easily from one university to another">(ECTS)</a></th>
								<th class="hidden-xs-down"><a class="convenor-help" href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="This is the convenor for the current academic session">Current Convenor</a></th>
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
										<td><span class="hidden-xs-down"><?php echo $delivery->campus; ?><?php if ($delivery->module_version > 1 ){ ?><br>(version <?php echo $delivery->module_version; ?>)<?php } ?></span>
											<div class="hidden-sm-up">
												<strong>Location: </strong><?php echo $delivery->campus; ?><?php if ($delivery->module_version > 1 ){ ?> (version <?php echo $delivery->module_version; ?>)<?php } ?><br>
												<strong>Term: </strong><?php echo $delivery->term; ?> <a href="<?php echo $delivery->delivery_url; ?>" title="View Timetable"><small>View Timetable</small></a><br>
												<strong>Level: </strong><a href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="<?php echo $delivery->credit_level_desc; ?>" id="level-info"><?php echo $delivery->credit_level; ?></a><br>
												<strong>Credits <a class="credits-help" href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="ECTS credits are recognised throughout the EU and allow you to transfer credit easily from one university to another">(ECTS)</a>: </strong><?php echo $delivery->credit_amount; ?><br>
												<strong><a class="convenor-help" href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="This is the convenor for the current academic session">Current Convenor</a>: </strong><?php echo $delivery->convenor; ?><br>
											</div>
										</td>
										<td class="hidden-xs-down"><?php echo $delivery->term; ?><br><a href="<?php echo $delivery->delivery_url; ?>" title="View Timetable"><small>View Timetable</small></a></td>
										<td class="hidden-xs-down"><a href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="<?php echo $delivery->credit_level_desc; ?>" id="level-info"><?php echo $delivery->credit_level; ?></a></td>
										<td class="hidden-xs-down"><?php echo $delivery->credit_amount; ?></td>
										<td class="hidden-xs-down"><?php echo $delivery->convenor; ?></td>
										<td class="text-center"><i class="kf-<?php echo in_array($module->year,$delivery->delivery_sessions)?'check':'close';?>"></i></td>
										<td class="text-center"><i class="kf-<?php echo in_array($module->year+1,$delivery->delivery_sessions)?'check':'close';?>"></i></td>
									</tr>
									<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>

				<div class="content-full">
					<p class="kf-exclamation-circle session-info"><em>Information below is for the <strong><?php echo $module->year-1 . '-' . substr($module->year, 2);  ?></strong> session.</em></p>
				</div>
			</div>
			<div class="content-container relative">
				<div class="content-aside top-sidebar">
					<ul class="nav nav-tabs-vertical" role="tablist">
						 <?php $data_found = false; if (isset($module->synopsis) && !empty($module->synopsis)){ $data_found = true; } ?>
						<li class="nav-item"><a href="#overview"  data-toggle="tab" role="tab" class="nav-link active">Overview</a></li>
						<?php if ((isset($module->collections) && !empty($module->collections)) ||
									(isset($module->restrictions) && !empty($module->restrictions)) ||
									(isset($module->contact_hours) && !empty($module->contact_hours)) ||
									(isset($module->availability) && !empty($module->availability)) ||
									(isset($module->cost) && !empty($module->cost))){ $data_found = true; ?>
						<li class="nav-item"><a href="#details" data-toggle="tab" role="tab" class="nav-link">Details</a></li>
						<?php } ?>
						<?php if (isset($module->method_of_assessment) && !empty($module->method_of_assessment)){ $data_found = true; ?>
						<li class="nav-item"><a href="#method_of_assessment"  data-toggle="tab" role="tab" class="nav-link">Method of assessment</a></li>
						<?php } ?>
						<?php if (isset($module->preliminary_reading) && !empty($module->preliminary_reading)){ $data_found = true; ?>
						<li class="nav-item"><a href="#preliminary_reading" data-toggle="tab" role="tab" class="nav-link">Preliminary reading</a></li>
						<?php } ?>
						<?php if (isset($module->learning_outcome) && !empty($module->learning_outcome)){ $data_found = true; ?>
						<li class="nav-item"><a href="#learning_outcomes" data-toggle="tab" role="tab" class="nav-link">Learning outcomes</a></li>
						<?php } ?>
						<?php if (isset($module->progression) && !empty($module->progression)){ $data_found = true; ?>
						<li class="nav-item"><a href="#progression" data-toggle="tab" role="tab" class="nav-link">Progression</a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="content-main">
					<div class="tab-content">
						
						<?php
						 	Flight::render("partials/tab", array("title"=>"Overview", "id" => "overview", "selected" => true, "content" => Flight::fetch("modules/tabs/overview", array("data_found"=>$data_found))));

							if ((isset($module->collections) && !empty($module->collections)) ||
								(isset($module->contact_hours) && !empty($module->contact_hours)) ||
								(isset($module->availability) && !empty($module->availability)) ||
								(isset($module->cost) && !empty($module->cost))){
								Flight::render("partials/tab", array("title"=>"Details", "id" => "details", "selected" => false, "content" => Flight::fetch("modules/tabs/details")));
							}
						 	if (isset($module->method_of_assessment) && !empty($module->method_of_assessment)){
								Flight::render("partials/tab", array("title"=>"Method Of Assessment", "id" => "method_of_assessment", "selected" => false, "content" => Flight::fetch("modules/tabs/method"))); 
							}
							if ((isset($module->preliminary_reading) && !empty($module->preliminary_reading)) || (isset($module->reading_lists))){
								Flight::render("partials/tab", array("title"=>"Preliminary reading", "id" => "preliminary_reading", "selected" => false, "content" => Flight::fetch("modules/tabs/reading"))); 
							}
							if (isset($module->learning_outcome) && !empty($module->learning_outcome)){
							 Flight::render("partials/tab", array("title"=>"Learning outcomes", "id" => "learning_outcomes", "selected" => false, "content" => Flight::fetch("modules/tabs/learning")));
							}
							if (isset($module->progression) && !empty($module->progression)){
								Flight::render("partials/tab", array("title"=>"Progression", "id" => "progression", "selected" => false, "content" => Flight::fetch("modules/tabs/progression"))); 
							}
						
						?>
					</div>
				</div>
				<div class="content-aside" style="margin-top:15rem;">
					<h3 class="kf-check-circle">Pre-requisites</h3>
					<p><?php echo empty($module->pre_requisite)?'None':$module->pre_requisite; ?></p>
			
					<h3 class="kf-exclamation-circle">Restrictions</h3>
					<p><?php echo empty($module->restrictions)?'None':$module->restrictions; ?></p>
				</div>
		</div>

			<script>
	window.addEventListener("load", function(){
		$('#level-info, .credits-help, .convenor-help').popover({
		    placement:'top',
		    html:true
		}).click(function(e){
			e.preventDefault();
			$('#level-info, .credits-help').not(this).popover('hide');
		});
	},false);
		

	</script>
		<div class="content-container p-t-2">
			<small class="content-full">
				University of Kent makes every effort to ensure that module information is accurate for the relevant academic session and to provide educational services as described. However, courses, services and other matters may be subject to change. <a href="https://www.kent.ac.uk/termsandconditions/">Please read our full disclaimer</a>.
			</small>

		</div>
</div>

	<?php } else { ?>
		<p>Sorry, this module isn't running currently.</p>
	<?php } ?>
