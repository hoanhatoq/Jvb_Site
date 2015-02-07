<?php
if(!class_exists('skin_pages'))
require_once ('./cache/skins/user/finance/skin_pages.php');
class skin_payment extends skin_pages {

//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw,$vsPrint;
$this->bw=$bw;



$this->catTitle=$option['cate_obj']->getTitle();
$this->urlCate="{$this->bw->base_url}news/category/{$option['cate_obj']->getSlugId()}";


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="container">
<!--box_title-->
<div class="row" id="margintop">
<div class="col-md-12 col-xs-12 col-sm-12">
<div class="tieude">
<h2 style="width:18%;" ><span>{$obj->getTitle()}</span></h2>
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
<div class="col-md-12 col-sm-12 col-xs-12">
<h1 class="titleDetail">

</h1>
{$obj->getContent()}
</div>



</div>
<!--wrapper_content-->
</div>
</div>
<!--end content rao vặt-->
</div>
</div>
<script>
var urlcate= '{$this->urlCate}';

</script>
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>