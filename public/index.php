<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include "../app/bootstrap.php";

// shim paths (since this sits along side other content, its base path is one level down)
if(!defined("LOCAL") || !LOCAL){
	Flight::request()->base = dirname(Flight::request()->base);
	Flight::request()->url = substr(Flight::request()->url, strlen(Flight::request()->base));
}

// And away we go!
Flight::start();