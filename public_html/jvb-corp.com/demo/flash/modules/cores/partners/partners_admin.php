<?php
require_once(LIBS_PATH.'boards/VSAdminBoard.php');

class partners_admin extends VSAdminBoard {


	/**
	*auto run function
	*System IDE create
	**/
	public	function auto_run(){
	
		global $bw;		$this->tabs[]=array(
				'id'=>'partners',
				'href'=>"{$bw->base_url}{$bw->input[0]}/partners_display_tab/&ajax=1",
				'title'=>$this->getLang()->getWords("tab_".$bw->input[0],$bw->input[0]),
				'default'=>0,
		);
	if(VSFactory::getSettings()->getSystemKey ( $bw->input[0]. '_category_list', 0, $bw->input[0] )){
			$this->tabs[]=array(
				'id'=>'categorys_partnerss',
				'href'=>"{$bw->base_url}menus/display-category-tab/{$bw->input[0]}/&ajax=1",
				'title'=>$this->getLang()->getWords("{$bw->input[0]}_category","Danh mục"),
				'default'=>0,
				);
	}
		parent::auto_run();
	}



}
