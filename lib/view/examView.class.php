<?php

class examView extends View
{
    public $examArr = array();

    public function assembleExamList($data)
    {
        foreach ($data["exams"] as $examRecord) {
            $this->examArr[count($this->examArr)] = ["course" => $examRecord["course"], "date" => $examRecord["whichday"],
                "room" => $examRecord["room"], "seat" => $examRecord["seat"], "time" => $examRecord["time"], "exam" => $examRecord["exam"]];
        }
    }

    public function showPage()
    {
        require_once "lib/template/user-examtable.php";
    }
}