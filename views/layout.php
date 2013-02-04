<!-- InstanceBegin template="/Templates/daedalus_v1.dwt" codeOutsideHTMLIsLocked="false" -->
<!-- TEMPLATE_VERSION="Daedalus v1.0" -->
<kentWrapper type="courses" siteroot="<?php echo BASE_URL; ?>" mode="<?php echo $type;?>" year="<?php echo $year;?>">

	<kentMeta>
		<!-- InstanceBeginEditable name="metadata" -->
		<title>Test</title>
		<!-- InstanceEndEditable -->
	</kentMeta>
	<kentContent>
		<!-- InstanceBeginEditable name="content" -->

                        <?php if(isset($preview) && $preview == true):?>
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