<?php if (isset($course->no_fee_output) && $course->no_fee_output === 'true'): ?>
	<!-- Do nothing -->
<?php else: ?>
	<h2>Fees</h2>
	<!-- fees panel -->
	<?php if (isset($course->globals->fees_override_pgr) && !empty($course->globals->fees_override_pgr) && strpos($course->programme_type, 'research') !== false) {
		echo $course->globals->fees_override_pgr;
	} else {
		?>

		<?php if (isset($course->globals->fees_caveat_text_pg) && !empty($course->globals->fees_caveat_text_pg)) echo ' <h3>'.$course->globals->fees_caveat_text_pg.'</h3>' ?>
		

		<?php $pos_codes = array(); foreach ($course->deliveries as $delivery): ?>
			<?php if (!in_array($delivery->pos_code, $pos_codes)): ?>
				<table class="table">
					<thead>
					<tr>
						<td colspan="3"><i
								class="icon icon-bullet"></i> <?php echo preg_replace('/- (\w){4}-time/', '', $delivery->description) . ':' ?>
						</td>
					</tr>
					<tr>
						<th></th>
						<th>UK/EU</th>
						<th>Overseas</th>
					</tr>
					</thead>
					<tbody>
					<?php if ($has_fulltime): ?>
						<tr>
							<td><strong>Full-time</strong></td>
							<td><?php echo (is_numeric($delivery->fees->home_full_time) ? '&'.$delivery->fees->currency.';' : '') . $delivery->fees->home_full_time; ?></td>
							<td><?php echo (is_numeric($delivery->fees->int_full_time) ? '&'.$delivery->fees->currency.';' : '') . $delivery->fees->int_full_time; ?></td>
						</tr>
					<?php endif; ?>
					<?php if ($has_parttime): ?>
						<tr>
							<td><strong>Part-time</strong></td>
							<td><?php echo (is_numeric($delivery->fees->home_part_time) ? '&'.$delivery->fees->currency.';' : '') . $delivery->fees->home_part_time; ?></td>
							<td><?php echo (is_numeric($delivery->fees->int_part_time) ? '&'.$delivery->fees->currency.';' : '') . $delivery->fees->int_part_time; ?></td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
				<?php $pos_codes[] = $delivery->pos_code; endif; ?>
		<?php endforeach; ?>
		<p>For details on when and how to pay fees and charges, please see our <a href="/finance-student/student-finance-guide/">Student Finance Guide</a>.</p>
		<?php
		if (
			isset($course->globals->fees_year_in_industryabroad_text_pg) && // If YII/YA text is set AND
			(
				(!empty($course->year_in_industry)) || // YII or YA has some text
				(!empty($course->year_abroad))
			) // then
		) {
			echo $course->globals->fees_year_in_industryabroad_text_pg;
		}

		if (isset($course->globals->fees_exception_text_pg)) echo $course->globals->fees_exception_text_pg;
		?>
	<?php } ?>
<?php endif; ?>

<section class="info-section">
<?php if(!empty($course->additional_costs)): ?>
	<h2>Additional costs</h2>
	<?php echo $course->additional_costs; ?>
<?php endif; ?>

<?php if(!empty($course->general_additional_costs)): ?>
	<?php echo $course->general_additional_costs; ?>
<?php endif; ?>

<?php if(!empty($course->fees_and_funding)){ ?>
<h2>Funding</h2>
	<?php echo $course->fees_and_funding; ?>
<?php } ?>
</section>
