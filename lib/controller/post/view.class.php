<?
	class viewPostController extends postController{
		function __construct(){
			parent::__construct();
			$this->setView("View");
			$this->setModel("postModel");
		}
		public function start(){
			$this->checkLoginAndRedirect();
			if(empty($_GET['noticeid'])){
				$this->view->show404();
			}else{
				$this->model->getDatabase();
				$id=database::sanitize($_GET['noticeid']);
				$result=database::queryAndOne("SELECT notices.*, eca.eca_name, users.user_sid FROM `notices` Inner Join `users` on users.user_sid=notices.publisher_sid Inner Join `eca` on eca.eca_id=notices.eca_id WHERE notices.notice_id='{$id}'","ASSOC");
				cache::addCacheArr($result);
				$this->model->ignorePost($id);
				$this->view->showDedicatedPage('post_view');
			}
		}
	}
?>