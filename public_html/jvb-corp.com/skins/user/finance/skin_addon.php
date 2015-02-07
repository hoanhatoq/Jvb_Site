<?php
class skin_addon extends skin_board_public {




function getSocialLeft($url){
		global $bw;
		

		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		//echo $url;exit();
		if($option=='home'){
		$url=$bw->base_url;	
		}

		
		$BWHTML .= <<<EOF

	<div class="social_left">	



	<script>
		
		setTimeout(function(){	

			(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));

			!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
			
			window.___gcfg = {lang: 'vi'};

		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/platform.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();

		},3000)

</script>
		
		<div style="margin-bottom:6px;" class="fb-like" data-href="{$url}" data-layout="box_count" data-action="like" ></div>

		<div class="clear"></div>

		<!-- Đặt thẻ này vào nơi bạn muốn Nút +1 kết xuất. -->
		<div class="g-plusone" data-size="tall"></div>

		<!-- Đặt thẻ này sau thẻ Nút +1 cuối cùng. -->
		<script type="text/javascript">
		  
		</script>	
		
		<div class="clear"></div>		
		
		 <a style="width:10px;" href="{$url}" data-count="vertical" class="twitter-share-button" data-lang="en">Twe</a>

    <script></script>


	</div>
        
EOF;

		return $BWHTML;
	}	

	
function getNewBar($option){
		global $bw;
		
		require_once CORE_PATH.'pages/pages.php';
		$new=new pages();
		$category=VSFactory::getMenus()->getCategoryGroup('news');
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());

		$new->setCondition("status>0 and catId in ($ids)");
		$new->setLimit(array(0,10));
		$new->setOrder('`hit` DESC');
		
		$option['list']=$new->getObjectsByCondition();

		 $option['ban']= $this->getAddon()->getBannerByCode("BANNER_PRO");


		$BWHTML .= <<<EOF
		
	<article>	
	<div class="side_bar side_bar_right">
            <div class="title_cate"><span></span>Tin xem nhiều</div>
            <div class="main_cate">
				<foreach="$option['list'] as $value">
                <div class="item_new_right">
                	<a href="{$value->getUrl($value->getModule())}">
                    	{$value->createImageCache($value->getImage(),74,55,3)}
                        <h3>{$value->getTitle()}</h3>
                    </a>
                </div>
                </foreach>
            </div>
            <div class="ads">
                <foreach="$option['ban'] as $key=>$value">
                    <img  src="{$value->getCacheImagePathByFile($value->getImage(),1,1,1,1,1,1)}" class="img-resposive">
              </foreach>
            </div>
        </div><!--end side_bar-->
	</article>	
        
EOF;

		return $BWHTML;
	}	



function getItemProuctBySession($option){
		global $bw,$vsTemplate;

	
		$BWHTML .= <<<EOF
		

		<if="$option['list234234']">
     	
		<div class=" select_cate_de">
              <ul class="list_cate_child">
                  <li class="list_first"><a >Sản phẩm nbạn đã xem qua</a></li><div class="clear"></div>                             
                </ul>
                <div class="clear"></div>
                <div class="single-item main_product main_category">
                    {$this->getHtml()->itemProduct($option['list'])}
                </div>   
            </div><!--end select_se-->
        <div class="clear"></div>


		
			<foreach="$option['list'] as $key=>$value">
			<if="$value->getId()">
			<div class="item">
	        	<a href="{$value->getUrl('products')}">{$value->createImageCache($value->getImage(),225,225,4)}</a>
	            <h3><a href="{$value->getUrl('products')}">{$value->getTitle()}</a></h3>
	            <if="$value->getPrice()"><div class="price">{$this->numberFormat($value->getPrice())} đ</div></if>
	            <if="$value->getPromotion()"><div class="promotion">{$this->numberFormat($value->getPromotion())} đ</div></if>
	            <div class="intro">
	            	 <h3><a href="{$value->getUrl('products')}">{$value->getTitle()}</a></h3>
	                <if="$value->getPrice()"><div class="price">{$this->numberFormat($value->getPrice())} đ</div></if>
	                <if="$value->getPromotion()"><div class="promotion"> {$this->numberFormat($value->getPromotion())} đ</div></if>
	                <a onclick="addCart({$value->getId()})" class="order" href="javascript:void(0)"></a>
	                <a class="detail" href="{$value->getUrl('products')}"></a>
	            </div>
	        </div>
	        </if>
	        </foreach>
        </if>


EOF;
		return $BWHTML;
	}	





function getCategotyProduct($option){
		global $bw;
		
		$option['cate']=VSFactory::getMenus()->getCategoryGroup('products')->getChildren();	




		$BWHTML .= <<<EOF
		
        
		<ul class="menu_f">
			<foreach="$option['cate'] as $key=>$cate">
        	<li><span class="icon" style="background:url({$cate->getCacheImagePathByFile($cate->getFileId(),1,1,1,1)})" ></span><a href="{$cate->getUrlCategory()}">{$cate->getTitle()}</a>
            	<ul>
                	<div class="wap_sb">
                	<foreach="$cate->children as $child1">
                	<ul >
                        <li class="title_sub"><a href="{$child1->getUrlCategory()}">{$child1->getTitle()}</a></li>
                       <foreach="$child1->children as $child2">
                        	<li><a href="{$child2->getUrlCategory()}">{$child2->getTitle()}</a></li>
						</foreach>
                    </ul>
                    </foreach>
                    <div class="clear"></div>
                    </div>
                </ul>
            </li>
            </foreach>
        </ul>


EOF;
		return $BWHTML;
	}	





	
function getTags($obj){
		global $bw;
		
		
		require_once CORE_PATH.'tags/tags.php';
//		$option['category']=VSFactory::getMenus()->getCategoryGroup('products');
//		$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
		$tags=new tags();
		//$tags->setCondition("status>0");
		$tags->setCondition("`id` IN (SELECT `tagId` FROM `vsf_tagcontent` WHERE `contentId` ={$obj->getId()})");
		 
		//$tags->setOrder("`index`");
		$this->list_tag=$tags->getObjectsByCondition();
		
		
		$BWHTML .= <<<EOF
		
		<if="$this->list_tag">
			<div class="tag_detail"><span>Tag:</span>
				<foreach="$this->list_tag as $obj">
	                <a  href="{$bw->base_url}products/tags/{$obj->getSlugId()}">{$obj->getTitle()} </a>
	            </foreach>
			</div>
		</if>
        
EOF;
		return $BWHTML;
	}		
	
	

	
	function getBanner($option) {
		global $bw;

		$option['slide']=Object::getObjModule('partners', 'banner_home', '>0');

		//print_r(VSFactory::getMenus()->getCategoryGroup('banner_top'));die;


		$BWHTML .= <<<EOF
		
	
		
		<div class="slide_home">
        	<div id="slider_home">
            	<foreach="$option['slide'] as $key=>$value">
			    <if="$value->getImage()">
			    	{$value->createImageCache($value->getImage(),927,380,3)}
			    </if>
			</foreach>
            </div>
        </div>

		
				
			
	
		
EOF;
		return $BWHTML;
	}
	




	
	function getMenuTop($option = array()) {
		global $bw,$vsLang;
		$this->bw = $bw;
		$vsLang = VSFactory::getLangs();
		$BWHTML .= <<<EOF
		
	
		<div class="clear"></div>
        <div class="menu_top">
        	<ul>
                <foreach="$option['menu'] as $mn">
                	<li class="{$mn->active}" ><a href="{$this->bw->base_url}{$mn->getUrl()}">{$mn->getTitle()}</a></li>
                	
                </foreach>
                <div class="clear"></div>	
            </ul>
        	
        </div>
		
		
		
		
EOF;
		return $BWHTML;
	}
	
	
	function getSocial($option=array()){
		global $bw;
		
		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		//echo $url;exit();
		if($option=='home'){
		$url=$bw->base_url;	
		}
		
		$BWHTML .= <<<EOF
		
		<div class="wap_social">
			<div class="google-plus"><g:plusone size="medium" href="{$url}"><g:plusone></div>
			<div class="tweeter"><a data-url="{$url}" href="https://twitter.com/share" class="twitter-share-button"></a></div>
			
			<div class="fb-like" data-href="{$url}" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
		</div>
		<style>
			.wap_social div{
				float:left;
			}
			
		</style>
	<div id="fb-root"></div>		
	<script>
	$(document).ready(function() {
							
			(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
	
			
			(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			  
			 !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs'); 
		
		});
	</script>
			
	
			
			
EOF;
		return $BWHTML;
	}	
	
	
	function getMenuBottom($option = array()) {
		global $bw,$vsLang;
		$this->bw = $bw;
		$vsLang = VSFactory::getLangs();
		$BWHTML .= <<<EOF
		
            
            <ul>
				<foreach="$option ['menu'] as $mn ">
                <li><a class="{$mn->active}" href="{$this->bw->base_url}{$mn->url}">{$mn->getTitle()}</a></li>
                </foreach>
			</ul>
		
EOF;
		return $BWHTML;
	}


function getContact($option = array()) {
		
	
		require_once CORE_PATH.'contacts/pcontacts.php';
		$pc=new pcontacts();
		$category=VSFactory::getMenus()->getCategoryGroup('contacts');
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		$pc->setCondition("status>0 AND catId in($ids)");
		$pc->setOrder("`index`");
		$option['obj']=$pc->getOneObjectsByCondition();
		
		
		global $bw;
		$BWHTML .= <<<EOF
		
       
       <p><if="$option['obj']">{$option['obj']->getIntro()}</if> </p>  
                
                
EOF;
		return $BWHTML;


	function getAnalytic($option = array()) {
		global $bw;
		$BWHTML .= <<<EOF
		
		<p>Đang truy cập:<span><b>{$this->numberFormat($option['online'])}</b> | Tổng truy cập:<b>{$this->numberFormat($option['total'])}</b></span></p>
		
        
                
EOF;
		return $BWHTML;
	}
	function getProductCategory($option = array()) {
		global $bw;
		$this->bw=$bw;
		

		$BWHTML .= <<<EOF
		
		<div class="home-listing">
            <div class="control">
                <ul class="nav nav-tabs tabs-left" id="menu">
                  <foreach="$option ['category'] as $cate ">
                  <li ><a href="{$this->bw->base_url}products/category/{$cate->getSlugId()}" >{$cate->getTitle()}</a></li>
                  </foreach>
                  
                </ul>
            </div>
            
        </div><!-- end .home-listing -->
		
		
		
                
EOF;
		return $BWHTML;
	}
	
	function getServiceHome($option = array()) {
		global $bw;
		$this->bw=$bw;
		$option['ser']=Object::getObjModule('pages', 'services', '>0', '5', '');
		$BWHTML .= <<<EOF
			<div class="service_home">
		    	<div class="wrap_service_home">
		        	<foreach="$option['ser'] as $obj ">
			        	<div class="service_item ser{$vsf_count}">
			            	<a href="{$obj->getUrl('services')}" class="im"></a>
			                <a href="{$obj->getUrl('services')}" class="na">{$obj->getTitle()}</a>
			            </div>
		            </foreach>
		            <div class="ser_bott"></div>
		        </div>
		    </div>
EOF;
		return $BWHTML;
	}
	function getNewsCategory($option = array()) {
		global $bw;
		$this->bw=$bw;
		
		$option ['category'] = VSFactory::getMenus ()->getCategoryGroup ( 'posts' )->getChildren();
		$BWHTML .= <<<EOF
			<div class="news_sitebar cate_sitebar">
            	<div class="title">Tin tức</div>
                <ul id="menu">
                	<foreach="$option ['category'] as $cat ">
                	<li><a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}">{$cat->getTitle()}</a></li>
                	</foreach>
                </ul>
            </div>
           <div class="clear"></div>
EOF;
		return $BWHTML;
	}
	function getCustomerSitebar($option = array()) {
		global $bw;
		$this->bw=$bw;
		$option['customers']=Object::getObjModule('pages', 'customers', '>0', '', '');
		$BWHTML .= <<<EOF
			<div class="news_sitebar cate_sitebar">
            	<div class="title">Hỗ trợ khách hàng</div>
                <ul id="menu">
                	<foreach="$option ['customers'] as $obj ">
                	<li><a href="{$obj->getUrl('customers')}">{$obj->getTitle()}</a></li>
                	</foreach>
                </ul>
            </div>
           <div class="clear"></div>
EOF;
		return $BWHTML;
	}
	function getServiceSitebar($option = array()) {
		global $bw;
		$this->bw=$bw;
		$option['service']=Object::getObjModule('pages', 'services', '>0', '', '');
		$BWHTML .= <<<EOF
			<div class="news_sitebar cate_sitebar">
            	<div class="title">Dịch vụ</div>
                <ul id="menu">
                	<foreach="$option ['service'] as $obj ">
                	<li><a href="{$obj->getUrl('services')}">{$obj->getTitle()}</a></li>
                	</foreach>
                </ul>
            </div>
           <div class="clear"></div>
EOF;
		return $BWHTML;
	}
	
	
	
	function getNewsSitebar($option = array()) {
		global $bw;
		$this->bw=$bw;
		$option['news']=Object::getObjModule('posts', 'posts', '=2', '2', '');
		$BWHTML .= <<<EOF
		<div class="news_sitebar ">
            	<div class="title">Những bài viết gần đây</div>
                
                <foreach="$option['news'] as $obj ">
                <div class="news_home_item">
                    <div class="na"><a href="{$obj->getUrl('posts')}">{$obj->getTitle()}<span> [{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}]</span></a></div>
                    <div class="intro">{$this->cut($obj->getIntro(),100)}</div>
                        
                    
                    <a class="detail" href="{$obj->getUrl('posts')}">Chi tiết</a>
                    <div class="clear"></div>
                </div>
                </foreach>
                <a class="viewall" href="{$bw->base_url}posts">Xem tất cả...</a>
                <div class="clear"></div>
                
            </div>
                
                
EOF;
		return $BWHTML;
	}
	function getNewsHome($option = array()) {
		global $bw;
		$this->bw=$bw;
		$option['news']=Object::getObjModule('pages', 'news', '=2', '2', '');
		$BWHTML .= <<<EOF
		<div class="col-md-12">
                    <h3 class="title-right1">Tin tức</h3>
                    <div class="box-news">                      
                         <ul class="list-news">
                            <foreach="$option['news'] as $obj ">
                            <li>
                                <a href="{$obj->getUrl('news')}">{$obj->createImagecache($obj->getImage(),70,55)}</a>
                                <a href="{$obj->getUrl('news')}">{$obj->getTitle()}</a>
                               
                            </li>
                            </foreach>            
                        </ul>
                        <div class="clr"></div>
                    </div>                        
                </div>
                
                
EOF;
		return $BWHTML;
	}
	function getVideoHome($option = array()) {
		global $bw;
		$this->bw=$bw;
		$option['video']=Object::getObjModule('pages', 'videos', '>0', '', '');
		$option['shift']=array_shift($option['video']);
		
		$BWHTML .= <<<EOF
			

            	<div class="row">
                    <div class="col-md-12">
                    <div class="box-video">
                        <h3 class="title-right">Video</h3>
                        <if="$option['shift'] ">
                        <iframe width="280" height="200" 
			            src="http://www.youtube.com/embed/{$option['shift']->getcode()}" 
			        	frameborder="0" allowfullscreen>
			        	</iframe>
                        <h4>{$option['shift']->getTitle()}</h4>
                        </if>
                        <ul class="list-video">
                            <foreach="$option['video'] as $obj ">
                            <li><a href="{$obj->getUrl('videos')}">{$obj->getTitle()}</a></li>
                            </foreach>
                        </ul> 
                        <div class="clr"></div>
                    </div>                                              
                </div>
                
EOF;
		return $BWHTML;
	}
	
	function getProjectHome($option = array()) {
		global $bw;
		$this->bw=$bw;
		$option['project']=Object::getObjModule('pages', 'projects', '=2', '3', '');
		
		$BWHTML .= <<<EOF
			<div class="title_block2">Hình ảnh dự án</div>
            <foreach="$option['project'] as $obj ">
            <div class="pro_item">
            	<div class="im"><a href="{$obj->getUrl('projects')}">{$obj->createImageCache($obj->getImage(),341,208)}</a></div>
                <div class="na"><a href="{$obj->getUrl('projects')}">{$obj->getTitle()}</a></div>
                <div class="intro">
					{$this->cut($obj->getContent(),140)}
                </div>
                <a href="{$obj->getUrl('peojects')}" class="detail">Chi tiết</a>
            </div>
            </foreach>
                
                
EOF;
		return $BWHTML;
	}
	function getAdsSitebar($option = array()) {
		global $bw;
		$this->bw=$bw;
		$option['ads']=Object::getObjModule('pages', 'ads', '>0', '', '');
		$BWHTML .= <<<EOF
			<div class="ads_sitebar">
              	<foreach="$option['ads'] as $obj ">
              		<a href="">{$obj->createImageCache($obj->getImage(),304,93)}</a>
              	</foreach>
                
             </div>
EOF;
		return $BWHTML;
	}
	
	
	function getSearchHome($option = array()) {
		global $bw;
		$this->bw=$bw;
		$option['video']=Object::getObjModule('videos', 'videos', '>0', '', '');
		$BWHTML .= <<<EOF
			<div class="box_item search_box">
            	<div class="im"><img src="{$bw->vars['img_url']}/im_search.png"  /></div>
                <div class="title_search">Tìm kiếm</div>
                <div class="form_search">
                	<form name="search_product" method="get" action="{$bw->base_url}projects/search" >
                    	<p class="provin_title">Thành phố/tỉnh</p>
                        <p class="dis_title">Quận/huyện</p>
                    	<input name="provin" class="provinces" type="text" />
                        <input name="dis" class="dis" type="text" />
                        <input class="submit_searchHome" type="submit" value="Tìm"  />
                        <div class="clear"></div>
                    </form>
                </div>
            </div>
                
                
EOF;
		return $BWHTML;
	}
	function getSearchSitebar($option = array()) {
		global $bw;
		$this->bw=$bw;
		$option['news']=Object::getObjModule('pages', 'ads', '>0', '', '');
		$BWHTML .= <<<EOF
			<div class="search_sitebar">
            		<div class="title_searchBar">Tìm kiếm</div>
                	<form name="search_product" method="get" action="{$bw->base_url}projects/search" >
                    	<p class="provin_title">Thành phố/tỉnh</p>
                        <p class="dis_title">Quận/huyện</p>
                    	<input name="provin" class="provinces" type="text" />
                        <input name="dis" class="dis" type="text" />
                        <input class="submit_searchHome" type="submit" value="Tìm"  />
                        <div class="clear"></div>
                    </form>
              </div>
EOF;
		return $BWHTML;
	}
	function getContactFooter($option = array()) {
	
		require_once CORE_PATH.'contacts/pcontacts.php';
		$pc=new pcontacts();
		$category=VSFactory::getMenus()->getCategoryGroup('pcontacts');
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		$pc->setCondition("status>-1 and catId in (94)");
		//$pc->setOrder("`index`");
		$option['obj']=$pc->getOneObjectsByCondition();
		
		
		global $bw;
		$BWHTML .= <<<EOF
       {$option['obj']->getContent()}  
EOF;
		return $BWHTML;
	}
	
	
	
	
	//////////<vssupport  id="{$skype->getId()}" ></vssupport>
	/////////<a href="ymsgr:sendIM?nguyenvanhung2212"><img src="{$bw->vars['img_url']}/yahoo_1.jpg" /></a>
	/////////<a href="skype:ndt4you?chat"><img src="{$bw->vars['img_url']}/yahoo_1.jpg" /></a>
	/////////<a rel="nofollow" href="skype:ndt4you?chat"><img src="http://mystatus.skype.com/balloon/ndt4you"> </a>
	////////<a rel="nofollow" href="ymsgr:sendIM?vietsol_sp"><img  src="http://opi.yahoo.com/online?u=vietsol_sp&amp;m=g&amp;t=1"></a>
	function getSupport($option = array()) {
		global $bw;
		$this->bw=$bw;
		$BWHTML .= <<<EOF
		<div class="sitebar_item support_sitebar">
			<div class="support_sitebar_title"><h3>Hỗ trợ trực tuyến</h3></div>
			<foreach="$option['support'] as $obj ">
			<div class="yahoo">{$obj->getTitle()}:</br>
				
				<a href="ymsgr:sendIM?{$obj->getYahoo()}"><img src="{$bw->vars['img_url']}/yahoo_online.png"  /></a>
				<a href="{$obj->getSkype()}?chat"><img src="{$bw->vars['img_url']}/sky.png"  /></a>
				<a>({$obj->getPhone()})</a>
			</div>
			</foreach>
			<div class="line"></div>
			<div class="sitebar_bott"></div>
		</div>
                
                
EOF;
		return $BWHTML;
	}
	
	

function getPromotionLeft($option = array()) {
		global $bw;
		$this->bw=$bw;

		$option['ban']= $this->getAddon()->getBannerByCode("BANNER_LEFT_PRO");
		//print_r($option['ban']);die;

		$BWHTML .= <<<EOF
		

		<div class="col-md-12 col_margin">
          <div class="capacity hide_mobile">
            <div class="box_capa">
              <h2>QUẢNG CÁO</h2>
            </div>
            <div class="boxCapaAd">
              <foreach="$option['ban'] as $key=>$value">
            	 <img  src="{$value->getCacheImagePathByFile($value->getImage(),1,1,1,1,1,1)}">
			  </foreach>
            </div>
          </div>
        </div>

EOF;
		return $BWHTML;
	}

	
	
function getPromotionBanner($option = array()) {
		global $bw;
		$this->bw=$bw;

		$option['ban']= $this->getAddon()->getBannerByCode("BANNER_PRO");
		//print_r($option['ban']);die;

		$BWHTML .= <<<EOF
			
		<if="$option['ban']">		
        <div class="col-md-12 col-xs-12 col-sm-5 wrapper borderall">
          <div class="promotion">
            <strong>KHUYẾN MÃI</strong>
          </div>
          <div class="col-md-12 col-xs-12 col-sm-12 smImg" id="padding">
			<foreach="$option['ban'] as $key=>$value">
            <img  src="{$value->getCacheImagePathByFile($value->getImage(),1,1,1,1,1,1)}" class="img-resposive">
			</foreach>
          </div>
        </div>
		</if>	
EOF;
		return $BWHTML;
	}

function getPageBottom($option = array()) {
		global $bw;
		$this->bw=$bw;


		require_once CORE_PATH . 'pages/pages.php';
		$pg=new pages();
		 $option['cate'] = VSFactory::getMenus ()->getCategoryGroup ('info')->getChildren();

		foreach ($option['cate'] as $key=>$value){
			$ids=VSFactory::getMenus()->getChildrenIdInTree($key);
			$pg->setCondition("status>0 and catId in ({$ids})");
			$pg->setOrder('`index` DESC');
			$option['list'][$key]=$pg->getObjectsByCondition();

		}	

		$option['abouts']=Object::getObjModule('pages', 'abouts', '>0');


		$BWHTML .= <<<EOF
				
        <div class="con_footer">
        	<div class="box box_0">
            	<div class="title_box">Về công ty kim minh</div>
               	<foreach="$option['abouts'] as $obj">
                <p><a href="{$obj->getUrl($obj->getModule())}">{$obj->getTitle()}</a></p>
				</foreach>
            </div>	
        	<foreach="$option['cate'] as $key=>$value">
        	<div class="box box_{$vsf_count}">
            	<div class="title_box">{$value->getTitle()}</div>
               	<foreach="$option['list'][$key] as $obj">
                <p><a href="{$obj->getUrl($obj->getModule())}">{$obj->getTitle()}</a></p>
				</foreach>
            </div>
            </foreach>
        </div>

EOF;
		return $BWHTML;
	}	


function Register($option=array()) {
		global $bw;
		
		$BWHTML .= <<<EOF
			
	
	<!--register account-->
		<div class=" com_info fix_popup">
			<button style="display:none;"  class="rescomment" data-toggle="modal" data-target=".register_popup"></button>
			<div class="modal fade register_popup" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
							<button aria-hidden="true" data-dismiss="modal" class="trigg_c close" type="button">×</button>
							<h4 class="modal-title iconRes">ĐĂNG KÝ TÀI KHOẢN</h4>
						</div>
						<div class="modal-body">
							<div class="error"></div>
							<form id="form_register" class="form-horizontal" role="form">
								<div class="form-group">
									<label for="inputName" class="col-sm-2 control-label">Họ tên</label>
									<div class="col-sm-10">
										<input name="name" type="text" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPhone" class="col-sm-2 control-label">Điện thoại</label>
									<div class="col-sm-10">
										<input name="phone" type="text" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
									<div class="col-sm-10">
									  <input name="email" type="email" class="form-control" id="inputEmail3">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Mật khẩu</label>
									<div class="col-sm-10">
									  <input name="password" type="password" class="form-control" id="inputPassword3">
									</div>
								</div>
								<div class="form-group">
									<label for="inputAd" class="col-sm-2 control-label">Địa chỉ</label>
									<div class="col-sm-10">
										<input name="address" type="text" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Mã bảo vệ:</label>
									<div class="col-sm-10" id="serc">
										<div class="col-sm-5" style="padding-left:0;">
											<input type="text" class="form-control" placeholder="Mã bảo vệ" name="sec_code">
										</div>
										<div class="col-sm-6">
											<img id="change" src="{$bw->vars['board_url']}/vscaptcha/" />
											<a href="#" id="an" class="mamoi">refresh</a>
										</div>
									</div>
								</div>
								<div class="form-group">
									
									<div style="text-align:center;" class="col-sm-12">
										<button onclick="register()" type="button" class="btn btn-success">ĐĂNG KÝ</button>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-4">
										<a href="{$bw->base_url}" class="backhome">Về trang chủ</a>
									</div>
									<div class="col-md-6 col-md-offset-2" style="text-align:right;">
										Bạn đã có tài khoản?<a onclick="$('.trigg_c').trigger('click');$('.button_trigg_login').trigger('click');" href="javascript:void(0)" class="loginPro"> Đăng nhập</a>
									</div>
								</div>

							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end register account-->


		<script>

			function register(){
				$.ajax({
				type:'POST',
				url: baseUrl+'users/do_registry',
				data:$('#form_register').serialize(),
				cache: false,
					success: function(data){
						if(data==1){
							location.href="{$bw->base_url}";
						}else{
							$('.error').text(data);
						}
					}
					
				});
			}
	

		</script>

		<script>
			$(document).ready(function () {
				$("#an").click(function(){
				//alert(123);
                $("#change").attr("src",$("#change").attr("src")+"?a");
                return false;
				});
			});
		</script>


	
	
	
EOF;
		return $BWHTML;
	}	
	





function getPostRaoVat($option=array()) {
		global $bw;
		
		$this->login=VSFactory::getUserLogin();

		$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ('raovats')->getChildren();

		$this->user=VSFactory::getUserLogin();

		$BWHTML .= <<<EOF
			
	
	<div class="dk_news">
		<if="$this->login['id']">
		<button class="btn btn-link" data-toggle="modal" data-target=".post_raovat">ĐĂNG TIN</button>
		<else />
		<button class="btn btn-link" data-toggle="modal" data-target=".login_pop">ĐĂNG TIN</button>
		</if>
		<div class="modal fade post_raovat" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="trigg_c close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">ĐĂNG TIN RAO VẶT</h4>
					</div>
					<div class="modal-body">
						<form id="form_raovat" role="form">
							<div class="form-group">
								<label for="exampleInputEmail1" class="label">Tiêu Đề(0/160)</label>
								<input name='title' type="text" class="form-control">
							</div>
							<div class="form-group">
								<label  for="exampleInputEmail1" class="label">Nội Dung Tin</label>
								<textarea name='content' class="form-control" rows="3"></textarea>
							</div>
							<div class="col-xs-5" id="paddingleft">
								<div class="form-group">
									<label for="exampleInputEmail1" class="label">Giá Từ</label>
									<input name='price' type="text" class="form-control">

								</div>
							</div>
							<div class="col-xs-5 col-xs-offset-1">
								<div class="form-group">
									<label for="exampleInputEmail1" class="label">Danh Mục Rao</label>
									<select name='catId' class="form-control">
										<foreach="$option['cate'] as $key=>$value">
										<option value="{$value->getId()}">{$value->getTitle()}</option>
										</foreach>
									</select>
								</div>
							</div>
							<div class="col-xs-12 form-group" id="paddingleft">
								<label for="exampleInputFile" class="label">Chọn hình</label>
							
								 <span class="btn btn-success fileinput-button">
								        <i class="glyphicon glyphicon-plus"></i>
								        <span>Select files...</span>
								        <!-- The file input field used as target for the file upload widget -->
								        <input id="fileupload" type="file" name="files" multiple>
								    </span>
								    <br>
								    <br>
								    <!-- The global progress bar -->
								    <div id="progress" class="progress">
								        <div class="progress-bar progress-bar-success"></div>
								    </div>
								    <!-- The container for the uploaded files -->
								    <div id="files_list" class="files"></div>





							</div>
							<div class="col-xs-4" id="paddingleft">
								<label for="exampleInputFile" class="label">Họ Tên</label>
								<input value="{$this->user['name']}" name='name' type="text" class="form-control">
							</div>
							<div class="col-xs-4">
								<label for="exampleInputFile" class="label">Số Điện Thoại</label>
								<input value="{$this->user['phone']}" name='phone' type="text" class="form-control">
							</div>
							<div class="col-xs-4">
								<label for="exampleInputFile" class="label">Email</label>
								<input value="{$this->user['email']}" name='email' type="text" class="form-control">
							</div>
							<div class="clear"></div>
							<div class="msg"></div>
							<button onclick='post_raovat()' type="button" class="btn btn-success" style="margin-top:30px;">TIẾP TỤC</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<script>

		$(function () {
		   
		    $('#fileupload').fileupload({
		      url: baseUrl+'raovats/uploadfile',
		      dataType:'json',
		      done: function (e,data) {
		      		console.log(data.result);
		           $('#files_list').html(data.result.html);    
		        },
		        progressall: function (e, data) {
		            var progress = parseInt(data.loaded / data.total * 100, 10);
		            $('#progress .progress-bar').css(
		                'width',
		                progress + '%'
		            );
		        }
		    }).prop('disabled', !$.support.fileInput)
		        .parent().addClass($.support.fileInput ? undefined : 'disabled');
		});
</script>


		<script>

			function post_raovat(){
				$.ajax({
				type:'POST',
				url: baseUrl+'raovats/user_post',
				data:$('#form_raovat').serialize(),
				cache: false,
					success: function(data){
						if(data==1){
							location.href="{$bw->base_url}raovats";
						}else{
							$('.msg').text(data);
						}
					}
					
				});
			}
	

		</script>
	
	
	
EOF;
		return $BWHTML;
	}	



function getComment($option=array()) {
		global $bw;
		
		$this->user=VSFactory::getUserLogin();

		$this->id=end(explode("-",$bw->input[2]));

		if($bw->input[0]=='raovats')
			$this->cl="col-md-8";

		if($bw->input[0]=='products')
			$this->cl="col-md-12";
		

		$BWHTML .= <<<EOF

<script>
	$(document).ready(function(){
		

	})
	function send_comment(){
		if(!username){
			
			$('.trigg_c').trigger('click');
			setTimeout(function(){
				$('.button_trigg_login').trigger('click');
			},400)
			//$('.rescomment').trigger('click');
			return false;
		}
		if($('#ct_comment').val()==''){
			alert('Vui lòng nhập nội dung');
			return false;
		}
		$.ajax({
			type:'POST',
			url: baseUrl+'comments/send',
			data:$('#form_comment').serialize(),
			cache: false,
			success: function(data){
				if(data==1){
					location.reload();
				}
				if(data==2){
					alert('Vui lòng nhập nội dung');
				}
			}		
				
		});
	
	}

</script>


<div id="padding" class="fix_comment_{$bw->input[0]} {$this->cl} col-xs-12 col-sm-7 "><!--comment face-->
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="pel_com">
			<strong>BÌNH LUẬN</strong>
		</div>
		<form id="form_comment" role="form">
			<div class="form-group">
				<textarea id="ct_comment" placeholder="Nội dung" name="intro" class="form-control" ></textarea>
				<input type="hidden" name="module_cm" value="{$bw->input[0]}">
				<input type="hidden" name="objId" value="{$this->id}">
			</div>
			<if="!$this->user['id']"><button onclick="location.href='{$bw->base_url}users/login_mobile'" type="button" class="button_login_mobile btn btn-info">Đăng nhập</button></if>
			<button onclick="send_comment()" type="button" class="btn btn-info">Gửi</button>
		</form>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 info_pel_com">
		<ul>
		<foreach="$option as $key=>$value">
			<li>
				<div class="pel_img">
					<span>
						<a href="#"><img alt="" src="{$bw->vars['img_url']}/comment_pro.jpg"></a>
					</span>
				</div>
				<div class="info_com">
					<label>{$value->getName()}</label><span> - {$this->dateTimeFormatAgo($value->getPostDate())}</span>
					<p>
						<php>$value->setIntro(nl2br($value->getIntro())); </php>{$value->getIntro()}
					</p>
					<if="$value->getContent()">
					<div class="replay">
						<label>Memoryshop</label><span> - {$this->dateTimeFormatAgo($value->getLastUpdate())}</span>
						<p>
							{$value->getContent()}
						</p>
					</div>
					</if>	
				</div>
			</li>
			</foreach>
		</ul>
	
		<div class="col-md-12 col-sm-12 col-xs-12 text-right">
			<!--<a href="#" class="readmore">Xem tất cả &gt;&gt;</a> -->
		</div>
	
	</div>
</div>

EOF;
		return $BWHTML;
	}	


function getLogin($option=array()) {
		global $bw;
		
		$this->login=VSFactory::getUserLogin();

		$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ('raovats')->getChildren();

		$this->user=VSFactory::getUserLogin();

		$BWHTML .= <<<EOF

		<script>

			function login_ajax(){
				$.ajax({
				type:'POST',
				url: baseUrl+'users/do_login',
				data:$('#login').serialize(),
				cache: false,
					success: function(data){
						if(data==1){
							location.href='{$bw->base_url}';
						}else{
							$('.error').text(data);
						}
					}
					
				});
				return false;
			}

			function login_ajax_mo(){
				$.ajax({
				type:'POST',
				url: baseUrl+'users/do_login',
				data:$('#login_mo').serialize(),
				cache: false,
					success: function(data){
						if(data==1){
							location.href='{$bw->base_url}';
						}else{
							$('.error').text(data);
						}
					}
					
				});
				return false;
			}

			
	

		</script>

		

<li class="Register">
		<if="$this->user['name']">
			<div class="fix_login_a"><a href="javascript:void(0)"  style="border-right:none;">Chào: <span class='user_name'><a style="padding:0px;" href="{$bw->base_url}users/chang_info"><b>{$this->cut($this->user['name'],15)}</b></a></span></a><a class="log_out" href="{$bw->base_url}users/logout">thoát</a></div>
		<else />
			<a href="javascript:void(0)" class="loginLink" style="border-right:none;">đăng nhập</a>
		</if>
		<div class="login">	

			<form id="login">
				<div class="error"></div>
				<input name="email" type="text" class="form-control" placeholder="Email hoặc số điện thoại">
				<input name="password"  type="password" class="form-control" placeholder="Mật Khẩu">
				<a onclick="login_ajax()" style="width:100%" class="btn btn-success" >Đăng Nhập</a>
				<label>
					<input type="checkbox" checked>&nbsp; Ghi nhớ
				</label>
				<span class="forgotPass"><a onclick="$('.loginLink').trigger('click');" id="fakePass" href="#" style="color:#008A00;">Quên mật khẩu</a></span>	
				
				<hr style="margin:5px 0">
				<span class="Account"><a  onclick="$('.rescomment,.loginLink').trigger('click');" id="fakeSignin" href="javascript:void(0)" style="color:#008A00;"> TẠO TÀI KHOẢN</a></span>
			</form>
			
			<!-- Button Quên mật khẩu -->
				<button class="btn btn-primary" data-toggle="modal" data-target=".ForgotPass" id="ForgotPass" style="visibility:collapse;display:none;">Quên mật khẩu</button>
				<div class="modal ForgotPass fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="trigg_c close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">QUÊN MẬT KHẨU</h4>
							</div>
							<div class="modal-body">
								<form id="forgot_password">
									
									<div class="form-group">
										<label for="" class="label">Nhập email vào bên dưới để nhận mật khẩu:</label>
										<input name="email" type="text" class="form-control" placeholder="Nhập email của bạn">
									</div>
									<div class="form-group">
										<label for="" class="label">Mã bảo vệ:</label>
										<input type="text" class="form-control" placeholder="Mã bảo vệ" name="security">
										<div style="margin:10px;"><img id="change_cap2" src="{$bw->vars['board_url']}/vscaptcha/" />
										<a href="#" id="cap2" class="mamoi">refresh</a></div>
									</div>

									
									<div class="error error_fogot"></div>
									<div onclick="forgot_password()" class="form-res" style=""><button type="button" class="btn btn-success">LẤY LẠI MẬT KHẨU</button></div>
							    </form>
							</div>
						</div>
					</div>
				</div>

				<script>
					function forgot_password(){
						$('.error_fogot').html('Vui lòng đợi trong giây lát....');
						$.ajax({
					       type:'POST',
					       url: baseUrl+'users/do_forgot_password',
					       data:'ajax=1&'+$('#forgot_password').serialize(),
					       cache: false,
					            success: function(data){
					           		$('.error_fogot').html(data);
					           		$("#cap2").trigger('click');
					           		//$('#update_password').find('input[type=password]').val('');

					           }     
						            
						  });

						}

				</script>

				<script>
					$(document).ready(function () {
						$("#cap2").click(function(){
						
		                $("#change_cap2").attr("src",$("#change_cap2").attr("src")+"?a");
		                return false;
						});
					});
				</script>

				
			
			<!-- Button ĐĂNG KÝ TÀI KHOẢN -->



			<!-- Button login -->
			<button class="button_trigg_login btn btn-primary" data-toggle="modal" data-target=".login_pop" id="ForgotPass" style="visibility:collapse;display:none;"></button>
				<div class="login_pop modal  fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="trigg_c close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">ĐĂNG NHẬP</h4>
							</div>
							<div class="modal-body">
								<form id="login_mo">
								<div class="error"></div>
								<div class="form-group">
									<label for="" class="label">Email:</label>
									<input name="email" type="text" class="form-control" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="" class="label">Nhập mật khẩu của bạn:</label>
									<input  name="password" type="password" class="form-control" placeholder="Nhập mật khẩu của bạn">
								</div>
								</form>
								<div  class="form-res" style="margin-top:20px;"><button onclick="login_ajax_mo()" type="button" class="btn btn-success">Đăng nhập</button></div>
							</div>
						</div>
					</div>
				</div>





			<button class="btn btn-link" data-toggle="modal" data-target=".signin-modal" id="signin-modal" style="visibility:collapse;display:none;">TẠO TÀI KHOẢN</button>
			
		</div>
	</li>






EOF;
		return $BWHTML;
	}





function getSocial($option=array()){
		global $bw;
		
		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		//echo $url;exit();
		if($option=='home'){
		$url=$bw->base_url;	
		}
		
		$BWHTML .= <<<EOF
		
		<div class="wap_social">
			<div class="fb-like" data-href="{$url}" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
			<div class="google-plus"><g:plusone size="medium" href="{$url}"><g:plusone></div>
			<div class="tweeter"><a data-url="{$url}" href="https://twitter.com/share" class="twitter-share-button"></a></div>
			
			
		</div>
		<style>
			.wap_social div{
				float:left;
			}
			
		</style>
	<div id="fb-root"></div>		
	<script>
	$(document).ready(function() {
							
			(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
	
			
			(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			  
			 !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs'); 
		
		});
	</script>
			
	
			
			
EOF;
		return $BWHTML;
	}	
	
	
	


	
}
?>