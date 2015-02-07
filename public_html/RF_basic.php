<?php
require("config.php");

class RF_basic {

  public $rf_id ;
  public $l_id;
  function __construct($rf_id, $l_id) 
  {
    $this->rf_id = $rf_id;
    $this->l_id = $l_id;

  }
  // To get rental factory name
  public function get_RF_name()
  	 
  {
    mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
    @mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
    $sql = "SET NAMES ujis";
    mysql_query($sql);

    $query = "SELECT * FROM v_rental_factory_nls WHERE rf_id = '" . 
              $this->rf_id . "' AND l_id = '". $this->l_id . "'" ;
    $result=mysql_query($query);
    $num=mysql_numrows($result);
    //echo $query;
    if ($num == 1){
    	$rf_short_desc = mysql_result($result,0,"short_desc");
    	}
    else{
    	  $rf_short_desc = "N/A";
    	}
    //return $query;
    return $rf_short_desc;
  }	  
  // This function to get city address of this rental factory
  public function get_RF_city()
  	 
  {
    mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
    @mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
    $query = "SELECT   pc.short_desc short_desc " .
             "FROM     v_prov_cities pc, ".
                      "v_rental_factories rf ".
             "WHERE    pc.pc_id = rf.pc_id ".
             "AND      rf.rf_id = '". $this->rf_id . "' " . 
             "AND      pc.l_id = '" . $this->l_id . "'"; 
    $result=mysql_query($query);
    $num=mysql_numrows($result);
    if ($num == 1){
    	$pc_short_desc = mysql_result($result,0,"short_desc");
    	}
    else{
    	  $pc_short_desc = "N/A";
    	}
    //return $query;
    return $pc_short_desc;
  }	  
  // This function to get city id of this rental factory
  public function get_city_id()
  	 
  {
    mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
    @mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
    $query = "SELECT   rf.pc_id  " .
             "FROM     v_rental_factories rf ".
             "WHERE    rf.rf_id = '". $this->rf_id . "' " . 
             "AND      rf.l_id = '" . $this->l_id . "'"; 
    $result=mysql_query($query);
    $num=mysql_numrows($result);
    if ($num == 1){
    	$pc_id = mysql_result($result,0,"pc_id");
    	}
    else{
    	  $pc_id = "N/A";
    	}
    //return $query;
    return $pc_id;
  }	  
  // This function to get city area of this rental factory
  public function get_city_area()
  	 
  {
    mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
    @mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
    $query = "SELECT   rf.pc_id  " .
             "FROM     v_rental_factories rf ".
    
             "WHERE    rf.rf_id = '". $this->rf_id . "' " . 
             "AND      rf.l_id = '" . $this->l_id . "'"; 
    $result=mysql_query($query);
    $num=mysql_numrows($result);
    if ($num == 1){
    	$pc_id = mysql_result($result,0,"pc_id");
    	}
    else{
    	  $pc_id = "N/A";
    	}
    //return $query;
    return $pc_id;
  }	  
}

?>