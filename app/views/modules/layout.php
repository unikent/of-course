<!-- InstanceBegin template="/Templates/daedalus_v1.dwt" codeOutsideHTMLIsLocked="false" -->
<!-- TEMPLATE_VERSION="Daedalus v1.0" -->
<kentWrapper type="simple">

  <kentMeta>
	<!-- InstanceBeginEditable name="metadata" -->
	<?php if(isset($meta) && isset($meta['title'])): ?>
		<title><?php echo $meta['title']; ?></title>
	<?php endif; ?>

	<?php if(isset($meta) && isset($meta['description'])): ?>
		<meta name="description" content="<?php echo $meta['description']; ?>" />
	<?php endif; ?>

	<!-- InstanceEndEditable -->
  </kentMeta>
  <kentContent>
	<!-- InstanceBeginEditable name="content" -->
	 
	 <?php echo $content; ?>

	<!-- InstanceEndEditable -->
  </kentContent>
  <kentScripts>
  	<script type="text/javascript" charset="utf8" src="<?php echo Flight::asset('js/build/moduletable.min.js'); ?>"></script>
  </kentScripts>

</kentWrapper>
<!-- InstanceEnd -->
