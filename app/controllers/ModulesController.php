<?php

use unikent\libs\Cache;
use unikent\libs\Logger;

class ModulesController {

	public function __construct()
	{

	}

	public function index()
	{	

		$list = $this->getModuleList($module_code);

		return Flight::layout("modules/index", $list, "modules/layout");
	}

	public function view($module_code)
	{
		$module = $this->getModule($module_code);
 
 		if($module_code !== $module_sits_code){
 			die("?");
 			Flight::redirect("module/".$module_sits_code);
 		}

 		return Flight::layout("modules/module", $module, "modules/layout");
	}


	protected function getModule($code){
		$data = Cache::load("https://api.kent.ac.uk/api/v1/modules/module/".$code);
		return json_decode($data['data']);
	}

	protected function getModuleList($collection = 'all'){
		$data = Cache::load("https://api.kent.ac.uk/api/v1/modules/collections/".$collection);
		return json_decode($data['data']);
	}

}