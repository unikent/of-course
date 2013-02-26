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
	   if (BASE_URL == '/')
	   {
    	   return ($use_base) ? BASE_URL.$path : $path;
	   }
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

	/**
	 * Cache check. 
	 * Use previous request responce data to find out if information from browser is still valid (and thus cacheable)
	 * Additionally provides debug info on request.
	 */
	Flight::map("cachecheck", function(){
		// Get last response.
		$request = CoursesFrontEnd::$pp->request;
		$response = $request->getResponse();
		$last_modified = $response->getLastModified();

		// Debug data if wanted.
		debug("[Cache] ".(string)$request."<br/>
			<br/>

			Received headers:
			<pre>
			".implode("\n", $response->getHeaderLines())."
			</pre>

			Request Information:
			<pre>
			".print_r($response->getInfo(), true)."
			</pre>
			Last Modified: {$last_modified}

		");

		// Cache if we can
		if($last_modified!==null) Flight::lastModified(strtotime($last_modified));

	});

	// Get last modified data from API (if possible, else null)
	Flight::map("last_modified", function(){
		$response = CoursesFrontEnd::$pp->request->getResponse();
		$last_modified = $response->getLastModified();
		if($last_modified === null){
			return null;
		}else{
			return strtotime($last_modified);
		}
	});

	// 404 handler
	// Use data to try and figure out best 404 info
	Flight::map('notFound', function($data = array()){

		$pantheon_config = Util::getConfig();
		if($pantheon_config["theme"] != "Daedalus"){
			// Avoid WSOD
			Flight::halt('404', "Error 404: webpage could not be found.");
		}
		
		// Attempt to resolve URL details, location, path and other stuff
		// that will allow us to be more helpful.
		$data = validate_404_data($data);

		// Attempt to get programmes so we can make some suggestions
		try {
			$data['programmes'] = CoursesFrontEnd::$pp->get_programmes_index($data['year'], $data['level']);
		}catch(Exception $e){
			$data['programmes'] = array();
		}	

		// Set data & open views
	  	Flight::setup($data['year'], $data['level']);
	  	Flight::response()->status(404);
		return Flight::layout('404', $data);
	});

	// 500 error handler
	Flight::map('error', function($error, $data = array()){

		// Attempt to resolve URL details, location, path and other stuff
		// that will allow us to be more helpful.
		$data = validate_404_data($data);

		// Fail mode action. Email for help?
		if(defined("FAIL_ALERT_EMAIL") && trim(FAIL_ALERT_EMAIL) != ''){

$message = "
500 error generated from: {$data["url"]} 
At: ".date(DATE_RFC822)."
On server: ".$_SERVER["HTTP_HOST"]."

Debug data:
".print_r($data, true)."

Error data:
".print_r($error, true)."
";

			mail(FAIL_ALERT_EMAIL, "Of-Course: 500 error", $message);
		}
		
		// Pass error message along
		$data['error'] = $error;

	    // Handle error
	    Flight::response()->status(500);
	    return Flight::layout('500', $data);
	});

	/**
	 * Validate 404 data. Attempt to guess correct URLS and routes for 404 page.
	 *
	 * @param $data
	 * @return $data
	 */
	function validate_404_data($data){

		// Get url
		$data['url'] = Flight::request()->url;

		// chunks
		$url_chunks = explode('/', $data['url']);

		// If we don't know level, try to work it out
		if(!isset($data['level'])){

			// First chunk should be level
			$level = isset($url_chunks[1]) ? $url_chunks[1] : '';

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

			$year = isset($url_chunks[2]) ? $url_chunks[2] : '';
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
		// Pretty up any weird code
		$data['slug'] = htmlentities($data['slug']);

		return $data;
	}