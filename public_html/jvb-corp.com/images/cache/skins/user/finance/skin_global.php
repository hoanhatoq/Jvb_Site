<?php
if(!class_exists('skin_board_public'))
require_once ('./cache/skins/user/finance/skin_board_public.php');
class skin_global extends skin_board_public {

//===========================================================================
// <vsf:vs_global:desc::trigger:>
//===========================================================================
function vs_global() {global $bw, $vsLang;
//$vsLang = VSFactory::getLangs();
$total = count($_SESSION['vs_item_cart']);
//$this->service=Object::getObjModule('pages', 'services', '>0', '', '');
//$hotline = VSFactory::getSettings ()->getSystemKey ( "hotline", " 0938 269 089 - 0938 269 089", "configs" );
$google = VSFactory::getSettings ()->getSystemKey ( "google", " ", "configs" );
$facebook = VSFactory::getSettings ()->getSystemKey ( "facebook", " ", "configs" );
$tw = VSFactory::getSettings ()->getSystemKey ( "tw", " ", "configs" );
//$this->user=VSFactory::getUserLogin();
//$this->logo=Object::getObjModule('pages', 'img_setting', '>0','',1);
//$this->payment=Object::getObjModule('pages', 'payment', '>0');
//$this->support=Object::getObjModule('supports', 'supports', '>0');
$this->analytic = VSFactory::getSettings ()->getSystemKey ( "analytic", "", "configs" );
//$this->fanpage = VSFactory::getSettings ()->getSystemKey ( "fanpage", "", "configs" );
//$this->keyword_search = VSFactory::getSettings ()->getSystemKey ( "keyword_search", "", "configs" );
//$this->linkgioithieu = VSFactory::getSettings ()->getSystemKey ( "link_abouts", "", "configs" );
$this->banner_top = Object::getObjModule('pages', 'banner_top', '>0');
$this->news = Object::getObjModule('pages', 'news', '>0','',5);
$this->lang=$_SESSION['user']['language']['vsfcurrentLang']['code'];


//--starthtml--//
$BWHTML .= <<<EOF
        <script type="text/javascript">

$(document).ready(function(){
$('.bxslider').bxSlider({
 speed: 700,
 mode: 'fade',
 infiniteLoop: true,
 hideControlOnEnd: true,
 controls: true,
 pager: false,
auto: true
});
});
</script>

<div class="header">
<div class="wrapper_header">
    <div class="logo"><a href="{$bw->base_url}"><img style="width:95px;" src="{$bw->vars['img_url']}/logo_jvb.png" /></a>
<img class="i_slogan" src="{$bw->vars['img_url']}/img_slogan.png">
    </div>
<form id="from_search" action="{$bw->base_url}pages/search" class="button_ss form_search">
<input value="{$bw->input['keyword']}" name="keyword" class="key-word" type="text">
<input type="button" value="Search">
</form>
<script>
$(document).ready(function(){
$('.button_ss').click(function(){
var keyword=$('.key-word').val();
if(keyword==''){
$('.key-word').css({'border':'1px solid red'});
return false;
}
if(keyword.length<=3){
$('.key-word').css({'border':'1px solid red'});
return false;
}
$('#from_search').submit();
});
})
</script>
        
        <div class="lang">
<a href="{$bw->vars['board_url']}"><img class="flag_jp" width="40px" src="{$bw->vars['img_url']}/fl_jp.jpg" /></a>
<a href="{$bw->vars['board_url']}/vi"><img width="40px" src="{$bw->vars['img_url']}/fl_vi.jpg" /></a>
        <a href="{$bw->vars['board_url']}/en"><img  width="40px" src="{$bw->vars['img_url']}/fl_en.jpg" /></a>
        </div>
        <div class="clear"></div>
    </div>
</div>
{$this->getAddon()->getMenuTop()}
<div class="banner">
<div class="wrapper_banner">
    <ul class="bxslider">
    {$this->__foreach_loop__id_54114ad9e7fec()}
        </ul>
        <!--
        <object width="1000" height="395" data="{$bw->vars['img_url']}/slide_fl.swf"></object>
        -->
    </div>
</div>
<div class="news_content">
<marquee behavior="scroll" direction="left">
<ul>
{$this->__foreach_loop__id_54114ad9e816a()}
</ul>
</marquee>
</div>
{$this->SITE_MAIN_CONTENT}
<div class="footer">
<div class="wrapper_footer">
    <div class="company_name">{$this->getLang()->getWords('conpany_na','Công ty cổ phần JVB Việt Nam')}</div>
        <div class="company_address">{$this->getLang()->getWords('address_n','Số 32-34, Đường Đặng Văn Ngữ, Phường Phương Liên, Quận Đống Đa, Thành phố Hà Nội, Việt Nam')}</div>
        <div class="social">
        <a href="{$facebook}"><img src="{$bw->vars['img_url']}/face.png" /></a>
            <a href="{$google}"><img src="{$bw->vars['img_url']}/twitter.png" /></a>
            <a href=""><img src="{$bw->vars['img_url']}/print.png" /></a>
        </div>
        <div class="design_by">{$this->getLang()->getWords('design_by_','Copyright©2014 JVB Vietnam.All Rights reserved')} </div>
    </div>
</div>

{$this->analytic}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_54114ad9e7fec()
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($this->banner_top)){
    foreach( $this->banner_top as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <li>
            <div class="service_slide">
                <div class="title">{$value->getTitle()}</div>
                {$this->cut($value->getIntro(),250)}
<div class="readmore"><a href="{$value->getUrl($value->getModule())}">{$this->getLang()->getWords('read_more','Xem thêm')}</a></div>
                </div>
                <div class="im_slide">{$value->createImageCache($value->getImage(),1000,310,1)}</div>
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
function __foreach_loop__id_54114ad9e816a()
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($this->news)){
    foreach( $this->news as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<li><a href="">{$value->getTitle()}</a></li>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:addCSS:desc::trigger:>
//===========================================================================
function addCSS($cssUrl="",$media="") {$media = $media?"media='$media'":'';

//--starthtml--//
$BWHTML .= <<<EOF
        <link type="text/css" rel="stylesheet" href="{$cssUrl}.css"  $media/>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:importantAjaxCallBack:desc::trigger:>
//===========================================================================
function importantAjaxCallBack() {global $bw,$vsLang;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:addJavaScriptFile:desc::trigger:>
//===========================================================================
function addJavaScriptFile($file="",$type='file') {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($type=='cur_file') {
$BWHTML .= <<<EOF

<script type="text/javascript" src='{$bw->vars['cur_scripts']}/{$file}.js'></script>

EOF;
}

else {
$BWHTML .= <<<EOF


EOF;
if($type=='external') {
$BWHTML .= <<<EOF

<script type="text/javascript" src='{$file}'></script>

EOF;
}

else {
$BWHTML .= <<<EOF


EOF;
if($type=='file') {
$BWHTML .= <<<EOF

<script type="text/javascript" src='{$bw->vars['board_url']}/javascripts/{$file}.js'></script>

EOF;
}

$BWHTML .= <<<EOF


EOF;
}
$BWHTML .= <<<EOF


EOF;
}
$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:addJavaScript:desc::trigger:>
//===========================================================================
function addJavaScript($script="") {$BWHTML = "";

//--starthtml--//
$BWHTML .= <<<EOF
        <script language="javascript" type="text/javascript">
{$script}
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:addDropDownScript:desc::trigger:>
//===========================================================================
function addDropDownScript($id="") {$BWHTML = "";
//--starthtml--//

//--starthtml--//
$BWHTML .= <<<EOF
        ddsmoothmenu.init({
mainmenuid: "{$id}", //Menu DIV id
orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
classname: 'ddsmoothmenu-v', //class added to menus outer DIV
//customtheme: ["#804000", "#482400"],
contentsource: "markup", //"markup" or ["container_id", "path_to_menu_file"]
})
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:PermissionDenied:desc::trigger:>
//===========================================================================
function PermissionDenied($error="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <div class="red">
{$error}</div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:displayFatalError:desc::trigger:>
//===========================================================================
function displayFatalError($message="",$line="",$file="",$trace="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <div class="vs-common">
<div class="red" align="left" style="padding: 20px">
Error: {$message}<br />
Line: {$line}<br />
File: {$file}<br />
Trace: <pre>{$trace}</pre><br />
</div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:global_main_title:desc::trigger:>
//===========================================================================
function global_main_title() {global $bw, $vsPrint;
$BWHTML = "";
//--starthtml--//

//--starthtml--//
$BWHTML .= <<<EOF
        <span class="{$bw->input['module']}">{$vsPrint->mainTitle}</span>
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>