<h2>Staff research interests</h2>
<?php echo $course->staff_research_interests_intro ?>
<?php foreach ( $course->staff_research_interests as $staff ): ?>
	<?php if ( $staff->hidden == 0 ): ?>
	<h3><?php echo $staff->title != '' ? $staff->title . ' '  : '' ?><?php echo $staff->forename ?> <?php echo $staff->surname ?><?php echo $staff->role != '' ? ': ' . $staff->role : '' ?></h3>
	<p><a href="//<?php echo $staff->profile_url ?>"><?php echo $staff->profile_url ?></a></p>
	<?php echo $staff->blurb ?>
	<?php endif; ?>
<?php endforeach; ?>