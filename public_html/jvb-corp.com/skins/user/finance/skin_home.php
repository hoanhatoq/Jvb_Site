<?php

class skin_home extends skin_objectpublic{
	
	
	function loadDefault($option=array()) {
		global $bw, $vsTemplate, $vsPrint, $vsUser,$menu;
		//$option['product']=Object::getObjModule("products", "products", "=2", "24", '');
		
		$this->service=Object::getObjModule('pages', 'services', '>0','',3);
		$this->news=Object::getObjModule('pages', 'news', '>0','',3);
		//pr($this->service);die;
	
		$this->lang=$_SESSION['user']['language']['vsfcurrentLang']['code'];
		
		$BWHTML .= <<<EOF


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
<div class="service_block">
	<div class="wap_app_web">
		<div class="title_web_app">{$this->getLang()->getWords('title_web_app','商品開発の流れ')}</div>
		<div class="m_w_a">
			<div  rel="ct_1" class="ls_tab tab1">ウェブサイト</div>
			<div  rel="ct_2" class="ls_tab tab2">アプリ</div>
			<div class="clear"></div>      
			<div  class="ct_d1 ct_1">	   
				<img  src="{$bw->vars['img_url']}/web_{$this->lang}.png">
			</div>
			<div  style="display:none;" class="ct_d1 ct_2">	   
				<img  src="{$bw->vars['img_url']}/app_{$this->lang}.png">
			</div>
			
		</div>
	</div>
	<div class="select_2">
		<div class="left_se">
			<div class="title_web_app">{$this->getLang()->getWords('title_jvb_sel','JVBベトナムの特徴')}</div>
			<div class="m_left">
				<img  src="{$bw->vars['img_url']}/select_{$this->lang}.png">
				<div>
					<if="$this->lang=='jp'">
					<p>直接訪問、打ち合わせ</p>
					<p>お客様の要求を正確に把握し、アイデアを提案する</p>
					<p>⇒ミスマッチングを防ぎ、安心です。</p>
					</if>
				</div>
				<div>
					<if="$this->lang=='jp'">
					日本側BSEとベトナム開発チームの密の連携で、確実に、且つ迅速に商品完成ができる。
					</if>
				</div>
				<div class="clear"></div>
			</div>
			
		</div>
		<div class="right_se">
			<div class="title_web_app">{$this->getLang()->getWords('news','ニュース')}</div>
			<div class="news_home">
				<foreach="$this->news as $key=>$value">
					<div class="item">
						<a href="{$value->getUrl($value->getModule())}">{$value->createImageCache($value->getImage(),85,68,3)}</a>
						<h3><a href="{$value->getUrl($value->getModule())}">{$value->getTitle()} - <span>{$this->dateTimeFormat($value->getPostDate(),'d/m/y')}</span></a></h3>
						<div class="intro"><p>{$this->cut($value->getIntro(),150)}</p></div>
					</div>
					<div class="clear"></div>
				</foreach>
			</div>
		
		</div>
	</div>

	<!--
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
	-->
	
    <div class="clear"></div>
</div>


		  
EOF;
		

		return $BWHTML;
	}

}
?>