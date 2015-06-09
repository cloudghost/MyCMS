<?php

class callingView extends View
{
	public $code;
	public $id;
    public function showPage($get,$id="")
    {
		$this->code=$get;
		$this->id=$id;
        require_once "lib/template/QRcode.php";
    }
}