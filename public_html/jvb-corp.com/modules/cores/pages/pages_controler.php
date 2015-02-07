<?php
require_once (CORE_PATH . 'pages/pages.php');
class pages_controler extends VSControl_admin {

	function __construct($modelName) {
		global $vsSkin, $bw;
		if (file_exists ( ROOT_PATH . $vsSkin->basicObject->getFolder () . "/skin_" . $bw->input [0] . ".php" )) {
			parent::__construct ( $modelName, "skin_" . $bw->input [0], "page", $bw->input [0] );
		} else {
			parent::__construct($modelName,"skin_pages","page",$bw->input[0]);
		}
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
			default :
				$this->loadDefault ();
				break;
				
		}
	}

	function addEditObjProcess() {
		global $bw, $vsStd;
		/****file processing**************/
		

		$bw->input[$this->modelName]['code'] = $bw->input[$this->modelName]['catProduct'];


		$bw->input[$this->modelName]['module'] = $bw->input[0];
		
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
		
		
		if(!$bw->input[$this->modelName]['slug']){
			$bw->input[$this->modelName]['slug']=VSFactory::getTextCode()->removeAccent($bw->input[$this->modelName]['title'],"-");	
		}
		$bw->input[$this->modelName]['mUrl']=$bw->input[$this->modelName]['mUrl']?$bw->input[$this->modelName]['mUrl']:$bw->input[$this->modelName]['slug'];
		$bw->input[$this->modelName]['mUrl']=strtolower($bw->input[$this->modelName]['mUrl']);
		
		
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

	function getHtml() {
		return $this->html;
	}

	function getOutput() {
		return $this->output;
	}

	function setHtml($html) {
		$this->html = $html;
	}

	function setOutput($output) {
		$this->output = $output;
	}
	
	/**
	 * Skins for page .
	 * ..
	 * 
	 * @var skin_pages
	 *
	 */
	var $html;
	
	/**
	 * String code return to browser
	 */
	var $output;
}
