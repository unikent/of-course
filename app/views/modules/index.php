<?php
use \unikent\kent_theme\kentThemeHelper;
?>

<div class="container">
	<h1>Module Catalogue</h1>

	<p>The Module catalogue contains information about academic modules taught at the university.</p>
	<ul class="nav nav-tabs collection-tabs">
		<li class="nav-item"><a href="#" class="nav-link active" data-quickspot-reconfigure="module-filter">All</a></li>
		<?php foreach($collections as $code => $collection){ ?>
			<li class="nav-item">
				<a href="#<?php echo $code;?>" class="nav-link" data-quickspot-reconfigure="module-filter" data-quickspot-config="modules_inline" data-quickspot-url="<?php echo API_URL; ?>/v1/modules/collection/<?php echo $collection['collection'];?>"><?php echo $collection['name'];?></a>
			</li>
		<?php } ?>
	</ul>
</div>
<div class="panel-secondary">
		<div class="container form-inline p-t-2 p-b-2 filter-box" id="filter_box">
			<div style="display:inline">
				<input 
					id="module-filter" 
					class="form-control" 
					type="text" 
					placeholder="Search courses"
					data-quickspot-config="modules_inline"
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
		</div>
</div>
<div class="card-panel cards-list cards-backed card-panel-secondary module-listing">
	<div class="card-panel-body quickspot-output" id="quickspot-output">
	</div>			 
</div>