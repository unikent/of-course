<?php
	use unikent\libs\Logger;

	/**
	 * Layout: applies layout wrapper to content
	 *
	 * @param $view View name
	 * @param $params Data for view
	 * @output Renders HTML to browser
	 */
	Flight::map('layout', function($view, $params = array()){
		Flight::render($view, $params, 'content');
		Flight::pantheon_render('layout', $params);
	});

	/**
	 * Render using pantheon
	 */
	Flight::map('pantheon_render', function($outer_view, $params){

		// define $template as a closure for getting the pantheon wrapper
		$template = function() use ($params)
		{
			if (defined("TEMPLATING_ENGINE"))
			{
				// Overwrite pantheon route with "URL route"
				// Remove any spaces that may cause issues for the pantheon renderer
				if(!LOCAL) define("RELATIVE_SITE_ROOT", str_replace(array(' ','%20',','),'_', parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)) . '/');

				// call pantheon
				require TEMPLATING_ENGINE . '/template.loader.php';

				// workaround for pantheon setting get and post to null if they're empty
				if ($_GET === null) $_GET = array();
				if ($_POST === null) $_POST = array();

				// Shim logging data
				foreach(Logger::get('warning') as $warn){
					inspect($warn);
				}
				foreach(Logger::get('debug') as $warn){
					debug($warn);
				}

				// run pantheon and store its output in a buffer
				ob_start();

				Flight::render('layout', $params);

				require TEMPLATING_ENGINE . '/run.php';
				$content = ob_get_contents();
				ob_end_clean();

				// Render with correct headers
				Flight::response()->write($content)->send();
			}else{
				Flight::render('layout');
			}
		};

		// go go gadget pantheon
		return $template();
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
		Logger::debug("[Cache] ".(string)$request."<br/>
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
			if($request !== null ){
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
		/*
		$pantheon_config = Util::getConfig();
		if($pantheon_config["theme"] != "Daedalus"){

			$page404 = Cache::get("courses-daedalus-chronos-error-page", function(){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://kent.ac.uk/404.html");//url
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_TIMEOUT, 2);

				$data = curl_exec($ch);

				curl_close($ch);

				return $data;
			}, 120);

			$page404 .= '<!-- loaded via chronos -->';

			// Avoid WSOD
			Flight::halt('404', $page404);
		}*/

		// Attempt to resolve URL details, location, path and other stuff
		// that will allow us to be more helpful.
		$data = validate_404_data($data);

		// Attempt to get programmes so we can make some suggestions
		try {
			$data['programmes'] = CoursesController::$pp->get_programmes_index($data['year'], $data['level']);
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
	function pantheon_escape($string) {
		return urlencode(
			str_replace(' ', '-',
				str_replace(',', '', $string)
			)
		);
	}
