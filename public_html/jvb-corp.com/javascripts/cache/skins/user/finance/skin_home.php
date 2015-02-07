<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_home extends skin_objectpublic {

//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault($option=array()) {global $bw, $vsTemplate, $vsPrint, $vsUser,$menu;
//$option['product']=Object::getObjModule("products", "products", "=2", "24", '');
$this->service=Object::getObjModule('pages', 'services', '>0','',3);
$this->news=Object::getObjModule('pages', 'news', '>0','',3);
//pr($this->service);die;


//--starthtml--//
$BWHTML .= <<<EOF
        <script type="text/javascript">
$(document).ready(function(){
setTimeout(function(){
$('.tab1').trigger('click');
},100);
$('.ls_tab').click(function(){
$('.ls_tab').removeClass('active');
$(this).addClass('active');
$('.ct_d1').hide();
$("."+$(this).attr('rel')).fadeIn(1);
});
});
</script>
<div class="service_block">
<!--<div class="wap_app_web">
<div class="title_web_app">{$this->getLang()->getWords('title_web_app','商品開発の流れ')}</div>
<div class="m_w_a">
<div  rel="ct_1" class="ls_tab tab1">ウェブサイト</div>
<div  rel="ct_2" class="ls_tab tab2">アプリ</div>
<div class="clear"></div>      
<div  class="ct_d1 ct_1">   
<img  src="{$bw->vars['img_url']}/web_jp.png">
</div>
<div  style="display:none;" class="ct_d1 ct_2">   
<img  src="{$bw->vars['img_url']}/app_jp.png">
</div>
</div>
</div>
<div class="select_2">
<div class="left_se">
<div class="title_web_app">{$this->getLang()->getWords('title_jvb_sel','JVBベトナムの特徴')}</div>
<div class="m_left">
<img  src="{$bw->vars['img_url']}/select_2.png">
</div>
</div>
<div class="right_se">
<div class="title_web_app">{$this->getLang()->getWords('news','ニュース')}</div>
<div class="news_home">
{$this->__foreach_loop__id_54112bbae695b($option)}
</div>
</div>
</div>
-->
<div class="service_item">
<a href="{$bw->base_url}development"><div class="bg_s"></div></a>
    <div class="im"><a href="{$bw->base_url}development"><img width="240px" src="{$bw->vars['img_url']}/qui_trinh.jpg"></a></div>
        <div class="title"><a href="{$bw->base_url}development">{$this->getLang()->getWords('qui_trinh')}</a></div>
        
    </div>
<div class="service_item">
<a href="{$bw->base_url}special"><div class="bg_s"></div></a>
    <div class="im"><a href="{$bw->base_url}special"><img width="240px" src="{$bw->vars['img_url']}/dac_diem.jpg"></a></div>
        <div class="title"><a href="{$bw->base_url}special">{$this->getLang()->getWords('dac_diem')}</a></div>
       
    </div>
<div class="service_item">
<a href="{$bw->base_url}news"><div class="bg_s"></div></a>
    <div class="im"><a href="{$bw->base_url}news"><img width="240px" src="{$bw->vars['img_url']}/tin_tuc.jpg"></a></div>
        <div class="title"><a href="{$bw->base_url}news">{$this->getLang()->getWords('tin_tuc')}</a></div>
       
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
function __foreach_loop__id_54112bbae695b($option=array())
{
global $bw, $vsTemplate, $vsPrint, $vsUser,$menu;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($this->news)){
    foreach( $this->news as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class="item">
<a href="{$value->getUrl($value->getModule())}">{$value->createImageCache($value->getImage(),85,68,3)}</a>
<h3><a href="{$value->getUrl($value->getModule())}">{$value->getTitle()} - <span>{$this->dateTimeFormat($value->getPostDate(),'d/m/y')}</span></a></h3>
<div class="intro"><p>{$this->cut($value->getIntro(),150)}</p></div>
</div>
<div class="clear"></div>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>