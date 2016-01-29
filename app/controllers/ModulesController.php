<?php

use unikent\libs\Cache;
use unikent\libs\Logger;

class ModulesController {

	public function __construct()
	{

	}

	public function index()
	{	
		$list = $this->getModuleList();

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

	public function view($module_code)
	{
		$module = $this->getModule($module_code);
 
 		if($module_code !== $module_sits_code){
 			Flight::redirect("module/".$module_sits_code);
 		}

 		return Flight::layout("modules/module", $module, "modules/layout");
	}


	public function legacy_url($module_code)
	{
		$module = $this->getModule($module_code);
 		Flight::redirect("module/".$module->module_sits_code, 301);
 	
	}



	protected function getModule($code){
		$data = Cache::load(KENT_API_URL . "v1/modules/module/" . $code);
		return json_decode($data['data']);
	}

	protected function getModuleList($collection = 'all'){

		// Grab first page of datatable
		$data = Cache::load(KENT_API_URL . "v1/modules/collection/" . $collection);
		return json_decode($data['data']);
	}




}