<?php $year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/'); ?>

<article class="container">
	<div class='row-fluid'>
		<div class='span12'>
			<h1>We were unable to find <?php echo (!empty($slug)) ? "'{$slug}' "  : " a course "; ?><?php if(isset($id)): ?> with the id <?php echo $id;?> <?php endif; ?> </h1>
		</div>
	</div>
	<div class='row-fluid' style='min-height:300px;'>
		<div class='span7' >
			<p><strong>It seems we couldn't find the programme you were attempting to view.</strong></p>
			<p>Why not try using the search to find what you're after or alternatively head back to the <a href='<?php echo BASE_URL; ?>'>courses index page</a>.</p>
			<?php if(!empty($slug)): ?>
				<h3>Are any of these what you're looking for?</h3>
					<ul>
					<?php
						$limit = 8;
						$displayed = 0;
						
						foreach($programmes as $programme){
							if(strpos($programme->name, $slug) !==false || strpos($programme->slug, $slug) !==false){
								$link = Flight::url("{$level}/{$year_for_url}{$programme->id}/{$programme->slug}");
								echo "<li><a href='{$link}'>{$programme->name}</a></li>";
								$displayed++;
							}
							if($displayed > $limit)break;
						}
					?>
					</ul>
			<?php endif; ?>
		</div>
		<div class='span5'>
			<div class='well'>
				<h4>Not after a course?</h4>
				<p>Maybe some of these links will be more helpful</p>
				<ul>
					<li><a href='http://www.kent.ac.uk'>Go to the University of Kent homepage</a></li>
					<li><a href='http://www.kent.ac.uk/student/'>Read the student guide</a></li>
					<li><a href='http://www.kent.ac.uk/maps/'>View campus maps</a></li>
					<li><a href='http://www.kent.ac.uk/contact/'>Contact us</a></li>
				</li>
			</div>
		</div>

	</div>

</article>

<!--
Debug Info:
<?php
	if(isset($error)) echo $error->getCode().': '.$error->getMessage();
	if(isset($error_msg)) echo $error_msg;
?>

-->
