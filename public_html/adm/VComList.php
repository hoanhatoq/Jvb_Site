<?php
session_start();

// ログイン状態のチェック
if (!isset($_SESSION["USERID"])) {
  header("Location: logout.php");
  exit;
}

?>


<!DOCTYPE html>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>企業リスト</title>
<link rel="stylesheet" href="css/comsea.css" type="text/css" media="all">
</head>
</head>
<body>
<div>	
	<a rel="nofollow" href="main.php">管理画面</a><br>
	<a rel="nofollow" href="logout.php" >ログアウト</a>

	<br><br>
	<table>
	  <tr valign="top">
		<td >
					       <?php
						require("RF_basic.php");
						mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
						@mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
						$sql = "SET NAMES utf8";
						mysql_query($sql) or die('DIDIE<br>');
						$l_id = htmlspecialchars($_GET["l_id"]);
						
						$sql = "SELECT vbn.bt_id, btn.description, count(vbn.c_id) num " 
						 	. " FROM v_company_basic_nls vbn, "
							. " v_business_type_nls btn "
							. " WHERe vbn.l_id = " . $l_id 
							. " AND   btn.l_id = " . $l_id 
							. " AND   vbn.bt_id = btn.bt_id "
							. " GROUP BY bt_id, short_desc";
						
						$result1 = mysql_query($sql);

						$num1 = mysql_num_rows($result1);

						mysql_close();

						?>
						<table  border="1" cellspacing="5" cellpadding="5">
						<tr>
						<td width="100">業種名</td>
						</tr>

						<?php
						$i=0;
						while ($i < $num1) {

						$f1=mysql_result($result1,$i,"bt_id");
						$f2=mysql_result($result1,$i,"description");
						$f3=mysql_result($result1,$i,"num");
						?>
						<tr>
						<td><a href="VComList.php?bt_id=<?php echo $f1; ?>&l_id=<?php echo $l_id?>">
								<?php echo $f2 . "(" . $f3 . ")";?>
						    </a>
						</td>
						</tr>
						<?php
						$i++;
						}
						?></table>
		</td>
		<td>
		
					       <?php
						mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
						@mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
						$bt_id = htmlspecialchars($_GET["bt_id"]);
						$sql = "SET NAMES utf8";
						mysql_query($sql);
						If ($bt_id == "ALL" OR $bt_id == "") {
							$query="SELECT cbn.*, btn.short_desc FROM v_company_basic_nls cbn, v_business_type_nls btn "
        	                                               . " WHERE cbn.l_id = ". $l_id 
        	                    						   . " AND btn.l_id = " . $l_id 
        	                    						   . " AND cbn.bt_id= btn.bt_id" 
                	                                       . " ORDER BY cbn.bt_id, cbn.cb_name";

						} else {
							$query="SELECT cbn.*, btn.short_desc FROM v_company_basic_nls cbn, v_business_type_nls btn "
        	                                               . " WHERE cbn.l_id = ". $l_id 
        	                    						   . " AND btn.l_id = ". $l_id
        	                                               . " AND cbn.bt_id= btn.bt_id AND cbn.bt_id = "
							       						   . $bt_id 
                	                                       . " ORDER BY cbn.bt_id, cbn.cb_name";
						
						}
						$result=mysql_query($query);

						$num=mysql_numrows($result);

						mysql_close();

						?>
						<table class="companylist">
						<tr>
						<th width="30">No</td>
						<th width="200">企業名</td>	
						<th width="70">業種</td>
						<th width="350">事業内容</td>
						</tr>

						<?php
						$i=0;
						while ($i < $num) {

						$f1=mysql_result($result,$i,"c_id");
						$f2=mysql_result($result,$i,"cb_name");
						$f3=mysql_result($result,$i,"short_desc");
						$f4=mysql_result($result,$i,"business_description");
						$f5=mysql_result($result,$i,"cbn_id");
						?>
						<tr>
						<td> <a href="VComDetaInfo.php?cbn_id=<?php echo $f5; ?>&l_id=<?php echo $l_id; ?>">	
							<?php echo $i+1;?>
						      </a>	
						</td>
						<td><?php echo $f2; ?></td>
						<td><?php echo $f3;?></td>
						<td><?php echo $f4;?></td>
						</tr>
						<?php
						$i++;
						}
						?>
					</table>
			</td>
		</tr>
    </table>
<!-- / content -->
<!-- footer -->
	<footer>
		<a rel="nofollow" href="main.php" target="_blank">管理画面</a>
	</footer>

<!-- / footer -->
</div>
</body>
</html>