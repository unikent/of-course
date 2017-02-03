<div class="container">

	<?php \unikent\kent_theme\kentThemeHelper::breadcrumb(array("Courses" => "/courses/",  $level_pretty. ' profiles' => '')); ?>

	<h1><?php echo $level_pretty; ?> student profiles</h1>

	<ul class="nav nav-tabs  pt-1">
		<li class="nav-item">
			<a class="nav-link <?php if($level_code === 'ug') echo 'active'; ?>"  href="<?php echo Flight::url("profiles/undergraduate/"); ?>">Undergraduate</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php if($level_code === 'pg') echo 'active'; ?>" href="<?php echo Flight::url("profiles/postgraduate/"); ?>">Postgraduate</a>
		</li>
	</ul>

</div>
<div class=" panel-secondary">
	<div class="container form-inline pt-2 pb-2 filter-box profile-filter-box" id="filter_box">
			<div id="profile-filter-container">
				<input 
					id="profile-filter" 
					class="form-control" 
					type="text" 
					placeholder="Search student profiles"
					data-quickspot-config="<?php echo $level_code;?>_profiles_inline"
					data-quickspot-target="quickspot-output"
					data-quickspot-filters="filter_box"
					/>
			</div>
			<div class="search-select module-options-search-div">
				<select class="subject-search form-control " data-filter-col="__subjects">
					<option value="">All subjects</option>
					<?php foreach ($categories as $v){ ?>
						<option value="<?php echo $v->name; ?>"><?php echo $v->name; ?></option>
					<?php }?>
				</select>
			</div>
	</div>
</div>
<?php 
$profiles = (array)$profiles; 
usort($profiles, function($a,$b){ return $a->name > $b->name;});
?>
<div class="card-panel cards-list cards-backed card-panel-secondary course-listing">
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
