<?php

class skin_orders extends skin_objectpublic {
function reviewCart($option = array()) {
		global $bw;
		$this->total=0;
       
		require_once(CORE_PATH."products/Product.class.php");
		$pp = new Product();
		$this->pp = $pp;
		$this->menu=VSFactory::getMenus();
		
		$BWHTML .= <<<EOF
	
		
		
		<div class="primary">
        <div class="breakcrum">
            {$option['breakcrum']}
              <p class="clear"></p>
        </div>
      </div><!--end primary-->  
      <div class="clear"></div>
      
        <div class="main_content_full">
			<div class="giohang_form">
				<form action="{$bw->base_url}orders/update" method="post" name="addEditForm" id="addEditForm">
					<table class="giohang" border="0" style="width: 100%;" cellspacing="0" rowspacing="0" >
						<tbody>
							<tr class="textwhile">
								<th class="giohang_col2" style="width:550px">Sản phẩm</th>
								<th class="giohang_col3">Đơn giá</th>
								<th class="giohang_col4">Số lượng</th>
								<th class="giohang_col5">Thành tiền</th>
							</tr>
								<foreach="$_SESSION['vs_item_cart'] as $index =>$item">
							
							<php>
								$this->tota = 0;
								$this->tota = $item['price']*$item['quantity'];	
								$this->total+= $this->tota;
							</php>
						
						<tr>
							<td style="text-align:left; padding-left:15px;"  class="giohang_colsp">{$this->pp->createImageCache($item['image'],60,60)} 
							<a class="title_item_or" target="_blank" href="{$bw->base_url}products/detail/{$index}">
							{$item['title']} 
							</a>
							<div class="delete_cart"><a onclick="deleteCart(this,{$index})" >Bỏ sản phẩm này</a></div></td>
							
							<td class="giohang_col3">{$this->numberFormat($item['price'])}  VND</td>
							<td class="giohang_col4" ><input style="text-align:center;" value="{$item['quantity']}" name="cart[$index][quantity]"></td>
							<td class="giohang_col5">{$this->numberFormat($this->tota)} VND</td>
						</tr>
						</foreach>
						<tr>
							<td style="padding-right:20px;" colspan="5"><div class="total">Tổng cộng: <span><span class="total_item">
							
							{$this->numberFormat($this->total,0)}</span>  {$this->getLang()->getWords('currency_d','VND')} <br /> 
							<br/>
							<input type="button" onclick="location.href='{$bw->base_url}products'" id="btn_back_cart" value="Tiếp tục mua hàng" class="btn"/>
							<input type="button" id="btn_update_cart" value="Cập nhật" class="btn"/></td>
						</tr>
						
						</tbody>
						
					</table>
					<div class="clear"></div>
				</form>
				
				
				<if="$_SESSION['vs_item_cart']">
					<div class="thongtinkh">
							<form id="payment-info" action="{$bw->base_url}orders/payment_finish" method="post" class="form_info">
								<h3>Thông tin đặt hàng</h3>
								<label>Họ và tên:</label><input value="{$bw->input['orders']['title']}" id="order_title" class="title_text" id="title" name="orders[title]">
								<div class="clear"></div>
								<label>{$this->getLang()->getWords('order_form_phone','Điện thoại')}:</label><input value="{$bw->input['orders']['phone']}" id="order_phone" class="phone_text"  "id="orderPhone" name="orders[phone]">
								<div class="clear"></div>
								<label>{$this->getLang()->getWords('order_form_email','Email')}:</label><input value="{$bw->input['orders']['email']}" id="order_email" class="mail_text"   id="orderEmail" name="orders[email]">
								<div class="clear"></div>
								<label>{$this->getLang()->getWords('order_form_address','Địa chỉ')}:</label><input value="{$bw->input['orders']['address']}" id="order_address" class="address_text"  name="orders[address]">
								<div class="clear"></div>
								<label>Ghi chú:</label>
								<textarea name="orders[intro]" ></textarea>
								<div class="clear"></div>
								<label>{$this->getLang()->getWords('captcha')}:</label><input  name="security"  type="text" class="input_sec_code" />
								<img id="siimage" src="{$bw->base_url}vscaptcha/" />
				               	<a href="#" id="reload_img" class="mamoi mamoi2">{$this->getLang()->getWords('refresh_captcha')}</a>
				               	<if="$option['message']">
									<h2>{$option['message']}</h2>
								</if>
				               	
				                <div class="clear"></div>
								<input id="btn_payment" type="submit" value="Đặt hàng" class="btn" >
								<input id="btn_cancel" type="button" value="Hủy bỏ" class="btn">
								<div class="clear"></div>
							</form>
						</div>
					</if>	
				
				</div>
			</div>
		
		
		
		
		
		<script>
		
			
			$("#reload_img").click(function(){
		        $("#siimage").attr("src",$("#siimage").attr("src")+"?a");
		        return false;
		    });
			
		
			$(document).ready(function(){
				$('.id_size_change').change(function() {
					var id_size=$(this).find(':selected').val();
					var id_product=$(this).find(':selected').attr('ref');
					$.ajax({
						type:'POST',
						dataType:'json',
						url: baseUrl+'orders/update',
						data:'ajax=1&json=1&id_product='+id_product+'&id_size='+id_size+'&change=1',
						success: function(data) {
							
						}
					});
				});

				
			});
			
				
			function deleteCart(obj,idproduct){
				$(obj).parent().parent().parent().remove();	
				$.ajax({
					type:'POST',
					dataType:'json',
					url: baseUrl+'orders/delete_item',
					data:'ajax=1&json=1&idproduct='+idproduct+'',
					success: function(data) {
						if(data.status==1){
							$('div.total').find('.total_item').text(data.total);
						}
						if(data.total==0)
						{
							//$('.thongtinkh').remove();
						}
					}
				}); 	
			}
	
			
				<if="!$_SESSION['vs_item_cart']">
				  $('#btn_delete_item').css({display:"none"});
				  $('#btn_delete_cart').css({display:"none"});
				  $('#btn_update_cart').css({display:"none"});
				  $('#btn_payment_cart').css({display:"none"});
				</if>
                $("#btn_delete_item").click(function(){
					var value = getCheck();
					if(value){
					$("#addEditForm").attr("action","{$bw->base_url}orders/delete_item").submit();
					}
				});
				$("#btn_update_cart").click(function(){
					$("#addEditForm").attr("action","{$bw->base_url}orders/update").submit();
				});
				$("#btn_delete_cart").click(function(){
					$("#addEditForm").attr("action","{$bw->base_url}orders/delete").submit();
				});
				$("#btn_payment_cart").click(function(){
					$("#addEditForm").attr("action","{$bw->base_url}orders/payment").submit();
				});
				
				 function checkall(obj){
                    $(".selectitem").each(function(){
                        $(this).attr('checked',$(obj).attr('checked'));
                    });

                }

                function getCheck() {
                    var checkedString = '';
                    $("input.selectitem").each(function(){
                        if(this.checked) checkedString += $(this).val()+',';
                    });
                    
                    checkedString = checkedString.substr(0,checkedString.lastIndexOf(','));
                    if(checkedString =='') {
                        alert("{$this->getLang()->getWords('delete_obj_confirm_noitem', "Bạn chưa chọn sản phẩm !")}");
                        return false;
                    }
                    return checkedString;
                }
				
                
          </script> 
	


		<script>
			function checkTrue(id,lang){
		     var address = $("#"+id).val();
		                       
		        if(!$('#'+id).val()){
		        	//$('#'+id).addClass('warning');
		           $('#'+id).after('<div class="warnings warning_'+id+'">'+lang+'</div>');
		           $(".warning_"+id).slideDown('slow').delay(12000).slideUp('slow');
		            
		            //$('.warning').css({'background':'#f2bcbc','border':'1px solid #f72e2e'});
		            $('.warning').delay(1000).removeClass('warning');
		            $("#"+id).focus();
		            check = 1;

		          /*setTimeout(function(){
					$("#"+id).removeAttr('style');
					},8000); */ 
		        }                
			}  
			function checkMail(id,lang){
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if(!$('#'+id).val() || !filter.test($('#'+id).val())) {
	
					 $('#'+id).after('<div class="warnings warning_'+id+'">'+lang+'</div>');
			            $(".warning_"+id).slideDown('slow').delay(12000).slideUp('slow');
			            
			            //$('.warning').css({'background':'#f2bcbc','border':'1px solid #f72e2e'});
			            $('.warning').delay(1000).removeClass('warning');
			            $("#"+id).focus();
			            check = 1;
				}
			}
		
		
		$(document).ready(function(){		
			$('#btn_payment').click(function(){
				check = 0;
				$('.warnings').remove(); 				
				checkTrue('order_title','{$this->getLang()->getWords('err_contact_name','Vui lòng nhập tên !')}');
				checkTrue('order_phone','{$this->getLang()->getWords('err_contact_phone','Vui lòng nhập số điện thoại !')}');
				//checkTrue('order_address','{$this->getLang()->getWords('err_contact_address','Vui lòng nhập số Địa chỉ!')}');
				//checkMail('order_email','{$this->getLang()->getWords('err_contact_email','Vui lòng kiểm tra lại địa chỉ Email !')}');
				//checkTrue('title','{$this->getLang()->getWords('err_contact_title','Vui lòng nhập tiêu đề !')}');
				if(check)return false;;
			});
     	});	
			
			
		</script>
		
		
		
		
		
		

		
		
EOF;
	}
	function paymentFinish($option = array()) {
		global $bw;
		
		
		
		$BWHTML .= <<<EOF
				

<div id="main-content">
	<div class="container">
		<div id="featured-js">
		
			<div class="product-js">
				<h4 style="padding:30px 10px;">{$this->getLang()->getWords('payment_finish','Cảm ơn quý khách đã đặt hàng! Chúng tôi sẽ kiểm tra đơn hàng và liên hệ với quý khách trong thời gian sớm nhất!')}</h4>	
			</div>

		</div>
					
	</div>
</div>					
				

				
				
				
		 <script>
			

                        
                        setTimeout('relead()',8000);
                        function relead(){
                                document.location.href = "{$bw->base_url}";
                        }
                        
</script>		
				
				
	
		
		
		
		
		<script>  
		
		$(document).ready(function(){
		
          
            jConfirm('Bạn đã đặt hàng thành công !', 'Thông báo', function(r) {
						   
			    if(r==true){
			    	document.location.href = "{$bw->base_url}";
			    }else{
			    	document.location.href = "{$bw->base_url}";
			    }
						    
			});                    
           
        });  
           
            </script>
		
		
		
		
		
		
		
		
		
		
EOF;
	}
	function payment($option = array()) {
		global $bw;
		

		$BWHTML .= <<<EOF
		
		<div class="Content">
<div class="Content_banner"> 
	<div id="navigator" class="link_nav"> {$option['breakcrum']} </div>
</div>
<!-- STOP Content_banner -->
<div class="Content_main">
	<div id="content">
		<div class="thongtinkh">
			<form id="payment-info" action="{$bw->base_url}orders/payment_finish" method="post" class="form_info">
				<h3>Thông tin đặt hàng</h3>
				<label>{$this->getLang()->getWords('order_form_title','Tiêu đề')}:</label><input class="title_text" id="title" name="orders[title]">
				<div class="clear"></div>
				<label>{$this->getLang()->getWords('order_form_email','Email')}:</label><input class="mail_text"   id="orderEmail" name="orders[email]">
				<div class="clear"></div>
				<label>{$this->getLang()->getWords('order_form_phone','Điện thoại')}:</label><input class="phone_text"  "id="orderPhone" name="orders[phone]">
				<div class="clear"></div>
				<label>{$this->getLang()->getWords('order_form_address','Địa chỉ')}:</label><input class="address_text"  name="orders[address]">
				<div class="clear"></div>
				<label>Ghi chú:</label>
				<textarea name="orders[intro]" ></textarea>
				<div class="clear"></div>
				<label>{$this->getLang()->getWords('captcha')}:</label><input  name="security"  type="text" class="input_sec_code" />
				<img id="siimage" src="{$bw->base_url}vscaptcha/" />
               	<a href="javascript:void(0)" id="reload_img" class="mamoi mamoi2">{$this->getLang()->getWords('refresh_captcha')}</a>
                <div class="clear"></div>
				<input id="btn_payment" type="submit" value="Thanh toán" class="btn">
				<input id="btn_cancel" type="button" value="Hủy bỏ" class="btn">
				<div class="clear"></div>
			</form>
			<if="$option['account_bank']">
			<div class="band">{$option['account_bank']->getContent()}</div>
			</if>
			<div class="clear"></div>
			<script>
				$("#reload_img").click(function(){
		        $("#siimage").attr("src",$("#siimage").attr("src")+"?a");
		        return false;
		        });
			
	       	$("#payment-info").submit(function(){
				if($(".title_text").val()==$(".title_text").attr('vsvalue')){
					alert("Vui lòng nhập tên");
					return false;
				}
				if($(".phone_text").val()==$(".phone_text").attr('vsvalue')){
					alert("Vui lòng nhập số điện thoại");
					return false;
				}
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	 			if(!filter.test($(".mail_text").val())){
	 				alert("Email không hợp lệ");
					return false;
				}
				
			});
	        $("#btn_payment").click(function(){
						//$("#payment-info").attr("action","{$bw->base_url}orders/payment_finish").submit();
			});
			$("#btn_cancel").click(function(){
						window.location='{$bw->base_url}orders/';
			});
	       </script> 
		</div>
	</div>
</div>
		
		
EOF;
	}
	function deleteCart($option = array()) {
		global $bw;
		$BWHTML .= <<<EOF
		{$this->getAddon()->getProductCategory($option)}
		<div id="content">
		Giỏ hàng đã được xóa!
		</div>
EOF;
	}
	
	
function showDeaultCart($option = array()) {
		global $bw;
		
		require_once(CORE_PATH."products/Product.class.php");
		$pp = new Product();
		$this->pp = $pp;
		$this->menu=VSFactory::getMenus();
		
		$this->total= 0;
		
		
		$BWHTML .= <<<EOF
		
		<div class="wrapper_detail_order">
			<div class="title_detail"></div>
            <h4 class="title_detail_item">Giỏ hàng</h4>
			<foreach="$_SESSION['vs_item_cart'] as $index =>$item">
			
				<php>
							$this->tota = 0;
							$this->tota = $item['price']*$item['quantity'];	
							$this->total+= $this->tota;
							
							
						</php>
			
				<div class="item_sess">
				{$this->pp->createImageCache($item['image'],60,60)}
				<h3>{$this->cut($item['title'], 40)}</h3>
				<h2>Số lượng: {$item['quantity']}</h2>
				<h4>Giá tiền: <span>{$this->numberFormat($this->tota)}  </span>đ</h2>
				</div>
				<div class="clear"></div>
			</foreach>
			<div class="total_see">Tổng tiền: <span>{$this->numberFormat($this->total)} </span>đ
			<br />
			</div>
			<div class="order_option">
				<a class="mh_tiep" href="{$bw->base_url}products"> mua hàng tiếp</a>
				<a class="payment" href="{$bw->base_url}orders"> Thanh toán</a>
				<div class="clear"></div>
			</div>
		</div>
		<script>
			$('.order_fixed .number_order').text({$option['load_cart']['num_cart']});
		</script>
		
		<if="$option['load_cart']['message']!=""">
		<script>
			jAlert('{$option['load_cart']['message']}','Thông báo'); 
			$('.order_fixed .number_order').text({$option['num_cart']});
		</script>
		</if>
		
EOF;
	}	
	
	
	
	
	
}
