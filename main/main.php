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
		// Use webservices to get course data
		$course = $this->pp->get_programme($year, $type, $id);


		//debug option
		if(isset($_GET['debug_performance'])){ inspect($course); }

		// Check for errors / 404 (so we can show custom 404 page)
		if (! $course || isset($course->error)){
			return Flight::render('missing_course.php');
		}
		
		//fix slug paths
		if($course->slug != $slug){
 			return Flight::redirect($type.'/'.$year.'/'.$id.'/'.$course->slug);
 		}
 		//Layout switcher
		if(isset($_GET['old'])){
			//Render full page
			Flight::layout('course_page_old', array('course'=>$course, 'type'=> $type));
		}else{
			//Render full page
			Flight::layout('course_page', array('course'=>$course, 'type'=> $type));
		}
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
	public function list_ajax($type, $year){
		$out = array();
		$js = json_decode(Cache::load(XCRI_WEBSERVICE.$year.'/'.$type, 5));
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
	    $programmes_json = Cache::load(XCRI_WEBSERVICE.$year.'/'.$type, 5);//5 minute cache

		$programmes = json_decode($programmes_json);
		
		//Layout switcher
		if(isset($_GET['old'])){
			//Render full page
			Flight::render('search', array('programmes' => $programmes));
		}else{
			//Render full page
			Flight::render('search_old', array('programmes' => $programmes));
		}
		
		
	}

}