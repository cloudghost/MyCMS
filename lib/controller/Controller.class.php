<?php

class Controller
{

    public $view;
    public $model;


    public function __construct()
    {
        $this->cookieLogin();
    }

    /**
     *Logs the user in using cookies if the user isn't already logged in.
     */
    protected function cookieLogin()
    {
        require_once "lib/model/Model.class.php";
        if (!empty($_COOKIE["sid"]) && !empty($_COOKIE["password"]) && !empty($_COOKIE["pwd"]) && !$this->checkLogin()) {
            if (get_class($this->model) !== "cmsModel") {
                require_once "lib/model/cmsModel.class.php";
                $modelTemp = new cmsModel();
            } else {
                $modelTemp = $this->model;
            }
            $modelTemp->getDatabase();
            $sid = $_COOKIE["sid"];
            $password = $_COOKIE["password"];
            $pwd = $modelTemp->decrypt($_COOKIE["pwd"]);
            $modelTemp->sid = $sid;
            $modelTemp->pwd = $pwd;
            $modelTemp->password = $password;
            if ($modelTemp->validateSid() && $modelTemp->getStudentInfo() && $modelTemp->validatePassword()) {
                $modelTemp->setSessionVals();
                if (!$this->checkDBRegistration()) {
                    $_SESSION["user"]["type"] = "user";
                    $this->view->temporaryRedirect("/register");
                    exit();
                } else {
                    $sid = $_SESSION["user"]["sidRaw"];
                    $modelTemp->getUserDataFromDb($sid);
                    $this->view->temporaryRedirect("/");
                    exit();
                }
            }

        }
    }

    /*
     * function used to check whether or not the user is logged in. Returns 1 when logged in and 0 when not.
     */

    public function checkLogin()
    {
        if (empty($_SESSION["user"]["sid"])) {
            return 0;
        } else {
            return 1;
        }
    }

    public function logOut()
    {
        session_destroy();
        unset($_SESSION);
        setcookie("sid", null, time() - 100);
        setcookie("password", null, time() - 100);
        $this->setView("View");
        $this->view->temporaryRedirect("/");
    }

    public function setView($view)
    {
        require_once "lib/view/View.class.php";
        if ($view !== "View") {
            require_once "lib/view/$view.class.php";
        }
        $this->view = new $view();
    }

    public function setModel($model)
    {
        require_once "lib/model/Model.class.php";
        if ($model !== "Model") {
            require_once "lib/model/$model.class.php";
        }
        $this->model = new $model();
    }

    public function addCrossMessage($type, $content, $title = null)
    {
        if (empty($_SESSION["server"]["crossMessage"])) {
            $_SESSION["server"]["crossMessage"] = array();
            $arrLength = 0;
        } else {
            $arrLength = $_SESSION["server"]["crossMessage"];
        }
        $_SESSION["server"]["crossMessage"][$arrLength] = ["type" => $type, "content" => $content, "title" => $title];
    }

    protected function checkLoginAndRedirect()
    {
        if (!$this->checkLogin()) {
            $this->view->addMessage("alertDangerMessage", "这个页面需要登陆，你没登陆来干啥", "没有登录");
            $this->view->show403();
        }
    }

    public function checkDBRegistration()
    {
        preg_match("/\d+/", $_SESSION["user"]["sid"], $match);
        $sid = $match[0];
        $this->model->getDatabase();
        $result = database::queryAndArray("SELECT COUNT(*) FROM `users` WHERE user_sid = '{$sid}'")[0][0];
        return $result;
    }

    /**
     * @param $class Controller
     * @return string
     */
    protected function getClassPureName($class)
    {
        $className = get_class($class);
        $classTypeArr = ["Controller", "Model", "View"];
        foreach ($classTypeArr as $value) {
            if (strpos($className, $value) !== false) {
                $classType = $value;
                break;
            }
        }
        $className = str_replace($classType, "", $className);
        return $className;
    }

    /**
     * @param $class Controller
     * @return string
     */
    protected function getClassType($class)
    {
        $className = get_class($class);
        $classTypeArr = ["Controller", "Model", "View"];
        $classType = "";
        foreach ($classTypeArr as $value) {
            if (strpos($className, $value) !== false) {
                $classType = $value;
                break;
            }
        }
        return $classType;
    }

    protected function checkAddOnExists($addOnName, $caller)
    {
        $className = $this->getClassPureName($caller);
        $dirString = "lib/controller/" . $className;
        $list = scandir($dirString);
        $found = false;
        $addOnName = $addOnName . ".class.php";

        $classType = $this->getClassType($caller);
        $classType = strtolower($classType);
        foreach ($list as $listVal) {
            if ($addOnName === $listVal) {
                $found = "lib/" . $classType . "/" . $className . "/" . $addOnName;
                break;
            }
        }
        return $found;
    }

    protected function getClassName($class)
    {
        $addOnName = $class->method;
        $callerCapitalized = ucfirst(get_class($class));
        return $addOnName . $callerCapitalized;
    }

    protected function getMethod($class, $needRedirct = true)
    {
        $addOn = empty($_GET["method"]) ? false : $_GET["method"];
        $class->method = $addOn;
        if (!empty($addOn)) {
            if ($dir = $this->checkAddOnExists($addOn, $class)) {
                require_once $dir;
            } else {
                $this->view->show404();
                exit();
            }
        }
        //The first if skipped, so the addOn must be empty
        elseif($needRedirct === true){
            $this->view->show404();
            exit();
        }
    }
}