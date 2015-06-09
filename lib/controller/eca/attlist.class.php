<?php

class attlistEcaController extends ecaController{

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
        $this->view->showEcaAttendancelist($this->ecaId);
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
    private function getEcaMembers(){
        $sql = "SELECT * FROM `eca_members` WHERE `eca_id`='{$this->ecaId}'";
        $ecaMembers = database::queryAndArray($sql,"ASSOC");
        $this->ecaMembers = $ecaMembers;
    }
	private function getList(){
		$result=database::queryAndArray("SELECT * FROM `callrecord` WHERE `eca_id`='{$this->ecaId}' ORDER BY `tset` DESC","ASSOC");
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
		}
		$this->registers=$arr;
	}
	private function getEcaInfo(){
		$ecaInfo = database::queryAndArray("SELECT * FROM eca WHERE eca_id = '{$this->ecaId}'","assoc")[0];
        $this->ecaInfo = $ecaInfo;
    }
}