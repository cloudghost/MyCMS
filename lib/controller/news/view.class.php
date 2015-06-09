<?
	class viewNewsController extends newsController{
		function __construct(){
			parent::__construct();
			$this->setView("View");
			$this->setModel("Model");
		}
		public function start(){
			$this->checkLoginAndRedirect();
			if(empty($_GET['news'])){
				$this->view->show404();
			}else{
				$this->model->getDatabase();
				$id=database::sanitize($_GET['news']);
				$result=database::queryAndOne("SELECT news.*, media.media_name FROM `news` Inner Join `media` on media.media_id=news.media_id WHERE `news_id`='{$id}'","ASSOC");
				cache::addCacheArr($result);
				$this->view->showDedicatedPage('news_view');
			}
		}
	}
?>