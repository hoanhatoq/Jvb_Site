<?php

class skin_pcontacts extends skin_objectadmin {
	function addEditObjForm($obj, $option = array()) {
		global $bw;
		if(!$obj->getLatitude()) $obj->setLatitude($this->getSettings()->getSystemKey('default_latitude','10.810691379544469'));
		if(!$obj->getLongitude()) $obj->setLongitude($this->getSettings()->getSystemKey('default_longitude','106.66831443098454'));
		if(!$obj->getZoom()) $obj->setZoom($this->getSettings()->getSystemKey('default_zoom','17'));
		$BWHTML .= <<<EOF
		<div class="vs_panel" id="vs_panel_{$this->modelName}">
		<div class="ui-dialog">
<div >

</div>

		<form class="frm_add_edit_obj" id="frm_add_edit_obj"  method="POST" enctype='multipart/form-data'>
		<input type="hidden" value="{$bw->input['vdata']}" name="vdata"/>
		<input type="hidden" value="{$bw->input['pageIndex']}" name="pageIndex"/>
		<input type="hidden" value="{$obj->getId()}" name="{$this->modelName}[id]"/>
			<table class="obj_add_edit">
				<thead>
					<tr>
						<th colspan="2">
							<span class="ui-dialog-title-form">{$this->getLang()->getWords('add_edit_'.$bw->input[0],'Thêm/Sửa tin')}</span>
							<div class="vs-buttons">
								<button type="submit" ><span><img src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" class="icon-wrapper-vs vs-icon-accept"></span><span>{$this->getLang()->getWords('global_accept')}</span></button>
								<button type="button" id="frm_close" class="btnCancel frm_close"><span><img src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" class="icon-wrapper-vs vs-icon-cancel"></span><span>{$this->getLang()->getWords("global_cancel")}</span></button>
							</div>
						</th>
					</tr>
					
				</thead>
				<tbody>
				<tr>
					<td style="width: 111px;"><label>{$this->getLang()->getWords('title')}</label></td>
					<td>
					<input  name="{$this->modelName}[title]" id="{$this->modelName}_title" type="textbox" value="{$obj->getTitle()}" style='width:100%' />
					</td>
				</tr>
				<if="$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_status",1,$bw->input[0])">
				<tr>
					<td style="width: 121px;"><label>{$this->getLang()->getWords('status')}</label></td>
					<td>
					<label>
						<input <if="$obj->getStatus()=='0'">checked='checked'</if>  name="{$this->modelName}[status]" id="{$this->modelName}_status_0" type="radio" value="0"  />
						{$this->getLang()->getWords('hide')}
						<!--<img title="{$this->getLang()->getWords('hide')}" src="{$bw->vars['img_url']}/status_0.png"/>-->
					</label>
					<label>
						<input <if="$obj->getStatus()==1||$obj->getStatus()==null">checked='checked'</if>  name="{$this->modelName}[status]" id="{$this->modelName}_status_1" type="radio" value="1"  />
						{$this->getLang()->getWords('visible')}
						<!--<img title="{$this->getLang()->getWords('visible')}" src="{$bw->vars['img_url']}/status_1.png"/>-->
					</label>
					<if="$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_status_home",0,$bw->input[0])">
					<label>
						<input  <if="$obj->getStatus()==2">checked='checked'</if>  name="{$this->modelName}[status]" id="{$this->modelName}_status_2" type="radio" value="2"  />
						{$this->getLang()->getWords('home')}
						<!--<img title="{$this->getLang()->getWords('home')}" src="{$bw->vars['img_url']}/status_2.png"/>-->
					</label>
					</if>
					</td>
				</tr>
				</if>
				<if="$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_category_list",0,$bw->input[0])">
				<tr>
					<td><label>{$this->getLang()->getWords("category")}</label></td>
					<td>
					<select  name="{$this->modelName}[catId]">
						<foreach="$this->model->getCategories()->getChildren() as $cate">
							 <option value="{$cate->getId()}">{$cate->getTitle()}</option>
						</foreach>
					</select>
					<br>
					</td>
				</tr>
				</if>
				<if="$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_index",1,$bw->input[0])">
				<tr>
					<td><label>{$this->getLang()->getWords("index")}</label></td>
					<td>
					<input  name="{$this->modelName}[index]" id="{$this->modelName}_index" type="textbox" value="{$obj->getIndex()}" />
					</td>
				</tr>
				</if>
				
				<if="$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_intro",1,$bw->input[0])">
				<tr>
					<td><label>{$this->getLang()->getWords('intro')}</label></td>
					<td>
					{$this->createEditor($obj->getIntro(), "{$this->modelName}[intro]", "100%", "333px")}
					</td>
				</tr>
				</if>
				<tr>
					<td><label>{$this->getLang()->getWords('content')}</label></td>
					<td>
					{$this->createEditor($obj->getContent(), "{$this->modelName}[content]", "100%", "333px")}
					</td>
				</tr>
				<if="$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_google_map",1,$bw->input[0])">
				<tr>
					<td><label>{$this->getLang()->getWords('google_map')}</label></td>
					<td>
					<div style="margin-top: 10px;">
					{$this->getLang()->getWords('address')}:<input type="text" style='width:500px;' id="address" name="{$this->modelName}[address]" value="{$obj->getAddress()}"/>
					</div>
					<div style="margin-top: 10px;">
					Y:<input type="text" id="gmap_lng" name="{$this->modelName}[longitude]" value="{$obj->getLongitude()}"/>
					X:<input type="text" id="gmap_lat" name="{$this->modelName}[latitude]" value="{$obj->getLatitude()}"/>
					
					Zoom:<input type="text" id="gmap_zoom" name="{$this->modelName}[zoom]" value="{$obj->getZoom()}"/>
					</div>
					<a class="find_address" onclick="return false;">{$this->getLang()->getWords('obj_choise_place', ' Choise Place')}</a> |
					<a class="go_hcm" onclick="return false;">{$this->getLang()->getWords('obj_center_hcm', ' Center HCM')} </a>
					<div id="show_google_map" style="display:none; margin-top: 10px;">
						<h3 class="ttks_title"><span>{$this->getLang()->getWords('Google_map_goo','Bản đồ google')}</span></h3>
						<div class="clear_left" ></div>
						<div class="gioithieuks" style="padding-top:10px;">
							<div id="map_canvas" style="height: 500px;">Google image not show</div>
							<div class="clear_left" ></div>
						</div>
					</div>
					</td>
				</tr>
				</if>
				<tr>
				<td></td>
				<td>
				<center>
				<input type="submit" value="{$this->getLang()->getWords('accept')}" class="btnOk"/>
				<input type="button" id="frm_close" value="{$this->getLang()->getWords("Cancel")}" class="btnCancel frm_close"/>
				</center>
				</td>
				</tr>
				</tbody>
			</table>
		</form>
		</div>
		<script>
			$('.find_address').click(function(){
				$("#show_google_map").animate({"height": "toggle"}, { duration: 1000 });
				if($('#gmap_lat').val() & $('#gmap_lng').val()){
				    stockholm = new google.maps.LatLng($('#gmap_lat').val(), $('#gmap_lng').val());
				    parliament = new google.maps.LatLng($('#gmap_lat').val(), $('#gmap_lng').val());
				}

			    initialize();
			});
			$('.go_hcm').click(function(){
			   $("#show_google_map").animate({"height": "toggle"}, { duration: 1000 });
			    stockholm = new google.maps.LatLng('10.798', '106.696');
			    parliament = new google.maps.LatLng('10.798', '106.696');
			    initialize();
			});
			
			$("#frm_add_edit_obj").submit(function(){
				var flag=false;
				var message="";
				var frm=$(this);
				
				vsf.uploadFile("frm_add_edit_obj", "{$bw->input[0]}", "{$this->modelName}_add_edit_process", "vs_panel_{$this->modelName}","{$bw->input[0]}",1,
							function(){
								var hashbase=frm.parents('.ui-tabs-panel').attr('id');
								window.location.hash=hashbase+"{$bw->input['back']}";	
							}
				);
				return false;
			});
			
			$(".frm_close").click(function(){
			//vsf.get('{$bw->input[0]}/{$this->modelName}_display_tab&pageIndex={$bw->input['pageIndex']}&vdata={$_REQUEST['vdata']}','vs_panel_{$this->modelName}');
//			vsf.get('{$bw->input[0]}/{$this->modelName}_display_tab','vs_panel_{$this->modelName}',{vdata:'{$_REQUEST['vdata']}',pageIndex:'{$bw->input['pageIndex']}'});
//			return false;
			var hashbase=$(this).parents('.ui-tabs-panel').attr('id');
			window.location.hash=hashbase+"{$bw->input['back']}";
				///alert(window.location.hash);
			//vsf.get('{$bw->input[0]}/{$this->modelName}_display_tab&pageIndex={$bw->input['pageIndex']}&vdata={$_REQUEST['vdata']}','vs_panel_{$this->modelName}');
			//vsf.get('{$bw->input[0]}/{$this->modelName}_display_tab','vs_panel_{$this->modelName}',{vdata:'{$_REQUEST['vdata']}',pageIndex:'{$bw->input['pageIndex']}'});
			return false;
			});
		////////*********************select file field*************************/
						$("input[type='radio']").change(function(){
							if($(this).val()=='link'||$(this).val()=='file'){
							
								$("input[name='"+this.name+"']").each(function(){
										if($(this).attr("checked")){
											$("#"+$(this).attr('obj')).removeAttr("disabled");
										}else{
											$("#"+$(this).attr('obj')).attr("disabled","disabled");
										}
								});
								
							}
						});
						<if="$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_google_map",1,$bw->input[0])">
     var stockholm = new google.maps.LatLng('{$obj->getLatitude()}', '{$obj->getLongitude()}');
  var parliament = new google.maps.LatLng('{$obj->getLatitude()}', '{$obj->getLongitude()}');
  var marker;
  var map;
  function initialize() {
    var mapOptions = {
      zoom: {$obj->getZoom()},
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: stockholm
    };
    map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
          
    marker = new google.maps.Marker({
      map:map,
      draggable:true,
      animation: google.maps.Animation.DROP,
      position: parliament
    });
    google.maps.event.addListener(marker, 'click', toggleBounce);
    google.maps.event.addListener(marker, 'mouseup', function(event) {
//    alert(event.latLng.lat());
//    alert(event.latLng.lng());
	//console.log(marker);
    $("#gmap_lat").val(event.latLng.lat());
    $("#gmap_lng").val(event.latLng.lng());
     $("#gmap_zoom").val(marker.map.getZoom());
  });
    
  }
  function toggleBounce() {
    if (marker.getAnimation() != null) {
      marker.setAnimation(null);
    } else {
      marker.setAnimation(google.maps.Animation.BOUNCE);
    }
  }
  $(document).ready(function(){
initialize();
});			
		</if>				
		</script>
		
EOF;
	}
}
