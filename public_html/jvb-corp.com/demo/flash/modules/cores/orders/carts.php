<?php

class carts {
	static function setQuantity($key,$quantity){
		if(isset($_SESSION['vs_item_cart'][$key])){
			$_SESSION['vs_item_cart'][$key]['quantity']=$quantity;
			if($quantity===0) unset($_SESSION['vs_item_cart'][$key]['quantity']);
		}
	}
	/**
	 * @param Order_item $order_item
	 * Enter description here ...
	 */
	static function addItem($productId,$type="",$quantity=1,$cateSize=0){
		//unset($_SESSION['vs_item_cart']);exit();
		
		require_once CORE_PATH.'products/products.php';
		$products=new products();
		$products->getObjectById($productId);


		if(isset($_SESSION['vs_item_cart'][$productId])){
			$_SESSION['vs_item_cart'][$productId]['quantity']+=$quantity;
			return true;
		}

		//print_r($products);die;
	
		if(!$products->basicObject->getId()){
			carts::$message=VSFactory::getLangs()->getWords('product_not_found','Không tìm thấy sản phẩm');
			return false;
		}
		
		$order_items=new order_items();
		$order_items->basicObject->setProductId($products->basicObject->getId());
		$order_items->basicObject->setType($type);
		$order_items->basicObject->setTitle($products->basicObject->getTitle());
		$order_items->basicObject->setImage($products->basicObject->getImage());
		$order_items->basicObject->setQuantity($quantity);
		$order_items->basicObject->setPrice($products->basicObject->getPrice());

		if($products->basicObject->getPromotion()>0){
			$order_items->basicObject->setPrice($products->basicObject->getPromotion());
		}
		
		

		if($products->basicObject->sold>=$products->basicObject->limit_deal && $products->basicObject->getPrice_deal()>0){
			$order_items->basicObject->setPrice($products->basicObject->getPrice_deal());
		}
		
		
		
		$_SESSION['vs_item_cart'][$order_items->basicObject->getProductId()]=$order_items->basicObject->convertToDB();
		
		
	 	
	
		return true;
	}
	/**
	 * 
	 * Enter description here ...
	 * @param int
	 */
	static function resetCart(){
		$_SESSION['vs_item_cart']=array();
	}
	/**
	 * 
	 * Enter description here ...
	 * @param int
	 */
	static function removeItem($key){
		unset($_SESSION['vs_item_cart'][$key]);
	}
	static function update(){
		
	}
	/**
	 * 
	 * Enter description here ...
	 * @param Order $order
	 */
	static function insertToDB($order){
		global $vsStd,$bw;
		
		if(!$order->getId()){
			$orders=new orders();
			$orders->insertObject($order);
			$order=$orders->basicObject;
			
			
			
		$vsStd->requireFile ( LIBS_PATH . "Email.class.php", true );
		$email = new Emailer();
		$idorder=mysql_insert_id();
		
		$email_sender = VSFactory::getSettings ()->getSystemKey ( "email_orders", "nguyenbaotrung186@gmail.com", "configs" );
		$email->setTo($email_sender);
		$email->addBCC($order->getEmail());
		//$email->addBCC('hth.hoangkyanh@gmail.com');
		 
		//$email->addBCC('baotrung@vietsol.net');
		//$email->addBCC('name_nguyenbaotrung@yahoo.com');
		//$email->addBCC($order->getEmail());
		$email->setFrom('alert@vsmail.vn');
		$email->setSubject("memoryshop.vn: Đơn đặt hàng #{$idorder}");
		
		$body.="Khách hàng: ".$order->getTitle()."<br/>";
		$body.="Điện thoại: ".$order->getPhone()."<br/>";
		$body.="Địa chỉ: ".$order->getAddress()."<br/>";
		$body.="Email: ";
		$body.=$order->getEmail()."<br/>";
		$body.="Danh sách sản phẩm đặt hàng:<br/><br/>";
		$total=0;
		$body.="<table class='table_email' border=1  border='1' cellspacing='0' cellspacing='0' >";
		$body.="<tr style='padding:4px 8px'>
				<td style='padding:4px 8px' >Tên sản phẩm</td>
				<td style='padding:4px 8px' >Số lượng</td>
				<td style='padding:4px 8px' >Giá</td>
				<td style='padding:4px 8px' >Thành tiền</td>
			</tr>";
		foreach ($_SESSION['vs_item_cart'] as $index=> $value) {
			$price=number_format($value['price']);
			$price_t=number_format($value['quantity']*$value['price']);
			$tota=$value['quantity']*$value['price'];
			$total+=$tota;
			$body.="<tr style='padding:4px 8px' >
				<td style='padding:4px 8px' ><a href='{$bw->base_url}products/detail/{$index}'>{$value['title']}</a></td>
				<td style='padding:4px 8px' >{$value['quantity']}</td>
				<td style='padding:4px 8px' >{$price} VND</td>
				<td style='padding:4px 8px' >{$price_t} VND</td>
			</tr>";
			//$body.="<a href='{$bw->base_url}products/detail/{$index}'>{$value['title']}</a>  ------------Số lượng: {$value['quantity']}   ---------Giá:{$price} VND -------- Thành tiền:{$price_t} VND          "."<br/>";
		}
		$total_fm=number_format($total);
		$body.="<tr style='padding:4px 8px' >
				<td colspan='3' style='padding:4px 8px' >Tổng tiền</td>
				<td style='padding:4px 8px' >{$total_fm} VND</td>
			</tr>";
		
		$body.="</table>";
		
		
		$email->setBody($body);
		$email->sendMail();
			
		//$body.="Chi tiết: http://www.giamcankhoedep.com/admin.php?vs=orders#orders/orders/orders_add_edit_form/{$idorder}&&pageIndex= "."<br/>";

		$email->setBody($body);
		$email->sendMail();
			
			
		}

		$db=VSFactory::createConnectionDB();

		$order_items=new order_items();
		if(array($_SESSION['vs_item_cart'])){
			foreach ($_SESSION['vs_item_cart'] as $index=> $value) {
				$order_item=new Order_item();
				$order_item->convertToObject($value);
				$order_item->setOrderId($order->getId());
				//$order_item->setItemTitle($order->getTitle());
				$order_items->insertObject($order_item);

				$query="UPDATE vsf_product set `sold`=`sold`+{$value['quantity']} WHERE `id`={$index}";

				$db->query($query);
				
			}
		}
	}
	/**
	 * @return Order
	 * Enter description here ...
	 */
	static function getCartInfo(){
		$order=new Order();
		if(is_array($_SESSION['vs_item_cart'])){
			foreach ($_SESSION['vs_item_cart'] as $index=> $value) {
				$order->total+=$value['quantity']*$value['price'];
				$order->quantity+=$value['quantity'];
			}
		}
		return $order;
		
	}
	/**
	 * 
	 * Enter description here ...
	 * @var string
	 */
	static  $message;
}

?>