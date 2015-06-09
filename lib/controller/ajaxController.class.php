<?php

//The ajax controller is independent of other controller classes
class ajaxController extends Controller{

    public $method;

    function __construct(){

    }

    public function start(){
        $this->method=$_GET["method"];
        $method = $this->method;
        $this->$method();
    }

    private function updateUserInfo(){
        $password = $_POST["password"];
        $sid = $_POST["sid"];
        $name = $_POST["name"];
        $value = $_POST["value"];
        if($password === $_SESSION["user"]["password"]) {
            require_once "lib/model/Model.class.php";
            $this->model = new Model();
            $this->model->getDatabase();
            $sid = database::sanitize($sid);
            $name = database::sanitize($name);
            $value = database::sanitize($value);
            echo  database::queryAndArray("UPDATE `users` SET `$name` = '{$value}' WHERE `user_sid` = '{$sid}'");
        }
        else{
            echo 0;
        }
    }
}