<?php
use unikent\libs\Config;

// Make app main working dir for system
chdir (dirname(__FILE__));
define("APP_ROOT", dirname(__FILE__));

// Configs
require 'config.php';

// Load Composer & other utils
require '../vendor/autoload.php';
require 'shared/autoloader.php';
require 'lib/utils.php';

// Configure cache
Config::set("cachedir", CACHE_DIRECTORY);

// Autoload everything else
Flight::path('controllers/');

// Routes
require "routes.php";

// Create asset path
Flight::request()->asset = Flight::request()->base;
if(!defined("LOCAL") || !LOCAL){
	// shim paths (since this sits along side other content, its base path is one level down)
	Flight::request()->base = dirname(Flight::request()->base);
	Flight::request()->url = substr(Flight::request()->url, strlen(Flight::request()->base));
}