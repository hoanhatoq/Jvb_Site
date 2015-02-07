<?php
class skin_pages extends skin_objectpublic{
	function showDefault($option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
		$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");
		
		$cateId = $option['obj']?$option['obj']->getId():0;
		
		

		
		
		$BWHTML .= <<<EOF
		
		
		<div id="primary">
			
			<div class="productNew">
		
				<div class="productNew-detai-box productNew-box">
					<div class="content_news">
						<foreach="$option['pageList'] as $key=>$obj">
						<div class="item-search news_home_item"> 
							
							<h3><a href="{$obj->getUrl($bw->input[0])}">{$obj->getTitle()} </a></h3>
							<p>{$this->cut($obj->getContent(),100)}</p>
							
							<div class="clear_left"></div>
						</div>
						</foreach>
					</div><!--end content_news-->
					{$option['paging']}
					
				</div>
			</div>
			<!-- end .productNew-box--> 
			
		</div>
		<!-- end #primary--> 
		
			
EOF;
	}
	
	function showDetail($obj,$option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		
		$this->catTitle=$option['cate_obj']->getTitle();
		$this->urlCate="{$this->bw->base_url}$bw->input[0]/category/{$option['cate_obj']->getSlugId()}";


		$option['ban']= $this->getAddon()->getBannerByCode("BANNER_PRO");



		//if($bw->input[0]=='abouts')
			$option['list_detail']=Object::getObjModule('pages',$bw->input[0], '>0');

		if($bw->input[0]=='development'){
			unset($option['list_detail']);
		}

		
		$BWHTML .= <<<EOF


	<div class="content">
		<if="$option['list_detail']">
		<div class="sitebar">
	        <div class="sitebar_item">
	            <ul id="menu" >
	                <foreach="$option['list_detail'] as $other ">
						<li><a href="{$other->getUrl($other->getModule())}">{$other->getTitle()}</a></li>
					</foreach>
	            </ul>
	        </div>
	       
	     </div>
		 </if>
	    <div class="center">
	    	<div class="title_detail">{$obj->getTitle()}
				<if="$bw->input[0]!='abouts'">
					<if="$bw->input[0]!='services'">
					<span>{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}</span>
					</if>
				</if>
			</div>
	       {$obj->getContent()}
	       		<if="$option['other']">
				<div class="other">
	            	<div class="other_title"><a>{$this->getLang()->getWords('tinlienquan','関連ニュース')}</a></div>
	                <ul>
	                	<foreach="$option['other'] as $other ">
							<li><a href="{$other->getUrl($other->getModule())}">{$other->getTitle()}</a></li>
						</foreach>
	                </ul>
	            </div>
	        	</if>
	    </div>
	    <div class="clear"></div>
	</div>

		
				

EOF;
	}


	

}
?>