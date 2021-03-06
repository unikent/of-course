<?php

use unikent\libs\Cache;

/**
 * Module controller
 * runs logic for module catalogue replacement
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
			//"humanities" => array("name" => "Humanities (UG)", "collection" => "H2"),
			//"sciences" => array("name" => "Sciences (UG)", "collection" => "SPS2"),
			//"social" => array("name" => "Social Sciences (UG)", "collection" => "SS2"),
			"postgraduate" => array("name" => "Postgraduate", "collection" => "PG"),
			"brussels" => array("name" => "Brussels", "collection" => "B"),
			"paris" => array("name" => "Paris", "collection" => "P"),
			"wild" => array("name" => "Wild modules", "collection" => "W")
		);

		$subjects = $this->getSubjectsList();

		return Flight::layout("modules/index", array('modules' => $list, 'collections' => $collections, 'subjects'=>$subjects), "modules/layout");
	}

	/**
	 * Show modules in a collection
	 *
	 */
	public function collection($collection = 'all'){
		$list = $this->getModuleList($collection);

		// Handle error
		if(isset($list->error)){
			return $this->collection_404($list->error);
		}

		$subjects = $this->getSubjectsList();

		return Flight::layout("modules/collection", array('modules' => $list, "collection" => $collection, "subjects" => $subjects), "modules/layout");
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

		$subjects = $this->getSubjectsList();

		// Handle error
		if(isset($module->error)){
			return $this->module_404($module->error);
		}

		// If url uses "sds code", send it to sits code url
		/*
		if(strtoupper($module_code) === strtoupper($module->sds_code) && strtoupper($module->code) !==  strtoupper($module->sds_code)){
			Flight::redirect("/modules/module/".strtolower($module->code));
		}
		*/
		return Flight::layout("modules/module", array('module'=>$module, "subjects"=>$subjects), "modules/layout");
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

		//redirect module pages
		$module = $this->getModule($module_code);
		return Flight::redirect("modules/module/".$module->sds_code, 301);

	}

	public function legacy_collection_url($code =null){
		// Redirect to module catalogue index page
		if ($code === null) {
			return Flight::redirect('/modules/collection', 301);
		}

		return Flight::redirect("modules/collection/".$code, 301);
	}

	/**
	 * 404 helper for bad module catalogue.
	 *
	 */
	protected function collection_404($error){
		$list = $this->getCollectionList();
		Flight::response()->status(404);
		return Flight::layout("modules/error", array('error'=> $error, 'collections' => $list), "modules/layout");
	}

	/**
	 * 404 helper for bad module.
	 *
	 */
	protected function module_404($error){
		$subjects = $this->getSubjectsList();
		Flight::response()->status(404);
		return Flight::layout("modules/error", array('error'=> $error, 'subjects' => $subjects), "modules/layout");
	}


	/**
	 * Get module data from API
	 *
	 */
	protected function getModule($code){
		$data = Cache::load(API_URL . "/v1/modules/module/" . $code,15);

		if($data == false){
			return (object) array("error" => "Sorry, unable to find module.");
		}

		return json_decode($data['data']);
	}

	/**
	 * Get collection list data from API
	 *
	 */
	protected function getCollectionList(){

		// Grab first page of datatable
		$data = Cache::load(API_URL . "/v1/modules/collection/", 15);
		return json_decode($data['data']);
	}

	/**
	 * Get module list data from API
	 *
	 */
	protected function getModuleList($collection = 'all'){
		// Grab first page of datatable
		$data = Cache::load(API_URL . "/v1/modules/collection/" . $collection, 15);

		if($data == false){
			return (object) array("error" => "Sorry, unable to find collection");
		}

		return json_decode($data['data']);
	}

	protected function getSubjectsList($group = 'all'){
		$data = Cache::load(API_URL . "/v1/modules/subjects/" . $group, 15);

		if($data == false){
			return (object) array("error" => "Unable to find specified subject group.");
		}
		$data = json_decode($data['data']);

		return $data->subjects;
	}
}
