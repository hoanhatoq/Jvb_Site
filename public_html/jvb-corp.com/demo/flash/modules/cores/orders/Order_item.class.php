<?php 

class Order_item extends BasicObject {

	public	function convertToDB(){
			isset ( $this->Id ) ? ($dbobj ['Id'] = $this->Id) : '';
		isset ( $this->orderId ) ? ($dbobj ['orderId'] = $this->orderId) : '';
		isset ( $this->image ) ? ($dbobj ['image'] = $this->image) : '';
		isset ( $this->catIdSize ) ? ($dbobj ['catIdSize'] = $this->catIdSize) : '';
		isset ( $this->title ) ? ($dbobj ['title'] = $this->title) : '';
		isset ( $this->productId ) ? ($dbobj ['productId'] = $this->productId) : '';
		isset ( $this->quantity ) ? ($dbobj ['quantity'] = $this->quantity) : '';
		isset ( $this->price ) ? ($dbobj ['price'] = $this->price) : '';
		isset ( $this->saleOff ) ? ($dbobj ['saleOff'] = $this->saleOff) : '';
		isset ( $this->date ) ? ($dbobj ['date'] = $this->date) : '';
		isset ( $this->status ) ? ($dbobj ['status'] = $this->status) : '';
		isset ( $this->info ) ? ($dbobj ['info'] = $this->info) : '';
		isset ( $this->type ) ? ($dbobj ['type'] = $this->type) : '';
		return $dbobj;

	}

	
	public	function convertToObject($object = array()){
			isset ( $object ['Id'] ) ? $this->setId ( $object ['Id'] ) : '';
		isset ( $object ['orderId'] ) ? $this->setOrderId ( $object ['orderId'] ) : '';
		isset ( $object ['image'] ) ? $this->setImage ( $object ['image'] ) : '';
		isset ( $object ['catIdSize'] ) ? $this->setCatIdSize ( $object ['catIdSize'] ) : '';
		isset ( $object ['title'] ) ? $this->setTitle ( $object ['title'] ) : '';
		isset ( $object ['productId'] ) ? $this->setProductId ( $object ['productId'] ) : '';
		isset ( $object ['quantity'] ) ? $this->setQuantity ( $object ['quantity'] ) : '';
		isset ( $object ['price'] ) ? $this->setPrice ( $object ['price'] ) : '';
		isset ( $object ['saleOff'] ) ? $this->setSaleOff ( $object ['saleOff'] ) : '';
		isset ( $object ['date'] ) ? $this->setDate ( $object ['date'] ) : '';
		isset ( $object ['status'] ) ? $this->setStatus ( $object ['status'] ) : '';
		isset ( $object ['info'] ) ? $this->setInfo ( $object ['info'] ) : '';
		isset ( $object ['type'] ) ? $this->setType ( $object ['type'] ) : '';

	}





	function getId(){
		return $this->Id;
	}



	function getOrderId(){
		return $this->orderId;
	}



	function getImage(){
		return $this->image;
	}



	function getCatIdSize(){
		return $this->catIdSize;
	}



	function getTitle(){
		return $this->title;
	}



	function getProductId(){
		return $this->productId;
	}



	function getQuantity(){
		return $this->quantity;
	}



	function getPrice(){
		return $this->price;
	}



	function getSaleOff(){
		return $this->saleOff;
	}



	function getDate(){
		return $this->date;
	}



	function getStatus(){
		return $this->status;
	}



	function getInfo(){
		return $this->info;
	}



	function getType(){
		return $this->type;
	}



	function setId($Id){
		$this->Id=$Id;
	}




	function setOrderId($orderId){
		$this->orderId=$orderId;
	}




	function setImage($image){
		$this->image=$image;
	}




	function setCatIdSize($catIdSize){
		$this->catIdSize=$catIdSize;
	}




	function setTitle($title){
		$this->title=$title;
	}




	function setProductId($productId){
		$this->productId=$productId;
	}




	function setQuantity($quantity){
		$this->quantity=$quantity;
	}




	function setPrice($price){
		$this->price=$price;
	}




	function setSaleOff($saleOff){
		$this->saleOff=$saleOff;
	}




	function setDate($date){
		$this->date=$date;
	}




	function setStatus($status){
		$this->status=$status;
	}




	function setInfo($info){
		$this->info=$info;
	}




	function setType($type){
		$this->type=$type;
	}



		var		$Id;

		var		$orderId;

		var		$image;

		var		$catIdSize;

		var		$title;

		var		$productId;

		var		$quantity;

		var		$price;

		var		$saleOff;

		var		$date;

		var		$status;

		var		$info;

		var		$type;

	
	/**
	*List fields in table
	**/
	var		$fields=array('Id','orderId','image','catIdSize','title','productId','quantity','price','saleOff','date','status','info','type',);
}
