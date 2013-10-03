<?php
// Divide our array in half so we can display it in two columns
$subject_array = array();
foreach ($subjects as $id=>$subject)
{
	$subject_array["$subject->name"] = $id;
}

ksort($subject_array);
$quarter = round( (count($subject_array) / 4), 0, PHP_ROUND_HALF_UP );

$subjects_a = array_slice($subject_array, 0, $quarter);
$subjects_b = array_slice($subject_array, $quarter, $quarter);
$subjects_c = array_slice($subject_array, $quarter*2, $quarter);
$subjects_d = array_slice($subject_array, $quarter*3);

$year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/');

?>
<div class='span3'>
	<?php foreach($subjects_a as $subject=>$id): ?>
	  <a href='<?php echo Flight::url("{$level}/{$year_for_url}search/subject_category/" . urlencode($subject)); ?>'><?php echo $subject; ?></a>
	<?php endforeach;?>
</div>
<div class='span3'>
	<?php foreach($subjects_b as $subject=>$id): ?>
	  <a href='<?php echo Flight::url("{$level}/{$year_for_url}search/subject_category/" . urlencode($subject)); ?>'><?php echo $subject; ?></a>
	<?php endforeach;?>
</div>
<div class='span3'>
	<?php foreach($subjects_c as $subject=>$id): ?>
	  <a href='<?php echo Flight::url("{$level}/{$year_for_url}search/subject_category/" . urlencode($subject)); ?>'><?php echo $subject; ?></a>
	<?php endforeach;?>
</div>
<div class='span3'>
	<?php foreach($subjects_d as $subject=>$id): ?>
	  <a href='<?php echo Flight::url("{$level}/{$year_for_url}search/subject_category/" . urlencode($subject)); ?>'><?php echo $subject; ?></a>
	<?php endforeach;?>
</div>
