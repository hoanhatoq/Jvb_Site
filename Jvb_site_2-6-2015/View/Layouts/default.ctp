<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'JBV Viet Nam');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?> |
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
        echo $this->Html->css('style');
        echo $this->Html->css('jquery.bxslider');
        

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Html->script('jquery-1.7.1.js');
        echo $this->Html->script('jquery.nivo.slider.js');
        echo $this->Html->script('slideios.js');
        echo $this->Html->script('jquery.lazy.js');
        echo $this->Html->script('jquery.bxslider.js');
        echo $this->Html->script('imenu.js');
    ?>
</head>
<body>

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
    <div id="container">
        
        <div id="header">
          <div class="wrapper_header">
        <div class="logo"><a href="#"><?php echo $this->Html->image('logo_jvb.png', array('style'=> 'width:95px'));?></a>
            <?php echo $this->Html->image('img_slogan.png', array('class'=> 'i_slogan'));?>
          
        </div>
    <form id="from_search" action="#" class="button_ss form_search">
        <input value="" name="keyword" class="key-word" type="text">
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
                    <a href="#">
                        <?php echo $this->Html->image('fl_jp.jpg', array('class'=> 'flag_jp', 'style'=>'width:40px'));?></a>
                    <a href="#"><?php echo $this->Html->image('fl_vi.jpg', array('style'=>'width:40px'));?>
                        </a>
                    <a href="#"><?php echo $this->Html->image('fl_en.jpg', array('style'=>'width:40px'));?></a>
            </div>
            <div class="clear"></div>
        </div>
</div>
        <div class="clear"></div>
        <div class="menu_top">
            <ul>
                            
                     <li class="active" ><a href="<?php echo $this->Html->url(array('controller' => 'index', 'action' => 'index')) ?>">Trang chủ</a></li>
                    
                            
                    <li class="" ><a href="<?php echo $this->Html->url(array('controller' => 'Introduce', 'action' => 'introduce')) ?>">Giới thiệu</a></li>
                    
                            
                    <li class="" ><a href="<?php echo $this->Html->url(array('controller' => 'Services', 'action' => 'services')) ?>">Dịch vụ</a></li>
                    
                            
                    <li class="" ><a href="<?php echo $this->Html->url(array('controller' => 'News', 'action' => 'New')) ?>">Tin tức</a></li>
                    
                            
                    <li class="" ><a href="<?php echo $this->Html->url(array('controller' => 'Recruitment', 'action' => 'recruitment')) ?>">Tuyển dụng</a></li>
                    
                            
                    <li class="" ><a href="<?php echo $this->Html->url(array('controller' => 'Contact_us', 'action' => 'contact_us')) ?>">Liên hệ</a></li>
                    
                    <div class="clear"></div>
            </ul>
            
        </div>
        <div class="banner">
<div class="wrapper_banner">
    <ul class="bxslider">
            
        <li>
            <div class="service_slide">
                <div class="title">Phát triển ứng dụng Mobile</div>
                Công ty chúng tôi cung cấp dịch vụ phát triển ứng dụng Mobile trên nền iOS và Android.
Đội ngũ nhân viên của chúng tôi tư vấn và phát triển dựa trên nhu cầu thực tế của khách hàng.
<div class="readmore"><a href="http://jvb-corp.com/vi/banner_top/detail/dich-vu-cntt.html">Xem thêm</a></div>
                </div>
                <div class="im_slide">
                    <?php 
                        echo $this->Html->image('banner2.png', array('class'=> 'lazy', 'alt'=> 'banner_mobile')); 
                    ?>
                </div>
            </li>
                    
        <li>
            <div class="service_slide">
                <div class="title">Phát triển ứng dụng Web</div>
                Công ty JVB Vietnam cung cấp dịch vụ thiết kế và phát triển ứng dụng Web
<div class="readmore"><a href="http://jvb-corp.com/vi/banner_top/detail/phat-trien-ung-dung-web.html">Xem thêm</a></div>
                </div>
                <div class="im_slide">
                    <?php 
                        echo $this->Html->image('banner1.png', array('class'=> 'lazy', 'alt'=> 'banner_mobile')); 
                    ?>
                </div>
            </li>
                    
        <li>
            <div class="service_slide">
                <div class="title">Nội dung số</div>
                Công ty JVB Vietnam số hóa thông tin về văn hóa, môi trường kinh doanh tại Việt Nam để quảng bá cho khách hàng Nhật
<div class="readmore"><a href="http://jvb-corp.com/vi/banner_top/detail/noi-dung-so.html">Xem thêm</a></div>
                </div>
                <div class="im_slide">
                    <?php 
                        echo $this->Html->image('banner3.png', array('class'=> 'lazy', 'alt'=> 'banner_mobile')); 
                    ?>
                </div>
            </li>
            
        </ul>
      
    </div>
</div>
<div class="news_content">
    <marquee behavior="scroll" direction="left">
        <ul>
                    
            <li><a href="">Tuyển phiên dịch viên tiếng Nhật</a></li>
                    
            <li><a href="">Tuyển lập trình viên Mobile</a></li>

        </ul>
    </marquee>
</div>
        <script type="text/javascript">
                $(document).ready(function(){
                setTimeout(function(){
                $('.tab2').trigger('click');
                },100);
                $('.ls_tab').click(function(){
                $('.ls_tab').removeClass('active');
                $(this).addClass('active');
                $('.ct_d1').hide();
                $("."+$(this).attr('rel')).fadeIn(1);
                });
                });
        </script> 
        <?php echo $this->fetch('content'); ?>
        </div>
        <div class="footer">
            <div class="wrapper_footer">
            <div class="company_name">Công ty cổ phần JVB Việt Nam</div>
            <div class="company_address">Số 32-34, Đường Đặng Văn Ngữ, Phường Phương Liên, Quận Đống Đa, Thành phố Hà Nội, Việt Nam</div>
            <div class="social">
            <a href=" ">
                <?php echo $this->Html->image('face.png');?></a>
            <a href=" ">
                <?php echo $this->Html->image('twitter.png');?></a>
            <a href="">
                <?php echo $this->Html->image('print.png');?></a>
        </div>
        <div class="design_by">Copyright©2014 JVB Vietnam.All Rig </div>
    </div>       
        </div>
        
      
    </div>


            <?php echo $this->Session->flash(); ?>

           
        
        


</body>
</html>
