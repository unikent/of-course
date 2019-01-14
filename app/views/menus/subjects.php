<?php

	$year_for_url = empty($year) ? '' : ((strcmp($year, CoursesController::$current_year) == 0) ? '' : $year . '/');
	$all = count((array) $subjects);
	$quarter = (int)round($all / 4, 0, PHP_ROUND_HALF_UP);
	$counter = 0;

	foreach ($subjects as $subject):
		//pantheon escaping for the subject categories on the nav
		$url = "{$level}/{$year_for_url}search/subject_category/" . slug_escape($subject->name);
		$mod = $counter % $quarter;
?>

		<?php if ($mod === 0): ?>
			<div class="span3">
		<?php endif; ?>

			<a href='<?php echo Flight::url($url); ?>'><?php echo $subject->name; ?></a>

		<?php if ($mod + 1 == $quarter || $counter == $all): ?>
			</div>
		<?php endif; ?>

<?php
	++$counter;
	endforeach;
?>
