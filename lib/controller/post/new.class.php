<?
	class newpostController extends postController{
		function __construct(){
			parent::__construct();
			$this->setView("View");
			$this->setModel("postModel");
		}
		public function start(){
			$this->checkLoginAndRedirect();
			cache::addCache('ecaInfo',$this->model->getEcaInfo());
			if(empty($_POST)){
				$this->view->showDedicatedPage("posteditor");
			}else{
				if(!$this->model->verify($_POST)){
					echo 0;
					exit();
				}
				$this->model->add($_POST);
			}
		}
	}
?>