<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/chronos_v1.dwt" codeOutsideHTMLIsLocked="false" -->
<!-- TEMPLATE_VERSION="Chronos v1.0" -->
    <head>
        <!-- InstanceBeginEditable name="doctitle" -->
        <title></title>
        <!-- InstanceEndEditable -->
        <kentIncludeMeta>
        <!-- InstanceBeginEditable name="metadata" -->
            <!--<meta name="keywords" content="" />-->
            <!--<meta name="description" content="" />-->
        <!-- InstanceEndEditable -->
        </kentIncludeMeta>
        <kentIncludeCSS />
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css" type="text/css" media="all" />
        <link rel='stylesheet' href='/css/livesearch.css' />
<link rel='stylesheet' href='/css/960.css' />
<link rel='stylesheet' href='/css/browser.css' />
<link rel='stylesheet' href='/css/maps.css' />
        <kentHideInBrowser>
            <!--#include virtual="Templates/dreamweaver-styles.shtml" -->
            <!--#include virtual="/Templates/dreamweaver-styles.shtml" -->
        </kentHideInBrowser>
        <kentIncludeJavascript />
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
        <script type='text/javascript' src='/js/menu.js'></script>
        <script type='text/javascript' src='/js/insta_search.js'></script>
        <!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
    </head>
    <body>
        <kentPage>
            <kentPageHeader>
                <kentGlobalHeader/>
                <kentDepartmentHeader hideBanner='true'/>
            </kentPageHeader>
            <kentPageBody>
                <kentPageBodyFull>
                
                

                    <kentPageContent>
                    
                    <div class="maps" id="maps">
                    
                        <div class="container_16">
                        <div class="grid_16 search_bar">
                			<div class="search_box">
                            	<input type="text" name="search" placeholder="Search all courses..." autocomplete="off">
                            	<input type="image" src="/images/search.jpg">
                            </div>
                            
                            <ul class="advsearch_links">
                                <li class="first advsearchlink"><a href="/ug/2014/search/alt">Advanced search</a></li>
                            </ul>
                            		
                			<ul class="search_links">
                			    <li class="first toplink"><a href="" id="campuses_and_centres_anchor">Subjects</a>
                		
                            		<div id="campuses_and_centres_links" class="megamenu" style="display: none; ">
                            			<div class="maps_megacontentarea">
                            				<div class="megacontentsection">
                                				Architecture
                            				</div>
                            				<div class="megacontentsection">
                                				Finance
                            				</div>
                            				<div class="megacontentsection">
                                				American Studies
                            				</div>
                            				<div class="megacontentsection">
                                				English
                            				</div>
                            				<div class="megacontentsection">
                                				History
                            				</div>
                            				<div class="megacontentsection">
                                				Biology
                            				</div>
                            			</div>
                            		</div>
                
                        		</li>
                        		
                    			<li class="first toplink"><a href="" id="campuses_and_centres_anchor">Schools</a>
                		
                        		    <div id="campuses_and_centres_links" class="megamenu" style="display: none; ">
                        			<div class="maps_megacontentarea">
                        				<div class="megacontentsection">
                            				Architecture</h3>
                        				</div>
                        				<div class="megacontentsection">
                            				Finance
                        				</div>
                        				<div class="megacontentsection">
                            				Law
                        				</div>
                        				<div class="megacontentsection">
                            				Anthropology
                        				</div>
                        				<div class="megacontentsection">
                            				Biosciences
                        				</div>
                        			</div>
                        		</div>
                
                        		</li>
                        		
                                	
                            	<li class="last toplink"><a href="">More</a>
                            	
                            		<div id="more_links" class="megamenu" style="display: none; ">
                            			<div class="maps_megacontentarea">
                                			
                                			<div class="megacontentsection">
                            					Undergraduate study
                            				</div>
                            				<div class="megacontentsection">
                            					About
                            				</div>
                            				<div class="megacontentsection">
                            					Courses (2013 entry)
                            				</div>
                            				<div class="megacontentsection">
                            					Applications
                            				</div>
                            				<div class="megacontentsection">
                            					How it works
                            				</div>
                            				<div class="megacontentsection">
                            					Part-time study
                            				</div>
                            				<div class="megacontentsection">
                            					Mature students
                            				</div>
                            				<div class="megacontentsection">
                            					Why study at Kent
                            				</div>
                            				<div class="megacontentsection">
                            					What do  our students say?
                            				</div>
                            				<div class="megacontentsection">
                            					Downloads
                            				</div>
                            			</div>
                            		</div>
                            
                            	</li>
                            </ul>
			
                        </div>
		
                        <div class="clear"></div>

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
                        <h1><?php echo $course->programme_title; ?> <?php echo $course->award; ?> - <?php echo $course->year; ?></h1>
                        <p><?php echo  $course->programme_abstract; ?></p>
                        <div class="snippetBox">
                            <div class="tabs">
                                <ul class="tabsFallBackNav">
<!--
                                    <li><a href="#tab1">Overview</a></li>
                                    <li><a href="#tab2">Structure</a></li>
                                    <li><a href="#tab3">Teaching and assessment</a></li>
                                    <li><a href="#tab3">Careers</a></li>
                                    <li><a href="#tab3">Entry requirements</a></li>
                                    <li><a href="#tab3">Fees and funding</a></li>
                                    <li><a href="#tab3">Apply</a></li>
                                    <li><a href="#tab3">Further info</a></li>
-->
                                </ul>
                                <?php Flight::render('tabs/overview2', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/structure', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/teaching', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/careers', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/entry', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/fees', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/apply', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/info', array('course'=>$course)); ?>
                            </div>
                        </div>
                        
                        
                    </div><!--/grid_10-->
                            
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
                	</div>
                    </div>
                    
                    </kentPageContent>
                    
                </kentPageBodyFull>
            </kentPageBody>
            <kentPageFooter>
                <kentDepartmentFooter/>
                <kentGlobalFooter/>
            </kentPageFooter>
        </kentPage>
    </body>
<!-- InstanceEnd -->
</html>