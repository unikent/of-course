<?php

class CoursesFrontEnd {

	/**
	 * View (alt) - View a "live" programme from the programmes plant
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 * @param int Id of programme
	 * @param string Slug - programme name
	 */
	public function view($type, $year, $id, $slug = ''){
		
		//Use webservices to get course data
		$course_json = Cache::load(XCRI_WEBSERVICE.$year.'/'.$type.'/programme/'.$id, 5);//5 minute cache
		$course = json_decode($course_json);

		//debug option
		if(isset($_GET['debug_performance'])){ inspect($course); }

		//Check for errors
		if(isset($course->error)){
			return Flight::render('missing_course.php');
		}

		//fix slug paths
		if($course->slug != $slug){
 			return Flight::redirect($type.'/'.$year.'/'.$id.'/'.$course->slug);
 		}

 		//Layout switcher
		
		if($_GET['old']){
			//Render full page
			Flight::render('course_page_old', array('course'=>$course, 'type'=> $type));
		}else{
			//Render full page
			Flight::render('course_page', array('course'=>$course, 'type'=> $type));
		}
		
		
	}

	/**
	 * List programmes - Show a list of all programmes availble to the system.
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 */
	public function list_programmes($type, $year){

		$listing_json = Cache::load(XCRI_WEBSERVICE.$year.'/'.$type, 5);//5 minute cache

		$listing = json_decode($listing_json);

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
		
		Flight::render('search', array('programmes' => $programmes));
		
	}
	
	/**
	 * Search page
	 *
	 * @param string Type UG|PG
	 * @param yyyy Year to show
	 * @param int Id of programme
	 * @param string Slug - programme name
	 */
	public function search_alt($type, $year)
	{
	    $programmes_json = Cache::load(XCRI_WEBSERVICE.$year.'/'.$type, 5);//5 minute cache

		$programmes = json_decode($programmes_json);
		
		Flight::render('search_alt', array('programmes' => $programmes));
		
	}


}