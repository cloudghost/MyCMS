<?php

class viewEcaController extends ecaController{


    private $ecaId;
    private $ecaInfo;
    private $ecaMembers;
    public function start(){
        $this->model->getDatabase();
        $this->getEcaId();
        if(empty($this->ecaId)){
            $this->view->show404();
            exit;
        }
        $this->getEcaInfo();
        $this->getEcaMembers();
        foreach($this->ecaInfo as $key => $value){
            cache::addCache($key,$value);
        }
        cache::addCache("members",$this->ecaMembers);
        $ecaTitleString = "ECA | ".$this->ecaInfo["eca_name"]." |";
        cache::addCache("title",$ecaTitleString);
        $this->view->showEcaPage($this->ecaId);
    }

    private function getEcaId(){
        if(!empty($_GET["eca_id"])){
            $ecaId = database::sanitize($_GET["eca_id"]);
            $ecaCount = database::queryAndArray("SELECT COUNT(*) FROM eca WHERE eca_id = '{$ecaId}'")[0][0];
            if(!empty($ecaCount)){
                $this->ecaId = $ecaId;
            }
        }
        else{
            $this->ecaId = false;
        }
    }

    private function getEcaInfo(){
		$sid=database::sanitize($_SESSION['user']['sidRaw']);
        if($ecaInfo = database::queryAndOne("SELECT eca.*, eca_members.* FROM eca INNER JOIN eca_members on eca.eca_id=eca_members.eca_id WHERE eca.eca_id = '{$this->ecaId}' and eca_members.user_sid='{$sid}'","assoc")){
		}else{
			$ecaInfo = database::queryAndOne("SELECT * FROM eca WHERE eca_id = '{$this->ecaId}'","assoc");
		}
		if($ecaContact=database::queryAndOne("SELECT * FROM eca_info WHERE eca_id='{$this->ecaId}'","ASSOC")){
		    $this->ecaInfo = array_merge($ecaInfo,$ecaContact);	
		}
		else{
			$this->ecaInfo = $ecaInfo;	
		}
    }

    private function getEcaMembers(){
        $sql = "SELECT users.user_cName, users.user_eName, users.user_sid, users.user_year, users.user_gender, users.user_wechat, users.user_mobile , eca_members.* FROM eca_members INNER JOIN users WHERE users.user_sid = eca_members.user_sid and eca_id = $this->ecaId ORDER BY eca_members.authority DESC";
        $ecaMembers = database::queryAndArray($sql,"assoc");
        $this->ecaMembers = $ecaMembers;
    }



}