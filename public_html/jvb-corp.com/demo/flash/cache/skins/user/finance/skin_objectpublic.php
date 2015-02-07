<?php
if(!class_exists('skin_board_public'))
require_once ('./cache/skins/user/finance/skin_board_public.php');
class skin_objectpublic extends skin_board_public {

//===========================================================================
// <vsf:getItemProuctBySession:desc::trigger:>
//===========================================================================
function getItemProuctBySession($option=array()) {global $bw,$vsTemplate;

require_once CORE_PATH . 'products/products.php';
$pr=new products();

//$pr->setFieldsString('id,price,promotion,title,mUrl');
//$pr->setFieldsString('id,price,promotion,title,mUrl');
$id=$_COOKIE['obj_visit'];
if(isset($_SESSION['obj_visit_delete'])){
foreach ($_SESSION['obj_visit_delete'] as $key => $value) {
$id_arr=explode(",",$id);
foreach ($id_arr as $k => $v) {
if($value==$v)
unset($id_arr[$k]);
}
}
$id=implode(",",$id_arr);
setcookie("obj_visit",implode(",",$id_arr), time()+3600*24000,"/");
unset($_SESSION['obj_visit_delete']);
}
if($id){
$pr->setCondition("status > 0 AND `id` in($id) ");
$option['list']=$pr->getObjectsByCondition();
}
$bw->input['lazy']=0;
//pr($_COOKIE);die;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option['list']) {
$BWHTML .= <<<EOF

<div class="clear"></div>  
<div class="list_session select_cate_de">
              <ul class="list_cate_child">
                  <li class="list_first"><a >Sản phẩm bạn đã xem qua</a></li><div class="clear"></div>                             
                </ul>
                <div class="clear"></div>
                <div class="
EOF;
if(count($_SESSION['obj_visit'])>4) {
$BWHTML .= <<<EOF
single-item-session
EOF;
}

$BWHTML .= <<<EOF
 product-session main_product main_category">
                    {$this->itemProduct($option['list'])}
                </div>   
            </div><!--end select_se-->
        <div class="clear"></div>

EOF;
}

$BWHTML .= <<<EOF

<script>
$(document).ready(function(){
$('.list_session').find('.item').append('<div onclick="remove_ss(this)" class="remove"></div>');
})
function remove_ss(obj){
var id=$(obj).parent().attr('data-id');
$.ajax({
type : 'POST',
url : baseUrl + 'products/remove_session',
data : 'ajax=1&id='+id+'',
success : function(data) {
$(obj).parent().remove();
}
});
}
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw;
echo 1233;exit();

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:loadItemProductByHot:desc::trigger:>
//===========================================================================
function loadItemProductByHot($option=array()) {global $bw;

$this->mobile=0;
$detect = new Mobile_Detect;
if ($detect->isMobile() ||  $detect->isTablet()  ) {
$this->mobile=1;
}

foreach ($option as $key => $value) {
$option[$key]=$value;
$catobj=VSFactory::getMenus()->getCategoryById($value->getCatId());
$option[$key]->urlseo=$bw->base_url.$catobj->getSlug()."/".$value->getSlug().".html";
}


//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_53d1c68589387($option)}
        
EOF;
}

$BWHTML .= <<<EOF

<script>
$('.main_product .item').hover(function(){
var h=$(this).height();
$(this).find('.intro').stop().animate({'top':0},400);
},function(){
$(this).find('.intro').stop().animate({'top':'100%'},400);
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c68589387($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option)){
    foreach( $option as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<script type="text/javascript">
$(document).ready(function(){
$("a#link_tip_{$value->getId()}").easyTooltip({
useElement: "tool_tip_{$value->getId()}"   
});
});
</script>

EOF;
if($value->getId()) {
$BWHTML .= <<<EOF

<div class="item">
        <a id="link_tip_{$value->getId()}" >{$value->createImageCache($value->getImage(),175,175,3)}</a>
            <h3><a href="{$value->urlseo}">{$value->getTitle()}</a></h3>
            
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
<div class="promotion">{$this->numberFormat($value->getPromotion())} đ</div>
EOF;
}

$BWHTML .= <<<EOF

          <div id="tool_tip_{$value->getId()}" class="tooltip" style="display:none" >
<div class="main_tooltip">{$value->getIntro()}</div>
        </div>
        </div>
        
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
// <vsf:itemProduct:desc::trigger:>
//===========================================================================
function itemProduct($option=array()) {global $bw;

$this->mobile=0;
$detect = new Mobile_Detect;
if ($detect->isMobile() ||  $detect->isTablet()  ) {
$this->mobile=1;
}


//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_53d1c68589610($option)}
    
EOF;
}

else {
$BWHTML .= <<<EOF

    <div>Dữ liệu đang được cập nhật....</div>    
        
EOF;
}
$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c68589610($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option)){
    foreach( $option as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        

EOF;
if($value->getId()) {
$BWHTML .= <<<EOF

<script type="text/javascript">
$(document).ready(function(){
$("a#link_tip_{$value->getId()}").easyTooltip({
useElement: "tool_tip_{$value->getId()}"   
});
});
</script>
<div data-id="{$value->getId()}" class="item">
        <a href="{$value->getUrl('products')}" id="link_tip_{$value->getId()}" >{$value->createImageCache($value->getImage(),225,225,4)}</a>
            <h3><a href="{$value->getUrl('products')}">{$value->getTitle()}</a></h3>
            
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
<div class="promotion">{$this->numberFormat($value->getPromotion())} đ</div>
EOF;
}

$BWHTML .= <<<EOF

        <div id="tool_tip_{$value->getId()}" class="tooltip" style="display:none" >
<div class="main_tooltip">{$value->getIntro()}</div>
        </div>
        </div>
        
        
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
// <vsf:showPopupKM:desc::trigger:>
//===========================================================================
function showPopupKM($obj="") {global $bw;
$bw->input['ajax']=1;
$obj=Object::getObjModule('pages', 'popup_km', '>0', '',1);

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($obj) {
$BWHTML .= <<<EOF

<img width="100%"  src="{$obj->getCacheImagePathByFile($obj->getImage(),1,1,1,1,1,1)}">

EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="center">
            <h3 class="navigator">
                      {$option['breakcrum']}
                </h3>
                <h1 class="main_title">{$obj->getTitle()}</h1>
                <div class="detail_text">                
        <!--<h1>Công ty TNHH MTV TM-DV Huỳnh Gia Khang<span>(2/2/2012)</span></h1>-->
                    <p>{$obj->getContent()}</p>
                    <!--
                    <div class="other">
                        <h3 class="other_title">Các tin khác</h3>
                        <a href="#">Công ty TNHH MTV TM-DV Huỳnh Gia Khang<span>(2/2/2012)</span></a>
                        <a href="#">Công ty TNHH MTV TM-DV Huỳnh Gia Khang<span>(2/2/2012)</span></a>
                        <a href="#">Công ty TNHH MTV TM-DV Huỳnh Gia Khang<span>(2/2/2012)</span></a>
                        <a href="#">Công ty TNHH MTV TM-DV Huỳnh Gia Khang<span>(2/2/2012)</span></a>
                        <a href="#">Công ty TNHH MTV TM-DV Huỳnh Gia Khang<span>(2/2/2012)</span></a>
                    </div>
-->
                </div>
                
                       
            </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showEmail:desc::trigger:>
//===========================================================================
function showEmail($content="") {global $bw,$vsPrint;
$lang = VSFactory::getLangs ();
$copyright_left = VSFactory::getSettings ()->getSystemKey ( "copyright_left", "092 2727 939", "configs" );


//--starthtml--//
$BWHTML .= <<<EOF
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>{$bw->vars ['global_websitename']}</title>
<style>
h1,h2,h3,h4,p{margin:0px;padding:0px}
table{
border-collapse:collapse;
}
ul.menu_top li.last {background: none repeat scroll 0% 0% transparent;}
.footer a{text-decoration: none; outline: none; }
</style>
</head>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0"
marginheight="0" marginwidth="0" bgcolor="#ffffff">
<div marginheight="0" marginwidth="0" bgcolor="#FFFFFF">
<table width="650" height="122" cellspacing="0" cellpadding="0" border="0" align="center">
  <tbody><tr>
    <td colspan="6"><a target="_blank" href="{$bw->base_url}"><img  border="0"  src="{$bw->vars['board_url']}/images/logo.png"></a></td>
  </tr>
</tbody></table>
<table width="650" height="auto" cellspacing="0" cellpadding="0" border="0" align="center">
  <tr>
    <td style="border:15px solid #ccc;padding:30px;display:block">
$content</td>
  </tr>
</tbody></table>
<table width="650" cellspacing="0" cellpadding="0" border="1" align="center" frame="BOX" rules="NONE" style="display: block; margin-top: 10px;">
  <tbody><tr>
    <td height="10px" style="padding:10px;border:0" class="footer">{$copyright_left}</td>
  </tr>
</tbody></table><div class="yj6qo"></div><div class="adL">
</div></div>
</body>
</html>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showMore:desc::trigger:>
//===========================================================================
function showMore($option=array(),$count=4) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        {$this->__foreach_loop__id_53d1c685899db($option,$count)}
<script type="text/javascript">
var tallest = 0
jQuery(document).ready(function(){
$(".grid-item-info").each(function(){
if ($(this).height() > tallest)
tallest = $(this).height()
})
if (tallest > 0) {
$(".grid-item-info").each(function(){
$(this).css("min-height",tallest);
})
}
})
</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c685899db($option=array(),$count=4)
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option)){
    foreach( $option as $value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';$last = $vsf_count%$count==0?' last':'';
    $BWHTML .= <<<EOF
        

<div class="grid-item$last">
<h3 class="item-title"><a href="{$value->getUrl('products')}" title="{$value->getTitle()}">{$value->getTitle()}</a></h3>
<div class="grid-item-image">
<a href="{$value->getUrl('products')}">
{$value->createImageCache($value->getImage(),210,162,3)}
</a>
</div>
<div class="grid-item-code">MSP: <span>{$value->getCode()}</span></div>
<div class="grid-item-info">{$this->cut($value->getIntro(),150)}</div>
<div class="grid-item-price-order">
<div class="item-price">
<span>{$value->getPrice(true)}</span> 
EOF;
if($value->getPrice()) {
$BWHTML .= <<<EOF
{$this->getLang()->getWords('global_currency','VNĐ')}
EOF;
}

$BWHTML .= <<<EOF

</div>
<div class="item-order"><a href="{$value->getUrl('products')}" >Đặt hàng</a></div>
<div class="clear"></div>
</div>
</div>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showCateAjax:desc::trigger:>
//===========================================================================
function showCateAjax($option=array(),$count=4) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option['list']) {
$BWHTML .= <<<EOF

<div id="thenho1" class="tab-pane active">
<div class="row">
{$this->itemProduct($option['list'])}
</div>
<div class="col-md-12 text-right">
<a href="{$option['obj_cate']->getCatUrl()}">Xem tất cả &gt;&gt;</a> 
</div>
</div>
<!--end the nho-->

EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}


}
?>