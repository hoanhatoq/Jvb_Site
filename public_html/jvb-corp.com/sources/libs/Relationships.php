<?php
require_once(LIBS_PATH."Relationship.class.php");
class VSFRelationship  extends VSFObject{
	
	public $tableName 		= NULL;
	public $primaryField 	= NULL;
	public $basicClassName = 'Relationship';
		
	public $result 		= array();
	public $arrayField 	= array();
	
	public $obj	= NULL;
	public $relId 	= "";
	public $objectId = "";
	

	
	public $arrval 		= array();
	private $arrObj		= array();
	
	
	function resetParameter(){
		$this->result	= array();
		$this->arrayField 	= array();
		$this->arrval 		= array();
	}
		
	function resetObject(){
		$this->relId 	= "";
		$this->objectId = "";
		$this->resetParameter();
	}
	function __construct() {
		parent::__construct();
	}
	
	function __destruct() {
		unset($this->tableName);
		unset($this->primaryField);
//		unset($this->basicClassName);
		unset($this->result);
		unset($this->arrayField);
		unset($this->arrval);
		unset($this->arrObj);
		unset($this->relId);
		unset($this->objectId);
	}
	
	//fill $tableName $objectId $relId  and delete if we have full infomation about it

	function delRelByObject(){
		$this->result['status'] == true;
		if(!$this->check_exitTable()){
			$this->result['status'] == false;
			$this->result['message'] .= "Table [".SQL_PREFIX.$this->tableName."] not exits";
			return false;
		}
		if($this->objectId){
			$condition="objectId in ($this->objectId)";
			$this->setCondition($condition);
			$this->deleteObjectByCondition();
		}
		return true;
	}
	
	function delObjectByRel(){
		$this->result['status'] == true;
		if(!$this->check_exitTable()){
			$this->result['status'] == false;
			$this->result['message'] .= "Table [".SQL_PREFIX.$this->tableName."] not exits";
			return false;
		}
		if($this->relId){
			$condition="relId =".$this->relId;
			$this->setCondition($condition);
			$this->deleteObjectByCondition();
		}
		return true;
	}
	
	function delRelationByOption($condition){
		$this->result['status'] == true;
		if(!$this->check_exitTable()){
			$this->result['status'] == false;
			$this->result['message'] .= "Table [".SQL_PREFIX.$this->tableName."] not exits";
			return false;
		}
		$this->setCondition($condition);
		$this->deleteObjectByCondition();
		return true;
	}
	
	// return $arrval if has field and $val
	function getObjectObjByRel($group=0){
		$DB = VSFactory::createConnectionDB();
		$vsLang = VSFactory::getLangs();
		if(!$this->check_exitTable()){
			$this->result['status'] = false;
			$this->result['message'] .= $vsLang->getWords("global_relationship_err_noTable","This table is not exits")."<br>";
			return false;
		}
		
			
		if($this->relId){
			$DB->simple_construct(
						array(	'select'	=> '*',
								'from'		=> $this->tableName,
								'where'		=> "relId in ({$this->relId})"
							)
					);
			$DB->simple_exec();
			$this->resetParameter();
			$count = count($this->primaryField);
			
			$rel = $DB->fetch_row();
			while($rel){
				$this->basicObject = clone $this->basicObject;
				$this->basicObject->convertToObject($rel);
				
				if($group){
					if($count){
						$eval ="\$this->arrObj";
						foreach($this->primaryField as $field)
							$eval = $eval."[$rel[$field]]";
						eval($eval."=\$this->basicObject ;");
					}else $this->arrObj[$rel['objectId']][$rel['relId']] = $this->basicObject;

				 }else $this->arrObj[$rel['objectId']] = $this->basicObject;
				 
				 
				 $rel = $DB->fetch_row();
			}
			return true;
		}else{
			$this->result['status'] = false;
			$this->result['message'] .= "relId not exits<br>";
			return false;
		} 
	}
	
	
	function getObjectByRel($advance = false){
		$vsLang = VSFactory::getLangs();
		$DB = VSFactory::createConnectionDB();
		if(!$this->check_exitTable()){
			$this->result['status'] = false;
			$this->result['message'] .= $vsLang->getWords("global_relationship_err_noTable","This table is not exits")."<br>";
			return "";
		}
		if($this->relId){
			$DB->simple_construct(
				array(	'select'	=> '*',
						'from'		=> $this->tableName,
						'where'		=> "relId in ({$this->relId})"
				)
			);
			$DB->simple_exec();
			$this->resetParameter();
			
			$rel = $DB->fetch_row();
			while($rel){
				$objectId .= $rel['objectId'].',';
				if($advance) $this->arrval[$rel['objectId']] = $rel;
				$rel = $DB->fetch_row();
			}
			return trim($objectId,',');
		}else{
			$this->result['status'] = false;
			$this->result['message'] .=  $vsLang->getWords("global_relationship_err_relIdNotExist","relId is not exist")."<br>";
			return "";
		}
	}
	
	// return $arrval if has field and $val
	function getRelObjByObject($group=0){
		$vsLang = VSFactory::getLangs();
		$DB = VSFactory::createConnectionDB();
		if(!$this->check_exitTable()){
			$this->result['status'] = false;
			$this->result['message'] .= $vsLang->getWords("global_relationship_err_noTable","This table is not exists")."<br>";
			return false;
		}
		if($this->objectId){
			$arr =	array(	'select'	=> '*',
							'from'		=> $this->tableName,
							'where'		=> "objectId in ({$this->objectId})"
						);
						
			if($this->relId) $arr['where'] .= " and relId in ($this->relId)";
			$DB->simple_construct($arr);
			$DB->simple_exec();

			$this->resetParameter();

			$count = count($this->primaryField);
			
			$rel = $DB->fetch_row();

			while($rel) {
				$this->basicObject = clone $this->basicObject;
				$this->basicObject->convertToObject($rel);
				
				 if($group){
					if($count){
						$eval ="\$this->arrObj";
						foreach($this->primaryField as $field)
							$eval = $eval."[$rel[$field]]";
						eval($eval."=\$this->basicObject ;");
					}else $this->arrObj[$rel['relId']][$rel['objectId']] = $this->basicObject;

				 }else $this->arrObj[$rel['relId']] = $this->basicObject;
				 
				 $rel = $DB->fetch_row();
			}
			return true;
		}else{
			$this->result['status'] = false;
			$this->result['message'] .= $vsLang->getWords("global_relationship_err_objIdNotExist","objectId is not exist")."<br>";
			return false;
		} 
	}
	
	function getRelByObject($advance=0){
		$vsLang = VSFactory::getLangs();
		$DB = VSFactory::createConnectionDB();
		if(!$this->check_exitTable()){
			$this->result['status'] = false;
			$this->result['message'] .= $vsLang->getWords("global_relationship_err_noTable","This table is not exists")."<br>";
			return "";
		}
		if($this->objectId){
			$arr =	array(	'select'	=> '*',
							'from'		=> $this->tableName,
							'where'		=> "objectId in ({$this->objectId})"
						);
						
			if($this->relId) $arr['where'] .= " and relId in ($this->relId)";
			$DB->simple_construct($arr);
			$DB->simple_exec();

			$this->resetParameter();
			$rel = $DB->fetch_row();
			
			while($rel) {
				 $relId .= $rel['relId'].',';
				 if($advance) $this->arrval[$rel['relId']] = $rel;
				 $rel = $DB->fetch_row();
			}
			return trim($relId,',');
			
		}else{
			$this->result['status'] = false;
			$this->result['message'] .= $vsLang->getWords("global_relationship_err_objIdNotExist","objectId is not exist")."<br>";
			return "";
		} 
	}
	
	
	function getRelationObjByOption($option = array(), $group = 0, $advance = 1){
		$vsLang = VSFactory::getLangs();
		$DB = VSFactory::createConnectionDB();
		if(!$this->check_exitTable()){
			$this->result['status'] = false;
			$this->result['message'] .= $vsLang->getWords("global_relationship_err_noTable","This table is not exits")."<br>";
			return "";
		}
		$arr =	array(	'select'	=> ($option['select']? $option['select'] : '*'),
						'from'		=> ($option['from'] ? $option['from']  : $this->tableName),
						'where'		=> ($option['where'] ? $option['where']  : 1),
						'groupby'	=> ($option['group'] ? $option['group']  : NULL),
						'having'	=> ($option['having'] ? $option['having']  : NULL),
					);
		
		$DB->simple_construct($arr);
		$DB->simple_exec();
		$this->resetParameter();

		$count = count($this->primaryField);
		$rel = $DB->fetch_row();
		while($rel){
			$this->basicObject = clone $this->basicObject;
			$this->basicObject->convertToObject($rel);
			$relId .= $rel['relId'].',';
			if($group){
				if($count){
					$eval ="\$this->arrObj";
					foreach($this->primaryField as $field)
						$eval = $eval."[$rel[$field]]";
					eval($eval."=\$this->basicObject ;");
				}else{
					$this->arrObj[reset($rel)] = $this->basicObject;
					if($advance) $this->arrval[$rel['relId']] = $rel;
				} 
			 }else{
			 	if($advance) $this->arrval[$rel['relId']] = $rel;
			 	$this->arrObj[$this->basicObject->getRelId()] = $this->basicObject;
			 } 

			 $rel = $DB->fetch_row();
		}
		return trim($relId,',');
	}
	
	
	function getRelationByOption($advance = false, $option = array()){
		$vsLang = VSFactory::getLangs();
		$DB = VSFactory::createConnectionDB();
		if(!$this->check_exitTable()){
			$this->result['status'] = false;
			$this->result['message'] .= $vsLang->getWords("global_relationship_err_noTable","This table is not exits")."<br>";
			return "";
		}
		$arr =	array(	'select'	=> ($option['select']? $option['select'] : '*'),
						'from'		=> ($option['where'] ? $option['where']  : $this->tableName),
						'where'		=> ($option['where'] ? $option['where']  : 1),
					);
		$DB->simple_construct($arr);
		$DB->simple_exec();
		$this->resetParameter();
		
		$resultKey = $option['key']?$option['key']:"objectId";
		$rel = $DB->fetch_row();
		while($rel){
			$relationId .= $rel[$resultKey].',';
			if($advance) $this->arrval[] = $rel;
			$rel = $DB->fetch_row();
		}
		return trim($relationId,',');
	}
	
	//tao 1 table relationship  khi co $this->tableName 
	function createTable(){
		$DB = VSFactory::createConnectionDB();
		$this->result['status']=true;
		if($this->tableName == ""){
			$this->result['status'] = false;
			$this->result['message'] .= "Name table  can't be left blank!<br>";
			return false;
		}
		if($this->check_exitTable()){
			$this->result['message'] .= "Table name[".SQL_PREFIX.$this->tableName."] has been exits";
			return false;
		}	
		$sql = $this->getSQLString();
		$DB->query($sql);
		if($DB->query_id)
		 	$this->result['message'] .= "Table name[".SQL_PREFIX.$this->tableName."] has been created success";
		return true;
	}
	
	function insertRel($groupDelete=NULL, $advance = NULL){
		global $bw;
		$this->result['status'] == true;
		$this->validateRelation();
		
		if(!$this->result['status']) return false;
		
		if(!$this->check_exitTable()) $this->createTable();
		
		if($advance) $condition = $advance;
		else{
			if(is_string($this->objectId)||is_numeric($this->objectId))
				$condition = $groupDelete ? "objectId in ({$this->objectId}) and relId in ({$groupDelete})":"objectId in ({$this->objectId})";
			else $this->result['message'] .= "objectId is not a numberic";
		}
		$DB = VSFactory::createConnectionDB();
		$DB->simple_delete($this->tableName, $condition);
		$DB->simple_exec();
		
		$array = explode(',',$this->relId);
		
		foreach ($array as $value) {
			$this->createBasicObject();
			$array = array(
						'relId'=>$value,
						'objectId'=>$this->objectId,
					);
			if(count($this->arrayField))
				$array = array_merge((array)$array, (array)$this->arrayField);
			
			$this->basicObject->convertToObject($array);
			
			$dbObj = $this->basicObject->convertToDB();
			if($DB->do_insert($this->tableName, $dbObj)){
				if($DB->query_id) $this->result['message'] .= "Insert value to table [".SQL_PREFIX.$this->tableName."] succcess";
			}
		}
	}

	function initRelationship(){
		if( $this->tableName == ""){
			$this->result['status'] = false;
			$this->result['message'] .= "Name table  can't be left blank!<br>";
			return false;
		}
		if(!$this->check_exitTable()) $this->createTable();
	}
	
	function getSQLString(){
		$advance = " , ";
		foreach ($this->arrayField as $key => $value)
			$advance .= $key." ".$value['value']." ".$value['default'].", ";
		
		return "
			CREATE TABLE `".SQL_PREFIX.$this->tableName."` (			  
			  	objectId varchar(56) NOT NULL,
			  	relId varchar(56) NOT NULL".
				substr($advance,0,-2).
			") ENGINE=MyISAM ;
		";
	}
	
	function validateRelation(){
		$this->result['status'] = true;
		$this->result['message'] = "";
		if( $this->tableName == ""){
			$this->result['status'] = false;
			$this->result['message'] .= "Name table  can't be left blank!<br>";
		}
		if(!intval($this->objectId)){
			$this->result['status'] = false;
			$this->result['message'] .= "Name objectId  can't be left blank or type is int!<br>";
		}
		if( $this->relId == "" ){
			$this->result['status'] = false;
			$this->result['message'] .= "Name relId  can't be left blank or type is int!<br>";
		}	
	}
	
	function check_exitTable(){
		global $bw;
		$listTB = VSFactory::createConnectionDB()->get_table_names();
		$nameTB = SQL_PREFIX.$this->tableName;
	
		foreach ($listTB as $val){
			if($val == $nameTB) return 1;
		}
		return 0;			
	}
	
	function setArrayField($array){
		if(is_array($array)){
			$this->arrayField = $array;
			$extendField = array_keys($this->arrayField);
			
			$this->basicObject->extendObjectFields($extendField);
		}
	}
	
	function setPrimaryField($array){
		if(is_array($array)) $this->primaryField = $array;
	}

	function setRelId($relId){
		$this->relId = $relId;
	}

	function setObjectId($objectId) {
		$this->objectId = $objectId;
	}
	
	function getArrObj(){
		return $this->arrObj;
	}
	
/*
	function setFieldName($fileName, $type) {
		global $DB;
		if(!$DB->field_exists($fileName,$this->tableName))
			$DB->sql_add_field($this->tableName,$fileName,$type);
		return $this->arrayField[$fileName]=$fileName;
	}
	
	function setFieldValue($fileName, $value) {
		isset($this->arrayField[$fileName])? $this->$fileName=$value:'';
	}
	
	function getFieldValue($fileName) {
		if(isset($this->arrayField[$fileName]))
			 return $this->$fileName;
	}
*/
	
	function insertRel2($groupDelete=NULL, $advance = NULL, $empty = true){
		global $bw;
		$DB = VSFactory::createConnectionDB();
		$this->result['status'] == true;
		$this->validateRelation();
		
		if(!$this->result['status']) return false;
		
		if(!$this->check_exitTable()) $this->createTable();
		if($empty){
			if($advance) $condition = $advance;
			else{
				if(is_string($this->objectId)||is_numeric($this->objectId))
					$condition = $groupDelete ? "objectId in ({$this->objectId}) and relId in ({$groupDelete})":"objectId in ({$this->objectId})";
				else $this->result['message'] .= "objectId is not a numberic";
			}
			
			$DB->simple_delete($this->tableName, $condition);
			$DB->simple_exec();
		}
		$array = explode(',',$this->relId);
		
		foreach ($array as $value) {
			$array = array(
						'relId'=>$value,
						'objectId'=>$this->objectId,
					);
			if(count($this->arrayField))
				$array = array_merge((array)$array, (array)$this->arrayField);
			
			$this->basicObject->convertToObject($array);
			
			$dbObj = $this->basicObject->convertToDB();
			if($DB->do_insert($this->tableName, $dbObj)){
				if($DB->query_id) $this->result['message'] .= "Insert value to table [".SQL_PREFIX.$this->tableName."] succcess";
			}
		}
	}
}