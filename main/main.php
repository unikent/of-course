<?php

class CoursesFrontEnd {

	/**
	 * A Programmes Plant API Object.
	 */
	public $pp = false;

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
	 * View - View a "live" programme from the programmes plant
	 *
	 * @param string $type undergraduate or postgraduate.
	 * @param yyyy Year to show
	 * @param int Id of programme
	 * @param string Slug - programme name
	 */
	public function view($type, $year, $id, $slug = '')
	{
		// If at this point the type is our shortened version, redirect to the long version.
		if ($type == 'ug')
		{
			Flight::redirect('/undergraduate' . '/' . $year . '/' . $id . '/' . $slug);
		}
		elseif ($type == 'pg') 
		{
			Flight::redirect('/postgraduate' . '/' . $year . '/' . $id . '/' . $slug);
		}

		// Clean up variables.
		Flight::setup($type, $year);

		$type = Flight::get('type');

		// Use webservices to get course data for programme.
		try
		{
			$course = $this->pp->get_programme($year, $type, $id);
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			// 404? handle has missing/unknown course
			Flight::response()->status(404);
			return Flight::layout('missing_course', array('slug'=> $slug, 'id'=>$id, 'programmes'=> $this->get_programme_index($year, $type)));
		}
		
		// Debug option
		if(isset($_GET['debug_performance'])){ inspect($course); }
		
		// Fix slug paths
		if($course->slug != $slug)
		{
 			return Flight::redirect('/' . $type . '/' . $year . '/' . $id . '/' . $course->slug);
 		}

 		// Render programme page
 		Flight::layout('course_page', array('course'=>$course, 'type'=> $type, 'subjects'=> $subjects));
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
			// 404? handle has missing/unknown course
			Flight::response()->status(404);
			Flight::setup('auto', 'auto', true);
			return Flight::layout('missing_course');
		}

		Flight::setup('auto', $course->year, true);

		// Debug option
		if(isset($_GET['debug_performance'])){ inspect($course); }
		
		Flight::layout('course_page', array('course'=> $course));
	}

	/**
	 * Display subjects page
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 */
	public function subjects($type, $year)
	{	
		Flight::setup($type, $year);

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
	public function list_programmes($type, $year)
	{
		$listing = $this->pp->get_programmes_index('2014', 'ug');

		$base_url = BASE_URL;

		foreach($listing as $course){
			echo "<a href='{$base_url}/{$type}/{$year}/{$course->id}/{$course->slug}'>{$course->name}</a><br/>";
		}

		Flight::stop();
	}

	/**
	 * Data formatted for searching by quickspot
	 *
	 */
	public function ajax_search_data($type, $year)
	{
		$out = array();
		try{
			$js = $this->pp->get_programmes_index($year, $type);
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			die("fatal erorr.");
		}
		foreach($js as $j)$out[] = $j;
		echo json_encode($out);
	}

	/**
	 * Subjects Page
	 */
	public function ajax_subjects_page($type, $year)
	{
		try
		{
			$subjects = $this->pp->get_subjectcategories();
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			$subjects = array();	
		}

		return Flight::render('menus/subjects', array('type' => $type, 'year' => $year, 'subjects'=> $subjects));
	}

	/**
	 * Search page
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 * @param int Id of programme
	 * @param string Slug - programme name
	 */
	public function search($type, $year, $search_type = '', $search_string = '')
	{
		Flight::setup($type, $year);

	    $programmes = $this->pp->get_programmes_index($year, $type);//5 minute cache
	    $campuses = $this->pp->get_campuses();
	    $subject_categories = $this->pp->get_subjectcategories();

		//debug option
		if(isset($_GET['debug_performance'])){ inspect($programmes); }
		
		//Render full page
		Flight::layout('search', array('programmes' => $programmes, 'campuses' => $campuses, 'subject_categories' => $subject_categories, 'search_type' => $search_type, 'search_string' => $search_string));	
		
	}


	// Quietly grab index
	private function get_programme_index($year, $type)
	{
		try
		{
			return $this->pp->get_programmes_index($year, $type);
		}
		catch(Exception $e)
		{
			return array();
		}
	}

}