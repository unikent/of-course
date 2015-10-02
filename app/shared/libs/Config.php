<?php
namespace unikent\libs;

Class Config {
	// Config data
	public static $data = array();

	// get Config item
	public static function get($id){
		return isset(static::$data[$id]) ? static::$data[$id] : false;
	}

	// set config item
	public static function set($key, $value){
		return (static::$data[$key] = $value) ? true : false; // return true|false for success
	}

	// Populate config data
	public static function fill($data){
		static::$data = $data;
	}
}