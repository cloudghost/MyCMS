<?
	class listpostController extends postController{
		function __construct(){
			parent::__construct();
			$this->setView("View");
			$this->setModel("postModel");
		}
		public function start(){
			cache::addCache("new_post_list",$this->model->getnewpost());
			cache::addCache("post_list",$this->model->getpost());
			$this->view->showDedicatedPage("post_list");
		}
	}
?>