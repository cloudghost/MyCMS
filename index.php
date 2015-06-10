<?php

/*
 * MyCMS -- A better cms for SCIERS
 *
 *
 */

session_start();
date_default_timezone_set("Asia/Hong_Kong");
$action = !empty($_GET["action"]) ? $_GET["action"] : "index";
/*
 * allowed urls:
 *      /
 *      /login
 *      /homework
 *      /subject
 *      /exam
 *      /calendar
 */

$allowed = ["index", "login", "homework","attendance", "timetable", "exam", "calendar", "show", "functions", "feedback", "ajax", "register", "eca", "verify","rollcalling","news","post"];

//Gets the controller class files

require_once "lib/controller/Controller.class.php";
if (!in_array($action, $allowed)) {
    $controller = new Controller();
    $controller->setView("View");
    $controller->view->show404();
    exit();
}
if ($action == "functions") {
    $funcName = $_GET["name"];
    $controller = new Controller();
    $controller->$funcName();
}
if ($action == "show") {
    $controller = new Controller();
    $controller->setView("View");
    $controller->view->showDedicatedPage($_GET["page"]);
    exit();
}
$cName = $action . "Controller";
require_once "lib/controller/$cName.class.php";
/**
 * @var Controller
 */
$controller = new $cName();
$controller->start();
