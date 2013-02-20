<?php

class CoursesFrontEnd {

	/**
	 * A Programmes Plant API Object.
	 */
	public static $pp = false;
	public static $current_year = '2014';

	// New frontend controller
	public function __construct()
	{
		static::$pp = new ProgrammesPlant\API(XCRI_WEBSERVICE);

		if (defined('CACHE_DIRECTORY') && is_dir(CACHE_DIRECTORY))
		{
			static::$pp->with_cache('file')->directory(CACHE_DIRECTORY);
		}

		static::$pp->no_ssl_verification();
	}
	
	/**
	 * View - View a "live" programme from the programmes plant, but without any year
	 *
	 * @param string $type undergraduate or postgraduate.
	 * @param yyyy Year to show
	 * @param int Id of programme
	 * @param string Slug - programme name
	 */
	public function view_noyear($level, $id, $slug = '')
	{
		return $this->view($level, static::$current_year, $id, $slug);
	}
	
	/**
	 * View - View a "live" programme from the programmes plant
	 *
	 * @param string $level undergraduate or postgraduate.
	 * @param yyyy Year to show
	 * @param int Id of programme
	 * @param string Slug - programme name
	 */
	public function view($level, $year, $id, $slug = '')
	{
 
		// Use webservices to get course data for programme.
		try
		{
			$course = static::$pp->get_programme($year, $level, $id);
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			// Not found?
			// Do 404 action, sending any useful enviormental data we have so it can be as useful as possible
			$data = array('slug' => $slug, 'id' => $id, 'year'=> $year, 'level' => $level, 'error'=> $e);
			return Flight::notFound($data);
		}catch(\Exception $e){
			// Another error type?
			$data = array('slug' => $slug, 'id' => $id, 'year'=> $year, 'level' => $level, 'error'=> $e);
			return Flight::notFound($data);
		}
		
		// Attempt to cache responce with browser + debug some extra information.
		Flight::cachecheck();

		// Debug option
		if(isset($_GET['debug_performance'])){ inspect($course); }
		
		// Fix slug paths
		if($course->slug != $slug)
		{	
			// If current year, don't bother with "year" in URL
			if($year == static::$current_year){
				return Flight::redirect('/' . $level . '/' . $id . '/' . $course->slug);
			}else{
				return Flight::redirect('/' . $level . '/' . $year . '/' . $id . '/' . $course->slug);	
			}
 		}

 		// Render programme page
 		Flight::setup($year, $level);
 		return Flight::layout('course_page', array('course'=>$course));
	}

	/**
	 * Display a preview page
	 *
	 * @param string $hash of preview
	 */
	public function preview($hash)
	{
		try
		{
			$course = static::$pp->get_preview_programme($hash);	
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{	
			// We dont know enough to help the 404 out really
			return Flight::notFound(array('error'=> $e));
		}catch(\Exception $e){
			// Another error. Pretend it was a 404.
			return Flight::notFound(array('error'=> $e));
		}

		Flight::cachecheck();

		// Debug option
		if(isset($_GET['debug_performance'])){ inspect($course); }
		
		Flight::setup($course->year, null, true);
		return Flight::layout('course_page', array('course'=> $course));
	}

	/**
	 * Search page
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 * @param string type of search
	 * @param string string to search
	 */
	public function search($level, $year, $search_type = '', $search_string = '')
	{

		Flight::setup($year, $level);

	    $programmes = static::$pp->get_programmes_index($year, $level);//5 minute cache

	    $campuses = static::$pp->get_campuses();
	    $subject_categories = static::$pp->get_subjectcategories();

		//debug option
		if(isset($_GET['debug_performance'])){ inspect($programmes); }
		
		//Render full page
		return Flight::layout('search', array('programmes' => $programmes, 'campuses' => $campuses, 'subject_categories' => $subject_categories, 'search_type' => $search_type, 'search_string' => $search_string));	
		
	}
	/**
	 * Search page (no year)
	 */
	public function search_noyear($level, $search_type = '', $search_string = '')
	{
		return $this->search($level, static::$current_year, $search_type, $search_string);
	}

	/**
	 * Data formatted for searching by quickspot
	 *
	 */
	public function ajax_search_data($level, $year)
	{
		$out = array();

		try{
			$js = static::$pp->get_programmes_index($year, $level);
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			return Flight::halt(501, "Fatal error in getting programmes index.");
		}

		// Try & cache
		Flight::cachecheck();

		echo json_encode($js);
	}

	/**
	 * Subjects Page
	 */
	public function ajax_subjects_page($level, $year)
	{
		try
		{
			$subjects = static::$pp->get_subjectcategories();
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			$subjects = array();	
		}

		// Try & cache
		Flight::cachecheck();

		Flight::setup($year, $level);
		return Flight::render('menus/subjects', array('subjects'=> $subjects));
	}



	/**
	 * Display subjects page
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 */
	public function subjects($level, $year)
	{	
		Flight::setup($year, $level);

		// Get feed
		try
		{
			$subjects = static::$pp->get_subject_index($year, $type);	
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			$subjects = array();	
		}

		return Flight::layout('subjects', array('subjects'=> $subjects));
	}
	
	/**
	 * List programmes - Show a list of all programmes availble to the system.
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 */
	public function list_programmes($level, $year)
	{
		$listing = static::$pp->get_programmes_index(static::$current_year, 'undergraduate');

		$year_for_url = empty($year) ? '' : ((strcmp($year, static::$current_year) == 0) ? '' : $year . '/');

		foreach($listing as $course){
			echo "<a href='". Flight::url("{$level}/{$year_for_url}{$course->id}/{$course->slug}") . "'>{$course->name}</a><br/>";
		}

		Flight::stop();
	}


	/**
	 * Subject leaflets page
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 */
	public function leaflets($level, $year)
	{
		
		Flight::setup($year, $level);

	    $leaflets = (array) static::$pp->get_subject_leaflets($year, $level);

	    // sort our leaflets
	    usort($leaflets, function($a,$b)
			{
				return strcmp($a->name, $b->name);
		});

		//debug option
		if(isset($_GET['debug_performance'])){ inspect($leaflets); }
		
		//Render full page
		Flight::layout('leaflets', array('leaflets' => $leaflets, 'type' => $level));	
		
	}


	/**
	 * Give a set of parameters attempt to automatically work out what the correct URL should be
	 *
	 * @param string $slug
	 * @param string $level UG|PG|Postgrad|UnderGrad
	 * @param yyyy Year to show
	 * @param INT ID
	 *
	 * will redirect or 404 depending on what it can guess accuratly.
	 */
	public function redirect_handler($slug, $level=null, $year=null, $id=null)
	{
		// Fill values if not provided
		if($year===null) $year = static::$current_year;
		if($level===null) $level = 'undergraduate';

		// Fix know "old" url styles
		if($level == 'undergrad' || $level == 'ug'){
			$level = 'undergraduate';
		}elseif($level == 'postgrad' || $level == 'pg'){
			$level = 'postgraduate';
		}

		// If its not fixed, then just go with default
		if($level != 'postgraduate' && $level != 'undergraduate')
		{
			$level = 'undergraduate';
		}

		// If we somehow hit a search url, fix it.
		if($slug=='search'){
			return Flight::redirect("{$level}/{$year}/search");
		}

		// If we have an id, try a direct redirect
		if($id !== null){
			// Auto fix
			$correct_url = Flight::url("{$level}/{$year}/{$id}/{$slug}", false);
			return Flight::redirect($correct_url);
		}

		// Else attempt a fix
		$programmes = $this->get_programme_index($year, $level);
		$correct_url = false;

		// look through the list and see if we recoginise that slug from anyware
		foreach($programmes as $programme){

			//echo $programme->name;
			if(strpos($programme->name, $slug) !== false || strpos($programme->slug, $slug) !== false){

				// If correct url IS NOT false, it means we have two results and cannot auto fix reliably.
				// Go to 404 in this case
				if($correct_url){
					$data = array('slug' => $slug, 'year'=> $year, 'level' => $level, 'error_msg' => "Multiple matches, unable to guess redirect.");
					return Flight::notFound($data);
				}
			
				// Correct URL	
				$correct_url = Flight::url("{$level}/{$year}/{$programme->id}/{$programme->slug}", false);
				//die($correct_url);
			}
		}
		// Only 1 matched result, send em on there wau
		if($correct_url) return Flight::redirect($correct_url);

		// Else 404, we cant help
		$data = array('slug' => $slug, 'year'=> $year, 'level' => $level,'error_msg' => "No matches found, unable to guess redirect.");
		return Flight::notFound($data);
	}

	// Quietly grab index
	private function get_programme_index($year, $level)
	{
		try
		{
			return static::$pp->get_programmes_index($year, $level);
		}
		catch(Exception $e)
		{
			return array();
		}
	}

}