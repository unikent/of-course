<!-- InstanceBegin template="/Templates/daedalus_v1.dwt" codeOutsideHTMLIsLocked="false" -->
<!-- TEMPLATE_VERSION="Daedalus v1.0" -->
<kentWrapper type="courses" siteroot="<?php echo BASE_URL != '/' ? BASE_URL : ''; ?>/" mode="<?php echo $level;?>" year="<?php echo $year;?>" currentyear="<?php echo CoursesFrontEnd::$current_year;?>">

	<kentMeta>
		<!-- InstanceBeginEditable name="metadata" -->
		<?php if(isset($meta) && isset($meta['title'])): ?>
		<title><?php echo $meta['title']; ?></title>
		<?php endif; ?>

		<?php if(isset($meta) && isset($meta['description'])): ?>
		<meta name="description" content="<?php echo $meta['description']; ?>" /> 
		<?php endif; ?>

		<?php if(isset($meta) && isset($meta['canonical'])): ?>
		<link rel="canonical" href="<?php echo $meta['canonical']; ?>" />
		<?php endif; ?>


		<link media='screen' type='text/css' rel='stylesheet' href='<?php echo ASSET_URL ?>/css/courses.css' />

		<!-- InstanceEndEditable -->
	</kentMeta>
	<kentContent>
		<!-- InstanceBeginEditable name="content" -->
			<kentAttribute name='last_updated' default='<?php echo time(); ?>'><?php echo Flight::last_modified(); ?></kentAttribute>

                <?php if(isset($preview) && $preview == true):?>
                    <meta name="robots" content="noindex, nofollow" />
                    <div class='alert alert-error' style="padding: 10px;margin:10px 0 0 0;">
                        You are currently viewing a preview of revision <strong><?php echo $course->revision_id; ?></strong>. This is preview data ONLY and is not representative of any course offered by this institution.
                    </div>
                <?php endif;?>

              <?php echo $content; ?>


              <a href='#' onclick= "$('html, body').scrollTop();" class='scroll-to-top'>
             	 <i class="icon-chevron-up icon-white"></i>
              </a>

		<!-- InstanceEndEditable -->
	</kentContent>
	<kentScripts>
		<script type="text/javascript" charset="utf8" src="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.1/jquery.dataTables.min.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo ASSET_URL ?>/js/build/of-course.min.js"></script>
	</kentScripts>
</kentWrapper>	
<!-- InstanceEnd -->