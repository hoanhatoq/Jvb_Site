<?php
require_once(CORE_PATH.'orders/orders.php');

class orders_controler extends VSControl_admin {

		function __construct($modelName){
			global $vsTemplate,$bw;//		$this->html=$vsTemplate->load_template("skin_orders");
		parent::__construct($modelName,"skin_orders","order");
		$this->model->categoryName="orders";

	}
	function auto_run(){
			global $bw;
			switch($bw->input[1]){
				case $this->modelName.'_cancel_checked' :
					$this->checkShowAll(-1);
					break;
				default :
					return parent::auto_run();
					break;
					
			}
	}


function addEditObjForm($objId = 0, $option = array()) {
		global  $vsStd, $bw, $vsPrint;
		require_once CORE_PATH.'orders/order_items.php';
		$order_items=new order_items();
		$order_items->setCondition("orderId='$objId'");
		$option['order_items']=$order_items->getObjectsByCondition('getProductId');
		$option['total_d']=0;
		$option['total_u']=0;
		foreach ($option['order_items'] as $key => $value) {
			$value->total=$value->getQuantity()*$value->getPrice();
			if($value->getType()==1)
			$option['total_d']+=$value->total;
			if($value->getType()==2)
			$option['total_u']+=$value->total;
		}
		

             
		return parent::addEditObjForm($objId,$option);
	}
	
function onDeleteObjectById($id){
		require_once CORE_PATH.'orders/order_items.php';
		$order_items=new order_items();
		$order_items->setCondition("`orderId`='$id'");
		$order_items->deleteObjectByCondition();

	}
	function onDeleteObjectByCondition($condition){
		require_once CORE_PATH.'orders/order_items.php';
		$order_items=new order_items();
		$order_items->setCondition("`orderId` in (select `id` from vsf_order where $condition )");
		$order_items->deleteObjectByCondition();
	}	
	


	function getHtml(){
		return $this->html;
	}



	function getOutput(){
		return $this->output;
	}



	function setHtml($html){
		$this->html=$html;
	}




	function setOutput($output){
		$this->output=$output;
	}



	
	/**
	*Skins for order ...
	*@var skin_orders
	**/
	var		$html;

	
	/**
	*String code return to browser
	**/
	var		$output;
}
