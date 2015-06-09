<?php

class examController extends Controller
{
    public $examArr;

    function __construct()
    {
        require_once "lib/model/Model.class.php";
        require_once "lib/model/cmsModel.class.php";
        $this->model = new cmsModel();
        require_once "lib/view/View.class.php";
        require_once "lib/view/examView.class.php";
        $this->view = new examView($this);
        parent::__construct();

    }

    public function start()
    {
        $this->checkLoginAndRedirect();
        $this->examArr = $this->model->getExam();
        $this->view->assembleExamList($this->examArr);
        $this->view->showPage();
    }
}