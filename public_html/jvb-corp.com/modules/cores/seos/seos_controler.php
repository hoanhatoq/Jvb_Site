<?php
require_once(CORE_PATH.'seos/seos.php');

class seos_controler extends VSControl_admin {

		function __construct($modelName){
			global $vsTemplate,$bw;//		$this->html=$vsTemplate->load_template("skin_seos");
		parent::__construct($modelName,"skin_seos","seo");
		$this->model->categoryName="seos";

	}

	function auto_run() {
		global $bw;
		
		
		switch ($bw->input [1]) {
			case $this->modelName . '_display_tab' :
				$this->displayObjTab ();
				break;
			case $this->modelName . '_search' :
				$this->displaySearch ();
				break;
			case $this->modelName . '_visible_checked' :
				$this->checkShowAll ( 1 );
				break;
			case $this->modelName . '_home_checked' :
				$this->checkShowAll ( 2 );
				break;
			case $this->modelName . '_index_change' :
				$this->indexChange();
				break;
				
			case $this->modelName.'_home_checked' :
				$this->checkShowAll(2);
				break;
			case $this->modelName.'_new_checked' :
				$this->checkShowAll(4);
				break;	
				
			case $this->modelName.'_trash_checked' :
				$this->checkTrash();
				break;
			
			case $this->modelName.'_hide_checked' :
				$this->checkShowAll(0);
				break;
			case $this->modelName.'_display_list' :
				$this->getObjList ( $bw->input [2], $this->model->result ['message'] );
				break;
			
			case $this->modelName.'_add_edit_form' :
				$this->addEditObjForm ( $bw->input [2] );
				break;
			
			case $this->modelName.'_add_edit_process' :
				$this->addEditObjProcess ();
				break;
			
			case $this->modelName.'_delete' :
				$this->deleteObj($bw->input[2]);
				break;
			case $this->modelName.'_change_cate' :
				$this->changeCate($bw->input[2]);
				break;	
				
			case $this->modelName."_display_answer_tab":
				$this->displayAnswer();
				break;
			case $this->modelName."_upload_image":
				$this->uploadImage();
				break;	
				
			case $this->modelName."_checkPermalink":
				$this->checkPermalink();
				break;
			case $this->modelName."_create_seo":
				$this->create_seos();
				break;	
			default :
				$this->loadDefault ();
				break;
				
		}
	}


function create_seos(){
	global $bw;

	$bw->input['ajax']=1;


	if($bw->input[2]=='start'){
		$category=VSFactory::getMenus()->getCategoryGroup('products');
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());

		$al_menu=VSFactory::getMenus()->getMenuByCondition($ids);
		$url_seo=array();
		$db=VSFactory::createConnectionDB();
		//pr($al_menu);die;
		foreach ($al_menu as $key => $value){
			if($value->getLevel()==1){
				continue;
			}
			//pr($value->getSlug());
			$this->model->setCondition("`aliasUrl`='{$value->getSlug()}'");
			$obj=$this->model->getOneObjectsByCondition();
			//pr(VSFactory::createConnectionDB());die;
			if(isset($obj->id)){
				continue;
			}

			$this->model->basicObject->setId(null);
			$this->model->basicObject->setRealUrl($value->getUrl()."/category/".$value->getSlug());
			$this->model->basicObject->setAliasUrl($value->getSlug());
			$this->model->basicObject->setTitle($value->getTitle());
			$this->model->insertObject();
		
		}
		pr(VSFactory::createConnectionDB());die;
	}


	$option=array();
	echo $this->html->create_seos($option);
}	

function displaySearch(){
		global $bw;
//		if (VSFactory::getSettings()->getSystemKey ( $bw->input [0] . '_category_list', 0, $bw->input[0] ))
//			$option ['categoryList'] = $this->getCategoryBox ();
			//$option ['objList'] = $this->getObjList ();
        	$order="";
        	$from="vsf_".$this->tableName;
        	$where="1=1";
        	if($bw->input['search']['title']){
        		$where.=" and ( `title` like '%{$bw->input['search']['title']}%' or `aliasUrl` like '%{$bw->input['search']['title']}%' or `realUrl` like '%{$bw->input['search']['title']}%' )";
        	}
        	if($bw->input['search']['id']){
        		$where.=" and `id`='{$bw->input['search']['id']}' ";
        	}
        	if($bw->input['search']['status']!=-1&&$bw->input['search']['status']!==NULL){
	        		$where.=" and `status`='{$bw->input['search']['status']}'";
        		
        	}
			if($bw->input['search']['keyword']){
	        		$where.=" and `keyword` like '%{$bw->input['search']['keyword']}%' ";
        		
        	}
        	$this->model->setCondition($where);
        	
        	$itemList=$this->model->getObjectsByCondition();
        	$vdata['search']=$bw->input['search'];
        	$option['vdata']=json_encode($vdata);
        	$tmp['search']=$_GET['search'];
        	$bw->input['back']=urldecode( http_build_query($tmp	))."&pageIndex=".$bw->input['pageIndex'];
		return $this->output = $this->html->getListItemTable ($itemList, $option );
	}



	function getHtml(){
		return $this->html;
	}



	function getOutput(){
		return $this->output;
	}



	function setHtml($html){
		$this->html=$html;
	}




	function setOutput($output){
		$this->output=$output;
	}



	
	/**
	*Skins for seo ...
	*@var skin_seos
	**/
	var		$html;

	
	/**
	*String code return to browser
	**/
	var		$output;
}
