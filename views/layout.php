<!-- InstanceBegin template="/Templates/daedalus_v1.dwt" codeOutsideHTMLIsLocked="false" -->
<!-- TEMPLATE_VERSION="Daedalus v1.0" -->
<kentWrapper type="courses" siteroot="<?php echo BASE_URL != '/' ? BASE_URL : ''; ?>/" mode="<?php echo $level;?>" year="<?php echo $year;?>" currentyear="<?php echo CoursesFrontEnd::$current_year;?>">

	<kentMeta>
		<!-- InstanceBeginEditable name="metadata" -->
		<title></title>
		<link href="<?php echo ASSET_URL; ?>/css/build/of-course.min.css" type="text/css" rel="stylesheet">
		<!-- InstanceEndEditable -->
	</kentMeta>
	<kentContent>
		<!-- InstanceBeginEditable name="content" -->

                <?php if(isset($preview) && $preview == true):?>
                    <meta name="robots" content="noindex, nofollow" />
                    <div class='alert alert-error' style="padding: 10px;margin:10px 0 0 0;">
                        You are currently viewing a preview of revision <strong><?php echo $course->revision_id; ?></strong>. This is preview data ONLY and is not representative of any course offered by this institution.
                    </div>
                <?php endif;?>

              <?php echo $content; ?>

		<!-- InstanceEndEditable -->
	</kentContent>	
</kentWrapper>	
<!-- InstanceEnd -->