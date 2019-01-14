<div class="container">
	<?php \unikent\kent_theme\kentThemeHelper::breadcrumb(array("Courses"=>"/courses/", "Modules"=>"/courses/modules", "Collections"=>"/courses/modules/collection", $modules->title => "")); ?>

	<h1>Module Catalogue</h1>

	<a href='<?php echo Flight::url("modules/collection");?>' class="pull-right">Browse all collections &raquo;</a>
	<h2><?php echo $modules->title;?> </h2>
</div>
<div class="filter-header panel-secondary">
		<div class="filter-categories container form-inline" id="filter_categories">

			<div class="filter-select">
				<select class="custom-select subject-search form-control" data-filter-col="sds_code">
					<option value="">All subjects</option>
					<?php foreach ($subjects as $k => $v){ ?>
						<option value="<?php echo $k; ?>"><?php echo $v; ?> - (<?php echo $k; ?>)</option>
					<?php }?>
				</select>
			</div>

			<input type="hidden" name="quickspot_result_count" />
			<input type="hidden" name="qucikspot_return_to_scroll_position" />
		</div>

		<div class="filter-text container form-inline">
			<h2><span id="filter_title">All</span> modules</h2>
			<div class="filter-container">
				<input
						id="module-filter"
						class="form-control"
						type="text"
						placeholder="Filter module list by keyword"
						data-quickspot-config="modules_inline"
						data-quickspot-source="<?php echo API_URL; ?>/v1/modules/collection/<?php echo $collection?>"
						data-quickspot-target="quickspot-output"
						data-quickspot-filters="filter_categories"
						data-quickspot-filter-text-target="filter_title"
				>
			</div>
		</div>
	</div>

	<div class="filter-results card-panel cards-list cards-backed card-panel-secondary">
		<div class="card-panel-body standard-output" id="quickspot-output">
		</div>
	</div>
