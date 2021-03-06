<?php
use unikent\libs\Cache;
use unikent\libs\Log;

class CoursesController {

	/**
	* A Programmes Plant API Object.
	*/
	public static $pp = false;
	public static $current_year = 'current';

	// New frontend controller
	public function __construct()
	{
		static::$pp = new ProgrammesPlant\API(XCRI_WEBSERVICE);


		if (defined('CACHE_DIRECTORY') && is_dir(CACHE_DIRECTORY))
		{
			static::$pp->with_cache('file')->directory(CACHE_DIRECTORY);
		}

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
			// Year to old
			if($year < 2014){
				$data = array('slug' => $slug, 'id' => $id, 'year'=> $year, 'level' => $level, 'error'=> $e);
				return Flight::notFound($data);
			}

			// Another error type?
			$data = array('slug' => $slug, 'id' => $id, 'year'=> $year, 'level' => $level);
			return Flight::error($e, $data);
		}

		$years = static::$pp->make_request("$level/year");
		// Attempt to cache responce with browser + debug some extra information.
		Flight::cachecheck();

		// Debug option
		if(isset($_GET['debug_performance'])){ Log::warning($course); }

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
		$course->locations_str = $this->getCourseLocations($course);
		$course->locations_str_linked = $this->getCourseLocationsLinked($course);
		$course->award_list	= $this->getCourseAwardList($course);
		$course->award_list_linked = $this->getCourseAwardListLinked($course);

		$meta = array(
			'title'=> "{$course->programme_title} - {$course->award_list} - {$course->locations_str} - The University of Kent",
			'canonical' => Flight::url("{$level}/{$id}/{$course->slug}"),
			'active_instance' => Flight::url("{$level}/{$id}/{$course->slug}"),
			'description' => strip_tags($course->programme_abstract),
		);

		if($year && ($year !== static::$current_year)){
			$meta['canonical'] =  Flight::url("{$level}/{$year}/{$id}/{$course->slug}");
		}

		switch($level){
			case 'postgraduate':
			if($year && ($year !== static::$current_year)){
				$meta['title'] = "{$course->programme_title} | Postgraduate Programmes {$year} | The University of Kent";
			}

			$course->module_list = array();

			if(is_array($course->modules)){
				foreach ($course->modules as $delivery_modules) {
					if(!is_object($delivery_modules->stages)) continue;

					foreach ($delivery_modules->stages as $stage) {
						if(!is_object($stage->clusters)) continue;

						foreach ($stage->clusters as $clusters) {
							if(!is_array($clusters)) continue;

							foreach ($clusters as $cluster) {
								if(!is_object($cluster->modules)) continue;

								foreach ($cluster->modules as $modules) {
									if(!is_array($modules)) continue;
									foreach ($modules as $module) {

										//skip blanks
										if ($module->module_code == '') continue;
										// index on module code, so duplicates will just overwrite each other
										$course->module_list[$module->module_code] = $module;
									}
								}
							}
						}
					}
				}
			}
			break;

			default:

			if($year && ($year !== static::$current_year)){
				$meta['title'] = "{$course->programme_title} ($course->ucas_code) | Undergraduate Programmes {$year} | The University of Kent";
			}
			break;
		}

		// Additional data
		$data = array(
			"school_name" => $course->administrative_school[0]->name,
			"has_parttime" => (strpos(strtolower($course->mode_of_study), 'part-time') !== false),
			"has_fulltime" => (strpos(strtolower($course->mode_of_study), 'full-time') !== false),
			'meta' => $meta,
			'layout' => $level === 'postgraduate' ? 'pg' : 'ug',
			'years' => $years
		);

		// Course object should be global for views
		Flight::view()->set('course', $course);

		// Pass additional data
		return Flight::layout('course', $data);
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

			$years = static::$pp->make_request("$level/year");

			Flight::cachecheck();

			// Debug option
			if(isset($_GET['debug_performance'])){Log::warning($course); }

			Flight::setup($course->year, $level, true);

			$course->locations_str = $this->getCourseLocations($course);
			$course->locations_str_linked = $this->getCourseLocationsLinked($course);
			$course->award_list	= $this->getCourseAwardList($course);
			$course->award_list_linked = $this->getCourseAwardListLinked($course);
			$course->years = $years->years;
			$course->current_year = $years->current;
			$course->programmme_status_text = '';

			// Additional data
			$data = array(
				"school_name" => $course->administrative_school[0]->name,
				"has_parttime" => (strpos(strtolower($course->mode_of_study), 'part-time') !== false),
				"has_fulltime" => (strpos(strtolower($course->mode_of_study), 'full-time') !== false),
				'meta' => $meta,
				'layout' => $level === 'postgraduate' ? 'pg' : 'ug',
				'years' => $years
			);

			// Course object should be global for views
			Flight::view()->set('course', $course);

			return Flight::layout('course', $data);
		}

	/**
	* Display a simpleview page
	*
	* @param string $hash of simpleview
	*/
	public function simpleview($level, $hash)
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
		if(isset($_GET['debug_performance'])){ Log::warning($course); }

		Flight::setup($course->year, $level, false, true);

		return Flight::render('simpleview_course_page', array('course'=> $course));
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
		if(!Flight::validYear($year)){
			return Flight::notFound();
		}

		// get all the years on offer, most recent first
		$years_data = static::$pp->make_request("$level/year");

		// make sure the most recent year is first
		rsort($years_data->years);

		// this is used in the search results listing, so we can output the correct year for each course in the link, if needed
		$year_for_url = ($year == 'current' || $year == static::$current_year ? '' : $year . '/');

		// set default meta info
		$title = 'Courses A-Z';
		$template = 'ug/search';
		$meta = array(
			'title' => 'Courses A-Z | Undergraduate courses | The University of Kent',
			'description' => 'Search all of the undergraduate courses offered by the University of Kent',
		);

		// if we have multiple years the meta info needs changing
		if ( $level != 'postgraduate' && $year != 'current' && sizeof($years) > 1 && defined("SHOW_UG_PREVIOUS_YEAR_BANNER") && SHOW_UG_PREVIOUS_YEAR_BANNER == true ) {
			$title = 'Courses A-Z '. $year;
			$template = 'ug/search';
			$meta = array(
				'title' => 'Courses A-Z | Undergraduate courses ' . $year . ' | The University of Kent',
				'description' => 'Search all of the undergraduate courses for ' . $year . ' offered by the University of Kent',
			);
		}
		// pg meta info
		elseif ( $level == 'postgraduate' ) {
			$title = 'Courses A-Z';
			$template = 'pg/search';
			$meta = array(
				'title' => 'Courses A-Z | Postgraduate courses | The University of Kent',
				'description' => 'Search all of the postgraduate courses offered by the University of Kent',
			);
		}

		Flight::setup($year, $level);

		try {
			$programmes = static::$pp->get_programmes_index($year, $level);//5 minute cache

			$campuses = static::$pp->get_campuses();
			$subject_categories = static::$pp->get_subjectcategories($level);
			$awards = static::$pp->get_awards($level);
			$award_names = array();
			foreach ($awards as $award)
			{
				$award_names[] = $award->name;
			}
			sort($award_names);
		}
		catch(\Exception $e)
		{
			// Another error.
			return Flight::error($e);
		}

		//debug option
		if(isset($_GET['debug_performance'])){ Log::warning($programmes); }

		//Render full page
		return Flight::layout($template, array('meta' => $meta, 'programmes' => $programmes, 'campuses' => $campuses, 'subject_categories' => $subject_categories, 'search_type' => $search_type, 'search_string' => $search_string, 'awards' => $award_names, 'disable_search_bar' => true, 'title' => $title, 'years' => $years_data->years, 'year_for_url' => $year_for_url));

	}
	/**
	* Search page (no year)
	*/
	public function search_noyear($level, $search_type = '', $search_string = '')
	{
		return $this->search($level, static::$current_year, $search_type, $search_string);
	}

	/**
	* new courses list
	*
	* @param string Type UG|PG
	* @param yyyy Year to show
	*/
	public function new_courses($level, $year)
	{
		switch($level){
			case 'postgraduate':
			$template = 'new_courses';
			$meta = array(
				'title' => 'New Courses A-Z | Postgraduate courses | The University of Kent',
				'description' => 'Search all of the new postgraduate courses offered by the University of Kent',
			);
			break;

			default:
			$template = 'new_courses';
			$meta = array(
				'title' => 'New Courses A-Z | Undergraduate courses | The University of Kent',
				'description' => 'Search all of the new undergraduate courses offered by the University of Kent',
			);
			break;
		}


		Flight::setup($year, $level);

		try {
			$programmes = static::$pp->get_programmes_index($year, $level);//5 minute cache
		}
		catch(\Exception $e)
		{
			// Another error.
			return Flight::error($e);
		}

		//debug option
		if(isset($_GET['debug_performance'])){ Log::warning($programmes); }

		//Render full page
		return Flight::layout($template, array('meta' => $meta, 'programmes' => $programmes, 'level' => $level));
	}

	/**
	* Search page (no year)
	*/
	public function new_courses_noyear($level)
	{
		return $this->new_courses($level, static::$current_year);
	}

	/**
	* study abroad courses list
	*
	* @param string Type UG|PG
	* @param yyyy Year to show
	*/
	public function study_abroad($level, $year)
	{
		if(!Flight::validYear($year)){
			return Flight::notFound();
		}
		$title = 'Postgraduate courses with international study';
		$template = 'pg_search';
		$meta = array(
			'title' => 'Postgraduate courses with international study | Postgraduate courses | The University of Kent',
			'description' => 'Search all of the study abroad option courses offered by the University of Kent',
		);

		Flight::setup($year, $level);

		try {
			$programmes = static::$pp->get_programmes_index($year, $level);//5 minute cache
			$campuses = static::$pp->get_campuses();
			$subject_categories = static::$pp->get_subjectcategories($level);
			$awards = static::$pp->get_awards($level);
			$award_names = array();
			foreach ($awards as $award)
			{
				$award_names[] = $award->name;
			}
			sort($award_names);
		}
		catch(\Exception $e)
		{
			// Another error.
			return Flight::error($e);
		}

		//debug option
		if(isset($_GET['debug_performance'])){ Log::warning($programmes); }

		//Render full page
		return Flight::layout($template, array('meta' => $meta, 'programmes' => $programmes, 'campuses' => $campuses, 'subject_categories' => $subject_categories, 'search_type' => $search_type, 'search_string' => $search_string, 'awards' => $award_names, 'disable_search_bar' => true, 'title' => $title, 'only_study_abroad' => true));
	}

	/**
	* Search page (no year)
	*/
	public function study_abroad_noyear($level)
	{
		return $this->study_abroad($level, static::$current_year);
	}

	/**
	* Data formatted for searching by quickspot
	*
	*/
	public function ajax_search_data($level, $year='current')
	{
		// Cache json output for a minute or so (go faster!)
		$output = Cache::get("courses-daedalus-search-json-{$level}-{$year}", function() use ($level, $year) {

			try
			{
				$js = CoursesController::$pp->get_programmes_index($year, $level);
			}
			catch(ProgrammesPlant\ProgrammesPlantNotFoundException $e)
			{
				return false;
			}
			catch(\Exception $e)
			{
				// Another error.
				return "{'error':'Unable to load data.'}";
			}

			return json_encode($js);
		}, 2);

		if($output === false) Flight::halt(501, "Fatal error in getting programmes index.");

		// 1h Cache.
		Flight::response()->cache(time()+3600);

		// Try & cache
		echo $output;
	}

	/**
	* Subjects Page
	*/
	public function ajax_subjects_page($level, $year='current')
	{

		try
		{
			$subjects = (array) static::$pp->get_subjectcategories($level);
			usort($subjects, function ($a, $b) {
				return $a->name > $b->name;
			});
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
	public function ajax_leaflets_data($level, $year='current')
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
	public function subjects($level, $year='current')
	{
		Flight::setup($year, $level);

		// Get feed
		try
		{
			$subjects = static::$pp->get_subject_index($year, $level);
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
	public function list_programmes($level, $year='current')
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
	public function leaflets($level, $year='current')
	{

		Flight::setup($year, $level);

		$leaflets = (array) static::$pp->get_subject_leaflets($year, $level);

		// sort our leaflets
		usort($leaflets, function($a,$b)
		{
			return strcmp($a->name, $b->name);
		});

		//debug option
		if(isset($_GET['debug_performance'])){ Log::warning($leaflets); }

		//Render full page
		Flight::layout('leaflets', array('leaflets' => $leaflets, 'type' => $level));

	}

	/**
	* Subject leaflets page when no year is specified
	*
	* @param string Type UG|PG
	* @return rendering of the leaflets view
	*/
	public function leaflets_noyear($level)
	{
		return $this->leaflets($level, static::$current_year);
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

	/**
	* apply - View the apply page for a course
	*
	* @param string $type undergraduate or postgraduate.
	* @param yyyy Year to show
	* @param int Id of programme
	*/
	public function apply($level, $year, $id)
	{
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
			$data = array('id' => $id, 'year'=> $year, 'level' => $level, 'error'=> $e);
			return Flight::notFound($data);
		}
		catch(\Exception $e)
		{
			// Year to old
			if($year < 2014){
				$data = array('id' => $id, 'year'=> $year, 'level' => $level, 'error'=> $e);
				return Flight::notFound($data);
			}

			// Another error type?
			$data = array('id' => $id, 'year'=> $year, 'level' => $level);
			return Flight::error($e, $data);
		}

		// Are applications actually open for this year?
		if (isset($course->globals->disable_apply) && $course->globals->disable_apply=='true'){
			//if not redirect to course home
			Flight::redirect("$level/$year/".$course->instance_id);
		}

		// Attempt to cache responce with browser + debug some extra information.
		Flight::cachecheck();

		// Debug option
		if(isset($_GET['debug_performance'])){ Log::warning($course); }

		// Render programme page
		Flight::setup($year, $level);

		$course->locations_str = $this->getCourseLocations($course);
		$course->award_list	= $this->getCourseAwardList($course);
		$course->award_list_linked = $this->getCourseAwardListLinked($course);

		$meta = array(
			'title' => "{$course->programme_title} - {$course->award_list} - {$course->locations_str} - The University of Kent",
			'canonical' => Flight::url("{$level}/{$id}/{$course->slug}"),
			'active_instance' => Flight::url("{$level}/{$id}/{$course->slug}"),
			'description' => strip_tags($course->programme_abstract),
		);

		if($year && ($year !== static::$current_year)){
			$meta['canonical'] =  Flight::url("{$level}/{$year}/{$id}/{$course->slug}");
		}

		// get the deliveris with valid IPOs
		$validDeliveries = array();
		foreach ($course->deliveries as $delivery) {

			if(!empty($delivery->current_ipo) || (substr($delivery->mcr, -2)=='FU')){
				$validDeliveries[] = $delivery;
			}
		}


		//if($level=="postgraduate" || ($level=="undergraduate" && $delivery->attendance_pattern == 'part-time' && (strlen($course->how_to_apply_atypical_courses) == 0))) {
		//	// go directly to evision if there is only one valid delivery for this course
		//	if (count($validDeliveries) == 1) {
		//		$delivery = $validDeliveries[0];
		//		$url = (!empty($delivery->current_ipo)) ? "https://evision.kent.ac.uk/urd/sits.urd/run/siw_ipp_lgn.login?process=siw_ipp_app&code1=" . $delivery->mcr . "&code2=" . $delivery->current_ipo : '';
		//
		//		if (!empty($url)) {
		//			header('Location: ' . $url);
		//			exit;
		//		}
		//	}
		//}


		switch($level){
			case 'postgraduate':
			if($year && ($year !== static::$current_year)){
				$meta['title'] = "{$course->programme_title} - {$course->award_list} - {$course->locations_str} - Postgraduate Programmes {$year} Application - The University of Kent";
			}

			return Flight::layout('apply-pg', array('meta' => $meta, 'course' => $course, 'deliveries' => $validDeliveries));
			break;

			default:
			if($year && ($year !== static::$current_year)){
				$meta['title'] = "{$course->programme_title} ($course->ucas_code) - {$course->award_list} - {$course->locations_str} - Undergraduate Programmes {$year} Application - The University of Kent";
			}
			return Flight::layout('apply-ug', array('meta' => $meta, 'course' => $course, 'deliveries' => $validDeliveries));
			break;
		}

		return true;
	}

	/**
	* apply - View the apply page for a course, but without any year
	*
	* @param string $type undergraduate or postgraduate.
	* @param int Id of programme
	*/
	public function apply_noyear($level, $id, $slug='')
	{
		return $this->apply($level, static::$current_year, $id);
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

	//to display locations under course heading
	private function getCourseLocations($course)
	{
		$additional_locations =  is_array($course->additional_locations) ? $course->additional_locations : array();
		$locations = array_merge($course->location, $additional_locations);
		$locations_count = sizeof($locations);

		$locations_str = '';
		foreach($locations as $key => $loc){
			$locations_str .= $loc->name;
			$locations_str .= ($key === $locations_count-2) ? ' and ' : (($key === $locations_count-1) ? '' : ', ');
		}

		return $locations_str;
	}

	//to display locations under course heading
	private function getCourseLocationsLinked($course)
	{
		$additional_locations =  is_array($course->additional_locations) ? $course->additional_locations : array();
		$locations = array_merge($course->location, $additional_locations);
		$locations_count = sizeof($locations);

		$locations_str = '';
		foreach($locations as $key => $loc){
			$locations_str .= '<a class="text-accent" href="' .$loc->url . '">' . $loc->name . '</a>';
			$locations_str .= ($key === $locations_count-2) ? ' and ' : (($key === $locations_count-1) ? '' : ', ');
		}

		return $locations_str;
	}

	private function getCourseAwardList($course)
	{
		// no award - should this be possible?
		if(empty($course->award)) return '';

		$award_list = '';
		foreach ($course->award as $award) {
			if (!empty($award->name)) {
				$award_list .= $award->name . ', ';
			}
		}

		return rtrim($award_list, ', ');
	}

	private function getCourseAwardListLinked($course)
	{
		// no award - should this be possible?
		if(empty($course->award)) return '';

		$award_list = '';
		foreach ($course->award as $award) {
			if (!empty($award->name)) {
				$award_list .= '<a class="award-tt" title="' . $award->longname . '" data-title="' . $award->longname . '" data-toggle="popover" data-trigger="focus" tabindex="0" role="button">' . $award->name . '</a>, ';
			}
		}

		return rtrim($award_list, ', ');
	}

	public function profiles($level = 'undergraduate', $search_string = ''){
		try{
			$profiles = static::$pp->make_request($level . '/profile');
			$subject_categories = static::$pp->get_subjectcategories($level);
		}catch(\Exception $e){
			return Flight::notFound();
		}

		switch ($level) {
			case "undergraduate":
				$level_pretty = 'Undergraduate';
				$level_code = 'ug';
			break;
			default:
				$level_pretty = 'Postgraduate';
				$level_code = 'pg';
		}

		$meta = array(
			'title' => $level_pretty  . ' Student Profiles | The University of Kent',
			'description' => ''
		);

		return Flight::layout('profiles', array('meta' => $meta,
				'profiles'=> $profiles,
			 	'level' => $level,
			 	'level_code'=>$level_code,
			 	'level_pretty'=>$level_pretty,
				'subject_categories' => $subject_categories,
				'search_type' => 'subject_category',
				'search_string' => $search_string
		));
	}

	public function profile($level,$idOrSlug){
		try{
			$profile = static::$pp->make_request( $level . '/profile/' . $idOrSlug);
		}catch(\Exception $e){
			return Flight::notFound();
		}

		$meta = array(
			'title' => 'Student Profile | ' . $profile->name . ' | The University of Kent',
			'description' => $profile->lead,
		);

		return Flight::layout('profile', array('meta' => $meta, 'level'=> $level, 'profile'=> $profile));
	}



}
