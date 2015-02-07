<!DOCTYPE html>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title>ベトナム　パートナー 工場団地詳細</title>
<meta name="keywords" content="ベトナム, 進出,工場団地,詳細情報"> 
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
</head>
</head>
<body id="page2">
<div class="main">
<!-- header -->
	<header>
		<div class="wrapper">
			<h1><a href="index.php" id="logo">ベトナム　パートナー</a></h1>
						<a href="/vn/index.php" id="vn"><img src="images/vi.png" alt="Vietnamese"/>Vietnamese</a>			
			<a href="/index.php" id="vn"><img src="images/ja.png" alt="Japanese"/>Japanese&nbsp;&nbsp;</a>			
		</div>
		<nav>
			<ul id="menu">
				<li class="alpha"><a href="index.php"><span><span>ホーム</span></span></a></li>
				<li><a href="VComInfo.php?bt_id=ALL"><span><span>ベトナム企業</span></span> </a></li>
				<li id="menu_active"><a href="VBasicInfo.php"><span><span>ベトナム情報</span></span></a></li>
				<li><a href="About.php"><span><span>会社概要</span></span></a></li>
				<li class="omega"><a href="Contacts.html"><span><span>お問い合わせ</span></span></a></li>
			</ul>
		</nav>
		<div class="wrapper">
			<div class="text">
				<span class="text1">Effective<span>business solutions</span></span>
		</div>
	</header>
<!-- / header -->
<!-- content -->
	<section id="content">
		<div class="wrapper">
			<div class="pad">
				<div class="wrapper">
					<article class="col1"><h2>Project name</h2></article>
					<article class="col2 pad_left1"><h2>Latest projects</h2></article>
				</div>
			</div>
			<div class="box pad_bot1">
				<div class="pad marg_top">
					<article class="col1">
<?php

require("config.php");
require("RF_basic.php");
mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
@mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
$sql = "SET NAMES ujis";
mysql_query($sql);
$rf_id = htmlspecialchars($_GET["rf_id"]);
$query= "SELECT * FROM v_rental_factory_contacts WHERE rf_id = " 
        . $rf_id . " AND rfc_id = 2 AND l_id = 2";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
?>
<table border="1" cellspacing="2" cellpadding="2">
<?php
If ($num == 1) {
 $addr_1=mysql_result($result,0,"addr_1");
 $addr_2=mysql_result($result,0,"addr_2");
 $pos_info_1=mysql_result($result,0,"pos_info_1");
 $pos_info_2=mysql_result($result,0,"pos_info_2");
 $pos_info_3=mysql_result($result,0,"pos_info_3");
 $pos_info_4=mysql_result($result,0,"pos_info_4");
 $owner=mysql_result($result,0,"owner");
 $ccp=mysql_result($result,0,"ccp");
 $tel=mysql_result($result,0,"tel");
 $fax=mysql_result($result,0,"fax");
 $email=mysql_result($result,0,"email");
 $language=mysql_result($result,0,"language");
 $homepage=mysql_result($result,0,"homepage");
 } else {
 $addr_1="N/A";
 $addr_2="N/A";
 $pos_info_1="N/A";
 $pos_info_2="N/A";
 $pos_info_3="N/A";
 $pos_info_4="N/A";
 $owner="N/A";
 $ccp="N/A";
 $tel="N/A";
 $fax="N/A";
 $email="N/A";
 $language="N/A";
 $homepage="N/A";
 }
?>
 <tr><td> 住所</td> <td> <?php echo $addr_1 . $addr_2; ?></td></tr>  
 <tr><td> 位置</td> <td> <?php echo $pos_info_1; ?></td></tr>  
 <tr><td> 位置</td> <td> <?php echo $pos_info_2; ?></td></tr>  
 <tr><td> 位置</td> <td> <?php echo $pos_info_3; ?></td></tr>  
 <tr><td> 位置</td> <td> <?php echo $pos_info_4; ?></td></tr>  
 <tr><td> 事業主</td> <td> <?php echo $owner; ?></td></tr>  
 <tr><td> 担当者</td> <td> <?php echo $ccp; ?></td></tr>  
 <tr><td> 電話</td> <td> <?php echo $tel; ?></td></tr>  
 <tr><td> FAX</td> <td> <?php echo $fax; ?></td></tr>  
 <tr><td> メール</td> <td> <?php echo $email; ?></td></tr>  
 <tr><td> 対応言語</td> <td> <?php echo $language; ?></td></tr>  
 <tr><td> ホームページ</td> <td> <?php echo $homepage; ?></td></tr>  
</table>
			</div>
		</div>
	</section>
<!-- / content -->
<!-- footer -->
	<footer>
		<a rel="nofollow" href="http://vietpartner.jp/" target="_blank">ベトパートー</a>
	</footer>

<!-- / footer -->
</div>
</body>
</html>