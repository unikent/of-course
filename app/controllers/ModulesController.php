<?php

use unikent\libs\Cache;
use unikent\libs\Logger;

/**
 * Module controller
 * runs logic for module catalog replacement 
 */
class ModulesController {

	/**
	 * Home
	 *  
	 */
	public function index()
	{	
		$list = $this->getModuleList();

 		// Home page collections
		$collections = array(
			"humanities" => array("name" => "Humanities (UG)", "collection" => "H1"),
			"sciences" => array("name" => "Sciences (UG)", "collection" => "SPS1"),
			"social" => array("name" => "Social Sciences (UG)", "collection" => "SS1"),
			"postgraduate" => array("name" => "Postgraduate", "collection" => "PG"),
			"brussels" => array("name" => "Brussels", "collection" => "B"),
			"paris " => array("name" => "Paris", "collection" => "P"),
			"wild" => array("name" => "Wild Modules", "collection" => "W")
		);

		return Flight::layout("modules/index", array('modules' => $list, 'collections' => $collections), "modules/layout");
	}

	/**
	 * Show modules in a collection
	 *  
	 */
	public function collection($collection = 'all'){
		$list = $this->getModuleList($collection);

		return Flight::layout("modules/collection", array('modules' => $list, "collection" => $collection), "modules/layout");
	}

	/**
	 * Collections list
	 *  
	 */
	public function collections(){
		$list = $this->getCollectionList();

		return Flight::layout("modules/collections", array('collections' => $list), "modules/layout");
	}

	/**
	 * View a module
	 *  
	 */
	public function view($module_code)
	{
		$module = $this->getModule($module_code);

		// If url uses "sds code", send it to sits code url
		if(strtoupper($module_code) !== strtoupper($module->sds_code)){
			Flight::redirect("module/".$module->code);
		}

		return Flight::layout("modules/module", $module, "modules/layout");
	}

	/**
	 * handle legacy URL
	 *  
	 */
	public function legacy_url($module_code = null)
	{
		// Redirect to module catalogue index page
		if ($module_code === null) {
			return Flight::redirect('/modules', 301);
		}

		// Redirect to collections... the 'splat' gets the wildcard (*) from the route
		if ($page = @$module_code->splat) {
			echo str_replace('.html', '', $page);
			//TODO: update route once we have the search index
			return Flight::redirect('/modules/?tab=' . $page, 301);
		}

		//redirect module pages
		$module = $this->getModule($module_code);
		Flight::redirect("module/".$module->module_sits_code, 301);

	}

	/**
	 * Get module data from API
	 *  
	 */
	protected function getModule($code){
		$data = Cache::load(KENT_API_URL . "v1/modules/module/" . $code);
		return json_decode($data['data']);
	}

	/**
	 * Get collection list data from API
	 *  
	 */
	protected function getCollectionList(){

		// Grab first page of datatable
		$data = Cache::load(KENT_API_URL . "v1/modules/collection/");
		return json_decode($data['data']);
	}

	/**
	 * Get module list data from API
	 *  
	 */
	protected function getModuleList($collection = 'all'){
		// Grab first page of datatable
		$data = Cache::load(KENT_API_URL . "v1/modules/collection/" . $collection);

		return json_decode($data['data']);
	}
}
