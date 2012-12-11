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

		// If we can't find the course give us a 404.
		if (! $course)
		{
			Flight::notFound();
		}

		// Debug option
		if(isset($_GET['showdata'])){ print_r($course );die(); }

		// Check for errors
		if(isset($course->error)){
			return Flight::render('missing_course.php');
		}

		// Auto correct wrong routes (ie slug is incorrect)
		if($course->slug_2 != $slug){
			return Flight::redirect($type.'/'.$year.'/'.$id.'/'.$course->slug_2);
		}

		// Render full page
		Flight::render('course_page.php', array('course'=>$course));		
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

}