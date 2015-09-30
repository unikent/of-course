<?php

// Make app main working dir for system
chdir (dirname(__FILE__));

define("APP_ROOT", dirname(__FILE__));

// Configs
require 'config.php';

// Load Composer
require '../vendor/autoload.php';

// Utils
require 'lib/utils.php';

// Autoload everything else
Flight::path('controllers/');


// Load routes
require "routes.php";