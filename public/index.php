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
Flight::route('/ajax/subjects/@type:(undergraduate|postgraduate)/@year:[0-9]+', array($main,'ajax_subjects_page'));
Flight::route('/ajax/search/@type:(undergraduate|postgraduate)/@year:[0-9]+/', array($main,'ajax_search_data'));

// Preview
Flight::route('/preview/@hash', array($main,'preview'));

// Key Pages
Flight::route('/@type:(undergraduate|postgraduate)/@year:[0-9]+/search/@search_type/@search_string', array($main,'search'));
Flight::route('/@type:(undergraduate|postgraduate)/@year:[0-9]+/search', array($main,'search'));
Flight::route('/@type:(undergraduate|postgraduate)', array($main,'list_programmes'));

// Subjects
Flight::route('/@type:(undergraduate|postgraduate)/@year:[0-9]+/subjects/@id:[0-9]+/@slug', array($main,'subject_view'));
Flight::route('/@type:(undergraduate|postgraduate)/@year:[0-9]+/subjects', array($main,'subjects'));

//Subject leaflets
Flight::route('/@type:(undergraduate|postgraduate)/@year:[0-9]+/leaflets', array($main,'leaflets'));

// Courses
Flight::route('/@type:(undergraduate|postgraduate)/@year:[0-9]+/@id:[0-9]+/@slug', array($main,'view'));
Flight::route('/@type:(undergraduate|postgraduate)/@year:[0-9]+/@id:[0-9]+', array($main,'view'));
Flight::route('/@type:(undergraduate|postgraduate)/@id:[0-9]+/@slug', array($main,'view_noyear'));
Flight::route('/@type:(undergraduate|postgraduate)/@id:[0-9]+', array($main,'view_noyear'));

// Legacy Courses
// These URLS look like: /undergrad/subjects/<subject name>/<slug>
Flight::route('/undergrad/subjects/[A-Za-z]+/@slug', function($slug){
	Flight::redirect('/undergraduate/2014/' . $slug);
});

// Override base urls
Flight::request()->base = BASE_URL;
Flight::request()->url = substr(Flight::request()->url, strlen(Flight::request()->base));

// Run Flight!
Flight::start();