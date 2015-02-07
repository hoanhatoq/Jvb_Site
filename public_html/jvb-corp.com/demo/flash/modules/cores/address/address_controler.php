<?php
require_once(CORE_PATH.'address/address.php');

class address_controler extends VSControl_admin {

		function __construct($modelName){
			global $vsTemplate,$bw,$vsPrint;//		$this->html=$vsTemplate->load_template("skin_address");
		parent::__construct($modelName,"skin_address","addres");
		$this->model->categoryName="address";
		

	}





	function getHtml(){
		return $this->html;
	}



	function getOutput(){
		return $this->output;
	}



	function setHtml($html){
		$this->html=$html;
	}




	function setOutput($output){
		$this->output=$output;
	}



	
	/**
	*Skins for addres ...
	*@var skin_address
	**/
	var		$html;

	
	/**
	*String code return to browser
	**/
	var		$output;
}
