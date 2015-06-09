<?php

class registerView extends View
{
    public $arr = array();
	public $sel1='';
	public $sel2='';
	public $sel3='';
	public $wechatid;
	public $mobilenumber;
    public function initiatearr($result)
    {
			if(!empty($result[0]['user_wechat'])){
				$this->wechatid=$result[0]['user_wechat'];
			}
			if(!($result[0]['user_mobile']==0)){
				$this->mobilenumber=$result[0]['user_mobile'];
			}
			if(!empty($result[0]['user_gender'])){
				switch($result[0]['user_gender']){
					case 'n':
						$this->sel1=' selected="selected" ';
						break;
					case 'm':
						$this->sel2=' selected="selected" ';
						break;
					case 'f':
						$this->sel3=' selected="selected" ';
						break;
				}
			}
    }

    public function showPage()
    {
        require_once "lib/template/registrationform.php";
    }
}