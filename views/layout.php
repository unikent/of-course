<!-- InstanceBegin template="/Templates/daedalus_v1.dwt" codeOutsideHTMLIsLocked="false" -->
<!-- TEMPLATE_VERSION="Daedalus v1.0" -->
<kentWrapper type="standard">

	<kentMeta>
		<!-- InstanceBeginEditable name="metadata" -->
		<title>Test</title>
	
	
		<link rel='stylesheet' href='<?php echo BASE_URL ?>css/import.css' />
		<script type='text/javascript' src='<?php echo BASE_URL ?>js/menu.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL ?>js/quickspot.js'></script>

        <script type='text/javascript'>
            quickspot.attach({
                "url":"<?php echo BASE_URL ?>ajax/<?php echo $type ?>/<?php echo $year ?>/",
                "target":"searchbox",
                "search_on": ["name", "award", "subject", "main_school", "ucas_code", "search_keywords"],
                "click_handler":function(itm){
                    //Send em to page
                    document.location = '<?php echo BASE_URL.$type ?>/<?php echo $year ?>/'+itm.id+'/'+itm.slug;
                },
                "display_handler": function(itm){
                    return itm.name+' - <i>'+itm.award+'</i>'; //Do somthing useful like showing award once we have it.
                }
            });
        </script>
		
		
		<!-- InstanceEndEditable -->
	</kentMeta>
	<kentContent menu="false">
		<!-- InstanceBeginEditable name="content" -->

			<div class="search_bar">
                            <div class="search_box">
                                <input id='searchbox' type="text" name="search" placeholder="Search all courses..." autocomplete="off">
                                <input type="image" src="<?php echo BASE_URL ?>/images/search.jpg">
                            </div>
                            
                            <ul class="advsearch_links">
                                <li class="first advsearchlink"><a href="<?php echo BASE_URL.$type ?>/<?php echo $year ?>/search">Advanced search</a></li>
                            </ul>
                                    
                            <ul class="search_links">

                                <li class="first toplink">
                                    <?php Flight::render('menus/subjects', array('subjects' => $subjects, 'type' => $type, 'year' => $year)); ?>
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

                        <?php if(isset($preview) && $preview == trye):?>
                            <meta name="robots" content="noindex, nofollow">
                            <div style='color: #b94a48;background-color: #f2dede;border: 1px solid #eed3d7;margin:20px 15px 5px; font-size:12px;padding:6px;'>
                                You are currently viewing a preview of revision <strong><?php echo $course->revision_id; ?></strong>. This is preview data ONLY and is not representative of any course offered by this institution.
                            </div>
                        <?php endif;?>

                        <?php echo $content; ?>

		<!-- InstanceEndEditable -->
	</kentContent>

</kentWrapper>	
<!-- InstanceEnd -->