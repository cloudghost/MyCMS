<?php

class View
{
    public $cache = array();
    public $title;
    public $controller;
    public $jsListArr = array();
    public $messageArr = array();

    function __construct($controller = null)
    {
        $this->controller = $controller;
        require_once "lib/frontFunctions.php";
        require_once "lib/cache.class.php";
        $this->initiateCrossMessage();
    }

    /*
     * Shows a 404 error page
     */

    public function initiateCrossMessage()
    {
        if (!empty($_SESSION["server"]["crossMessage"])) {
            foreach ($_SESSION["server"]["crossMessage"] as $messageArr) {
                $this->addMessage($messageArr["type"], $messageArr["content"], $messageArr["title"]);
            }
            unset($_SESSION["server"]["crossMessage"]);
        }
    }

    public function addMessage($messageType, $content, $title = null)
    {
        require_once "lib/message/Message.class.php";
        require_once "lib/message/" . $messageType . ".class.php";
        $message = new $messageType($content, $title);
        $this->messageArr[count($this->messageArr)] = $message;
    }

    public function show404()
    {
        header("HTTP/1.1 404 Not Found");
        require_once "lib/template/404.php";
        exit();
    }

    /**
     *403 Error function. Shows the 403 page and automatically exits
     */
    public function show403()
    {
        header("HTTP/1.1 403 Restricted Content");
        require_once "lib/template/403.php";
        exit();
    }

    public function permanentRedirect($url)
    {
        header("Location: $url", true, 301);
        exit();
    }

    public function temporaryRedirect($url)
    {
        header("Location: $url", true, 302);
        exit();
    }

    public function showDedicatedPage($page)
    {
        require_once "lib/template/$page.php";
    }

    public function showMessage()
    {
        foreach ($this->messageArr as $message) {
            $message->showMessage();
        }
    }

    public function addCache($key, $value)
    {
        $this->cache[$key] = $value;
    }

    public function getCache($key)
    {
        return $this->cache[$key];

    }

    public function setTitle($string)
    {
        $this->title = $string;
    }
}