<?php

class skin_address extends skin_objectpublic {
	
function showDefault($option = array()) {
		global $bw,$vsPrint;
		$vsPrint->addExternalJavaScriptFile("http://maps.google.com/maps/api/js?sensor=true&language=vi");
	
		$BWHTML .= <<<EOF
		
		
		<div class="main_content_full">
     		<div class="primary">
		        <div class="breakcrum">
		            {$option['breakcrum']}
		              <p class="clear"></p>
		        </div>
		    </div><!--end primary-->  
		      <div class="clear"></div>
        	<div class=" select_cate_de">
            	<ul class="list_cate_child">
                	<li class="list_first"><a href="">hệ thống cửa hàng</a></li>
                  <div class="clear"></div>                             
                </ul>
                <div class="clear"></div>
                <div class="main_ht">
                	<table width="100%" border="1">
						<foreach="$option['cate'] as $key=>$value">
	                      <tr>
	                        <th colspan="3">{$value->getTitle()}</th>
	                      </tr>
	                      <foreach="$option['pageList'][$key] as $obj">
	                      <tr>
	                        <td width="342"><h3>{$obj->getTitle()}</h3>
	                        				<p>{$obj->getIntro()}</p>
	                                    </td>
	                        <td width="381">{$obj->getContent()}
	                                        </td>
	                        <td width="341"><div class="map_ht" onclick="show_map({$obj->getId()})" >Bản đồ</div></td>
	                      </tr>
	                      </foreach>
                     	</foreach>
                    </table>

              </div><!--end main_ht-->
                
            </div><!--end select_se-->
            <div class="clear"></div>
            
            
        </div><!--end main_content-->


		<script>
			function show_map(id){
				$.fancybox({
			       type: 'ajax',
			       href:baseUrl+"address/address_address_map/"+id   
			    });

				
			}
		
		</script>

	
EOF;
	}



function showMap($obj){
		global $bw;
		
		
		
		$BWHTML .= <<<EOF
		
		<style>
			#map_canvas{
				color:#000;

			}
		</style>
		
		
		<div style="padding:10px;" ><div id="map_canvas" style="width:450px; height:450px; border:1px solid #333;" ></div></div>
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
	}	
	
	
}
