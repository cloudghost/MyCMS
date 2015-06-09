<?php
	class callingModel extends Model{
		function __construct(){
			parent::getDatabase();
			database::connect();
		}
		public function gettoken($length){
			$returnStr='';
			$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
			for($i = 0; $i < $length; $i ++) {
				$returnStr .= $pattern {mt_rand ( 0, strlen($pattern)-1) }; //生成php随机数
			}
			if(!($this->validate($returnStr))){
				return gettoken($length);
			}else{
				return $returnStr;
			}
		}
		function get(){
			return array('id'=>(int)($_GET["id"]),'token'=>$_GET["token"]);
		}
		public function verify(){
			parent::getDatabase();
			database::connect();
			if(!empty($_SESSION['user']['sidRaw'])){
				$sid=database::sanitize($_SESSION['user']['sidRaw']);
			}else{
				return -1;
			}
			$arr=$this->get();
			extract($arr);
			if($this->checkcall($id,$sid)){
				$r=$this->addroll($id,$sid);
				if($r==-1){
					return 1;
				}else if($r==2){
					return 2;
				}else{
					return -1;
				}
			}else{
				return false;
			}
		}
		public function validate($token){
			parent::getDatabase();
			database::connect();
			$sql='SELECT `token` from `callrecord`';
			$arr=database::queryAndArray($sql);
			foreach($arr as $val){
				if(in_array($token,$val)){
					return false;
				}
			}
			return true;
		}
		private function addroll($id,$sid){
			parent::getDatabase();
			database::connect();
			$sql="SELECT `user_sid` FROM `rollrecord` WHERE `rollcall_id`= $id ";
			$arr=database::queryAndArray($sql);
			foreach($arr as $val){
				if(in_array($sid,$val)){
					return -1;
				}
			}
			if($sid!=0){
				$sql="INSERT INTO `rollrecord` VALUES('{$id}','{$sid}')";
				$result = database::query($sql);
				if($result){
					return 2;
				}else{
					return false;
				}
			}
		}
		public function generateQR($url,$width=400){
			return "<img onload=\"imgresponse()\" id=\"qrcode\" src=\"http://qr.liantu.com/api.php?bg=ffffff&fg=0000ff&gc=00ffff&w=$width&text=$url/\">";
		}
		public function mysqladd($token,$ecaid,$sid){
			parent::getDatabase();
			database::connect();
			$timeset=time();
			$sql="SELECT * FROM `callrecord` WHERE `eca_id`='{$ecaid}' ORDER BY `tset` DESC";
			//select * from table1 order by field1,field2 [desc]
			$result=database::queryAndOne($sql,"ASSOC");
			if(!empty($result)&&(($timeset-48*60*60)<$result['tset'])){
				if(($timeset-15*60)<$result['tset']){
					$this->rollcall=$result;
				}else{
					$this->rollcall=null;
				}
				return false;
			}
			$sql = "INSERT INTO `callrecord`(`token`,`eca_id`,`tset`) VALUES ('{$token}','{$ecaid}','{$timeset}')";
			$result = database::query($sql);
			$sql="SELECT `rollcall_id` FROM `callrecord` WHERE `tset`='{$timeset}'";
			$arr=database::queryAndArray($sql);
			$id=$arr[0][0];
			$sql="INSERT INTO `rollrecord` VALUES('{$id}','{$sid}')";
			$result = database::query($sql);
			return $id;
		}
		public function checkcall($rollid,$sid){
			parent::getDatabase();
			database::connect();
			$sql = "SELECT * FROM `callrecord` WHERE `rollcall_id`= $rollid ";
			$arr=database::queryAndArray($sql);
			if(in_array($rollid,$arr[0])){
				$sql="SELECT count(*) FROM `eca_members` WHERE `eca_id`='{$arr[0][2]}' AND `user_sid`='{$sid}'";
				$result=database::queryAndOne($sql);
				if($result[0]==1){
					return true;
				}
				else{
					return false;
				}
			}
			return false;
		}
		public function urlgen($ecaid){
			parent::getDatabase();
			database::connect();
			if (!$this->checkuser($ecaid,$_SESSION["user"]["sidRaw"])){
				return false;
			}
			$token=$this->gettoken(8);
			$sid = database::sanitize($_SESSION["user"]["sidRaw"]);
			$rollid=$this->mysqladd($token,$ecaid,$sid);
			if($rollid){
				$url= "http://{$_SERVER["HTTP_HOST"]}/index.php?action=verify%26token=$token%26id=$rollid";
				return array($url,$rollid);
			}else{
				if(isset($this->rollcall)){
					$url= "http://{$_SERVER["HTTP_HOST"]}/index.php?action=verify%26token={$this->rollcall['token']}%26id={$this->rollcall['rollcall_id']}";
					return array($url,$this->rollcall['rollcall_id']);
				}
				return false;
			}
		}
		private function checkuser($ecaid,$sid){
			parent::getDatabase();
			$sql="SELECT count(*) FROM `eca_members` WHERE `user_sid`='{$sid}' and `eca_id`='{$ecaid}' and `authority`>='8'";
			if(database::queryAndOne($sql)[0]>0){
				return true;
			}else{
				return false;
			}
		}
		public function returnlatersheet($id){
			parent::getDatabase();
			database::connect();
			$id = database::sanitize($id);
			$sql="SELECT `user_sid` FROM `rollrecord` WHERE `rollcall_id`='{$id}' ";
			$result=database::queryAndArray($sql);
			$arr=[];
			foreach($result as $r){
				$arr[]=$r[0];
			}
			return json_encode($arr);
		}
	}
?>