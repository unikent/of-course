<?php
namespace unikent\libs;

use \Exception as Exception;

/**
 * Cache - Caching helper class
 *
 * @version 1.0.0
 * @author Carl Saggs
 */
class Cache {

	/**
	 * Read cache file
	 *
	 * @param $key - unique identifier for cache (use of .'s will create additional folders')
	 * @param $cachetime - Time in minutes cache needs to be newer than.
	  *
	 * @return cache data|false
	 */
	public static function read($key, $cachetime = 120)
	{
		$path = static::get_cache_path($key);

		if(static::_check($path, $cachetime))
		{
			return static::_read($path);
		}

		return false;
	}

	/**
	 * Write cache file
	 *
	 * @param $key - unique identifier for cache (use of .'s will create additional folders')
	 * @param $payload - data to store
	 *
	 * @return success:true|false
	 */
	public static function write($key, $payload)
	{
		$path = static::get_cache_path($key);
		return static::_write($path, $payload);
	}

	/**
	 * Delete
	 *
	 * @param $key - unique identifier for cache (use of .'s will create additional folders')
	 *
	 * @return success:true|false
	 */
	public static function delete($key, $deletDir=false)
	{
		$path = static::get_cache_path($key);

        $maybedir = substr($path,0,strlen($path)-5);
        if(!empty($maybedir) && is_dir($maybedir) && $deletDir){
            return static::rrmdir($maybedir);
        }
        if(file_exists($path)) {
            return unlink($path);
        }

        return true;
	}

    protected static function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") static::rrmdir($dir."/".$object); else unlink($dir."/".$object);
                }
            }
            reset($objects);
            return rmdir($dir);
        }
        return true;
    }

	/**
	 * get data from cache - or if unable to reload data using callback
	 *
	 * @param $key - unique identifier for cache (use of .'s will create additional folders')
	 * @param $callback - function that will load required data if cache has expired/doesn't exist
	 * @param $cachetime - Time in minutes cache needs to be newer than.
	 *
	 * @return cache data | callback data | expired cache data | false (if unable to failover)
	 */
	public static function get($key, $callback, $cachetime = 120)
	{
		$path = static::get_cache_path($key);

		// If cahce is all happy, lets just return it
		if(static::_check($path, $cachetime))
		{
			return static::_read($path);
		}

		// Cache is bad, so lets reload the data
		try	{
			$data = $callback();
		}
		catch(\Exception $e) {
			// Don't recover if in disablecache mode
			if(isset($_GET['disablecache']))
			{
				print_r($e);
				die();
			}
			return static::_force_read($path);
		}
		
		// if data returned is no good (or an error value)
		if($data === null || $data === false)
		{
			return static::_force_read($path);
		}

		// else write new data & return it
		$success = static::_write($path, $data);

		return $data;
	}

	/**
	 * load - caching wrapper around curl
	 *
	 * @param $endpoint - URL to load data from
	 * @param $cachetime - Time in minutes cache needs to be newer than.
	 * @param $timeout - how long to wait for webservice to respond
	 *
	 * @return cache data | newly curlled dat | expired cache data | false (if unable to failover)
	 */
	public static function load($endpoint, $cachetime = 60, $timeout = 4)
	{
		if(!class_exists("unikent\libs\QuickCurl")) return false;

		// Get cache path
		$path = static::get_cache_path_from_url($endpoint);

		// if cache is happy, return it
		if(static::_check($path, $cachetime))
		{
			return static::_read($path);
		}

		// if not, lets try and load this end point
		$payload = QuickCurl::get($endpoint, array(), $timeout);

		// If everything worked fine, cache result and return data
		if($payload['http'] == '200'){
			static::_write($path, $payload);
			return $payload;
		}

		// Not 200, sothing went wrong :o 
		// Attempt to recover by passing on an expired cache copy
		// we can try and reload again later.
		return static::_force_read($path);
	}


	/**
	 * Generate useable filepath from key
	 * 
	 * @param $key Unique name for cache
	 * @return $path valid path name
	 */
	private static function get_cache_path($key)
	{
		// trim it
		$key = trim($key);

		// Clean it 
		// - convert spaces & '/' to -
		// - convert . to folders
		// - remove unwanted chars,
		// - append json
		$key = str_replace(array(' ','/'), '-', $key);
		$key = str_replace('.', '/', $key);
		$key = preg_replace("/[^A-Za-z0-9_\-\/]/", '', $key).'.json';

		// return path to cacheFile.
		return Config::get('cachedir').$key;
	}

	/**
	 * Automatically generate a human-ish readable cache key & cache path from a url endpoint.
	 * 
	 * @param $url - URL endpoint to create a cache for
	 * @return $path valid path name
	 */
	private static function get_cache_path_from_url($url){
		// Normalise cache key so:
		// http://twitter.com/api/bla.xml?cake=moon&yes -> webservices.twitter-com-bla-xml-cake-moon-yes
		$url_parts = parse_url($url);

		// Flatten host
		$host = str_replace('.','-',$url_parts['host']);
		// Flatten path
		$path = isset($url_parts['path']) ? ltrim($url_parts['path'], '/') : '';
		// Flatten query string
		if(isset($url_parts['query'])){
			$query = trim(str_replace(array('&disablecache','disablecache&','disablecache'),'',$url_parts['query']));
			$query = ($query != '') ? '-'.$query : ''; // if nothing was there aside from disable cache, dont add a - seperator
		}else{
			$query = '';
		}

		// Build key (remove any special chars)
		$cache_key = $host.'.'.str_replace(array('.','/','?','=','&'), '-', $path.$query);

		return static::get_cache_path('webservices.' . $cache_key);
	}

	/**
	 * Force read.
	 * If somthing went wrong repopulating a cache, attempt to fall back to expired cache if possible. 
	 * (then back away for cache period in order to give issue chance to resolve itself)
	 * 
	 * @param $path - Full path to file.
	 * @return $data | false
	 */
	private static function _force_read($path)
	{
		if(file_exists($path)){
			// touch file so we dont check again until next expire)
			touch($path); 
			return static::_read($path);
		}

		// nothing we can do, can't reload and we have no cache.
		return false;
	}


	/**
	 * Check cache is Valid (exists / isn't expired / isn't disabled)
	 * true = valid, false = bad
	 * 
	 * @param $path - Full path to file.
	 * @return $data | false
	 */
	private static function _check($path, $cache_time = false)
	{
		// if the file exists, and disable cache is NOT enabled
		if($cache_time === false){
			// ignore cache time, so long as the file exists and disablecache is turned off its fine
			return (file_exists($path) && !isset($_GET['disablecache']));
		}
		else
		{
			// ensure even cache has not expired
			return (file_exists($path) && !isset($_GET['disablecache']) && (time() - filemtime($path)) < ($cache_time*60));
		}
	}

	/**
	 * Write data to file
	 * 
	 * @param $path - Valid cache file
	 * @param $payload - Data to store
	 * @return success: true|false
	 */
	private static function _write($path, $payload)
	{
		//Get cache folder.
		$f = pathinfo($path);
		$folder = $f['dirname'].'/';
		
		// Ensure folder exists - if not, create it.
		if (!file_exists($folder)) mkdir($folder,0777,true);

		// Write payload
		$success = file_put_contents($path, json_encode($payload));

		// If everything worked, chmod and return true
		if($success !== false){
			chmod($path, 0777);
			return true;
		}
		
		// somthing went wrong :(
		return false;
	}

	/**
	 * read data from file
	 * 
	 * @param $path - Valid cache file
	 * @return data | falase
	 */
	private static function _read($path)
	{
		$data = file_get_contents($path);

		if($data !== false){
			return json_decode($data, true);
		}

		return false;
	}
}
