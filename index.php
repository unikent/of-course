<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Load flight
require 'flight/Flight.php';
require 'config/paths.php';
require 'main/main.php';

//Load Pantheon
require PANTHEON_ENGINE . '/template.loader.php';

//Hook pantheon to render method
Flight::after("start", function(){
	require PANTHEON_ENGINE . '/run.php';
});

//Setup main object
$main = new CoursesFrontEnd();

//define routes
Flight::route('/@type/@year/search', array($main,'search'));

Flight::route('/@type/@year/@id', array($main,'view'));
Flight::route('/@type/@year/@id/@slug', array($main,'view'));


Flight::route('/ajax/@type/@year/', array($main,'list_programmes'));

//run FLIGHT
Flight::start();

?>
