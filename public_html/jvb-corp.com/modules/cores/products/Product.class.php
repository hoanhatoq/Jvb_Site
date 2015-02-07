<?php 

class Product extends BasicObject {

	public	function convertToDB(){
			isset ( $this->id ) ? ($dbobj ['id'] = $this->id) : '';
		isset ( $this->catId ) ? ($dbobj ['catId'] = $this->catId) : '';
		isset ( $this->label ) ? ($dbobj ['label'] = $this->label) : '';
		isset ( $this->title ) ? ($dbobj ['title'] = $this->title) : '';
		isset ( $this->intro ) ? ($dbobj ['intro'] = $this->intro) : '';
		isset ( $this->content ) ? ($dbobj ['content'] = $this->content) : '';
		isset ( $this->price ) ? ($dbobj ['price'] = $this->price) : '';
		isset ( $this->promotion ) ? ($dbobj ['promotion'] = $this->promotion) : '';
		isset ( $this->number_deal ) ? ($dbobj ['number_deal'] = $this->number_deal) : '';
		isset ( $this->limit_deal ) ? ($dbobj ['limit_deal'] = $this->limit_deal) : '';
		isset ( $this->shipping ) ? ($dbobj ['shipping'] = $this->shipping) : '';
		isset ( $this->manufacturer ) ? ($dbobj ['manufacturer'] = $this->manufacturer) : '';
		isset ( $this->postDate ) ? ($dbobj ['postDate'] = $this->postDate) : '';
		isset ( $this->deal ) ? ($dbobj ['deal'] = $this->deal) : '';
		isset ( $this->price_deal ) ? ($dbobj ['price_deal'] = $this->price_deal) : '';
		isset ( $this->dateStart ) ? ($dbobj ['dateStart'] = $this->dateStart) : '';
		isset ( $this->dateEnd ) ? ($dbobj ['dateEnd'] = $this->dateEnd) : '';
		isset ( $this->sold ) ? ($dbobj ['sold'] = $this->sold) : '';
		isset ( $this->detail ) ? ($dbobj ['detail'] = $this->detail) : '';
		isset ( $this->status ) ? ($dbobj ['status'] = $this->status) : '';
		isset ( $this->removedText ) ? ($dbobj ['removedText'] = $this->removedText) : '';
		isset ( $this->image ) ? ($dbobj ['image'] = $this->image) : '';
		isset ( $this->index ) ? ($dbobj ['index'] = $this->index) : '';
		isset ( $this->code ) ? ($dbobj ['code'] = $this->code) : '';
		isset ( $this->vote ) ? ($dbobj ['vote'] = $this->vote) : '';
		isset ( $this->type ) ? ($dbobj ['type'] = $this->type) : '';
		isset ( $this->style ) ? ($dbobj ['style'] = $this->style) : '';
		isset ( $this->group ) ? ($dbobj ['group'] = $this->group) : '';
		isset ( $this->brand ) ? ($dbobj ['brand'] = $this->brand) : '';
		isset ( $this->hot ) ? ($dbobj ['hot'] = $this->hot) : '';
		isset ( $this->size ) ? ($dbobj ['size'] = $this->size) : '';
		isset ( $this->mTitle ) ? ($dbobj ['mTitle'] = $this->mTitle) : '';
		isset ( $this->mIntro ) ? ($dbobj ['mIntro'] = $this->mIntro) : '';
		isset ( $this->mKeyword ) ? ($dbobj ['mKeyword'] = $this->mKeyword) : '';
		isset ( $this->mUrl ) ? ($dbobj ['mUrl'] = $this->mUrl) : '';
		isset ( $this->info ) ? ($dbobj ['info'] = $this->info) : '';
		return $dbobj;

	}





	public	function convertToObject($object = array()){
			isset ( $object ['id'] ) ? $this->setId ( $object ['id'] ) : '';
		isset ( $object ['catId'] ) ? $this->setCatId ( $object ['catId'] ) : '';
		isset ( $object ['label'] ) ? $this->setLabel ( $object ['label'] ) : '';
		isset ( $object ['title'] ) ? $this->setTitle ( $object ['title'] ) : '';
		isset ( $object ['intro'] ) ? $this->setIntro ( $object ['intro'] ) : '';
		isset ( $object ['content'] ) ? $this->setContent ( $object ['content'] ) : '';
		isset ( $object ['price'] ) ? $this->setPrice ( $object ['price'] ) : '';
		isset ( $object ['promotion'] ) ? $this->setPromotion ( $object ['promotion'] ) : '';
		isset ( $object ['number_deal'] ) ? $this->setNumber_deal ( $object ['number_deal'] ) : '';
		isset ( $object ['limit_deal'] ) ? $this->setLimit_deal ( $object ['limit_deal'] ) : '';
		isset ( $object ['shipping'] ) ? $this->setShipping ( $object ['shipping'] ) : '';
		isset ( $object ['manufacturer'] ) ? $this->setManufacturer ( $object ['manufacturer'] ) : '';
		isset ( $object ['postDate'] ) ? $this->setPostDate ( $object ['postDate'] ) : '';
		isset ( $object ['deal'] ) ? $this->setDeal ( $object ['deal'] ) : '';
		isset ( $object ['price_deal'] ) ? $this->setPrice_deal ( $object ['price_deal'] ) : '';
		isset ( $object ['dateStart'] ) ? $this->setDateStart ( $object ['dateStart'] ) : '';
		isset ( $object ['dateEnd'] ) ? $this->setDateEnd ( $object ['dateEnd'] ) : '';
		isset ( $object ['sold'] ) ? $this->setSold ( $object ['sold'] ) : '';
		isset ( $object ['detail'] ) ? $this->setDetail ( $object ['detail'] ) : '';
		isset ( $object ['status'] ) ? $this->setStatus ( $object ['status'] ) : '';
		isset ( $object ['removedText'] ) ? $this->setRemovedText ( $object ['removedText'] ) : '';
		isset ( $object ['image'] ) ? $this->setImage ( $object ['image'] ) : '';
		isset ( $object ['index'] ) ? $this->setIndex ( $object ['index'] ) : '';
		isset ( $object ['code'] ) ? $this->setCode ( $object ['code'] ) : '';
		isset ( $object ['vote'] ) ? $this->setVote ( $object ['vote'] ) : '';
		isset ( $object ['type'] ) ? $this->setType ( $object ['type'] ) : '';
		isset ( $object ['style'] ) ? $this->setStyle ( $object ['style'] ) : '';
		isset ( $object ['group'] ) ? $this->setGroup ( $object ['group'] ) : '';
		isset ( $object ['brand'] ) ? $this->setBrand ( $object ['brand'] ) : '';
		isset ( $object ['hot'] ) ? $this->setHot ( $object ['hot'] ) : '';
		isset ( $object ['size'] ) ? $this->setSize ( $object ['size'] ) : '';
		isset ( $object ['mTitle'] ) ? $this->setMTitle ( $object ['mTitle'] ) : '';
		isset ( $object ['mIntro'] ) ? $this->setMIntro ( $object ['mIntro'] ) : '';
		isset ( $object ['mKeyword'] ) ? $this->setMKeyword ( $object ['mKeyword'] ) : '';
		isset ( $object ['mUrl'] ) ? $this->setMUrl ( $object ['mUrl'] ) : '';
		isset ( $object ['info'] ) ? $this->setInfo ( $object ['info'] ) : '';

	}





	function getId(){
		return $this->id;
	}

	function getUrl(){
		global $bw;
		if(APPLICATION_TYPE=='user'){
			$catobj=VSFactory::getMenus()->getCategoryById($this->getCatId());
				return $bw->base_url . "{$catobj->getUrl()}/category/" .$catobj->getSlug()."/". $this->getMUrl(). '.html';
		}
		else{
			echo "chua build admin";
		}
	}



	function getCatId(){
		return $this->catId;
	}



	function getLabel(){
		return $this->label;
	}



	function getTitle(){
		return $this->title;
	}



	function getIntro(){
		return $this->intro;
	}



	function getContent(){
		return $this->content;
	}



	function getPrice(){
		return $this->price;
	}



	function getPromotion(){
		return $this->promotion;
	}



	function getNumber_deal(){
		return $this->number_deal;
	}



	function getLimit_deal(){
		return $this->limit_deal;
	}



	function getShipping(){
		return $this->shipping;
	}



	function getManufacturer(){
		return $this->manufacturer;
	}



	function getPostDate(){
		return $this->postDate;
	}



	function getDeal(){
		return $this->deal;
	}



	function getPrice_deal(){
		return $this->price_deal;
	}



	function getDateStart(){
		return $this->dateStart;
	}



	function getDateEnd(){
		return $this->dateEnd;
	}



	function getSold(){
		return $this->sold;
	}



	function getDetail(){
		return $this->detail;
	}



	function getStatus(){
		return $this->status;
	}



	function getRemovedText(){
		return $this->removedText;
	}



	function getImage(){
		return $this->image;
	}



	function getIndex(){
		return $this->index;
	}



	function getCode(){
		return $this->code;
	}



	function getVote(){
		return $this->vote;
	}



	function getType(){
		return $this->type;
	}



	function getStyle(){
		return $this->style;
	}



	function getGroup(){
		return $this->group;
	}



	function getBrand(){
		return $this->brand;
	}



	function getHot(){
		return $this->hot;
	}



	function getSize(){
		return $this->size;
	}



	function getMTitle(){
		return $this->mTitle;
	}



	function getMIntro(){
		return $this->mIntro;
	}



	function getMKeyword(){
		return $this->mKeyword;
	}



	function getMUrl(){
		return $this->mUrl;
	}



	function getInfo(){
		return $this->info;
	}



	function setId($id){
		$this->id=$id;
	}




	function setCatId($catId){
		$this->catId=$catId;
	}




	function setLabel($label){
		$this->label=$label;
	}




	function setTitle($title){
		$this->title=$title;
	}




	function setIntro($intro){
		$this->intro=$intro;
	}




	function setContent($content){
		$this->content=$content;
	}




	function setPrice($price){
		$this->price=$price;
	}




	function setPromotion($promotion){
		$this->promotion=$promotion;
	}




	function setNumber_deal($number_deal){
		$this->number_deal=$number_deal;
	}




	function setLimit_deal($limit_deal){
		$this->limit_deal=$limit_deal;
	}




	function setShipping($shipping){
		$this->shipping=$shipping;
	}




	function setManufacturer($manufacturer){
		$this->manufacturer=$manufacturer;
	}




	function setPostDate($postDate){
		$this->postDate=$postDate;
	}




	function setDeal($deal){
		$this->deal=$deal;
	}




	function setPrice_deal($price_deal){
		$this->price_deal=$price_deal;
	}




	function setDateStart($dateStart){
		$this->dateStart=$dateStart;
	}




	function setDateEnd($dateEnd){
		$this->dateEnd=$dateEnd;
	}




	function setSold($sold){
		$this->sold=$sold;
	}




	function setDetail($detail){
		$this->detail=$detail;
	}




	function setStatus($status){
		$this->status=$status;
	}




	function setRemovedText($removedText){
		$this->removedText=$removedText;
	}




	function setImage($image){
		$this->image=$image;
	}




	function setIndex($index){
		$this->index=$index;
	}




	function setCode($code){
		$this->code=$code;
	}




	function setVote($vote){
		$this->vote=$vote;
	}




	function setType($type){
		$this->type=$type;
	}




	function setStyle($style){
		$this->style=$style;
	}




	function setGroup($group){
		$this->group=$group;
	}




	function setBrand($brand){
		$this->brand=$brand;
	}




	function setHot($hot){
		$this->hot=$hot;
	}




	function setSize($size){
		$this->size=$size;
	}




	function setMTitle($mTitle){
		$this->mTitle=$mTitle;
	}




	function setMIntro($mIntro){
		$this->mIntro=$mIntro;
	}




	function setMKeyword($mKeyword){
		$this->mKeyword=$mKeyword;
	}




	function setMUrl($mUrl){
		$this->mUrl=$mUrl;
	}




	function setInfo($info){
		$this->info=$info;
	}



		var		$id;

		var		$catId;

		var		$label;

		var		$title;

		var		$intro;

		var		$content;

		var		$price;

		var		$promotion;

		var		$number_deal;

		var		$limit_deal;

		var		$shipping;

		var		$manufacturer;

		var		$postDate;

		var		$deal;

		var		$price_deal;

		var		$dateStart;

		var		$dateEnd;

		var		$sold;

		var		$detail;

		var		$status;

		var		$removedText;

		var		$image;

		var		$index;

		var		$code;

		var		$vote;

		var		$type;

		var		$style;

		var		$group;

		var		$brand;

		var		$hot;

		var		$size;

		var		$mTitle;

		var		$mIntro;

		var		$mKeyword;

		var		$mUrl;

		var		$info;

	
	/**
	*List fields in table
	**/
	var		$fields=array('id','catId','label','title','intro','content','price','promotion','number_deal','limit_deal','shipping','manufacturer','postDate','deal','price_deal','dateStart','dateEnd','sold','detail','status','removedText','image','index','code','vote','type','style','group','brand','hot','size','mTitle','mIntro','mKeyword','mUrl','info',);
}
