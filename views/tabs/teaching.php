    <div class="tabContent" id="tab3">
        <h2>Teaching and assessment</h2>
        <?php echo $course->teaching_and_assessment; ?>

        <?php if(!empty($course->programme_aims)): ?>
        <h2>Programme aims</h2>
        <?php echo $course->programme_aims; ?>
        <?php endif; ?>

		<?php if(!empty($course->learning_outcomes)): ?>
        <h2>Learning outcomes</h2>
        <?php echo $course->learning_outcomes; ?>
        <?php endif; ?>
    </div>