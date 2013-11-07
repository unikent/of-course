<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

require dirname(__FILE__) . '/config/paths.php';

require VENDOR_PATH . '/autoload.php';
require APP_PATH . '/main/main.php';
require APP_PATH . '/main/methods.php';

// Set view path
Flight::set('flight.views.path', APP_PATH . '/views');

// set the relative site root to get this to work nicely with pantheon
// we don't want this to happen if we're using file-based config locally though
if ( ! defined("FILE_CONFIG") || ( defined("FILE_CONFIG") &&  ! FILE_CONFIG ) )
{
    define("RELATIVE_SITE_ROOT", dirname(Flight::request()->url) . "/");
}

// Load Pantheon
if (defined("TEMPLATING_ENGINE"))
{
	require TEMPLATING_ENGINE . '/template.loader.php';
	
	// workaround for pantheon setting get and post to null if they're empty
	if ($_GET === null) $_GET = array();
	if ($_POST === null) $_POST = array();
	
	//Hook pantheon to render method
	Flight::after("layout", function(){
		require TEMPLATING_ENGINE . '/run.php';
	});
}

// Setup main object
$main = new CoursesFrontEnd();

// Define routes
// AJAX
Flight::route('/ajax/subjects/@level:undergraduate|postgraduate/', array($main,'ajax_subjects_page'));
Flight::route('/ajax/subjects/@level:undergraduate|postgraduate/@year:current', array($main,'ajax_subjects_page'));
Flight::route('/ajax/subjects/@level:undergraduate|postgraduate/@year:[0-9]+', array($main,'ajax_subjects_page'));

Flight::route('/ajax/leaflets/@level:undergraduate|postgraduate/', array($main,'ajax_leaflets_data'));
Flight::route('/ajax/leaflets/@level:undergraduate|postgraduate/@year:current', array($main,'ajax_leaflets_data'));
Flight::route('/ajax/leaflets/@level:undergraduate|postgraduate/@year:[0-9]+', array($main,'ajax_leaflets_data'));

Flight::route('/ajax/search/@level:undergraduate|postgraduate/', array($main,'ajax_search_data'));
Flight::route('/ajax/search/@level:undergraduate|postgraduate/@year:current', array($main,'ajax_search_data'));
Flight::route('/ajax/search/@level:undergraduate|postgraduate/@year:[0-9]+', array($main,'ajax_search_data'));


// Preview
Flight::route('/@level:undergraduate|postgraduate/preview/@hash', array($main,'preview'));

// simpleview
Flight::route('/@level:undergraduate|postgraduate/simpleview/@hash', array($main,'simpleview'));

//XCRIP-CAP feed
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/xcri', array($main, 'xcri_cap'));
Flight::route('/@level:undergraduate|postgraduate/xcri', array($main, 'xcri_cap_noyear'));
Flight::route('/xcri', array($main, 'xcri_cap_noparams'));

// Search
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/search/@search_type/@search_string', array($main,'search'));
Flight::route('/@level:undergraduate|postgraduate/search/@search_type/@search_string', array($main,'search_noyear'));
Flight::route('/@level:undergraduate|postgraduate/search', array($main,'search_noyear'));
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/search', array($main,'search'));

// New courses
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/new', array($main,'new_courses'));
Flight::route('/@level:undergraduate|postgraduate/new', array($main,'new_courses_noyear'));

//Subject leaflets
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/leaflets', array($main,'leaflets'));
Flight::route('/@level:undergraduate|postgraduate/leaflets', array($main,'leaflets_noyear'));

// Courses
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/@id:[0-9]+/@slug', array($main, 'view'));
Flight::route('/@level:undergraduate|postgraduate/@year:[0-9]+/@id:[0-9]+', array($main, 'view'));
Flight::route('/@level:undergraduate|postgraduate/@id:[0-9]+/@slug', array($main, 'view_noyear'));
Flight::route('/@level:undergraduate|postgraduate/@id:[0-9]+', array($main, 'view_noyear'));

// Legacy Courses
// These URLS look like: /undergrad/subjects/<subject name>/<slug>
Flight::route('/@level:undergrad|postgrad/subjects/[A-Za-z0-9\-_]+/@slug', function($level, $slug) use($main){
	$main->redirect_handler($slug, $level);
}); 
// Malformed ug/pg levels for search
Flight::route('/@level:undergrad|postgrad|ug|pg/@year:[0-9]+/search', function($level, $year) use($main){
	$main->redirect_handler("search", $level, $year);
}); 
Flight::route('/@level:undergrad|postgrad|ug|pg/search', function($level, $year) use($main){
	$main->redirect_handler("search", $level);
}); 
// Malformed ug/pg levels for programmes
Flight::route('/@level:undergrad|postgrad|ug|pg/@id:[0-9]+/@slug', function($level, $id, $slug) use($main){
	$main->redirect_handler($slug, $level, null, $id);
}); 
Flight::route('/@level:undergrad|postgrad|ug|pg/@year:[0-9]+/@id:[0-9]+/@slug', function($level, $year, $id, $slug) use($main){
	$main->redirect_handler($slug, $level, $year, $id);
});


// Override base urls
if (BASE_URL != '/')
{	
   Flight::request()->base = BASE_URL;
   Flight::request()->url = substr(Flight::request()->url, strlen(Flight::request()->base));
}


// Run Flight!
Flight::start();