<?php
require_once(CORE_PATH.'address/address.php');

class address_controler_public extends VSControl_public {

	public	function auto_run(){
	
	global $bw;
				switch ($bw->input['action']) {
			case $this->modelName.'_address_map':
				$this->showMap($bw->input[2]);
				break;
			default:
				parent::auto_run();
				break;
		}

	}
	
	function showMap($option=array()){
		global $bw,$vsTemplate,$vsStd,$vsPrint;
		
		$obj=$this->model->getObjectById($bw->input[2]);
		$bw->input['ajax']=1;
		
		return $this->output = $this->getHtml()->showMap($obj);
	}

function showDefault($option=array()){
		global $bw,$vsTemplate,$vsStd,$vsPrint;
                //if(in_array($bw->input['module'], array('abouts','maps','helps')))return $this->showDefault1 ();
		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		if(!$category){
			$vsPrint->boink_it($bw->base_url);
		}
		/*$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		$this->model->setCondition("status>0 and catId in({$ids})");
		$this->model->setOrder("`index` DESC");
		$option=$this->model->getPageList($bw->input[0],1,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',12));
		$option['breakcrum']=$this->createBreakCrum(null);
		$option['title']=VSFactory::getLangs()->getWords($bw->input[0]);
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
        */
        $option['cate'] = $category->getChildren();       
		foreach ($option['cate'] as $key=>$value){
			$ids=VSFactory::getMenus()->getChildrenIdInTree($key);
			$this->model->setCondition("status>0 and catId in ({$ids})");
			$this->model->setLimit(array(0,5));
			$this->model->setOrder('`index` DESC');
			$option['pageList'][$key]=$this->model->getObjectsByCondition();
			//if(empty($option['pageList'][$key]))
				//unset($option['cate'][$key]);
		} 
		$option['breakcrum']=$this->createBreakCrum(null);
				
        return $this->output = $this->getHtml()->showDefault($option);
	}



	public	function __construct($modelName){
	
		global $vsTemplate,$bw;
//		$this->html=$vsTemplate->load_template("skin_addres");
		parent::__construct($modelName,"skin_address","addres",$bw->input[0]);
//		$this->model->categoryName=$bw->input[0];

	}





	function getHtml(){
		return $this->html;
	}



	function setHtml($html){
		$this->html=$html;
	}



	
	/**
	*
	*@var address
	**/
	var		$model;

	
	/**
	*
	*@var skin_address
	**/
	var		$html;
}
