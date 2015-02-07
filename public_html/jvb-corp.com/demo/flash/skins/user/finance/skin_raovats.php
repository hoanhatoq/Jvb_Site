<?php

class skin_raovats extends skin_objectpublic {



	function showDefault($option = array()) {
		global $bw;		

		$this->login=VSFactory::getUserLogin();

		$this->mobile=0;
		$detect = new Mobile_Detect;
		if ($detect->isMobile()) {
			$this->mobile=1;
		}


		
		$BWHTML .= <<<EOF
		
	<div class="container">
				<!--box_title-->
				<div class="row row_f" id="margintop">
					<div class="fix_col col-md-12 col-xs-12 col-sm-12">
						<div class="bgtitle2">
							<h2>tìm kiếm rao vặt</h2>
						</div>
						<div class="box_com">
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
									Tất cả sản phẩm<span class="caret"></span>
								</button>
								<ul role="menu" class="dropdown-menu">
									
								<foreach="$option['cate'] as $key=>$value">
									<li><a href="{$value->getCatUrl()}">{$value->getTitle()}</a></li>
								</foreach>	
								</ul>
								<div class="line_rv"></div>
							</div>
							
							{$this->getAddon()->getHtml()->getPostRaoVat()}
						</div>
						
					</div>
				</div>
				<!--end box_title-->
				
				<div class="row">
					<!--content rao vặt-->
					<div class="col-md-12">
						<div class="wrapper wap_raovat">
							<!--<div class="box_head">
								<div class="need_sale">
									CẦN BÁN
								</div>
								
								<div class="res_news">
									<ul>
										<li><span>Người đăng</span></li>
										<li><span>Xem</span></li>
										<li><span>Thời gian đăng</span></li>
									</ul>
								</div>
							</div>
							-->
							<!--wrapper_content-->
							<div class="wrapper_content">
								<!--discussionListItems-->
								<div id="padding" class="col-md-12 col-sm-12 col-xs-12 discussionListItems">
									<ul>
										<if="$this->mobile==0">
										{$this->showItem($option['pageList'])}
										<else />
										{$this->showItemMobile($option['pageList'])}
										</if>
									</ul>
								</div>
								<!--discussionListItems-->
							</div>
							<!--wrapper_content-->
						</div>
					</div>
					<!--end content rao vặt-->
				</div>
				
				<!--page-->
				<div class="row">
				
					<div class="col-md-12 page">
						<div class="pagination">
							{$option['paging']}
						</div>
					</div>
				</div>
				<!--end page-->
			</div>
			<!-- end container-->


			
EOF;

		return $BWHTML;
	}	

	
	
function showDetail($obj,$option = array()) {
	global $bw;		

	$this->login=VSFactory::getUserLogin();

	//print_r($obj);die;
		
		$BWHTML .= <<<EOF	
	
	
	
	
	<div class="container">
				<!--box_title-->
				<div class="row row_f" id="margintop">
					<div class="fix_col col-md-12 col-xs-12 col-sm-12">
						<div class="bgtitle2">
							<h2>tìm kiếm rao vặt</h2>
						</div>
						<div class="box_com">
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
									Tất cả sản phẩm<span class="caret"></span>
								</button>
								<ul role="menu" class="dropdown-menu">
									
								<foreach="$option['cate'] as $key=>$value">
									<li><a href="{$value->getCatUrl()}">{$value->getTitle()}</a></li>
								</foreach>	
								</ul>
								<div class="line_rv"></div>
							</div>
							
							{$this->getAddon()->getHtml()->getPostRaoVat()}
						</div>
						
					</div>
				</div>
				<!--end box_title-->
				
				<div class="row">
					<!--content rao vặt-->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="wrapper wap_raovat">
							<!--<div class="box_head">
								<div class="need_sale">
									CẦN BÁN(<span></span>)
								</div>
								
								
							</div>-->
							
							<!--wrapper_content-->
							<div class="wrapper">
								<!--detail product-->
								<div class="rv_mb col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
									<div class="list_img">
										<span>
											<a ><img alt="" src="{$bw->vars['img_url']}/person_rv.png"></a>
										</span>
									</div>
									<div class="listBlock">
										<div class="titleText">
											<h3 class="title">
												<a >{$obj->getTitle()}</a>	
											</h3>
											<if="$obj->getPrice()"><span>{$this->numberFormat($obj->getPrice())} đ</span></if>
										</div>
									</div>
								</div>
								
								<div class="col-md-12 col-sm-12 col-xs-12 wrapper_content" id="padding">
									<!--images product-->
									<if="$obj->getImage()>0">
									<div class="col-md-5 col-sm-12 col-xs-12">	
										<!-- Slides -->
										<div id="Silder_holder">
											<ul id="image_slider" class="bxsliders">
												<li>{$obj->createImageCache($obj->getImage(),450,350)}</li>
											</ul>
											
										</div>
									  <!-- Slides --> 
									</div>
									<!--end images product-->
									</if>
									
									<!--description product-->
									<div class="col-md-7 col-sm-12 col-xs-12 colMargintop">
										<div class="col-md-12 col-sm-12 col-xs-12 descript_pro">
											<h3>{$obj->getTitle()}</h3>
											<if="$obj->getPrice()"><p class="price_pro">Giá: <span>{$this->numberFormat($obj->getPrice())} đ</span></p></if>
											<div class="info_rv">
												{$obj->getContent()}
											</div>
											
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="colsmFB">{$this->getAddon()->getHtml()->getSocial()}</div>
										</div>
									</div>
									<!--end description product-->
								</div>
								<!--end detail product-->
								
								<!--comment and advertisement-->
								<div class="col-md-12 col-sm-12 col-xs-12 border-top" id="padding">
									<div class="wrapper_content">
										{$this->getAddon()->getHtml()->getComment($option['comment'])}
										
										<!--advertisement-->
										<div class="col-md-4 col-xs-12 col-sm-5">
											{$this->getAddon()->getHtml()->getPromotionBanner()}
										</div>
										<!--end advertisement-->
									</div>
								</div>
								<!--end comment and advertisement-->
								
								
								<if="$option['other']">
								<!--discussionListItems-->
								<div class="col-md-12 col-sm-12 col-xs-12 border-top" id="padding">
									<div class="col-md-12 col-sm-12 col-xs-12" id="padding">
										<div class="news_diff"><h2>TIN CÙNG DANH MỤC</h2></div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" id="padding">
										<div class="discussionListItems">
											<ul>
												{$this->showItem($option['other'])}
											</ul>
										</div>
									</div>
								</div>
								</if>
								<!--end discussionListItems-->
							</div>
							<!--end wrapper_content-->
						</div>
					</div>
					<!--end content rao vặt-->
				</div>
				
			</div>
	
	
EOF;

		return $BWHTML;
	}	

		

	
function showItem($option = array()) {
	global $bw;		

	$this->login=VSFactory::getUserLogin();
		
		$BWHTML .= <<<EOF		
	
	
	
<foreach="$option as $key=>$value">
	<li class="item_rv">
		<div class="list_img">
			<span>
				<a href="#"><img src="{$bw->vars['img_url']}/person_rv.png" alt=""></a>
			</span>
		</div>
		<div class="listBlock">
			<div class="titleText">
				<h3 class="title title_rv">
					<a href="{$value->getUrl('raovats')}">{$value->getTitle()}</a>	
				</h3>
				<if="$value->getPrice()"><span><b>{$this->numberFormat($value->getPrice())}</b> đ</span></if>
			</div>
		</div>
		<div class="listper">
			<div class="titleText">
				<h3 class="title">
					<a class="name_rv">{$value->getName()}</a>	
				</h3>
				<span>{$value->getPhone()}</span>
			</div>
		</div>
		<div class="listsee">Lượt xem:<b>{$value->getHit()}</b></div>
		<div class="listtime">{$this->dateTimeFormatAgo($value->getPostDate())}</div>
	</li>
	</foreach>


EOF;

		return $BWHTML;
	}	



function showItemMobile($option = array()) {
	global $bw;		

	$this->login=VSFactory::getUserLogin();
		
		$BWHTML .= <<<EOF		
	
	
	
<foreach="$option as $key=>$value">
	<li class="item_rv">
		<div class="list_img">
			<span>
				<a href="#"><img src="{$bw->vars['img_url']}/person_rv.png" alt=""></a>
			</span>
		</div>
		<div style="width:58%;float:left;" class="">
			<div class="titleText">
				<h3 class="title title_rv">
					<a href="{$value->getUrl('raovats')}">{$value->getTitle()}</a>	
				</h3>
			</div>
		</div>
		<div style="width:28%;float:left;" class="">
			<div class="titleText">
				<h3 class="title">
					<a class="name_rv">{$value->getName()}</a>	
				</h3>
			</div>
		</div>
	</li>
	</foreach>


EOF;

		return $BWHTML;
	}		




	
}
