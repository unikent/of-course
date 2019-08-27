<?php if (isset($course->no_fee_output) && $course->no_fee_output === 'true'): ?>
    <!-- Do nothing -->
<?php else: ?>
	<h2>Fees</h2>
    <?php if (isset($course->globals->fees_caveat_text_ug) && !empty($course->globals->fees_caveat_text_ug)) echo ' <h3 class="card-title">'.$course->globals->fees_caveat_text_ug.'</h3>' ?>
	
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>UK/EU</th>
            <th>Overseas</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $fees = $course->deliveries[0]->fees;

        ?>
        <?php if ($has_fulltime): ?>
            <tr>
                <td><strong>Full-time</strong></td>
                <td><?php echo (is_numeric($fees->home_full_time) ? '&'.$fees->currency.';' : '') . $fees->home_full_time; ?></td>
                <td><?php echo (is_numeric($fees->int_full_time) ? '&'.$fees->currency.';' : '') . $fees->int_full_time; ?></td>
            </tr>
        <?php endif; ?>
        <?php if ($has_parttime): ?>
            <tr>
                <td><strong>Part-time</strong></td>
                <td><?php echo (is_numeric($fees->home_part_time) ? '&'.$fees->currency.';' : '') . $fees->home_part_time; ?></td>
                <td><?php echo (is_numeric($fees->int_part_time) ? '&'.$fees->currency.';' : '') . $fees->int_part_time; ?></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
	<p>For details on when and how to pay fees and charges, please see our <a href="/finance-student/student-finance-guide/">Student Finance Guide</a>.</p>
    <div class="mb-2">
            <?php
            if (isset($course->globals->fees_exception_text_ug)) echo $course->globals->fees_exception_text_ug;

            if ($has_foundation && isset($course->globals->fees_foundation_year_exception_text_ug)) {
                echo $course->globals->fees_foundation_year_exception_text_ug;
            }

            if (isset($course->globals->fees_year_in_industryabroad_text_ug) && // If YII/YA text is set AND
                (
                    (!empty($course->year_in_industry)) || // YII or YA has some text
                    (!empty($course->year_abroad))
                ) // then
            ) {
                echo $course->globals->fees_year_in_industryabroad_text_ug;
            }
            ?>
    </div>
<?php endif; ?>

<section class="info-section">
    <?php if(!empty($course->additional_costs)): ?>
        <h2>Additional costs</h2>
        <?php echo $course->additional_costs; ?>
    <?php endif; ?>

	<?php if(!empty($course->general_additional_costs)): ?>
		<?php echo $course->general_additional_costs; ?>
	<?php endif; ?>

	<h2>Funding</h2>
	<?php echo $course->funding;?>
</section>
