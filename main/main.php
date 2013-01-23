<?php

class CoursesFrontEnd {

	/**
	 * A Programmes Plant API Object.
	 */
	public $pp = false;

	public function __construct()
	{
		$this->pp = new ProgrammesPlant\API(XCRI_WEBSERVICE);
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
		// Use webservices to get course data & subject data
		$course = $this->pp->get_programme($year, $type, $id);
		$subjects = $this->pp->get_subject_index($year, $type);

		Flight::view()->set('type', $type);
		Flight::view()->set('year', $year);

		// Debug option
		if(isset($_GET['debug_performance'])){ inspect($course); }

		// Check for errors / 404 (so we can show custom 404 page)
		if (! $course || isset($course->error)){
			return Flight::render('missing_course.php');
		}
		
		// Fix slug paths
		if($course->slug != $slug){
 			return Flight::redirect($type.'/'.$year.'/'.$id.'/'.$course->slug);
 		}

 		Flight::layout('course_page', array('course'=>$course, 'type'=> $type, 'subjects'=> $subjects));
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
	 *
	 *
	 */
	public function list_ajax($type, $year){
		$out = array();
		$js = $this->pp->get_programmes_index($year, $type);
		foreach($js as $j)$out[] = $j;
		echo json_encode($out);
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
		//debug option
		if(isset($_GET['debug_performance'])){ inspect($programmes); }
		
		//Render full page
		Flight::layout('search', array('programmes' => $programmes));	
		
	}

}