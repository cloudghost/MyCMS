<?php
	class newsModel extends Model{
		public $media;
		function __construct(){
			parent::getDatabase();
			database::connect();
		}
		public function deleteNews($id){
			parent::getDatabase();
			$id=database::sanitize($id);
			database::query("DELETE FROM `news` WHERE `news_id`='{$id}'");
		}
		public function getNews($id){
			parent::getDatabase();
			$id=database::sanitize($id);
			return database::queryAndOne("SELECT * FROM `news` WHERE `news_id`='{$id}'",'ASSOC');
		}
		public function getMediaInfo(){
			parent::getDatabase();
			if($this->getMedia()){
				return database::queryAndOne("SELECT `media_id`, `user_sid`, `media_name` FROM `media` WHERE `media_id` = '{$this->media}'",'ASSOC');
			}else{
				return false;
			}
		}
		public function getMedia(){
			parent::getDatabase();
			if(empty($_SESSION['media'])){
				return false;
			}
			$this->media=database::sanitize($_SESSION['media']['ID']);
			return true;
		}
		public function mediaLogin(){
			if($this->getMedia()){
				return true;
			}
			if(!(empty($_COOKIE['mediaID']))||!empty($_COOKIE['mediaPassword'])){
				return $this->cookieLogin();
			}else if(!empty($_POST['mediaID'])&&!empty($_POST['mediaPassword'])){
				return $this->login($_POST['mediaID'],$_POST['mediaPassword']);
			}else{
				return false;
			}
		}
		private function login($mediaID,$mediaPassword){
			if($this->userCheck($mediaID,$mediaPassword)){
				if(!empty($_POST["remember"])){
					setcookie("mediaID", $mediaID, time() + 365 * 24 * 60 * 60);
					setcookie("mediaPassword", $this->encrypt($mediaPassword), time() + 365 * 24 * 60 * 60);
					return true;
				}else{
					return true;
				}
			}else{
				return false;
			}
		}
		private function cookieLogin(){
			parent::getDatabase();
			$mediaID=$_COOKIE['mediaID'];
			$mediaPassword=$this->decrypt($_COOKIE['mediaPassword']);
			return $this->userCheck($mediaID,$mediaPassword);
		}
		private function userCheck($mediaID,$mediaPassword){
			parent::getDatabase();
			$mediaID=database::sanitize($mediaID);
			$mediaPassword=database::sanitize($mediaPassword);
			$sql="SELECT `media_key` FROM `media` WHERE `media_id`={$mediaID}";
			if(database::queryAndOne($sql)[0]==$mediaPassword){
				$this->setSession($mediaID,$mediaPassword);
				return true;
			}else{
				return false;
			}
		}
		private function setSession($mediaID,$pwd){
			$this->media=$mediaID;
			$_SESSION["media"]["ID"] = $this->media;
			$_SESSION["media"]["pwd"] = $pwd;
		}
		public function sessionDestory(){
			$_SESSION["media"]["ID"] = null;
			$_SESSION["media"]["pwd"] = null;
		}
		public function getcontent($id){
			parent::getDatabase();
			database::connect();
			database::sanitize($id);
			$sql="SELECT * FROM `news` WHERE `news_id`='{$id}'";
			return database::queryAndOne($sql,'assoc');
		}
		public function verify($post){
			if(empty($post['news_title'])||empty($post['news_description'])||empty($post['news_content'])){
				return false;
			}else{
				return true;
			}
		}
		public function add($post){
			extract($post);
			parent::getDatabase();
			database::connect();
			$news_title=database::sanitize($news_title);
			$news_description=database::sanitize($news_description);
			$news_content=database::sanitize($news_content);
			$user_sid=database::sanitize($_SESSION["user"]["sidRaw"]);
			$time=database::sanitize(time());
			$media=database::sanitize($_SESSION["media"]["ID"]);
			$sql="INSERT INTO `news`(`news_title`, `news_description`, `news_content`, `media_id`,`user_sid`, `news_submit_time`) VALUES ('{$news_title}','{$news_description}','{$news_content}','{$media}','{$user_sid}','{$time}')";
			if(database::query($sql)){
				echo true;
			}
		}
		public function modify($post){
			extract($post);
			parent::getDatabase();
			database::connect();
			$news_id=database::sanitize($news_id);
			$news_title=database::sanitize($news_title);
			$news_description=database::sanitize($news_description);
			$news_content=database::sanitize($news_content);
			$user_sid=database::sanitize($_SESSION["user"]["sidRaw"]);
			$time=database::sanitize(time());
			$sql="UPDATE `news` SET `news_title`='{$news_title}',`user_sid`='{$user_sid}',`news_description`='{$news_description}',`news_content`='{$news_content}',`news_submit_time`='{$time}' WHERE `news_id`='{$news_id}'";
			if(database::query($sql)){
				echo true;
			}
		}
		
	}
?>