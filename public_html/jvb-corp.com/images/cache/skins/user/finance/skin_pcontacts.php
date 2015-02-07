<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_pcontacts extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($obj="",$option=array()) {//$option['ban']= $this->getAddon()->getBannerByCode("BANNER_PRO");
//$option['abouts']=Object::getObjModule('pages', 'abouts', '>0');

global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content">
    
    <div class="center_f">
        <div class="p_contact">{$obj->getContent()}</div>
        {$this->getContactForm($option)}
        <div class="map" id="map_canvas"></div>
        <div class="clear"></div>
    </div>
        <div class="pager">
            {$option['paging']}
        </div>
    </div>
    <div class="clear"></div>
</div>


    <script>
     function init() {
                                               
    var myHtml = "<h4>{$obj->getTitle()}</h4><p>{$obj->getAddress()}</p>";
                                                
      var map = new google.maps.Map(
      document.getElementById("map_canvas"),
      {scaleControl: true}
      );
      map.setCenter(new google.maps.LatLng({$obj->getLatitude()},{$obj->getLongitude()}));
      map.setZoom({$obj->getZoom()});
      map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
      var marker = new google.maps.Marker({
      map: map,
      position:map.getCenter()
});
var infowindow = new google.maps.InfoWindow({
'pixelOffset': new google.maps.Size(0,15)
});
      infowindow.setContent(myHtml);
      infowindow.open(map, marker);
    }
    $(document).ready(function(){
init();
});
            </script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getContactForm:desc::trigger:>
//===========================================================================
function getContactForm($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <form id="contact" class="contact" method="POST" action="">
                     <label>{$this->getLang()->getWords('name_ct','Họ tên')}<font>(<span>*</span>)</font> </label><input class="an" name="name" required type="name" class="col_left" value="{$option['obj']->getName()}"  />
                    <div class="clear"></div>
                    
                    <!--<label>{$this->getLang()->getWords('address_ct','Địa chỉ')}<font>(<span>*</span>)</font></span></label><input name="address" required type="name" value="{$option['obj']->getAddress()}"  />
                    <div class="clear"></div>-->
                    
                    <label>{$this->getLang()->getWords('phone_ct','Điện thoại')}<font>(<span>*</span>)</font></label><input name="phone" required type="name"  value="{$option['obj']->getPhone()}"  />
                    <div class="clear"></div>
                    
                    <label>{$this->getLang()->getWords('email_ct','Email')}<font>(<span>*</span>)</font></label><input  name="email" required type="email" value="{$option['obj']->getEmail()}"  />                           
                    <div class="clear"></div>
                    
                  <label>{$this->getLang()->getWords('title_ct','Tiêu đề')}<font>(<span>*</span>)</font></label><input class="an" name="title" required type="name" class="col_left" value="{$option['obj']->getTitle()}"  />
                    <div class="clear"></div>
                    <label>{$this->getLang()->getWords('content_ct','Nội dung')}:</label><textarea class="an" name="content">{$option['obj']->getContent()}</textarea>
                    <div class="clear"></div>
                     <label>{$this->getLang()->getWords('capcha_ct')} :</label><input  name="sec_code"  type="text" style="width:100px" />
                     <img id="siimage" src="{$bw->vars['board_url']}/vscaptcha/" />
                     <a href="#" id="reload_img" class="mamoi">refresh</a>
                    <div class="clear"></div> 
<div class="required_text"><span>(*)</span>{$this->getLang()->getWords('required','Nội dung')}</div> 
                    <input type="submit" name="btnSubmit" value="{$this->getLang()->getWords('send_ct','Gửi ngay')}" class="input_submit" />
                    <input type="reset" name="btnSubmit" value="{$this->getLang()->getWords('reset_ct','Làm lại')}" class="input_reset" />
                   
                    <div class="clear"></div>
               </form>
                        
                 <script>
                            $("#reload_img").click(function(){
                            $("#siimage").attr("src",$("#siimage").attr("src")+"?a");
                            return false;
                            
});

</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:sendContactSuccess:desc::trigger:>
//===========================================================================
function sendContactSuccess($obj="",$option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content">
   <div class="center_f">
      {$this->getLang()->getWords('contact_thankyou')}
    </div>
</div>
            <script>
 $(document).ready(function()
                            {
                             
                            });
                        
                        setTimeout('relead()',5000);
                        function relead(){
                                document.location.href = "{$bw->base_url}home";
                        }
                        
            </script>
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>