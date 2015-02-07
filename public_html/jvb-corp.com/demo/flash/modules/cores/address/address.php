<?php
require_once(CORE_PATH."address/Addres.class.php");

class address extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
		global $bw,$vsPrint;
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'Addres';
		$this->tableName 		= 'addres';
		$this->categoryField='catId';
		$this->categoryName=$category?$category:"address";
		$this->createBasicObject();		parent::__construct();
		

	}




	
	/**
	*Enter description here ...
	*@var Addres
	**/
	var		$obj;
}
