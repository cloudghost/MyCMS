<?php

class attendanceController extends Controller
{
    public $attendanceArr;

    function __construct()
    {
        require_once "lib/model/Model.class.php";
        require_once "lib/model/cmsModel.class.php";
        $this->model = new cmsModel();
        $this->setView('View');

    }

    public function start()
    {
        if(!empty($_GET['year'])&&!empty($_GET['month'])){
            $year=$_GET['year'];
            $month=$_GET['month'];
        }else{
            $year=date('Y',time());
            $month=date('m',time());
        }
         $this->checkLoginAndRedirect();
         $this->attendanceArr = $this->model->getAttendance(array('year'=>$year,'month'=>$month));
         cache::addCache('attendance',$this->attendanceArr['INFO_DICT']);
         cache::addCacheArr(array('year'=>$year,'month'=>$month));
         //var_dump($this->attendanceArr['INFO_DICT']['abs_records']);
         $this->view->showDedicatedPage('user_attendance');
    }
}