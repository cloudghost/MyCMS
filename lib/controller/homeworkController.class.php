<?php

class homeworkController extends Controller
{
    public $homeworkArr;

    function __construct()
    {
        require_once "lib/model/Model.class.php";
        require_once "lib/model/cmsModel.class.php";
        $this->model = new cmsModel();
        require_once "lib/view/View.class.php";
        require_once "lib/view/homeworkView.class.php";
        $this->view = new homeworkView($this);
        parent::__construct();

    }


    public function start()
    {
        $this->checkLoginAndRedirect();
        $this->homeworkArr = $this->model->getHomework();
        $this->view->addMessage("alertSuccessMessage", "若要查看详细信息，请点击你要看的那一行");
        $this->view->assembleAllHomeworkList($this->homeworkArr);
        $this->view->sortByDeadline();
        $this->view->showPage();
    }
}