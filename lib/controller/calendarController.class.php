<?php

class calendarController extends Controller
{
    public $calendarArr;
    public $type;
    public $month;
    public $year;

    function __construct()
    {
        require_once "lib/model/Model.class.php";
        require_once "lib/model/cmsModel.class.php";
        $this->model = new cmsModel();
        require_once "lib/view/View.class.php";
        require_once "lib/view/calendarView.class.php";
        $this->view = new calendarView($this);
        parent::__construct();
    }

    public function start()
    {
        $this->checkLoginAndRedirect();
        $this->getTime();
        $this->getType();
        $this->calendarArr = $this->model->getCalendar($this->model->year, $this->model->month);
        if ($this->type === "list") {
            $this->view->assembleCalendarArrList($this->calendarArr);
            $this->view->showPage();
        } else {
            $this->view->assembleCalendarArrGraphic($this->calendarArr);

        }

    }


    private function getTime()
    {


        $month = !empty($_GET["month"]) ? $_GET["month"] : $this->model->month;
        if (!intval($month, 10) || intval($month, 10) > 12 || intval($month, 10) < 1) {
            $month = $this->model->month;
        }
        $this->model->month = $month;


        $year = !empty($_GET["year"]) ? $_GET["year"] : $this->model->year;
        if (!intval($year, 10) || intval($year, 10) > $this->model->year + 10 || intval($year, 10) < 2011) {
            $year = $this->model->year;
        }
        $this->model->year = $year;
    }

    private function getType()
    {
        $type = !empty($_GET["type"]) ? $_GET["type"] : "list";
        if ($type !== "list" || $type !== "graphic") {
            $type = "list";
        }
        $this->type = $type;
    }
}