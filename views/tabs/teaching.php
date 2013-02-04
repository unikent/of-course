    <div class="tabContent" id="tab3">
        <h2>Teaching &amp; assessment</h2>
        <p><?php echo $course->teaching_and_assessment; ?></p>

        <?php if(!empty($course->programme_aims)): ?>
        <h2>Programme aims</h2>
        <p><?php echo $course->programme_aims; ?></p>
        <?php endif; ?>

		<?php if(!empty($course->learning_outcomes)): ?>
        <h2>Learning outcomes</h2>
        <p><?php echo $course->learning_outcomes; ?></p>
        <?php endif; ?>
    </div>