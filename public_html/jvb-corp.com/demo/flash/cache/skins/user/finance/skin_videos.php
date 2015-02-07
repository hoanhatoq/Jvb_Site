<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_videos extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsPrint;
$this->bw=$bw;


//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw,$vsPrint;
$this->bw=$bw;

$this->catTitle=$option['cate_obj']->getTitle();
$this->urlCate="{$this->bw->base_url}news/category/{$option['cate_obj']->getSlugId()}";


//--starthtml--//
$BWHTML .= <<<EOF
        <script type="text/javascript">
$(document).ready(function(){
$('.scroll').jScrollPane();
});
</script>
<div id="main">
        {$this->getAddon()->getProductCategory($option)}
        <div id="main-left" class="main-content">
            <div class="row">
            <!-- content left -->
            <div class="col-md-9">                         
                <div class="row">
                    <div class="col-md-12">
                        <div class="group-title">                        
                            <h2>Video</h2>                                                    
                        </div>
                    </div>
                    <div class="news">
                   <div class="wapper_video">
                <div class="play">
                    <div class="title_play">{$obj->getTitle()}</div>
                       
                        <iframe width="100%" height="400" src="//www.youtube.com/embed/{$obj->getCode()}" frameborder="0" allowfullscreen></iframe>
                        
                    </div>
                   
                        <div  class="list_play scroll  ">
                            
                            {$this->__foreach_loop__id_53b8f304d87b2($obj,$option)}
                        
                        </div>
                 
                    

                
                </div>
           
                    
                    
                    <div class="clear"></div>
                </div>
                   <div class="clr"></div>
                    
                   
                </div>                                                
            </div>
            
            <!-- content right -->
            <div id="sidebar" class="col-md-3">
                <div class="row">
                   {$this->getAddon()->getHtml()->getNewsHome($option)}   
                   {$this->getAddon()->getHtml()->getCustomerBlock()}                                              
                </div>                    
            </div>
                
        </div>
        </div>
        </div><!-- end .main-content -->
        
                
    </div>
  
   

<script>
var urlcate= '{$this->urlCate}';

</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53b8f304d87b2($obj="",$option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['other'])){
    foreach( $option['other'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                            <div class="list_item">
                                <a class="im_list_item" href="{$obj->getUrl('videos')}">{$obj->createImageCache($obj->getImage(),203, 142)}</a>
                                <a class="na_list_item" href="{$obj->getUrl('videos')}">{$obj->getTitle()}</a>
                            </div>
                            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>