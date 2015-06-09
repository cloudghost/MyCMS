<?php

class verifyController extends Controller
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
		$this->cookielogin();
        $return=$this->model->verify();
		switch($return){
			case 2:
			$m='<p class="am-text-center">点名成功！</p>';
			break;
			case 1:
			$m='<p class="am-text-center">你已经点名了！</p>';
			break;
			case -1:
			$m='<p class="am-text-center">你是不是没有登录啊？返回主页登录再来点名吧！</p>';
			break;
			case false:
			$m='<p class="am-text-center">你确定你没超时？</p>';
			break;
		}
		$this->view->showPage($m);
    }
}