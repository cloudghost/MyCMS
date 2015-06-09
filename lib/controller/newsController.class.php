<?php

class newsController extends Controller
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

    function __construct()
    {
        $this->setModel("Model");
        $this->setView("View");
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
        }
        else{
            
        }
    }


}