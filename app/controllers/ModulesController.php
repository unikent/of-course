<?php

use unikent\libs\Cache;
use unikent\libs\Logger;

class ModulesController {

	public function index()
	{
		$list = $this->getModuleList($module_code);

		return Flight::layout("modules/index", $list, "modules/layout");
	}

	public function view($module_code)
	{
		$module = $this->getModule($module_code);

		if($module_code !== $module_sits_code){
			Flight::redirect("module/".$module_sits_code);
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
		$data = Cache::load(KENT_API_URL ."v1/modules/module/".$code);
		return json_decode($data['data']);
	}

	protected function getModuleList($collection = 'all'){
		$data = Cache::load(KENT_API_URL ."v1/modules/collections/".$collection);
		return json_decode($data['data']);
	}
}
