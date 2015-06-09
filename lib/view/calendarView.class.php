<?php

class calendarView extends View
{

    public $calendarArr = array();

    public function assembleCalendarArrGraphic($data)
    {
        foreach ($data["days"] as $dayRecord) {
            $timezone = new DateTimeZone("Asia/Hong_Kong");
            $dateString = $dayRecord["date"];
            $dateObject = new DateTime($dateString, $timezone);

        }
    }

    public function assembleCalendarArrList($data)
    {
        foreach ($data["days"] as $dayRecord) {
            $arrCount = count($this->calendarArr);
            $month = $this->controller->model->getMonth($dayRecord["date"]);
            $day = $this->controller->model->getDay($dayRecord["date"]);
            $this->calendarArr[$arrCount]["date"] = $month . "-" . $day;
            $this->calendarArr[$arrCount]["results"] = array();
            foreach ($dayRecord["records"] as $event) {
                $this->calendarArr[$arrCount]["results"][count($this->calendarArr[$arrCount]["results"])] = ["title" => $event["title"],
                    "location" => $event["location"], "content" => $event["content"], "time" => $event["time"]];
            }
        }
    }

    public function showPage()
    {
        require_once "lib/template/user-calendar.php";
    }
}