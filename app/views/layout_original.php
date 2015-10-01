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
           <link rel='stylesheet' href='<?php echo Flight::request()->base; ?>css/import.css' />
        <kentHideInBrowser>
            <!--#include virtual="Templates/dreamweaver-styles.shtml" -->
            <!--#include virtual="/Templates/dreamweaver-styles.shtml" -->
        </kentHideInBrowser>
        <kentIncludeJavascript />

        <script type='text/javascript' src='<?php echo Flight::request()->base; ?>js/menu.js'></script>
        <script type='text/javascript' src='<?php echo Flight::request()->base; ?>js/quickspot.js'></script>

        <script type='text/javascript'>
            quickspot.attach({
                "url":"<?php echo Flight::request()->base; ?>searchajax/<?php echo $type ?>/<?php echo $year ?>/",
                "target":"searchbox",
                "clickhandler":function(itm){
                    //Send em to page
                    document.location = '<?php echo Flight::request()->base.$type ?>/<?php echo $year ?>/'+itm.id+'/'+itm.slug;
                },
                "displayhandler": function(itm){
                    return itm.name+' (ID: '+itm.id+')'; //Do somthing useful like showing award once we have it.
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


                        <?php echo $content; ?>
                    

            <kentPageFooter>
                <kentDepartmentFooter/>
                <kentGlobalFooter/>
            </kentPageFooter>
        </kentPage>
    </body>
<!-- InstanceEnd -->
</html