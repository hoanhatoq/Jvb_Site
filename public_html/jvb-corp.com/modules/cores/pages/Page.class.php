<?php
class Page extends BasicObject {

	public function convertToDB() {
		isset ( $this->id ) ? ($dbobj ['id'] = $this->id) : '';
		isset ( $this->catId ) ? ($dbobj ['catId'] = $this->catId) : '';
		isset ( $this->title ) ? ($dbobj ['title'] = $this->title) : '';
		isset ( $this->intro ) ? ($dbobj ['intro'] = $this->intro) : '';
		isset ( $this->image ) ? ($dbobj ['image'] = $this->image) : '';
		isset ( $this->content ) ? ($dbobj ['content'] = $this->content) : '';
		isset ( $this->postDate ) ? ($dbobj ['postDate'] = $this->postDate) : '';
		isset ( $this->status ) ? ($dbobj ['status'] = $this->status) : '';
		isset ( $this->index ) ? ($dbobj ['index'] = $this->index) : '';
		isset ( $this->code ) ? ($dbobj ['code'] = $this->code) : '';
		isset ( $this->module ) ? ($dbobj ['module'] = $this->module) : '';
		isset ( $this->mTitle ) ? ($dbobj ['mTitle'] = $this->mTitle) : '';
		isset ( $this->mKeyword ) ? ($dbobj ['mKeyword'] = $this->mKeyword) : '';
		isset ( $this->mIntro ) ? ($dbobj ['mIntro'] = $this->mIntro) : '';
		isset ( $this->mUrl ) ? ($dbobj ['mUrl'] = $this->mUrl) : '';
		isset ( $this->name ) ? ($dbobj ['name'] = $this->name) : '';
		isset ( $this->phone ) ? ($dbobj ['phone'] = $this->phone) : '';
		isset ( $this->email ) ? ($dbobj ['email'] = $this->email) : '';
		isset ( $this->address ) ? ($dbobj ['address'] = $this->address) : '';
		isset ( $this->hit ) ? ($dbobj ['hit'] = $this->hit) : '';
	
		
		
		return $dbobj;
	}

	public function convertToObject($object = array()) {
		isset ( $object ['id'] ) ? $this->setId ( $object ['id'] ) : '';
		isset ( $object ['catId'] ) ? $this->setCatId ( $object ['catId'] ) : '';
		isset ( $object ['title'] ) ? $this->setTitle ( $object ['title'] ) : '';
		isset ( $object ['intro'] ) ? $this->setIntro ( $object ['intro'] ) : '';
		isset ( $object ['image'] ) ? $this->setImage ( $object ['image'] ) : '';
		isset ( $object ['content'] ) ? $this->setContent ( $object ['content'] ) : '';
		isset ( $object ['postDate'] ) ? $this->setPostDate ( $object ['postDate'] ) : '';
		isset ( $object ['status'] ) ? $this->setStatus ( $object ['status'] ) : '';
		isset ( $object ['index'] ) ? $this->setIndex ( $object ['index'] ) : '';
		isset ( $object ['code'] ) ? $this->setCode ( $object ['code'] ) : '';
		isset ( $object ['module'] ) ? $this->setModule ( $object ['module'] ) : '';
		isset ( $object ['mTitle'] ) ? $this->setMTitle ( $object ['mTitle'] ) : '';
		isset ( $object ['mKeyword'] ) ? $this->setMKeyWord ( $object ['mKeyword'] ) : '';
		isset ( $object ['mIntro'] ) ? $this->getMIntro ( $object ['mIntro'] ) : '';
		isset ( $object ['mUrl'] ) ? $this->setMUrl ( $object ['mUrl'] ) : '';
		isset ( $object ['name'] ) ? $this->setName ( $object ['name'] ) : '';
		isset ( $object ['phone'] ) ? $this->setPhone ( $object ['phone'] ) : '';
		isset ( $object ['email'] ) ? $this->setEmail ( $object ['email'] ) : '';
		isset ( $object ['address'] ) ? $this->setAddress ( $object ['address'] ) : '';
		isset ( $object ['hit'] ) ? $this->setHit ( $object ['hit'] ) : '';
		
		
		
	}


	function getLinkEdit($module,$id) {
		global $bw;
		if(!$module || $id){
			echo "";
		}
		if(!isset($_SESSION['admin']['obj']['id']))
			return false;	
		//echo "<a href='".$bw->vars['board_url']."/"."admin.php?vs={$module}#{$module}/{$module}/{$module}_add_edit_form/{$id}'">."</a>";
		return "<a class='edit_admin' target='_blank' href='{$bw->vars['board_url']}/admin.php?vs={$module}#pages/{$module}/pages_add_edit_form/{$id}'>Edit content</a>";
	}	


	function getId() {
		return $this->id;
	}

	function getCatId() {
		return $this->catId;
	}

	function getTitle() {
		return $this->title;
	}

	function getIntro() {
		return $this->intro;
	}

	function getImage() {
		return $this->image;
	}

	function getContent() {
		return $this->content;
	}

	function getPostDate() {
		return $this->postDate;
	}

	function getIndex() {
		return $this->index;
	}

	function getCode() {
		return $this->code;
	}

	function getModule() {
		return $this->module;
	}

	function getHit() {
		return $this->hit;
	}

	function setIds($id) {
		$this->id = $id;
	}

	function setCatId($catId) {
		$this->catId = $catId;
	}

	function setTitle($title) {
		$this->title = $title;
	}

	function setIntro($intro) {
		$this->intro = $intro;
	}

	function setImage($image) {
		$this->image = $image;
	}

	function setContent($content) {
		$this->content = $content;
	}

	function setPostDate($postDate) {
		$this->postDate = $postDate;
	}

	function setStatus($status) {
		$this->status = $status;
	}

	function setIndex($index) {
		$this->index = $index;
	}

	function setCode($code) {
		$this->code = $code;
	}

	function setModule($module) {
		$this->module = $module;
	}

	function setHit($hit) {
		$this->hit = $hit;
	}
	var $id;
	var $catId;
	var $title;
	var $intro;
	var $image;
	var $content;
	var $postDate;
	var $status;
	var $index;
	var $code;
	var $module;
	
	var $name;
	var $phone;
	var $address;
	var $email;
	/**
	 * @return the $name
	 */
	/**
	 * @return the $provin
	 */

	/**
	 * @param field_type $dis
	 */
	
	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param field_type $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @return the $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @return the $timebegin
	
	

	/**
	 * @return the $dateend
	 */
	
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param field_type $phone
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * @param field_type $address
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * @param field_type $timebegin
	 */

	
}
