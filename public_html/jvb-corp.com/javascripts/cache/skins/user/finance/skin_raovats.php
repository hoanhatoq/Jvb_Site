<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_raovats extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw;
$this->login=VSFactory::getUserLogin();
$this->mobile=0;
$detect = new Mobile_Detect;
if ($detect->isMobile()) {
$this->mobile=1;
}


//--starthtml--//
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
{$this->__foreach_loop__id_53d1c685902f4($option)}
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

EOF;
if($this->mobile==0) {
$BWHTML .= <<<EOF

{$this->showItem($option['pageList'])}

EOF;
}

else {
$BWHTML .= <<<EOF

{$this->showItemMobile($option['pageList'])}

EOF;
}
$BWHTML .= <<<EOF

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
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c685902f4($option=array())
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
        
<li><a href="{$value->getCatUrl()}">{$value->getTitle()}</a></li>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw;
$this->login=VSFactory::getUserLogin();
//print_r($obj);die;

//--starthtml--//
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
{$this->__foreach_loop__id_53d1c68590613($obj,$option)}
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

EOF;
if($obj->getPrice()) {
$BWHTML .= <<<EOF
<span>{$this->numberFormat($obj->getPrice())} đ</span>
EOF;
}

$BWHTML .= <<<EOF

</div>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 wrapper_content" id="padding">
<!--images product-->

EOF;
if($obj->getImage()>0) {
$BWHTML .= <<<EOF

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

EOF;
}

$BWHTML .= <<<EOF

<!--description product-->
<div class="col-md-7 col-sm-12 col-xs-12 colMargintop">
<div class="col-md-12 col-sm-12 col-xs-12 descript_pro">
<h3>{$obj->getTitle()}</h3>

EOF;
if($obj->getPrice()) {
$BWHTML .= <<<EOF
<p class="price_pro">Giá: <span>{$this->numberFormat($obj->getPrice())} đ</span></p>
EOF;
}

$BWHTML .= <<<EOF

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


EOF;
if($option['other']) {
$BWHTML .= <<<EOF

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

EOF;
}

$BWHTML .= <<<EOF

<!--end discussionListItems-->
</div>
<!--end wrapper_content-->
</div>
</div>
<!--end content rao vặt-->
</div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c68590613($obj="",$option=array())
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
        
<li><a href="{$value->getCatUrl()}">{$value->getTitle()}</a></li>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showItem:desc::trigger:>
//===========================================================================
function showItem($option=array()) {global $bw;
$this->login=VSFactory::getUserLogin();

//--starthtml--//
$BWHTML .= <<<EOF
        {$this->__foreach_loop__id_53d1c68590902($option)}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c68590902($option=array())
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

EOF;
if($value->getPrice()) {
$BWHTML .= <<<EOF
<span><b>{$this->numberFormat($value->getPrice())}</b> đ</span>
EOF;
}

$BWHTML .= <<<EOF

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

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showItemMobile:desc::trigger:>
//===========================================================================
function showItemMobile($option=array()) {global $bw;
$this->login=VSFactory::getUserLogin();

//--starthtml--//
$BWHTML .= <<<EOF
        {$this->__foreach_loop__id_53d1c68590b27($option)}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c68590b27($option=array())
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

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>