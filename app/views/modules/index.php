<h1>Module Catalogue</h1>

<p>The Module catalogue contains information about academic modules taught at the university. <a href="<?php echo Flight::url("modules/disclaimer"); ?>">Disclaimer</a>.</p>

<div class="daedalus-tabs module_tabs">
	<ul class="nav nav-tabs">
		<li><a href="#all">All Modules</a></li>

		<?php foreach($collections as $code => $collection){ ?>
			<li><a href="#<?php echo $code;?>"><?php echo $collection['name'];?></a></li>
		<?php } ?>
	</ul>
	<div class="tab-content">
		<section id="all">
			<h2>Overview</h2>
			
			<table class="dataTable_all table table-striped" data-count="<?php echo $modules->total; ?>" data-ready="true">
				<thead>
					<tr>
						<th>Module Code</th>
						<th>Module title</th>
					</tr>
				</thead>
				<?php $n=0; foreach($modules->modules as $module){ ?>
					<tr class="<?php $n++;echo $n % 2 == 0 ? 'even' : 'odd';?> <?php echo $module->running?'running':'inactive'; ?>">
						<td><?php if($module->running){ ?><a href="<?php echo Flight::url("modules/module/".$module->sds_code); ?>"><?php echo $module->sds_code ?></a><?php }else{ echo $module->sds_code; }?></td>
						<td><?php if($module->running){ ?><a href="<?php echo Flight::url("modules/module/".$module->sds_code); ?>"><?php echo $module->title ?></a><?php }else{ echo $module->title . ' - <em>Module not currently running</em>'; }?></td>
					</tr>
				<?php } ?>	
			</table>
		</section>

		<?php foreach($collections as $code => $collection){ ?>
			<section id="<?php echo $code;?>">
			<a href='<?php echo Flight::url("modules/collection");?>' class="pull-right">Browse all collections &raquo;</a>
				<h2 id="collection_title_<?php echo $collection['collection'];?>"><?php echo $collection['name'];?></h2>


				<table class="dataTable_<?php echo $code;?> table table-striped" data-collection="<?php echo $collection['collection'];?>">
					<thead>
						<tr>
							<th>Module Code</th>
							<th>Module title</th>
						</tr>
					</thead>
					<tr>
						<td>Loading....</td>
						<td></td>
					</tr>
				</table>
			</section>
		<?php } ?>
	</div>
</div>

<?php /* hidden till we decide on images/links

<div class="row-fluid" style="clear:both;">
	<div class="span4">
		<h3>Why study at kent</h3>
		<a href="http://www.kent.ac.uk/courses/undergraduate/why/index.html"><img style="width:100%" src="http://www.kent.ac.uk/courses/menu/top/images/220x110-ug-why-2015.jpg" alt="student"></a>
		<p> Attend an Open Day of visit us when it suites you.</p>
	</div>
	<div class="span4">
		<h3>Quality Accommodation</h3>
		<a href="http://www.kent.ac.uk/courses/funding/undergraduate/index.html"><img  style="width:100%" src="http://www.kent.ac.uk/courses/menu/top/images/220x110-ug-feesfunding-2015.png" alt="students eating breakfast"></a>
		<p>Our first-class accommodation will ensure you feel at home.</p>
	</div>
	<div class="span4">
		<h3>Superb Student experience</h3>
		<a href="http://www.kent.ac.uk/courses/undergraduate/prospectus/index.html"><img  style="width:100%" src="http://www.kent.ac.uk/courses/menu/top/images/220x110-ug-brochure-2015.png" alt="2015 prospectus"></a>
		<p>Find out why our students love studying at Kent.</p>
	</div>
</div>
*/ ?>

<kentScripts>
	<script type="text/javascript" charset="utf8" src="<?php echo Flight::asset('js/build/moduletable.min.js'); ?>"></script>
<script>
	$(".module_tabs .nav a").click(function(){
		var tab_name = $(this).attr("href").substring(1);
		var table = $(".dataTable_" +  tab_name);

		// Don't double init
		if(table.attr('data-ready') == 'true') return;
		table.attr('data-ready', 'true');

		module_datatable(table, {"api_endpoint": "<?php echo KENT_API_URL;?>v1/modules/collection/" + table.attr("data-collection"), base_url: "<?php echo Flight::url('modules/module/'); ?>" });
	});

	$('body').on('click' , ".dataTables_paginate a", function(e){
		if(!$(this).closest('li').is('disabled')){
			$('html, body').animate({
				scrollTop: $(".daedalus-tabs").first().offset().top
			}, 300);
		}
	});

	// Init first table
	module_datatable($(".dataTable_all"), {"deferLoading":true, "api_endpoint": "<?php echo KENT_API_URL;?>v1/modules/collection/all", base_url: "<?php echo Flight::url('modules/module/'); ?>" });

	// Trigger click on load (if hash is in use), so tabbed tables work
	var hash = window.location.hash;
	if(hash){
		// convert #!bla to #bla
		if(hash.indexOf('#!') === 0)hash = '#'+hash.substring(2);
		$("a[href='"+hash+"']").click();
	}

 </script>
</kentScripts>