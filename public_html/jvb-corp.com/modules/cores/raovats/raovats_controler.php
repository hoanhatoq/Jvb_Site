<?php
require_once(CORE_PATH.'raovats/raovats.php');

class raovats_controler extends VSControl_admin {

		function __construct($modelName){
			global $vsTemplate,$bw;//		$this->html=$vsTemplate->load_template("skin_raovats");
		parent::__construct($modelName,"skin_raovats","raovat");
		$this->model->categoryName="raovats";

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
	*Skins for raovat ...
	*@var skin_raovats
	**/
	var		$html;

	
	/**
	*String code return to browser
	**/
	var		$output;
}
