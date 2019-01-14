<h2>Staff research interests</h2>

<?php if ( strstr($course->programme_type, 'research') ): ?>
<?php echo $course->staff_research_interests_intro ?>
<?php endif; ?>

<?php if (!empty($course->staff_profile_links)): ?>
	<?php echo $course->staff_profile_links; ?>
<?php elseif (!empty($course->staff_profiles)): ?>
	<p>Full details of staff research interests can be found on the <a href='<?php echo $course->staff_profiles; ?>'>School's website</a>.</p>
<?php endif; ?>

<?php if(isset($course->staff_research_interests) && !empty($course->staff_research_interests)): ?>
	<?php foreach ( $course->staff_research_interests as $staff ): ?>
		<?php if ( $staff->hidden == 0 ): ?>
		<h3><?php echo $staff->title != '' ? $staff->title . ' '  : '' ?><?php echo $staff->forename ?> <?php echo $staff->surname ?><?php echo $staff->role != '' ? ': ' . $staff->role : '' ?></h3>
		
		<?php if ( ! empty ($staff->blurb) ): ?>
		<div class="staff-profile mb-3">
			<?php echo $staff->blurb ?>

			<?php if($staff->profile_url != ''): ?>
				<a class="chevron-link" href="<?php echo $staff->profile_url ?>">View Profile</a>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>