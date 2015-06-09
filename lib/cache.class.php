<?php

class Cache{
    public static $cache = array();
    public static function addCache($key,$value){
        self::$cache[$key] = $value;
		return true;
    }
	public static function addCacheArr($arr){
        self::$cache=array_merge(self::$cache,$arr);
		return true;
    }
    public static function getCache($key){
        if(!empty(self::$cache[$key])){
            return self::$cache[$key];
        }else{
			return false;
		}
    }
}