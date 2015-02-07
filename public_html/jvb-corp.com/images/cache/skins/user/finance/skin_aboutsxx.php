<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_aboutsxx extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsPrint;
$this->bw=$bw;
$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");

$cateId = $option['obj']?$option['obj']->getId():0;


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


//--starthtml--//
$BWHTML .= <<<EOF
        <div id="main">
        {$this->getAddon()->getProductCategory($option)}
        <div id="main-left" class="main-content">
            <div class="row">
            <!-- content left -->
            <div class="col-md-9">                         
                <div class="row">
                    <div class="col-md-12">
                        <div class="group-title">                        
                            <h2>Giới thiệu</h2>                                                    
                        </div>
                    </div>
                    <div class="news">
                   {$obj->getContent()} 
                    </div>
                   
                   
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
// <vsf:showMore:desc::trigger:>
//===========================================================================
function showMore($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>