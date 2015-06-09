<?php

class joinEcaController extends ecaController{

    private $ecaId;
    private $sid;
    function __construct(){
        parent::__construct();
        $this->sid = $_SESSION["user"]["sidRaw"];
    }
    public function start(){
        $this->model->getDatabase();
        $this->getEca();
        $this->validateEca();
        $this->checkUserRegistered();
        $this->registerUser();
    }

    private function getEca(){
        if(!empty($_GET["eca_id"])){
            $this->ecaId = $_GET["eca_id"];
        }
        else{
            echo 0;
            exit();
        }
    }
    private function validateEca(){
        if(intval($this->ecaId)){
            $this->ecaId = database::sanitize($this->ecaId);
            $result = database::queryAndArray("SELECT COUNT(*) FROM eca where eca_id = '{$this->ecaId}'")[0][0];
            $result = intval($result);
            if($result == 0){
                echo 0;
                exit();
            }
        }
    }

    private function checkUserRegistered(){
        $result = database::queryAndArray("SELECT COUNT(*) FROM eca_members where eca_id = '{$this->ecaId}' and user_sid = '{$this->sid}'")[0][0];
        $result=intval($result);
        if($result > 0){
            echo 2;
            exit();
        }
    }
    private function registerUser(){
        $result = database::query("INSERT INTO eca_members VALUES ('{$this->sid}','{$this->ecaId}','member',DEFAULT)");
        if($result){
            echo 1;
        }
        else{
            echo 0;
        }
    }
}