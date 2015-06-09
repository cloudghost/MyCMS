<?php

class indexController extends Controller
{
    private $toShowUserIndex;

    private $timetableArr;
    private $examArr;
    private $homeworkArr;
    private $calendarArr;

    function __construct()
    {
        require_once "lib/model/Model.class.php";
        require_once "lib/model/cmsModel.class.php";
        $this->model = new cmsModel();
        require_once "lib/view/View.class.php";
        require_once "lib/view/indexView.class.php";
        $this->view = new indexView($this);
        parent::__construct();

    }


    public function start()
    {
        $this->toShowUserIndex = $this->checkLogin();
        if ($this->toShowUserIndex) {
            $this->model->getDatabase();
            $this->view->addMessage("alertSuccessMessage", "为什么不去<a href='/feedback'><strong>评论区</strong></a>发表一个言论呢");
            $this->timetableArr = $this->model->getTimetable();
            $this->calendarArr = $this->model->getCalendar(date("Y"), date("n"));
            $this->examArr = $this->model->getExam();
            $this->homeworkArr = $this->model->getHomework();
            $this->view->assembleNewHwList($this->homeworkArr);
            $this->view->assembleHandInHwList($this->homeworkArr);
            $this->view->assembleTimetable($this->model->weekDay, $this->model->weekDayTmw, $this->timetableArr);
            $this->view->showUserIndex();


        } else {
            $this->view->showLanding();
        }
    }
}