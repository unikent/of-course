<?php
	use unikent\libs\Log;
	use unikent\kent_theme\KentThemeHelper;

	/**
	 * Layout: applies layout wrapper to content
	 *
	 * @param $view View name
	 * @param $params Data for view
	 * @output Renders HTML to browser
	 */
	Flight::map('layout', function($view, $params = array(), $layout = 'layout'){
		Flight::render($view, $params, 'content');
		// allow alternate layout to be passed as param
		Flight::render($layout, $params);
	});

	Flight::map("fetch", function($view, $params = array()){
		return Flight::view()->fetch($view, $params);
	});

	

	/**
	 * URL: generate url with base path appended.
	 *
	 * @param $path path to link to
	 * @return string absoulte URL
	 */
	Flight::map("url", function($url = '/'){

		if($url === '/') return Flight::request()->base;

		if(Flight::request()->base == '/'){
			return '/'.$url;
		}else{
			return Flight::request()->base.'/'.$url;
		}
	});

	/**
	 * URL: generate url with base path appended.
	 *
	 * @param $path path to link to
	 * @return string absoulte URL
	 */
	Flight::map("asset", function($url = '/'){

		if($url === '/') return Flight::request()->asset;

		if(Flight::request()->asset == '/'){
			return '/'.$url;
		}else{
			return Flight::request()->asset.'/'.$url;
		}
	});
	/**
	 * gzip the content if the request can handle gzipped content
	 *
	 * @param $content The string to gzip
	 * @return $content Hopefully gzipped
	 */
	Flight::map('gzip', function($content){

		// what do we have in our Accept-Encoding headers
		$HTTP_ACCEPT_ENCODING = isset($_SERVER["HTTP_ACCEPT_ENCODING"]) ? $_SERVER["HTTP_ACCEPT_ENCODING"] : '';

		// set the right encoding
		if( headers_sent() )
			$encoding = false;
		else if( strpos($HTTP_ACCEPT_ENCODING, 'x-gzip') !== false )
			$encoding = 'x-gzip';
		else if( strpos($HTTP_ACCEPT_ENCODING,'gzip') !== false )
			$encoding = 'gzip';
		else
			$encoding = false;

		if($encoding){
			// Add the appropriate encoding header and gzip our content
			header('Content-Encoding: ' . $encoding);
			$content = "\x1f\x8b\x08\x00\x00\x00\x00\x00" . gzcompress($content);
		}

		return $content;
	});

	Flight::map("validYear", function($year){
		return ($year == 'current' || (int)$year > 2013);
	});

	/**
	 * setup: Sets data for views
	 *
	 * @param $year Year to be displayed
	 * @param $level Undergraduate vs Postgraduate
	 * @param $preview true|false
	 * @param $simpleview true|false
	 */
	Flight::map('setup', function($year, $level, $preview = false, $simpleview = false){

		// Set data for view
		Flight::view()->set('level', (!$level) ? 'undergraduate' : $level);
		Flight::view()->set('year', $year);
		Flight::view()->set('preview', $preview);
		Flight::view()->set('simpleview', $simpleview);
	});

	/**
	 * Cache check.
	 * Use previous request responce data to find out if information from browser is still valid (and thus cacheable)
	 * Additionally provides debug info on request.
	 */
	Flight::map("cachecheck", function(){
		// Get last response.
		$request = CoursesController::$pp->request;
		$response = $request->getResponse();
		$last_modified = $response->getLastModified();


		// Debug data if wanted.
		Log::debug("[Cache] ".(string)$request."<br/>
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
		// Try / Catch
		try {
			// Get request
			$request = CoursesController::$pp->request;
			// If its okay, get responce
			if($request !== null && $request !== false ){
				$response = $request->getResponse();
				// Grab last modified, and return it if its not invalid.
				$last_modified = $response->getLastModified();
				if($last_modified !== null) return strtotime($last_modified);
			}
			return null;
		}
		catch(Exception $e)
		{
			return null;
		}
	});

	// 404 handler
	// Use data to try and figure out best 404 info
	Flight::map('notFound', function($data = array()){

		// Attempt to resolve URL details, location, path and other stuff
		// that will allow us to be more helpful.
		$data = validate_404_data($data);

		/*
		// Attempt to get programmes so we can make some suggestions
		try {
			$data['programmes'] = CoursesController::$pp->get_programmes_index($data['year'], $data['level']);
		}catch(Exception $e){
			$data['programmes'] = array();
		}

		*/
		$_GET['q'] = $data['slug'];
		KentThemeHelper::_404();

	});

	// 500 error handler
	Flight::map('error', function($error, $data = array()){

		/** @var Exception $error */
		// Attempt to resolve URL details, location, path and other stuff
		// that will allow us to be more helpful.
		$data = validate_404_data($data);

		$message = "
				500 error generated from: {$data["url"]}
				At: ".date(DATE_RFC822)."
				On server: ".$_SERVER["HTTP_HOST"]."

				Debug data:
				".print_r($data, true)."

				Error data:
				". get_class($error) . " '{$error->getMessage()}' in {$error->getFile()}({$error->getLine()})\n
			";

		// Fail mode action. Email for help?
		if(defined("FAIL_ALERT_EMAIL") && trim(FAIL_ALERT_EMAIL) != ''){
			mail(FAIL_ALERT_EMAIL, "Of-Course: 500 error", $message);
		}

		KentThemeHelper::_500('',$message);

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
				$data['year'] = CoursesController::$current_year;
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

	/**
	* Escape invalid characters that cause pantheon to chunder (for subject categories)
	*
	* @param $string
	* @return string
	*/
	function slug_escape($string) {
		return urlencode(
			str_replace(' ', '-',
				str_replace(',', '', $string)
			)
		);
	}
