<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Load flight
require 'flight/Flight.php';
require 'config/paths.php';
require 'main/main.php';

//Load Pantheon
require PANTHEON_ENGINE . '/template.loader.php';

$main = new CoursesFrontEnd();

Flight::route('/@type/@year/', array($main,'list_programmes'));
Flight::route('/@type/@year/@id/*', array($main,'view'));

Flight::start();

//Post proccess Results
require PANTHEON_ENGINE . '/run.php';
?>
