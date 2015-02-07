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
//pr($this->service);die;


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="service_block">
<div class="service_item">
<a href="{$bw->base_url}development"><div class="bg_s"></div></a>
    <div class="im"><a href="{$bw->base_url}development"><img width="240px" src="{$bw->vars['img_url']}/qui_trinh.jpg"></a></div>
        <div class="title"><a href="{$bw->base_url}development">{$this->getLang()->getWords('qui_trinh')}</a></div>
        <!--<div class="intro">
        </div>-->
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


}
?>