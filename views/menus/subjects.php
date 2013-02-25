<?php
// Divide our array in half so we can display it in two columns
$subjects = (array)$subjects;
$len = count($subjects);
$quater =  round($len / 4, 0, PHP_ROUND_HALF_UP);

$subjects_a = array_slice($subjects, 0, $quater );
$subjects_b = array_slice($subjects, $quater, $quater );
$subjects_c = array_slice($subjects, $quater*2, $quater);
$subjects_d = array_slice($subjects, $quater*3, $quater);

$year_for_url = empty($year) ? '' : ((strcmp($year, CoursesFrontEnd::$current_year) == 0) ? '' : $year . '/');

?>
<div class='span3'>
	<?php foreach($subjects_a as $subject): ?>

	  <a href='<?php echo Flight::url("{$level}/{$year_for_url}search/subject_category/" . urlencode($subject->name)); ?>'><?php echo $subject->name; ?></a>
	<?php endforeach;?>
</div>
<div class='span3'>
	<?php foreach($subjects_b as $subject): ?>
	  <a href='<?php echo Flight::url("{$level}/{$year_for_url}search/subject_category/" . urlencode($subject->name)); ?>'><?php echo $subject->name; ?></a>
	<?php endforeach;?>
</div>
<div class='span3'>
	<?php foreach($subjects_c as $subject): ?>
	  <a href='<?php echo Flight::url("{$level}/{$year_for_url}search/subject_category/" . urlencode($subject->name)); ?>'><?php echo $subject->name; ?></a>
	<?php endforeach;?>
</div>
<div class='span3'>
	<?php foreach($subjects_d as $subject): ?>
	  <a href='<?php echo Flight::url("{$level}/{$year_for_url}search/subject_category/" . urlencode($subject->name)); ?>'><?php echo $subject->name; ?></a>
	<?php endforeach;?>
</div>
