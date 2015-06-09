<?php

class memberviewEcaController extends ecaController
{
    function start()
    {
        $this->model->getDatabase();
		$sid=$_GET['userid'];
        $sid = database::sanitize($sid);
        $sql = "SELECT eca_members.user_sid, eca_members.eca_id, eca.eca_name, eca.eca_description, eca.eca_owner_sid FROM eca INNER JOIN eca_members WHERE eca.eca_id = eca_members.eca_id AND eca_members.user_sid = '{$sid}'";
        $this->userEcaList = database::queryAndArray($sql,"assoc");
        cache::addCache("userEcaList", $this->userEcaList);
		$result=database::queryAndOne("SELECT * FROM `users` WHERE user_sid = '{$sid}'",'ASSOC');
		cache::addCacheArr($result);
        $this->view->showDedicatedPage("user_view");
		
    }
}
