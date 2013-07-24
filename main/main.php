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

/**
		if (defined('CACHE_DIRECTORY') && is_dir(CACHE_DIRECTORY))
		{
		    static::$pp->with_cache('file')->directory(CACHE_DIRECTORY);
		}
**/

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
	public function view($level, $year, $id, $slug = ''){

		$meta = array();
 
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
		}
		catch(\Exception $e)
		{
			// Another error type?
			$data = array('slug' => $slug, 'id' => $id, 'year'=> $year, 'level' => $level);
			return Flight::error($e, $data);
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

		$meta = array(
			'canonical' => Flight::url("{$level}/{$id}/{$course->slug}"),
			'description' => strip_tags($course->programme_abstract),
		);

		if($year && ($year !== static::$current_year)){
			$meta['canonical'] =  Flight::url("{$level}/{$year}/{$id}/{$course->slug}");	
		}

 		switch($level){
 			case 'postgraduate':
 				$template = 'pg_course_page';
				if($year && ($year !== static::$current_year)){
					$meta['title'] = "{$course->programme_title} | Postgraduate Programmes {$year} | The University of Kent";
				}
 				break;

 			default:
 				$template = 'ug_course_page';
				if($year && ($year !== static::$current_year)){
					$meta['title'] = "{$course->programme_title} ($course->ucas_code) | Undergraduate Programmes {$year} | The University of Kent";
				}
 				break;
 		}

 		return Flight::layout($template, array('meta' => $meta, 'course' => $course));
	}

	/**
	 * Display a preview page
	 *
	 * @param string $hash of preview
	 */
	public function preview($level, $hash)
	{
		try
		{
			$course = static::$pp->get_preview_programme($level, $hash);	
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{	
			// We dont know enough to help the 404 out really
			return Flight::notFound(array('error'=> $e));
		}
		catch(\Exception $e)
		{
			// Another error. Pretend it was a 404.
			return Flight::error($e);
		}

		Flight::cachecheck();

		// Debug option
		if(isset($_GET['debug_performance'])){ inspect($course); }
		
		Flight::setup($course->year, null, true);


		return Flight::layout($course->programme_level.'_course_page', array('course'=> $course));
	}
	
	/**
	 * Get the XCRI feed
	 *
	 * @param $year
	 * @param $level
	 */
	public function xcri_cap($level, $year)
	{
		try
		{
			$xcri_cap = static::$pp->get_xcri_cap($year, $level);
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{	
			// We dont know enough to help the 404 out really
			return Flight::notFound(array('error'=> $e));
		}
		catch(\Exception $e)
		{
			// Another error. Pretend it was a 404.
			return Flight::error($e);
		}

		Flight::cachecheck();

		// add appropriate content type header
		header("Content-type: text/xml; charset=utf-8");
		
		echo Flight::gzip($xcri_cap);

		Flight::stop();
	}

	/**
	 * Get the XCRI feed withought a year
	 *
	 * @param $level
	 */
	public function xcri_cap_noyear($level)
	{
		$year = static::$current_year;
		$this->xcri_cap($level, $year);
	}

	/**
	 * Get the XCRI feed withought any parameters
	 *
	 */
	public function xcri_cap_noparams()
	{
		$this->xcri_cap_noyear('undergraduate');
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

		switch($level){
			case 'postgraduate':
				$template = 'pg_search';
				$meta = array(
					'title' => 'Advanced Course Search | Undergraduate Programmes | The University of Kent',
					'description' => 'Search all of the undergraduate programmes offered by the University of Kent',
				);
				break;

			default:
				$template = 'ug_search';
				$meta = array(
					'title' => 'Advanced Course Search | Postgraduate Programmes | The University of Kent',
					'description' => 'Search all of the postgraduate programmes offered by the University of Kent',
				);
				break;
		}



		Flight::setup($year, $level);

		try {
			$programmes = static::$pp->get_programmes_index($year, $level);//5 minute cache
	    	$campuses = static::$pp->get_campuses();
	    	$subject_categories = static::$pp->get_subjectcategories();
		}
		catch(\Exception $e)
		{
			// Another error.
			return Flight::error($e);
		}

		//debug option
		if(isset($_GET['debug_performance'])){ inspect($programmes); }
		
		//Render full page
		return Flight::layout($template, array('meta' => $meta, 'programmes' => $programmes, 'campuses' => $campuses, 'subject_categories' => $subject_categories, 'search_type' => $search_type, 'search_string' => $search_string));	
		
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
		catch(\Exception $e)
		{
			// Another error.
			echo "{'error':'Unable to load data.'}";
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
		catch(\Exception $e)
		{
			$subjects = array();	
		}

		// Try & cache
		Flight::cachecheck();

		Flight::setup($year, $level);
		return Flight::render('menus/subjects', array('subjects'=> $subjects));
	}

	/**
	 * Get a json representation of the subject leaflets
	 *
	 */
	public function ajax_leaflets_data($level, $year)
	{
		$out = array();

		try{
			$js = static::$pp->get_subject_leaflets($year, $level);
		}
		catch(\Exception $e)
		{
			return Flight::halt(501, "Fatal error in getting subject leaflets.");
		}

		echo json_encode($js);
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
		catch(\Exception $e)
		{
			$subjects = array();	
		}

		return Flight::layout('subjects', array('subjects'=> $subjects));
	}
	
	/**
	 * List programmes - Show a list of all programmes availble to the system.
	 *
	 * @depricated
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 */
	public function list_programmes($level, $year)
	{
		$listing = static::$pp->get_programmes_index(static::$current_year, 'undergraduate');

		$year_for_url = empty($year) ? '' : ((strcmp($year, static::$current_year) == 0) ? '' : $year . '/');

		foreach($listing as $course)
		{
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
		if($slug == 'search')
		{
			return Flight::redirect(Flight::url("{$level}/search"), 301);
		}

		// If we have an id, try a direct redirect
		if($id !== null){
			// Auto fix
			return Flight::redirect(Flight::url("{$level}/{$year}/{$id}/{$slug}"), 301);
		}

		// Else attempt a fix
		$programmes = $this->get_programme_index($year, $level);

		$correct_url = false;
		$matches = 0;

		// look through the list and see if we recoginise that slug from anyware
		foreach($programmes as $programme)
		{
			if($programme->slug == $slug)
			{
				$correct_url = Flight::url("{$level}/{$year}/{$programme->id}/{$programme->slug}");
			} 
			elseif(strpos($programme->name, $slug) !== false || strpos($programme->slug, $slug) !== false)
			{
				$matches++;
			}
		}

		if($correct_url) // If there is an exact match, 301 redirect to it.
		{ 
			return Flight::redirect($correct_url, 301);
		} 
		elseif($matches > 0) // If there are multiple, inexact matches 404 with suggestions.
		{  
			$data = array('slug' => $slug, 'year'=> $year, 'level' => $level, 'error_msg' => "Multiple matches, unable to guess redirect.");
			return Flight::notFound($data);
		} 
		else // If there are no inexact matches, just 404.
		{
			return Flight::notFound();
		}
	}

	// Quietly grab index
	private function get_programme_index($year, $level)
	{
		try
		{
			return static::$pp->get_programmes_index($year, $level);
		}
		catch(\Exception $e)
		{
			return array();
		}
	}

}
