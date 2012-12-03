<?php

class CoursesFrontEnd {

	public function view($type, $year, $id){

		//echo XCRI_WEBSERVICE.$year.'/'.$type.'/programme/'.$id;

		$course_json = Cache::load(XCRI_WEBSERVICE.$year.'/'.$type.'/programme/'.$id, 5);//5 minute cache


	 	echo $course_json ;
		die();
	}

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