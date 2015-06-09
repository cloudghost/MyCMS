<?php

class ecaView extends View
{
    public function showEcaList()
    {
        $this->showDedicatedPage("eca_list");
    }

    public function showUserEca()
    {
        $this->showDedicatedPage("eca_main");
    }

    public function showEcaPage(){
        $this->showDedicatedPage("eca_view");
    }

    public function showEcaAttendance(){
        $this->showDedicatedPage("eca_attendance");
    }
	public function showEcaAttendancelist(){
        $this->showDedicatedPage("eca_attendancelist");
    }
	public function showEcaAttendanceview(){
        $this->showDedicatedPage("eca_attendance_view");
    }
}