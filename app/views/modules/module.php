
	<header class="content-header">

		<div class="module-search">
            <form class="quickspot-container" action="/search">
                <div class="form-group">
                    <label for="module-search" class="sr-only">Search modules</label>
                    <div class="input-group input-group-lg">
                        <input type="search" name="q" class="form-control" id="module-search" placeholder="Search modules..." autocomplete="off" data-quickspot-config="modules" data-quickspot-target="quickspot-results-container">
                        <span class="input-group-btn">
							<button type="submit" class="btn btn-accent btn-icon">
								<span class="sr-only">Search modules</span>
								<span class="kf-fw kf-search"></span>
							</button>
						</span>
                    <div aria-live="assertive" aria-relevant="additions" class="screenreader" style="position: absolute!important; clip: rect(1px 1px 1px 1px); clip: rect(1px,1px,1px,1px);"></div></div>
                    <div id="quickspot-results-container" tabindex="100" class="quickspot-results-container quickspot-results-container" style="display: none;" aria-hidden="true"><div class="quickspot-results"></div></div>
				</div>
            </form>
        </div>

		<?php \unikent\kent_theme\kentThemeHelper::breadcrumb(array("Courses"=>"/courses/", "Modules"=>"/courses/modules", $module->title => "")); ?>

		<h1><?php echo $module->title; ?>&nbsp;-&nbsp;<?php echo $module->sds_code; ?></h1>
	</header>
	<div class="content-body ">
		<?php if(!empty($module->deliveries)){ ?>

			<div class="content-container">
				<div class="content-full">
					<div class="panel panel-primary-tint mb-2 table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Location</th>
								<th>Term</th>
								<th>Level</th>
								<th>Credits <a class="credits-help" href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="ECTS credits are recognised throughout the EU and allow you to transfer credit easily from one university to another">(ECTS)</a></th>
								<th><a class="convenor-help" href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="This is the convenor for the current academic session">Current Convenor</a></th>
								<th><?php echo $module->year-1 . '-' . substr($module->year, 2);  ?></th>
								<th><?php echo $module->year . '-' . substr($module->year+1, 2);  ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($module->deliveries as $delivery){
								if (!empty($delivery->delivery_sessions)){
									?>
									<tr>
										<td><span><?php echo $delivery->campus; ?><?php if ($delivery->module_version > 1 ){ ?><br>(version <?php echo $delivery->module_version; ?>)<?php } ?></span></td>
										<td><?php echo $delivery->term; ?><br><a href="<?php echo $delivery->delivery_url; ?>" title="View Timetable"><small>View Timetable</small></a></td>
										<td><a href="#" data-toggle="popover" data-trigger="focus" tabindex="0" role="button" data-content="<?php echo $delivery->credit_level_desc; ?>" id="level-info"><?php echo $delivery->credit_level; ?></a></td>
										<td><?php echo $delivery->credit_amount; ?></td>
										<td><?php echo $delivery->convenor; ?></td>
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
				</div>

				<style>

				</style>

				<div class="content-full key-info">
					<div class="col-md-4">
						<h3 class="kf-check-circle">Pre-requisites</h3>
						<p><?php echo empty($module->pre_requisite)?'None':$module->pre_requisite; ?></p>
					</div>
					<div class="col-md-4">
						<h3 class="kf-exclamation-circle">Restrictions</h3>
						<p><?php echo empty($module->restrictions)?'None':$module->restrictions; ?></p>
						</div>
					<div class="col-md-4">
						<h3 class="kf-info-circle">Session</h3>
						<p><em>Information below is for the <strong><?php echo $module->year-1 . '-' . substr($module->year, 2);  ?></strong> session.</em></p>
					</div>

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
		<div class="content-container pt-1">
			<div class="content-full">
				<small>
					University of Kent makes every effort to ensure that module information is accurate for the relevant academic session and to provide educational services as described. However, courses, services and other matters may be subject to change. <a href="https://www.kent.ac.uk/termsandconditions/">Please read our full disclaimer</a>.
				</small>
			</div>

		</div>
</div>

	<?php } else { ?>
		<p>Sorry, this module isn't running currently.</p>
	<?php } ?>
