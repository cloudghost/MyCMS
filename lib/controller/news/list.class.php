<?php
	class listNewsController extends newsController{
		function __construct(){
			parent::__construct();
			$this->setView("View");
			$this->setModel("newsModel");
		}
		public function start(){
			$this->checkLoginAndRedirect();
			if(empty($_GET["search"])){
				$sql = "SELECT  news.news_id, news.news_title, news.news_description, news.media_id, media.media_name, news.news_submit_time, users.user_eName, users.user_cName, users.user_sid from news Inner Join users on users.user_sid = news.user_sid Inner Join media on media.media_id = news.media_id ORDER BY news.news_submit_time DESC";
			}else{
				$keyword = database::sanitize($_GET["search"]);
				$sql = "SELECT  news.news_id, news.news_title, news.news_description, news.media_id, media.media_name, news.news_submit_time, users.user_eName, users.user_cName, users.user_sid from news Inner Join users on users.user_sid = news.user_sid Inner Join media on media.media_id = news.media_id WHERE news_title LIKE '%{$keyword}%' or news_description LIKE '%{$keyword}%' or news_content LIKE '%{$keyword}%' ORDER BY news.news_submit_time DESC";
			}
			$newsList = database::queryAndArray($sql,"assoc");
			cache::addCache("news_list",$newsList);
			$this->view->showDedicatedPage("news_list");
		}
	}
?>