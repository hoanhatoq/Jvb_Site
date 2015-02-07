<!DOCTYPE html>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>企業詳細</title>
<link rel="stylesheet" href="css/main.css" type="text/css" media="all">
</head>
</head>
<body >
<div class="main">
	<a href="main.php">管理画面</a><br>
	<a href=VComList.php?l_id=2>企業一覧</a><br>
	<a href=VComList.php?l_id=1>Danh Sách Công Ty</a><br>
	<a href="logout.php" >ログアウト</a>

	<br><br>

<!-- header -->
<!-- / header -->
<!-- content -->
<?php

require("config.php");
require("RF_basic.php");
mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
@mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
$sql = "SET NAMES utf8";
mysql_query($sql);
/* Get parameter */
$bt_id = htmlspecialchars($_GET["bt_id"]);
$cbn_id = htmlspecialchars($_GET["cbn_id"]);
$cbn_id = htmlspecialchars($_GET["l_id"]);
$query=  "SELECT cb.cb_name, cb.business_description, cb.established, cb.addr_1, cb.addr_2, cb.owner, "
       . " cb.ccp, cb.tel, cb.fax, cb.email, cb.language, cb.homepage, btn.short_desc, c.country_code "
       . " FROM  v_company_basic_nls cb, v_business_type_nls btn, v_companies c "
       . " WHERE btn.bt_id = cb.bt_id "
       . " AND   btn.l_id = 2 "
       . " AND   c.c_id = cb.c_id "
       . " AND   cb.l_id = 2"
       . " AND   cb.cbn_id = " . $cbn_id;
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
?>
<?php
If ($num == 1) {
 $cb_name=mysql_result($result,0,"cb_name");
 $business_description=mysql_result($result,0,"business_description"); 
 $established=mysql_result($result,0,"established");
 $addr_1=mysql_result($result,0,"addr_1");
 $addr_2=mysql_result($result,0,"addr_2");
 $owner=mysql_result($result,0,"owner");
 $ccp=mysql_result($result,0,"ccp");
 $tel=mysql_result($result,0,"tel");
 $fax=mysql_result($result,0,"fax");
 $email=mysql_result($result,0,"email");
 $language=mysql_result($result,0,"language");
 $homepage=mysql_result($result,0,"homepage");
 $country_code=mysql_result($result,0,"country_code");
 $short_desc=mysql_result($result,0,"short_desc");
 } else {
 $cb_name="N/A";
 $business_description="N/A";
 $established="N/A";
 $addr_1="N/A";
 $addr_2="N/A";
 $owner="N/A";
 $ccp="N/A";
 $tel="N/A";
 $fax="N/A";
 $email="N/A";
 $language="N/A";
 $homepage="N/A";
 $country_code="N/A";
 $short_desc="N/A";
 }
?>
<form id="ContactForm" action="CContact.php" method="POST">
<table class="about">
 <tr><td bgcolor="#cccccc"> 企業名</td> <td><?php echo $cb_name;?> </td></tr>  
 <tr><td bgcolor="#cccccc"> 事業内容</td> <td><?php echo $business_description;?> </td></tr>  
 <tr><td bgcolor="#cccccc"> 設立</td> <td><?php echo $established;?> </td></tr>  
 <tr><td bgcolor="#cccccc"> 住所1</td> <td> <?php echo $addr_1 ; ?></td></tr>  
 <tr><td bgcolor="#cccccc"> 住所2</td> <td> <?php echo $addr_2; ?></td></tr>  
 <tr><td bgcolor="#cccccc"> 株主</td> <td> <?php echo $owner; ?></td></tr>  
 <tr><td bgcolor="#cccccc"> 担当者</td> <td> <?php echo $ccp; ?></td></tr>  
 <tr><td bgcolor="#cccccc"> 電話</td> <td> <?php echo $tel; ?></td></tr>      
 <tr><td bgcolor="#cccccc"> FAX</td> <td> <?php echo $fax; ?></td></tr>       
 <tr><td bgcolor="#cccccc"> メール</td> <td> <?php echo $email; ?></td></tr>     
 <tr><td bgcolor="#cccccc"> 対応言語</td> <td> <?php echo $language; ?></td></tr>  
 <tr><td bgcolor="#cccccc"> URL</td> <td> <?php echo $homepage; ?></td></tr>  
 <tr><td bgcolor="#cccccc"> 国コード</td> <td> <?php echo $country_code; ?></td></tr>  
 <tr><td bgcolor="#cccccc"> 事業内容</td> <td> <?php echo $short_desc; ?></td></tr>  



 <!-- 
 			<input type="hidden"  name="cname" value="<?php echo $cb_name; ?>">
			<input type="submit" value="お問い合わせ">

 -->
 <tr><td> <input type="submit" value="更新"></td><td><input type="submit" value="非表示"></td> </tr>  
　
</table>
</form>
			</div>
		</div>
	</section>
<!-- / content -->
<!-- footer -->
	<footer>
		<a rel="nofollow" href="main.php">管理画面</a>
	</footer>

<!-- / footer -->
</div>
</body>
</html>