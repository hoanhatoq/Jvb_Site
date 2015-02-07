<?php
    class AdmClass
    {
    	function __construct() {
    	}
        function get_passwd($email)
        {
        	// Create query to get 
        	$query = 'SELECT email, passwd from v_adm_tbl WHERE email = ' . '\'' . $email . '\'';
        	$result = mysql_query($query);
        	$num=mysql_numrows($result);
			if ($num == 1) {
        		$password=mysql_result($result,0,"passwd");
        	} else 
        	{	
        		$password = 'NULL';
        	}
            return $password ;
        }
	}
?>

