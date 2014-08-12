<h1>Your application - <?php echo $course->programme_title ?></h1>

<h2>Select your course options.</h2>

<p>To begin your application process, you'll need to select your course options below.</p>

<p><em class="icon-asterisk required"></em> required field</p>

<div>
	<fieldset class="highlight-fieldset indent">
	    <legend>Course options</legend>
	    <div class="form-group">
	        <label for="type">Type of study <em class="icon-asterisk required"><span class="collapse-text">(required)</span></em></label>
	        <div class="controls">
	            <select name="type" required="required" id="type" parsley-select="" class="parsley-validated">
					<option value="pleaseselect">Please select</option>
					<option value="ft">Full-time</option>
					<option value="pt">Part-time</option>
				</select>
	        </div>
	    </div>
	    
	    <div class="form-group">
	        <label for="award">Award <em class="icon-asterisk required"><span class="collapse-text">(required)</span></em></label>
	        <div class="controls">
	            <select name="award" required="required" id="award" parsley-select="" class="parsley-validated">
	            	<?php if (sizeof($course->deliveries) === 1): ?>
	            	<option value="<?php echo $course->award[0]->{name}?>"><?php echo $course->award[0]->{name}?></option>
	            	<?php else: ?>
					<option value="pleaseselect">Please select</option>
					<?php foreach ($course->deliveries as $delivery): ?>
					<option value="<?php echo $delivery->award_name?>"><?php echo $delivery->description?></option>
					<?php endforeach; ?>
					<?php endif; ?>
				</select>
			</div>
	    </div>
	    
	    <div class="form-group coursetwo-row">
	        <label for="year">Year <em class="icon-asterisk required"><span class="collapse-text">(required)</span></em></label>
	        <div class="controls">
	            <select name="year" id="year" required="required" parsley-select="" class="parsley-validated">
					<option value="<?php echo $course->year?>"><?php echo $course->year?></option>
					<?php if ($course->current_year == $course->year): ?>
					<option value="<?php echo $course->year-1?>"><?php echo $course->year-1?></option>
					<?php else: ?>
					<option value="<?php echo $course->year+1?>"><?php echo $course->year+1?></option>
					<?php endif; ?>
				</select>
			</div>
	    </div>
	</fieldset>
</div>


<p class="btn-indent daedalus-tab-action daedaus-js-display">
	<button type="button" class="btn btn-large btn-primary next-btn" tabindex="0" role="button">Next <i class="icon-chevron-right icon-white"></i></button>
</p>
