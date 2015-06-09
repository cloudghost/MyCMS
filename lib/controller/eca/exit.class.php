<?php

class exitEcaController extends ecaController{
    private $ecaId;
    private $sid;
    function __construct(){
        parent::__construct();
    }
    public function start(){
        $this->model->getDatabase();
		if(!empty($_POST['user'])&&!empty($_POST['eca'])){
			$eca=database::sanitize($_POST['eca']);
			$sid=database::sanitize($_POST['user']);
			$sql="DELETE FROM `eca_members` WHERE `user_sid`='{$sid}' and `eca_id`='{$eca}' and `authority`<'9'";
			if(database::query($sql)){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
    }
}