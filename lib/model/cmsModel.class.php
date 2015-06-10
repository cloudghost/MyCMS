<?php

class cmsModel extends Model
{
    // pwd = without salt
    // password = with salt and md5
    function __construct()
    {
        parent::__construct();

    }

    public $sid;
    public $pwd;
    public $password;
    public $salt;
    public $eName;
    public $cName;
    public $sidRaw;



    public function getStudentInfo()
    {
        $result = file_get_contents("http://www.alevel.com.cn/user/interface/sinfo/$this->sid/");
        /* return example after using json_decode()
        [array (size=3)]
        'status' => boolean true
        'info' => string 'Ok' (length=2)
        'student' =>
        [array (size=4)]
          'ename' => string 'Philip' (length=6)
          'salt' => string 'fG' (length=2)
          'name' => string 'è“å¤©é˜³' (length=9)
          'student_num' => string '3510' (length=4)*/


        $infoArr = json_decode($result, true);
        if ($this->checkData($infoArr)) {

            //Variables are to be used within the model
            //Session values are only to be used when local values are not available
            $this->salt = $infoArr["student"]["salt"];
            $this->sidRaw = $infoArr["student"]["student_num"];
            $this->eName = $infoArr["student"]["ename"];
            $this->cName = $infoArr["student"]["name"];
            if(empty($this->password)) {
                $this->password = strtoupper(md5($this->salt . $this->pwd));
            }
            return 1;
        } else {
            return 0;
        }
    }

    public function setSessionVals()
    {
        $_SESSION["user"]["sid"] = $this->sid;
        $_SESSION["user"]["sidRaw"] = $this->sidRaw;
        $_SESSION["user"]["eName"] = $this->eName;
        $_SESSION["user"]["cName"] = $this->cName;
        $_SESSION["user"]["pwd"] = $this->pwd;
        $_SESSION["user"]["password"] = $this->password;
        $_SESSION["user"]["salt"] = $this->salt;
    }

    public function checkData($data)
    {
        if ($data["status"] == false) {
            return 0;
        } else {
            return 1;
        }
    }

    public function validatePassword()
    {
        $result = file_get_contents("http://www.alevel.com.cn/user/interface/validate/$this->sid/$this->password/");
        $infoArr = json_decode($result, true);
        if ($this->checkData($infoArr)) {
            return 1;
        } else {
            return 0;
        }
    }


    /**
     * Sets the student ID and password if valid
     * @return int
     */
    public function validateSid()
    {
        $checked = preg_match("/s(\d{4})/", $this->sid);
        if ($checked)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function getTimetable()
    {
        require_once 'lib/model/cmsNewModel.class.php';
        $modeltmp = new cmsNewModel();
        $sid = $_SESSION["user"]["sidRaw"];
        $password = $_SESSION["user"]["password"];
        //$result = file_get_contents("http://www.alevel.com.cn/user/interface/cinfo/$sid/$password/");
        $infoArr=$modeltmp->getInfo($sid,'TIMETABLE');
        //var_dump( json_decode($result, true));
        //var_dump($infoArr);
        if ($this->checkData($infoArr))
        {
            return $infoArr;
        }
        else
        {
            return 0;
        }
    }

    public function getExam()
    {
        $sid = $_SESSION["user"]["sid"];
        $password = $_SESSION["user"]["password"];
        $result = file_get_contents("http://www.alevel.com.cn/user/interface/einfo/$sid/$password/");
        $infoArr = json_decode($result, true);
        if ($this->checkData($infoArr)) {
            return $infoArr;
        } else {
            return 0;
        }
    }

    public function getHomework()
    {
        $sid = $_SESSION["user"]["sid"];
        $password = $_SESSION["user"]["password"];
        /*
         * unknown error while accessing hinfo: the result returned must be utf-8 encoded otherwise json_decode() will return null...
         */

        $result = file_get_contents("http://www.alevel.com.cn/user/interface/hinfo/$sid/$password/");
        $infoArr = json_decode(iconv("gbk", 'UTF-8//IGNORE', $result), true);
        if ($this->checkData($infoArr)) {

            return $infoArr;
        } else {
            return 0;
        }
    }

    public function getCalendar($year, $month)
    {
        $sid = $_SESSION["user"]["sid"];
        $password = $_SESSION["user"]["password"];
        $result = file_get_contents("http://www.alevel.com.cn/user/interface/calendar/$sid/$password/$year/$month/");
        $infoArr = json_decode($result, true);
        if ($this->checkData($infoArr)) {
            return $infoArr;
        } else {
            return 0;
        }
    }

    public function getYear($string)
    {
        return $string[0] . $string[1] . $string[2] . $string[3];
    }

    public function getMonth($string)
    {
        return $string[5] . $string[6];
    }

    public function getDay($string)
    {
        return $string[8] . $string[9];
    }


}