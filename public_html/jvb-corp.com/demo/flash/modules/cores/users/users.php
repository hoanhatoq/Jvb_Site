<?php 
require_once(CORE_PATH."users/User.class.php");

class users extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'User';
		$this->tableName 		= 'user';
		//$this->categoryField='catId';
		//$this->categoryName=$category?$category:"users";
		$this->createBasicObject();		parent::__construct();

	}

function updateSession($obj=null){
		if(!$obj){
			$obj=$this->basicObject;
		}

		//print_r($obj);die;

		$_SESSION['user']['obj']=$obj->convertToDB();
	}


	
	function getObjectByName($name){
		$name=strtolower($name);
		$this->setCondition("name='$name'");
		return $this->getOneObjectsByCondition();
	}


	
	/**
	*Enter description here ...
	*@var User
	**/
	var		$obj;
}
