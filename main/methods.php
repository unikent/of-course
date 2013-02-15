<?php
	
	/**
	 * Layout: applies layout wrapper to content
	 *
	 * @param $view View name
	 * @param $params Data for view
	 * @output Renders HTML to browser
	 */
	Flight::map('layout', function($view, $params){
		Flight::render($view, $params, 'content');
		Flight::render('layout');
	});

	/**
	 * URL: generate url with base path appended.
	 *
	 * @param $path path to link to
	 * @param $use_base use base URL
	 * @return string absoulte URL
	 */
	Flight::map('url', function($path, $use_base = true){
		return ($use_base) ? BASE_URL.'/'.$path : $path;
	});

	/**
	 * setup: Sets data for views
	 *
	 * @param $year Year to be displayed
	 * @param $level Undergraduate vs Postgraduate
	 * @param $preview true|false
	 */
	Flight::map('setup', function($year, $level, $preview = false){
		// Set data for view
		Flight::view()->set('level', (!$level) ? 'undergraduate' : $level);
		Flight::view()->set('year', $year);
		Flight::view()->set('preview', $preview);
	});

	// 404 handler
	Flight::map('notFound', function($data = array()){

		// Use data to try and figure out best 404 info
		// we can.
		echo '<pre>';print_r($data );
		die("bang");

		// Attempt to resolve URL details, location, path and other stuff
		// that will allow us to be more helpful.
	  
	    //Flight::setup(null,null);
	    // Output page with 404 header.
	     Flight::response()->status(404);
		return Flight::layout('missing_course');
	});



