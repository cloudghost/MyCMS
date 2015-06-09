<?php

class attviewEcaController extends ecaController{

    private $rollcall_id;
    private $Info;
    private $ecaMembers;
	private $registers;
    public function start(){
        $this->model->getDatabase();
        $this->getId();
        if(empty($this->rollcall_id)){
            $this->view->show404();
            exit;
        }
        $this->getRollcallInfo();
        $this->getEcaMembers();
		$this->getList();
        foreach($this->Info as $key => $value){
            cache::addCache($key,$value);
        }
        cache::addCache("members",$this->ecaMembers);
        $ecaTitleString = "ECA | ".$this->Info["eca_name"]." |";
        cache::addCache("title",$ecaTitleString);
		cache::addCache("attendance",$this->registers);
        $this->view->showEcaAttendanceView($this->ecaId);
    }
    private function getId(){
        if(!empty($_GET["rollcall_id"])){
            $rollcall_id = database::sanitize($_GET["rollcall_id"]);
            $Count = database::queryAndArray("SELECT COUNT(*) FROM callrecord WHERE rollcall_id = '{$rollcall_id}'")[0][0];
            if(!empty($Count)){
                $this->rollcall_id = $rollcall_id;
            }
        }
        else{
            $this->rollcall_id = false;
        }
    }
    private function getRollcallInfo(){
		$sid=database::sanitize($_SESSION['user']['sidRaw']);
		$InfoArray = database::queryAndOne("SELECT callrecord.*,eca.* FROM callrecord INNER JOIN eca on eca.eca_id=callrecord.eca_id WHERE callrecord.rollcall_id = '{$this->rollcall_id}'","assoc");
		$userInfo=database::queryAndOne("SELECT * FROM eca_members INNER JOIN eca on eca.eca_id=eca_members.eca_id WHERE eca_members.user_sid = '{$_SESSION['user']['sidRaw']}'","assoc");
		$this->Info = array_merge($userInfo,$InfoArray);
        
    }
    private function getEcaMembers(){
        $sql = "SELECT users.user_cName, users.user_eName, users.user_sid, users.user_year, users.user_gender, users.user_wechat, users.user_mobile , eca_members.* FROM eca_members INNER JOIN users on users.user_sid = eca_members.user_sid WHERE eca_id = {$this->Info['eca_id']} ORDER BY eca_members.authority DESC";
        $ecaMembers = database::queryAndArray($sql,"assoc");
        $this->ecaMembers = $ecaMembers;
    }
	private function getList(){
			$sql="SELECT user_sid FROM rollrecord WHERE rollcall_id='{$this->rollcall_id}'";
			$rel=database::queryAndArray($sql);
			$tmp=[];
			foreach($rel as $a){
				$tmp[]=$a[0];
			}
			foreach($this->ecaMembers as $Member){
				if(in_array($Member['user_sid'],$tmp)){
					$TMP[$Member['user_sid']]=1;
				}else{
					$TMP[$Member['user_sid']]=0;
				}
			}
		$this->registers=$TMP;
	}
}