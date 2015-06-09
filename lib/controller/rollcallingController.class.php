<?php

class rollcallingController extends Controller
{
    function __construct()
    {
        require_once "lib/model/Model.class.php";
		require_once "lib/model/rollcallingModel.class.php";
		require_once "lib/view/View.class.php";
		require_once "lib/view/rollcallingView.class.php";
		$this->model=new callingModel();
        $this->view = new callingView();
    }

    public function start()
    {
		if(!isset($_POST['id'])){
			if($result=$this->model->urlgen($_GET['method'])){
				$qr=$this->model->generateQR($result[0]);
				$this->view->showPage($qr,$result[1]);
			}else{
				$this->view->showPage('<p class="am-text-center">你生成二维码太频繁了！！</p>');
			}
		}else{
			echo $this->model->returnlatersheet($_POST['id']);
		}
    }
}