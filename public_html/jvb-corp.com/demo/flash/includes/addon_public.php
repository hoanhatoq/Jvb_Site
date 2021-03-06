<?php
require_once LIBS_PATH.'boards/addons/addon_public_board.php';
class addon_public extends addon_public_board{
	function getMenuTop($option=array()){
		global   $bw;
		$option['menu']=VSFactory::getMenus()->getMenuForUser();
        $option['list'] = VSFactory::getMenus()->getListGroup();   
		foreach ($option['menu'] as $menu) {
			if(@strpos($bw->input['vs'], trim($menu->getUrl(),'/')) ===0){
				$menu->active="active";
			}
			if($bw->vars['public_frontpage']== $bw->input['vs']&&$menu->getUrl()=='' ){
				$menu->active="active";
			}
			if($menu->cate){
				$cate=VSFactory::getMenus()->getCategoryGroup($menu->cate);
				if($cate&&$cate->getChildren()){
					$menu->children=$cate->getChildren();
				}
			}
			/*if(in_array($menu->getUrl(), array("services/"))){
				$option['obj_services'][$menu->getId()]=Object::getObjModule('pages', 'services', '>0', '', '');
			}
			if(in_array($menu->getUrl(), array("customers/"))){
				$option['obj_customers'][$menu->getId()]=Object::getObjModule('pages', 'customers', '>0', '', '');
			}*/

		}
                
               
		return $this->getHtml()->getMenuTop($option);
	}
	

	function getBannerByCode($code){
		if (is_array ( $this->banner [$code] ))
			return $this->banner [$code];
		$ids = VSFactory::getMenus ()->getChildrenIdInTree ( VSFactory::getMenus ()->getCategoryGroup ( "banners" ) );
		
		require_once CORE_PATH . 'banners/banners.php';
		$banners = new banners ();
		$banners->setFieldsString ( "id,title,url,image,intro,video" );
		$banners->setCondition ( "`POSITION` IN (
					SELECT id FROM vsf_bannerpo
					WHERE `code`='$code'
				) and `status`>0 and catId in ($ids) " );
		$banners->setOrder ( "`index` desc" );
		
		$this->banner [$code] = $banners->getObjectsByConditionWithImage ();
		return $this->banner [$code];
	}
	
	function getItemProuctBySession(){
		global $vsTemplate;
		require_once CORE_PATH . 'products/products.php';
		$pr=new products();


		pr(21312);die;

		if(!isset($_SESSION['obj_visit'])){
			return false;
		}
		//$pr->setFieldsString('id,price,promotion,title,mUrl');
		$id=implode(",",$_SESSION['obj_visit']);
		$pr->setCondition("status > 0 AND `id` in($id) ");
		$option['list']=$pr->getObjectsByCondition();
		return $this->getHtml()->getItemProuctBySession($option);
	}


	function getMenuMain($option=array()){
		global   $bw;
		
		$option['menu']=VSFactory::getMenus()->getMenuByPosition('main');
        $option['list'] = VSFactory::getMenus()->getListGroup();   
		foreach ($option['menu'] as $menu) {
			if(@strpos($bw->input['vs'], trim($menu->getUrl(),'/')) ===0){
				$menu->active="active";
			}
			if($bw->vars['public_frontpage']== $bw->input['vs']&&$menu->getUrl()=='' ){
				$menu->active="active";
			}
			if($menu->cate){
				$cate=VSFactory::getMenus()->getCategoryGroup($menu->cate);
				if($cate&&$cate->getChildren()){
					$menu->children=$cate->getChildren();
				}
			}
			if(in_array($menu->getUrl(), array("services/"))){
				$option['obj_service'][$menu->getId()]=Object::getObjModule('pages', 'services', '>0', '', '');

			}
			if(in_array($menu->getUrl(), array("lease/"))){
				$option['obj_lease'][$menu->getId()]=Object::getObjModule('pages', 'lease', '>0', '', '');

			}
			
		}
                
               
		return $this->getHtml()->getMenuMain($option);
	}
	function getMenuBottom($option = array()) {
		global $bw;
		$option ['menu'] = VSFactory::getMenus ()->getMenuByPosition ( 'bottom' );
		foreach ( $option ['menu'] as $menu ) {
			if (@strpos ( $bw->input ['vs'], trim ( $menu->getUrl (), '/' ) ) === 0) {
				$menu->active = "active";
			}
			if ($bw->vars ['public_frontpage'] == $bw->input ['vs'] && $menu->getUrl () == '') {
				$menu->active = "active";
			}
		}
		return $this->getHtml ()->getMenuBottom ( $option );
	}

	
	
	function getBanner(){
		$option['banner']=Object::getObjModule('pages', 'slidebanner', '>0', '', '');
	  return $this->getHtml()->getBanner($option);
	}
	
	
	
	function getSupports(){
		$option['support']=Object::getObjModule('supports', 'supports', '>0', '', ' ');
		
	  return $this->getHtml()->getSupport($option);
	}

	function getProductCategory($option = array()) {
		require_once CORE_PATH . 'products/products.php';
		$option ['category'] = VSFactory::getMenus ()->getCategoryGroup ( 'products' )->getChildren();
		return $this->getHtml ()->getProductCategory( $option );
	}
	function getAboutBlock(){
		$option['about']=Object::getObjModule('pages', 'abouts', '>0', '', '1');
	  return $this->getHtml()->getAboutBlock($option);
	}
	function getNewsBlock(){
		$option['news']=Object::getObjModule('pages', 'news', '=2', '', '');
	  return $this->getHtml()->getNewsBlock($option);
	}
	function getAdsBlock(){
		$option['ads']=Object::getObjModule('banners', 'banners', '>0', '', '');
	  return $this->getHtml()->getAdsBlock($option);
	}
	function getProMaxBlock(){
		require_once CORE_PATH . products . "/" . products . '.php';		
		$pages = new products ();
		$category = VSFactory::getMenus ()->getCategoryGroup ( 'products' );
		$ids = VSFactory::getMenus ()->getChildrenIdInTree ( $category );
		$pages->setCondition ( "status>0 and state=2 and catId in ($ids)" );
		$pages->setOrder ( "`index` DESC,id DESC" );
		$option['proMax']=$pages->getObjectsByCondition ();
		
		
	  return $this->getHtml()->getProMaxBlock($option);
	}
	function getProHightline($option = array()) {
		require_once CORE_PATH . 'products/products.php';
		$option['cate']=VSFactory::getMenus()->getCategoryGroup("products")->getChildren();
			$count=0;
			foreach ($option['cate'] as $key=>$value) {
				foreach ($value->getChildren() as $k=>$v) {
					if($v->getStatus()==2){
						$count ++;
						$option['cateHome'][$k]=$v;
						if($count==3)
						break;
					}	
				}
				
			}
		
		return $this->getHtml ()->getProHightline( $option );
	}
	function getCustomerBlock($option = array()) {
		$option['cus']=Object::getObjModule('pages', 'customers', '=2', '', '');
		
	
		return $this->getHtml ()->getCustomerBlock( $option );
	}
	
	
}

?>