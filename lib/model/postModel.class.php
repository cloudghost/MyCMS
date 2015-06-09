<?php

class postModel extends Model
{
	public $eca_id;
    // pwd = without salt
    // password = with salt and md5
    function __construct()
    {
        parent::__construct();
    }
	public function ignorePost($id){
		$this->getDatabase();
		$sid=database::sanitize($_SESSION['user']['sidRaw']);
		return database::query("DELETE FROM `noticetouser` WHERE `notice_id`='{$id}' and `user_sid`='{$sid}'");
	}
	public function getnewpost(){
		$this->getDatabase();
		$sid=database::sanitize($_SESSION['user']['sidRaw']);
		$sql="SELECT noticetouser.*, notices.*, eca.eca_name FROM noticetouser Inner Join notices on notices.notice_id = noticetouser.notice_id Inner Join eca on eca.eca_id = notices.eca_id WHERE noticetouser.user_sid = '{$sid}'";
		return database::queryAndArray($sql,"ASSOC");
	}
	public function getpost(){
		$this->getDatabase();
		$sid=database::sanitize($_SESSION['user']['sidRaw']);
		$sql="SELECT notices.*, eca.eca_name FROM notices Inner Join eca on eca.eca_id = notices.eca_id Inner Join eca_members on eca_members.eca_id=notices.eca_id WHERE eca_members.user_sid='{$sid}'";
		return database::queryAndArray($sql,"ASSOC");
	}
	public function getEcaInfo(){
		$this->getDatabase();
		if(empty($_GET['ecaid'])){
			return false;
		}
		$eca_id=database::sanitize($_GET['ecaid']);
		$this->eca_id=$eca_id;
		return database::queryAndOne("SELECT * FROM `eca` WHERE `eca_id`={$eca_id}","ASSOC");
	}
	public function verify($post){
		if(empty($post['notice_title'])||empty($post['notice_content'])){
			return false;
		}else{
			return true;
		}
	}
	public function add($post){
		extract($post);
		$this->getDatabase();
		$notice_title=database::sanitize($notice_title);
		$notice_content=database::sanitize($notice_content);
		$publisher_sid=database::sanitize($_SESSION["user"]["sidRaw"]);
		$time=database::sanitize(time());
		$eca_id=database::sanitize($eca_id);
		$sql="INSERT INTO `notices`(`notice_title`, `notice_content`, `publisher_sid`, `notice_submit_time`,`eca_id`) VALUES ('{$notice_title}','{$notice_content}','{$publisher_sid}','{$time}','{$eca_id}')";
		if((database::query($sql))){
			$id=database::queryAndOne("SELECT `notice_id` FROM `notices` WHERE `notice_submit_time`='{$time}'")[0];
			if(isset($user_sid)){
				$user_sid=database::sanitize($user_sid);
				if($this->addOne($id,$user_sid)){
					echo true;
				}else{
					echo false;
				}
			}else{
				if($this->addmem($id,$eca_id)){
					echo true;
				}else{
					echo false;
				}
			}
		}else{
			echo false;
		}
	}
	public function addmem($id,$eca_id){
		$this->getDatabase();
		$eca_list=database::queryAndArray("SELECT `user_sid` FROM `eca_members` WHERE `eca_id`='{$eca_id}'");
		foreach($eca_list as $ecamember){
			$sql="INSERT INTO `noticetouser` VALUES ('{$ecamember[0]}','{$id}')";
			database::query($sql);
		}
		return true;
	}
	public function addOne($id,$user){
		$this->getDatabase();
		$sql="INSERT INTO `noticetouser` VALUES ('{$user}','{$id}')";
		if(database::query($sql)){
			return true;
		}else{
			return false;
		}
	}
}