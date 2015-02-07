<?php
class skin_news extends skin_objectpublic{
	function showDefault($option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		
        $option['news']=Object::getObjModule('pages',$bw->input[0], '>0','',6);


		$BWHTML .= <<<EOF
        

        <div class="content">
    <div class="sitebar">
        <if="$option['cate']">
        <div class="sitebar_item">
            <ul>
                <foreach="$option['cate'] as $key=>$value">
                <li><a href="{$value->getCatUrl()}">{$value->getTitle()}</a></li>
                </foreach>
            </ul>
        </div>
        </if>
        <div class="sitebar_item">
            <div class="lasted_title">{$this->getLang()->getWords('tin-noibat','Tin nổi bật')}</div>
            <foreach="$option['news'] as $key=>$value">
                <if="$vsf_count==1">
                <div class="lasted_top">
                    <div class="title"><a href="{$value->getUrl($value->getModule())}">{$value->getTitle()}</a></div>
                    <div class="im"><a href="{$value->getUrl($value->getModule())}">{$value->createImageCache($value->getImage(),85,60,3)}</a></div>
                    <div class="intro">
                        {$this->cut($value->getIntro(),150)}
                    </div>
                </div>
                <else />
                <div class="lasted_item"><a href="{$value->getUrl($value->getModule())}">{$value->getTitle()}</a></div>
                </if>
            </foreach>
        </div>
     </div>
    <div class="center">
        <foreach="$option['pageList'] as $obj ">
        <div class="news_item">
            <div class="im"><a href="{$obj->getUrl($obj->getModule())}">{$obj->createImageCache($obj->getImage(),85,68,3)}</a></div>
            <div class="title"><a href="{$obj->getUrl($obj->getModule())}">{$obj->getTitle()} - <span>{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}</span></a></div>
            <div class="intro"><p>{$this->cut($obj->getIntro(),150)}</p></div>
        </div>
        </foreach>

        <div class="pager">
            {$option['paging']}
        </div>

    </div>
    <div class="clear"></div>
</div>




EOF;
	}
	
	function showDetail($obj,$option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		
		//$this->catTitle=$option['cate_obj']->getTitle();
		//$this->urlCate="{$this->bw->base_url}news/category/{$option['cate_obj']->getSlugId()}";

        $option['news']=Object::getObjModule('pages',$bw->input[0], '>0','',6);
		
		$BWHTML .= <<<EOF
		


    <div class="content">
        <div class="sitebar">
        <if="$option['cate']">
        <div class="sitebar_item">
            <ul>
                <foreach="$option['cate'] as $key=>$value">
                <li class="active"><a href="{$value->getCatUrl()}">{$value->getTitle()}</a></li>
                </foreach>
            </ul>
        </div>
        </if>
        <div class="sitebar_item">
            <div class="lasted_title">Tin nổi bật</div>
            <foreach="$option['news'] as $key=>$value">
                <if="$vsf_count==1">
                <div class="lasted_top">
                    <div class="title"><a href="{$value->getUrl($value->getModule())}">{$value->getTitle()}</a></div>
                    <div class="im"><a href="{$value->getUrl($value->getModule())}">{$value->createImageCache($value->getImage(),85,60,3)}</a></div>
                    <div class="intro">
                        {$this->cut($value->getIntro(),150)}
                    </div>
                </div>
                <else />
                <div class="lasted_item"><a href="{$value->getUrl($value->getModule())}">{$value->getTitle()}</a></div>
                </if>
            </foreach>
        </div>

     </div>
    <div class="center">
        <div class="title_detail">{$obj->getTitle()} - <span>{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}</span></div>
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