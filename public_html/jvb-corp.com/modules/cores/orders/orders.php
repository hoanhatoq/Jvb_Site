<?php 
require_once(CORE_PATH."orders/Order.class.php");

class orders extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'Order';
		$this->tableName 		= 'order';
		//$this->categoryField='catId';
		//$this->categoryName=$category?$category:"orders";
		$this->createBasicObject();		parent::__construct();

	}




	
	/**
	*Enter description here ...
	*@var Order
	**/
	var		$obj;
}
