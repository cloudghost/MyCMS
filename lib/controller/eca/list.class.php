<?php

class listEcaController extends ecaController
{



    function start()
    {
        $sid = $_SESSION["user"]["sidRaw"];
        $this->checkLoginAndRedirect();
        $this->model->getDatabase();
        if(empty($_GET["search"])){
            $sql = "SELECT  eca.eca_id, eca.eca_name, eca.eca_description, users.user_eName, users.user_sid from eca Inner Join users on users.user_sid = eca.eca_owner_sid";
        }
        else{

            $keyword = database::sanitize($_GET["search"]);
            $sql = "SELECT  eca.eca_id, eca.eca_name, eca.eca_description, users.user_eName, users.user_sid from eca Inner Join users on user_sid = eca.eca_owner_sid WHERE eca_name LIKE '%{$keyword}%' or eca_description LIKE '%{$keyword}%'";
        }
        $ecaList = database::queryAndArray($sql,"assoc");
        $ecaMembers = database::queryAndArray("SELECT eca_id from eca_members WHERE user_sid = '{$sid}' and status = 'approved'");
        cache::addCache("eca_list",$ecaList);
        cache::addCache("user_joined_eca",$ecaMembers);
        $this->view->showDedicatedPage("eca_list");
    }
}
