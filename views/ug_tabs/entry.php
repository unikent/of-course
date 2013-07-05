
  <h2>Entry requirements</h2>
  <?php if(!empty($course->entry_profile)): ?>
  	<?php echo $course->entry_profile;?>
  <?php endif; ?>
  <!-- <?php echo $course->entry_requirements_overriding_text;?> -->
  
	<section class="info-section">
		<h3>Home/EU students </h3>
		<?php echo $course->homeeu_students_intro_text;?>
		
		
		<table class="table">
			<thead>
		      <tr>
		        <th>Qualification</th>
		        <th>Typical offer/minimum requirement</th>
		      </tr>
			</thead>
			<tbody>
		
		  <?php if(!empty($course->a_level)): ?>
		  <tr>
		    <td>A level</td>
		    <td><?php echo $course->a_level ?></td>
		  </tr>
		  <?php endif; ?>
		
		  <?php if(!empty($course->cgse)): ?>
		  <tr>
		    <td>GCSE</td>
		    <td><?php echo $course->cgse ?></td>
		  </tr>
		  <?php endif; ?>
		
		  <?php if(!empty($course->access_to_he_diploma)): ?>
		  <tr>
		    <td>Access to HE Diploma</td>
		    <td><?php echo $course->access_to_he_diploma ?></td>
		  </tr>
		  <?php endif; ?>
		
		  <?php if(!empty($course->btec_level_5_hnd)): ?>
		  <tr>
		    <td>BTEC Level 5 HND</td>
		    <td><?php echo $course->btec_level_5_hnd ?></td>
		  </tr>
		  <?php endif; ?>
		
		  <?php if(!empty($course->btec_level_3_extended_diploma_formerly_btec_national_diploma)): ?>
		  <tr>
		    <td>BTEC Level 3 Extended Diploma (formerly BTEC National Diploma) </td>
		    <td><?php echo $course->btec_level_3_extended_diploma_formerly_btec_national_diploma ?></td>
		  </tr>
		  <?php endif; ?>
		
		  <?php if(!empty($course->international_baccalaureate)): ?>
		  <tr>
		    <td>International Baccalaureate</td>
		    <td><?php echo $course->international_baccalaureate ?></td>
		  </tr>
		  <?php endif; ?>

			</tbody>
		</table>
	</section>
	
	<section class="info-section">
    <h3>International students<a href="/courses/undergrad/apply/entry.html"></a></h3>
    <?php echo $course->international_students_intro_text ?>
    <table class="table">
	<thead>
      <tr>
        <th>Qualification</th>
        <th>Typical offer/minimum requirement</th>
      </tr>
	</thead>
    <tbody>

	<?php if(!empty($course->kent_international_foundation_programme)): ?>
		<tr>
			<td>Kent International Foundation Programme</td>
			<td><?php echo $course->kent_international_foundation_programme ?></td>
		</tr>
  	<?php endif; ?>

	<?php if(!empty($course->english_language_requirements)): ?>
		<tr>
			<td>English Language Requirements</td>
			<td><?php echo $course->english_language_requirements ?></td>
		</tr>
	<?php endif; ?>
    </tbody>
    </table>
	</section>
	
	<section class="info-section">
		<h3>General entry requirements</h3>
		<?php echo $course->general_entry_requirements_link ?>
	</section>
