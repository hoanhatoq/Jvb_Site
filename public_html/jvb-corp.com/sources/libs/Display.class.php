<?php
/*
+-----------------------------------------------------------------------------
|   VIET SOLTION SJC version 3.0.0
|	Author: BabyWolf
|	Homepage: http://vietsol.net
|	If you use this code, please don't delete these comment line!
|	Start Date: 21/09/2004
|	Finish Date: 22/09/2004
|	Modified Start Date: 07/02/2007
|	Modified Finish Date: 10/02/2007
+-----------------------------------------------------------------------------
*/

class VSFDisplay {
	var $to_print = "";
	var $output = "";
	var $macros = "";
	var $javaScriptFile = array ();
	var $javaScript = array ();
	var $cssOutput = array ();
	
	var $pageTitle = "";
	var $mainTitle = "";
	public $displayPrint = false;
	public $featureBox = "";
	
	//-------------------------------------------
	// CONSTRUCTOR
	//-------------------------------------------
	function __construct() {
		$this->pageTitle = VSFactory::getLangs()->getWords ( 'global_page_title', 'Home page' );
		$this->mainTitle = VSFactory::getLangs()->getWords ( 'global_main_title', 'Home page' );
	
	}
	
	/**
	 * This function is for add css to the list
	 * @name addCSSFile
	 * @author BabyWolf
	 * @param String $cssFileName
	 * @return void
	 */
	function addCSSFile($cssFileName = "",$media="") {
		$this->cssOutput [$cssFileName][0] = 'styles';
		$this->cssOutput [$cssFileName][1] = $media;
	}
	
	/**
	 * This function is for add css to the list
	 * @name addGlobalCSSFile
	 * @author BabyWolf
	 * @param String $cssFileName
	 * @return void
	 */
	function addGlobalCSSFile($cssFileName = "",$media="") {
		$this->cssOutput [$cssFileName][0] = 'global';
		$this->cssOutput [$cssFileName][1] = $media;
	}
	
	/**
	 * This function is for build javascript to html
	 * @name buildJavaScript
	 * @author BabyWolf
	 * @return void
	 */
	function buildCSS() {
		global $vsTemplate, $bw, $vsSkin;
		$cssStylesPath = ROOT_PATH . $vsSkin->cssDir . "/";
		$cssStylesUrl = '/' . $vsSkin->cssDir . "/";
		$cssGlobalPath = ROOT_PATH . "styles/css/";
		$cssGlobalUrl = "/styles/css/";
		$css = "";
		if (IN_DEV||APPLICATION_TYPE=='admin') {
			foreach ( $this->cssOutput as $key => $value ) {
				if ($value[0] == 'global' && file_exists ( $cssGlobalPath . $key . ".css" )) {
					$css .= $vsTemplate->getGlobal()->addCSS ( $bw->vars ['board_url'] . $cssGlobalUrl . $key,$value[1] );
				} elseif ($value[0] == 'styles' && file_exists ( $cssStylesPath . $key . ".css" )) {
					$css .= $vsTemplate->getGlobal()->addCSS ( $bw->vars ['board_url'] . $cssStylesUrl . $key,$value[1] );
				}
			}
		} else {
			$minify = $bw->vars ['board_url'] . "/components/min/index.php?";
			$css = '<link rel="stylesheet" type="text/css" href="' . $minify . 'f=';
			foreach ( $this->cssOutput as $key => $value ) {
				if ($value == 'global' && file_exists ( $cssGlobalPath . $key . ".css" )) {
					$css .= $cssGlobalUrl . $key . '.css,';
				} elseif ($value == 'styles' && file_exists ( $cssStylesPath . $key . ".css" )) {
					$css .= $cssStylesUrl . $key . '.css,';
				}
			}
			$css = rtrim ( $css, ',' );
			$css .= '">';
		}
		return $css;
	}
	
	/**
	 * This function is for add javascript to the list
	 * @name addJavaScriptFile
	 * @author BabyWolf
	 * @param String $scriptFileName
	 * @return void
	 */
	function addJavaScriptFile($scriptFileName = "", $postion = 0) {
		$this->javaScript [$scriptFileName] [0] = 'file';
		$this->javaScript [$scriptFileName] [1] = $scriptFileName;
		$this->javaScript [$scriptFileName] [2] = $postion;
	}
	
	/**
	 * This function is for add javascript to the list
	 * @name addJavaScriptString
	 * @author BabyWolf
	 * @param String $scriptFileName
	 * @return void
	 */
	function addJavaScriptString($name = "", $script = "", $postion = 0) {
		$this->javaScript [$name] [0] = 'string';
		$this->javaScript [$name] [1] = $script;
		$this->javaScript [$name] [2] = $postion;
	}
	/**
	 * This function is for add javascript to the list
	 * @name addJavaScriptFile
	 * @author BabyWolf
	 * @param String $scriptFileName
	 * @return void
	 */
	function addCurentJavaScriptFile($scriptFileName = "", $postion = 0) {
		$this->javaScript [$scriptFileName] [0] = 'cur_file';
		$this->javaScript [$scriptFileName] [1] = $scriptFileName;
		$this->javaScript [$scriptFileName] [2] = $postion;
	}
	
	function addExternalJavaScriptFile($scriptFileName = "", $postion = 0) {
		$this->javaScript [$scriptFileName] [0] = 'external';
		$this->javaScript [$scriptFileName] [1] = $scriptFileName;
		$this->javaScript [$scriptFileName] [2] = $postion;
	}
	/**
	 * This function is for build javascript to html
	 * @name buildJavaScript
	 * @author BabyWolf
	 * @return void
	 */
	function buildJavaScript() {
		global $bw, $vsTemplate, $vsSkin;
		$java = array ();
		$jsPath = "javascripts/";
		if (IN_DEV||APPLICATION_TYPE=='admin') {
			foreach ( $this->javaScript as $value ) {
				if ($value [0] == 'file') {
					if (file_exists ( $jsPath . $value [1] . ".js" )) {
						$java [$value [2]] ['file'] .= $vsTemplate->getGlobal()->addJavaScriptFile ( $value [1], 'file' );
					}
				} elseif ($value [0] == 'cur_file') {
					$java [$value [2]] ['cur_file'] .= $vsTemplate->getGlobal()->addJavaScriptFile ( $value [1], 'cur_file' );
				} elseif ($value [0] == 'external') {
					$java [$value [2]] ['external'] .= $vsTemplate->getGlobal()->addJavaScriptFile ( $value [1], 'external' );
				} elseif ($value [0] == 'string') {
					$java [$value [2]] ['string'] .= $vsTemplate->getGlobal()->addJavaScript ( $value [1] );
				}
			}
			$html [0] = $java [0] ['file'] . $java [0] ['cur_file'] . $java [0] ['string'] . $java [0] ['external'];
			$html [1] = $java [1] ['string'] . $java [1] ['cur_file'] . $java [1] ['file'] . $java [1] ['external'];
		} else {
			$start_minify .= "<script type='text/javascript' src='" . $bw->vars ['board_url'] . "/components/min/index.php?" . "charset=utf-8&f=";
			$currentjsPath = $vsSkin->javaDir;
			foreach ( $this->javaScript as $value ) {
				if ($value [1] == 'tiny_mce/tiny_mce') {
					$tinymce = $vsTemplate->getGlobal()->addJavaScriptFile ( $value [1] );
					continue;
				}
				if ($value [0] == 'file') {
					if (file_exists ( $jsPath . $value [1] . ".js" )) {
						$minify [$value [2]] .= '/' . $jsPath . $value [1] . ".js,";
					}
				} elseif ($value [0] == 'cur_file') {
					$minify [$value [2]] .= '/' . $currentjsPath . $value [1] . ".js,";
				} elseif ($value [0] == 'string') {
					$html [$value [2]] .= $vsTemplate->getGlobal()->addJavaScript ( $value [1] );
				} elseif ($value [0] == 'external') {
					$external .= $vsTemplate->getGlobal()->addJavaScriptFile ( $value [1], 'external' );
				}
			}
			$stop_minify .= "'></script>";
			$html [1] = $html [1] . $start_minify . rtrim ( $minify [1], ',' ) . $stop_minify . $tinymce;
			$html [0] = $html [0] . $start_minify . rtrim ( $minify [0], ',' ) . $stop_minify . $external;
		}
		return $html;
	}
	
	//-------------------------------------------
	// Appends the parsed HTML to our class var
	//-------------------------------------------
	function addOutput($to_add) {
		$this->to_print .= $to_add;
		//return 'true' on success
		return true;
	}
	/*-------------------------------------------------------------------------*/
	//
	// Parses all the information and prints it.
	//
	/*-------------------------------------------------------------------------*/
	function doOutput() {
		global $vsCom, $Debug, $bw, $vsStd, $vsTemplate, $vsSkin;
		//-------------------------------------------
		// END TIMER
		//-------------------------------------------
		$this->ex_time = sprintf ( "%.4f", $Debug->endTimer () );
		//-------------------------------------------
		// SQL DEBUG?
		//-------------------------------------------
		$this->_check_debug();
		$stats = $this->_show_debug ();
		// Page title
		$this->lang=$_SESSION['user']['language']['vsfcurrentLang']['code'];
		//$this->pageTitle .= " | " . VSFactory::getSettings ()->getSystemKey ( "websitename_".$this->lang, " ", "configs" );
		$this->pageTitle = VSFactory::getSettings ()->getSystemKey ( "websitename_".$this->lang, " ", "configs" )." | ".$this->pageTitle;
		// Main title
		$this->mainTitle = $this->mainTitle ? $vsTemplate->getGlobal()->global_main_title () : "";
		
		//---------------------------------------------------------
		// SITE MAIN CONTENT
		//---------------------------------------------------------
		if($vsTemplate->getGlobal()->alone){
                        $vsSkin->BOARD = $this->to_print;
                }else{
                $vsTemplate->getGlobal()->SITE_MAIN_CONTENT = $this->to_print;
		$vsSkin->BOARD = $vsTemplate->getGlobal()->vs_global();
                }
		
		$vsSkin->TITLE = $this->pageTitle;
		$vsSkin->SHORTCUT = $bw->vars ['board_url'] . "/favicon.ico";
		//   	$vsSkin->wrapper = preg_replace('/\s\s+/', '&lt;', $vsSkin->wrapper);
		$vsSkin->CSS = $this->buildCSS ();
		//---------------------------------------------------------
		// JSCRIPT
		//---------------------------------------------------------
		$javascript = $this->buildJavaScript ();
		$vsSkin->JAVASCRIPT_TOP = $javascript [1];
		$vsSkin->JAVASCRIPT_BOTTOM = $javascript [0];
		//---------------------------------------------------------
		// Get the macros and replace them
		//---------------------------------------------------------
		$vsSkin->IMG_DIR = $bw->skin ['_imagedir'];
		
		$vsSkin->loadWrapper ();
		//$vsSkin->wrapper = preg_replace('/script \n+/script', '\n', $vsSkin->wrapper);
		$this->zip_file();
		$vsCom->injectLastProcess();
		$vsSkin->show ();
		
		$this->lastestProject ();
		
		
		$this->_finish ();
	}
/*-------------------------------------------------------------------------*/
	//
	// this function build content for iframe,only show script and content, not show global skins
	//
	/*-------------------------------------------------------------------------*/
	function doOutputContent() {
		global $vsCom, $Debug, $bw, $vsStd, $vsTemplate, $vsSkin;
		//-------------------------------------------
		// END TIMER
		//-------------------------------------------
		$this->ex_time = sprintf ( "%.4f", $Debug->endTimer () );
		//-------------------------------------------
		// SQL DEBUG?
		//-------------------------------------------
		$this->_check_debug();
		$stats = $this->_show_debug ();
		// Page title
		$this->pageTitle .= " | " . $bw->vars ['global_websitename'];
		// Main title
		$this->mainTitle = $this->mainTitle ? $vsTemplate->getGlobal()->global_main_title () : "";
		
		//---------------------------------------------------------
		// SITE MAIN CONTENT
		//---------------------------------------------------------
		if($vsTemplate->getGlobal()->alone){
                        $vsSkin->BOARD = $this->to_print;
                }else{
                $vsTemplate->getGlobal()->SITE_MAIN_CONTENT = $this->to_print;
		$vsSkin->BOARD = $vsTemplate->getGlobal()->SITE_MAIN_CONTENT;//$vsTemplate->getGlobal()->vs_global();
                }
		
		$vsSkin->TITLE = $this->pageTitle;
		$vsSkin->SHORTCUT = $bw->vars ['board_url'] . "/favicon.ico";
		//   	$vsSkin->wrapper = preg_replace('/\s\s+/', '&lt;', $vsSkin->wrapper);
		
		$vsSkin->CSS = $this->buildCSS ();
		//---------------------------------------------------------
		// JSCRIPT
		//---------------------------------------------------------
		$javascript = $this->buildJavaScript ();
		$vsSkin->JAVASCRIPT_TOP = $javascript [1];
		$vsSkin->JAVASCRIPT_BOTTOM = $javascript [0];
		//---------------------------------------------------------
		// Get the macros and replace them
		//---------------------------------------------------------
		$vsSkin->IMG_DIR = $bw->skin ['_imagedir'];
		
		$vsSkin->loadWrapper ();
		//$vsSkin->wrapper = preg_replace('/script \n+/script', '\n', $vsSkin->wrapper);
		$this->zip_file();
		$vsCom->injectLastProcess();
		$vsSkin->show ();
		$this->lastestProject ();
		$this->_finish ();
	}
	function lastestProject() {
		global  $bw, $vsSetting;
//		if(APPLICATION_TYPE=='user'){
//			VSFactory::getCacheVar()->updateCache();
//		}

		/////////////
		if(VSFactory::getLangs()->change){
			//$exp=var_export(VSFactory::getLangs()->currentKeys,true);
			//CACHE_PATH
			//fwrite($handle, $string)
			VSFactory::getLangs()->exportToCache();
		}
		//echo VSFactory::getSettings()->builcachesetting;exit;
		if(VSFactory::getSettings()->builcachesetting){
			VSFactory::getSettings()->addSetting();
		}
	}
	
	/*-------------------------------------------------------------------------*/
	// print the headers
	/*-------------------------------------------------------------------------*/
	function do_headers() {
		global $vsTemplate, $bw;
		$bw->vars ['nocache']=2;
		if(LAST_MODIFY_FILE&&!$bw->vars ['nocache']&&APPLICATION_TYPE!='admin'){
			$cache_file = LAST_MODIFY_FILE;
			if (file_exists($cache_file)) {
				$lastmodtime = gmdate("D, d M Y H:i:s", filemtime($cache_file));
				$lastExptime = gmdate("D, d M Y H:i:s", filemtime($cache_file)+30);
				
				if(! strstr($lastmodtime, "GMT")) {
					$lastmodtime .= " GMT";
				}

				header ('Last-Modified: ' . $lastmodtime);
				header ('Cache-Control: max-age=9999, must-revalidate');
				header ('Expires: ' . $lastExptime);
				die();
			}
		}
		$bw->vars ['print_headers'] = isset ( $bw->vars ['print_headers'] ) ? $bw->vars ['print_headers'] : 0;
		if ($bw->vars ['print_headers']) {
			@header ( "HTTP/1.0 200 OK" );
			@header ( "HTTP/1.1 200 OK" );
			@header ( "Content-type: text/html" );
			@header ( "Cache-Control: no-cache, must-revalidate, max-age=0" );
			@header ( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
			@header ( "Pragma: no-cache" );
			if ($bw->vars ['nocache']) {
				@header ( "Cache-Control: no-cache, must-revalidate, max-age=0" );
				@header ( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
				@header ( "Pragma: no-cache" );
			}
		}
	}
	/*-------------------------------------------------------------------------*/
	//
	// Redirect using HTTP commands, not a page meta tag.
	//
	/*-------------------------------------------------------------------------*/
	
	function boink_it($url) {
		global $bw;
		VSFactory::createConnectionDB()->close_db();
		// Ensure &amp;s are taken care of
		$url = str_replace ( "&amp;", "&", $url );
		if ($bw->vars ['header_redirect'] == 'refresh')
			header ( "Refresh: 2;url=" . $url );
		else if ($bw->vars ['header_redirect'] == 'html') {
			@flush ();
			echo ("<html><head><meta http-equiv='refresh' content='2; url=$url'></head><body></body></html>");
			exit ();
		} else {
			@header ( "HTTP/1.1 301 Moved Permanently" );
			@header ( "Location: " . $url );
		}
		exit ();
	}
	/*-------------------------------------------------------------------------*/
	//
	// print a pure redirect screen
	//
	/*-------------------------------------------------------------------------*/
	function redirect_screen($text = "", $url = "", $override = 0) {
		global $bw, $vsStd, $vsTemplate;
//		if ($bw->skin_global == "")
//			$vsTemplate->getGlobal() = new skin_global ();
		if ($bw->input ['debug']) {
			flush ();
			exit ();
		}
		if ($override != 1) {
			if ($bw->base_url)
				$url = $bw->base_url . $url;
			else
				$url = "{$bw->vars['board_url']}/?" . $url; //index.{$bw->vars['php_ext']}?".$url;
		}
		//---------------------------------------------------------
		// Feck off first?
		//---------------------------------------------------------
		if ($bw->vars ['ipb_remove_redirect_pages'] == 1)
			$this->boink_it ( $url );
		
		$bw->lang ['stand_by'] = stripslashes ( $bw->lang ['stand_by'] );
		// CSS
		$css = $this->buildCSS ();
		
		// Get template
		$htm = $vsTemplate->getGlobal()->Redirect($text, $url, $css);
		echo ($htm);
		$this->_finish ();
	}
	
	//-------------------------------------------
	// show_debug
	// @internal
	//-------------------------------------------
	function _show_debug() {
		global $bw,  $vsStd;
		$DB=VSFactory::createConnectionDB();
		$input = "";
		$queries = "";
		$sload = "";
		$stats = "";
		//+----------------------------------------------
		// Form & Get & Skin
		//+----------------------------------------------
		$bw->vars ['debug_level'] = isset ( $bw->vars ['debug_level'] ) ? $bw->vars ['debug_level'] : 0;
		
		if ($bw->vars ['debug_level'] >= 2) {
			$stats .= "<br />\n<div class='tableborder'>\n<div class='pformstrip'>FORM and GET Input</div><div class='row1' style='padding:6px'>\n";
			
			while ( list ( $k, $v ) = each ( $bw->input ) )
				$stats .= "<strong>$k</strong> = $v<br />\n";
			
			$stats .= "</div>\n</div>";
			$stats .= "<br />\n<div class='tableborder'>\n<div class='pformstrip'>SKIN & TASK Info</div><div class='row1' style='padding:6px'>\n";
			while ( list ( $k, $v ) = each ( $bw->skin ) ) {
				if (strlen ( $v ) > 120)
					$v = substr ( $v, 0, 120 ) . '...';
				$stats .= "<strong>$k</strong> = " . $vsStd->txt_htmlspecialchars ( $v ) . "<br />\n";
			}
			
			$stats .= "<b>Next task</b> = " . $vsStd->get_date ( $bw->cache ['systemvars'] ['task_next_run'], 'LONG' ) . "\n<br /><b>Time now</b> = " . $vsStd->get_date ( time (), 'LONG' );
			$stats .= "<br /><b>Timestamp Now</b> = " . time ();
			$stats .= "</div>\n</div>";
			$stats .= "<br />\n<div class='tableborder'>\n<div class='pformstrip'>Loaded PHP Templates</div><div class='row1' style='padding:6px'>\n";
			$stats .= "<strong>" . implode ( ", ", $bw->loaded_templates ) . "</strong><br />\n";
			$stats .= "</div>\n</div>";
		
		}
		// SQL
		if ($bw->vars ['debug_level'] >= 3) {
			$stats .= "<br />\n<div class='tableborder'>\n<div class='pformstrip'>Queries Used</div><div class='row1' style='padding:6px'>";
			foreach ( $DB->obj ['cached_queries'] as $q ) {
				$q = htmlspecialchars ( $q );
				$q = preg_replace ( "/^SELECT/i", "<span class='red'>SELECT</span>", $q );
				$q = preg_replace ( "/^UPDATE/i", "<span class='blue'>UPDATE</span>", $q );
				$q = preg_replace ( "/^DELETE/i", "<span class='orange'>DELETE</span>", $q );
				$q = preg_replace ( "/^INSERT/i", "<span class='green'>INSERT</span>", $q );
				$q = str_replace ( "LEFT JOIN", "<span class='red'>LEFT JOIN</span>", $q );
				$q = preg_replace ( "/(" . $bw->vars ['sql_tbl_prefix'] . ")(\S+?)([\s\.,]|$)/", "<span class='purple'>\\1\\2</span>\\3", $q );
				$stats .= "$q<hr />\n";
			}
			if (count ( $DB->obj ['shutdown_queries'] )) {
				foreach ( $DB->obj ['shutdown_queries'] as $q ) {
					$q = htmlspecialchars ( $q );
					$q = preg_replace ( "/^SELECT/i", "<span class='red'>SELECT</span>", $q );
					$q = preg_replace ( "/^UPDATE/i", "<span class='blue'>UPDATE</span>", $q );
					$q = preg_replace ( "/^DELETE/i", "<span class='orange'>DELETE</span>", $q );
					$q = preg_replace ( "/^INSERT/i", "<span class='green'>INSERT</span>", $q );
					$q = str_replace ( "LEFT JOIN", "<span class='red'>LEFT JOIN</span>", $q );
					
					$q = preg_replace ( "/(" . $bw->vars ['sql_tbl_prefix'] . ")(\S+?)([\s\.,]|$)/", "<span class='purple'>\\1\\2</span>\\3", $q );
					$stats .= "<div style='background:#DEDEDE'><b>SHUTDOWN:</b> $q</div><hr />\n";
				}
			}
			$stats .= "</div>\n</div>";
		}
		
		if ($stats) {
			$collapsed_ids = ',' . $vsStd->my_getcookie ( 'collapseprefs' ) . ',';
			$show ['div_fo'] = 'show';
			$show ['div_fc'] = 'none';
			if (strstr ( $collapsed_ids, ',debug,' )) {
				$show ['div_fo'] = 'none';
				$show ['div_fc'] = 'show';
			}
			
			$stats = "<div align='center' style='display:{$show['div_fc']}' id='fc_debug'>
					   <div class='row2' style='padding:8px;vertical-align:middle'><a href='javascript:togglecategory(\"debug\", 0);'>Show Debug Information</a></div>
					  </div>
					  <div align='center' style='display:{$show['div_fo']}' id='fo_debug'>
					   <div class='row2' style='padding:8px;vertical-align:middle'><a href='javascript:togglecategory(\"debug\", 1);'>Hide Debug Information</a></div>
					   <br />
					   <div class='tableborder' align='left'>
						<div class='maintitle'>Debug Information</div>
						 <div style='padding:5px;background:#8394B2;'>$stats</div>
					   </div>
					  </div>";
		}
		return $stats;
	}
	//-------------------------------------------
	// check_debug
	// @internal
	//-------------------------------------------
	function _check_debug() {
		global $bw, $vsStd;
		$DB=VSFactory::createConnectionDB();
		if ($DB->obj ['debug']) {
			flush ();
			print "<html><head><title>SQL Debugger</title><body bgcolor='white'><style type='text/css'> TABLE, TD, TR, BODY { font-family: verdana,arial, sans-serif;color:black;font-size:11px }</style>";
			print "<h1 align='center'>SQL Total Time: {$DB->sql_time} for {$DB->sql_count} queries</h1><br />" . $bw->debug_html;
			print "<br /><div align='center'><strong>Total SQL Time: {$DB->sql_time}</div></body></html>";
			exit ();
		}
	}
	
	function zip_file() {
		if(VSFactory::getSettings()->getSystemKey('enable_gzip', 1, 'global', 0, 1)){
			$buffer = ob_get_contents ();
			ob_end_clean ();
			ob_start ( 'ob_gzhandler' );
			print $buffer;
		}
	}
	//-------------------------------------------
	// finish
	// @internal
	//-------------------------------------------
	function _finish() {
		global $bw, $vsStd;
		//---------------------------------------------------------
		// Do shutdown
		//---------------------------------------------------------
		if (! USE_SHUTDOWN) {
			$vsStd->__destruct ();
			VSFactory::createConnectionDB()->close_db ();
		}
		//---------------------------------------------------------
		// Print, plop and part
		//---------------------------------------------------------
		$this->do_headers ();
		exit ();
	}
} // END class
?>