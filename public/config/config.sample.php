<?php

$config['siteName']				=	'Daedalus';
$config['theme']				=	'Daedalus';


$config['headerType']  			=	'image';
$config['headerImage']			=	'images/design/headerImageExtended.jpg';
$config['keyText']				=	'Some sample text here';
$config['keyTextColour']		=	'to display online';

$config['footer'] = array(
	'author' => 'The IS Web Development Team',
	'contact' =>'The University of Kent, Canterbury, Kent, CT2 7NZ, T: +44 (0)1227 764000',
	'additional' => ''
);

/**
 * If there is no key text, this header image should be the full 960px
 * wide as it will extend across the whole page.
 */
 


/**
 * There are two properties for key text. The second will be coloured
 * using this site's secondary colour. Both will be capitalised before
 * being displayed. If your key text overruns the box it will be hidden,
 * so trial and error is required to find something which works.
 */



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
											'breadcrumbdividerlasthover.gif' => 'images/design/breadcrumbdividerlasthover.gif'
										),
										#'Gzip',
									);
									
$config['modules']				=	array(
										'InspectorOutput'
									);    
									
