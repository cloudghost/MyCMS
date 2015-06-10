<?php

class timetableController extends Controller
{
    public $timetableArr;

    function __construct()
    {
        require_once "lib/model/Model.class.php";
        require_once "lib/model/cmsModel.class.php";
        $this->model = new cmsModel();
        require_once "lib/view/View.class.php";
        require_once "lib/view/timetableView.class.php";
        $this->view = new timetableView($this);
        parent::__construct();

    }

    public function start()
    {
        $this->checkLoginAndRedirect();
        $this->timetableArr = $this->model->getTimetable();
        //$this->view->assembleTimetableArr($this->timetableArr);
        //var_dump($this->timetableArr);
        cache::addCache('timetable',$this->timetableArr['INFO_DICT']);
        $this->view->showPage();
    }
}