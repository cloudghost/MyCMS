<?php


class timetableView extends View
{
    public $timetableArr = array();
    public $courseNumber;
    public function assembleTimetableArr($data){
        $i = 0;
        foreach($data["courses"] as $course){
            $timeArr = explode(",",$course["time"]);
            /*
  * the result looks like this:
                   array (size=5)
                   0 => string 'Tu3' (length=3)
                   1 => string 'Tu4' (length=3)
                   2 => string 'W3' (length=2)
                   3 => string 'W4' (length=2)
                   4 => string '' (length=0)     <----- We need to get rid of this
  */
            $timeArr = array_slice($timeArr, 0, count($timeArr) - 1);
            foreach($timeArr as $time){
                $dayPattern = "/\D+/";  //The regular expression to get the letters representing the day
                $lessonPattern = "/\d+/"; //The regular expression to get the digits representing the lesson


                preg_match($dayPattern, $time, $matchDay);
                preg_match($lessonPattern, $time, $matchLesson);

                $day = $matchDay[0];
                $lesson = $matchLesson[0];

                foreach($this->controller->model->textDayToNumDay as $textDay => $numDay){
                    if($day === $textDay){
                        $day = $numDay - 1; //Converting the days index to zero based, e.g. Monday to friday = 0 - 4
                    }
                }
                $this->timetableArr[$day][$lesson] = $course["course"];
                $i ++;
            }
        }
        $this->courseNumber = $i;
    }

    public function showPage(){
        require_once "lib/template/user-timetable.php";
    }
}