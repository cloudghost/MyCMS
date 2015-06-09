<?php

class apiEcaController extends ecaController
{


    public function start()
    {
        $this->setModel('Model');
        $this->model->getDatabase();
        $method = $_GET["require"];
        $string = '$this->' . $method . "();";
        eval($string);
    }
	private function updateAttendance()
    {
        $this->checkLoginAndRedirect();
        if(!$json_string = $_POST['post']){
			echo false;
			exit();
		}
		$arr = json_decode($json_string,true);
		extract($arr);
		$eca_id=database::sanitize($eca_id);
        $rollcall_id = database::sanitize($rollcall_id);
		$re=database::queryAndOne("SELECT `authority` FROM `eca_members` WHERE `user_sid`='{$_SESSION['user']['sidRaw']}' and `eca_id`='{$eca_id}'");
		if($re[0]<8){
			echo false;
			exit();
		}
        $re = database::queryAndArray("SELECT `user_sid` FROM `rollrecord` WHERE `rollcall_id`='{$rollcall_id}'");
		foreach($re as $val){
			$result[]=$val[0];
		}
		foreach($attendance as $sid=>$att){
			$sid=substr($sid,1,4);
			if($att){
				if(!in_array($sid,$result)){
					$re=database::query("INSERT INTO `rollrecord`(`rollcall_id`, `user_sid`) VALUES ('{$rollcall_id}','{$sid}')");
					if(!re){
						die(database::geterror());
					}
				}
			}else{
				if(in_array($sid,$result)){
					$re=database::query("DELETE FROM `rollrecord` WHERE `rollcall_id`='{$rollcall_id}' and `user_sid`='{$sid}'");
					if(!re){
						die(database::geterror());
					}
				}
			}
		}
        echo 1;
    }
	private function updateContact()
    {
        $this->checkLoginAndRedirect();
        $ecaId = database::sanitize($_POST["ecaId"]);
        $contact = database::sanitize($_POST["contact"]);
		$place = database::sanitize($_POST["place"]);
		$moment = database::sanitize($_POST["moment"]);
		$userid= $_SESSION["user"]["sidRaw"];
        $member = database::queryAndOne("SELECT user_sid, authority from eca_members where eca_id = '{$ecaId}' and `user_sid`='{$userid}'","assoc");
        $permit = false;
            if($member["authority"] > 6){
                $permit = true;
            }
        if(!$permit){
            var_dump($member);
            exit();
        }
		$result = database::queryAndOne("SELECT count(*) FROM `eca_info` WHERE `eca_id`='{$ecaId}'")[0];
		if($result>0){
			$result = database::query("UPDATE `eca_info` SET `eca_place`='{$place}',`eca_contact`='{$contact}',`eca_moment`='{$moment}' WHERE `eca_id`='{$ecaId}'");
		}else{
			$result = database::query("INSERT INTO `eca_info`(`eca_id`, `eca_place`, `eca_contact`, `eca_moment`) VALUES ('{$ecaId}','{$place}','{$contact}','{$moment}')");
		}
        echo $result;
    }
    private function updateDescription()
    {
        $this->checkLoginAndRedirect();
        $ecaId = database::sanitize($_POST["ecaId"]);
        $newDescription = database::sanitize(htmlentities($_POST["description"]));
		$userid=$_SESSION["user"]["sidRaw"];
        $member = database::queryAndOne("SELECT user_sid, authority from eca_members where eca_id = '{$ecaId}' and user_sid='{$userid}'","assoc");
        $permit = false;
            if($member["authority"] > 6){
                $permit = true;
            }
        if(!$permit){
            var_dump($member);
            exit();
        }
        $result = database::query("UPDATE `eca` SET eca_description = '{$newDescription}' where eca_id = '{$ecaId}'");
        echo $result;
    }
	
	private function changeRole()
    {
        $this->checkLoginAndRedirect();
        $ecaId = database::sanitize($_POST["ecaId"]);
        $role = database::sanitize($_POST["role"]);
		$authority = database::sanitize($_POST["authority"]);
		$userid = database::sanitize($_POST["userid"]);
		$result = database::query("UPDATE `eca_members` SET `role`='{$role}',`authority`='{$authority}' WHERE `eca_id`='{$ecaId}' and `user_sid`='{$userid}'");
        echo $result;
    }

    private function deleteEca(){
        $ecaId = database::sanitize($_POST["ecaId"]);
        $ecaExists = database::queryAndArray("SELECT COUNT(*) FROM eca where eca_id = '{$ecaId}'")[0][0];
        if(empty($ecaExists)){
            echo "Eca doesn't exists";
            exit;
        }
        else{
            $ecaOwnerSid = database::queryAndArray("SELECT eca_owner_sid from eca WHERE eca_id = '{$ecaId}'")[0][0];
            if($_SESSION["user"]["sidRaw"] != $ecaOwnerSid){
                echo "ECA owner sid doesn't match session";
            }
            $deletedEca = database::query("DELETE FROM eca WHERE eca_id = '{$ecaId}'");
            $deletedMembers = database::query("DELETE FROM eca_members WHERE eca_id = '{$ecaId}'");
			database::query("DELETE notices.*,noticetouser.* FROM notices INNER JOIN noticetouser on noticetouser.notice_id=notices.notice_id WHERE notices.eca_id = '{$ecaId}'");
			database::query("DELETE FROM `notices` WHERE `eca_id` = '{$ecaId}'");
            if($deletedEca && $deletedMembers){
                echo '1';
            }
            else{
                echo 'error while trying to delete';
            }
        }
    }
}