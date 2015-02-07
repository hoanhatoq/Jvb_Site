<?php
if(!class_exists('skin_board_public'))
require_once ('./cache/skins/user/finance/skin_board_public.php');
class skin_addon extends skin_board_public {

//===========================================================================
// <vsf:getSocialLeft:desc::trigger:>
//===========================================================================
function getSocialLeft($url="") {global $bw;

$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//echo $url;exit();
if($option=='home'){
$url=$bw->base_url;
}


//--starthtml--//
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
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getNewBar:desc::trigger:>
//===========================================================================
function getNewBar($option="") {global $bw;
require_once CORE_PATH.'pages/pages.php';
$new=new pages();
$category=VSFactory::getMenus()->getCategoryGroup('news');
$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
$new->setCondition("status>0 and catId in ($ids)");
$new->setLimit(array(0,10));
$new->setOrder('`hit` DESC');
$option['list']=$new->getObjectsByCondition();
 $option['ban']= $this->getAddon()->getBannerByCode("BANNER_PRO");


//--starthtml--//
$BWHTML .= <<<EOF
        <article>
<div class="side_bar side_bar_right">
            <div class="title_cate"><span></span>Tin xem nhiều</div>
            <div class="main_cate">
{$this->__foreach_loop__id_53e648978f537($option)}
            </div>
            <div class="ads">
                {$this->__foreach_loop__id_53e648978f682($option)}
            </div>
        </div><!--end side_bar-->
</article>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e648978f537($option="")
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['list'])){
    foreach( $option['list'] as $value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <div class="item_new_right">
                <a href="{$value->getUrl($value->getModule())}">
                    {$value->createImageCache($value->getImage(),74,55,3)}
                        <h3>{$value->getTitle()}</h3>
                    </a>
                </div>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e648978f682($option="")
{
global $bw;
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
// <vsf:getItemProuctBySession:desc::trigger:>
//===========================================================================
function getItemProuctBySession($option="") {global $bw,$vsTemplate;


//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option['list234234']) {
$BWHTML .= <<<EOF

     
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

{$this->__foreach_loop__id_53e648978f882($option)}
        
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
function __foreach_loop__id_53e648978f882($option="")
{
global $bw,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['list'])){
    foreach( $option['list'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        

EOF;
if($value->getId()) {
$BWHTML .= <<<EOF

<div class="item">
        <a href="{$value->getUrl('products')}">{$value->createImageCache($value->getImage(),225,225,4)}</a>
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

            <div class="intro">
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
<div class="promotion"> {$this->numberFormat($value->getPromotion())} đ</div>
EOF;
}

$BWHTML .= <<<EOF

                <a onclick="addCart({$value->getId()})" class="order" href="javascript:void(0)"></a>
                <a class="detail" href="{$value->getUrl('products')}"></a>
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
// <vsf:getCategotyProduct:desc::trigger:>
//===========================================================================
function getCategotyProduct($option="") {global $bw;
$option['cate']=VSFactory::getMenus()->getCategoryGroup('products')->getChildren();



//--starthtml--//
$BWHTML .= <<<EOF
        <ul class="menu_f">
{$this->__foreach_loop__id_53e648978fe84($option)}
        </ul>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e648978fbbd($option="",$key='',$cate='',$child1='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($child1->children)){
    foreach( $child1->children as $child2 )
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
function __foreach_loop__id_53e648978fd07($option="",$key='',$cate='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($cate->children)){
    foreach( $cate->children as $child1 )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <ul >
                        <li class="title_sub"><a href="{$child1->getUrlCategory()}">{$child1->getTitle()}</a></li>
                       {$this->__foreach_loop__id_53e648978fbbd($option,$key,$cate,$child1)}
                    </ul>
                    
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e648978fe84($option="")
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['cate'])){
    foreach( $option['cate'] as $key=>$cate )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <li><span class="icon" style="background:url({$cate->getCacheImagePathByFile($cate->getFileId(),1,1,1,1)})" ></span><a href="{$cate->getUrlCategory()}">{$cate->getTitle()}</a>
            <ul>
                <div class="wap_sb">
                {$this->__foreach_loop__id_53e648978fd07($option,$key,$cate)}
                    <div class="clear"></div>
                    </div>
                </ul>
            </li>
            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getTags:desc::trigger:>
//===========================================================================
function getTags($obj="") {global $bw;

require_once CORE_PATH.'tags/tags.php';
//$option['category']=VSFactory::getMenus()->getCategoryGroup('products');
//$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
$tags=new tags();
//$tags->setCondition("status>0");
$tags->setCondition("`id` IN (SELECT `tagId` FROM `vsf_tagcontent` WHERE `contentId` ={$obj->getId()})");
 
//$tags->setOrder("`index`");
$this->list_tag=$tags->getObjectsByCondition();


//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($this->list_tag) {
$BWHTML .= <<<EOF

<div class="tag_detail"><span>Tag:</span>
{$this->__foreach_loop__id_53e648979005d($obj)}
</div>

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
function __foreach_loop__id_53e648979005d($obj="")
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($this->list_tag)){
    foreach( $this->list_tag as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <a  href="{$bw->base_url}products/tags/{$obj->getSlugId()}">{$obj->getTitle()} </a>
            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getBanner:desc::trigger:>
//===========================================================================
function getBanner($option="") {global $bw;
$option['slide']=Object::getObjModule('partners', 'banner_home', '>0');
//print_r(VSFactory::getMenus()->getCategoryGroup('banner_top'));die;


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="slide_home">
        <div id="slider_home">
            {$this->__foreach_loop__id_53e648979022e($option)}
            </div>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e648979022e($option="")
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['slide'])){
    foreach( $option['slide'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
    
EOF;
if($value->getImage()) {
$BWHTML .= <<<EOF

    {$value->createImageCache($value->getImage(),927,380,3)}
    
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
// <vsf:getMenuTop:desc::trigger:>
//===========================================================================
function getMenuTop($option=array()) {global $bw,$vsLang;
$this->bw = $bw;
$vsLang = VSFactory::getLangs();

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="clear"></div>
        <div class="menu_top">
        <ul>
                {$this->__foreach_loop__id_53e648979043a($option)}
                <div class="clear"></div>
            </ul>
        
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e648979043a($option=array())
{
global $bw,$vsLang;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['menu'])){
    foreach( $option['menu'] as $mn )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li class="{$mn->active}" ><a href="{$this->bw->base_url}{$mn->getUrl()}">{$mn->getTitle()}</a></li>
                
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getSocial:desc::trigger:>
//===========================================================================
function getSocial($option=array()) {global $bw;
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//echo $url;exit();
if($option=='home'){
$url=$bw->base_url;
}

//--starthtml--//
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
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getMenuBottom:desc::trigger:>
//===========================================================================
function getMenuBottom($option=array()) {global $bw,$vsLang;
$this->bw = $bw;
$vsLang = VSFactory::getLangs();

//--starthtml--//
$BWHTML .= <<<EOF
        <ul>
{$this->__foreach_loop__id_53e6489790631($option)}
</ul>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e6489790631($option=array())
{
global $bw,$vsLang;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option ['menu'])){
    foreach( $option ['menu'] as $mn  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li><a class="{$mn->active}" href="{$this->bw->base_url}{$mn->url}">{$mn->getTitle()}</a></li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getContact:desc::trigger:>
//===========================================================================
function getContact($option=array()) {
require_once CORE_PATH.'contacts/pcontacts.php';
$pc=new pcontacts();
$category=VSFactory::getMenus()->getCategoryGroup('contacts');
$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
$pc->setCondition("status>0 AND catId in($ids)");
$pc->setOrder("`index`");
$option['obj']=$pc->getOneObjectsByCondition();

global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <p>
EOF;
if($option['obj']) {
$BWHTML .= <<<EOF
{$option['obj']->getIntro()}
EOF;
}

$BWHTML .= <<<EOF
 </p>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getAnalytic:desc::trigger:>
//===========================================================================
function getAnalytic($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <p>Đang truy cập:<span><b>{$this->numberFormat($option['online'])}</b> | Tổng truy cập:<b>{$this->numberFormat($option['total'])}</b></span></p>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getProductCategory:desc::trigger:>
//===========================================================================
function getProductCategory($option=array()) {global $bw;
$this->bw=$bw;


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="home-listing">
            <div class="control">
                <ul class="nav nav-tabs tabs-left" id="menu">
                  {$this->__foreach_loop__id_53e648979084e($option)}
                  
                </ul>
            </div>
            
        </div><!-- end .home-listing -->
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e648979084e($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option ['category'])){
    foreach( $option ['category'] as $cate  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                  <li ><a href="{$this->bw->base_url}products/category/{$cate->getSlugId()}" >{$cate->getTitle()}</a></li>
                  
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getServiceHome:desc::trigger:>
//===========================================================================
function getServiceHome($option=array()) {global $bw;
$this->bw=$bw;
$option['ser']=Object::getObjModule('pages', 'services', '>0', '5', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="service_home">
    <div class="wrap_service_home">
        {$this->__foreach_loop__id_53e6489790a33($option)}
            <div class="ser_bott"></div>
        </div>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e6489790a33($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['ser'])){
    foreach( $option['ser'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <div class="service_item ser{$vsf_count}">
            <a href="{$obj->getUrl('services')}" class="im"></a>
                <a href="{$obj->getUrl('services')}" class="na">{$obj->getTitle()}</a>
            </div>
            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getNewsCategory:desc::trigger:>
//===========================================================================
function getNewsCategory($option=array()) {global $bw;
$this->bw=$bw;
$option ['category'] = VSFactory::getMenus ()->getCategoryGroup ( 'posts' )->getChildren();

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="news_sitebar cate_sitebar">
            <div class="title">Tin tức</div>
                <ul id="menu">
                {$this->__foreach_loop__id_53e6489790c0a($option)}
                </ul>
            </div>
           <div class="clear"></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e6489790c0a($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option ['category'])){
    foreach( $option ['category'] as $cat  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li><a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}">{$cat->getTitle()}</a></li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getCustomerSitebar:desc::trigger:>
//===========================================================================
function getCustomerSitebar($option=array()) {global $bw;
$this->bw=$bw;
$option['customers']=Object::getObjModule('pages', 'customers', '>0', '', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="news_sitebar cate_sitebar">
            <div class="title">Hỗ trợ khách hàng</div>
                <ul id="menu">
                {$this->__foreach_loop__id_53e6489790da7($option)}
                </ul>
            </div>
           <div class="clear"></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e6489790da7($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option ['customers'])){
    foreach( $option ['customers'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li><a href="{$obj->getUrl('customers')}">{$obj->getTitle()}</a></li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getServiceSitebar:desc::trigger:>
//===========================================================================
function getServiceSitebar($option=array()) {global $bw;
$this->bw=$bw;
$option['service']=Object::getObjModule('pages', 'services', '>0', '', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="news_sitebar cate_sitebar">
            <div class="title">Dịch vụ</div>
                <ul id="menu">
                {$this->__foreach_loop__id_53e6489790f44($option)}
                </ul>
            </div>
           <div class="clear"></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e6489790f44($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option ['service'])){
    foreach( $option ['service'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li><a href="{$obj->getUrl('services')}">{$obj->getTitle()}</a></li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getNewsSitebar:desc::trigger:>
//===========================================================================
function getNewsSitebar($option=array()) {global $bw;
$this->bw=$bw;
$option['news']=Object::getObjModule('posts', 'posts', '=2', '2', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="news_sitebar ">
            <div class="title">Những bài viết gần đây</div>
                
                {$this->__foreach_loop__id_53e6489791100($option)}
                <a class="viewall" href="{$bw->base_url}posts">Xem tất cả...</a>
                <div class="clear"></div>
                
            </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e6489791100($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['news'])){
    foreach( $option['news'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <div class="news_home_item">
                    <div class="na"><a href="{$obj->getUrl('posts')}">{$obj->getTitle()}<span> [{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}]</span></a></div>
                    <div class="intro">{$this->cut($obj->getIntro(),100)}</div>
                        
                    
                    <a class="detail" href="{$obj->getUrl('posts')}">Chi tiết</a>
                    <div class="clear"></div>
                </div>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getNewsHome:desc::trigger:>
//===========================================================================
function getNewsHome($option=array()) {global $bw;
$this->bw=$bw;
$option['news']=Object::getObjModule('pages', 'news', '=2', '2', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="col-md-12">
                    <h3 class="title-right1">Tin tức</h3>
                    <div class="box-news">                      
                         <ul class="list-news">
                            {$this->__foreach_loop__id_53e64897912b0($option)}            
                        </ul>
                        <div class="clr"></div>
                    </div>                        
                </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e64897912b0($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['news'])){
    foreach( $option['news'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                            <li>
                                <a href="{$obj->getUrl('news')}">{$obj->createImagecache($obj->getImage(),70,55)}</a>
                                <a href="{$obj->getUrl('news')}">{$obj->getTitle()}</a>
                               
                            </li>
                            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getVideoHome:desc::trigger:>
//===========================================================================
function getVideoHome($option=array()) {global $bw;
$this->bw=$bw;
$option['video']=Object::getObjModule('pages', 'videos', '>0', '', '');
$option['shift']=array_shift($option['video']);

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="row">
                    <div class="col-md-12">
                    <div class="box-video">
                        <h3 class="title-right">Video</h3>
                        
EOF;
if($option['shift'] ) {
$BWHTML .= <<<EOF

                        <iframe width="280" height="200" 
            src="http://www.youtube.com/embed/{$option['shift']->getcode()}" 
        frameborder="0" allowfullscreen>
        </iframe>
                        <h4>{$option['shift']->getTitle()}</h4>
                        
EOF;
}

$BWHTML .= <<<EOF

                        <ul class="list-video">
                            {$this->__foreach_loop__id_53e64897914d3($option)}
                        </ul> 
                        <div class="clr"></div>
                    </div>                                              
                </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e64897914d3($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['video'])){
    foreach( $option['video'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                            <li><a href="{$obj->getUrl('videos')}">{$obj->getTitle()}</a></li>
                            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getProjectHome:desc::trigger:>
//===========================================================================
function getProjectHome($option=array()) {global $bw;
$this->bw=$bw;
$option['project']=Object::getObjModule('pages', 'projects', '=2', '3', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="title_block2">Hình ảnh dự án</div>
            {$this->__foreach_loop__id_53e64897916aa($option)}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e64897916aa($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['project'])){
    foreach( $option['project'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <div class="pro_item">
            <div class="im"><a href="{$obj->getUrl('projects')}">{$obj->createImageCache($obj->getImage(),341,208)}</a></div>
                <div class="na"><a href="{$obj->getUrl('projects')}">{$obj->getTitle()}</a></div>
                <div class="intro">
{$this->cut($obj->getContent(),140)}
                </div>
                <a href="{$obj->getUrl('peojects')}" class="detail">Chi tiết</a>
            </div>
            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getAdsSitebar:desc::trigger:>
//===========================================================================
function getAdsSitebar($option=array()) {global $bw;
$this->bw=$bw;
$option['ads']=Object::getObjModule('pages', 'ads', '>0', '', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="ads_sitebar">
              {$this->__foreach_loop__id_53e648979186e($option)}
                
             </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e648979186e($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['ads'])){
    foreach( $option['ads'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
              <a href="">{$obj->createImageCache($obj->getImage(),304,93)}</a>
              
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getSearchHome:desc::trigger:>
//===========================================================================
function getSearchHome($option=array()) {global $bw;
$this->bw=$bw;
$option['video']=Object::getObjModule('videos', 'videos', '>0', '', '');

//--starthtml--//
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
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getSearchSitebar:desc::trigger:>
//===========================================================================
function getSearchSitebar($option=array()) {global $bw;
$this->bw=$bw;
$option['news']=Object::getObjModule('pages', 'ads', '>0', '', '');

//--starthtml--//
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
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getContactFooter:desc::trigger:>
//===========================================================================
function getContactFooter($option=array()) {require_once CORE_PATH.'contacts/pcontacts.php';
$pc=new pcontacts();
$category=VSFactory::getMenus()->getCategoryGroup('pcontacts');
$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
$pc->setCondition("status>-1 and catId in (94)");
//$pc->setOrder("`index`");
$option['obj']=$pc->getOneObjectsByCondition();

global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        {$option['obj']->getContent()}
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getSupport:desc::trigger:>
//===========================================================================
function getSupport($option=array()) {global $bw;
$this->bw=$bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sitebar_item support_sitebar">
<div class="support_sitebar_title"><h3>Hỗ trợ trực tuyến</h3></div>
{$this->__foreach_loop__id_53e6489791af3($option)}
<div class="line"></div>
<div class="sitebar_bott"></div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e6489791af3($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['support'])){
    foreach( $option['support'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class="yahoo">{$obj->getTitle()}:</br>
<a href="ymsgr:sendIM?{$obj->getYahoo()}"><img src="{$bw->vars['img_url']}/yahoo_online.png"  /></a>
<a href="{$obj->getSkype()}?chat"><img src="{$bw->vars['img_url']}/sky.png"  /></a>
<a>({$obj->getPhone()})</a>
</div>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getPromotionLeft:desc::trigger:>
//===========================================================================
function getPromotionLeft($option=array()) {global $bw;
$this->bw=$bw;
$option['ban']= $this->getAddon()->getBannerByCode("BANNER_LEFT_PRO");
//print_r($option['ban']);die;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="col-md-12 col_margin">
          <div class="capacity hide_mobile">
            <div class="box_capa">
              <h2>QUẢNG CÁO</h2>
            </div>
            <div class="boxCapaAd">
              {$this->__foreach_loop__id_53e6489791bd6($option)}
            </div>
          </div>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e6489791bd6($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['ban'])){
    foreach( $option['ban'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
             <img  src="{$value->getCacheImagePathByFile($value->getImage(),1,1,1,1,1,1)}">
  
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getPromotionBanner:desc::trigger:>
//===========================================================================
function getPromotionBanner($option=array()) {global $bw;
$this->bw=$bw;
$option['ban']= $this->getAddon()->getBannerByCode("BANNER_PRO");
//print_r($option['ban']);die;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option['ban']) {
$BWHTML .= <<<EOF

        <div class="col-md-12 col-xs-12 col-sm-5 wrapper borderall">
          <div class="promotion">
            <strong>KHUYẾN MÃI</strong>
          </div>
          <div class="col-md-12 col-xs-12 col-sm-12 smImg" id="padding">
{$this->__foreach_loop__id_53e6489791d68($option)}
          </div>
        </div>

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
function __foreach_loop__id_53e6489791d68($option=array())
{
global $bw;
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
// <vsf:getPageBottom:desc::trigger:>
//===========================================================================
function getPageBottom($option=array()) {global $bw;
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


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="con_footer">
        <div class="box box_0">
            <div class="title_box">Về công ty kim minh</div>
               {$this->__foreach_loop__id_53e6489791f86($option)}
            </div>
        {$this->__foreach_loop__id_53e6489792219($option)}
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e6489791f86($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['abouts'])){
    foreach( $option['abouts'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <p><a href="{$obj->getUrl($obj->getModule())}">{$obj->getTitle()}</a></p>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e64897920f7($option=array(),$key='',$value='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['list'][$key])){
    foreach( $option['list'][$key] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <p><a href="{$obj->getUrl($obj->getModule())}">{$obj->getTitle()}</a></p>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e6489792219($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['cate'])){
    foreach( $option['cate'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <div class="box box_{$vsf_count}">
            <div class="title_box">{$value->getTitle()}</div>
               {$this->__foreach_loop__id_53e64897920f7($option,$key,$value)}
            </div>
            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:Register:desc::trigger:>
//===========================================================================
function Register($option=array()) {global $bw;

//--starthtml--//
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
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getPostRaoVat:desc::trigger:>
//===========================================================================
function getPostRaoVat($option=array()) {global $bw;
$this->login=VSFactory::getUserLogin();
$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ('raovats')->getChildren();
$this->user=VSFactory::getUserLogin();

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="dk_news">

EOF;
if($this->login['id']) {
$BWHTML .= <<<EOF

<button class="btn btn-link" data-toggle="modal" data-target=".post_raovat">ĐĂNG TIN</button>

EOF;
}

else {
$BWHTML .= <<<EOF

<button class="btn btn-link" data-toggle="modal" data-target=".login_pop">ĐĂNG TIN</button>

EOF;
}
$BWHTML .= <<<EOF

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
{$this->__foreach_loop__id_53e6489792568($option)}
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
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e6489792568($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['cate'])){
    foreach( $option['cate'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<option value="{$value->getId()}">{$value->getTitle()}</option>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getComment:desc::trigger:>
//===========================================================================
function getComment($option=array()) {global $bw;
$this->user=VSFactory::getUserLogin();
$this->id=end(explode("-",$bw->input[2]));
if($bw->input[0]=='raovats')
$this->cl="col-md-8";
if($bw->input[0]=='products')
$this->cl="col-md-12";


//--starthtml--//
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

EOF;
if(!$this->user['id']) {
$BWHTML .= <<<EOF
<button onclick="location.href='{$bw->base_url}users/login_mobile'" type="button" class="button_login_mobile btn btn-info">Đăng nhập</button>
EOF;
}

$BWHTML .= <<<EOF

<button onclick="send_comment()" type="button" class="btn btn-info">Gửi</button>
</form>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 info_pel_com">
<ul>
{$this->__foreach_loop__id_53e6489792823($option)}
</ul>
<div class="col-md-12 col-sm-12 col-xs-12 text-right">
<!--<a href="#" class="readmore">Xem tất cả &gt;&gt;</a> -->
</div>
</div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53e6489792823($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option)){
    foreach( $option as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';$value->setIntro(nl2br($value->getIntro()));
    $BWHTML .= <<<EOF
        
<li>
<div class="pel_img">
<span>
<a href="#"><img alt="" src="{$bw->vars['img_url']}/comment_pro.jpg"></a>
</span>
</div>
<div class="info_com">
<label>{$value->getName()}</label><span> - {$this->dateTimeFormatAgo($value->getPostDate())}</span>
<p>
{$value->getIntro()}
</p>

EOF;
if($value->getContent()) {
$BWHTML .= <<<EOF

<div class="replay">
<label>Memoryshop</label><span> - {$this->dateTimeFormatAgo($value->getLastUpdate())}</span>
<p>
{$value->getContent()}
</p>
</div>

EOF;
}

$BWHTML .= <<<EOF

</div>
</li>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getLogin:desc::trigger:>
//===========================================================================
function getLogin($option=array()) {global $bw;
$this->login=VSFactory::getUserLogin();
$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ('raovats')->getChildren();
$this->user=VSFactory::getUserLogin();

//--starthtml--//
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

EOF;
if($this->user['name']) {
$BWHTML .= <<<EOF

<div class="fix_login_a"><a href="javascript:void(0)"  style="border-right:none;">Chào: <span class='user_name'><a style="padding:0px;" href="{$bw->base_url}users/chang_info"><b>{$this->cut($this->user['name'],15)}</b></a></span></a><a class="log_out" href="{$bw->base_url}users/logout">thoát</a></div>

EOF;
}

else {
$BWHTML .= <<<EOF

<a href="javascript:void(0)" class="loginLink" style="border-right:none;">đăng nhập</a>

EOF;
}
$BWHTML .= <<<EOF

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
//--endhtml--//
return $BWHTML;
}


}
?>