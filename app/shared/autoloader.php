<?php
// Autoloader for shared libs

spl_autoload_register(function($class){
	// Namespace
	$ns = 'unikent\libs\\';
	// If namespace exists, build path to file and include it, if it exists
	if(strpos($class, $ns) !== false){
		$path = dirname(__FILE__).'/libs/'.str_replace($ns, '', $class).'.php';

		if(file_exists($path)) include $path;
	}
});