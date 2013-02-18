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
	// Use data to try and figure out best 404 info
	Flight::map('notFound', function($data = array()){

		// Attempt to resolve URL details, location, path and other stuff
		// that will allow us to be more helpful.

		$url_chunks = explode('/', Flight::request()->url);

		// If we don't know level, try to work it out
		if(!isset($data['level'])){

			// First chunk should be level
			$level = $url_chunks[1];

			// If level is a known type
			if($level == 'undergraduate' || $level == 'ug' || $level == 'undergrad' )
			{
				$data['level']= 'undergraduate';
			}
			elseif($level == 'postgraduate' || $level == 'pg' || $level == 'postgrad' )
			{
				$data['level']= 'postgraduate';
			}
			else
			{
				// Else just guess its ug
				$data['level']= 'undergraduate';
			}
		}

		// If we don't know year, guess that instead
		if(!isset($data['year'])){

			$year = $url_chunks[2];
			// If this looks like a year. Try and use it
			if(is_numeric($year) && strlen($year)==4)
			{
				$data['year'] = $year;
			}
			else
			{
				$data['year'] = CoursesFrontEnd::$current_year;
			}
			
		}
		// try and guess slug
		if(!isset($data['slug'])){
			$final_part = $url_chunks[sizeof($url_chunks)-1];
			$data['slug'] = $final_part;
		}

		// Attempt to get programmes so we can make some suggestions
		try {
			$data['programmes'] = CoursesFrontEnd::$pp->get_programmes_index($data['year'], $data['level']);
		}catch(Exception $e){
			$data['programmes'] = array();
		}	

		// Set data & open views
	  	Flight::setup($data['year'], $data['level']);
	  	Flight::response()->status(404);
		return Flight::layout('missing_course', $data);
	});



