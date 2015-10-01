<?php
use unikent\libs\Config;

// Make app main working dir for system
chdir (dirname(__FILE__));

define("APP_ROOT", dirname(__FILE__));

// Configs
require 'config.php';

// Load Composer
require '../vendor/autoload.php';
require 'shared/autoloader.php';
// Utils
require 'lib/utils.php';

// Autoload everything else
Flight::path('controllers/');

Config::set("cachedir", CACHE_DIRECTORY);
// Load routes
require "routes.php";