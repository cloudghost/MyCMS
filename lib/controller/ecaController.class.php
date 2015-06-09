<?php

class ecaController extends Controller
{

    /**
     * @var Model
     */
    public $model;

    /**
     * @var ecaView
     */
    public $view;
    public $method;

    private $userEcaList;

    function __construct()
    {
        $this->setModel("Model");
        $this->setView("ecaView");
        parent::__construct();
    }

    public function start()
    {
        $this->checkLoginAndRedirect();
        $this->getMethod($this, false);

        if (!empty($this->method)) {
            $className = $this->getClassName($this);
            $class = new $className();
            $class->start();
        } else {
            $this->model->getDatabase();
            $sid = $_SESSION["user"]["sidRaw"];
            $sql = "SELECT eca_members.user_sid, eca_members.eca_id, eca.eca_name, eca.eca_description, eca.eca_owner_sid FROM eca INNER JOIN eca_members WHERE eca.eca_id = eca_members.eca_id AND eca_members.user_sid = '{$sid}'";
            $this->userEcaList = database::queryAndArray($sql,"assoc");
            cache::addCache("userEcaList", $this->userEcaList);
            $this->view->showDedicatedPage("eca_home");
        }

    }
}