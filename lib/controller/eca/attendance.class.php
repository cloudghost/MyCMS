<?php

class attendanceEcaController extends ecaController{

    private $ecaId;
    private $ecaInfo;
    private $ecaMembers;
	private $registers;
    public function start(){
        $this->model->getDatabase();
        $this->getEcaId();
        if(empty($this->ecaId)){
            $this->view->show404();
            exit;
        }
        $this->getEcaInfo();
        $this->getEcaMembers();
		$this->getList();
        foreach($this->ecaInfo as $key => $value){
            cache::addCache($key,$value);
        }
        cache::addCache("members",$this->ecaMembers);
        $ecaTitleString = "ECA | ".$this->ecaInfo["eca_name"]." |";
        cache::addCache("title",$ecaTitleString);
		cache::addCache("attendance",$this->registers);
        $this->view->showEcaAttendance($this->ecaId);
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
        if($ecaInfo = database::queryAndArray("SELECT eca.*, eca_members.* FROM eca INNER JOIN eca_members on eca.eca_id=eca_members.eca_id WHERE eca.eca_id = '{$this->ecaId}' and eca_members.user_sid='{$sid}'","assoc")[0]){
		}else{
			$ecaInfo = database::queryAndArray("SELECT * FROM eca WHERE eca_id = '{$this->ecaId}'","assoc")[0];
		}
        $this->ecaInfo = $ecaInfo;
        
    }
    private function getEcaMembers(){
        $sql = "SELECT users.user_cName, users.user_eName, users.user_sid, users.user_year, users.user_gender, users.user_wechat, users.user_mobile , eca_members.* FROM eca_members INNER JOIN users WHERE users.user_sid = eca_members.user_sid and eca_id = $this->ecaId ORDER BY eca_members.authority DESC";
        $ecaMembers = database::queryAndArray($sql,"assoc");
        $this->ecaMembers = $ecaMembers;
    }
	private function getList(){
		$result=database::queryAndArray("SELECT * FROM `callrecord` WHERE `eca_id`='{$this->ecaId}' ORDER BY `tset` DESC","ASSOC");
		$i=1;
		foreach($result as $val){
			$sql="SELECT user_sid FROM rollrecord WHERE rollcall_id='{$val['rollcall_id']}'";
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
			$val['attendance']=$TMP;
			$arr[]=$val;
			$i++;
			if($i>3){
				break;
			}
		}
		$this->registers=$arr;
	}
}