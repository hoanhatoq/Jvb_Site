<?php
require_once(CORE_PATH.'orders/orders.php');
require_once(CORE_PATH.'orders/order_items.php');
require_once(CORE_PATH.'orders/carts.php');

class orders_controler_public extends VSControl_public {
	function __construct($modelName){
		global $vsTemplate,$bw;
//		$this->html=$vsTemplate->load_template("skin_product");
		parent::__construct($modelName,"skin_orders","order",$bw->input[0]);
		//$this->model->categoryName=$bw->input[0];
	}
	public	function auto_run(){
	
	global $bw;
				switch ($bw->input['action']) {
			case $this->modelName.'_addcart':
				$this->addToCart($bw->input[2],$bw->input[3]);
				break;
			case $this->modelName.'_review':
				$this->reviewCart();
				break;
			case $this->modelName.'_delete_item':
				$this->deleteItem();
				break;
			case $this->modelName.'_delete':
				$this->deleteCart();
				break;
			case $this->modelName.'_update':
				$this->updateCart();
				break;
			case $this->modelName.'_payment':
				$this->payment();
				break;
			case $this->modelName.'_payment_finish':
				$this->paymentFinish();
				break;
			default:
				parent::auto_run();
				break;
		}

	}

	function showDefault($option=array()){
		require_once CORE_PATH.'pages/pages.php';
//		$pages=new pages();
//		$category=VSFactory::getMenus()->getCategoryGroup('account_bank');
//		$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
//
//		$pages->setCondition("status>0 and catId in ($ids)");
//		$option['account_bank']=$pages->getOneObjectsByCondition();  
		return $this->reviewCart($option);
	}
	function reviewCart($option=array()){

		//print_r($_SESSION);die;
		$option['breakcrum']=$this->createBreakCrum(null);
		return $this->output=$this->html->reviewCart($option);
	}
	function deleteItem(){
		global $bw;
		
		if($bw->input['idproduct']){
		unset($_SESSION['vs_item_cart'][$bw->input['idproduct']]);	
			$total = 0;
			foreach ($_SESSION['vs_item_cart'] as $index =>$item){							
				$total = $total+($item['price']*$item['quantity']);
			}
		}
		
		$value['status']=1;
		$value['total']=number_format($total);
			
		echo json_encode($value);
		exit();
		
		/*if(is_array($bw->input['checkedcart']))
		foreach ($bw->input['checkedcart'] as $index=> $value) {
			carts::removeItem($index);
		}*/
		
		return $this->reviewCart($option);
	}
	function deleteCart(){
		global $bw;
		$option['breakcrum']=$this->createBreakCrum(null);
		carts::resetCart();
		return $this->reviewCart($option);
		
//		return $this->output=$this->html->deleteCart($option);
	}
	function updateCart(){
		global $bw;
		
		if($bw->input['change']==1){
			$id_old=$_SESSION['vs_item_cart'][$bw->input['id_product']]['catIdSize'];
			$_SESSION['vs_item_cart'][$bw->input['id_product']]['catIdSize']=$id_old.",".$bw->input['id_size'];	
			/*echo "<pre>";
			print_r($_SESSION['vs_item_cart'][$bw->input['id_product']]['catIdSize']);
			echo "</pre>";
			exit();*/
			
			exit();
		}
		
		
		$option['breakcrum']=$this->createBreakCrum(null);
		if(is_array($bw->input['cart']))
		foreach ($bw->input['cart'] as $index=> $value) {
			carts::setQuantity($index, $value['quantity']);
		}
		return $this->reviewCart($option);
	}
	function payment(){
//		require_once CORE_PATH.'pages/pages.php';
//		$pages=new pages();
//		$category=VSFactory::getMenus()->getCategoryGroup('account_bank');
//		$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
//
//		$pages->setCondition("status>0 and catId in ($ids)");
//		$option['account_bank']=$pages->getOneObjectsByCondition(); 
//		$option['breakcrum']=$this->createBreakCrum(null);
		return $this->output=$this->html->payment($option);
	}
	function paymentFinish(){
		global $bw,$vsStd;
		require_once ROOT_PATH.'vscaptcha/VsCaptcha.php';
		$vscaptcha=new VsCaptcha();
		if($vscaptcha->check($bw->input['security'])){
	
		
		//$this->model->basicObject->setTitle($_SESSION['vs_item_cart']['title']);
		$this->model->basicObject->setTitle($bw->input['orders']['name']);
		$this->model->basicObject->convertToObject($bw->input['orders']);
		$this->model->basicObject->setPostDate(time());
		
		carts::insertToDB($this->model->basicObject);
		$option['cart'] = $_SESSION['vs_item_cart'];
		
		carts::resetCart();
		
		}else{
			
			$option['message']=VSFactory::getLangs()->getWords('captcha_not_match','Mã bảo mật không đúng');
			return $this->output=$this->html->reviewCart($option);
		}
		
		$option['breakcrum']=$this->createBreakCrum(null);
		
		
		return $this->output=$this->html->paymentFinish($option);
	}	
	
	
	function addToCart($productId,$type=""){
		global $bw,$vsPrint,$vsTemplate;
		
		$productId=$bw->input['id'];
		

		require_once CORE_PATH.'products/products.php';
		$products=new products();
		$products->getObjectById($productId);

		
		$type=$bw->input['type'];
		intval($bw->input['quantity'])?$bw->input['quantity']=intval($bw->input['quantity']):$bw->input['quantity']=1;
	
		if(!carts::addItem($productId,$type,$bw->input['quantity'],$bw->input['cate_size'])){
			$result['status']=0;
			$result['message']=carts::$message;			
		}else{
			$result['status']=1;
			//$result['message']=VSFactory::getLangs()->getWords('order_item_added','Sản phẩm vừa được thêm vào giỏ hàng');
		}
		if($bw->input['json']){
			$result=array_merge($result,carts::getCartInfo()->convertToDB());
			$result['num_cart']=count($_SESSION['vs_item_cart']);
			
			echo json_encode($result);exit();
			//$vsPrint->_finish();
		}

		echo $result['status'];die;

		
		$option['load_cart']=$result;
		$option['msg']=1;
		
		$vsPrint->boink_it($bw->base_url."orders");
	
		return $this->output=$this->html->showDeaultCart($option);
		
		//return $this->output=$result['message'];
	}
	function getHtml(){
		return $this->html;
	}



	function setHtml($html){
		$this->html=$html;
	}



	
	/**
	*
	*@var orders
	**/
	var		$model;

	
	/**
	*
	*@var skin_orders
	**/
	var		$html;
}
