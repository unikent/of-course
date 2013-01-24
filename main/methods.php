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
