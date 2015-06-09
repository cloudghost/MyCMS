<?php

class homeworkView extends View
{

    public $allHomeworkList = array();

    public function assembleAllHomeworkList($data)
    {
        if (!empty($data["homeworks"])) {
            foreach ($data["homeworks"] as $homeworkEntry) {
                $deadline = $homeworkEntry["deadline"];
                $deadlineString = $this->controller->model->getMonth($deadline) . "-" . $this->controller->model->getDay($deadline);

                if ($deadline === $this->controller->model->standardFormat) {
                    $deadlineString = $deadlineString . " (今天)";
                }
                $this->allHomeworkList[count($this->allHomeworkList)] =
                    ["course" => $homeworkEntry["course"], "teacher" => $homeworkEntry["teacher"], "setDate" => $homeworkEntry["inputdate"],
                        "title" => $homeworkEntry["title"], "deadline" => $deadlineString, "assessed" => $homeworkEntry["is_assessement"]];
                //                                                                                                              !!!!!!!!!!!!!!!!!!
            }
        }
    }

    public function sortByDeadline()
    {
        $arr = array();
        $i =0;
        foreach($this->allHomeworkList as $homework){
            $arr[$i] = $homework["deadline"];
            $i++;
        }
        arsort($arr);
        $tempArr = $this->allHomeworkList;
        unset($this->allHomeworkList);
        $j = 0;
        foreach($arr as $key=>$value){
            $this->allHomeworkList[$j] = $tempArr[$key];
            $j++;
        }
    }


    public function showPage()
    {
        require_once "lib/template/user-worklist.php";
    }
}