<?php

class feedbackController extends Controller
{


    function __construct()
    {
        require_once "lib/model/Model.class.php";
        require_once "lib/model/cmsModel.class.php";
        $this->model = new cmsModel();
        require_once "lib/view/View.class.php";
        require_once "lib/view/feedbackView.class.php";
        $this->view = new feedbackView();
        parent::__construct();

    }

    public function start()
    {
        $this->checkLoginAndRedirect();
        $this->view->showPage();
    }
}