<?php

class skin_products extends skin_objectpublic {



function sideBar($option = array()) {
    global $bw,$vsPrint;
    $this->bw = $bw;
 
    $option['ban']= $this->getAddon()->getBannerByCode("BANNER_PRO");

    $BWHTML .= <<<EOF


      <div class="side_bar">
          <div class="title_cate"><span></span>{$option['cate']->getTitle()}</div>
            <div class="main_cate">
              <ul id="menu" class="cate_mn">
                  <foreach="$option['cate']->children as $key=>$value">
                  <li><a href="{$value->getUrlCategory()}">{$value->getTitle()}</a>
                      <if="$value->children">
                      <ul >
                          <foreach="$value->children as $child2">
                            <li><a href="{$child2->getUrlCategory()}">{$child2->getTitle()}</a></li>
                          </foreach>
                      </ul>
                      </if>
                    </li>
                    </foreach>
                </ul>
            </div>
            <div class="ads">
              <foreach="$option['ban'] as $key=>$value">
                    <img  src="{$value->getCacheImagePathByFile($value->getImage(),1,1,1,1,1,1)}" class="img-resposive">
              </foreach>
            </div>
        </div><!--end side_bar-->
        
       
    
EOF;
  }



function showCategory($option = array()) {
		global $bw,$vsPrint;
		$this->bw = $bw;

    $bw->input['lazy']=0;
		
		$this->full_url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";




		$BWHTML .= <<<EOF




      <div class="primary">
        <div class="breakcrum">
            {$option['breakcrum']}
              <p class="clear"></p>
        </div>
      </div><!--end primary-->  
      <div class="clear"></div>
      {$this->sideBar($option)}
      
        <div class="main_content">

          <foreach="$option['cate']->children as $key=>$value">
          <if="$option['pageList'][$key]">
          <div class=" select_cate_de">
              <ul class="list_cate_child">
                  <li class="list_first"><if="$value->getFileId()"><span style="background:url({$value->getCacheImagePathByFile($value->getFileId(),1,1,1,1)})" ></span></if><a href="{$value->getUrlCategory()}">{$value->getTitle()}</a></li>
                    <span class="right">
                        <div class="s_left">
                          <foreach="$value->children as $ke=>$va">
                            <if="$vsf_count<=4"><li><a href="{$va->getUrlCategory()}">{$va->getTitle()}</a></li></if>
                          </foreach>
                          <div class="icon click_toggle"></div> 
                          <div class="clear"></div> 
                         </div> 
                        <div class="sub">       
                          <foreach="$value->children as $ke=>$va">
                            <if="$vsf_count>4"><li><a href="{$va->getUrlCategory()}">{$va->getTitle()}</a></li></if>
                          </foreach>
                          <div class="clear"></div>   
                        </div>
                      </span>
                    <div class="clear"></div>                             
                </ul>
                <div class="clear"></div>
                <div class="main_slide_ios single-item main_product main_category">
                    {$this->itemProduct($option['pageList'][$key])}
                </div>   
            </div><!--end select_se-->
            {$this->getItemProuctBySession()} 
            <div class="clear"></div>
            </if>
            </foreach>
        </div><!--end main_content-->
    
    
		
EOF;
	}



function showCategoryLevel4($option = array()) {
    global $bw,$vsPrint;

    $bw->input['lazy']=0;

    $this->bw = $bw;

    $this->brand=VSFactory::getMenus()->getCategoryGroup('brand')->getChildren();
      unset($option['size'][517]);

    
    $this->full_url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";




    $BWHTML .= <<<EOF
    

    <script type="text/javascript">
      $(document).ready(function() {
         $('.product_item_hot').slick({
          dots: true,
          infinite: true,
          speed: 300,
          slidesToShow: 2,
          slidesToScroll: 1,
          centerPadding: '60px'
        });
        
        setTimeout(function(){
          $('.product_item_hot .slick-active').first().addClass('slick-active-first');
        },500);
        
        $('.item,.slick-prev,.slick-next').click(function(){
          $('.product_item_hot .slick-active').removeClass('slick-active-first');
          $('.product_item_hot .slick-active').first().addClass('slick-active-first');
        })

        setInterval(function(){
          $('.product_item_hot .item').trigger('click');
        },100)
        
      });
    </script>


      <div class="primary">
        <div class="breakcrum">
            {$option['breakcrum']}
              <p class="clear"></p>
        </div>
      </div><!--end primary-->  
      <div class="clear"></div>
      {$this->sideBar($option)}
        
        <div class="main_content">
          <if="$option['hot']">
          <div class="wap_item_hot">
                <div class="top_sp">Top những sản phẩm bán chạy nhanh</div>
                <div class="product_item_hot">

                    <foreach="$option['hot'] as $key=>$value">
                    
                    <div class="item">
                      <div class="left">
                        <a href="{$value->getUrl('products')}">{$value->createImageCache($value->getImage(),145,145,3)}</a>
                        <h3><a href="{$value->getUrl('products')}">{$value->getTitle()}</a></h3>
                        </div>
                        <if="$value->getPromotion()"><div class="sale">{$this->numberFormat($value->getPrice()-$value->getPromotion())} đ</div></if>
                        <if="$value->getPrice()"><div class="price">{$this->numberFormat($value->getPrice())} đ</div></if>
                        <if="$value->getPromotion()"><div class="promotion">{$this->numberFormat($value->getPromotion())}đ</div></if>
                        <div class="clear"></div>
                    </div><!--end item-->
                    </foreach>
                </div><!--end product_item_hot-->
            </div><!--end wap_item_hot-->
            </if>
            
          <div class=" select_cate_de">
                <ul class="list_cate_child">
                  <if="$option['cateObj']"><li class="list_first"><a >{$option['cateObj']->getTitle()}</a></li></if>
                      
                      <div class="clear"></div>       
                </ul>
                <div class="clear"></div>
                <div class="main_product main_category main_cate_child">
                    {$this->itemProduct($option['pageList'])} 
                    <div class="clear"></div>
                    <div class="pager">
                        {$option['paging']}
                    </div>
                </div><!--end main_cate_child-->   
            </div><!--end select_se-->
            <div class="clear"></div>

            {$this->getItemProuctBySession()}
            
            
        </div><!--end main_content-->
    
    
    
EOF;
  }



function showDetail($obj, $option = array()) {
		global $bw, $vsPrint;
		$this->bw = $bw;

		
		/* $this->catTitle=$option['cate_obj']->getTitle();
		 $this->bw=$bw;
		 $this->urlCate="{$this->bw->base_url}products/category/{$option['cate_obj']->getSlugId()}";
		*/
		
     //print_r($obj);die;

     $bw->input['lazy']=0;

		$BWHTML .= <<<EOF
  

  <script>
          

          $(document).ready(function(){
                $('.slide_detail').bxSlider({
				  mode:'fade',	
                  pagerCustom: '#bx-pager'
                });
            });
        
        $(document).ready(function(){
          
        $(".slide_detail li img").elevateZoom({ tintOpacity:0.5});
        

          $("#tabs li").click(function() {
            $("#tabs li").removeClass('active');
            $(this).addClass("active");
            $(".tab_content").hide();
            var selected_tab = $(this).find("a").attr("href");
            $(selected_tab).fadeIn();
            return false;
          });
          
          setTimeout(function(){
            $('.first_tab').trigger('click');
          },400);
        }); 
        
       </script>
	   <script type="text/javascript">

			   
        


			</script>

  
    <div class="primary">
        <div class="breakcrum">
            {$option['breakcrum']}
              <p class="clear"></p>
        </div>
      </div><!--end primary-->  
      <div class="clear"></div>
      {$this->sideBar($option)}
		<div class="main_content">
     
          <div class=" select_cate_de">
              <ul class="list_cate_child">
                    <if="$option['cateObj']"><li class="list_first"><a ><h2>{$option['cateObj']->getTitle()}</h2></a></li></if>
                    <span class="right">
                        <div class="s_left">
                          <li><a class="icon_c" href="{$option['cateObj']->getUrlCategory()}">Xem tất cả những sản phẩm cùng danh mục</a></li>
                        </div> 
                          <div class="clear"></div> 
                         </div> 
                    </span>     
                    <div class="clear"></div>                             
                </ul>
                <div class="clear"></div>
                <script>
                 
          $(document).ready(function(){
            $("#tabs li").click(function() {
              $("#tabs li").removeClass('active');
              $(this).addClass("active");
              $(".tab_content").hide();
              var selected_tab = $(this).find("a").attr("href");
              $(selected_tab).fadeIn(1);
              return false;
            });
            
            setTimeout(function(){
              $('.first_tab').trigger('click');
            },400);
          }); 
          
                </script>
                <div class="main_product main_category main_cate_child">
                  <div class="wap_slide">
                        <ul class="slide_detail">
                           <li>{$obj->createImageCache($obj->getImage(),510,500,5)}</li>
                            <foreach="$option['files_list'] as $key=>$value">
                              <li>{$value->createImageCache($value,500,500,5)}</li>
                            </foreach>
                        </ul>
                        <div id="bx-pager"> 
                          <a data-slide-index="0" href="">{$obj->createImageCache($obj->getImage(),90,90,3)}</a>
                          <foreach="$option['files_list'] as $key=>$value">
                            <a data-slide-index="{$vsf_count}" href="">{$value->createImageCache($value,90,90,3)}</a>
                          </foreach>
                          
                        </div>
                    </div><!--end wap_slide--> 
                    <div class="right_footer">  
                        <h1>{$obj->getTitle()}</h1>{$obj->getLinkEdit($bw->input[0],$obj->getId())}  
                        <if="$obj->getPromotion()"><p class="style_p_p price">Giá bán: <span>{$this->numberFormat($obj->getPromotion())} đ</span></p></if>
                        <if="$obj->getPrice()"><p class="price_a price style_p_p">Giá thị trường: <span>{$this->numberFormat($obj->getPrice())}</span> đ</p></if>
                        <a onclick="addCart({$obj->getId()})" href="javascript:void(0)"><img src="{$bw->vars['img_url']}/button_order_detail.png" /></a>
          </div>
                  <if="$obj->getPromotion()">
                      <style> 
                          .right_footer .price_a span {
                            text-decoration: line-through;
                            font-size:17px;
                          }    
                      </style>
                  </if>

                    <div class="clear"></div>
                    <div class="w_content">
                      <ul class="list_tab" id="tabs">
                           <li><a class="first_tab" href="#tab1">Chi tiết sản phẩm</a></li>
                            <foreach="$option['payment_info'] as $key=>$value">
                             <li><a href="#tab{$key}">{$value->getTitle()}</a></li>
                             </foreach>
                             
                             <div class="clear"></div>
                        </ul>
                        <div class="clear"></div>
                        <div id="tabs_content_container">
                            <div id="tab1" class="tab_content first-child" style="display: block;">
                                <p>{$obj->getContent()}</p>
                            </div>
                            <foreach="$option['payment_info'] as $key=>$value">
                            <div id="tab{$key}" class="tab_content">
                                {$value->getCOntent()}
                            </div>
                            </foreach>
                        </div>
                        
                    </div>
                </div>   
            </div><!--end select_se-->
            <div class="clear"></div>
            <if="$option['other']">
            <div class="select_cate select_other">
              <ul class="list_cate_child">
                  <li class="list_first t_1 active"><a>Sản phẩm cùng danh mục</a></li><li class="list_first t_2"><a>Danh mục khác</a></li>
                  <div class="clear"></div>                             
                </ul>
                <div class="clear"></div>
                <div class="main_other main_product main_product_default">
                  {$this->itemProduct($option['other'])}   
                </div>
                <div class="main_other_dift main_product">
                  {$this->itemProduct($option['list_cate_diff'])}   
                </div>
                
            </div><!--end select_se-->
            </if>
            <div class="clear"></div>
            {$this->getItemProuctBySession()}
            
        </div><!--end main_content-->

        <script>    
            
          $(document).ready(function(){
            $(".t_1").click(function() {
                $('.t_1,.t_2').removeClass('active');
                $(this).addClass('active');
                $('.select_other').find('.main_product').hide();
                $('.select_other .main_other').fadeIn(1);
              }); 
           

              $(".t_2").click(function() {
                $('.t_1,.t_2').removeClass('active');
                $(this).addClass('active');
                $('.select_other').find('.main_product').hide();
                $('.select_other').find('.main_other_dift').fadeIn(1);
             }); 
            }); 

        </script>
		
EOF;
	}




function showDefault($option = array()) {
		global $bw,$vsPrint;

  
		$BWHTML .= <<<EOF

    <div class="primary">
        <div class="breakcrum">
            {$option['breakcrum']}
              <p class="clear"></p>
        </div>
      </div><!--end primary-->  
      <div class="clear"></div>
    <foreach="$option['cate'] as $key=>$value">
        <div class="clear"></div>
        <div class="select_cate">
          <ul class="list_cate_child">
              <li class="list_first"><span style="background:url({$value->getCacheImagePathByFile($value->getFileId(),1,1,1,1)})" ></span><a href="{$value->getUrlCategory()}">{$value->getTitle()}</a></li>
                <span class="right">
                  <div class="s_left">
                    <foreach="$value->children as $ke=>$va">
                      <if="$vsf_count<=6"><li><a href="{$va->getUrlCategory()}">{$va->getTitle()}</a></li></if>
                    </foreach>
                    <div class="icon click_toggle"></div> 
                    <div class="clear"></div> 
                   </div> 
                  <div class="sub">       
                    <foreach="$value->children as $ke=>$va">
                      <if="$vsf_count>6"><li><a href="{$va->getUrlCategory()}">{$va->getTitle()}</a></li></if>
                    </foreach>
                    <div class="clear"></div>   
                  </div>
                </span>
                <div class="clear"></div>                             
            </ul>
            <div class="clear"></div>
            <div class="main_product main_product_default">
              {$this->itemProduct($option['pageList'][$key])}   
            </div>
            
        </div><!--end select_se-->
  </foreach>



EOF;
  return $BWHTML;
	}
	

}
?>