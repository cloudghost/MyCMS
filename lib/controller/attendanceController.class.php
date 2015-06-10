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
        if(isset($_GET['year'])&&isset($_GET['momth'])){
            $year=$_GET['year'];
            $month=$_GET['momth'];
        }else{
            $year=date('yyyy',time());
            $month=date('mm',time());
        }
         $this->checkLoginAndRedirect();
         $this->attendanceArr = $this->model->getAttendance(array('year'=>$year,'month'=>$month));
         var_dump($this->attendanceArr);
         cache::addCache('attendance',$this->attendanceArr['INFO_DICT']);
         $this->view->showDedicatedPage('user_attendance');
    }
}