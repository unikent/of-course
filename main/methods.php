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
		return ($use_base) ? BASE_URL.$path : $path;
	});

	Flight::map('setup', function($year, $level, $preview = false){

		// Ensure year is int and is valid
		// @todo Add method to get correct year
		if($year == 'auto' || $year == null || strlen($year) != 4) $year = 2014;
		$year = (int) $year;

		if($year == 0) $year = 2014;

		// If $level isn't one of valid types, set as UG.
		if ($level != 'undergraduate' && $level != 'postgraduate')
		{
			$level = 'ug';
		}

		// Contract long names.
		if ($level == 'undergraduate')
		{
			$level = 'ug';
		}
		elseif ($level == 'postgraduate') 
		{
			$level = 'pg';
		}
		
		// Set data to views
		Flight::set('type', $level);

		Flight::view()->set('type', $level);
		Flight::view()->set('year', $year);
		Flight::view()->set('preview', $preview);
	});
