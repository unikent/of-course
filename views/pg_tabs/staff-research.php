<h2>Staff research interests</h2>
<?php echo $course->staff_research_interests_intro ?>
<?php foreach ( $course->staff_research_interests as $staff ): ?>
	<?php if ( $staff->hidden == 0 ): ?>
	<h3><?php echo $staff->title != '' ? $staff->title . ' '  : '' ?><?php echo $staff->forename ?> <?php echo $staff->surname ?><?php echo $staff->role != '' ? ': ' . $staff->role : '' ?></h3>
	<?php if ( ! empty ($staff->profile_url) ): ?>
	<div class="staff-profile">
		<?php echo $staff->blurb ?>
		<a href="//<?php echo $staff->profile_url ?>">Profile</a>
	</div>
	<?php endif; ?>
	<?php endif; ?>
<?php endforeach; ?>