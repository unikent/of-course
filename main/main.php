<?php

class CoursesFrontEnd {

	/**
	 * A Programmes Plant API Object.
	 */
	public $pp = false;
	public $current_year = '2014';

	public function __construct()
	{
		$this->pp = new ProgrammesPlant\API(XCRI_WEBSERVICE);

		if (defined('CACHE_DIRECTORY') && is_dir(CACHE_DIRECTORY))
		{
			$this->pp->with_cache('file')->directory(CACHE_DIRECTORY);
		}

		$this->pp->no_ssl_verification();
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
		$this->view($level, $this->current_year, $id, $slug);
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
			$course = $this->pp->get_programme($year, $level, $id);
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			// Not found?
			// Do 404 action, sending any useful enviormental data we have so it can be as useful as possible
			$data = array('slug' => $slug, 'id' => $id, 'year'=> $year, 'level' => $level);
			Flight::notFound($data);
		}
		
		// Debug option
		if(isset($_GET['debug_performance'])){ inspect($course); }
		
		// Fix slug paths
		if($course->slug != $slug)
		{
 			return Flight::redirect('/' . $type . '/' . $year_url . $id . '/' . $course->slug);
 		}

 		// Render programme page
 		Flight::setup($level, $year);
 		Flight::layout('course_page', array('course'=>$course));
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
			$course = $this->pp->get_preview_programme($hash);	
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{	
			// We dont know enough to help the 404 out really
			Flight::notFound();
		}

		// Debug option
		if(isset($_GET['debug_performance'])){ inspect($course); }
		
		Flight::setup($course->year, null, true);
		Flight::layout('course_page', array('course'=> $course));
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
			$subjects = $this->pp->get_subject_index($year, $type);	
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			$subjects = array();	
		}

		Flight::layout('subjects', array('subjects'=> $subjects));
	}
	
	/**
	 * List programmes - Show a list of all programmes availble to the system.
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 */
	public function list_programmes($level, $year)
	{
		$listing = $this->pp->get_programmes_index($this->current_year, 'undergraduate');

		$base_url = BASE_URL;

		foreach($listing as $course){
			echo "<a href='{$base_url}/{$level}/{$year}/{$course->id}/{$course->slug}'>{$course->name}</a><br/>";
		}

		Flight::stop();
	}

	/**
	 * Data formatted for searching by quickspot
	 *
	 */
	public function ajax_search_data($level, $year)
	{
		$out = array();

		try{
			$js = $this->pp->get_programmes_index($year, $level);
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			Flight::halt(501, "Fatal error in getting programmes index.");
		}

		//foreach($js as $j)$out[] = $j;
		echo json_encode($js);
	}

	/**
	 * Subjects Page
	 */
	public function ajax_subjects_page($level, $year)
	{
		try
		{
			$subjects = $this->pp->get_subjectcategories();
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			$subjects = array();	
		}

		return Flight::render('menus/subjects', array('type' => $level, 'year' => $year, 'subjects'=> $subjects));
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

	    $programmes = $this->pp->get_programmes_index($year, $level);//5 minute cache
	    $campuses = $this->pp->get_campuses();
	    $subject_categories = $this->pp->get_subjectcategories();

		//debug option
		if(isset($_GET['debug_performance'])){ inspect($programmes); }
		
		//Render full page
		Flight::layout('search', array('programmes' => $programmes, 'campuses' => $campuses, 'subject_categories' => $subject_categories, 'search_type' => $search_type, 'search_string' => $search_string));	
		
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

	    $leaflets = (array) $this->pp->get_subject_leaflets($year, $level);

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


	// Quietly grab index
	private function get_programme_index($year, $level)
	{
		try
		{
			return $this->pp->get_programmes_index($year, $level);
		}
		catch(Exception $e)
		{
			return array();
		}
	}

}