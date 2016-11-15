<h2>Fees</h2>

<?php if (isset($course->no_fee_output) && $course->no_fee_output === 'true'): ?>
    <!-- Do nothing -->
<?php else: ?>
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
    <div class="card-panel-single">
        <div class="card" style="font-size:0.7rem;">
            <?php
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

            if (isset($course->globals->fees_exception_text_ug)) echo $course->globals->fees_exception_text_ug;
            ?>
        </div>
    </div>
<?php endif; ?>

<section class="info-section">
	<h2>Funding</h2>
	<?php echo $course->funding;?>
</section>