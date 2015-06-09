<?php

class database
{
    /**
     * @var mysqli
     */
	 
    public static $mysqli;
    public static $testval;
    public static function connect()
    {
        self::$mysqli = new mysqli("localhost", "sciecxnk_scieit", "scieit123", "sciecxnk_mycms");
        if (self::$mysqli->errno) {
            die(self::$mysqli->error);
        }
        self::$mysqli->set_charset("utf8");
        self::$mysqli->query("SET NAMES utf8");
        self::$testval ="default";
    }


    /**
     * Sanitizes and performs the query
     *
     * @param $query string
     * @return mysqli_result
     */
    public static function query($query)
    {
        return self::$mysqli->query($query);
    }
    /**
     * Queries the database with the specified SQL statement
     *
     * @param $data mysqli_result
     * @param $type string
     * @return array
     */
    public static function get_array($data, $type = "row")
    {
        $functionName = "mysqli_fetch_" . $type;
        $resultArr = [];
        while ($row = $functionName($data)){
            $resultArr[count($resultArr)] = $row;
        }
        return $resultArr;
    }
	public static function get_one($data, $type = "row")
    {
        $functionName = "mysqli_fetch_" . $type;
        $resultArr = $functionName($data);
        return $resultArr;
    }
    /**
     * Tries to stop sql injection
     * @param $string string
     * @return string
     */
    public static function sanitize($string){
        return self::$mysqli->real_escape_string($string);
    }

    public static function changdefault(){
        self::$testval = "fd";
    }

    public static function queryAndArray($query,$type="row"){
        if($result = self::query($query)){
			return self::get_array($result,$type);
		}else{
			return false;
		}
    }
	public static function queryAndOne($query, $type = "row")
    {
        $result = self::query($query);
        return self::get_one($result,$type);
    }
	public static function lastaffected(){
		return self::$mysqli->affected_rows;
	}
	public static function geterror(){
		return self::$mysqli->error;
	}
}