<article class="container">
	<h1>
		<?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?>
		<?php if($course->subject_to_approval == 'true'){ echo "<span>(Subject to approval)</span>";} ?>
	</h1>
	
	<?php if($course->programme_suspended == 'true' || $course->programme_withdrawn == 'true'): ?>
		<?php echo $course->holding_message; ?>
	<?php else: ?>


	<div class="daedalus-tabs">
	
	<div class="row-fluid">
		<div class="span12">
			<ul class="nav nav-tabs">
				<li><a href="#overview">Overview</a></li>
				<li><a href="#structure">Course structure</a></li>
				<li><a href="#teaching">Teaching &amp; Assessment</a></li>
				<li><a href="#careers">Careers</a></li>
				<li><a href="#entry">Entry requirements</a></li>
				<li><a href="#fees">Fees &amp; Funding</a></li>
				<li><a href="#apply">Apply</a></li>
				<li><a href="#info">Further info</a></li>
			</ul>
		</div><!-- /span -->
	</div><!-- /row -->
	
	<div class="row-fluid">
		<div class="span7">
			<div class="tab-content">
				<section id="overview"><?php Flight::render('ug_tabs/overview', array('course'=>$course)); ?></section>
				<?php if ( empty($course->modules->stages) ) : ?>
				<section id="structure"><?php Flight::render('ug_tabs/structure_empty', array('course'=>$course)); ?></section>
				<?php else: ?>
				<section id="structure"><?php Flight::render('ug_tabs/structure', array('course'=>$course)); ?></section>
				<?php endif; ?>
				<section id="teaching"><?php Flight::render('ug_tabs/teaching', array('course'=>$course)); ?></section>
				<section id="careers"><?php Flight::render('ug_tabs/careers', array('course'=>$course)); ?></section>	
				<section id="entry"><?php Flight::render('ug_tabs/entry', array('course'=>$course)); ?></section>
				<section id="fees"><?php Flight::render('ug_tabs/fees', array('course'=>$course)); ?></section>
				<section id="apply"><?php Flight::render('ug_tabs/apply', array('course'=>$course)); ?></section>
				<section id="info"><?php Flight::render('ug_tabs/info', array('course'=>$course)); ?></section>
			</div>
		</div><!-- /span -->
		<div class="span5">

			<div class="side-panel">
			<div class="panel admission-links">
				<a href="#" onclick="pantheon.show_tab('apply');" class="apply-adm-link">Apply</a>, <a href="#" onclick="pantheon.show_tab('enquiries');" class="enquire-adm-link">enquire</a> or <a href="#" onclick="pantheon.show_tab('enquiries');" class="pros-adm-link">order a prospectus</a>
			</div>

			<aside class="key-facts-container">
				<h2>Key facts</h2>
				<div class="key-facts">
					<ul>
						<?php
							// If there a second subject area?
							 $second_subject = (isset($course->subject_area_2[0]) && $course->subject_area_2[0] != null);
						?>
						<li><strong>Subject area<?php if($second_subject) echo 's'; ?>:</strong>
							<?php 
								echo $course->subject_area_1[0]->name; 
								echo ($second_subject) ? ' | '.$course->subject_area_2[0]->name : '';
							?>
						</li>
						<li><strong>Award:</strong> <?php echo $course->award[0]->name;?> </li>
						<li><strong>Honours type:</strong> <?php echo $course->honours_type;?> </li>
					
						<?php if(!empty($course->ucas_code)): ?>
						<li><strong>UCAS code:</strong> <?php echo $course->ucas_code;?>	</li>
						<?php endif; ?>
					
						<li><strong>Location:</strong> <a href="<?php echo $course->location[0]->url;?>"><?php echo $course->location[0]->name;?></a>	</li>
					
						<li><strong>Mode of study:</strong> <?php echo $course->mode_of_study;?></li>
					
						<?php if(!empty($course->duration)): ?>
						<li><strong>Duration:</strong> <?php echo $course->duration;?></li>
						<?php endif; ?>
					
						<?php if(!empty($course->start)): ?>
						<li><strong>Start: </strong> <?php echo $course->start;?> </li>
						<?php endif; ?>
						
						<?php if(!empty($course->accredited_by)): ?>
						<li><strong>Accredited by</strong>: <?php echo $course->accredited_by;?>	</li>
						<?php endif; ?>
						
						<?php if(!empty($course->total_kent_credits_awarded_on_completion)): ?>
						<li><strong>Total Kent credits:</strong> <?php echo $course->total_kent_credits_awarded_on_completion;?></li>
						<?php endif; ?>
					
						<?php if(!empty($course->total_ects_credits_awarded_on_completion)): ?>
						<li><strong>Total ECTS credits:</strong> <?php echo $course->total_ects_credits_awarded_on_completion;?></li>
						<?php endif; ?>
					</ul>
				</div>
			</aside>
			</div>
		</div><!-- /span -->
	</div><!-- /row -->

</div>
	
	<?php if ( ! empty($course->related_courses) ): ?>
	<section class="related-course-section">
		<h2>Related to this course</h2>
		
		<div id="myCarousel" class="carousel slide" data-interval="false">
		  <!-- Carousel items -->
		  <div class="<?php echo count($course->related_courses) > 4 ? 'carousel-inner' : 'carousel-inner-left'; ?>">
		  <?php $count = 0; ?>
		  <?php for( $i = 0; $i < ( round( (count($course->related_courses) / 4) + 0.5, 0, PHP_ROUND_HALF_DOWN ) ); $i++ ): ?>
		  <?php $related_courses = array_slice($course->related_courses, $i*4) ?>
			<div class="<?php if ($count == 0) echo 'active ' ?>item">
				
					<?php foreach($related_courses as $related_course): ?>
					<div class="span2 related-course">
		                <div class="cell">
		                    <div class="mask">
		                        <a href="<?php echo Flight::url("{$level}/{$related_course->id}/{$related_course->slug}"); ?>">
		                        	<span><?php echo $related_course->name ?></span>
		                        	<span class="related-award"><?php echo $related_course->award;?></span>
		                        </a>
		                    </div>
		                </div> 
					</div>
					<?php $count++; if ($count%4 == 0) break; ?>
					<?php endforeach; ?>
				
			</div>
			<?php endfor; ?>
		  </div>
		  <!-- Carousel nav -->
		  <?php if (count($course->related_courses) > 4): ?>
		  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		  <?php endif; ?>
		</div>

		<ul class="related-course-list">
		<?php foreach($course->related_courses as $related_course): ?>
                    <li>
                    <a href="<?php echo Flight::url("{$level}/{$related_course->id}/{$related_course->slug}"); ?>">
                    	<span><?php echo $related_course->name ?></span>
                    	<span class="related-award"><?php echo $related_course->award;?></span>
                    </a>
                    </li>
		<?php endforeach; ?>
		</ul>
	
	</section>
	<?php endif; ?>
	
		
	<?php if (!empty($course->globals->general_disclaimer)): ?>
	<footer class="general_disclaimer" style='font-size:0.8em;'>
		<?php echo $course->globals->general_disclaimer; ?>
	</footer>
	<?php endif;?>
				
	<?php endif;?>
</article>