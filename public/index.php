<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

require dirname(__FILE__) . '/../config/paths.php';

require APP_PATH . '/vendor/autoload.php';
require APP_PATH . '/main/main.php';

// Load Pantheon
if (defined("TEMPLATING_ENGINE"))
{
	require TEMPLATING_ENGINE . '/template.loader.php';
	
	//Hook pantheon to render method
	Flight::after("start", function(){
		require TEMPLATING_ENGINE . '/run.php';
	});
}

Flight::set('flight.views.path', APP_PATH . '/views');

Flight::map('layout', function($view, $params){
	Flight::render($view, $params, 'content');
	Flight::render('layout');
});

// Setup main object
$main = new CoursesFrontEnd();

// Define routes

//javascript
Flight::route('/searchajax/@type/@year/', array($main,'list_ajax'));
//key pages
Flight::route('/@type/@year/search', array($main,'search'));
Flight::route('/@type/@year/', array($main,'list_programmes'));
//courses
Flight::route('/@type/@year/@id', array($main,'view'));
Flight::route('/@type/@year/@id/@slug', array($main,'view'));

// Run Flight!
Flight::start();

?>
