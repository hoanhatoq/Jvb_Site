<?php 
require_once(CORE_PATH."products/Product.class.php");

class products extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'Product';
		$this->tableName 		= 'product';
		$this->categoryField='catId';
		$this->categoryName=$category?$category:"products";
		$this->createBasicObject();		parent::__construct();

	}




	
	/**
	*Enter description here ...
	*@var Product
	**/
	var		$obj;
}
