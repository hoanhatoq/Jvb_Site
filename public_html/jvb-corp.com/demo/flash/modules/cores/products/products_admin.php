<?php
require_once(LIBS_PATH.'boards/VSAdminBoard.php');

class products_admin extends VSAdminBoard {


	/**
	*auto run function
	*System IDE create
	**/
	public	function auto_run(){
	
		global $bw;		
		$this->tabs[]=array(
				'id'=>"{$bw->input[0]}",
				'href'=>"{$bw->base_url}products/products_display_tab/&ajax=1",
				'title'=>$this->getLang()->getWords("tab_product",'product'),
				'default'=>1,
		);
		
		/*$this->tabs[]=array(
				'id'=>"{$bw->input[0]}_labelss",
				'href'=>"{$bw->base_url}products/productlabels_display_tab/&ajax=1",
				'title'=>$this->getLang()->getWords("{$bw->input[0]}_labels","Nhãn"),
				'default'=>1,
		);*/
		
	if(VSFactory::getSettings()->getSystemKey ( $bw->input[0]. '_products_category_list', 0, $bw->input[0] )){
			$this->tabs[]=array(
				'href'=>"{$bw->base_url}menus/display-category-tab/{$bw->input[0]}/&ajax=1",
				'title'=>$this->getLang()->getWords("{$bw->input[0]}_category","Danh mục"),
				'default'=>0,
				);
	}
	/*$this->tabs[]=array(
		'href'=>"{$bw->base_url}menus/display-category-tab/{$bw->input[0]}_size/&ajax=1",
		'title'=>$this->getLang()->getWords("Size"),
		'default'=>0,
		);

	$this->tabs[]=array(
		'href'=>"{$bw->base_url}menus/display-category-tab/brand/&ajax=1",
		'title'=>$this->getLang()->getWords("brand",'Thương hiệu'),
		'default'=>0,
		);

	if(VSFactory::getSettings()->getSystemKey ( $bw->input[0]. '_products_label', 0, $bw->input[0] )){
			$this->tabs[]=array(
				'id'=>"{$bw->input[0]}_label",
				'href'=>"{$bw->base_url}menus/display-category-tab/{$bw->input[0]}_label/&ajax=1",
				'title'=>$this->getLang()->getWords("{$bw->input[0]}_label","Nhãn"),
				'default'=>0,
				);
	}*/
	
	
		parent::auto_run();
	}



}
