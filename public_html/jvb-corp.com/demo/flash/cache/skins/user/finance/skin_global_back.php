<?php
if(!class_exists('skin_board_public'))
require_once ('./cache/skins/user/finance/skin_board_public.php');
class skin_global_back extends skin_board_public {

//===========================================================================
// <vsf:vs_global:desc::trigger:>
//===========================================================================
function vs_global() {global $bw, $vsLang;
//$vsLang = VSFactory::getLangs();
$total = count($_SESSION['vs_item_cart']);
$this->cate = VSFactory::getMenus ()->getCategoryGroup ( 'products' )->getChildren();
//$this->service=Object::getObjModule('pages', 'services', '>0', '', '');

$this->user=VSFactory::getUserLogin();

//--starthtml--//
$BWHTML .= <<<EOF
        <style>
a:hover {
  cursor:pointer;
 }
</style>

<script>
function ajax_cate(id_cate,id_return){
if(!id_return)
id_return=id_cate;
$.ajax({
type:'GET',
url: baseUrl+'products/ajax_cate/'+id_cate+'',
cache: false,
success : function(data) {
$('#main_'+id_return).html(data);
}
});
}

</script>

<script type="text/javascript">
function addCart(id,number){
$.ajax({
type : 'POST',
url : baseUrl + 'orders/addcart',
data : 'ajax=1&id='+id+'',
success : function(data) {
if (data == 1) {
window.location.href = "{$bw->base_url}orders";
return false;
}
if (data == 0) {
alert('Sản phẩm đã hết thời gian đặt hàng');
return false;
}
alert('Có lỗi đặt hàng');
}
});
return false;
}
</script>


<script>
var username='{$this->user['name']}';
$('#openBtn').click(function(){
$('#myCreateAccount').modal({show:true})
});
$(document).ready(function () {
if(username){
$('.rg_detail_pro').remove();
}
$("#linkSignIn").click(function() {
//ẩn modal đang mở
$('#mySingIn').modal('toggle');
//hiện form đăng nhập
$('.signin-modal').modal();
});
$("#linkForgotPassword").click(function() {
//ẩn modal đang mở
$('.signin-modal').modal('toggle');
$('#mySingIn').modal('toggle');
//hiện form quên mật khẩu
$('.ForgotPass').modal();
});
});
</script>
<script>
$(document).ready(function() {
$().UItoTop({ inDelay: 200, outDelay: 200, scrollSpeed: 500 });
//$().UItoTop({ easingType: 'easeOutQuart' });
 });
</script>
<script>
$(document).ready(function() {
/*function scroll_if_anchor(href) {
href = typeof (href) == "string" ? href : $(this).attr("href");
// You could easily calculate this dynamically if you prefer
var fromTop = 50;
// If our Href points to a valid, non-empty anchor, and is on the same page (e.g. #foo)
// Legacy jQuery and IE7 may have issues: http://stackoverflow.com/q/1593174
if (href.indexOf("#") == 0) {
var $target = $(href);
// Older browser without pushState might flicker here, as they momentarily
// jump to the wrong position (IE < 10)
if ($target.length) {
$('html, body').animate({ scrollTop: $target.offset().top - fromTop });
if (history && "pushState" in history) {
history.pushState({}, document.title, window.location.pathname + href);
return false;
}
}
}
}
// When our page loads, check to see if it contains and anchor
scroll_if_anchor(window.location.hash);
// Intercept all anchor clicks
$("body").on("click", "a.click", scroll_if_anchor);
*/
$(".loginLink").click(function() {
//$("#login").slideToggle('500').css('display', 'block');
$("#login").toggle();
});
$("#login").mouseleave(function() {
//$("#login").slideToggle('500').css('display', 'block');
//$("#login").fadeOut();
});
$("#fakeSignin").click(function() {
$('#signin-modal').click();
});
$("#fakePass").click(function() {
$('#ForgotPass').click();
});
});
</script>
<script>
$(document).scroll(function () {
var y = $(this).scrollTop();
if (y > 300) {
$('.menusub').fadeIn();
} else {
$('.menusub').fadeOut();
}
});
</script>
{$this->getAddon()->getHtml()->Register()}
<header>
<div class="navbar navbar-inverse" role="navigation">
<div class="container">
<div class="navbar-header">
  <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
  </button>
  <a href="{$bw->base_url}" class="navbar-brand"><img class="logo" src="{$bw->vars['img_url']}/logo.png" alt=""/></a>
</div>
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right">
<li class="active"><a href="{$bw->base_url}">Trang chủ</a></li>
<li><a href="{$bw->base_url}raovats">rao vặt</a></li>
<li><a href="{$bw->base_url}deal">cùng mua</a></li>
{$this->getAddon()->getHtml()->getLogin()}
<li class="quick-cart">
<a href="{$bw->base_url}orders"></a>
</li>
</ul>
<form class="input-group navbar-left">
<input type="text" class="form-control" placeholder="Tìm kiếm">
<span class="input-group-btn">
<button class="btn btn-default" type="button"></button>
</span>
</form>
</div>
</div>
</div>
</header>
<!--end top_bar-->
<!--main content-->
<section>
<div class="menusub">
<ul class="nav nav-pills nav-stacked">
<li class="active"><a href="{$bw->base_url}">Trang Chủ</a></li>
<li><a href="{$bw->base_url}raovats">Rao Vặt</a></li>
<li><a href="{$bw->base_url}deal">Cùng Mua</a></li>
<li><a href="{$bw->base_url}contacts">Liên Hệ</a></li>
<li><a href="{$bw->base_url}news">Tin Tức</a></li>
<li><a href="{$bw->base_url}questions">Hỏi Đáp</a></li>
</ul>
</div>
<!--menu+slider-->
<div class="container">
<!--menu-->
<div class="row">
<div id="paddingright" class="col-md-3 col-sm-5 col-xs-12">
<div class="wtSubMenu">
<div class="tile double">
<a class="click" href="{$bw->base_url}products/category/the-nho-417">
<img alt="" src="{$bw->vars['img_url']}/icon-3.png">
<p>THẺ NHỚ</p>
</a>
</div>
<div style="background:#3366ff;" class="tile half">
<a class="click" href="{$bw->base_url}products/category/dau-doc-the-nho-456">
   <img alt="" src="{$bw->vars['img_url']}/icon-2.png">
   <p>ĐẦU ĐỌC THẺ NHỚ</p>
   </a>
   </div>
   
   <div style="background:#7f007f;" class="tile half violet">
<a class="click" href="{$bw->base_url}products/category/san-pham-khac-457">
  <img alt="" src="{$bw->vars['img_url']}/icon-4.png">
  <p>SẢN PHẨM KHÁC</p>
  </a>
  </div>
<div style="background:#ff0000;" class="tile red">
<a class="click" href="{$bw->base_url}products/category/usb-419">
<img alt="" src="{$bw->vars['img_url']}/icon-1.png">
<p>USB</p>
</a>
</div>
<div style="background:#e46c0a;" class="tile orange">
<a class="click" href="{$bw->base_url}products/category/ssd-443">
<img alt="" src="{$bw->vars['img_url']}/icon-5.png">
<p>SSD</p>
</a>
</div>
<div style="background:#f8a707;" class="tile nho">
<a class="click" href="{$bw->base_url}products/category/hdd-444">
<img alt="" src="{$bw->vars['img_url']}/icon-6.png">
<p>HDD</p>
</a>
</div>
</div>
<div class="phoneHotline"> 
<i style="color:#666666;" class="glyphicon glyphicon-earphone"></i>
<span class="hotlineTop">HOT LINE:</span>
<span class="phoneTop">0938 269 089 - 0938 269 089</span>
</div>
  
</div>
<!--end menu-->
<!--slider-->
<div class="col-md-8 col-sm-6 col-xs-12">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
<li data-target="#carousel-example-generic" data-slide-to="1"></li>
<li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
<div class="item active">
  <img src="{$bw->vars['img_url']}/banner2.jpg" alt="slider1">
</div>
<div class="item">
  <img src="{$bw->vars['img_url']}/banner1.jpg" alt="slider1">
</div>
<div class="item">
  <img src="{$bw->vars['img_url']}/banner3.jpg" alt="slider1">
</div>
  </div>
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
<span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
</div>
<!--end slider-->
<div class="col-md-1 col-sm-1" id="paddingleft">
<div class="contact">
<ul class="nav nav-pills nav-stacked">
<li><a href="{$bw->base_url}contacts">Liên Hệ</a></li>
<li><a href="{$bw->base_url}questions">Hỏi Đáp</a></li>
<li><a href="{$bw->base_url}news">Tin Tức</a></li>
<li><a href="{$bw->base_url}raovats">RAO VẶT</a></li>
</ul>
</div>
</div>
</div>
</div>
{$this->SITE_MAIN_CONTENT}
        <!--footer-->
<footer>
<div class="container">
<div class="wt_footer">
<!--info footer-->
<div class="col-md-5">
<div class="info-footer">
<p><strong>CÔNG TY TNHH THƯƠNG MẠI DỊCH VỤ CƯ XÁ ĐÔ THÀNH</strong></p>
<p>Địa chỉ:Số 103/3A Đường Vân Thân,P.8,Q.6,TP.HCM</p>
<p>Phone:(08):62909743 - Email:info@vietsol.net</p>
</div>
<div class="link-social">
<img alt="" src="{$bw->vars['img_url']}/icon-fb.png">
<img alt="" src="{$bw->vars['img_url']}/icon-tw.png">
<img alt="" src="{$bw->vars['img_url']}/icon-gg.png">
<p>Thiết kế và phát triển bởi <span style="color: gray;">Vietsol</span></p>
</div>
<div class="link-bank">
<img alt="" src="{$bw->vars['img_url']}/lienket.png">
</div>
</div>
<!--end info footer-->
<!--facebook+google-->
<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-1">
<div class="col-xs-3 col-sm-5 col-md-3 googleplus">
<div class="google_info">
<p>CƯ XÁ ĐÔ THÀNH</p>
</div>
</div>
<div class="col-xs-8 col-sm-7 col-md-8 fbook">
<img src="{$bw->vars['img_url']}/lk-fb.png"></div>
</div>
<!--end facebook+google-->
</div>
</div>
</footer>
<!--end footer-->
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getSiteBar:desc::trigger:>
//===========================================================================
function getSiteBar($option=null) {global $bw,$vsLang,$vsMenu,$vsSettings,$urlcate,$vsExperts,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
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
//===========================================================================
// <vsf:pop_up_window:desc::trigger:>
//===========================================================================
function pop_up_window($title="",$css="",$text="") {
//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:Redirect:desc::trigger:>
//===========================================================================
function Redirect($Text="",$Url="",$css="") {global $bw;
$BWHTML = "";

//--starthtml--//
$BWHTML .= <<<EOF
        <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html40/loose.dtd">
<html>
<head>
<title>Redirecting...</title>
<meta http-equiv='refresh' content='2; url=$Url' />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
$css
<style type="text/css">
.title
{
color:red;
}
.text
{
padding:10px;
color:#009F3C;
}
</style>
</head>
  <body >
<center>
<table style="background-color:#6ac3cb" cellpadding="0" cellspacing="0" width="100%" height="100%"> 
<tr>
<td width="416px" align="center" valign="middle" style="background:url({$bw->vars ['board_url']}/styles/redirect/direct.jpg) no-repeat center  top;" height="432px">
<br/><br/><br/><br/>
<img src="{$bw->vars ['board_url']}/styles/redirect/turtle.gif">
<br/><br/>
<p class="text">{$Text}</p>
    <a href='$Url' title="{$Url}" class="title">( Click here if you do not wish to wait )</a>
 </td>
</tr>  
</table> 
</center>
</body>
</html>
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>