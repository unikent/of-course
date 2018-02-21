<div class="container">
	<?php \unikent\kent_theme\kentThemeHelper::breadcrumb(array(
		"Courses" => "/courses/",
		"Profiles" => "/courses/profiles",
		$level_pretty => ''
	)); ?>
	<h1><?php echo $level_pretty; ?> profiles</h1>

	<ul class="nav nav-tabs  pt-1">
		<li class="nav-item">
			<a class="nav-link <?php if($level_code === 'ug') echo 'active'; ?>"  href="<?php echo Flight::url("profiles/undergraduate/"); ?>">Undergraduate</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php if($level_code === 'pg') echo 'active'; ?>" href="<?php echo Flight::url("profiles/postgraduate/"); ?>">Postgraduate</a>
		</li>
	</ul>

</div>
<div class="filter-header panel-secondary">
	<div class="filter-categories container form-inline" id="filter_categories">
			<div class="filter-select">
				<select class="custom-select subject-search form-control" data-filter-col="__subjects">
					<option value="">All subjects</option>
					<?php

					$subject_categories = (array) $subject_categories;
					usort($subject_categories, function ($a, $b){
						if ($a->name == $b->name) {
							return 0;
						}
						return ($a->name < $b->name) ? -1 : 1;
					});

					foreach($subject_categories as $sc): ?>
					<option <?php if(strcmp($search_type, 'subject_category')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower(slug_escape($sc->name))) == 0) echo 'selected'; ?>><?php echo $sc->name?></option>
					<?php endforeach; ?>

					?>
				</select>

				<select class="custom-select type-search form-control" data-filter-col="type">
					<option value="">Students and alumni</option>
					<option value="student" <?php if(strcmp($search_type, 'type')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('student')) == 0) echo 'selected'; ?>>Students only</option>
					<option value="alumni" <?php if(strcmp($search_type, 'type')  == 0  && strcmp(urldecode(strtolower($search_string)), strtolower('alumni')) == 0) echo 'selected'; ?>>Alumni only</option>
				</select>

			</div>
	</div>

	<div class="filter-text container form-inline">
		<h2><span id="filter_title">All</span> profiles</h2>
		<div class="filter-container">
			<input
				id="profile-filter"
				class="form-control"
				type="text"
				placeholder="Filter profiles by keyword"
				data-quickspot-config="<?php echo $level_code;?>_profiles_inline"
				data-quickspot-target="quickspot-output"
				data-quickspot-filters="filter_categories"
				/>
		</div>
	</div>

</div>
<?php
$profiles = (array)$profiles;
usort($profiles, function($a,$b){ return $a->name > $b->name;});
?>
<div class="filter-results card-panel cards-list cards-backed card-panel-secondary">
	<div class="card-panel-body standard-output" id="quickspot-output">
		<?php foreach($profiles as $p): if($p->type ==' alumni'){ continue; } ?>
			<div class="card card-linked chevron-link">

				<a href="<?php echo Flight::url("profiles/{$level}/{$p->slug}"); ?>" class="card-title-link ">
					<h3 style="display:inline;"><?php echo $p->name;?> - <?php echo $p->course; ?></h3>
				</a>
				<a href="<?php echo Flight::url("profiles/{$level}/{$p->slug}"); ?>" class="faux-link-overlay" aria-hidden="true"><?php echo $p->name;?> - <?php echo $p->course; ?></a>

				<span class="kf-book tag text-accent"> <?php echo implode($p->subject_categories, ', ')?></span>
			</div>
		<?php endforeach; ?>
	</div>
</div>
