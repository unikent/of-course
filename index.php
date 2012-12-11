<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Load Composer
require dirname(__FILE__) . '/vendor/autoload.php';

require dirname(__FILE__) . '/config/paths.php';
require dirname(__FILE__) . '/main/main.php';

// Load Pantheon
if (defined(TEMPLATING_ENGINE))
{
	require TEMPLATING_ENGINE . '/template.loader.php';

	//Hook pantheon to render method
	Flight::after("render", function(){
		require TEMPLATING_ENGINE . '/run.php';

	});
}

// Setup main object
$main = new CoursesFrontEnd();

// Define routes
Flight::route('/@type/@year/', array($main,'list_programmes'));

Flight::route('/@type/@year/@id', array($main,'view'));
Flight::route('/@type/@year/@id/@slug', array($main,'view'));

// Run Flight!
Flight::start();

?>
