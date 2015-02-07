<?php
 // For multibytes 
 // mb_language("Vietnamese");
 mb_detect_order("auto");
 ini_set("mbstring.http_input", "auto");
 mb_http_output("auto");
 mb_internal_encoding("UTF-8");
 mb_substitute_character("none");
  
 // For user
 define("VPN_DB_HOST", "localhost");
 define("VPN_DB_USER", "jvbadm_test");
 define("VPN_DB_PASS", "sl1981");
 define("VPN_DB_NAME", "jvbadm_test");

?>
