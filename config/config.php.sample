<?php

$config['siteName']				=	'Undergraduate Courses';

$config['theme']				=	'Chronos';


/**
 * If there is no key text, this header image should be the full 960px
 * wide as it will extend across the whole page.
 */
 
$config['headerType']  			=	'image';
$config['headerImage']			=	'config/images/header_undergrad12.jpg';

/**
 * There are two properties for key text. The second will be coloured
 * using this site's secondary colour. Both will be capitalised before
 * being displayed. If your key text overruns the box it will be hidden,
 * so trial and error is required to find something which works.
 */

$config['keyText']				=	'Some sample text here';
$config['keyTextColour']		=	'to display online';

/**
 * There are three defined colours. As a general rule, the primary
 * will be used the most, followed by the secondary and finally the
 * tertiary.
 * 
 * The primary and secondary will usually be different, complementing
 * colours while the tertiary will be a slight variation of the primary.
 *
 * Each colour has a text colour to ensure text on these backgrounds will
 * always be visible.
 *
 * The gradient start and end colour are used when autogenerating gradients
 * and are usually close to the primary/tertiary colours.
 */

$primaryColour 					= 	'#06210f'; 	# dark green
$primaryTextColour				=	'#ffffff';

$secondaryColour				=	'#345235'; 	# light green
$secondaryTextColour			=	'#ffffff';

$highlightPrimaryColour			=	'#937227'; 	# gold
$highlightPrimaryTextColour		=	'#ffffff';

$highlightSecondaryColour		=	'#bc9746'; 	# gold
$highlightSecondaryTextColour	=	'#ffffff';

$gradientStartColour			=	'#06210f'; # really dark green
$gradientEndColour				=	'#132b15'; # slightly less dark green

$config['cssModules']			= 	array(
										'StripComments',
										'Constants' => array(
											
											'primaryColour' => $primaryColour,
											'primaryTextColour' => $primaryTextColour,
											'highlightPrimaryColour' => $highlightPrimaryColour,
											'highlightPrimaryTextColour' => $highlightPrimaryTextColour,
											'secondaryColour' => $secondaryColour,
											'secondaryTextColour' => $secondaryTextColour,
											'gradientStartColour' => $gradientStartColour,
											'gradientEndColour' => $gradientEndColour,
										),										
										'Gradients' => array(
											'headerBackground' => array(
												'orientation' => 'vertical',
												'startColour' => $gradientStartColour,
												'endColour' => $gradientEndColour,
												'height' => 57,
												'width' => 1,
											),
											'keyTextBackground' => array(
												'orientation' => 'vertical',
												'startColour' => $gradientStartColour,
												'endColour' => $gradientEndColour,
												'height' => 174,
												'width' => 231,
											),
											'headerDividerBackground' => array(
												'orientation' => 'vertical',
												'startColour' => $gradientStartColour,
												'endColour' => $gradientEndColour,
												'height' => 16,
												'width' => 1,
											),
											'departmentFooterBackground' => array(
												'orientation' => 'vertical',
												'startColour' => $gradientStartColour,
												'endColour' => $gradientEndColour,
												'height' => 58,
												'width' => 1,
											),
										),
										'Polygons',
										'Images' => array(
											
											'headerImage.jpg' 	=> $config['headerImage'],
											'dreamweaverBackground.jpg' => 'images/dreamweaver/pageBackground.jpg',
											'dreamweaverBackgroundNoBanner.jpg' => 'images/dreamweaver/pageBackgroundNoBanner.jpg',
											'ulli.gif' => 'images/design/ulli.gif',
											'ululli.gif' => 'images/design/ululli.gif',
											'ulululli.gif' => 'images/design/ulululli.gif',
											'ululululli.gif' => 'images/design/ululululli.gif',
											'breadcrumbdivider.png' => 'images/design/breadcrumbdivider.png',
											'breadcrumbdividerhover.gif' => 'images/design/breadcrumbdividerhover.gif',
											'breadcrumbdividerspanhover.gif' => 'images/design/breadcrumbdividerspanhover.gif',
											'breadcrumbdividerlast.gif' => 'images/design/breadcrumbdividerlast.gif',
											'breadcrumbdividerlasthover.gif' => 'images/design/breadcrumbdividerlasthover.gif',
											'Bacchus/dreamweaver/defaultBackground.jpg' => 'images/dreamweaver/background.jpg'
										),
										#'Gzip',
									);
									
$config['modules']				=	array(
										'InspectorOutput',
									    'Layout/Head/IncludeMeta' => array(
											'pageTitleTag' => 'h1', //h1, h2 etc  ... no gt/lt symbols
											'globalSiteKeywords' => '',
											'globalSiteDescription' => '',
											'siteName' => $config['siteName']  
									    ),  
										'Chronos/DepartmentFooter' => array(
											'author' => 'C&DO Web Content and Editorial Team - &copy; University of Kent',
											'contact' => 'The University of Kent, Canterbury, Kent, CT2 7NZ, T: +44 (0)1227 764000',
											'bannerInfo' => 'Birds feeding. &copy; 2010 Josie'
										),
										'Snippets/ModuleCatalogueModule',
										'Snippets/ModuleCatalogueCollection',
										'Snippets/ModuleCatalogueSchool',
										'Snippets/ModuleCatalogueSubject',
										'Snippets/PGProgrammesSubject',
										'Snippets/PGProgrammesProgramme',
										'Snippets/PGProgrammesSearch',
										'Snippets/PGProgrammesList',
										'Snippets/PGProgrammes',
										'Snippets/UGProgrammesSubject',
										'Snippets/UGProgrammesProgramme',
										'Snippets/UGProgrammesSearch',
										'Snippets/UGProgrammesList',
										'Snippets/UGProgrammes',
										'Snippets/tagCloud',
										'Snippets/dataGrid',
										'Snippets/Coverflow',
										'Snippets/HorizontalRule',
										'Layout/Body/Analytics' => array(
											'accountNumber' => 'UA-25298482-1'
										),
										'Layout/Body/AddThis' => array(
											'text' => 'Kent.ac.uk',
											'onclickonly' => 'false',
											'services' => "", 
											'enabled' => 'true'
										),
										'Layout/Body/GlobalSearch' => array(
											'bgColour' => $primaryColour,
											//'imageUrl' => 'http://preview-www.kent.ac.uk/webteamtest/chronos-template/images/site/banner.jpg',
										//	'searchText' => 'Search kent on the web',
										)
									);