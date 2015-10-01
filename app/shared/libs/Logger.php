<?php
namespace unikent\libs;
// very basic Logging wrapper
// to pass messaging up to pantheon

Class Logger {
	// Config data
	protected static $data = array('debug'=> array(), 'warning'=> array());


	public static function debug($msg){
		return static::log('debug', $msg);
	}
	public static function warn($msg){
		return static::log('warning', $msg);
	}
	public static function log($level, $msg){
		static::$data[$level][] = $msg;
	}


	public static function get($level = 'warning'){
		return static::$data[$level];
	}
}