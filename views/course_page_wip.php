    <kentPageBody>
                <kentPageBodyFull>

                    <kentPageContent>                   
                    <div class="courses">
                    
                        <div class="container_16">
                        
	

                		<div class="grid_16" id="utilityBar">
                        			<div id="breadcrumbs">
                        			<ul>
                        				<li><a href="/">University of Kent<span class="forPrint"><sup> [7]</sup></span></a></li>
                        			</ul>
                        			</div>
                        			<div id="socialEvangeliser">
                                	<ul>
                                		<li class="share">
                                			<a class="addthis_button" href="http://www.addthis.com/bookmark.php">
                                				<img width="125" height="16" border="0" alt="Share" src="http://ct1.addthis.com/static/btn/v2/lg-share-en.gif">
                                			<span class="forPrint"><sup> [8]</sup></span></a>
                                		</li>
                                	</ul>
                                </div>
                        </div>
                    </div>
            	
                    	<div class="container_16">
                            <div class="grid_10">
                                 <h1><?php echo  $course->programme_title; ?> <?php echo $course->award->name; ?> - <?php echo $course->year; ?></h1>
                                <?php Flight::render('tabs/overview2', array('course'=>$course)); ?>
                            </div>
                            <div class="grid_6">
                            
                                <div id="key-facts">
                                    <h2>Key facts</h2>
                                    <ul>
                                      <li><strong>Subject area:</strong> <?php echo $course->subject_area_1->{1}->name;?></li>
                                      <li><strong>Award:</strong> <?php echo $course->award->{1}->name;?> </li>
                                      <li><strong>Honours type:</strong> <?php echo $course->honours_type;?> </li>
                                      <li><strong>Ucas code:</strong> <?php echo $course->ucas_code;?>  </li>
                                      <li><strong>Location:</strong> <?php echo $course->location->{1}->name;?>  </li>
                                      <li><strong>Mode of study:</strong> <?php echo $course->mode_of_study;?> 
                                      </li>
                                      <li><strong>Duration:</strong> <?php echo $course->duration;?></li>
                                      <li><strong>Start: </strong> <?php echo $course->start;?> </li>
                                      <li><strong>Accredited by</strong>: <?php echo $course->accredited_by;?>  </li>
                                      <li><strong>Total Kent credits:</strong> <?php echo $course->total_kent_credits_awarded_on_completion;?></li>
                                      <li><strong>Total ECTS credits:</strong> <?php echo $course->total_ects_credits_awarded_on_completion;?></li>
                                    </ul>
                                </div>
                             </div>


                        <div class="grid_16">
                        <?php Flight::render('tabs/structure', array('course'=>$course)); ?>
                        <?php Flight::render('tabs/teaching', array('course'=>$course)); ?>
                        <?php Flight::render('tabs/careers', array('course'=>$course)); ?>
                        <?php Flight::render('tabs/entry', array('course'=>$course)); ?>
                        <?php Flight::render('tabs/fees', array('course'=>$course)); ?>
                        <?php Flight::render('tabs/apply', array('course'=>$course)); ?>
                        <?php Flight::render('tabs/info', array('course'=>$course)); ?>
                        </div>
                        
                   
                            
                     
                	</div>
                    </div>

                        </kentPageContent>
        
    </kentPageBodyFull>
</kentPageBody>