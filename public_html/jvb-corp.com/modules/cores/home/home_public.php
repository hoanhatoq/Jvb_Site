<?php
/*
 +-----------------------------------------------------------------------------
 |   VS FRAMEWORK 3.0.0
 |	Author: BabyWolf
 |	Homepage: http://vietsol.net
 |	If you use this code, please don't delete these comment line!
 |	Start Date: 21/09/2004
 |	Finish Date: 22/09/2004
 |	Version 2.0.0 Start Date: 07/02/2007
 |	Version 3.0.0 Start Date: 03/29/2009
 |	Modify Date: 10/10/2009
 +-----------------------------------------------------------------------------
 */
if (! defined ( 'IN_VSF' )) {
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit ();
}
global $vsStd;

class home_public extends VSControl{
	/**
	 * 
	 * Enter description here ...
	 * @var skin_home
	 */
	private $html = "";

	public $partner = null;
	public function __construct(){
		global $vsTemplate, $vsStd;
		$this->html =  $vsTemplate->load_template('skin_home' );

	}
	function auto_run() {
		global $bw;
		
		switch ($bw->input[1]){
			case 'order' :
				$this->getOrder ();
				break;
			default:
				$this->loadDefault();
		}

	}
	
	
	function loadDefault(){
		global $vsStd, $vsPrint,$vsCom,$bw,$DB;
		
		//$vsPrint->mainTitle = $vsPrint->pageTitle = VSFactory::getLangs()->getWords('pageTitle','CÔNG TY TNHH THƯƠNG MẠI DỊCH VỤ CƯ XÁ ĐÔ THÀNH');
		$this->lang=$_SESSION['user']['language']['vsfcurrentLang']['code'];
		if($text=VSFactory::getSettings()->getSystemKey('home_title_'.$this->lang,'','configs')){
			$vsCom->SEO->basicObject->setTitle($text);
			unset($text);
		}
		if($text=VSFactory::getSettings()->getSystemKey('home_description','','configs')){
			$vsCom->SEO->basicObject->setIntro($text);
			unset($text);
		}
		if($text=VSFactory::getSettings()->getSystemKey('home_keywords','','configs')){
			$vsCom->SEO->basicObject->setKeyword($text);
			unset($text);
		}
		
		
		$this->lang=$_SESSION['user']['language']['vsfcurrentLang']['code'];

		//print_r($text);die;
		
		//$option['pro']=Object::getObjModule('products', 'products', '=2', '', '');
		
		
		$category = VSFactory::getMenus ()->getCategoryGroup ('products');
		require_once CORE_PATH . 'products/products.php';

		$pro=new products();

		require_once CORE_PATH . 'pages/pages.php';

		$pg=new pages();
		
        $option['cate'] = $category->getChildren();


        $this->size_limt=3;
		

		foreach ($option['cate'] as $key=>$value){
			$ids=VSFactory::getMenus()->getChildrenIdInTree($key);
			$pro->setCondition("status=2 and catId in ({$ids})");
			$pro->setLimit(array(0,$this->size_limt));
			$pro->setOrder('`index` DESC');
			$option['list'][$key]=$pro->getObjectsByCondition();


			$pg->setCondition("status>0 and code in ({$ids})");
			$pg->setLimit(array(0,4));
			$pg->setOrder('`index` DESC');
			$option['news'][$key]=$pg->getObjectsByCondition();
			if(empty($option['list'][$key]))
				unset($option['cate'][$key]);
		}        
		

	//	print_r($option['news']);die;
	

		//pr($this->size_limt);die;

		
		
		
		return $this->output = $this->html->loadDefault($option);
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
	
}
?>