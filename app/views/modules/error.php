<style>
	.qs-search-box .quickspot-container .quickspot-results{
		width: 95%;
	}
</style>
<div class="container">

	<h1><?php echo $error; ?></h1>

	<?php if (empty($collections)){ ?>
	<h2>Search all Modules</h2>

	<div class="qs-search-box">
		<div class="quickspot-container">
			<label for="modulesearch" class="screenreader-only">Search modules by code or keyword</label>
			<input class="input-xlarge" style="width: 95%" id="modulesearch" type="text" name="search" placeholder="Search modules by code or keyword" autocomplete="off" tabindex="0">
			<button class="btn" name="quick-spot-search">search</button>
		</div>
		<div class="text-right">
			<a href="<?php echo Flight::url("modules/");?>">Browse all modules</a>
		</div>
	</div>
	<?php }else{ ?>
		<h2>Collections</h2>

		<ul>
			<?php foreach($collections as $code => $collection){ ?>
				<li><a href="<?php echo $collection->code ?>"><?php echo $collection->title ?></a></li>
			<?php } ?>
		</ul>
	<?php } ?>
</div>
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
				qs.datastore.filter(function(o){return o.running===true});
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