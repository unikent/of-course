<?php

class CoursesFrontEnd {

	/**
	 * View - View a "live" programme from the programmes plant
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
		if(isset($_GET['showdata'])){ print_r($course );die(); }

		//Check for errors
		if(isset($course->error)){
			return Flight::render('missing_course.php');
		}

		//auto correct wrong routes (ie slug is incorrect)
		if($course->slug_2 != $slug){
			return Flight::redirect($type.'/'.$year.'/'.$id.'/'.$course->slug_2);
		}

		//Render full page
		Flight::render('course_page.php', array('course'=>$course));
		
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


}