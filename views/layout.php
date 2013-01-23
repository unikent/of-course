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
           <link rel='stylesheet' href='<?php echo BASE_URL ?>css/import.css' />
        <kentHideInBrowser>
            <!--#include virtual="Templates/dreamweaver-styles.shtml" -->
            <!--#include virtual="/Templates/dreamweaver-styles.shtml" -->
        </kentHideInBrowser>
        <kentIncludeJavascript />

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
        <!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
    </head>
    <body>
        <kentPage>
            <kentPageHeader>
                <kentGlobalHeader/>
                <kentDepartmentHeader hideBanner='true'/>
            </kentPageHeader>
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

                        <?php echo $content; ?>
                    

            <kentPageFooter>
                <kentDepartmentFooter/>
                <kentGlobalFooter/>
            </kentPageFooter>
        </kentPage>
    </body>
<!-- InstanceEnd -->
</html>