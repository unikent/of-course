<div class="container">
	<?php \unikent\kent_theme\kentThemeHelper::breadcrumb(array("Courses"=>"/courses/", "Modules"=>"/courses/modules", "Collections"=>"/courses/modules/collection", $modules->title => "")); ?>

	<h1>Module Catalogue</h1>

	<a href='<?php echo Flight::url("modules/collection");?>' class="pull-right">Browse all collections &raquo;</a>
	<h2><?php echo $modules->title;?> </h2>
</div>
<div class="panel-secondary">
		<div class="container form-inline pt-2 pb-2 filter-box" id="filter_box">
			<div class="module-filter-container">
				<input
						id="module-filter"
						class="form-control"
						type="text"
						placeholder="Search modules"
						data-quickspot-config="modules_inline"
						data-quickspot-source="<?php echo API_URL; ?>/v1/modules/collection/<?php echo $collection?>"
						data-quickspot-target="quickspot-output"
						data-quickspot-filters="filter_box"
				>
			</div>

			<div class="search-select module-options-search-div">
				<select class="subject-search form-control "  data-filter-col="sds_code">
					<option value="">All subjects</option>
					<?php foreach ($subjects as $k => $v){ ?>
						<option value="<?php echo $k; ?>"><?php echo $v; ?> - (<?php echo $k; ?>)</option>
					<?php }?>
				</select>
			</div>

			<input type="hidden" name="quickspot_result_count" />
			<input type="hidden" name="qucikspot_return_to_scroll_position" />
		</div>
	</div>
	<div class="card-panel cards-list cards-backed card-panel-secondary module-listing">
		<div class="card-panel-body quickspot-output" id="quickspot-output">
		</div>
	</div>
