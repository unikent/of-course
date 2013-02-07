<?php

class CoursesFrontEnd {

	/**
	 * A Programmes Plant API Object.
	 */
	public $pp = false;

	public function __construct()
	{
		$this->pp = new ProgrammesPlant\API(XCRI_WEBSERVICE);
		$this->pp->no_ssl_verification();
	}

	/**
	 * View - View a "live" programme from the programmes plant
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 * @param int Id of programme
	 * @param string Slug - programme name
	 */
	public function view($type, $year, $id, $slug = '')
	{

		Flight::view()->set('type', $type);
		Flight::view()->set('year', $year);

		// Use webservices to get course data for programme
		try
		{
			$course = $this->pp->get_programme($year, $type, $id);
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			// 404? handle has missing/unknown course
			Flight::response()->status(404);
			return Flight::layout('missing_course');
		}
		
		// Debug option
		if(isset($_GET['debug_performance'])){ inspect($course); }
		
		// Fix slug paths
		if($course->slug != $slug){
 			return Flight::redirect($type.'/'.$year.'/'.$id.'/'.$course->slug);
 		}

 		// Render programme page
 		Flight::layout('course_page', array('course'=>$course, 'type'=> $type, 'subjects'=> $subjects));
	}

	/**
	 * Display a preview page
	 *
	 * @param string $hash of preview
	 */
	public function preview($hash){

		//Set vars
		Flight::view()->set('type', 'ug');
		Flight::view()->set('year', $course->year);
		Flight::view()->set('preview', true);

		try
		{
			$course = $this->pp->get_preview_programme($hash);	
		}
		catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
		{
			// 404? handle has missing/unknown course
			Flight::response()->status(404);
			return Flight::layout('missing_course');
		}

		try 
		{
			$subjects = $this->pp->get_subject_index($course->year, 'ug');
		} 
		catch(Exception $e)
		{ 	
			// If this fails, so be it. Move on.
			$subjects = array();
		}

		// Debug option
		if(isset($_GET['debug_performance'])){ inspect($course); }

		Flight::layout('course_page', array('course'=>$course, 'type'=> 'ug', 'subjects'=> $subjects));
	}

	/**
	 * Display subjects page
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 */
	public function subjects($type, $year)
	{
		// Get feed
		$subjects = $this->pp->get_subject_index($year, $type);	
		Flight::view()->set('type', $type);
		Flight::view()->set('year', $year);

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
			echo "<a href='{$base_url}{$type}/{$year}/{$course->id}/{$course->slug}'>{$course->name}</a><br/>";
		}
		die();
	}

	/**
	 * Data formatted for searching by quickspot
	 *
	 */
	public function ajax_search_data($type, $year){
		$out = array();
		$js = $this->pp->get_programmes_index($year, $type);
		foreach($js as $j)$out[] = $j;
		echo json_encode($out);
	}
	/**
	 * Subjects Page
	 *
	 */
	public function ajax_subjects_page(){

		$subjects = $this->pp->get_subjectcategories();

		return Flight::render('menus/subjects', array('subjects'=> $subjects));
	}


	
	
	/**
	 * Search page
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 * @param int Id of programme
	 * @param string Slug - programme name
	 */
	public function search($type, $year)
	{

		Flight::view()->set('type',$type);
		Flight::view()->set('year',$year);

	    $programmes = $this->pp->get_programmes_index($year, $type);//5 minute cache
	    $campuses = $this->pp->get_campuses();
	    $subject_categories = $this->pp->get_subjectcategories();
		//debug option
		if(isset($_GET['debug_performance'])){ inspect($programmes); }
		
		//Render full page
		Flight::layout('search', array('programmes' => $programmes, 'campuses' => $campuses, 'subject_categories' => $subject_categories));	
		
	}

}