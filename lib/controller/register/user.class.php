<?php

class userregisterController extends registerController
{
    function __construct()
    {
        require_once "lib/model/Model.class.php";
        require_once "lib/model/cmsNewModel.class.php";
		require_once "lib/view/View.class.php";
		require_once "lib/view/registerView.class.php";
        $this->model = new cmsNewModel();
        $this->view = new registerView($this);
    }

    public function start()
    {
        $this->checkLoginAndRedirect();
        if ($this->isToShow()) {
            $infoArray = $this->model->getValidateCode($_SESSION["user"]["sid"], $_SESSION["user"]["pwd"]);
			$year = $infoArray["grade"];
            $form = $infoArray["class"];
            $userid = $infoArray["userid"];
            preg_match("/\d+/", $form, $match);
            preg_match("/\w+/", $form, $matchHouse);
            $class = $year . "." . $match[0];
            $house = $matchHouse[0];
            $_SESSION["user"]["house"] = $house;
            $_SESSION["user"]["class"] = $class;
            $_SESSION["user"]["year"] = $year;
            $_SESSION["user"]["form"] = $form;
            $_SESSION["user"]["userid"] = $userid;
			$this->model->getDatabase();
            database::connect();
			$sid = database::sanitize($_SESSION["user"]["sidRaw"]);
			$sql="select * from `users` where `user_sid` = {$sid}";
			$result=database::queryAndArray($sql,'assoc');
			$this->view->initiatearr($result);
            $this->view->showPage();
        } else {
            $this->model->getDatabase();
            database::connect();
            $sid = database::sanitize($_SESSION["user"]["sidRaw"]);
            $userid = database::sanitize($_SESSION["user"]["userid"]);
            $year = database::sanitize(substr($_SESSION["user"]["class"],0,2));
            $form = database::sanitize($_SESSION["user"]["form"]);
            $class = database::sanitize($_SESSION["user"]["class"]);
            $cName = database::sanitize($_SESSION["user"]["cName"]);
            $eName = database::sanitize($_SESSION["user"]["eName"]);
            $mobile = database::sanitize($_POST["mobile"]);
            $wechat = database::sanitize($_POST["wechat"]);
            $gender = database::sanitize($_POST["gender"]);
            $house = database::sanitize($_SESSION["user"]["house"]);
			$sql = "INSERT INTO `users` VALUES ('{$sid}','{$userid}', '{$cName}','{$eName}','{$year}', '{$house}', '{$form}', '{$class}', '{$gender}', '{$mobile}', '{$wechat}', DEFAULT )";
            $result =database::query($sql);
            if($result){
                echo 1;
            }
            else{
				$sql ="UPDATE `users` SET `user_cName`='{$cName}',`user_eName`='{$eName}',`user_year`='{$year}',`user_house`='{$house}',`user_form`='{$form}',`user_class`='{$class}',`user_gender`='{$gender}',`user_mobile`='${mobile}',`user_wechat`='{$wechat}' WHERE `user_sid`='{$sid}'";
				$result=database::query($sql);
				if(!($result)){
					die(false);
				}
                echo 0;
            }
        }
    }
    private function isToShow()
    {
        if (empty($_POST)) {
            return 1;
        } else {
            return 0;
        }
    }
}