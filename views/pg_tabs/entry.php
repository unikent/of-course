
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
				<tr>
					<td colspan="2">Entry requirements go here...</td>
				</tr>
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
