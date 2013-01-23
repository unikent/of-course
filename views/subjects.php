<kentPageBody>
     <kentPageBodyFull>
        <kentPageContent>
            <!-- InstanceBeginEditable name="content" -->

            <h1> Courses by Subject </h1>
            

            	<?php

            		// Divide our array in half so we can display it in two columns
            		$len = count($subjects);

					$subjects_left = array_slice($subjects, 0, $len / 2);
					$subjects_right = array_slice($subjects, $len / 2);


            	?>
            	<div style='padding:0 10px;'>
	            	<div style='width:470px;float:left;'>
	           

			            <?php foreach($subjects_left as $subject): ?>
			            	<h3><?php echo $subject->name; ?></h3>
			            	<ul>
				            	<?php foreach($subject->courses as $course): ?>
				            		<li><a href='<?php echo Flight::url("{$type}/{$year}/{$course->id}/{$course->slug}"); ?>'><?php echo $course->name; ?> - <?php echo $course->award; ?></a></li>
				            	<?php endforeach; ?>
				            </ul>
			        	<?php endforeach; ?>
			        </div>
			        <div style='width:470px;float:left;'>
	           

			            <?php foreach($subjects_right as $subject): ?>
			            	<h3><?php echo $subject->name; ?></h3>
			            	<ul>
				            	<?php foreach($subject->courses as $course): ?>
				            		<li><a href='<?php echo Flight::url("{$type}/{$year}/{$course->id}/{$course->slug}"); ?>'><?php echo $course->name; ?> - <?php echo $course->award; ?></a></li>
				            	<?php endforeach; ?>
				            </ul>
			        	<?php endforeach; ?>
			        </div>
			    </div>

	        <div style='clear:both;'>&nbsp;</div>

            <!-- InstanceEndEditable -->
        </kentPageContent>
     </kentPageBodyFull>
</kentPageBody>