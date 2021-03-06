<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_posts extends skin_objectpublic {

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
        <div class="content">
    <div class="center">
        <div class="page_title">Tin tức</div>
            
            
            
            {$this->__foreach_loop__id_53d1c6858c1b3($option)}
            
            
            <div class="clear"></div>
            <div class="page">
                {$option['paging']}
            </div>
        </div>
         <div class="sitebar">
         {$this->getAddon()->getHtml()->getNewsCategory($option)}
        {$this->getAddon()->getHtml()->getSearchSitebar($option)}
            {$this->getAddon()->getHtml()->getAdsSitebar($option)}
            {$this->getAddon()->getHtml()->getNewsSitebar($option)}
             
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
function __foreach_loop__id_53d1c6858c1b3($option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['pageList'])){
    foreach( $option['pageList'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <div class="project_item">
            <div class="im"><a href="{$obj->getUrl('posts')}">{$obj->createImageCache($obj->getImage(),356,208)}</a></div>
                <div class="na"><a href="{$obj->getUrl('posts')}">{$obj->getTitle()}</a></div>
                <div class="time">{$this->dateTimeFormat($obj->getPostDate(),'d/m/Y')}</div>
                <div class="intro">
                {$this->cut($obj->getIntro(),100)}
                </div>
                <a href="{$obj->getUrl('posts')}" class="detail">Chi tiết</a>
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
$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");
$this->catTitle=$option['cate_obj']->getTitle();
$this->urlCate="{$this->bw->base_url}posts/category/{$option['cate_obj']->getSlugId()}";

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content">
    <div class="center">
        <div class="page_title">Tin tức</div>
            <div class="page_detail">
            <div class="title_detail">{$obj->getTitle()}</div>
            <div class="time_detail">Ngày đăng: {$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}</div>
           {$obj->getContent()}
           
EOF;
if($option['other'] ) {
$BWHTML .= <<<EOF

           <div class="other">
           <p class="title_other">Các tin liên quan</p>
           <ul>
           {$this->__foreach_loop__id_53d1c6858c3a8($obj,$option)}
           </ul>
           </div>
           
EOF;
}

$BWHTML .= <<<EOF

             </div>  
            
                       
            <div class="clear"></div>
        </div>
         <div class="sitebar">
         {$this->getAddon()->getHtml()->getNewsCategory($option)}
        {$this->getAddon()->getHtml()->getSearchSitebar($option)}
            {$this->getAddon()->getHtml()->getAdsSitebar($option)}
            {$this->getAddon()->getHtml()->getNewsSitebar($option)}
             
        </div>
    <div class="clear"></div>
        
    </div>
<script>
var urlcate= '{$this->urlCate}';
</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6858c3a8($obj="",$option=array())
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
        
           <li><a href="{$other->getUrl('posts')}">{$other->getTitle()} <span>Ngày đăng: {$this->dateTimeFormat($other->getPostDate(),'d/m/y')}</span></a></li>
           
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>