<article class="container">
	<h1>
		<?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?>
		<?php if($course->subject_to_approval == 'true'){ echo "<span>(Subject to approval)</span>";} ?>
	</h1>
	
	<?php if($course->programme_suspended == 'true' || $course->programme_withdrawn == 'true'): ?>
		<?php echo $course->holding_message; ?>
	<?php else: ?>
	<div class="row-fluid">
		<div class="span12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#overview" data-toggle="tab">Overview</a></li>
				<li><a href="#structure" data-toggle="tab">Course structure</a></li>
				<li><a href="#teaching" data-toggle="tab">Teaching &amp; Assessment</a></li>
				<li><a href="#careers" data-toggle="tab">Careers</a></li>
				<li><a href="#entry" data-toggle="tab">Entry requirements</a></li>
				<li><a href="#fees" data-toggle="tab">Fees &amp; Funding</a></li>
				<li><a href="#apply" data-toggle="tab">Apply</a></li>
				<li><a href="#info" data-toggle="tab">Further info</a></li>
			</ul>
		</div><!-- /span -->
	</div><!-- /row -->
	
	<div class="row-fluid">
		<div class="span7">
			<div class="tab-content">
				<section class="tab-pane active fade in" id="overview"><?php Flight::render('tabs/overview', array('course'=>$course)); ?></section>
				<section class="tab-pane fade" id="structure"><?php Flight::render('tabs/structure', array('course'=>$course)); ?></section>
				<section class="tab-pane fade" id="teaching"><?php Flight::render('tabs/teaching', array('course'=>$course)); ?></section>
				<section class="tab-pane fade" id="careers"><?php Flight::render('tabs/careers', array('course'=>$course)); ?></section>	
				<section class="tab-pane fade" id="entry"><?php Flight::render('tabs/entry', array('course'=>$course)); ?></section>
				<section class="tab-pane fade" id="fees"><?php Flight::render('tabs/fees', array('course'=>$course)); ?></section>
				<section class="tab-pane fade" id="apply"><?php Flight::render('tabs/apply', array('course'=>$course)); ?></section>
				<section class="tab-pane fade" id="info"><?php Flight::render('tabs/info', array('course'=>$course)); ?></section>
			</div>
		</div><!-- /span -->
		<div class="span5">
			<aside class="key-facts-container">
				<h2>Key facts</h2>
				<div class="key-facts">
					<ul>
						<li><strong>Subject area:</strong> <?php echo $course->subject_area_1[0]->name;?></li>
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
		</div><!-- /span -->
	</div><!-- /row -->
	
	<section>
		<h3>Related to this course</h3>

	</section>
	
	<div id="myCarousel" class="carousel slide">
  <!-- Carousel items -->
  <div class="carousel-inner">
  <?php $count = 0; ?>
  <?php for( $i = 0; $i < ( intval( count($course->related_courses) / 4 ) ) + 1; $i++ ): ?>
  <?php $related_courses = array_slice($course->related_courses, $i*4) ?>
	<div class="<?php if ($count == 0) echo 'active ' ?>item">
		<div class="row">
			<?php foreach($related_courses as $related_course): ?>
			<a href="../<?php echo $related_course->id ?>/<?php echo $related_course->slug ?>">
				<div class="span3 related-course alert alert-info">
	              <h4><?php echo $related_course->name ?></h4>
	              <p></p>
	              <p><?php echo $related_course->award ?> <?php echo $related_course->mode_of_study ?></p>
	              <p><?php echo $related_course->campus ?> campus</p>
	              <p><?php echo $related_course->subject ?> subject area</p>
	              <p>UCAS code <?php echo $related_course->ucas_code ?></p>
				</div>
			</a>
			<?php $count++; if ($count%4 == 0) break; ?>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endfor; ?>
  </div>
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>


	
<!-- 	 [id] => 235 [name] => Accounting and Finance [slug] => accounting-and-finance [award] => BA (Hons) [subject] => Accounting & Finance [main_school] => Kent Business School [secondary_school] => [campus] => Canterbury [new_programme] => [subject_to_approval] => [mode_of_study] => Full-time only [ucas_code] => N400 [search_keywords] => accounting and finance,ba,hons, business [campus_id] => 1 [pos_code] => ACCF:BA ) -->
	
	<?php if (!empty($course->globals->general_disclaimer)): ?>
	<footer class="general_disclaimer">
		<small><?php echo $course->globals->general_disclaimer; ?></small>
	</footer>
	<?php endif;?>
				
	<?php endif;?>
</article>