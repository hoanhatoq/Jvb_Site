<?php
if(!class_exists('skin_objectadmin'))
require_once ('./cache/skins/admin/red/skin_objectadmin.php');
class skin_products extends skin_objectadmin {

//===========================================================================
// <vsf:getTinhtrang:desc::trigger:>
//===========================================================================
function getTinhtrang($str="") {$hot="<div class='hot_pro'>";
foreach(explode(",",$str) as $key => $value) {
if($value==1){
$hot.= "<b>Mới<b>";
}
if($value==2){
$hot.= "<b>Bán chạy</b>";
}
if($value==3){
$hot.= "<b>Khuyến mãi<b>";
}
}
$hot.="</div";


//--starthtml--//
$BWHTML .= <<<EOF
        {$hot}
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getListItemTable:desc::trigger:>
//===========================================================================
function getListItemTable($objItems=array(),$option=array()) {global $bw;
$setting="{$bw->base_url}settings#settings/settings/settings_search/&search[catName]={$bw->input[0]}";

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="ui-dialog">
<span class="ui-dialog-title">{$this->getLang()->getWords($this->modelName."_title","Danh sách bài viết")}</span>
<a target="_blank" href="{$setting}" class="settings_action">{$this->getLang()->getWords('setting')}</a>

EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_search_form",1,$bw->input[0])) {
$BWHTML .= <<<EOF

{$this->getSearchForm($option)}

EOF;
}

$BWHTML .= <<<EOF

<form class="frm_obj_list" id="frm_obj_list">
<div class="vs-button">
{$this->addOption()}
<a class="btn_custom_settings icon-wrapper-vs" 
group="{$bw->input[0]}_{$this->modelName}_list">
</a>

EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_export",0,$bw->input[0])) {
$BWHTML .= <<<EOF

<a style="padding:4px;background:#DDDDDD" href="{$bw->var_board['url']}pages/pages_export">In dánh sách Email<a/>

EOF;
}

$BWHTML .= <<<EOF

</div>
<div id="{$this->modelName}_item_panel">
<input type="hidden" name="catId" value="{$bw->input['catId']}"/>
<input type="hidden" name="pageIndex" value="{$bw->input['pageIndex']}"/>
<table class="obj_list">
<thead>
<tr>
<th class="check-column" scope="col"><input type="checkbox" onClick="checkAllClick()" class="check_all" name=""/></th>

EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_Id','ID',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<th onclick="orderItem('id', '{$option['s_order']}')" class="id" scope="col">{$this->getLang()->getWords("id")}</th>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_image_field','Image',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<th class="img">{$this->getLang()->getWords("image","Hình ảnh")}</th>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_title','Title',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<th onclick="orderItem('title', '{$option['s_order']}')" class="title" scope="col">{$this->getLang()->getWords("title","Tiêu đề")}

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_category_list','Category',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<th>{$this->getLang()->getWords("category",'Danh mục')}</th>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_status','Status',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<th onclick="orderItem('status', '{$option['s_order']}')" class="status" scope="col">{$this->getLang()->getWords("status","Trạng thái")}</th>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_postdate','postdate',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<th class="date">{$this->getLang()->getWords("postdate","Ngày đăng")}</th>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_index','index',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<th class="index" scope="col">{$this->getLang()->getWords("index","Thứ tự")}</th>

EOF;
}

$BWHTML .= <<<EOF

<th class="action" scope="col">{$this->getLang()->getWords("action","Thao tác")}</th>
</tr>
</thead>
<tbody>

EOF;
if($objItems) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_53d3109b7ed7d($objItems,$option)}

EOF;
}

else {
$BWHTML .= <<<EOF

<tr><td colspan="10">{$this->getLang()->getWords("no_data","Hiện không có dữ liệu")}</td></tr>

EOF;
}
$BWHTML .= <<<EOF

</tbody>
<tfoot>
<tr>
<th colspan="3">{$this->addOption()}</th>
<th colspan="10" class="pagination">{$option['paging']}</th>
</tr>
</tfoot>
</table>
</div>

EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_category_list','Category',$bw->input[0].'_'.$this->modelName.'_list') and $this->model->getCategories()->getChildren()) {
$BWHTML .= <<<EOF

<div class="more_action">
<label>{$this->getLang()->getWords("move_to_categories","Di chuyển đến")} 
<select name='toCatId'>
{$this->model->getCategories()->getChildrenBoxOption()}
</select>
</label>
<input type="button" class="icon-wrapper icon-wrapper-vs btnGo" name="" onClick="changCate()"  title="{$this->getLang()->getWords("move_to_categories","Di chuyển đến")} "/>
</div>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($option['vdata']) {
$BWHTML .= <<<EOF

<input type="hidden" value='{$option['vdata']}' name="vdata"/>

EOF;
}

$BWHTML .= <<<EOF

</form>
</div>
<script>
var objChecked=new Array();
////////////////checked
function checkAllClick(){
var check=$("#vs_panel_{$this->modelName}  .check_all").attr("checked");
objChecked=new Array();
$("#vs_panel_{$this->modelName} .btn_checkbox").each(function(){
if(check=='checked'){
$(this).attr("checked","checked").change();
objChecked.push($(this).val());
}else{
$(this).removeAttr("checked").change();
}
});
}
function checkRow(){
objChecked=new Array();
$(".btn_checkbox").each(function(){
if($(this).attr("checked")){
objChecked.push($(this).val());
$(this).change();
}
});
}
$(".btn_checkbox").change(function(){
if($(this).attr("checked")){
$(this).parents("tr").addClass("marked");
}else{
$(this).parents("tr").removeClass("marked");
}
});
////////////
$("#vs_panel_{$this->modelName} #frm_obj_list").submit(function(){
});
$("#vs_panel_{$this->modelName} #btn-delete-obj").click(function(){
if(objChecked.length==0){
vsf.alert("{$this->getLang()->getWords('global_error_none_select','Vui lòng chọn một hay nhiều tin')}");
return false;
}
jConfirm(
                     "{$this->getLang()->getWords('global_yesno_delete','Bạn có chắc chắn muốn xóa nó?')}?",
                     "Hộp thông báo",
                     function(r){
if(r){
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_delete/'+objChecked,'vs_panel_{$this->modelName}');
}
 }
);
return false;
});
$("#vs_panel_{$this->modelName} #btn-disable-obj").click(function(){
if(objChecked.length==0){
alert("{$this->getLang()->getWords('global_error_none_select','Vui lòng chọn một hay nhiều tin')}");
return false;
}
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_hide_checked/'+objChecked,'vs_panel_{$this->modelName}');
return false;
});
$("#vs_panel_{$this->modelName} #btn-enable-obj").click(function(){
if(objChecked.length==0){
vsf.alert("{$this->getLang()->getWords('global_error_none_select','Vui lòng chọn một hay nhiều tin')}");
return false;
}
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_visible_checked/'+objChecked,'vs_panel_{$this->modelName}');
return false;
});
$("#vs_panel_{$this->modelName} #btn-home-obj").click(function(){
if(objChecked.length==0){
vsf.alert("{$this->getLang()->getWords('global_error_none_select','Vui lòng chọn một hay nhiều tin')}");
return false;
}
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_home_checked/'+objChecked,'vs_panel_{$this->modelName}');
return false;
});
$("#vs_panel_{$this->modelName} #btn-new").click(function(){
if(objChecked.length==0){
vsf.alert("{$this->getLang()->getWords('global_error_none_select','Vui lòng chọn một hay nhiều tin')}");
return false;
}
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_new_checked/'+objChecked,'vs_panel_{$this->modelName}');
return false;
});
$("#vs_panel_{$this->modelName} #btn-trash-obj").click(function(){
if(objChecked.length==0){
vsf.alert("{$this->getLang()->getWords('global_error_none_select','Vui lòng chọn một hay nhiều tin')}");
return false;
}
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_trash_checked/'+objChecked,'vs_panel_{$this->modelName}');
return false;
});
$("#vs_panel_{$this->modelName} #btn-index-change-obj").click(function(){
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_index_change/','vs_panel_{$this->modelName}');
return false;
});
$("#vs_panel_{$this->modelName} #btn-add-obj").click(btnAdd_Click);

function btnAdd_Click(){
var hashbase=$(this).parents('.ui-tabs-panel').attr('id');
window.location.hash=hashbase+"/{$bw->input[0]}/{$this->modelName}_add_edit_form/";
}
function btnEditItem_Click(id,c){
var hashbase=$(c).parents('.ui-tabs-panel').attr('id');
window.location.hash=hashbase+"/{$bw->input[0]}/{$this->modelName}_add_edit_form/"+id+'&{$bw->input['back']}';
return false;
}
function btnRemoveItem_Click(id){
jConfirm(
                     "{$this->getLang()->getWords('global_yesno_delete')}?",
                     "Hộp thông báo",
                     function(r){
if(r){
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_delete/'+id,'vs_panel_{$this->modelName}');
}
 }
);
return false;
}
function changCate(){
if(objChecked.length){
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_change_cate/'+objChecked,'vs_panel_{$this->modelName}');
}else{
vsf.alert("{$this->getLang()->getWords('global_error_none_select')}");
}
return false;
}
</script>

<script>

EOF;
if($option['message']) {
$BWHTML .= <<<EOF

jAlert('{$option['message']}');

EOF;
}

$BWHTML .= <<<EOF

</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d3109b7ed7d($objItems=array(),$option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($objItems)){
    foreach( $objItems as $item )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<tr class="$vsf_class">
<th class="check-column check_td" scope="row"><input onClick="checkRow()"  value="{$item->getId()}" type="checkbox" class="btn_checkbox"/></th>

EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_Id','ID',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<td>{$item->getId()}</td>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_image_field','Image',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<td> <a onClick="btnEditItem_Click({$item->getId()},this);return false;" href="">{$item->createImageCache($item->getImage(),100,50)}</a></td>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_title','Title',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<td><a onClick="btnEditItem_Click({$item->getId()},this);return false;" href="">{$item->getTitle()}</a>
{$this->getTinhtrang($item->getHot())}
</td>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_category_list','Category',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<td>

EOF;
if($this->getMenu()->getCategoryById($item->getCatId())) {
$BWHTML .= <<<EOF

{$this->getMenu()->getCategoryById($item->getCatId())->getTitle()}

EOF;
}

else {
$BWHTML .= <<<EOF

{$this->getLang()->getWords("Uncategory","Không có danh mục")}

EOF;
}
$BWHTML .= <<<EOF

</td>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_status','Status',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<td class="status"><img src="{$bw->vars['img_url']}/status/status_{$item->getStatus()}.png"></td>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_postdate','postdate',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<td>{$this->dateTimeFormat($item->getPostDate(),"d/m/Y") }</td>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_index','index',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<td class="index"><input type="text" name="indexitem[{$item->getId()}]" value="{$item->getIndex()}" size="3"/></td>

EOF;
}

$BWHTML .= <<<EOF

<td class="action">
{$this->addOtionList($item)}
</td>
</tr>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:popup:desc::trigger:>
//===========================================================================
function popup($option=array()) {global $bw;
$token = base64_encode ( time () );

//--starthtml--//
$BWHTML .= <<<EOF
        <div style="width:600px;height:400px;" class="form_import">
<form id="form_exel"  method="post" enctype="multipart/form-data" >
<input id="select-file" name="file" type="file">
<input  type="submit"   value="Import file exel">
<div id="bar"></div>
<div id="percent"></div>
<div id="result"></div>
</form>

</div>

<script>
  var bar = document.getElementById('bar')
  var percent = document.getElementById('percent')
  var result = document.getElementById('result')
  var percentValue = "percent 0%";
 
  var fileInput = document.getElementById('select-file');  
  var form = document.getElementById('form_exel');
 
  form.addEventListener('submit', function(evt) {
var fileName = $("#select-file").val();
if(!fileName){
alert('vui lòng chọn file excel');
evt.preventDefault();
return false;
}
    // Chan khong cho form tao submit
    evt.preventDefault();
 
    // Ajax upload
    var file = fileInput.files[0];
    
    
    $('#result').text('Đang import dử liệu...........');
 
    // fd dung de luu gia tri goi len
    var fd = new FormData();
    fd.append('file', file);
 
    // xhr dung de goi data bang ajax
    var xhr = new XMLHttpRequest();
    xhr.open('POST',baseUrl+'products/products_popup', true);
 
    xhr.upload.onprogress = function(e) {
      if (e.lengthComputable) {
        var percentValue = (e.loaded / e.total) * 100 + '%';
        percent.innerHTML  = percentValue;
        bar.setAttribute('style', 'width: ' + percentValue);
      }
    };
 
    xhr.onload = function() {
      if (this.status == 200) {
        result.innerHTML = this.response;        
      };
    };
 
    xhr.send(fd);
 
  }, false);
 
</script>
<script>
function upload_fi(){
$.ajax({
          type : 'POST',
          dataType : 'json',
           enctype: 'multipart/form-data',
          url :baseUrl+'trackings/trackings_popup_track',
          data :$('#form_exel').serialize(),
          success : function(data) {
               
          }
     });
}
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getSearchForm:desc::trigger:>
//===========================================================================
function getSearchForm($option=array()) {global $bw;
$token = base64_encode ( time () );

//--starthtml--//
$BWHTML .= <<<EOF
        <form class="frm_search" id="frm_search">
<label>
{$this->getLang()->getWords('id')}
<input size="2" type="text"  name='search[id]' value="{$bw->input['search']['id']}"/>
</label>
<label>
{$this->getLang()->getWords('title','Tiêu đề')}
<input  name='search[title]' size="25" type="text" value="{$bw->input['search']['title']}"/>
</label>

EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_category_list",0,$bw->input[0])) {
$BWHTML .= <<<EOF

<label>
{$this->getLang()->getWords("category",'Danh mục')}
<select name='search[catId]'>
<option value="-1">{$this->getLang()->getWords("all",'Tất cả')}</option>
{$this->model->getCategories()->getChildrenBoxOption($bw->input['search']['catId'])}
</select>
</label>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_status",1,$bw->input[0])) {
$BWHTML .= <<<EOF

<label>
{$this->getLang()->getWords('status','Trạng thái')}
<select name='search[status]'>
<option 
EOF;
if($bw->input['search']['status']==-1) {
$BWHTML .= <<<EOF
selected='selected'
EOF;
}

$BWHTML .= <<<EOF
 value="-1">{$this->getLang()->getWords('all')}</option>
<option 
EOF;
if($bw->input['search']['status']=='0') {
$BWHTML .= <<<EOF
selected='selected'
EOF;
}

$BWHTML .= <<<EOF
 value="0">{$this->getLang()->getWords('action_hide','Ẩn')}</option>
<option 
EOF;
if($bw->input['search']['status']==1) {
$BWHTML .= <<<EOF
selected='selected'
EOF;
}

$BWHTML .= <<<EOF
 value="1">{$this->getLang()->getWords('action_visible','Hiện')}</option>
<option 
EOF;
if($bw->input['search']['status']==2) {
$BWHTML .= <<<EOF
selected='selected'
EOF;
}

$BWHTML .= <<<EOF
 value="2">{$this->getLang()->getWords('home')}</option>
</select>
</label>

EOF;
}

$BWHTML .= <<<EOF

<input type="hidden" id="sorder" value="{$option['s_order']}" name="search[s_order]"/>
<input type="hidden" id="sfield" value="{$option['s_ofield']}" name="search[s_ofield]"/>
<input type="hidden" value="$token" name="token"/>
<button  class="btnSearch" type="submit"><span><img src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" class="icon-wrapper-vs vs-icon-search"></span><span>{$this->getLang()->getWords('search','Tìm kiếm')}<span></button>
<input type="button" value="Import dữ liệu" onclick="load_form_import()" >
<input type="button" value="Export dữ liệu" onclick="export_excel()" >
</form>
<script>

function export_excel(){
location.href=baseUrl+'products/products_export_excel';
return false;
 $.ajax({
          type : 'POST',
          dataType : 'json',
          url :baseUrl+'products/products_export_excel', 
          success : function(data) {
               
          }
     });
    }


function load_form_import(){
  $.fancybox({
        type: 'ajax',
        href:baseUrl+'products/products_popup'
    });
     
    return false;
}
function orderItem(field, order){
$("#sfield").val(field);
$("#sorder").val(order);
$("#vs_panel_{$this->modelName} #frm_search").submit();
}
$("#vs_panel_{$this->modelName} #frm_search").submit(function(){
var hashbase=$(this).parents('.ui-tabs-panel').attr('id');
window.location.hash=hashbase+"/{$bw->input[0]}/{$this->modelName}_search/&"+$(this).serialize();
return false;
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:addOption:desc::trigger:>
//===========================================================================
function addOption() {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName.'_button_add',1)) {
$BWHTML .= <<<EOF

<input type="button" class="icon-wrapper icon-wrapper-vs btnAdd" id="btn-add-obj" title="{$this->getLang()->getWords('global_action_add','Thêm')}"/>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName.'_button_delete',1)) {
$BWHTML .= <<<EOF

<input type="button"  class="icon-wrapper icon-wrapper-vs btnDelete" id="btn-delete-obj" title="{$this->getLang()->getWords('global_action_delete','Xóa')}"/>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName.'_button_disable',1)) {
$BWHTML .= <<<EOF

<input type="button" class="icon-wrapper icon-wrapper-vs btnDisable" id="btn-disable-obj" title="{$this->getLang()->getWords('global_action_hide','Ẩn')}"/>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName.'_button_visible',1)) {
$BWHTML .= <<<EOF

<input type="button" class="icon-wrapper icon-wrapper-vs btnEnable" id="btn-enable-obj" title="{$this->getLang()->getWords('global_action_visible','Hiện')}"/>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_status_home",0,$bw->input[0])) {
$BWHTML .= <<<EOF

<input type="button" class="icon-wrapper icon-wrapper-vs btnHome" id="btn-home-obj" title="{$this->getLang()->getWords('global_action_home','Trang chủ')}"/>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_status_new",1,$bw->input[0])) {
$BWHTML .= <<<EOF

<input type="button" class="icon-wrapper icon-wrapper-vs btnNews" id="btn-new" title="{$this->getLang()->getWords('global_action_news','Sản phẩm mới')}"/>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_status_trash_action",0,$bw->input[0])) {
$BWHTML .= <<<EOF

<input type="button" class="icon-wrapper icon-wrapper-vs btnTrash" id="btn-trash-obj" title="{$this->getLang()->getWords('global_action_trash','Đưa vào thùng rác')}"/>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_index','index',$bw->input[0].'_'.$this->modelName.'_list')) {
$BWHTML .= <<<EOF

<input type="button" class="icon-wrapper icon-wrapper-vs btnIndexChange" id="btn-index-change-obj" title="{$this->getLang()->getWords('global_action_index_change','Cập nhật thứ tự')}"/>

EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:addEditObjForm:desc::trigger:>
//===========================================================================
function addEditObjForm($obj="",$option=array()) {global $bw;
$seo = "style='display:none'";
if ($obj->getMTitle() or $obj->getMKeyword() or $obj->getSlug() or $obj->getMIntro()){
$seo = "";
}
//pr($obj);die;
if($obj->getId())
$this->hot=explode(",",$obj->getHot());


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="vs_panel" id="vs_panel_{$this->modelName}">
<div class="ui-dialog">
<form class="frm_add_edit_obj" id="frm_add_edit_obj"  method="POST" enctype='multipart/form-data'>
<input type="hidden" value="{$bw->input['vdata']}" name="vdata"/>
<input type="hidden" value="{$bw->input['pageIndex']}" name="pageIndex"/>
<input type="hidden" value="{$obj->getId()}" name="{$this->modelName}[id]" />
<!--<input type="hidden" value="{$obj->getSlug ()}" name="{$this->modelName}[mUrl]" id="mUrl" data-module="{$this->modelName}" data-id = "{$obj->getId()}" />-->
<table class="obj_add_edit" width="100%">
<thead>
<tr>
<th colspan="2">
<span class="ui-dialog-title-form">{$this->getLang()->getWords('add_edit_'.$bw->input[0],'Thêm/Sửa tin')}</span>
<a class="btn_custom_settings icon-wrapper-vs" 
group="{$bw->input[0]}_{$this->modelName}_form">
</a>
<div class="vs-buttons">
<button type="submit" ><span><img src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" class="icon-wrapper-vs vs-icon-accept"></span><span>{$this->getLang()->getWords('global_accept')}</span></button>
<button type="button" id="frm_close" class="btnCancel frm_close"><span><img src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" class="icon-wrapper-vs vs-icon-cancel"></span><span>{$this->getLang()->getWords("global_cancel")}</span></button>
</div>
</th>
</tr>
</thead>
<tbody>
<tr>
<td style="width: 111px;"><label>{$this->getLang()->getWords('title','Tiêu đề')}</label></td>
<td>
<input  name="{$this->modelName}[title]" id="{$this->modelName}_title" type="text" value="{$obj->getTitle()}" style='width:99%' />
</td>
</tr>
<tr>
</tr>

EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_status','Status',$bw->input[0].'_'.$this->modelName.'_form')) {
$BWHTML .= <<<EOF

<tr>
<td style="width: 121px;"><label>{$this->getLang()->getWords('status','Trạng thái')}</label></td>
<td>
<label>
<input 
EOF;
if($obj->getStatus()=='0') {
$BWHTML .= <<<EOF
checked='checked'
EOF;
}

$BWHTML .= <<<EOF
  name="{$this->modelName}[status]" id="{$this->modelName}_status_0" type="radio" value="0"  />
{$this->getLang()->getWords('global_hide','Ẩn')}
</label>
<label>
<input 
EOF;
if($obj->getStatus()==1||$obj->getStatus()==null) {
$BWHTML .= <<<EOF
checked='checked'
EOF;
}

$BWHTML .= <<<EOF
  name="{$this->modelName}[status]" id="{$this->modelName}_status_1" type="radio" value="1"  />
{$this->getLang()->getWords('global_visible','Hiện')}
</label>

EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_status_home",0,$bw->input[0])) {
$BWHTML .= <<<EOF

<label>
<input  
EOF;
if($obj->getStatus()==2) {
$BWHTML .= <<<EOF
checked='checked'
EOF;
}

$BWHTML .= <<<EOF
  name="{$this->modelName}[status]" id="{$this->modelName}_status_2" type="radio" value="2"  />
{$this->getLang()->getWords('global_home','Trang chủ')}
</label>

EOF;
}

$BWHTML .= <<<EOF

</td>
</tr>

EOF;
}

$BWHTML .= <<<EOF


<tr>
<td><label>Tình trạng</label></td>
<td>
<label><input {$this->__foreach_loop__id_53d3109b7f9a3($obj,$option)}  name="{$this->modelName}[hot][1]"  type="checkbox" value=1>Sản phẩm mới</label>
<label><input {$this->__foreach_loop__id_53d3109b7fafc($obj,$option)} name="{$this->modelName}[hot][2]" type="checkbox" value=2>Sản phẩm Bán chạy</label>
<label><input {$this->__foreach_loop__id_53d3109b7fc5a($obj,$option)} name="{$this->modelName}[hot][3]" type="checkbox" value=3>Sản phẩm Khuyến mãi</label>
</td>
</tr>


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_category_list','Category',$bw->input[0].'_'.$this->modelName.'_form') and $this->model->getCategories()->getChildren()) {
$BWHTML .= <<<EOF

<tr>
<td><label>{$this->getLang()->getWords("category",'Danh mục')}</label></td>
<td>
<select  name="{$this->modelName}[catId]" id="vs_cate">
{$this->model->getCategories()->getChildrenBoxOption($obj->getCatId())}
</select>
<br>
</td>
</tr>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_index','index',$bw->input[0].'_'.$this->modelName.'_form')) {
$BWHTML .= <<<EOF

<tr>
<td><label>{$this->getLang()->getWords("index",'Thứ tự')}</label></td>
<td>
<input  name="{$this->modelName}[index]" id="{$this->modelName}_index" type="text" value="{$obj->getIndex()}" />
</td>
</tr>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_code','code',$bw->input[0].'_'.$this->modelName.'_form',0)) {
$BWHTML .= <<<EOF

<tr>
<td><label>{$this->getLang()->getWords("code","Mã")}</label></td>
<td>
<input  name="{$this->modelName}[code]" id="{$this->modelName}_code" type="text" value="{$obj->getCode()}" />
</td>
</tr>

EOF;
}

$BWHTML .= <<<EOF

<tr>
<td><label>Gía:</label></td>
<td>
<input  name="{$this->modelName}[price]" type="text" value="{$obj->getPrice()}" />
</td>
</tr>
<tr>
<td><label>Giá khuyến mãi</label></td>
<td>
<input  name="{$this->modelName}[promotion]" type="text" value="{$obj->getPromotion()}" />
</td>
</tr>

EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_image_field','Image',$bw->input[0].'_'.$this->modelName.'_form')) {
$BWHTML .= <<<EOF

<tr>
<td><label>{$this->getLang()->getWords('image','Hình ảnh')}</label>
<p>
{$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_image_width",'')}x{$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_image_height",'')}px
</p>
</td>
<td>
<div style="float:left;width:300px">
<label>
<input name="filetype[image]" value="file" type="radio" checked='checked' obj="image-file"/>
{$this->getLang()->getWords('upload','Tải lên từ máy')}:</label>
<label>
<input    type="file" value="" style='width:250px;'  id="image-file" name="image"/>
</label>
<br/>
<label>
<input name="filetype[image]"   value="link" type="radio" obj="image-link"/>
{$this->getLang()->getWords('download_from','Tải về từ đường dẫn')}:
</label>
<label>
<input disabled='disabled' type="text" value="" style='width:250px;' id="image-link" name="links[image]"/>
</label>
</div>
<div style="float:left;width:200px">

EOF;
if($obj->getImage()) {
$BWHTML .= <<<EOF

{$obj->createImageEditable($obj->getImage(),100,90)}

EOF;
}

$BWHTML .= <<<EOF


EOF;
}

$BWHTML .= <<<EOF

</div>
</td>
</tr>
</if>

EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_intro','Intro',$bw->input[0].'_'.$this->modelName.'_form')) {
$BWHTML .= <<<EOF

<tr>
<td><label>{$this->getLang()->getWords('intro','Mô tả')}</label></td>
<td>
{$this->createEditor($obj->getIntro(), "{$this->modelName}[intro]", "100%", "211px","full")}
</td>
</tr>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_content','Content',$bw->input[0].'_'.$this->modelName.'_form')) {
$BWHTML .= <<<EOF

<tr>
<td><label>{$this->getLang()->getWords('content','Nội dung')}</label></td>
<td>
{$this->createEditor($obj->getContent(), "{$this->modelName}[content]", "100%", "333px","full")}
</td>
</tr>

EOF;
}

$BWHTML .= <<<EOF

<tr>
<td></td>
<td>
EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_seo_option','SEO Option',$bw->input[0].'_'.$this->modelName.'_form')) {
$BWHTML .= <<<EOF

<button onclick="$('#seo').toggle();return false;">Seo option</button>

EOF;
}

$BWHTML .= <<<EOF

</tr></td>

EOF;
if($this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_seo_option','SEO Option',$bw->input[0].'_'.$this->modelName.'_form')) {
$BWHTML .= <<<EOF

<tr id="seo" $seo>
<td><label>{$this->getLang()->getWords('seo')}</label></td>
<td>
<label>Slug:<input type="text" style="width:100%" value="{$obj->getSlug()}" name="{$this->modelName}[slug]" /></label>
<label>Meta Title:<input type="text" style="width:100%" value="{$obj->getMTitle()}" name="{$this->modelName}[mTitle]" /></label>
<label>Meta Description:<textarea style="width:100%"   name="{$this->modelName}[mIntro]" >{$obj->getMIntro()}</textarea></label>
<label>Meta Keyword:<textarea style="width:100%"   name="{$this->modelName}[mKeyword]" >{$obj->getMKeyword()}</textarea></label>
</td>
</tr>

EOF;
}

$BWHTML .= <<<EOF

<tr style="border:none">
<td class="vs-button" colspan="2" >
<button type="submit" ><span><img src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" class="icon-wrapper-vs vs-icon-accept"></span><span>{$this->getLang()->getWords('global_accept')}</span></button>
<button type="button" id="frm_close" class="btnCancel frm_close"><span><img src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" class="icon-wrapper-vs vs-icon-cancel"></span><span>{$this->getLang()->getWords("global_cancel")}</span></button>
</td>
</tr>
</tbody>
</table>
</form>

</div>
<script>
$("#frm_add_edit_obj").submit(function(){
var flag=false;
var message="";
var frm=$(this);
if($("#{$this->modelName}_title").val().length<3){
message+='{$this->getLang()->getWords('error_title')}{$this->DS}n';
flag=true;
}
if(flag){
jAlert(message);
return false;
}
vsf.uploadFile("frm_add_edit_obj", "{$bw->input[0]}", "{$this->modelName}_add_edit_process", "vs_panel_{$this->modelName}","{$bw->input[0]}",1,
function(){
var hashbase=frm.parents('.ui-tabs-panel').attr('id');
window.location.hash=hashbase+"/{$bw->input['back']}";
}
);
return false;
});
$(".frm_close").click(function(){
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
</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d3109b7f9a3($obj="",$option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($this->hot)){
    foreach( $this->hot as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
EOF;
if($value==1) {
$BWHTML .= <<<EOF
checked="checked"
EOF;
}

$BWHTML .= <<<EOF

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d3109b7fafc($obj="",$option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($this->hot)){
    foreach( $this->hot as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
EOF;
if($value==2) {
$BWHTML .= <<<EOF
checked="checked"
EOF;
}

$BWHTML .= <<<EOF

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d3109b7fc5a($obj="",$option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($this->hot)){
    foreach( $this->hot as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
EOF;
if($value==3) {
$BWHTML .= <<<EOF
checked="checked"
EOF;
}

$BWHTML .= <<<EOF

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>