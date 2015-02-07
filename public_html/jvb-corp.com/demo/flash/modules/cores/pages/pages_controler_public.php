<?php
require_once CORE_PATH.'pages/pages.php';
class pages_controler_public extends VSControl_public {
	function __construct($modelName){
		global $vsTemplate,$bw,$vsPrint,$vsSkin;
		if(file_exists(ROOT_PATH.$vsSkin->basicObject->getFolder()."/skin_".$bw->input[0].".php")){
			
		parent::__construct($modelName,"skin_".$bw->input[0],"page",$bw->input[0]);;
		}else{
		parent::__construct($modelName,"skin_pages","page",$bw->input[0]);
		}
		unset($_SESSION['active']);
	}
	
	/**
	 * 
	 * @var pages
	 */
	protected $model;
	
	function auto_run() {
		global $bw;
		
		switch ($bw->input ['action']) {
			case $this->modelName . '_detail' :
				$this->showDetail ( $bw->input [2] );
				break;
			
			case $this->modelName . '_category' :
				$this->showCategory ( $bw->input [2] );
				break;
			case $this->modelName . '_review' :
				$this->showReview ( $bw->input [2] );
				break;
			case $this->modelName . '_popup_km' :
					return $this->output =  $this->getHtml()->showPopupKM($obj);
				break;	
			case $this->modelName . '_search' :
				$this->showSearch ();
				break;
			case $this->modelName.'_show_video':
				$this->showVideo($bw->input[2]);
				break;	
			case $this->modelName.'_send':
				$this->send();
				break;	
			case $this->modelName.'_success':
				$this->success();
				break;	
			case $this->modelName.'_export':
				$this->export_exel();
				break;	
			default :
				$this->showDefault ();
				break;
		}
	}
	

	function showDefault($option=array()){
		global $bw,$vsTemplate,$vsStd,$vsPrint;


                //if(in_array($bw->input['module'], array('abouts','maps','helps')))return $this->showDefault1 ();
		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$option['cate_list']=VSFactory::getMenus()->getCategoryGroup($bw->input[0])->getChildren();
		
		if(!$category){
			$vsPrint->boink_it($bw->base_url);
		}


		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		$this->model->setCondition("status>0 and catId in ($ids)");



		$this->model->setOrder("`index` desc");
		$tmp=$this->model->getPageList($bw->input[0],1,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',12));
		$option=array_merge($tmp,$option);
		$option['breakcrum']=$this->createBreakCrum($category);
		$option['title']=VSFactory::getLangs()->getWords($bw->input[0]);
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
       	$option['cate'] = $category->getChildren();
      	


        if($option['pageList'] and in_array($bw->input[0],array('abouts','services','recruitment','development','special'))){
         	$obj=current($option['pageList']);
			
			//pr($option['pageList']);die;
         	$vsPrint->boink_it($obj->getUrl($bw->input[0]));
         }       
      
        return $this->output = $this->getHtml()->showDefault($option);
	}

	function showCategory($catId){
		global $bw,$vsPrint;
        
		$idcate = $this->getIdFromUrl($catId);		
		$category=VSFactory::getMenus()->getCategoryById($idcate);
		if(!$category){
			$vsPrint->boink_it($bw->base_url);
		}
		
		
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		$this->model->setCondition("status>0 and catId in ({$idcate})");
		
		$this->model->setOrder("`index` desc,id desc");
		$option=$this->model->getPageList($bw->input[0]."/".$bw->input[1]."/".$bw->input[2]."/".$bw->input[3],4,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',12));
		
		$option['title']=$category->getTitle();
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
		$option['cate']=VSFactory::getMenus()->getCategoryGroup($bw->input[0])->getChildren();;
        $option['breakcrum']=$this->createBreakCrum(VSFactory::getMenus()->getCategoryById($idcate) );
        $option['obj']=$category;

        // pr($option['cate']);die;
     
		return $this->output = $this->getHtml()->showDefault($option);
	}
	function showDetail($objId,$option=array()){
		global $vsPrint, $bw,$vsTemplate;
		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);


		$slug=str_replace(".html","",$bw->input[2]);
        $this->model->setCondition("LOWER(mUrl)='{$slug}'");
		$obj=$this->model->getOneObjectsByCondition();

		if(empty($obj)) {
			$vsPrint->boink_it($bw->base_url."404.html");
		}
		$obj->createSeo();
		$option['breakcrum']=$this->createBreakCrum($obj);
		$option['other']=$this->getOtherList($obj);
		$option['cate'] = $category->getChildren();
		$option['cate_obj']=VSFactory::getMenus()->getCategoryById($obj->getCatId());
		
		$obj->createSeo();
		

		$obj->setHit($obj->getHit()+1);
		$this->model->updateObjectById($obj);	


		if(in_array($bw->input[0],array('abouts'))){
			unset($option['other']);
		}
	

	
		$this->output = $this->getHtml()->showDetail($obj,$option);
	}

	public function getOtherDif($obj,$array=array()) {
		global $bw;

		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);	
		if(!$category){
			$vsPrint->boink_it($bw->base_url);
		}
		$this->model->setLimit ( array (0, 4 ) );
		
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		$this->model->setCondition("status>0 and catId in ({$ids})");

		if(!empty($array)){
			$id=implode(",",array_keys($array));
			$id.=",".$obj->getId();
			$this->model->setCondition("status>0 and catId in ({$ids}) AND `id` not IN($id)");
		}


		return $this->model->getObjectsByCondition ();
	}

	
	public function getOtherList($obj) {
		global $bw;
		$vsMenu = VSFactory::getMenus();
		$cat = $vsMenu->getCategoryById ( $obj->getCatId () );
		$ids = $vsMenu->getChildrenIdInTree ( $cat );
	
		$this->model->setOrder ( "`index` Desc, id Desc" );
		$condition = "id <> {$obj->getId()} and status >0";
		$this->model->setLimit ( array (0, 4 ) );
		if ($ids)
			$condition .= " and catId in ( {$ids})";
	
		$this->model->setCondition($condition);
		return $this->model->getObjectsByCondition ();
	}
	
	function showQuestion(&$option) {
		require_once CORE_PATH.'pages/pages.php';
		$pages=new pages();
	
		$category=VSFactory::getMenus()->getCategoryGroup('customer-service');
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
	
		$pages->setCondition("catId in ($ids)");
		$pages->setOrder("`index`");
		$pages->setFieldsString ( "id,title" );
		$option['obj_list']=$pages->getObjectsByCondition();
	}
	function send($option) {
		global $bw,$vsStd,$vsPrint;
		
		require_once CORE_PATH.'pages/pages.php';
		$pages=new pages();
		$category=VSFactory::getMenus()->getCategoryGroup('questions');
		$bw->input['question']['catId']=$category->getId();
		$pages->obj->convertToObject($bw->input['question']);
		$pages->insertObject($pages->obj);
		
		return $this->success($option);

	}
	function success($option) {
		global $bw,$vsStd,$vsPrint;
		return $this->output = $this->getHtml()->success($option);

	}
	
    function getListLangObject(){
    }
	function showSearch($option=array()){
		global $bw,$vsTemplate,$vsStd,$vsPrint;
		$category=VSFactory::getMenus()->getCategoryGroup('projects');
		
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		
		$condition="1=1 ";
		if($bw->input['provin']){
			$condition.=" and status >0 and catId in ($ids) and provin like '%".mysql_real_escape_string($bw->input['provin'])."%'";	
		}
		if($bw->input['dis']){
			$condition.=" and status >0 and catId in ($ids)  and dis like '%".mysql_real_escape_string($bw->input['dis'])."%'";	
		}
		if($bw->input['provin'] and $bw->input['dis']){
			$condition.=" and status >0 and catId in ($ids) and provin like '%".mysql_real_escape_string($bw->input['provin']) ."%' and dis like '%".mysql_real_escape_string($bw->input['dis']) ."%'";	
		}

		$this->model->setCondition($condition);
		$this->model->setOrder("`index`,id desc");
		$option['pageList']=$this->model->getObjectsByCondition();

		$option['breakcrum']=$this->createBreakCrum(null);
		if($bw->input['keyword'])
		$option['title']=VSFactory::getLangs()->getWords('products_search_title','Tìm kiếm với từ khóa: ')."<i>".$bw->input['keyword']."</i>";
		else 
		$option['title']=VSFactory::getLangs()->getWords('products_search_result','Kết quả tìm kiếm');
		$vsPrint->mainTitle=$vsPrint->pageTitle="Tìm kiếm với từ khóa: ".$option['title'];
		$option['obj']=new Menu();
		$option['obj']->setTitle("Tìm kiếm");

        return $this->output = $this->getHtml()->showDefault($option);
        
//		return $this->output="";
	}
       /**
        * 
        * @param BasicObject
        */ 
    protected  function  onDeleteObject($obj){
    }
	public function getHtml() {
		return $this->html;
	}
	
	public function getOutput() {
		return $this->output;
	}
	
	public function setHtml($html) {
		$this->html = $html;
	}
	
	public function setOutput($output) {
		$this->output = $output;
	}
	/**
	 * 
	 * Enter description here ...
	 * @var skin_pages
	 */
	public $html;
}

?>