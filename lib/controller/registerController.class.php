<?php

class registerController extends Controller
{
    protected $method;

    /**
     * @var View
     */
    public $view;
    function __construct()
    {
        $this->setView("View");
        $this->setModel("cmsNewModel");
        parent::__construct();
    }

    public function start()
    {
		$this->checkLoginAndRedirect();
        $this->getMethod($this,false);
		if (!empty($this->method)) {
			$className = $this->getClassName($this);
			$child = new $className();
			$child->start();
		}else{
			
		}
    }


}







