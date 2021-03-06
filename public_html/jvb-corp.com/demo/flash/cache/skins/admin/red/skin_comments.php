<?php
if(!class_exists('skin_objectadmin'))
require_once ('./cache/skins/admin/red/skin_objectadmin.php');
class skin_comments extends skin_objectadmin {

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

<th onclick="orderItem('title', '{$option['s_order']}')" class="title" scope="col">{$this->getLang()->getWords("title","Tiêu đề")}</th>

EOF;
}

$BWHTML .= <<<EOF

<th>
Module
</th>

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

{$this->__foreach_loop__id_53d3109b59394($objItems,$option)}

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
function __foreach_loop__id_53d3109b59394($objItems=array(),$option=array())
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

<td><a onClick="btnEditItem_Click({$item->getId()},this);return false;" href=""><b>{$item->getName()}</b> :{$item->getTitle()}</a>
<p><i>Trả lời</i>
{$item->getContent()}
</p>
</td>

EOF;
}

$BWHTML .= <<<EOF

<td>
{$this->getLang()->getWords($item->module)}
<a target="_blank" href="{$bw->vars['board_url']}/{$item->module}/detail/{$item->getObjId()}">Deail</a>
</td>

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


}
?>