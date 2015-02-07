<?php
if(!class_exists('skin_pages'))
require_once ('./cache/skins/user/finance/skin_pages.php');
class skin_special extends skin_pages {

//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw,$vsPrint;
$this->bw=$bw;


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content">
    <div class="centers">
    
       {$obj->getContent()}
       
    </div>
    <div class="clear"></div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>