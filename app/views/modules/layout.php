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

		<link media='screen' type='text/css' rel='stylesheet' href='<?php echo Flight::asset('css/DT_bootstrap.css'); ?>' />
		<style>
			.container .dataTables_filter {
				padding: 10px;
				background-color: #fbf7eb;
				margin-bottom:10px;
			}
			.container .dataTables_filter label {
				float:none;
				margin-bottom: 0;
			}
			.container .dataTables_filter label input {
				border-radius: 0;
				margin-left:10px;
			}
		</style>
		<!-- InstanceEndEditable -->
	</kentMeta>
	<kentContent>
		<!-- InstanceBeginEditable name="content" -->
		
		<?php echo $content; ?>

		<!-- InstanceEndEditable -->
	</kentContent>
</kentWrapper>
<!-- InstanceEnd -->

