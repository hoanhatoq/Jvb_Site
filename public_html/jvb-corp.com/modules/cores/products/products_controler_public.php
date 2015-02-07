<?php
require_once CORE_PATH . 'products/products.php';
class products_controler_public extends VSControl_public {

	function __construct($modelName) {
		global $vsTemplate, $bw;
		// $this->html=$vsTemplate->load_template("skin_product");
		parent::__construct ( $modelName, "skin_products", "product", $bw->input [0] );
		// $this->model->categoryName=$bw->input[0];
	}

	function auto_run() {
		global $bw;
		
		switch ($bw->input ['action']) {
			case $this->modelName . '_get_price' :
				$this->getPrice ();
				break;
			case $this->modelName . '_label' :
				$this->showLabel ();
				break;
			case $this->modelName . '_search' :
				$this->showSearch ();
				break;
			case $this->modelName . '_search_pro' :
				$this->showSearchPro ();
				break;	
				
			case $this->modelName . '_ajax_by_hot' :
				$this->loadItemProductByHot ();
				break;	
			case $this->modelName.'_tags':
				$this->getTags();
				break;	
			case $this->modelName .'_category' :
				$this->showCategory($bw->input[2]);
				break;
			case $this->modelName .'_categories' :
				$this->showCategories($bw->input[2]);
				break;
			case $this->modelName .'_remove_session' :
				$this->remove_session($bw->input[2]);
				break;	
			default :
				
				parent::auto_run ();
				break;
		}
	}

function remove_session(){
	global $bw,$vsPrint;
	$_SESSION['obj_visit_delete'][time()]=intval($bw->input['id']);
	echo "ok";die;
}

function loadItemProductByHot(){
		global $bw,$vsPrint;
               // $category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		
		$num=$bw->input['number'];
		$condition=	"status>0 and `hot` LIKE '%{$num}%' ";

		$this->model->setCondition($condition);
		$this->model->setOrder("`index` DESC,id desc");

		$this->size_limt=5;
			
		$this->model->setLimit(array(0,$this->size_limt));
		$option['list']=$this->model->getObjectsByCondition();
		foreach ($option['list'] as $key => $value) {
			$catobj=VSFactory::getMenus()->getCategoryById($value->getCatId());
			$option[$key]=$value;
			$option[$key]->urlseo=$bw->base_url.$catobj->getSlug()."/".$value->getSlug().".html";
		}	

        $bw->input['ajax']=1;

		return $this->output = $this->getHtml()->loadItemProductByHot($option['list']);
	}

	
	
function getTags($option=array()){
		global $vsPrint, $bw,$vsTemplate;   
		
		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		
		require_once CORE_PATH.'tags/tags.php';     
		$tags=new tags();
		$tags->getObjectById($this->getIdFromUrl($bw->input[2]));
		if(!$tags->obj->getId()) $vsPrint->boink_it("");
		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
//		$tags->getContentByTagId($module, $id);
		$products=new products();
		$products->setCondition("id IN (SELECT contentId FROM vsf_tagcontent WHERE tagid='{$this->getIdFromUrl($bw->input[2])}' )");
		$option=$products->getPageList($bw->input[0]."/".$bw->input[1]."/".$bw->input[2],3,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',10));
		
		$option['title']=$tags->obj->getTitle();
		$tags->obj->createSEO();
		$option['obj']=$tags->obj;
		
		
		
		$option['breakcrum']=$this->createBreakCrum(null);
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
		$option['cate'] = $category->getChildren();
	
		
        return $this->output = $this->getHtml()->showDefault($option);

	}
	
	
	function showSearch($option=array()){
		global $bw,$vsTemplate,$vsStd,$vsPrint;
		$condition="1=1 and status >0";
		//echo 123123;die;

		if(!$bw->input['keyword']){
			$vsPrint->boink_it($bw->base_url);
		}

		foreach (explode(" ",$bw->input['keyword']) as $key => $value) {
			$condition.=" AND title like '%".mysql_real_escape_string($value)."%'";
		}



		$this->model->setCondition($condition);
		$this->model->setOrder("`index`,id desc");
		$option=$this->model->getPageList($bw->input[0]."/".$bw->input[1],2,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_public_limit',12));

		$option['breakcrum']=$this->createBreakCrum(null);
		if($bw->input['keyword'])
			$option['title']=VSFactory::getLangs()->getWords('products_search_title','Tìm kiếm với từ khóa: ')."<i>".$bw->input['keyword']."</i>";
		
		$vsPrint->mainTitle=$vsPrint->pageTitle="Tìm kiếm với từ khóa: ".$option['title'];
		$option['obj']=new Menu();
		$option['title_search']=$vsPrint->mainTitle;
		//pr(VSFactory::createConnectionDB());die;

		$option['cateObj']=$option['obj'];
		$option['cateObj']->setTitle($option['title']);
		$option['cate']=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$option['cate']->setTitle("Sản phẩm");
		//print_r($option['size']);die;

        return $this->output = $this->getHtml()->showCategoryLevel4($option);
        
//		return $this->output="";
	}
	function showCategory(){
		global $bw,$vsPrint;
               // $category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);

		$slug = str_replace(".html", '', $bw->input[2]);
		
		VSFactory::getMenus ()->setCondition("menuSlug='{$slug}'");
		$category = VSFactory::getMenus ()->getOneObjectsByCondition();
		//$category->createSeo();

		//pr($category);die;
		if (! $category) {
			$vsPrint->boink_it ( $bw->base_url );
		}

		if($bw->input[3])
			return $this->showDetail($bw->input[3]);	//die;



		if($category->getLevel()==4){
			$cate = VSFactory::getMenus ()->extractNodeInTree($category->getParentId(),VSFactory::getMenus ()->arrayTreeCategory);
			
			$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
			$condition=	"status>0 and catId in ({$ids})";

			$this->model->setCondition($condition);
			$this->model->setOrder("`index` DESC,id desc");
			$option=$this->model->getPageList($bw->input[0]."/".$bw->input[1]."/".$bw->input[2],3,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_public_limit',12));
			$option['cate']=$cate['category'];
			$option['cateObj']=$category;

			$option['breakcrum']=$this->createBreakCrum($category);



			$this->model->setCondition("status>0 and catId in ({$ids}) AND `hot` LIKE '%2%' ");
			$this->model->setLimit(array(0,5));
			$this->model->setOrder('`index` DESC');
			$option['hot']=$this->model->getObjectsByCondition();	

		

			return $this->output = $this->getHtml()->showCategoryLevel4($option);die;
		}

              

		$cate = VSFactory::getMenus ()->extractNodeInTree($category->getId(),VSFactory::getMenus ()->arrayTreeCategory);

        $option['cate']=$cate['category'];

        foreach ($option['cate']->children as $key=>$value){
			$ids=VSFactory::getMenus()->getChildrenIdInTree($key);
			$this->model->setCondition("status>0 and catId in ({$ids})");
			$this->model->setLimit(array(0,5));
			$this->model->setOrder('`index` DESC');
			$option['pageList'][$key]=$this->model->getObjectsByCondition();
			//if(empty($option['pageList'][$key]))
				//unset($option['cate'][$key]);
		} 

		$option['breakcrum']=$this->createBreakCrum($category);

        if($category->getLevel()<4){
        	return $this->output = $this->getHtml()->showCategory($option);
        }



        return $this->output = $this->getHtml()->showCategory($option);

		$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
		$condition=	"status>0 and catId in ({$ids})";

		$this->model->setCondition($condition);
		$this->model->setOrder("`index` DESC,id desc");
		$option=$this->model->getPageList($bw->input[0]."/".$bw->input[1]."/".$bw->input[2],3,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_public_limit',12));

		$option['title']=$category->getTitle();
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
        $option['obj']=$category;
        $option['breakcrum']=$this->createBreakCrum($category);

        $option['size']=VSFactory::getMenus()->getCategoryGroup('products_size')->getChildren();

       
    
		return $this->output = $this->getHtml()->showCategory($option);
	}	


	function getItemSkin(){
		global $vsTemplate;
		
		if(!isset($_SESSION['obj_visit'])){
			return false;
		}
		//$pr->setFieldsString('id,price,promotion,title,mUrl');
		$id=implode(",",$_SESSION['obj_visit']);
		$this->model->setCondition("status > 0 AND `id` in($id) ");
		$option['list']=$this->model->getObjectsByCondition();
		return $this->getHtml()->itemProduct($option['list']);
	}


	function showSearchPro(){
		global $bw,$vsPrint;
               // $category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		//$idcate = $this->getIdFromUrl($catId);		
		//$category=VSFactory::getMenus()->getCategoryById($idcate);
		if(!$category){
			//$vsPrint->boink_it($bw->base_url);
		}
		//$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
		//$condition=	"status>0 and catId in ({$ids})";

		$condition="1=1 AND status>0";
		if($bw->input['catId']){
			$category=VSFactory::getMenus()->getCategoryById($bw->input['catId']);
			$ids=VSFactory::getMenus()->getChildrenIdInTree($bw->input['catId']);
			$condition.=" and catId in ({$ids})";
		}

		if($bw->input['size']){
			$size=implode(",",array_keys($bw->input['size']));
			$condition.=" AND size in ({$size})";
		}


		
		if($bw->input['brand_select']){
			$condition.=" AND brand in ({$bw->input['brand_select']})";
		}

		if($bw->input['brand']){
			$br=implode(",",$bw->input['brand']);
			$condition.=" AND brand in ({$br})";
		}



		if($bw->input['price_from'] AND $bw->input['price_from']>0){
			$condition.=" AND price >= {$bw->input['price_from']}";
		}

		if($bw->input['price_to'] AND $bw->input['price_to']>0){
			$condition.=" AND price <={$bw->input['price_to']}";
		}





		$this->model->setCondition($condition);
		$this->model->setOrder("`index` DESC,id desc");
		$option=$this->model->getPageList($bw->input[0]."/".$bw->input[1],2,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_public_limit',12));

		
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
        $option['obj']=$category;
        $option['breakcrum']=$this->createBreakCrum($category);

        $option['size']=VSFactory::getMenus()->getCategoryGroup('products_size')->getChildren();

        if($category){
	        if($category->level==3){
	       		$category->setId($category->parentId);
	       	}
       	$option['title']=$category->getTitle();
       	$cate = VSFactory::getMenus ()->extractNodeInTree($category->getId(),VSFactory::getMenus ()->arrayTreeCategory);
       	}


        

        $option['obj_cate']=$category;

        $option['cate']=VSFactory::getMenus()->getCategoryGroup($bw->input[0])->getChildren();

        //print_r($option['obj_cate']);die;

		return $this->output = $this->getHtml()->showDefault($option);
	}	


	function showCateAjax($catId){
		global $bw,$vsPrint;
               // $category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$idcate = $this->getIdFromUrl($bw->input[2]);		
		$category=VSFactory::getMenus()->getCategoryById($idcate);
		if(!$category){
			//$vsPrint->boink_it($bw->base_url);
		}

		$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
		$condition=	"status=2 and catId in ({$ids})";

		$this->model->setCondition($condition);
		$this->model->setOrder("`index` DESC,id desc");


		$this->size_limt=10;
		$detect = new Mobile_Detect;
		if ($detect->isMobile()) {
			$this->size_limt=5;
		}
		
		$this->model->setLimit(array(0,$this->size_limt));
		$option['list']=$this->model->getObjectsByCondition();

     
        $option['obj_cate']=$category;

        //print_r($option['obj_cate']);die;
        $bw->input['ajax']=1;

		return $this->output = $this->getHtml()->showCateAjax($option);
	}

	function showDefault($option = array()) {
		global $bw, $vsTemplate, $vsStd, $vsPrint;

		/*$db=VSFactory::createConnectionDB();
		$option['pageList']=$this->model->getObjectsByCondition();	
		$i=1;
		foreach ($option['pageList'] as $key => $value) {
			$title="Máy đo huyết áp omron hem"." test demo".$i;
			//$query="UPDATE vsf_product SET `title`='{$title}' WHERE `id`={$value->getId()} ";
			$price=rand(10000,100000);
			$url=VSFactory::getTextCode()->removeAccent($value->getTitle(),"-");
			$query="UPDATE vsf_product SET `title`='{$title}' WHERE `id`={$value->getId()} ";
			$db->query($query);
			//$this->model->basicObject->setMUrl();
			//$this->model->basicObject->setId($value->getId());
			//$this->model->updateObject();	
			$i++;
		}
		pr(VSFactory::createConnectionDB());*/
		
		$category = VSFactory::getMenus ()->getCategoryGroup ($bw->input [0]);
		if (! $category) {
			$vsPrint->boink_it ( $bw->base_url );
		}
		$option['cate']=$category->getChildren();
		$option['breakcrum']=$this->createBreakCrum(null);

		foreach ($option['cate'] as $key=>$value){
			$ids=VSFactory::getMenus()->getChildrenIdInTree($key);
			$this->model->setCondition("status>0 and catId in ({$ids})");
			$this->model->setLimit(array(0,5));
			$this->model->setOrder('`index` DESC');
			$option['pageList'][$key]=$this->model->getObjectsByCondition();
		} 
		
		

		return $this->output = $this->getHtml()->showDefault($option);


/*	

		//$ids = VSFactory::getMenus ()->getChildrenIdInTree ( $category);
		//$condition=	"status>0 and catId in ({$ids})";


		$this->model->setCondition($condition);


		$this->model->setOrder("`index` desc,id desc");
		$tmp=$this->model->getPageList($bw->input[0],1,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',12));
		$option=array_merge($tmp,$option);
		$option['breakcrum']=$this->createBreakCrum(null);
		$option['title']=VSFactory::getLangs()->getWords($bw->input[0]);
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
        $option['cate'] = $category->getChildren();

        $option['size']=VSFactory::getMenus()->getCategoryGroup('products_size')->getChildren();
        return $this->output = $this->getHtml()->showDefault($option);*/
	}
        
	function showDetail($objId,$option=array()){
		global $vsPrint, $bw,$vsTemplate;     
        
		$slug=str_replace(".html","",$bw->input[3]);
        $this->model->setCondition("LOWER(mUrl)='{$slug}'");
		 $obj= $this->model->getOneObjectsByCondition();

		//pr($obj);die;

		if(empty($obj)) {
			$vsPrint->boink_it($bw->base_url."404.html");
		}
		$option['breakcrum']=$this->createBreakCrum($obj);
		$option['other']=$this->getOtherList($obj);
       // $option['cate'] = $category->getChildren();
        //$option['cate_obj']=VSFactory::getMenus()->getCategoryById($obj->getCatId());
       	$obj->createSeo();
       	
       	require_once CORE_PATH.'gallerys/gallerys.php';
		$galerys=new gallerys();
		$option['files_list']=$galerys->getAlbumByCode($bw->input[0]."_".$obj->getId());
       	
       
		$category=VSFactory::getMenus()->getCategoryById($obj->getCatId());

        
        $cate = VSFactory::getMenus ()->extractNodeInTree($category->getParentId(),VSFactory::getMenus ()->arrayTreeCategory);
        $option['cate']=$cate['category'];
        $option['cateObj']=$category;

        if(isset($_COOKIE['obj_visit'])){	
        	$_SESSION['obj_visit']=explode(",", $_COOKIE['obj_visit']);
	        $_SESSION['obj_visit'][$obj->getId()]=$obj->getId();     
	        $_SESSION['obj_visit']=array_unique($_SESSION['obj_visit']); 
	        $co=implode(",",$_SESSION['obj_visit']);
	        setcookie("obj_visit",$co, time()+3600*24000,"/");
	    }else{
	    	setcookie("obj_visit",$obj->getId(), time()+3600*24000);
	    }    

	    $id_other=implode(",",array_keys($option['other']));
	    $this->model->setCondition("`status`>0 AND `id` not IN($id_other)");
	    $this->model->setLimit(array(0,4));
	    $option['list_cate_diff']=$this->model->getObjectsByCondition();

        $option['payment_info']=Object::getObjModule('pages', 'payment_info', '>0');

		
    	return $this->output = $this->getHtml()->showDetail($obj,$option);
	}
	public function getOtherList($obj) {
		global $bw;
		$vsMenu = VSFactory::getMenus();
		$cat = $vsMenu->getCategoryById ( $obj->getCatId () );
		$ids = $vsMenu->getChildrenIdInTree ( $cat );
	
		$this->model->setOrder ( "`index` Desc, id Desc" );
		$condition = "id <> {$obj->getId()} and status >0";

		if($obj->getDeal()==1){
			$condition = "id <> {$obj->getId()} and status >0 AND `deal`=1";
		}	

		$this->model->setLimit ( array (0, 4 ) );
		if ($ids)
			$condition .= " and catId in ( {$ids})";
	
		$this->model->setCondition($condition);
		return $this->model->getObjectsByCondition ();
	}
	
	
	/*
	 * Show detail action
	 */
	function getListLangObject() {
	}

	/**
	 *
	 * @param
	 *        	BasicObject
	 */
	protected function onDeleteObject($obj) {
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
	 *
	 *
	 *
	 *
	 *
	 * Enter description here ...
	 *
	 * @var skin_products
	 */
	public $html;
}

?>