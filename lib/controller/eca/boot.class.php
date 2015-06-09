<?php

class bootEcaController extends ecaController
{


    public function start()
    {
        $this->setModel('Model');
        $this->model->getDatabase();
		$result=database::queryAndArray("SELECT * FROM `eca` WHERE 1","ASSOC");
		$count=1;
		foreach($result as $eca){
			if($eca['eca_id']!=$count){
				$sql="UPDATE `eca` SET `eca_id`='{$count}' WHERE `eca_id`='{$eca['eca_id']}'";
				database::query($sql);
				$sql="UPDATE `eca_members` SET `eca_id`='{$count}' WHERE `eca_id`='{$eca['eca_id']}'";
				database::query($sql);
			}
			$count++;
		}
		$result=database::query("SELECT eca.*,eca_members.* FROM eca Inner Join eca_members on eca.eca_id=eca_members.eca_id WHERE 1");
		var_dump($result);
    }
}