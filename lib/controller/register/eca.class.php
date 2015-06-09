<?php
class ecaRegisterController extends registerController{
    private $registerTime;
    private $ecaName;
    private $ecaDescription;
    private $ecaOwnerSid;
    /**
     * @var Model
     */
    public $model;
    /**
     * @var registerController
     */
    function __construct(){
        parent::__construct();
    }
    public function start(){
        $this->checkLoginAndRedirect();
        if($this->isToShow()){
            $this->view->showDedicatedPage("registereca");
        }
        else{
            if(empty($_POST["eca_name"]) || empty($_POST["eca_description"])){
                echo 3;
                exit();
            }
            $this->registerTime = time();
            $this->model->getDatabase();
            $this->prepareInsertVals();
            $this->checkIsUserRegistered();
            $this->checkIsEcaNameRegistered();
            $result = database::query("INSERT INTO `eca` VALUES (NULL ,'{$this->ecaName}', '{$this->ecaOwnerSid}', '{$this->ecaDescription}', FROM_UNIXTIME('{$this->registerTime}'))");
            $ecaId = database::queryAndArray("SELECT `eca_id` from `eca` where eca_owner_sid = '{$this->ecaOwnerSid}'")[0][0];
            $result2 = database::query("INSERT INTO `eca_members`(`user_sid`, `eca_id`, `role`,`authority`) VALUES ('{$this->ecaOwnerSid}', '{$ecaId}', 'owner','9')");
            if($result===true && $result2===true){
                echo 1;
            }
            else{
                echo 0;
            }
        }
    }

    private function isToShow(){
        if(empty($_POST)){
            return 1;
        }
        else{
            return 0;
        }
    }

    private function prepareInsertVals(){
        $this->ecaName = database::sanitize($_POST["eca_name"]);
        $this->ecaDescription = htmlentities(database::sanitize($_POST["eca_description"]));
        $this->ecaOwnerSid = $_SESSION["user"]["sidRaw"];
    }

    private function checkIsUserRegistered(){
        $count = database::queryAndArray("SELECT COUNT(*) FROM eca WHERE eca_owner_sid = '{$this->ecaOwnerSid}'")[0][0];
        if($count > 0){
            echo 4;
            exit();
        }
    }

    private function checkIsEcaNameRegistered(){
        $count = database::queryAndArray("SELECT COUNT(*) FROM eca WHERE eca_name = '{$this->ecaName}'")[0][0];
        if($count > 0){
            echo 5;
            exit;
        }
    }
}