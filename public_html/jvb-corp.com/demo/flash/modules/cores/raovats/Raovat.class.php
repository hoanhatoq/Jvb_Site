<?php 

class Raovat extends BasicObject {

	public	function convertToDB(){
			isset ( $this->id ) ? ($dbobj ['id'] = $this->id) : '';
		isset ( $this->catId ) ? ($dbobj ['catId'] = $this->catId) : '';
		isset ( $this->title ) ? ($dbobj ['title'] = $this->title) : '';
		isset ( $this->image ) ? ($dbobj ['image'] = $this->image) : '';
		isset ( $this->price ) ? ($dbobj ['price'] = $this->price) : '';
		isset ( $this->content ) ? ($dbobj ['content'] = $this->content) : '';
		isset ( $this->postDate ) ? ($dbobj ['postDate'] = $this->postDate) : '';
		isset ( $this->status ) ? ($dbobj ['status'] = $this->status) : '';
		isset ( $this->index ) ? ($dbobj ['index'] = $this->index) : '';
		isset ( $this->name ) ? ($dbobj ['name'] = $this->name) : '';
		isset ( $this->phone ) ? ($dbobj ['phone'] = $this->phone) : '';
		isset ( $this->email ) ? ($dbobj ['email'] = $this->email) : '';
		isset ( $this->address ) ? ($dbobj ['address'] = $this->address) : '';
		isset ( $this->hit ) ? ($dbobj ['hit'] = $this->hit) : '';
		return $dbobj;

	}





	public	function convertToObject($object = array()){
			isset ( $object ['id'] ) ? $this->setId ( $object ['id'] ) : '';
		isset ( $object ['catId'] ) ? $this->setCatId ( $object ['catId'] ) : '';
		isset ( $object ['title'] ) ? $this->setTitle ( $object ['title'] ) : '';
		isset ( $object ['image'] ) ? $this->setImage ( $object ['image'] ) : '';
		isset ( $object ['price'] ) ? $this->setPrice ( $object ['price'] ) : '';
		isset ( $object ['content'] ) ? $this->setContent ( $object ['content'] ) : '';
		isset ( $object ['postDate'] ) ? $this->setPostDate ( $object ['postDate'] ) : '';
		isset ( $object ['status'] ) ? $this->setStatus ( $object ['status'] ) : '';
		isset ( $object ['index'] ) ? $this->setIndex ( $object ['index'] ) : '';
		isset ( $object ['name'] ) ? $this->setName ( $object ['name'] ) : '';
		isset ( $object ['phone'] ) ? $this->setPhone ( $object ['phone'] ) : '';
		isset ( $object ['email'] ) ? $this->setEmail ( $object ['email'] ) : '';
		isset ( $object ['address'] ) ? $this->setAddress ( $object ['address'] ) : '';
		isset ( $object ['hit'] ) ? $this->setHit ( $object ['hit'] ) : '';
	}





	function getId(){
		return $this->id;
	}

	function getHit(){
		return $this->hit;
	}

	function setHit($hit){
		$this->hit=$hit;
	}


	function getCatId(){
		return $this->catId;
	}



	function getTitle(){
		return $this->title;
	}



	function getImage(){
		return $this->image;
	}



	function getPrice(){
		return $this->price;
	}



	function getContent(){
		return $this->content;
	}



	function getPostDate(){
		return $this->postDate;
	}



	function getStatus(){
		return $this->status;
	}



	function getIndex(){
		return $this->index;
	}



	function getName(){
		return $this->name;
	}



	function getPhone(){
		return $this->phone;
	}



	function getEmail(){
		return $this->email;
	}



	function getAddress(){
		return $this->address;
	}



	function setId($id){
		$this->id=$id;
	}




	function setCatId($catId){
		$this->catId=$catId;
	}




	function setTitle($title){
		$this->title=$title;
	}




	function setImage($image){
		$this->image=$image;
	}




	function setPrice($price){
		$this->price=$price;
	}




	function setContent($content){
		$this->content=$content;
	}




	function setPostDate($postDate){
		$this->postDate=$postDate;
	}




	function setStatus($status){
		$this->status=$status;
	}




	function setIndex($index){
		$this->index=$index;
	}




	function setName($name){
		$this->name=$name;
	}




	function setPhone($phone){
		$this->phone=$phone;
	}




	function setEmail($email){
		$this->email=$email;
	}




	function setAddress($address){
		$this->address=$address;
	}



		var		$id;

		var		$catId;

		var		$title;

		var		$image;

		var		$price;

		var		$content;

		var		$postDate;

		var		$status;

		var		$index;

		var		$name;

		var		$phone;

		var		$email;

		var		$address;

		var		$hit;
	
	/**
	*List fields in table
	**/
	var		$fields=array('id','catId','title','image','price','content','postDate','status','index','name','phone','email','address',);
}
