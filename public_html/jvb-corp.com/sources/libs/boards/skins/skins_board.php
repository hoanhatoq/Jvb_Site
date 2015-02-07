<?php
class skins_board {

	/**
	 *
	 * @return VSFLanguage
	 */
	function getLang() {
		return VSFactory::getLangs ();
	}

	/**
	 *
	 * @return settings
	 */
	function getSettings() {
		return VSFactory::getSettings ();
	}
	public $DS = "\\";

	function cut($string, $limit) {
		return VSFactory::getTextCode ()->cutString ( strip_tags ( $string ), $limit );
	}

	function dateTimeFormat($int, $format = "d/m/Y") {
		
		$int = $int?$int:time();
		
		return VSFactory::getDateTime ()->getDate ( $int, $format );
	}

	function numberFormat($number, $dec = 0) {
		return @number_format ( $number, $dec, ',', '.' );
	}
	
	
	function numberFormatDeal($obj, $dec = 0) {
		$number=$obj->getPrice();
		if($obj->getPromotion()>0){
			$number=$obj->getPromotion();
		}
		if($obj->getPromotion()>0){
			$number=$obj->getPromotion();
		}
		if($obj->getPrice_deal()>0 && $obj->getDeal()==1){
			$number=$obj->getPrice_deal();
		}
		
		return @number_format ( $number, $dec, ',', '.' );
	}

	function numberFormatPro($number, $dec = 0) {
		if (! $number)
			return "Call " . $this->getLang ()->getWords ( 'global_phone', '0903-567-789' );
		return @number_format ( $number, $dec ) . " " . $this->getLang ()->getWords ( 'unit', 'VN�' );
	}


	function getCundown($date){
	
		return $date-time();
	}

	
	
function dateTimeFormatAgo($int) {
		
		$int = $int?$int:time();
		
		$time_go=$this->nicetime($int);
		
		return $time_go;
	}
		
		
function nicetime($date){
	
	if(empty($date)) {
	return "No date provided";
	} 
	$periods = array("giây", "phút", "giờ", "ngày", "tuần", "tháng", "năm", "thập kỉ");
	$lengths = array("60","60","24","7","4.35","12","10");
	 
	$now = time();
	$unix_date = $date;
	
	//echo $unix_date;exit();
	 
	// check validity of date
	if(empty($unix_date)) {
	return "Bad date";
	}
	 
	// is it future date or past date
	if($now > $unix_date) {
	$difference = $now - $unix_date;
	$tense = "trước";
	 
	} else {
	$difference = $unix_date - $now;
	$tense = "bây giờ";
	}
	 
	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	$difference /= $lengths[$j];
	}
	 
	$difference = round($difference);
	 
	if($difference != 1) {
	$periods[$j].= "";
	}
 return "$difference $periods[$j] {$tense}";
}	
	
	/**
	 *
	 * @return admins
	 */
	function getAdmin() {
		return VSFactory::getAdmins ();
		;
	}

	function urlEncode($str) {
		return urlencode ( $str );
	}

	function htmlspecialchars($str) {
		return htmlspecialchars ( $str );
	}

	/**
	 *
	 * @return users
	 */
	function getUser() {
		return VSFactory::getUsers ();
		;
	}

	function createEditor($content, $name, $width, $height, $toolbar = 'simple', $theme = 'advanced') {
		global $vsPrint, $vsStd;
		
		$vsStd->requireFile ( JAVASCRIPT_PATH . "/tiny_mce/tinyMCE.php" );
		$editor = new tinyMCE ();
		$editor->setWidth ( $width );
		$editor->setHeight ( $height );
		$editor->setToolbar ( $toolbar );
		$editor->setTheme ( $theme );
		$editor->setInstanceName ( $name );
		$editor->setValue ( $content );
		
		return $editor->createHtml ();
	}

	static function titleSorter($a, $b) {
		if (is_object ( $a ) && is_object ( $b ))
			if ($a->getTitle () > $b->getTitle ())
				return 1;
		return 0;
	}
	
	function getSelectOption($obj,$selected=0,$method="getTitle"){
	
		if(!$obj) return;
	
		$html = "";
		foreach ($obj as $key => $value){
			$select = "";
			if($selected==$key) $select = "selected";
			$html .= "<option value='$key' $select>{$value->$method()}</option>";
		}
		return $html;
	
	}
	function get($var){
		return $var;
	}
	
}

?>