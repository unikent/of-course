<?php
namespace unikent\libs;

use unikent\libs\Config;
use unikent\libs\Log;

Class QuickCurl {


	public static function get($url, $params = array(), $timeout = 4, $curlParams = array()){
		return static::curl($url, $params, false, $timeout, $curlParams);
	}

	public static function post($url, $params = array(), $timeout = 4, $curlParams = array()){
		return static::curl($url, $params, true, $timeout, $curlParams);	
	}
	public static function curl($url, $params, $post = false, $timeout = 4, $curlParams = array()){

		// No url? fail
		if (empty($url)) return false;	
		// make get string if not posting
		if (!$post && !empty($params)) {
			$url = $url . "?" . http_build_query($params);
		}

		$curl = curl_init($url);

		if(isset($curlParams['HTTPHEADER']) && !empty($curlParams['HTTPHEADER'])){
			curl_setopt($curl, CURLOPT_HTTPHEADER, $curlParams['HTTPHEADER']);
		}

		// This code is horrible and INSECURE, but if changed may break stuff. NEEDS DISCUSSION.
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		if(isset($curlParams['SSL_VERIFYPEER'])){
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $curlParams['SSL_VERIFYPEER']);
		}

		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		if(isset($curlParams['FOLLOWLOCATION'])){
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, $curlParams['FOLLOWLOCATION']);
		}

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		if(isset($curlParams['RETURNTRANSFER'])){
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, $curlParams['RETURNTRANSFER']);
		}

		// Postify
		if ($post) {
			curl_setopt($curl, CURLOPT_POST, true);	
			curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
		} 


		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

		// Via Advocate?
		if(defined('LOCAL') && LOCAL == true){
			//do not use advocate when in local dev envirenment
		}
		else{
			if(!Config::get("disable_curl_proxy")){
				curl_setopt($curl, CURLOPT_PROXY, 'advocate.kent.ac.uk');
      			curl_setopt($curl, CURLOPT_PROXYPORT, 3128);		
			}
		}
        
		$data = curl_exec($curl);

		$http_code = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$headers = curl_getinfo($curl);

		// Some debugging info
		if($http_code !== 200){
			if($http_code === 0){
				Log::error("[quickcurl][fail] Request blocked via advocate: {$url}");
			}else{
				Log::error("[quickcurl][fail] Curled URL: {$url} ({$http_code})");
			}
		}else{
			Log::debug("[quickcurl][success] Curled URL: {$url} ({$http_code})");
		}

		return array('data' => $data, 'http' => $http_code, 'headers' => $headers);
	}
}