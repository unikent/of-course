<?php	
$has_parttime = (strpos(strtolower($course->mode_of_study), 'part-time') !== false);
$has_fulltime = (strpos(strtolower($course->mode_of_study), 'full-time') !== false);
?>
<article class="container">
	<h1>
		<?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?>
		<?php if($course->subject_to_approval == 'true'){ echo " (subject to approval)";} ?>
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
				<li><a href="#fees">Funding</a></li>
				<li class='screenreader-only'><a href="#enquiries" >Enquiries</a></li>
				<li class='screenreader-only'><a href="#apply">Apply</a></li>
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
				<section id="enquiries"><?php Flight::render('ug_tabs/enquiries', array('course'=>$course)); ?></section>
				<section id="apply"><?php Flight::render('ug_tabs/apply', array('course'=>$course)); ?></section>
			</div>
		</div><!-- /span -->
		<div class="span5">

			<div class="side-panel">
			<div class="panel admission-links">
				<a href="#!apply" class="apply-adm-link">Apply</a>, <a href="#!enquiries" class="enquire-adm-link">enquire</a> or <a href="#!enquiries" class="pros-adm-link">order a prospectus</a>
			</div>

			<div class="key-facts-block">
			<div class="key-facts-container">
				<h2><a class="fees-link">Fees <i class="icon-chevron-down toggler"></i></a></h2>
				<div class="fees-tables" style="display: none">
					<?php if (isset($course->globals->fees_caveat_text_ug) && !empty($course->globals->fees_caveat_text_ug)) echo $course->globals->fees_caveat_text_ug ?> 
					<table class="table">
					  <thead>
					    <tr>
					      <th></th>
					      <th>UK/EU</th>
					      <th>Overseas</th>
					    </tr>
					  </thead>
					  <tbody>
					  		<?php if($has_fulltime):?>
							<tr>
							  <td><strong>Full-time</strong></td>
						      <td><?php echo empty($course->fees->home->{'full-time'}) ? 'TBC' : '&pound;' . $course->fees->home->{'full-time'}; ?></td>
						      <td><?php echo empty($course->fees->int->{'full-time'}) ? 'TBC' : '&pound;' . $course->fees->int->{'full-time'}; ?></td>
						    </tr>
							<?php endif;?>
							<?php if($has_parttime):?>
						    <tr>
						      <td><strong>Part-time</strong></td>
						      <td><?php echo empty($course->fees->home->{'part-time'}) ? 'TBC' : '&pound;' . $course->fees->home->{'part-time'}; ?></td>
						      <td><?php echo empty($course->fees->int->{'part-time'}) ? 'TBC' : '&pound;' . $course->fees->int->{'part-time'}; ?></td>
						    </tr>
							<?php endif;?>
					  </tbody>
					</table>

					<?php 

						if( 
							isset($course->globals->fees_year_in_industryabroad_text_ug) && // If YII/YA text is set AND
							( 
								(!empty($course->year_in_industry)) || // YII or YA has some text
								(!empty($course->year_abroad)) 
							) // then
						){
							 echo $course->globals->fees_year_in_industryabroad_text_ug;
						}
					?>

					<?php 
						if(isset($course->globals->fees_exception_text_ug)) echo $course->globals->fees_exception_text_ug;
					?>
				</div>
			</div>
			</div>

			<div class="key-facts-block">
			<aside class="key-facts-container">
				<h2>Key facts</h2>
				<div class="key-facts">
					<ul>
						<li>
							<?php if(!empty($course->additional_school[0])): ?>
								<strong>Schools:</strong> <a href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a>, <a href="<?php echo $course->url_for_additional_school ?>"><?php echo $course->additional_school[0]->name ?></a>
							<?php else: ?>
								<strong>School:</strong> <a href="<?php echo $course->url_for_administrative_school ?>"><?php echo $course->administrative_school[0]->name ?></a>
							<?php endif; ?>
						</li>
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

						<?php if(strpos($course->programme_type, "year abroad") !== false): ?>
							<li><strong>Year abroad:</strong> Yes</li>
						<?php endif; ?>

						<?php if(strpos($course->programme_type, "year in industry") !== false): ?>
							<li><strong>Year in Industry:</strong> Yes</li>
						<?php endif; ?>
					</ul>
				</div>
			</aside>
			</div>
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
		                        	<span><?php echo $related_course->name ?><?php if($related_course->subject_to_approval == 'true'){ echo " (subject to approval)";} ?></span>
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
                    	<span><?php echo $related_course->name ?><?php if($related_course->subject_to_approval == 'true'){ echo " (subject to approval)";} ?></span>
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