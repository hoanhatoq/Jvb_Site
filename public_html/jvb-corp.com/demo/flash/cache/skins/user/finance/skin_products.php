<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_products extends skin_objectpublic {

//===========================================================================
// <vsf:sideBar:desc::trigger:>
//===========================================================================
function sideBar($option=array()) {    global $bw,$vsPrint;
    $this->bw = $bw;
 
    $option['ban']= $this->getAddon()->getBannerByCode("BANNER_PRO");
    
//--starthtml--//
$BWHTML .= <<<EOF
        <div class="side_bar">
          <div class="title_cate"><span></span>{$option['cate']->getTitle()}</div>
            <div class="main_cate">
              <ul id="menu" class="cate_mn">
                  {$this->__foreach_loop__id_53d1c6858d07c($option)}
                </ul>
            </div>
            <div class="ads">
              {$this->__foreach_loop__id_53d1c6858d1d8($option)}
            </div>
        </div><!--end side_bar-->
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858cf98($option=array(),$key='',$value='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($value->children)){
    foreach( $value->children as $child2 )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                            <li><a href="{$child2->getUrlCategory()}">{$child2->getTitle()}</a></li>
                          
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858d07c($option=array())
{
    global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['cate']->children)){
    foreach( $option['cate']->children as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                  <li><a href="{$value->getUrlCategory()}">{$value->getTitle()}</a>
                      
EOF;
if($value->children) {
$BWHTML .= <<<EOF

                      <ul >
                          {$this->__foreach_loop__id_53d1c6858cf98($option,$key,$value)}
                      </ul>
                      
EOF;
}

$BWHTML .= <<<EOF

                    </li>
                    
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858d1d8($option=array())
{
    global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['ban'])){
    foreach( $option['ban'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <img  src="{$value->getCacheImagePathByFile($value->getImage(),1,1,1,1,1,1)}" class="img-resposive">
              
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showCategory:desc::trigger:>
//===========================================================================
function showCategory($option=array()) {global $bw,$vsPrint;
$this->bw = $bw;
    $bw->input['lazy']=0;
$this->full_url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



//--starthtml--//
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
          {$this->__foreach_loop__id_53d1c6858d742($option)}
        </div><!--end main_content-->
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858d46f($option=array(),$key='',$value='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($value->children)){
    foreach( $value->children as $ke=>$va )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                            
EOF;
if($vsf_count<=4) {
$BWHTML .= <<<EOF
<li><a href="{$va->getUrlCategory()}">{$va->getTitle()}</a></li>
EOF;
}

$BWHTML .= <<<EOF

                          
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858d5e5($option=array(),$key='',$value='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($value->children)){
    foreach( $value->children as $ke=>$va )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                            
EOF;
if($vsf_count>4) {
$BWHTML .= <<<EOF
<li><a href="{$va->getUrlCategory()}">{$va->getTitle()}</a></li>
EOF;
}

$BWHTML .= <<<EOF

                          
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858d742($option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['cate']->children)){
    foreach( $option['cate']->children as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
          
EOF;
if($option['pageList'][$key]) {
$BWHTML .= <<<EOF

          <div class=" select_cate_de">
              <ul class="list_cate_child">
                  <li class="list_first">
EOF;
if($value->getFileId()) {
$BWHTML .= <<<EOF
<span style="background:url({$value->getCacheImagePathByFile($value->getFileId(),1,1,1,1)})" ></span>
EOF;
}

$BWHTML .= <<<EOF
<a href="{$value->getUrlCategory()}">{$value->getTitle()}</a></li>
                    <span class="right">
                        <div class="s_left">
                          {$this->__foreach_loop__id_53d1c6858d46f($option,$key,$value)}
                          <div class="icon click_toggle"></div> 
                          <div class="clear"></div> 
                         </div> 
                        <div class="sub">       
                          {$this->__foreach_loop__id_53d1c6858d5e5($option,$key,$value)}
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
            
EOF;
}

$BWHTML .= <<<EOF

            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showCategoryLevel4:desc::trigger:>
//===========================================================================
function showCategoryLevel4($option=array()) {    global $bw,$vsPrint;
    $bw->input['lazy']=0;
    $this->bw = $bw;
    $this->brand=VSFactory::getMenus()->getCategoryGroup('brand')->getChildren();
      unset($option['size'][517]);
    
    $this->full_url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


    
//--starthtml--//
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
          
EOF;
if($option['hot']) {
$BWHTML .= <<<EOF

          <div class="wap_item_hot">
                <div class="top_sp">Top những sản phẩm bán chạy nhanh</div>
                <div class="product_item_hot">
                    {$this->__foreach_loop__id_53d1c6858da0b($option)}
                </div><!--end product_item_hot-->
            </div><!--end wap_item_hot-->
            
EOF;
}

$BWHTML .= <<<EOF

            
          <div class=" select_cate_de">
                <ul class="list_cate_child">
                  
EOF;
if($option['cateObj']) {
$BWHTML .= <<<EOF
<li class="list_first"><a >{$option['cateObj']->getTitle()}</a></li>
EOF;
}

$BWHTML .= <<<EOF

                      
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
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858da0b($option=array())
{
    global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['hot'])){
    foreach( $option['hot'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    
                    <div class="item">
                      <div class="left">
                        <a href="{$value->getUrl('products')}">{$value->createImageCache($value->getImage(),145,145,3)}</a>
                        <h3><a href="{$value->getUrl('products')}">{$value->getTitle()}</a></h3>
                        </div>
                        
EOF;
if($value->getPromotion()) {
$BWHTML .= <<<EOF
<div class="sale">{$this->numberFormat($value->getPrice()-$value->getPromotion())} đ</div>
EOF;
}

$BWHTML .= <<<EOF

                        
EOF;
if($value->getPrice()) {
$BWHTML .= <<<EOF
<div class="price">{$this->numberFormat($value->getPrice())} đ</div>
EOF;
}

$BWHTML .= <<<EOF

                        
EOF;
if($value->getPromotion()) {
$BWHTML .= <<<EOF
<div class="promotion">{$this->numberFormat($value->getPromotion())}đ</div>
EOF;
}

$BWHTML .= <<<EOF

                        <div class="clear"></div>
                    </div><!--end item-->
                    
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw, $vsPrint;
$this->bw = $bw;

/* $this->catTitle=$option['cate_obj']->getTitle();
 $this->bw=$bw;
 $this->urlCate="{$this->bw->base_url}products/category/{$option['cate_obj']->getSlugId()}";
*/
     //print_r($obj);die;
     $bw->input['lazy']=0;

//--starthtml--//
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
                    
EOF;
if($option['cateObj']) {
$BWHTML .= <<<EOF
<li class="list_first"><a ><h2>{$option['cateObj']->getTitle()}</h2></a></li>
EOF;
}

$BWHTML .= <<<EOF

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
                            {$this->__foreach_loop__id_53d1c6858ddce($obj,$option)}
                        </ul>
                        <div id="bx-pager"> 
                          <a data-slide-index="0" href="">{$obj->createImageCache($obj->getImage(),90,90,3)}</a>
                          {$this->__foreach_loop__id_53d1c6858df16($obj,$option)}
                          
                        </div>
                    </div><!--end wap_slide--> 
                    <div class="right_footer">  
                        <h1>{$obj->getTitle()}</h1>{$obj->getLinkEdit($bw->input[0],$obj->getId())}  
                        
EOF;
if($obj->getPromotion()) {
$BWHTML .= <<<EOF
<p class="style_p_p price">Giá bán: <span>{$this->numberFormat($obj->getPromotion())} đ</span></p>
EOF;
}

$BWHTML .= <<<EOF

                        
EOF;
if($obj->getPrice()) {
$BWHTML .= <<<EOF
<p class="price_a price style_p_p">Giá thị trường: <span>{$this->numberFormat($obj->getPrice())}</span> đ</p>
EOF;
}

$BWHTML .= <<<EOF

                        <a onclick="addCart({$obj->getId()})" href="javascript:void(0)"><img src="{$bw->vars['img_url']}/button_order_detail.png" /></a>
          </div>
                  
EOF;
if($obj->getPromotion()) {
$BWHTML .= <<<EOF

                      <style> 
                          .right_footer .price_a span {
                            text-decoration: line-through;
                            font-size:17px;
                          }    
                      </style>
                  
EOF;
}

$BWHTML .= <<<EOF

                    <div class="clear"></div>
                    <div class="w_content">
                      <ul class="list_tab" id="tabs">
                           <li><a class="first_tab" href="#tab1">Chi tiết sản phẩm</a></li>
                            {$this->__foreach_loop__id_53d1c6858e05e($obj,$option)}
                             
                             <div class="clear"></div>
                        </ul>
                        <div class="clear"></div>
                        <div id="tabs_content_container">
                            <div id="tab1" class="tab_content first-child" style="display: block;">
                                <p>{$obj->getContent()}</p>
                            </div>
                            {$this->__foreach_loop__id_53d1c6858e19e($obj,$option)}
                        </div>
                        
                    </div>
                </div>   
            </div><!--end select_se-->
            <div class="clear"></div>
            
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

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
            
EOF;
}

$BWHTML .= <<<EOF

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
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858ddce($obj="",$option=array())
{
global $bw, $vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['files_list'])){
    foreach( $option['files_list'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                              <li>{$value->createImageCache($value,500,500,5)}</li>
                            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858df16($obj="",$option=array())
{
global $bw, $vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['files_list'])){
    foreach( $option['files_list'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                            <a data-slide-index="{$vsf_count}" href="">{$value->createImageCache($value,90,90,3)}</a>
                          
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858e05e($obj="",$option=array())
{
global $bw, $vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['payment_info'])){
    foreach( $option['payment_info'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                             <li><a href="#tab{$key}">{$value->getTitle()}</a></li>
                             
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858e19e($obj="",$option=array())
{
global $bw, $vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['payment_info'])){
    foreach( $option['payment_info'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                            <div id="tab{$key}" class="tab_content">
                                {$value->getCOntent()}
                            </div>
                            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsPrint;
  

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="primary">
        <div class="breakcrum">
            {$option['breakcrum']}
              <p class="clear"></p>
        </div>
      </div><!--end primary-->  
      <div class="clear"></div>
    {$this->__foreach_loop__id_53d1c6858e7ab($option)}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858e4cb($option=array(),$key='',$value='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($value->children)){
    foreach( $value->children as $ke=>$va )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                      
EOF;
if($vsf_count<=6) {
$BWHTML .= <<<EOF
<li><a href="{$va->getUrlCategory()}">{$va->getTitle()}</a></li>
EOF;
}

$BWHTML .= <<<EOF

                    
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858e62b($option=array(),$key='',$value='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($value->children)){
    foreach( $value->children as $ke=>$va )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                      
EOF;
if($vsf_count>6) {
$BWHTML .= <<<EOF
<li><a href="{$va->getUrlCategory()}">{$va->getTitle()}</a></li>
EOF;
}

$BWHTML .= <<<EOF

                    
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858e7ab($option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['cate'])){
    foreach( $option['cate'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <div class="clear"></div>
        <div class="select_cate">
          <ul class="list_cate_child">
              <li class="list_first"><span style="background:url({$value->getCacheImagePathByFile($value->getFileId(),1,1,1,1)})" ></span><a href="{$value->getUrlCategory()}">{$value->getTitle()}</a></li>
                <span class="right">
                  <div class="s_left">
                    {$this->__foreach_loop__id_53d1c6858e4cb($option,$key,$value)}
                    <div class="icon click_toggle"></div> 
                    <div class="clear"></div> 
                   </div> 
                  <div class="sub">       
                    {$this->__foreach_loop__id_53d1c6858e62b($option,$key,$value)}
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
  
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>