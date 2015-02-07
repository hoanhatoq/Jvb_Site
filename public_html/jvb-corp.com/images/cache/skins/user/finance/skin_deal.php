<?php
if(!class_exists('skin_pages'))
require_once ('./cache/skins/user/finance/skin_pages.php');
class skin_deal extends skin_pages {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsPrint;
$this->bw = $bw;
    $this->brand=VSFactory::getMenus()->getCategoryGroup('brand')->getChildren();
    $option['item_f']=array_shift($option['pageList']);
    $vsPrint->addCurentJavaScriptFile ('jquery.countdown');
    if(isset($option['item_f'])) 
    if($option['item_f']->getDateEnd()>time()){
      $this->stop="Bạn vẫn còn mua được";
    }else{
      $this->stop="Sản phẩm hết thời gian đặt hàng";
    }
    //print_r($this->stop);die;


//--starthtml--//
$BWHTML .= <<<EOF
        <!-- container-->
      <div class="container margintop">     
        <div class="row">
          <!--content rao vặt-->
          <div class="col-md-12 col-xs-12 col-sm-12">
            <div class="wrapper">
              <div class="tieude">
                 <ul class="nav nav-tabs">
                  <li class="active"><a >CÙNG MUA</a></li>    
                 </ul>
              </div>
              
              <!--wrapper_content-->
              <div class="wrapper_buy">

EOF;
if($option['item_f']) {
$BWHTML .= <<<EOF

                <div class="colmargin col-md-12 col-xs-12 col-sm-12 col12" id="padding">
                  <div class="col-md-3 col-sm-2 col-xs-3">
                    <div class="buy_img">
                       <a href="{$option['item_f']->getUrl('products')}">{$option['item_f']->createImageCache($option['item_f']->getImage(),260,300)}</a>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-8 col-xs-6 buyBorder wtPadding mobile_sx" id="padding">
                    <div class="buy-description">
                      <div class="buyProInfo">
                        <h2><a href="{$option['item_f']->getUrl('products')}">{$option['item_f']->getTitle()}</a></h2>
                        <p>{$option['item_f']->getIntro()}</p>
                        <p>Mã hàng: {$option['item_f']->getCode()}</p>
                      </div>
                      <div class="buy_datetime">
                        <div class="buy_date"><span>Thời gian còn lại:</span></div>
                        <div id="cundown_first" class="buy_time"></div>
                        <div class="clear"></div>
                        <div class="buyPrice buyPrice_mobi">
                            
EOF;
if($option['item_f']->getPrice()) {
$BWHTML .= <<<EOF
<p><small class="gia">Giá: <span><b>{$this->numberFormatDeal($option['item_f'])}</b></span> đ</small></p>
EOF;
}

$BWHTML .= <<<EOF

                            <div class="orderpro"><a onclick="addCart({$option['item_f']->getId()})" href="javascript:void(0)">MUA HÀNG</a></div>
                        </div>
                      </div>
             <div class="buyPel">
                        <p class="p1">Đã có <b>{$option['item_f']->getSold()}/{$option['item_f']->getNumber_deal()}</b> người mua</p>
                        <p class="p2">Bạn vẫn còn mua được</p>
                      </div>
                      
                      <div class="social">
                        {$this->getAddon()->getHtml()->getSocial()}
                      </div>
                    </div>
                  </div>
                  <div class="col_mobile_f col-md-3 col-sm-2 col-xs-3" id="padding">
                    <div class="buyPrice">
                      
EOF;
if($option['item_f']->getPrice()) {
$BWHTML .= <<<EOF
<p><small class="gia">Giá: <span><b>{$this->numberFormatDeal($option['item_f'])}</b></span> đ</small></p>
EOF;
}

$BWHTML .= <<<EOF

                      <div class="orderpro"><a onclick="addCart({$option['item_f']->getId()})" href="javascript:void(0)">MUA HÀNG</a></div>
                    </div>
                    
                  </div>
                </div>
                <script>
                  $(document).ready(function(){
                    $('#cundown_first').countdown({
                        timestamp : (new Date()).getTime() + {$this->getCundown($option['item_f']->getDateEnd())}*1000
                    });
                  }); 
                </script>

EOF;
}

$BWHTML .= <<<EOF



               
                <div class="col-md-12 col-xs-12 col-sm-12" id="padding">
                  <!--product left-->
                  {$this->item_deal($option['pageList'])}
                  
                </div>
                
              </div>
              <!--wrapper_content-->
            </div>
          </div>
          <!--end content rao vặt-->
        </div>
        
        <!--page-->
        <div class="row">
          <div class="col-md-12 col-xs-12 col-sm-6 page">
            <ul class="pagination">
              {$option['paging']}
            </ul>
          </div>
        </div>
        <!--end page-->
      </div>
      <!-- end container-->
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw, $vsPrint;
$this->bw = $bw;

 $this->catTitle=$option['cate_obj']->getTitle();
 $this->bw=$bw;
 $this->urlCate="{$this->bw->base_url}products/category/{$option['cate_obj']->getSlugId()}";
$vsPrint->addCurentJavaScriptFile ('jquery.countdown');
$this->brand=VSFactory::getMenus()->getCategoryGroup('brand')->getChildren();

//--starthtml--//
$BWHTML .= <<<EOF
        <script>
        $(document).ready(function(){
          $('#cundown_detail_deal').countdown({
              timestamp : (new Date()).getTime() + {$this->getCundown($obj->getDateEnd())}*1000
          });
        }); 
      </script>
    <div class="container margintop">
       
        
        <div class="row">
          <!--content rao vặt-->
          <div class="col-md-12">
            <div class="wrapper">
              <div class="tieude">
                 <ul class="nav nav-tabs">
                  <li class="active"><a  >CÙNG MUA</a></li>
                   
                 </ul>
                </div>
              
              <!--wrapper_content-->
              <div class="wrapper_buy">
                
                <div class="colmargin col-md-12 col-xs-12 col-sm-12 col12" id="padding">
                  <div class="col-md-3 col-sm-2 col-xs-3">
                    <div class="buy_img">
                      {$obj->createImageCache($obj->getImage(),260,300)}
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-8 col-xs-6 buyBorder wtPadding mobile_sx" id="padding">
                    <div class="buy-description">
                      <div class="buyProInfo">
                        <h2>{$obj->getTitle()}</h2>
                        <p>{$obj->getIntro()}</p>
                        
EOF;
if($obj->getCode()) {
$BWHTML .= <<<EOF
<p>Mã hàng: {$obj->getCode()}</p>
EOF;
}

$BWHTML .= <<<EOF

                      </div>
                      <div class="buy_datetime">
                        <div class="buy_date"><span>Thời gian còn lại:</span></div>
                        <div id="cundown_detail_deal" class="buy_time">
                          
                        </div>
                        <div class="buyPrice buyPrice_mobi">
                            <h5>Thương hiêu: <span style="color:blue;"><b>{$this->brand[$obj->getBrand()]->getTitle()}</b></span></h5> 
                            
EOF;
if($obj->getPrice()) {
$BWHTML .= <<<EOF
<p><small class="gia">Giá: <span><b>{$this->numberFormat($obj->getPrice())}</b></span> đ</small></p>
EOF;
}

$BWHTML .= <<<EOF

                            
EOF;
if($obj->getPromotion()) {
$BWHTML .= <<<EOF
<p><strong class="gia">Giá KM: <span style="font-weight: bolder;font-size:19px">b>{$this->numberFormat($obj->getPromotion())}</b></span> đ</strong></p>
EOF;
}

$BWHTML .= <<<EOF

                            <p style="color:#ff0000;text-shadow:1px 1px 1px #969696;font-weight:bold;font-size:19px;font-style:italic">
                              
EOF;
if($obj->getType()==1) {
$BWHTML .= <<<EOF
Còn hàng
EOF;
}

else {
$BWHTML .= <<<EOF
Hết hàng
EOF;
}
$BWHTML .= <<<EOF

                            </p>
                            <div class="orderpro"><a onclick="addCart({$obj->getId()})" href="javascript:void(0)">MUA HÀNG</a></div>
              
                          </div>
                      </div>
                      <div class="buyPel">
                        <p class="p1">Đã có <b>{$obj->getSold()}/{$obj->getNumber_deal()}</b> người mua</p>
                        <p class="p2">Bạn vẫn còn mua được</p>
                      </div>
                      <div class="social">
                        {$this->getAddon()->getHtml()->getSocial()}
                      </div>
                    </div>
                  </div>
                  <div class="col_mobile_f col-md-3 col-sm-2 col-xs-3" id="padding">
                    <div class="buyPrice">
                      <h5>Thương hiêu: <span style="color:blue;"><b>{$this->brand[$obj->getBrand()]->getTitle()}</b></span></h5> 
                      
EOF;
if($obj->getPrice()) {
$BWHTML .= <<<EOF
<p><small class="gia">Giá: <span><b>{$this->numberFormat($obj->getPrice())}</b></span> đ</small></p>
EOF;
}

$BWHTML .= <<<EOF

                      
EOF;
if($obj->getPromotion()) {
$BWHTML .= <<<EOF
<p><strong class="gia">Giá KM: <span style="font-weight: bolder;font-size:19px">b>{$this->numberFormat($obj->getPromotion())}</b></span> đ</strong></p>
EOF;
}

$BWHTML .= <<<EOF

                      <p style="color:#ff0000;text-shadow:1px 1px 1px #969696;font-weight:bold;font-size:19px;font-style:italic">
                        
EOF;
if($obj->getType()==1) {
$BWHTML .= <<<EOF
Còn hàng
EOF;
}

else {
$BWHTML .= <<<EOF
Hết hàng
EOF;
}
$BWHTML .= <<<EOF

                      </p>
                      <div class="orderpro"><a onclick="addCart({$obj->getId()})" href="javascript:void(0)">MUA HÀNG</a></div>
        
                    </div>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="col12 cl_deal">{$obj->getContent()}</div>
                
                <div class="col-md-12 margintop" id="padding">
                  <!--comment advertisement-->
                  <div class="wrapper_content">
                    <div id="padding" class="col-md-8 col-xs-12 col-sm-7 com_info"><!--comment face-->
                       {$this->getAddon()->getHtml()->getComment($option['comment'])}
                    </div>
                    
                    <!--advertisement-->
                    {$this->getAddon()->getHtml()->getPromotionBannerDeal()}
                    <!--end advertisement-->
                  </div>
                  <!--end comment advertisement-->
                  
                  <!--product-->
                  
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

                  <div class="wrapper_buy">
                    <div class="col-md-12 border-top" id="padding">
                      <div class="news_diff margintop"><h2>SẢN PHẨM CÙNG LOẠI</h2></div>
                    </div>
                    
                    <div class="col-md-12 col-xs-12 col-sm-12" id="padding">
                      {$this->item_deal($option['other'])}
                    </div>
                
                  </div>
                  
EOF;
}

$BWHTML .= <<<EOF

                  <!--end product-->
                </div>
              </div>
              <!--wrapper_content-->
            </div>
          </div>
          <!--end content rao vặt-->
        </div>
        
        <!--page-->
        
        <!--end page-->
      </div>
      <!-- end container-->
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:item_deal:desc::trigger:>
//===========================================================================
function item_deal($option=array()) {global $bw,$vsPrint;

//--starthtml--//
$BWHTML .= <<<EOF
        {$this->__foreach_loop__id_53d1c685867ba($option)}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c685867ba($option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option)){
    foreach( $option as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
      <div class="col-md-6 colmargin smpaddingRight" id="
EOF;
if($vsf_count%2!=0) {
$BWHTML .= <<<EOF
paddingleft
EOF;
}

else {
$BWHTML .= <<<EOF
paddingright
EOF;
}
$BWHTML .= <<<EOF
">
        <div class="col12">
          <div class="col-md-5">
            <div class="ListBuyPro">
              <a href="{$value->getUrl('products')}">{$value->createImageCache($value->getImage(),260,300)}</a>
              <p style="margin: 0 0 3px 0">{$value->getTitle()}</p>
              
EOF;
if($value->getPrice()) {
$BWHTML .= <<<EOF
<small class="gia">Giá: <span>{$this->numberFormatDeal($value)}</span> đ</small>
EOF;
}

$BWHTML .= <<<EOF

              
            </div>
          </div>
          <div class="col-md-7 buyBorder">
            <div class="buy-description">
              <div class="buyProInfo">
                <h2><a href="{$value->getUrl('products')}">{$value->getTitle()}</a></h2>
                
EOF;
if($value->getcode()) {
$BWHTML .= <<<EOF
<p>Mã hàng: {$value->getcode()}</p>
EOF;
}

$BWHTML .= <<<EOF

              </div>
              <div class="buy_datetime">
                <div class="ListBuyProDate"><span>Thời gian còn lại:</span></div>
                <div id="cundown_{$value->getId()}" class="ListBuyProTime">
                  
                </div>
              </div>
              <div class="buyPel">
                 <p class="p1">Đã có <b>{$value->getSold()}/{$value->getNumber_deal()}</b> người mua</p>
                 <p class="p2">Bạn vẫn còn mua được</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--end product left-->
    <script>
      $(document).ready(function(){
        $('#cundown_{$value->getId()}').countdown({
            timestamp : (new Date()).getTime() + {$this->getCundown($value->getDateEnd())}*1000
        });
      }); 
    </script>
  
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>