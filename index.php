<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Load flight
require 'flight/Flight.php';
require 'config/paths.php';
require 'main/main.php';

//Load Pantheon
require PANTHEON_ENGINE . '/template.loader.php';

//Hook pantheon to render method
Flight::after("render", function(){
	require PANTHEON_ENGINE . '/run.php';
});

//Setup main object
$main = new CoursesFrontEnd();

//define routes
Flight::route('/@type/@year/', array($main,'list_programmes'));
Flight::route('/@type/@year/@id/*', array($main,'view'));

//run FLIGHT
Flight::start();

?>
