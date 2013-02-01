
			<h1 style='font-size:2.4em;padding:10px 0;'>
				<?php echo $course->programme_title; ?> <?php echo $course->award[0]->name; ?> - <?php echo $course->year; ?>
				<?php if($course->subject_to_approval == 'true'){ echo "<span>(Subject to approval)</span>";} ?>
			</h1>

			<?php if($course->programme_suspended == 'true' || $course->programme_withdrawn == 'true'): ?>
				<?php echo $course->holding_message; ?>
			<?php else: ?>
			<div class="row-fluid">
				<div class="span12">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#overview" data-toggle="tab">Overview</a></li>
						<li><a href="#structure" data-toggle="tab">Structure</a></li>
						<li><a href="#teaching" data-toggle="tab">Teaching and assessment</a></li>
						<li><a href="#careers" data-toggle="tab">Careers</a></li>
						<li><a href="#entry" data-toggle="tab">Entry requirements</a></li>
						<li><a href="#fees" data-toggle="tab">Fees and funding</a></li>
						<li><a href="#apply" data-toggle="tab">Apply</a></li>
						<li><a href="#info" data-toggle="tab">Further info</a></li>
					</ul>
				</div><!-- /span -->
			</div><!-- /row -->
			
			<div class="row-fluid">
				<div class="span7">
					<div class="tab-content">
						<div class="tab-pane active fade in" id="overview"><?php Flight::render('tabs/overview', array('course'=>$course)); ?></div>
						<div class="tab-pane fade" id="structure"><?php Flight::render('tabs/structure', array('course'=>$course)); ?></div>
						<div class="tab-pane fade" id="teaching"><?php Flight::render('tabs/teaching', array('course'=>$course)); ?></div>
						<div class="tab-pane fade" id="careers"><?php Flight::render('tabs/careers', array('course'=>$course)); ?></div>
						<div class="tab-pane fade" id="entry"><?php Flight::render('tabs/entry', array('course'=>$course)); ?></div>
						<div class="tab-pane fade" id="fees"><?php Flight::render('tabs/fees', array('course'=>$course)); ?></div>
						<div class="tab-pane fade" id="apply"><?php Flight::render('tabs/apply', array('course'=>$course)); ?></div>
						<div class="tab-pane fade" id="info"><?php Flight::render('tabs/info', array('course'=>$course)); ?></div>
					</div>
				</div><!-- /span -->
				<div class="span5">
					<div class="well">
					<span id="key-facts">Key facts</span>
					<ul>
						<li><strong>Subject area:</strong> <?php echo $course->subject_area_1[0]->name;?></li>
						<li><strong>Award:</strong> <?php echo $course->award[0]->name;?> </li>
						<li><strong>Honours type:</strong> <?php echo $course->honours_type;?> </li>
					
						<?php if(!empty($course->ucas_code)): ?>
						<li><strong>Ucas code:</strong> <?php echo $course->ucas_code;?>	</li>
						<?php endif; ?>
					
						<li><strong>Location:</strong> <a href="<?php echo $course->location[0]->url;?>"><?php echo $course->location[0]->name;?></a>	</li>
					
						<li><strong>Mode of study:</strong> <br><?php echo $course->mode_of_study;?></li>
					
						<?php if(!empty($course->duration)): ?>
						<li><strong>Duration:</strong> <br><?php echo $course->duration;?></li>
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
				</div><!-- /span -->
			</div><!-- /row -->
			
			<?php if (!empty($course->globals->general_disclaimer)): ?>
			<p class="general_disclaimer">
				<small><?php echo $course->globals->general_disclaimer; ?></small>
			</p>
			<?php endif;?>
						
			<?php endif;?>

			
			<script>   
				$(document).ready(function() {	   
					$('#myTab a').click(function (e) {
						e.preventDefault();
						$(this).tab('show');
					});
				});
			</script>