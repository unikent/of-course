
<section class="info-section">
	<h3>Home/EU students </h3>
	<?php echo $course->homeeu_students_intro_text;?>


	<?php if(defined('CLEARING') && CLEARING): ?>
		<p>
			Typical entry requirements for 2017 entry courses remain published on the UCAS course search website and apply to applications received during the main UCAS application cycle. These provide a rough guide to our likely entry requirements for Clearing and Adjustment applicants.
		</p>
		<p>
			However during Clearing (after 5 July), our entry requirements change in real time to reflect the supply and demand of remaining course vacancies and so may be higher or lower than those published on UCAS as typical entry grades.
		</p>
		<p>
			Our Clearing vacancy list [link] will be updated regularly as courses move in and out of Clearing, so please check regularly to see if we have any places available. You can submit an application via our online Clearing application form as soon as your full results are known. [either link to the form or explain how they can navigate to it]. See our Clearing website [link] for more details on how Clearing works at Kent.
		</p>
	<?php else: ?>

	<table class="table table-responsive table-striped ug-entry-requirements">
		<thead>
		<tr>
			<th>Qualification</th>
			<th>Typical offer/minimum requirement</th>
		</tr>
		</thead>
		<tbody>

		<?php if (!empty($course->a_level)): ?>
			<tr>
				<td>A level</td>
				<td><?php echo $course->a_level ?></td>
			</tr>
		<?php endif; ?>

		<?php if (!empty($course->cgse)): ?>
			<tr>
				<td>GCSE</td>
				<td><?php echo $course->cgse ?></td>
			</tr>
		<?php endif; ?>

		<?php if (!empty($course->access_to_he_diploma)): ?>
			<tr>
				<td>Access to HE Diploma</td>
				<td><?php echo $course->access_to_he_diploma ?></td>
			</tr>
		<?php endif; ?>

		<?php if (!empty($course->btec_level_5_hnd)): ?>
			<tr>
				<td>BTEC Level 5 HND</td>
				<td><?php echo $course->btec_level_5_hnd ?></td>
			</tr>
		<?php endif; ?>

		<?php if (!empty($course->btec_level_3_extended_diploma_formerly_btec_national_diploma)): ?>
			<tr>
				<td>BTEC Level 3 Extended Diploma (formerly BTEC National Diploma)</td>
				<td><?php echo $course->btec_level_3_extended_diploma_formerly_btec_national_diploma ?></td>
			</tr>
		<?php endif; ?>

		<?php if (!empty($course->international_baccalaureate)): ?>
			<tr>
				<td>International Baccalaureate</td>
				<td><?php echo $course->international_baccalaureate ?></td>
			</tr>
		<?php endif; ?>

		</tbody>
	</table>
</section>
<?php if(!empty($course->entry_profile)): ?>
  	<?php echo $course->entry_profile;?>
  <?php endif; ?>
  <!-- <?php echo $course->entry_requirements_overriding_text;?> -->

 <h2>Entry requirements</h2>
	<?php endif; ?>

	<section class="info-section">
    <h3>International students<a href="/courses/undergrad/apply/entry.html"></a></h3>
    <?php echo $course->international_students_intro_text ?>

	<?php if(!empty($course->english_language_requirements)): ?>
		<h4>English Language Requirements</h4>
		<?php echo $course->english_language_requirements ?>
	<?php endif; ?>

	</section>

	<section class="info-section">
		<h3>General entry requirements</h3>
		<?php echo $course->globals->ug_general_entry_requirements ?>
	</section>
