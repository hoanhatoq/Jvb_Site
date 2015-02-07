<?php
require_once(CORE_PATH."skins/skins.php");
class VSFSkin extends skins {
	public $wrapper = "";
	public $imageDir = "";
	public $cssDir = "";
	function __construct() {
		parent::__construct ();
		$this->getDefaultSkin ();
		
		$this->imageDir = $this->basicObject->getFolder () . "/images";
		$this->cssDir = $this->basicObject->getFolder () . "/css";
		$this->javaDir = $this->basicObject->getFolder () . "/javascripts/";
		
	}

	function __destruct() {
	}
	function show() {
		if(APPLICATION_TYPE=='user'){
			if(file_exists(CORE_PATH.'adverts/adverts.php')){
				require_once CORE_PATH.'adverts/adverts.php';
				$advert=new adverts();
				$request=ltrim($_SERVER['REQUEST_URI'],"/");
				$advert->url=$request;
				//'<advert code="global_banner" />'
		 		$this->wrapper=$advert->parseHtml($this->wrapper);
			}
		}
		echo $this->wrapper;
	}
	function loadWrapper() {
		global $vsCom,$bw;	
		$detect = new Mobile_Detect;
		if ($detect->isMobile() ) {

 			$this->meta_m='<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width" />';
		}	


	



		$BWHTML = "";
		$BWHTML .= <<<EOF
			<!DOCTYPE html>
			<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi" dir="ltr">
			<head>
			<title>{$this->TITLE}</title>
			<meta http-equiv="Content-Language" content="vi" />
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="Language" content="Vietnamese">
			<meta name="author" content="{$this->AUTHOR}">
			<meta name="copyright" content="{$this->COPYRIGHT}">
			<meta name="robots" content="FOLLOW,INDEX">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				
			<meta name="geo.region" content="VN" />
			<meta name="geo.position" content="10.777392;106.700662" />
			<meta name="ICBM" content="10.777392, 106.700662" />

				
			<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
			<meta name="DC.title" content="{$vsCom->SEO->basicObject->getTitle()}" />
			<meta name="DC.identifier" content="{$bw->base_url}" />
		    <meta name="DC.description" content="{$vsCom->SEO->basicObject->getIntro()}" />
			
			<meta name="DC.language" scheme="ISO639-1" content="en" />
			
			
			
			<link href="{$this->GOOGLELINK}" rel="publisher" />
			<link rel="shortcut icon" href="{$this->SHORTCUT}" type="image/x-icon" />
			{$this->GENERATOR}
			{$this->CSS}
			{$this->JAVASCRIPT_TOP}
			</head>
			<body>
			{$this->BOARD}

			</body> 
			</html>
			{$this->JAVASCRIPT_BOTTOM }
EOF;
			return $this->wrapper = $BWHTML;
	}
}
?>