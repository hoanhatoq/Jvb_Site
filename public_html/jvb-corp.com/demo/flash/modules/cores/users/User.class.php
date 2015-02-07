<?php 

class User extends BasicObject {

	public	function convertToDB(){
			isset ( $this->id ) ? ($dbobj ['id'] = $this->id) : '';
		isset ( $this->name ) ? ($dbobj ['name'] = $this->name) : '';
		isset ( $this->password ) ? ($dbobj ['password'] = $this->password) : '';
		isset ( $this->email ) ? ($dbobj ['email'] = $this->email) : '';
		isset ( $this->postDate ) ? ($dbobj ['postDate'] = $this->postDate) : '';
		isset ( $this->status ) ? ($dbobj ['status'] = $this->status) : '';
		isset ( $this->image ) ? ($dbobj ['image'] = $this->image) : '';
		isset ( $this->homePage ) ? ($dbobj ['homePage'] = $this->homePage) : '';
		isset ( $this->title ) ? ($dbobj ['title'] = $this->title) : '';
		isset ( $this->phone ) ? ($dbobj ['phone'] = $this->phone) : '';
		isset ( $this->mobile ) ? ($dbobj ['mobile'] = $this->mobile) : '';
		isset ( $this->company ) ? ($dbobj ['company'] = $this->company) : '';
		isset ( $this->sex ) ? ($dbobj ['sex'] = $this->sex) : '';
		isset ( $this->address ) ? ($dbobj ['address'] = $this->address) : '';
		isset ( $this->question ) ? ($dbobj ['question'] = $this->question) : '';
		isset ( $this->anser ) ? ($dbobj ['anser'] = $this->anser) : '';
		isset ( $this->skype ) ? ($dbobj ['skype'] = $this->skype) : '';
		isset ( $this->yahoo ) ? ($dbobj ['yahoo'] = $this->yahoo) : '';
		isset ( $this->country ) ? ($dbobj ['country'] = $this->country) : '';
		isset ( $this->intro ) ? ($dbobj ['intro'] = $this->intro) : '';
		isset ( $this->token ) ? ($dbobj ['token'] = $this->token) : '';
		return $dbobj;

	}





	public	function convertToObject($object = array()){
			isset ( $object ['id'] ) ? $this->setId ( $object ['id'] ) : '';
		isset ( $object ['name'] ) ? $this->setName ( $object ['name'] ) : '';
		isset ( $object ['password'] ) ? $this->setPassword ( $object ['password'] ) : '';
		isset ( $object ['email'] ) ? $this->setEmail ( $object ['email'] ) : '';
		isset ( $object ['postDate'] ) ? $this->setPostDate ( $object ['postDate'] ) : '';
		isset ( $object ['status'] ) ? $this->setStatus ( $object ['status'] ) : '';
		isset ( $object ['image'] ) ? $this->setImage ( $object ['image'] ) : '';
		isset ( $object ['homePage'] ) ? $this->setHomePage ( $object ['homePage'] ) : '';
		isset ( $object ['title'] ) ? $this->setTitle ( $object ['title'] ) : '';
		isset ( $object ['phone'] ) ? $this->setPhone ( $object ['phone'] ) : '';
		isset ( $object ['mobile'] ) ? $this->setMobile ( $object ['mobile'] ) : '';
		isset ( $object ['company'] ) ? $this->setCompany ( $object ['company'] ) : '';
		isset ( $object ['sex'] ) ? $this->setSex ( $object ['sex'] ) : '';
		isset ( $object ['address'] ) ? $this->setAddress ( $object ['address'] ) : '';
		isset ( $object ['question'] ) ? $this->setQuestion ( $object ['question'] ) : '';
		isset ( $object ['anser'] ) ? $this->setAnser ( $object ['anser'] ) : '';
		isset ( $object ['skype'] ) ? $this->setSkype ( $object ['skype'] ) : '';
		isset ( $object ['yahoo'] ) ? $this->setYahoo ( $object ['yahoo'] ) : '';
		isset ( $object ['country'] ) ? $this->setCountry ( $object ['country'] ) : '';
		isset ( $object ['intro'] ) ? $this->setIntro ( $object ['intro'] ) : '';
		isset ( $object ['token'] ) ? $this->setToken ( $object ['token'] ) : '';

	}





	function getId(){
		return $this->id;
	}



	function getName(){
		return $this->name;
	}



	function getPassword(){
		return $this->password;
	}



	function getEmail(){
		return $this->email;
	}



	function getPostDate(){
		return $this->postDate;
	}



	function getStatus(){
		return $this->status;
	}



	function getImage(){
		return $this->image;
	}



	function getHomePage(){
		return $this->homePage;
	}



	function getTitle(){
		return $this->title;
	}



	function getPhone(){
		return $this->phone;
	}



	function getMobile(){
		return $this->mobile;
	}



	function getCompany(){
		return $this->company;
	}



	function getSex(){
		return $this->sex;
	}



	function getAddress(){
		return $this->address;
	}



	function getQuestion(){
		return $this->question;
	}



	function getAnser(){
		return $this->anser;
	}



	function getSkype(){
		return $this->skype;
	}



	function getYahoo(){
		return $this->yahoo;
	}



	function getCountry(){
		return $this->country;
	}



	function getIntro(){
		return $this->intro;
	}



	function setId($id){
		$this->id=$id;
	}




	function setName($name){
		$this->name=$name;
	}




	function setPassword($password){
		$this->password=$password;
	}




	function setEmail($email){
		$this->email=$email;
	}




	function setPostDate($postDate){
		$this->postDate=$postDate;
	}




	function setStatus($status){
		$this->status=$status;
	}




	function setImage($image){
		$this->image=$image;
	}




	function setHomePage($homePage){
		$this->homePage=$homePage;
	}




	function setTitle($title){
		$this->title=$title;
	}




	function setPhone($phone){
		$this->phone=$phone;
	}




	function setMobile($mobile){
		$this->mobile=$mobile;
	}




	function setCompany($company){
		$this->company=$company;
	}




	function setSex($sex){
		$this->sex=$sex;
	}




	function setAddress($address){
		$this->address=$address;
	}




	function setQuestion($question){
		$this->question=$question;
	}




	function setAnser($anser){
		$this->anser=$anser;
	}




	function setSkype($skype){
		$this->skype=$skype;
	}




	function setYahoo($yahoo){
		$this->yahoo=$yahoo;
	}




	function setCountry($country){
		$this->country=$country;
	}


	function setToken($token){
		$this->token=$token;
	}


	function getToken(){
		return $this->token;
	}


	function setIntro($intro){
		$this->intro=$intro;
	}



		var		$id;

		var		$token;

		var		$name;

		var		$password;

		var		$email;

		var		$postDate;

		var		$status;

		var		$image;

		var		$homePage;

		var		$title;

		var		$phone;

		var		$mobile;

		var		$company;

		var		$sex;

		var		$address;

		var		$question;

		var		$anser;

		var		$skype;

		var		$yahoo;

		var		$country;

		var		$intro;

	
	/**
	*List fields in table
	**/
	var		$fields=array('id','name','password','email','postDate','status','image','homePage','title','phone','mobile','company','sex','address','question','anser','skype','yahoo','country','intro',);
}
