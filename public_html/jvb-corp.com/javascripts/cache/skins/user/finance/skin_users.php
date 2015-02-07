<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_users extends skin_objectpublic {

//===========================================================================
// <vsf:loginMobile:desc::trigger:>
//===========================================================================
function loginMobile($option="") {global $bw;


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="container">
<!--box_title-->
<div class="row" id="margintop">
<div class="col-md-12 col-xs-12 col-sm-12">
<div class="tieude">
<h2 style="width:18%;" ><span>{$this->getLang()->getWords($bw->input[0])}</span></h2>
</div>
</div>
</div>
<!--end box_title-->
<div class="row">
<!--content rao vặt-->
<div class="col-md-12">
<div class="wrapper">
<!--wrapper_content-->
<div class="wrapper_content">

<div style="">
<div class="col-md-12 col-sm-12 col-xs-12">
<h3>Đăng nhập</h3>

<form class="form_lo_mobile" style="display:block;" id="login_mobi">
<div class="error error_login"></div>
<input name="email" type="text" class="form-control" placeholder="Email hoặc số điện thoại">
<input name="password"  type="password" class="form-control" placeholder="Mật Khẩu">
<a onclick="login_ajax_mobile()" style="width:100%" class="btn btn-success" >Đăng Nhập</a>
</form>
</div>
</div>

<script>
function login_ajax_mobile(){
$.ajax({
type:'POST',
url: baseUrl+'users/do_login',
data:$('#login_mobi').serialize(),
cache: false,
success: function(data){
if(data==1){
location.href='{$bw->base_url}';
}else{
$('.error_login').text(data);
}
}
});
return false;
}
</script>
<script>
function register_mobile(){
$.ajax({
type:'POST',
url: baseUrl+'users/do_registry',
data:$('#form_register_mobile').serialize(),
cache: false,
success: function(data){
if(data==1){
location.href="{$bw->base_url}";
}else{
$('.error').text(data);
$("#an_1").trigger('click');
}
}
});
}

</script>


<div style="">
<div class="col-md-12 col-sm-12 col-xs-12">
<h3>Đăng kí tài khoản</h3>
<div class="error"></div>
<form id="form_register_mobile" class="form-horizontal" role="form">
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
<img id="change_cap3" src="{$bw->vars['board_url']}/vscaptcha/" />
<a href="#" id="an_1" class="mamoi">refresh</a>
</div>
</div>
</div>
<div class="form-group">
<div style="text-align:center;" class="col-sm-12">
<button onclick="register_mobile()" type="button" class="btn btn-success">ĐĂNG KÝ</button>
</div>
</div>
<div class="form-group">
<div class="col-md-4">
<a href="{$bw->base_url}" class="backhome">Về trang chủ</a>
</div>
</div>
</form>

</div>
</div>

</div>
<!--wrapper_content-->
</div>
</div>
<!--end content rao vặt-->
</div>
</div>
<script>
$(document).ready(function () {
$("#an_1").click(function(){
                $("#change_cap3").attr("src",$("#change_cap3").attr("src")+"?a");
                return false;
});
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:registry:desc::trigger:>
//===========================================================================
function registry($option="") {global $bw;
$this->member_acc=Object::getObjModule('pages','inforegistrys','>0','',1);

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content_dir">
    <div class="sitebar_left">
        
    </div>
        <div class="mid">
        
            <div id="dangky">
        <form  id="checkhtml5" class="form_dangky" action="{$bw->base_url}users/do_registry" method="POST" enctype="multipart/form-data" >
        <div class="main_re_acc">{$this->member_acc->getContent()}</div>
        <input type="checkbox" class="dangky_check"> 위의 회원가입약관에 동의합니다.
        <div class="clear"></div>
        <label>{$this->getLang()->getWords('username')}<span>*</span></label><input id="name" required name="name" type="name" value="{$bw->input['name']}"/><span class="checkid">Check id</span>
        <div class="clear"></div>
                <label>{$this->getLang()->getWords('password')}<span>*</span></label><input id="password" required name="password"  type="password" value="{$bw->input['password']}"/>
                <div class="clear"></div>
                <label>{$this->getLang()->getWords('relay_password')}<span>*</span></label><input id="password_confirm" required name="password_confirm"  type="password" value="{$bw->input['password_confirm']}"/>
                <div class="clear"></div>
                <label>{$this->getLang()->getWords('member')}<span>*</span></label><input id="title"  required name="title"  type="name" value="{$bw->input['title']}"/>
        <div class="clear"></div>
        
        <label>{$this->getLang()->getWords('email')}<span>*</span></label><input id="email" name="email"  required type="email" value="{$bw->input['email']}"/>
        <div class="clear"></div>
        
        <label>{$this->getLang()->getWords('address')}<span>*</span></label><input id="address" name="address" required  type="name" value="{$bw->input['address']}"/>
        <div class="clear"></div>
        
        <label>{$this->getLang()->getWords('phone')}</label><input id="phone" name="phone"   type="text" value="{$bw->input['phone']}"/>
        <div class="clear"></div>
        
        <label>{$this->getLang()->getWords('mobile')}<span>*</span></label><input id="mobile" name="mobile" required type="name" value="{$bw->input['mobile']}"/>
        <div class="clear"></div>
        
        
        <label>{$this->getLang()->getWords('question_re')}<span>*</span></label>
        <select name="question" name="question"> 
            <option value="">선택하십시오.</option>
            <option value="할아버님 성함은?">할아버님 성함은?</option>
<option value="할머님 성함은?">할머님 성함은?</option>
<option value="외할아버님 성함은?">외할아버님 성함은?</option>
<option value="외할머님 성함은?">외할머님 성함은?</option>
<option value="아버님 성함은?">아버님 성함은?</option>
<option value="어머님 성함은?">어머님 성함은?</option>
<option value="가장 아끼는 물건은?">가장 아끼는 물건은?</option>
<option value="제일 가보고 싶은 나라는?">제일 가보고 싶은 나라는?</option>
<option value="제일 좋아하는 색깔은?">제일 좋아하는 색깔은?</option>
<option value="애완동물 이름은?">애완동물 이름은?</option>
        </select>
        <div class="clear"></div>
        <label>{$this->getLang()->getWords('anser_question')}<span>*</span></label><input id="anser" name="anser" required  type="name" value="{$bw->input['anser']}"/>
        <div class="clear"></div>
        <label>{$this->getLang()->getWords('home_page')}</label><input id="phone" name="homePage"  type="text" value="{$bw->input['homePage']}"/>
        <div class="clear"></div>
<label>{$this->getLang()->getWords('sex')}</label>
        <select name="sex" >
        <option value=0 >선택하세요</option>
        <option value=1 >남자</option>
        <option value=2 >여자</option>
        </select>
        <div class="clear"></div>
        
        <label>{$this->getLang()->getWords('about_member')}</label>
<textarea name="intro">{$bw->input['intro']}</textarea>
        <div class="clear"></div>
               <label></label>
               
               <div class="clear"></div>
               
               <label>{$this->getLang()->getWords('capcha')}<span>*</span></label><input required name="security"  type="text" value="" style="width:157px;"/>
                    <img id="siimage"  src="{$bw->base_url}vscaptcha"/>
                <a class="capcha_btn" href="#"><img id="reload_img"  src="{$bw->vars['img_url']}/capcha_btn.jpg"></a>
                <script>
                $("#reload_img").click(function(){
                $("#siimage").attr("src",$("#siimage").attr("src")+"?a");
                return false;
});
</script>
<div class="clear"></div>
<h2 class="message">{$option['message']}</h2>
                <div class="clear"></div>
            <input type="submit" class="input_submit" value="{$this->getLang()->getWords('regis_submit')}" id="check_reg">
        </form>
        <div class="clear"></div>
            
</div>

<script type="text/javascript">
        $(document).ready(function() {
        jQuery('.form_dangky #name').keyup(function () { 
    this.value = this.value.replace(/[^a-zA-Z0-9]/g,'');
});

        $('.checkid').click(function(){
var name=$('#name').val();
$('#name').removeAttr('class');
if(name.length<=0){
$('#name').focus();
return false;
}
        $.ajax({
type:'POST',
dataType:'json',
url: baseUrl+'users/check_username',
data:'ajax=1&json=1&name='+name+'',
cache: false,
success: function(data) {
if(data.ok==1){
//$('#name').addClass('err_id');
//$('#name').val('');
alert('{$this->getLang()->getWords('user_no_ok','사용 중인 ID')}');
}
if(data.ok==0){
//$('#name').addClass('ok_id');
alert('{$this->getLang()->getWords('user_ok_re','사용 가능한 ID')}');
}
}
});
return false;
});
        });
    </script> 
<script>
$(document).ready(function () {
$('#checkhtml5').h5Validate({
errorClass:'black'
});
});
</script>
     <script>
        $(".form_dangky").submit(function(){
if(!$(".dangky_check").attr('checked')){
alert('{$this->getLang()->getWords('no_ok_agent','이용약관에 동의 안함')}');
return false;
}
});

if ($.browser.msie) {
$(document).ready(function(){
$('#check_reg').click(function(){
check = 0;
$('.warning').remove(); 
checkTrue('name');
checkTrue('title');
checkTrue('password');
checkTrue('password_confirm');
checkMail('email');
checkTrue('address');
checkTrue('mobile');
checkTrue('anser');

if(check)return false;;
});
     });
}
        </script>
            
            
        </div>
        <div class="sitebar_right">
        
        </div>     
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:registryOK:desc::trigger:>
//===========================================================================
function registryOK($option="") {global $bw;
//$option['location']=VSFactory::getMenus()->getCategoryGroup("location")->getChildren();

//--starthtml--//
$BWHTML .= <<<EOF
        <h1>{$option['message']}</h1>
<a href="">Click</a>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:loginForm:desc::trigger:>
//===========================================================================
function loginForm($option="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        {$this->loginForm_Action($option)}
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:loginForm_Action:desc::trigger:>
//===========================================================================
function loginForm_Action($option="") {global $bw;


//--starthtml--//
$BWHTML .= <<<EOF
        <form class="dangnhap" action="{$bw->base_url}users/do_login" id="login" method="POST" enctype="multipart/form-data" >
            <h3>{$this->getLang()->getWords('Login')}</h3>
            
EOF;
if($bw->input['action']=='do_login') {
$BWHTML .= <<<EOF

            <h2 class="message">{$option['message']}</h2>
            
EOF;
}

$BWHTML .= <<<EOF

                <label><label>{$this->getLang()->getWords('UserName')}</label>
                <input type="text" name="name" class="txt-user" value="{$bw->input['name']}"/>
                <div class="clear_left"></div>
                <label>Mật khẩu:</label>
                <input type="password" name="password" class="txt-pass"/>
                <div class="clear_left"></div>
                <a href="{$bw->vars['board_url']}/users/forgot_password">Quên mật khẩu ???</a>
                <div class="clear_left"></div>
                <input type="submit" value="Đăng nhập" class="dangnhap_btn">
                <div class="clear_left"></div>
                
EOF;
if($option['loginUrl']) {
$BWHTML .= <<<EOF
<a href="{$option['loginUrl']}"><img src="{$bw->vars['img_url']}/face_login.jpg" /></a>
EOF;
}

$BWHTML .= <<<EOF

            </form>
    
    <script>
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:forgotPassword:desc::trigger:>
//===========================================================================
function forgotPassword($option="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content_dir">
    <div class="sitebar_left">
        
        <div class="mid">
        
            <div id="dangky">
        
        <form class="form_dangky"  action="{$bw->base_url}users/do_forgot_password" method="POST">
        <h2 class="message">{$option['message']}</h2>
        <label>{$this->getLang()->getWords('username')}</label><input name="name" type="text" value="{$bw->input['name']}"/>
        <div class="clear_left"></div>
        
        <label>{$this->getLang()->getWords('email')}</label><input id="email" name="email"  type="text" value="{$bw->input['email']}"/>
        <div class="clear"></div>
        
        
        
        <div class="clear"></div>
        <label>{$this->getLang()->getWords('question_re')}</label>
        <select name="question" name="question"> 
            <option value="">선택하십시오.</option>
            <option value="할아버님 성함은?">할아버님 성함은?</option>
<option value="할머님 성함은?">할머님 성함은?</option>
<option value="외할아버님 성함은?">외할아버님 성함은?</option>
<option value="외할머님 성함은?">외할머님 성함은?</option>
<option value="아버님 성함은?">아버님 성함은?</option>
<option value="어머님 성함은?">어머님 성함은?</option>
<option value="가장 아끼는 물건은?">가장 아끼는 물건은?</option>
<option value="제일 가보고 싶은 나라는?">제일 가보고 싶은 나라는?</option>
<option value="제일 좋아하는 색깔은?">제일 좋아하는 색깔은?</option>
<option value="애완동물 이름은?">애완동물 이름은?</option>
        </select>
        <div class="clear"></div>
        <label>{$this->getLang()->getWords('anser_question')}</label><input id="phone" name="anser"  type="text" value="{$bw->input['anser']}"/>
        
        
        <div class="clear"></div>
               <div class="capcha">
               <label>{$this->getLang()->getWords('capcha')}<span>*</span></label><input name="security"  type="text" value="" style="width:157px;"/>
                    <img id="siimage"  src="{$bw->base_url}vscaptcha"/>
                <a class="capcha_btn" href="#"><img id="reload_img"  src="{$bw->vars['img_url']}/capcha_btn.jpg"></a>
                <script>
                $("#reload_img").click(function(){
                $("#siimage").attr("src",$("#siimage").attr("src")+"?a");
                return false;
});
</script>
        </div>
        
        <div class="clear"></div>
<input type="submit" class="input_submit" value="{$this->getLang()->getWords('forgot_password')}">
        </form>
        
       
</div>
        </div>
        <div class="sitebar_right">
        
        </div>     
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:doForgotPassword:desc::trigger:>
//===========================================================================
function doForgotPassword($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content_dir">
    <div class="sitebar_left">
        </div>
        <div class="mid">
        
            <div id="dangky">
<div class="title_box_den">{$this->getLang()->getWords('select_mouse')}</div>
<div class="box_den">{$option['password_new']}</div>
<div class="clear"></div>
            <h2 class="message">{$option['message']}</h2>
</div>
        </div>
        <div class="sitebar_right">
        
        </div>     
    </div>
    <style>
    .box_den{
    width:100px;
    height:30px;
    line-height:30px;
    background:#000;
    color:#000;
    text-align:center;
    }
    </style>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:changePassword:desc::trigger:>
//===========================================================================
function changePassword($option="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content_dir">
    <div class="sitebar_left">
    
        </div>
        <div class="mid">
        
            <div id="dangky">
        
        <form class="form_dangky"  action="{$bw->base_url}users/do_chang_password" method="POST">
        
        
        <label>{$this->getLang()->getWords('old_password_action')}<span></span></label><input name="oldpassword" type="text" value=""/>
        <div class="clear"></div>
            <label>{$this->getLang()->getWords('new_password_action')}<span></span></label><input name="password"  type="password" value=""/>
            <div class="clear"></div>
            <label>{$this->getLang()->getWords('relay_password_action')}<span></span></label><input name="passwordconfirm"  type="password" value=""/>
        <div class="clear"></div>
            <input type="submit" class="input_submit" value="{$this->getLang()->getWords('change_password')}">
        </form>
        <div class="clear"></div>
            <h2 class="message">{$option['message']}</h2>
</div>
        </div>
        <div class="sitebar_right">
        
        </div>     
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:doChangePassword:desc::trigger:>
//===========================================================================
function doChangePassword($option="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content_dir">
    <div class="sitebar_left">
    
        </div>
        <div class="mid">
        
            <div id="dangky">
        <div class="clear"></div>
            <h2 class="message">{$option['message']}</h2>
</div>
        </div>
        <div class="sitebar_right">
        
        </div>     
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:changeInfo:desc::trigger:>
//===========================================================================
function changeInfo($option="") {
global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="container">
<!--box_title-->
<div class="row" id="margintop">
<div class="col-md-12 col-xs-12 col-sm-12">
<div class="tieude">
<h2 style="width:18%;" ><span>{$this->getLang()->getWords($bw->input[0])}</span></h2>
</div>
</div>
</div>
<!--end box_title-->
<div class="row">
<!--content rao vặt-->
<div class="col-md-12">
<div class="wrapper">
<!--wrapper_content-->
<div class="wrapper_content">
<div style="float:left;width:45%">
<div class="col-md-12 col-sm-12 col-xs-12">
<h3>Thông tin tài khoản</h3>
<form  id="from_info_update" class="form_info"  method="POST" enctype="multipart/form-data" >
        
        <div class="form-group">
<label for="inputAd" class="col-sm-2 control-label">Họ tên</label>
<div class="col-sm-10">
<input  id="name" class="form-control"  name="name" type="name" value="{$option['obj']->getName()}"/>
</div>
</div>
<div class="form-group">
<label for="inputAd" class="col-sm-2 control-label">Email</label>
<div class="col-sm-10">
<input  disabled  class="form-control" type="email" name="email" value="{$option['obj']->getEmail()}"/>
</div>
</div>

<div class="form-group">
<label for="inputAd" class="col-sm-2 control-label">Phone</label>
<div class="col-sm-10">
<input  class="form-control" type="name" name="phone"  value="{$option['obj']->getPhone()}"/>
</div>
</div>
<div class="form-group">
<label for="inputAd" class="col-sm-2 control-label">Đia chỉ</label>
<div class="col-sm-10">
<input  class="form-control" type="name" name="address" value="{$option['obj']->getAddress()}"/>
</div>
</div>

               <div class="clear"></div>
               <div class="error_info error"></div>
               
            <input onclick="update_info()" type="button" class="button_cn btn btn-success" value="Cập nhật" id="check_reg">
        </form>
</div>
</div>
<div style="float:left;width:45%">
<div class="col-md-12 col-sm-12 col-xs-12">
<h3>Đổi mật khẩu</h3>
<form  id="update_password" class="form_info"  method="POST" enctype="multipart/form-data" >
        
        <div class="form-group">
<label for="inputAd" class="col-sm-2 control-label">Mật khẩu củ</label>
<div class="col-sm-10">
<input  id="name" class="form-control"  name="password_old" type="password" value=""/>
</div>
</div>
<div class="form-group">
<label for="inputAd" class="col-sm-2 control-label">Mật khẩu mới</label>
<div class="col-sm-10">
<input   class="form-control" type="password" name="password" value=""/>
</div>
</div>

               <div class="clear"></div>
               <div class="error_pass error"></div>
               
            <input onclick="change_password()" type="button" class="button_cn btn btn-success" value="Đổi mật khẩu" id="check_reg">
        </form>
</div>
</div>

</div>
<!--wrapper_content-->
</div>
</div>
<!--end content rao vặt-->
</div>
</div>

<script>
function update_info(){
$.ajax({
       type:'POST',
       url: baseUrl+'users/do_chang_info',
       data:'ajax=1&'+$('#from_info_update').serialize(),
       cache: false,
            success: function(data){
           $('.error_info').html(data);
           }     
            
  });
}

function change_password(){
$.ajax({
       type:'POST',
       url: baseUrl+'users/do_chang_password',
       data:'ajax=1&'+$('#update_password').serialize(),
       cache: false,
            success: function(data){
           $('.error_pass').html(data);
           //$('#update_password').find('input[type=password]').val('');
           }     
            
  });
}


</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:doSendPasswordForm:desc::trigger:>
//===========================================================================
function doSendPasswordForm($obj="",$option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <p>Chào {$obj->getTitle()}, bạn vừa yêu cầu lấy lại mật khẩu</p>
<p>Vui lòng truy cập vào địa chỉ sau để đổi lại mật khẩu</p>
<p>
<a  href="{$bw->base_url}users/renew_password/{$obj->getName()}/{$option['token']}">
{$bw->base_url}users/renew_password/{$obj->getName()}/{$option['token']}
</a>
</p>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showRegList:desc::trigger:>
//===========================================================================
function showRegList($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
        <div id="content_center">
            <div class="content_left">
                <div class="main_title">                
                <h1>Danh sách đội đăng ký {$option['location']->getTitle()}</h1>
                    </div>  
                      
                    <div class="dsdoithi">
                    {$this->__foreach_loop__id_53d1c68593b82($option)}
                    </div>
                    <div class="clear_left"></div>
                    <div class="page">
                         {$option['paging']}
                    </div>
                    
                </div>
                
                <div class="content_right">
                {$this->getAddon()->getLoginForm($option)}
                    <!-- STOP LOGIN -->
                    
                  {$this->getAddon()->getGallerysBlock($option)}
                    <!-- STOP HINH ANH -->
                </div>
            <div class="clear"></div>
            </div>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c68593b82($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['pageList'])){
    foreach( $option['pageList'] as $user )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <div class="dsdoithi_item">
                        <a href="{$bw->base_url}users/view_info/{$user->getSlugId()}" class="dsdoithi_img">
{$user->createImageCache($user->getImage(),74,74)}
                        </a>
                            <h3><a href="{$bw->base_url}users/view_info/{$user->getSlugId()}">{$vsf_count}. {$this->cut( $user->getTitle(),10)}</a></h3>
                            <p>Khu vực: <span>{$user->location->getTitle()}</span></p>
                            <p>Bình luận: <span style="color:#fb3f8c;">[{$user->getComment()}]</span></p>
                            <div class="clear_left"></div>
                        </div>
                    
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showApproveList:desc::trigger:>
//===========================================================================
function showApproveList($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
        <div id="content_center">
            <div class="content_left">
                <div class="main_title">                
                <h1>Danh sách đội thi {$option['location']->getTitle()}</h1>
                    </div>    
                    <div class="clear_left"></div>
                    <div class="dsdoithi">
                    {$this->__foreach_loop__id_53d1c68593d6b($option)}
                    
                    </div>
                    <div class="clear_left"></div>
                    <div class="page">
                         {$option['paging']}
                    </div>
                    
                </div>
                
                <div class="content_right">
                {$this->getAddon()->getLoginForm($option)}
                    <!-- STOP LOGIN -->
                    
                  {$this->getAddon()->getGallerysBlock($option)}
                    <!-- STOP HINH ANH -->
                </div>
            <div class="clear"></div>
            </div>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c68593d6b($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['pageList'])){
    foreach( $option['pageList'] as $user )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <div class="dsdoithi_item">
                        <a href="{$bw->base_url}users/view_info/{$user->getSlugId()}" class="dsdoithi_img">
{$user->createImageCache($user->getImage(),74,74)}
                        </a>
                            <h3><a href="#">{$vsf_count}. {$this->cut( $user->getTitle(),10)}</a></h3>
                            <p>Khu vực: <span>{$user->location->getTitle()}</span></p>
                            <p>Bình luận: <span style="color:#fb3f8c;">[{$user->getComment()}]</span></p>
                            <div class="clear_left"></div>
                        </div>
                    
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:viewInfo:desc::trigger:>
//===========================================================================
function viewInfo($obj="",$option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
        <div id="content_center">
            <div class="content_left">
                <div class="main_title">
                <h1>{$obj->getTitle()}</h1>
                    </div>
                    
                    <div class="video_clip">
                    {$option['video']->show(665,389)}
                    </div>
                    <div class="khuvuc">
                    <h3 class="sub_title">{$option['video']->getTitle()}</h3>                    
                    </div>
                    <div class="mangxh">
                    
<div id="fb-root"></div>
<fb:like class='fb-my-like-detail' send="false" layout="button_count" width="150" show_faces="true" action="like" font=""></fb:like>
<div class='my_twitter_detai'>
<a href="https://twitter.com/share" class="twitter-share-button" data-count="" data-via="MrTruyenhinh">Tweet</a>
</div>
<div class='gplus_p'><g:plusone size="medium"></div>
<div class='clear'></div>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=174908555940527";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
                    </div>
                    <div class="clear"></div>
                    <div  id="comment_panel" class="binhluan_left">
                    {$option['comment']}
                    </div>
                    <!-- STOP BINH LUAN -->
                    <div class="binhluan_right">
                    <form class="frm_subc" method="post">
                    <input type="hidden" name="comments[userId]" value="{$obj->getId()}"/>
                        <input id="txt_poster" name="comments[poster]" vsvalue="Họ tên" type="text" style="width:303px;" onfocus="if(this.value=='Họ tên') this.value='';" onblur="if(this.value=='') this.value='Họ tên';" value="
EOF;
if($this->getUser()->basicObject->getId()) {
$BWHTML .= <<<EOF
{$this->getUser()->basicObject->getTitle()}
EOF;
}

else {
$BWHTML .= <<<EOF
 
EOF;
if($_SESSION['poster']) {
$BWHTML .= <<<EOF
{$_SESSION['poster']}
EOF;
}

else {
$BWHTML .= <<<EOF
Họ tên
EOF;
}
$BWHTML .= <<<EOF

EOF;
}
$BWHTML .= <<<EOF
" class="input_text" />
                            <br/>
                        <input name="security"  type="text" style="width:75px;" onfocus="if(this.value=='Mã xác nhận') this.value='';" onblur="if(this.value=='') this.value='Mã xác nhận';" value="Mã xác nhận" class="input_text" />
                    <img id="siimage"  src="{$bw->base_url}vscaptcha"/>
                    <a class="capcha_btn" href="#"><img id="reload_img"  src="{$bw->vars['img_url']}/capcha_btn.jpg"></a>
                     <script>
                            $("#reload_img").click(function(){
                            $("#siimage").attr("src",$("#siimage").attr("src")+"?a");
                            return false;
});
</script>
                            <div class="clear_left"></div>
                            <p class="error_msg" style="color:#ff0000"></p>
                            <textarea id="txt_content" name="comments[content]"></textarea>
                            <input type="submit" value="Gửi" class="send_btn" />
                            <!--<input type="reset" value="Làm lại" class="reset_btn" />-->
                        </form>
                        <script>
                        $(".frm_subc").submit(function(){
if($("#txt_poster").val()==$("#txt_poster").attr('vsvalue')){
alert("Bạn chưa nhập họ tên!");
return false;
}
if($("#txt_content").val().length<5){
alert("Nội dung quá ngắn");
return false;
}
                        //alert($(this).serialize());
                        var frm=this;
                         $.ajax({
            url: baseUrl+'comments/submit_comment',
            type: 'POST',
            cache: false,
            data: $(frm).serialize(),
            dataType:'json',
            success: function(data){
             if(data.status){
             var html='<div class="binhluan_item">'+
                            '<h3>'+data.poster+' <span>('+data.postDate+')</span></h3>'+
                                '<p>'+data.content+'</p>   '  +                           
                           ' </div>';
                           $('.binhluan_center') .prepend($(html));
             }
             $('.error_msg').html(data.message);
             $("#reload_img").click();
             //frm.reset();
             $("#txt_content").text("");
             
            },
            error: function (){
            $("#reload_img").click();
                alert('Có lỗi xảy ra');
            }
        });
                        
                        
                        
                        return false;
                        
});
                        </script>
                    </div>
                    <!-- STOP BINH LUAN -->
                    <div class="clear"></div>
                </div>
                
                <div class="content_right">
                <div class="login_form">
                    <h3>Đăng nhập</h3>
                        <form>
                        <label>Tên đăng nhập:</label><input type="text" />
                            <label>Mật khẩu:</label><input type="text" />                            
                            <input type="submit" value="Đăng nhập" class="dangnhap" />
                            <div class="clear_left"></div>
                        </form>
                        <p>Nếu bạn chưa là thành viên cuộc thi này, hãy <a href="#">đăng ký</a> tại đây</p>
                        <p>Bạn quên mật khẩu, hãy <a href="#">click</a> vào đây</p>
                    </div>
                    <!-- STOP LOGIN -->                                      
                    
                    <div class="video_other">
                    <img src="{$bw->vars['img_url']}/dslienquan.jpg" />
                    {$this->__foreach_loop__id_53d1c6859402d($obj,$option)}
                        <div class="clear_left"></div>
                    </div>
                    <!-- STOP VIDEO OTHER -->
                </div>
            <div class="clear"></div>
            </div>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6859402d($obj="",$option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['other'])){
    foreach( $option['other'] as $user )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <div class="dsdoithi_item">
                        <a href="#" class="dsdoithi_img">
                        {$user->createImageCache($user->getImage(),74,74)}
                        </a>
                            <h3><a href="{$bw->base_url}users/view_info/{$user->getSlugId()}">{$vsf_count}. {$user->getTitle()}</a></h3>
                            <p>Khu vực: <span>Tân Bình</span></p>
                            <p>Bình luận: <span style="color:#fb3f8c;">[{$user->getComment()}]</span></p>
                            <div class="clear_left"></div>
                        </div>
                        
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:userComment:desc::trigger:>
//===========================================================================
function userComment($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <!--
                    <div class="page_binhluan">
                             <a href="#"><img src="{$bw->vars['img_url']}/binhluan_prev.jpg" /></a>
                             <a href="#" class="active">1</a>
                             <a href="#">2</a>
                             <a href="#">3</a>
                             <a href="#">4</a>
                             <a href="#">5</a>
                             <a href="#"><img src="{$bw->vars['img_url']}/binhluan_next.jpg" /></a>
                        </div>
                        -->
                        <div class="page_binhluan">
                        {$option['paging']}
                        </div>
                        <div  class="binhluan_center">
                        {$this->__foreach_loop__id_53d1c68594311($option)}
                        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c68594311($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['pageList'])){
    foreach( $option['pageList'] as $comment )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <div class="binhluan_item">
                            <h3>{$comment->getPoster()} <span>({$this->dateTimeFormat($comment->getPostDate(),"m/d/y h:i:s") })</span></h3>
                                <p>{$comment->getContent()}</p>                                
                            </div>
                        
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>