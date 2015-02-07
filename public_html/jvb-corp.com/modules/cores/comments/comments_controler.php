<?php
require_once(CORE_PATH.'comments/comments.php');

class comments_controler extends VSControl_admin {

		function __construct($modelName){
			global $vsTemplate,$bw;//		$this->html=$vsTemplate->load_template("skin_comments");
		parent::__construct($modelName,"skin_comments","comment");
		$this->model->categoryName="comments";

	}

	function auto_run() {
		global $bw;
		
		
		switch ($bw->input [1]) {
			
			default :
				parent::auto_run();
				break;
				
		}
	}


	function addEditObjProcess() {
		global $bw, $vsStd;
		/****file processing**************/
		
		//$bw->input[$this->modelName]['module'] = $bw->input[0];
		
		$bw->input[$this->modelName]['lastUpdate'] = time();

		if(is_array($bw->input['files'])){
			foreach ($bw->input['files'] as $name=> $file) {
				$bw->input[$this->modelName][$name]=$file;
			}
			
		}
        if(is_array($bw->input['links'])){
			foreach ($bw->input['links'] as $name=> $value) {
				$url=parse_url($value);
				if($bw->input['filetype'][$name]=='link'&&$url['host']){
					$files=new files();
					$fid=$files->copyFile($value,$bw->input[0]);
					if($fid)
					$bw->input[$this->modelName][$name]=$fid;
				}
				unset($url);
			}
			
		}
		
		/****end file processing**************/
		if($bw->input[$this->modelName]['id']){
			$this->model->getObjectById($bw->input[$this->modelName]['id']);
			if(!$this->model->basicObject->getId()){
				return $this->output =  $this->getObjList ($bw->input['pageIndex'],"Not define object of id={$bw->input[$this->modelName]['id']} submited!");
			}
			if($bw->input[$this->modelName]['image']){
				$files=new files();
				$files->deleteFile($this->model->basicObject->getImage());				
			}
			/////delete some here..........................................
		}else{
			$bw->input[$this->modelName]['postDate']=time();
			
			/////delete some here before inserting...................
		}
		
		
		$bw->input[$this->modelName]['mUrl']=$bw->input[$this->modelName]['mUrl']?$bw->input[$this->modelName]['mUrl']:$bw->input[$this->modelName]['slug'];
		
		$this->model->basicObject->convertToObject($bw->input[$this->modelName]);
		if(!$this->model->basicObject->getCatId()){
			if($this->model->getCategoryField()){
				$this->model->basicObject->setCatId($this->model->getCategories()->getId());
			}
		}
		if($this->model->basicObject->getId()){
			$this->model->updateObject();
			$message= VSFactory::getLangs()->getWords('update_success');
		}else{
			$this->model->insertObject();
			$message=VSFactory::getLangs()->getWords('insert_success');
		}
		/**add tags process***/
		require_once CORE_PATH.'tags/tags.php';
		$tags=new tags();
		$tags->addTagForContentId($bw->input[0], $this->model->basicObject->getId(), $bw->input['tags_submit_list']);
		/****/
		$this->afterProcess($this->model);
		if(!$this->model->result['status']){
			$message=$this->model->result['developer'];
			
		}
		///////some here.....................
		$this->lastModifyChange();
		return $this->output =  $this->getObjList ($bw->input['pageIndex'],$message);
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
        		$where.=" and `title` like '%{$bw->input['search']['title']}%'";
        	}
        	if($bw->input['search']['id']){
        		$where.=" and `id`='{$bw->input['search']['id']}' ";
        	}
			if($bw->input['search']['username']){
				require_once CORE_PATH.'users/users.php';
				$users=new users();
				$users->getObjectByName($bw->input['search']['username']);
				if($users->basicObject->getId())
        		$where.=" and `userId`='{$users->basicObject->getId()}' ";
        		else{
        			$where.=" and 0=1 " ;
        		}
        	}
        	if(isset($bw->input['search']['catId']))
        	if($bw->input['search']['catId']>0){
        		$category=VSFactory::getMenus()->getCategoryById($bw->input['search']['catId']);
        		if($category){
	        		$idns=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
	        		$where.=" and `catId` in ({$idns})";
        		}
        	}else{
        		if($this->model->categoryName){
        			$category=VSFactory::getMenus()->getCategoryGroup($this->model->categoryName);
        			if($category){
		        		$idns=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
		        		$where.=" and `catId` in ({$idns})";
        			}
        		}
        	}
        	if($bw->input['search']['status']!=-1&&$bw->input['search']['status']!==NULL){
	        		$where.=" and `status`='{$bw->input['search']['status']}'";
        		
        	}
        	$this->model->setCondition($where);
        	
        	$itemList=$this->model->getObjectsByCondition();
        	$vdata['search']=$bw->input['search'];
        	$option['vdata']=json_encode($vdata);
        	//if(!is_object($_GET['search'])) $_GET['search']=array();
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
	*Skins for comment ...
	*@var skin_comments
	**/
	var		$html;

	
	/**
	*String code return to browser
	**/
	var		$output;
}
