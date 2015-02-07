<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_news extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsPrint;
$this->bw=$bw;
        $option['news']=Object::getObjModule('pages',$bw->input[0], '>0','',6);


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content">
    <div class="sitebar">
        
EOF;
if($option['cate']) {
$BWHTML .= <<<EOF

        <div class="sitebar_item">
            <ul>
                {$this->__foreach_loop__id_540977c6c7b0a($option)}
            </ul>
        </div>
        
EOF;
}

$BWHTML .= <<<EOF

        <div class="sitebar_item">
            <div class="lasted_title">{$this->getLang()->getWords('tin-noibat','Tin nổi bật')}</div>
            {$this->__foreach_loop__id_540977c6c7c66($option)}
        </div>
     </div>
    <div class="center">
        {$this->__foreach_loop__id_540977c6c7d80($option)}
        <div class="pager">
            {$option['paging']}
        </div>
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
function __foreach_loop__id_540977c6c7b0a($option=array())
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
        
                <li><a href="{$value->getCatUrl()}">{$value->getTitle()}</a></li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_540977c6c7c66($option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['news'])){
    foreach( $option['news'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                
EOF;
if($vsf_count==1) {
$BWHTML .= <<<EOF

                <div class="lasted_top">
                    <div class="title"><a href="{$value->getUrl($value->getModule())}">{$value->getTitle()}</a></div>
                    <div class="im"><a href="{$value->getUrl($value->getModule())}">{$value->createImageCache($value->getImage(),85,60,3)}</a></div>
                    <div class="intro">
                        {$this->cut($value->getIntro(),150)}
                    </div>
                </div>
                
EOF;
}

else {
$BWHTML .= <<<EOF

                <div class="lasted_item"><a href="{$value->getUrl($value->getModule())}">{$value->getTitle()}</a></div>
                
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
function __foreach_loop__id_540977c6c7d80($option=array())
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
        
        <div class="news_item">
            <div class="im"><a href="{$obj->getUrl($obj->getModule())}">{$obj->createImageCache($obj->getImage(),85,68,3)}</a></div>
            <div class="title"><a href="{$obj->getUrl($obj->getModule())}">{$obj->getTitle()} - <span>{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}</span></a></div>
            <div class="intro"><p>{$this->cut($obj->getIntro(),150)}</p></div>
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
//$this->catTitle=$option['cate_obj']->getTitle();
//$this->urlCate="{$this->bw->base_url}news/category/{$option['cate_obj']->getSlugId()}";
        $option['news']=Object::getObjModule('pages',$bw->input[0], '>0','',6);

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content">
        <div class="sitebar">
        
EOF;
if($option['cate']) {
$BWHTML .= <<<EOF

        <div class="sitebar_item">
            <ul>
                {$this->__foreach_loop__id_540977c6c8020($obj,$option)}
            </ul>
        </div>
        
EOF;
}

$BWHTML .= <<<EOF

        <div class="sitebar_item">
            <div class="lasted_title">Tin nổi bật</div>
            {$this->__foreach_loop__id_540977c6c8185($obj,$option)}
        </div>
     </div>
    <div class="center">
        <div class="title_detail">{$obj->getTitle()} - <span>{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}</span></div>
        {$obj->getContent()}
            
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

            <div class="other">
                <div class="other_title"><a>{$this->getLang()->getWords('tinlienquan','関連ニュース')}</a></div>
                <ul>
                    {$this->__foreach_loop__id_540977c6c8356($obj,$option)}
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
function __foreach_loop__id_540977c6c8020($obj="",$option=array())
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
        
                <li class="active"><a href="{$value->getCatUrl()}">{$value->getTitle()}</a></li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_540977c6c8185($obj="",$option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['news'])){
    foreach( $option['news'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                
EOF;
if($vsf_count==1) {
$BWHTML .= <<<EOF

                <div class="lasted_top">
                    <div class="title"><a href="{$value->getUrl($value->getModule())}">{$value->getTitle()}</a></div>
                    <div class="im"><a href="{$value->getUrl($value->getModule())}">{$value->createImageCache($value->getImage(),85,60,3)}</a></div>
                    <div class="intro">
                        {$this->cut($value->getIntro(),150)}
                    </div>
                </div>
                
EOF;
}

else {
$BWHTML .= <<<EOF

                <div class="lasted_item"><a href="{$value->getUrl($value->getModule())}">{$value->getTitle()}</a></div>
                
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
function __foreach_loop__id_540977c6c8356($obj="",$option=array())
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