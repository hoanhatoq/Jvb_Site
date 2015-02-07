<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_pages extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsPrint;
$this->bw=$bw;
$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");
$cateId = $option['obj']?$option['obj']->getId():0;



//--starthtml--//
$BWHTML .= <<<EOF
        <div id="primary">
<div class="productNew">
<div class="productNew-detai-box productNew-box">
<div class="content_news">
{$this->__foreach_loop__id_5409779a7c497($option)}
</div><!--end content_news-->
{$option['paging']}
</div>
</div>
<!-- end .productNew-box--> 
</div>
<!-- end #primary-->
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_5409779a7c497($option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['pageList'])){
    foreach( $option['pageList'] as $key=>$obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class="item-search news_home_item"> 
<h3><a href="{$obj->getUrl($bw->input[0])}">{$obj->getTitle()} </a></h3>
<p>{$this->cut($obj->getContent(),100)}</p>
<div class="clear_left"></div>
</div>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw,$vsPrint;
$this->bw=$bw;
$this->catTitle=$option['cate_obj']->getTitle();
$this->urlCate="{$this->bw->base_url}$bw->input[0]/category/{$option['cate_obj']->getSlugId()}";

$option['ban']= $this->getAddon()->getBannerByCode("BANNER_PRO");

//if($bw->input[0]=='abouts')
$option['list_detail']=Object::getObjModule('pages',$bw->input[0], '>0');
if($bw->input[0]=='development'){
unset($option['list_detail']);
}


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content">

EOF;
if($option['list_detail']) {
$BWHTML .= <<<EOF

<div class="sitebar">
        <div class="sitebar_item">
            <ul id="menu" >
                {$this->__foreach_loop__id_5409779a7c6f2($obj,$option)}
            </ul>
        </div>
       
     </div>
 
EOF;
}

$BWHTML .= <<<EOF

    <div class="center">
    <div class="title_detail">{$obj->getTitle()}

EOF;
if($bw->input[0]!='abouts') {
$BWHTML .= <<<EOF


EOF;
if($bw->input[0]!='services') {
$BWHTML .= <<<EOF

<span>{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}</span>

EOF;
}

$BWHTML .= <<<EOF


EOF;
}

$BWHTML .= <<<EOF

</div>
       {$obj->getContent()}
       
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

<div class="other">
            <div class="other_title"><a>{$this->getLang()->getWords('tinlienquan','関連ニュース')}</a></div>
                <ul>
                {$this->__foreach_loop__id_5409779a7c7f9($obj,$option)}
                </ul>
            </div>
        
EOF;
}

$BWHTML .= <<<EOF

    </div>
    <div class="clear"></div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_5409779a7c6f2($obj="",$option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['list_detail'])){
    foreach( $option['list_detail'] as $other  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<li><a href="{$other->getUrl($other->getModule())}">{$other->getTitle()}</a></li>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_5409779a7c7f9($obj="",$option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['other'])){
    foreach( $option['other'] as $other  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<li><a href="{$other->getUrl($other->getModule())}">{$other->getTitle()}</a></li>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>