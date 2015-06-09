<?php

class loginNewsController extends newsController
{

    function __construct(){
			parent::__construct();
			$this->setView("View");
			$this->setModel("newsModel");
		}

    public function start()
    {

        if(($this->model->getMedia())||($this->model->mediaLogin())){
            $this->view->temporaryRedirect("/news/manage");
            exit();
        }
		if(empty($_POST['mediaID'])){
			$this->view->showDedicatedPage('news_login');
		}else{
			if($this->model->mediaLogin()!=false){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
}