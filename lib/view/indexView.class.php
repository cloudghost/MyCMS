<?php

class indexView extends View
{
    public $newHomeworkList = array();
    public $toDueHomeworkList = array();
    public $timetableList = array();


    public function showLanding()
    {
        require_once 'lib/template/index.php';
    }


    public function showUserIndex()
    {
        require_once "lib/template/user-index.php";
    }

    public function assembleNewHwList($data)
    {
        //should be homework instead of homeworks, but never mind....
        $arr = $data["homeworks"];
        if (!empty($arr)) {
            foreach ($arr as $value) {
                $setDate = $value["inputdate"];
                if ($setDate == $this->controller->model->standardFormat) {
                    //WTF the api returns something like is_assessement....
                    $this->newHomeworkList[count($this->newHomeworkList)] = [$value["course"], $value["teacher"], $value["title"], $value["deadline"], $value["is_assessement"]];
                }
            }
        }
    }

    public function assembleHandInHwList($data)
    {
        $arr = $data["homeworks"];
        if (!empty($arr)) {
            foreach ($arr as $value) {
                $dueDate = $value["deadline"];
                if ($dueDate == $this->controller->model->standardFormatTmw) {
                    //WTF the api returns something like is_assessement....
                    $this->toDueHomeworkList[count($this->toDueHomeworkList)] = [$value["course"], $value["teacher"], $value["title"], $value["is_assessement"]];
                }
            }
        }
    }

    /*public function assembleTimetable($today, $tomorrow, $data)
    {
        $arr = $data["courses"];
        foreach ($arr as $value) {
            $courseArr = $value;
            $availableDays = array();
            $timeArr = explode(",", $value["time"]);
            /*
             * the result looks like this:
                              array (size=5)
                              0 => string 'Tu3' (length=3)
                              1 => string 'Tu4' (length=3)
                              2 => string 'W3' (length=2)
                              3 => string 'W4' (length=2)
                              4 => string '' (length=0)     <----- We need to get rid of this
             */
        /*    $timeArr = array_slice($timeArr, 0, count($timeArr) - 1);

            //Generates the availableDays array
            foreach ($timeArr as $timeValue) {
                $pattern = "/^\D+/";
                preg_match($pattern, $timeValue, $temp);
                $weekDayResult = $temp[0]; //Array to string for ease of use
                if (!in_array($weekDayResult, $availableDays)) {
                    $availableDays[count($availableDays)] = $weekDayResult;
                }

            }
            $textDayToNumDay = $this->controller->model->textDayToNumDay;

            $temp = $availableDays;
            //resets the availableDays array
            $availableDays = array();

            //converts the availableDays array into number format.
            /*
             * Monday 1
             * Tuesday 2
             * Wednesday 3
             * ...
             * Fri 5
             *//*
            foreach ($textDayToNumDay as $text => $num) {
                if (in_array($text, $temp)) {
                    $availableDays[count($availableDays)] = $num;
                }
            }
            if (in_array($today, $availableDays) || in_array($tomorrow, $availableDays)) {
                foreach ($timeArr as $timeRecord) {
                    $pattern = "/^\D+/";
                    preg_match($pattern, $timeRecord, $match);
                    $day = $match[0];
                    //converts the day from text format into digit format
                    foreach ($textDayToNumDay as $text => $num) {
                        if ($text == $day) {
                            $day = $num;
                        }
                    }
                    $arrayIndex = $day == $today ? 0 : 1;
                    if ($day == $today || $day == $tomorrow) {
                        $pattern = "/\d+/";
                        preg_match($pattern, $timeRecord, $temp);
                        $period = $temp[0];
                        $this->timetableList[$arrayIndex][$period] = $value["course"];
                    }
                }
            }
        }
    }*/
}