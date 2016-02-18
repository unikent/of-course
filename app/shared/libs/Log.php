<?php
namespace unikent\libs;

use unikent\libs\Config;

/**
 * Log - Caching helper class
 *
 * @version 1.0.0
 */
class Log {

	public static $levels = array(
		'all' => 3,
		'debug' => 3,
		'warning' => 2,
		'error' => 1
	);

	// Data
	protected static $logs = array();
	protected static $config = false;


	// debug message - stuff maybe goes right, but is worth knowing
	public static function debug($message){
		static::log($message, 'debug');
	}

	// Somthing may have gone wrong - unsure but worth noting.
	public static function warning($message){
		static::log($message, 'warning');
	}

	// Somthing broken
	public static function error($message){
		static::log($message, 'error');
	}
	
	/**
	 * Log a message
	 *
	 */
	protected static function log($message, $level = 'debug'){

		$settings = static::load_settings();

		// Level of error must be lower than current log level, if not ignore message
		if(static::$levels[$level] > $settings['level']) return false;

		// Create new log item
		$context = debug_backtrace();
		$item = new LogItem($level, $message, $context);
		static::$logs[] = $item;

		// is logging enabled (write to error_log)
		if($settings['error_log'] == 'true' || $settings['error_log'] == true){

			// If log file is set log to that, else use error log
			if(!empty($settings['log_file'])){
				error_log($item->toString() . "\r\n", 3, $settings['log_file']);
			}else{
				error_log($item->toString());
			}	
		}
	
	}

	// Get collected errors
	public static function get(){
		return static::$logs;
	}

	protected static function load_settings(){
		// return ready configured logger
		if(static::$config) return static::$config;

		// defaults
		$default = array(
			'level' => 'warning',
			'error_log' => 'true',
			'log_file' => ''
		);

		// merge in later settings
		$config = Config::get('logging');
		if($config){
			$config = array_merge($default, $config);
		}else{
			$config = $default;
		}

		$config['level'] = static::$levels[$config['level']];

		return static::$config = $config;
	}
}

// Log Item
class LogItem {

	public $level;
	public $message;

	public $timestamp;
	public $file;
	public $line;

	public function __construct($level, $message, $context = false){

		$this->level = $level;
		$this->timestamp = time();

		// Make message a string
		if (is_object($message) || is_array($message)) {
			$message = print_r($message, true);
		}

		$this->message = $message;

		// Store context info if Available
		if($context){
			$this->line = $context[1]['line'];
			$this->file = $context[1]['file'];
		}
	}

	public function toString(){
		return "[$this->level] $this->message - Line: {$this->line} File: {$this->file}";
	}

}