<?php
// Divide our array in half so we can display it in two columns
$subjects = (array)$subjects;
$len = count($subjects);
$quater =  $len / 4;

$subjects_a = array_slice($subjects, 0, $quater );
$subjects_b = array_slice($subjects, $quater, $quater );
$subjects_c = array_slice($subjects, $quater*2, $quater);
$subjects_d = array_slice($subjects, $quater*3, $quater);

?>
<div class='span3'>
	<?php foreach($subjects_a as $subject): ?>

	  <a href='<?php echo Flight::url("{$type}/{$year}/search/subject_category/{$subject->name}"); ?>'><?php echo $subject->name; ?></a>
	<?php endforeach;?>
</div>
<div class='span3'>
	<?php foreach($subjects_b as $subject): ?>
	  <a href='<?php echo Flight::url("{$type}/{$year}/search/subject_category/{$subject->name}"); ?>'><?php echo $subject->name; ?></a>
	<?php endforeach;?>
</div>
<div class='span3'>
	<?php foreach($subjects_c as $subject): ?>
	  <a href='<?php echo Flight::url("{$type}/{$year}/search/subject_category/{$subject->name}"); ?>'><?php echo $subject->name; ?></a>
	<?php endforeach;?>
</div>
<div class='span3'>
	<?php foreach($subjects_d as $subject): ?>
	  <a href='<?php echo Flight::url("{$type}/{$year}/search/subject_category/{$subject->name}"); ?>'><?php echo $subject->name; ?></a>
	<?php endforeach;?>
</div>
