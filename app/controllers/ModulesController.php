<?php

use unikent\libs\Cache;
use unikent\libs\Logger;

class ModulesController {

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

		// If url uses "sds code", send it to sits code url
		if(strtoupper($module_code) !== strtoupper($module->sds_code)){
			Flight::redirect("module/".$module->code);
		}

		return Flight::layout("modules/module", $module, "modules/layout");
	}

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
