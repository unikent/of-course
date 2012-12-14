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
        <kentHideInBrowser>
            <!--#include virtual="Templates/dreamweaver-styles.shtml" -->
            <!--#include virtual="/Templates/dreamweaver-styles.shtml" -->
        </kentHideInBrowser>
        <kentIncludeJavascript />
        <!-- InstanceBeginEditable name="head" -->
        <script type='text/javascript' src='<?php echo BASE_URL ?>js/menu.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL ?>js/quickspot.js'></script>
        <link rel='stylesheet' href='<?php echo BASE_URL ?>css/courses.css' />

        <script type='text/javascript'>
            quickspot.attach({
                "url":"<?php echo BASE_URL ?>searchajax/<?php echo $type ?>/<?php echo $course->year ?>/",
                "target":"searchbox",
                "clickhandler":function(itm){
                    //Send em to page
                    document.location = '<?php echo BASE_URL.$type ?>/<?php echo $course->year ?>/'+itm.id+'/'+itm.slug;
                },
                "displayhandler": function(itm){
                    return itm.name+' (ID: '+itm.id+')'; //Do somthing useful like showing award once we have it.
                }
            });
        </script>

        <!-- InstanceEndEditable -->
    </head>
    <body>
        <kentPage>
            <kentPageHeader>
                <kentGlobalHeader/>
                <kentDepartmentHeader hideBanner='true'/>
            </kentPageHeader>
            <div class="grid_16 search_bar">
                            <div class="search_box">
                                <input id='searchbox' type="text" name="search" placeholder="Search all courses..." autocomplete="off">
                                <input type="image" src="<?php echo BASE_URL ?>/images/search.jpg">
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
            <kentPageBody>
                <kentPageBodyLeft>
                    <kentMenuGenerator name='left' maxDepth='3'>
                        <!-- InstanceBeginEditable name="menuParameters" -->
                        <param:menuGenerator name='buildAllMenus' value='true' />
                        <param:menuGenerator name='forceMenuHighlight' value='' />
                        <!-- InstanceEndEditable -->
                    </kentMenuGenerator>
                </kentPageBodyLeft>
                <kentPageBodyRight>
                    <kentUtilityBar/>
                    <kentPageContent>
                        <!-- InstanceBeginEditable name="content" -->
                        <h1><?php echo $course->programme_title; ?> <?php echo $course->award; ?> - <?php echo $course->year; ?></h1>
                        <p><?php echo  $course->programme_abstract; ?></p>
                        <div class="snippetBox">
                            <div class="tabs">
                                <ul class="tabsFallBackNav">
                                    <li><a href="#tab1">Overview</a></li>
                                    <li><a href="#tab2">Structure</a></li>
                                    <li><a href="#tab3">Teaching and assessment</a></li>
                                    <li><a href="#tab3">Careers</a></li>
                                    <li><a href="#tab3">Entry requirements</a></li>
                                    <li><a href="#tab3">Fees and funding</a></li>
                                    <li><a href="#tab3">Apply</a></li>
                                    <li><a href="#tab3">Further info</a></li>
                                </ul>
                                <?php Flight::render('tabs/overview', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/structure', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/teaching', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/careers', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/entry', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/fees', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/apply', array('course'=>$course)); ?>
                                <?php Flight::render('tabs/info', array('course'=>$course)); ?>
                            </div>
                        </div>
                        
                        <!-- InstanceEndEditable -->
                    </kentPageContent>
                </kentPageBodyRight>
            </kentPageBody>
            <kentPageFooter>
                <kentDepartmentFooter/>
                <kentGlobalFooter/>
            </kentPageFooter>
        </kentPage>
    </body>
<!-- InstanceEnd -->
</html>