<?php 
require_once(CORE_PATH."raovats/Raovat.class.php");

class raovats extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'Raovat';
		$this->tableName 		= 'raovat';
		$this->categoryField='catId';
		$this->categoryName=$category?$category:"raovats";
		$this->createBasicObject();		parent::__construct();

	}




	
	/**
	*Enter description here ...
	*@var Raovat
	**/
	var		$obj;
}
