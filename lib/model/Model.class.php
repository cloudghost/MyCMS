<?php

class Model
{

    private $encryptionMethod = "AES-256-CBC";

    /**
     * @var string md5 hash of the latter md5..
     */
    private $iniVector = "182918371849181\0";
    /**
     * @var string md5 of the string SCIEIT12345
     */
    private $password = "73e79fb6c34a9dee4e8134dee0e8d1cb";


    public $weekDay;
    public $year;
    public $month;
    public $dayOfMonth;
    public $standardFormat;

    //date and time for tomorrow
    public $weekDayTmw;
    public $standardFormatTmw;
    public $textDayToNumDay = ["M" => 1, "Tu" => 2, "W" => 3, "Th" => 4, "F" => 5];


    function __construct()
    {
        $this->weekDay = date("w");
        $this->year = date("Y");
        $this->month = date("m");
        $this->dayOfMonth = date("d");
        $this->standardFormat = date("Y-m-d");

        $this->standardFormatTmw = date("Y-m-d", time() + 24 * 60 * 60);
        $this->weekDayTmw = date("w", time() + 24 * 60 * 60);
    }

    public function getDatabase()
    {
        require_once "lib/db/database.class.php";
        database::connect();
    }

    public function encrypt($data)
    {
        return openssl_encrypt($data, $this->encryptionMethod, $this->password, false,$this->iniVector);
    }

    public function decrypt($data)
    {
        return openssl_decrypt($data, $this->encryptionMethod, $this->password,false,$this->iniVector);
    }

    public function getUserDataFromDb($sid){
        $userArr = database::queryAndArray("SELECT * FROM users where user_sid='{$sid}'","assoc")[0];
        $_SESSION["user"]["type"] = $userArr["user_type"];
        $_SESSION["user"]["year"] = $userArr["user_year"];
        $_SESSION["user"]["house"] = $userArr["user_house"];
        $_SESSION["user"]["form"] = $userArr["user_form"];
        $_SESSION["user"]["class"] = $userArr["user_class"];
        $_SESSION["user"]["mobile"] = $userArr["user_mobile"];
        $_SESSION["user"]["wechat"] = $userArr["user_wechat"];
    }
}