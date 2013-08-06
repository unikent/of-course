<h2>Staff research interests</h2>
<?php echo $course->staff_research_interests_intro ?>

<?php if(!empty($course->staff_profiles)): ?>
	<p>Full details of staff research interests can be found on the <a href='<?php echo $course->staff_profiles; ?>'>School's website</a>.</p>
<?php endif; ?>

<?php foreach ( $course->staff_research_interests as $staff ): ?>
	<?php if ( $staff->hidden == 0 ): ?>
	<h3><?php echo $staff->title != '' ? $staff->title . ' '  : '' ?><?php echo $staff->forename ?> <?php echo $staff->surname ?><?php echo $staff->role != '' ? ': ' . $staff->role : '' ?></h3>
	
	<?php if ( ! empty ($staff->blurb) ): ?>
	<div class="staff-profile">
		<?php echo $staff->blurb ?>

		<?php if($staff->profile_url != ''): ?>
			<a href="//<?php echo $staff->profile_url ?>">Profile</a>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php endif; ?>
<?php endforeach; ?>