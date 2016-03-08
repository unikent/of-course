<h1>Module Catalogue</h1>

<p>The Module catalogue contains information about academic modules taught at the university.</p>

<div class="daedalus-tabs module_tabs">
	<ul class="nav nav-tabs">
		<li><a href="#all">All Modules</a></li>

		<?php foreach($collections as $code => $collection){ ?>
			<li><a href="#<?php echo $code;?>"><?php echo $collection['name'];?></a></li>
		<?php } ?>
	</ul>
	<div class="tab-content">
		<section id="all">
			<div class="advanced-search-boxes">
				<div class="advanced-search-filters">
					<div class="search-filter">
						<span>Filter by: </span><input class="advanced-text-search" type="text" placeholder="keyword">
					</div>
					<div class="search-select subject-search-div">
						<select class="subject-search input-large " data-col="4">
							<option value="">All subjects</option>
							<?php foreach ($subjects as $k => $v){
								?>
							<option value="<?php echo $k; ?>"><?php echo $v; ?></option>
							<?php
							}?>
						</select>
					</div>
				</div>

			</div>

			<table class="dataTable_all table table-striped" data-ready="true">
				<thead>
					<tr>
						<th>Module Code</th>
						<th>Module title</th>
						<th class="hide">Sort-key</th>
						<th class="hide">Sort</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</section>

		<?php foreach($collections as $code => $collection){ ?>
			<section id="<?php echo $code;?>">

				<h2 id="collection_title_<?php echo $collection['collection'];?>"><?php echo $collection['name'];?></h2>

				<div class="advanced-search-boxes">
					<div class="advanced-search-filters">
						<div class="search-filter">
							<span>Filter by: </span><input class="advanced-text-search" type="text" placeholder="keyword">
						</div>
						<div class="search-select subject-search-div">
							<select class="subject-search input-large " data-col="4">
								<option value="">All subjects</option>
								<?php foreach ($subjects as $k => $v){
									?>
									<option value="<?php echo $k; ?>"><?php echo $v; ?></option>
									<?php
								}?>
							</select>
						</div>
					</div>

				</div>
				<table class="dataTable_<?php echo $code;?> table table-striped" data-collection="<?php echo $collection['collection'];?>">
					<thead>
						<tr>
							<th>Module Code</th>
							<th>Module title</th>
							<th class="hide">Sort-key</th>
							<th class="hide">Sort</th>
						</tr>
					</thead>
					<tr>
						<td>Loading....</td>
						<td></td>
						<td class="hide"></td>
						<td class="hide"></td>
					</tr>
				</table>
			</section>
		<?php } ?>
	</div>
</div>
<br>
<small>The University of Kent makes every effort to ensure that module information is accurate for the relevant academic session and to provide educational services as described. However, courses, services and other matters may be subject to change. <a href="https://www.kent.ac.uk/termsandconditions/">Please read our full disclaimer</a>.</small>

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
	<script type="text/javascript" charset="utf-8" src="<?php echo Flight::asset('js/build/moduletable.min.js'); ?>"></script>
	<script type="text/javascript" charset="utf-8">
		var all_modules = <?php echo json_encode(array_values((array)$modules->modules)); ?>;
	</script>
<script>

	var module_list_data = {};

	$(".module_tabs .nav a").click(function(){
		var tab_name = $(this).attr("href").substring(1);
		var table = $(".dataTable_" +  tab_name);

		// Don't double init
		if(table.attr('data-ready') == 'true') return;
		table.attr('data-ready', 'true');

		module_datatable(table, {"api_endpoint": "<?php echo KENT_API_URL;?>v1/modules/collection/" + table.attr("data-collection"), base_url: "<?php echo Flight::url('modules/module/'); ?>",keyword_filter:$('#' + tab_name + ' .advanced-text-search:first'),subject_filter:$('#' + tab_name + ' .subject-search:first'),id:tab_name });
	});

	// Init first table
	module_datatable($(".dataTable_all"), {"data": all_modules, "api_endpoint": "<?php echo KENT_API_URL;?>v1/modules/collection/all", base_url: "<?php echo Flight::url('modules/module/'); ?>",keyword_filter:$('#all .advanced-text-search:first'),subject_filter:$('#all .subject-search:first'),id:'all'});

	// Trigger click on load (if hash is in use), so tabbed tables work
	var hash = window.location.hash;
	if(hash){
		// convert #!bla to #bla
		if(hash.indexOf('#!') === 0)hash = '#'+hash.substring(2);
		$("a[href='"+hash+"']").click();
	}

 </script>
</kentScripts>