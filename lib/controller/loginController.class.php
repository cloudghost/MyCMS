<?php

class loginController extends Controller
{

    private $isToParse;
    private $isValidSid;
    private $loginSuccess;

    function __construct()
    {
        require_once "lib/model/Model.class.php";
        require_once "lib/model/cmsModel.class.php";
        require_once "lib/model/cmsNewModel.class.php";
		$this->newmodel = new cmsNewModel();
        $this->model = new cmsModel();
        /*Overrides the controller construct function as we do not need to automatically go to the registration form. We need to
        Validate user login first*/
        require_once "lib/view/View.class.php";
        require_once "lib/view/loginView.class.php";

        $this->view = new loginView($this);
        parent::__construct();
    }

    public function start()
    {

        if ($this->checkLogin()) {
            $this->addCrossMessage("alertWarningMessage", "你好像已经登陆了", "错误");
            $this->view->temporaryRedirect("/");
            exit();
        }
        $this->view->title = "登陆";
        $this->checkIsToParse();
        if ($this->isToParse) {
            $this->login();
            if (!empty($_POST["remember"])) {
                setcookie("sid", $_SESSION["user"]["sid"], time() + 365 * 24 * 60 * 60);
                setcookie("password", $_SESSION["user"]["password"], time() + 365 * 24 * 60 * 60);
                setcookie("pwd", $this->model->encrypt($_SESSION["user"]["pwd"]), time() + 365 * 24 * 60 * 60);
            }
            if (!$this->checkDBRegistration()) {
                $_SESSION["user"]["type"] = "user";
				$infoArray = $this->newmodel->getValidateCode($_SESSION["user"]["sid"], $_SESSION["user"]["pwd"]);
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
				$userid = database::sanitize($_SESSION["user"]["userid"]);
				$year = database::sanitize(substr($_SESSION["user"]["class"],0,2));
				$form = database::sanitize($_SESSION["user"]["form"]);
				$class = database::sanitize($_SESSION["user"]["class"]);
				$cName = database::sanitize($_SESSION["user"]["cName"]);
				$eName = database::sanitize($_SESSION["user"]["eName"]);
				$house = database::sanitize($_SESSION["user"]["house"]);
				$sql = "INSERT INTO `users` VALUES ('{$sid}','{$userid}', '{$cName}','{$eName}','{$year}', '{$house}', '{$form}', '{$class}', '', '0', '', DEFAULT )";
				$result =database::query($sql);
				$this->view->temporaryRedirect("/register/user");
                exit();
            } else {
                $sid = $_SESSION["user"]["sidRaw"];
                $this->model->getUserDataFromDb($sid);
                $this->view->temporaryRedirect("/");
                exit();
            }
        } else {
            $this->view->showPage();
        }
    }

    private function checkIsToParse()
    {
        if (!empty($_POST["sid"]) && !empty($_POST["pwd"])) {
            $this->isToParse = 1;
        } else {
            $this->isToParse = 0;
        }
    }

    private function login()
    {
        $this->model->sid = $_POST["sid"];
        $this->isValidSid = $this->model->validateSid();
        if (!$this->isValidSid) {
            $this->view->addMessage("alertDangerMessage", "错误的账户格式");
            $this->view->showPage();
            exit();
        }
        $this->model->pwd = $_POST["pwd"];
        if (!$this->model->getStudentInfo()) {
            $this->view->addMessage("alertDangerMessage", "用户名不存在");
            $this->view->showPage();
            exit();
        }
        if (!$this->model->validatePassword()) {
            $this->view->addMessage("alertDangerMessage", "密码错误");
            $this->view->showPage();
            exit();
        }
        $this->model->setSessionVals();
    }


}