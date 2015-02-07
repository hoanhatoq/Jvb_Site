<?php
class skin_development extends skin_pages{
	
	
	function showDetail($obj,$option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		
		
		
		$BWHTML .= <<<EOF


	<div class="content">
		
	    <div class="centers">
	    	
	       {$obj->getContent()}
	       		
	    </div>
	    <div class="clear"></div>
	</div>

		
				

EOF;
	}


	

}
?>