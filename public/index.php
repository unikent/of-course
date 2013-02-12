<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

require dirname(__FILE__) . '/config/paths.php';

require VENDOR_PATH . '/autoload.php';
require APP_PATH . '/main/main.php';
require APP_PATH . '/main/methods.php';

// Set view path
Flight::set('flight.views.path', APP_PATH . '/views');

// Load Pantheon
if (defined("TEMPLATING_ENGINE"))
{
	require TEMPLATING_ENGINE . '/template.loader.php';
	
	// workaround for pantheon setting get and post to null if they're empty
	if ($_GET === null) $_GET = array();
	if ($_POST === null) $_POST = array();
	
	//Hook pantheon to render method
	Flight::after("start", function(){
		require TEMPLATING_ENGINE . '/run.php';
	});
}

// Setup main object
$main = new CoursesFrontEnd();

// Define routes

// AJAX
Flight::route('/ajax/subjects/@type/@year', array($main,'ajax_subjects_page'));
Flight::route('/ajax/search/@type/@year/', array($main,'ajax_search_data'));

// Preview
Flight::route('/preview/@hash', array($main,'preview'));

// Key Pages
Flight::route('/@type/@year/search/@search_type/@search_string', array($main,'search'));
Flight::route('/@type/@year/search', array($main,'search'));
Flight::route('/@type/@year/', array($main,'list_programmes'));

// Subjects
Flight::route('/@type/@year/subjects/@id/@slug', array($main,'subject_view'));
Flight::route('/@type/@year/subjects', array($main,'subjects'));

//Subject leaflets
Flight::route('/@type/@year/leaflets', array($main,'leaflets'));

// Legacy Courses
// These URLS look like: /undergrad/subjects/<subject name>/<slug>
Flight::route('/undergrad/subjects/[A-Za-z]+/@slug', function($slug){
	Flight::redirect('/undergraduate/2014/' . $slug);
});

// Courses
Flight::route('/@type/@year/@id/@slug', array($main,'view'));
Flight::route('/@type/@year/@id', array($main,'view'));

// Run Flight!
Flight::start();