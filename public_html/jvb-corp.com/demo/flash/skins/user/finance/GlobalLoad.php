<?php
class GlobalLoad {

	function __construct() {
		$this->addDefaultScript ();
		$this->addDefaultCSS ();
	}
	function addDefaultScript() {
		global $vsPrint, $bw, $vsSkin;
		

		
		$vsPrint->addCurentJavaScriptFile ( 'jquery-1.7.1',1 );
		//$vsPrint->addCurentJavaScriptFile ( 'jquery.validate');
	
		$vsPrint->addCurentJavaScriptFile ( 'jquery.nivo.slider',1);
		$vsPrint->addCurentJavaScriptFile ( 'slideios',1);
		$vsPrint->addCurentJavaScriptFile ( 'jquery.lazy',1);
		$vsPrint->addCurentJavaScriptFile ( 'jquery.bxslider',1);

		$vsPrint->addCurentJavaScriptFile ( 'imenu');

		//$vsPrint->addCurentJavaScriptFile("jquery.fancybox");

		//$vsPrint->addCurentJavaScriptFile("script",1);
		
		//$vsPrint->addCurentJavaScriptFile("easyTooltip",1);

		//$vsPrint->addCurentJavaScriptFile("jquery.elevatezoom",1);	
		
		

//		$vsPrint->addCurentJavaScriptFile ( 'start');

//		
		
		
		
		
//		$jspath = ROOT_PATH . $vsSkin->basicObject->getFolder () . "/javascripts/";
//		$files = $this->find ( $jspath, '/\.js/' );
//		foreach ( $files as $value ) {
//			if ($value == "jquery.js") {
//				// $vsPrint->addCurentJavaScriptFile(str_replace(".js","",$value),1);
//			} else {
//				//$vsPrint->addCurentJavaScriptFile(str_replace(".js","",$value));
//			}
//		}
//		$vsPrint->addJavaScriptFile ( 'jquery.numeric' );
		$vsPrint->addJavaScriptString ( 'global_var', '
		
		
    			var vs = {};
				var noimage=0;
				var image = "loader.gif";
				var imgurl = "' . $bw->vars ['img_url'] . '";
				var img = "' . $bw->vars ['cur_folder'] . 'htc";
				var boardUrl = "' . $bw->vars ['board_url'] . '";
				var baseUrl  = "' . $bw->base_url . '";
				 var ajaxfile = boardUrl + "/index.php";
				var global_website_title = "' . $bw->vars ['global_websitename'] . '";
    		', 1 );
		$vsSettings = VSFactory::getSettings ();
		if ($vsSettings->getSystemKey ( 'google_analysiss', 1, 'global', 1, 1 ) && $vsSettings->getSystemKey ( 'google_analysis_key', 'UA-42288880-1', 'global', 1, 1 )) {
			$vsPrint->addJavaScriptString ( 'global_analysis', "
    			 
    		" );
		}
	}

	function addDefaultCSS() {
		global $vsUser, $vsPrint, $vsModule, $vsSkin;

		
		$vsPrint->addCSSFile("style");
		$vsPrint->addCSSFile("jquery.bxslider");
		//$vsPrint->addCSSFile("nivo-slider");

		//$vsPrint->addCSSFile ( 'jquery.fancybox' );
		
	}

	function find($direct, $pattern) {
		$images = array ();
		if ($dir = opendir ( $direct )) {
			
			while ( false !== ($file = readdir ( $dir )) ) {
				if ($file != "." && $file != ".." && $file != '.svn') {
					if (is_dir ( $file )) {
						// $images=array_merge($images,$this->find($file,$pattern,$file."/"));
					} else {
						if (preg_match ( $pattern, $file )) {
							$images [] = $file;
						}
					}
				}
			}
			closedir ( $dir );
		}
		return $images;
	}
}
$styleLoad = new GlobalLoad ();