<?
	class editNewsController extends newsController{
		function __construct(){
			parent::__construct();
			$this->setView("View");
			$this->setModel("newsModel");
		}
		public function start(){
			$this->checkLoginAndRedirect();
			cache::addCache('media_name',$this->model->getMediaInfo()['media_name']);
			if(empty($_POST)){
				if(empty($_GET['news'])){
					$this->view->showDedicatedPage("newseditor");
				}else if(!empty($_GET['delete'])){
					$this->model->deleteNews($_GET['news']);
					$this->view->temporaryRedirect('/news/manage');
				}else{
					cache::addCache('news_id',$_GET['news']);
					if($arr=$this->model->getNews($_GET['news'])){
						foreach($arr as $key=>$value){
							cache::addCache($key,$value);
						}
					}
					$this->view->showDedicatedPage("newseditor");
				}
			}else{
				if(!$this->model->verify($_POST)){
					echo 0;
					exit();
				}
				if(empty($_POST['news_id'])){
					$this->model->add($_POST);
				}else{
					$this->model->modify($_POST);
				}
			}
		}
	}
?>