<div class="panel admissions">
	<h2>Apply</h2>


	<?php if(!empty($course->how_to_apply)):
	// if how_to_apply (subject to approval) is set, show message instead of apply links
	?>
		<?php echo $course->how_to_apply; ?>
		
	<?php else: ?>

	
	<!-- <p>I would like to apply for Archaeology and Anthropology</p> -->
	
  
    
	<form>
	
	<div class="form-row">	
	<label for="apply-study-type">Type of study</label>
	<select id="apply-study-type">
		<option>Full time</option>
		<option>Part time</option>
	</select>
    	</div>
	
	<div class="form-row">
	<label for="apply-study-award">Award</label>
	<select id="apply-study-award">
		<option>MA</option>
		<option>MSc</option>
        <option>PhD</option>
	</select>
	</div>
	<br>
	

	<a href="#" class="apply-link">Apply for <strong>Anthropology</strong> <span id="apply-award-link">MA</span> - <span id="apply-type-link">Full time</span></a>
	
	<!--
	<input type="submit" value="Apply for Archaeology and Anthropology BA (Hons) - Full time"/>
	-->
	</form>
	
	<?php endif; ?>
</div>