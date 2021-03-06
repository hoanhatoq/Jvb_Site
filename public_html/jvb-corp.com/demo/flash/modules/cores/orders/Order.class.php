<?php 

class Order extends BasicObject {

	public	function convertToDB(){
			isset ( $this->id ) ? ($dbobj ['id'] = $this->id) : '';
		isset ( $this->title ) ? ($dbobj ['title'] = $this->title) : '';
		isset ( $this->intro ) ? ($dbobj ['intro'] = $this->intro) : '';
		isset ( $this->userId ) ? ($dbobj ['userId'] = $this->userId) : '';
		isset ( $this->address ) ? ($dbobj ['address'] = $this->address) : '';
		isset ( $this->email ) ? ($dbobj ['email'] = $this->email) : '';
		isset ( $this->info ) ? ($dbobj ['info'] = $this->info) : '';
		isset ( $this->postDate ) ? ($dbobj ['postDate'] = $this->postDate) : '';
		isset ( $this->phone ) ? ($dbobj ['phone'] = $this->phone) : '';
		isset ( $this->seri ) ? ($dbobj ['seri'] = $this->seri) : '';
		isset ( $this->total ) ? ($dbobj ['total'] = $this->total) : '';
		isset ( $this->quantity ) ? ($dbobj ['quantity'] = $this->quantity) : '';
		isset ( $this->userinfo ) ? ($dbobj ['userinfo'] = $this->userinfo) : '';
		isset ( $this->paymethod ) ? ($dbobj ['paymethod'] = $this->paymethod) : '';
		isset ( $this->status ) ? ($dbobj ['status'] = $this->status) : '';
		return $dbobj;

	}





	public	function convertToObject($object = array()){
			isset ( $object ['id'] ) ? $this->setId ( $object ['id'] ) : '';
		isset ( $object ['title'] ) ? $this->setTitle ( $object ['title'] ) : '';
		isset ( $object ['intro'] ) ? $this->setIntro ( $object ['intro'] ) : '';
		isset ( $object ['userId'] ) ? $this->setUserId ( $object ['userId'] ) : '';
		isset ( $object ['address'] ) ? $this->setAddress ( $object ['address'] ) : '';
		isset ( $object ['email'] ) ? $this->setEmail ( $object ['email'] ) : '';
		isset ( $object ['info'] ) ? $this->setInfo ( $object ['info'] ) : '';
		isset ( $object ['postDate'] ) ? $this->setPostDate ( $object ['postDate'] ) : '';
		isset ( $object ['phone'] ) ? $this->setPhone ( $object ['phone'] ) : '';
		isset ( $object ['seri'] ) ? $this->setSeri ( $object ['seri'] ) : '';
		isset ( $object ['total'] ) ? $this->setTotal ( $object ['total'] ) : '';
		isset ( $object ['quantity'] ) ? $this->setQuantity ( $object ['quantity'] ) : '';
		isset ( $object ['userinfo'] ) ? $this->setUserinfo ( $object ['userinfo'] ) : '';
		isset ( $object ['paymethod'] ) ? $this->setPaymethod ( $object ['paymethod'] ) : '';
		isset ( $object ['status'] ) ? $this->setStatus ( $object ['status'] ) : '';

	}





	function getId(){
		return $this->id;
	}



	function getTitle(){
		return $this->title;
	}



	function getIntro(){
		return $this->intro;
	}



	function getUserId(){
		return $this->userId;
	}



	function getAddress(){
		return $this->address;
	}



	function getEmail(){
		return $this->email;
	}



	function getInfo(){
		return $this->info;
	}



	function getPostDate(){
		return $this->postDate;
	}



	function getPhone(){
		return $this->phone;
	}



	function getSeri(){
		return $this->seri;
	}



	function getTotal(){
		return $this->total;
	}



	function getQuantity(){
		return $this->quantity;
	}



	function getUserinfo(){
		return $this->userinfo;
	}



	function getPaymethod(){
		return $this->paymethod;
	}



	function getStatus(){
		return $this->status;
	}



	function setId($id){
		$this->id=$id;
	}




	function setTitle($title){
		$this->title=$title;
	}




	function setIntro($intro){
		$this->intro=$intro;
	}




	function setUserId($userId){
		$this->userId=$userId;
	}




	function setAddress($address){
		$this->address=$address;
	}




	function setEmail($email){
		$this->email=$email;
	}




	function setInfo($info){
		$this->info=$info;
	}




	function setPostDate($postDate){
		$this->postDate=$postDate;
	}




	function setPhone($phone){
		$this->phone=$phone;
	}




	function setSeri($seri){
		$this->seri=$seri;
	}




	function setTotal($total){
		$this->total=$total;
	}




	function setQuantity($quantity){
		$this->quantity=$quantity;
	}




	function setUserinfo($userinfo){
		$this->userinfo=$userinfo;
	}




	function setPaymethod($paymethod){
		$this->paymethod=$paymethod;
	}




	function setStatus($status){
		$this->status=$status;
	}



		var		$id;

		var		$title;

		var		$intro;

		var		$userId;

		var		$address;

		var		$email;

		var		$info;

		var		$postDate;

		var		$phone;

		var		$seri;

		var		$total;

		var		$quantity;

		var		$userinfo;

		var		$paymethod;

		var		$status;
}
