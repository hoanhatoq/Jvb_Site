<!DOCTYPE html>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title>�٥ȥʥ� �ѡ��ȥʡ� ��Ⱦܺ�</title>
<meta name="keywords" content="�٥ȥʥ�, �ѡ��ȥʡ�,�ʽ�,���,�ܺپ���"> 
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="css/page2.css" type="text/css" media="all">
</head>
</head>
<body id="page2">
<div class="main">
<!-- header -->
	<header>
		<div class="wrapper">
			<h1><a href="index.php" id="logo">�٥ȥʥࡡ�ѡ��ȥʡ�</a></h1>
						<a href="/vn/index.php" id="vn"><img src="images/vi.png" alt="Vietnamese"/>Vietnamese</a>			
			<a href="/index.php" id="vn"><img src="images/ja.png" alt="Japanese"/>Japanese&nbsp;&nbsp;</a>			
		</div>
		<nav>
			<ul id="menu">
				<li class="alpha"><a href="index.php"><span><span>�ۡ���</span></span></a></li>
				<li><a href="VComInfo.php?bt_id=ALL"><span><span>�٥ȥʥ���</span></span> </a></li>
				<li id="menu_active"><a href="VBasicInfo.php"><span><span>�٥ȥʥ����</span></span></a></li>
				<li><a href="About.php"><span><span>��ҳ���</span></span></a></li>
				<li class="omega"><a href="Contacts.html"><span><span>���䤤��碌</span></span></a></li>
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
					<article class="col1"><h2>��Ȥξܺپ���</h2></article>
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
/* Get parameter */
$bt_id = htmlspecialchars($_GET["bt_id"]);
$cbn_id = htmlspecialchars($_GET["cbn_id"]);

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
<table class="companylist">
 <tr><td> ���̾</td> <td><?php echo $cb_name; 
			   If ($country_code = "JP") { echo "  (���ϴ��)";}
                           else { echo "(�٥ȥʥ���)";}
		           ?> </td></tr>  
 <tr><td> �ȼ�</td> <td> <?php echo $short_desc; ?></td></tr>  
 <tr><td> ��������</td> <td> <?php echo $business_description; ?></td></tr>  
 <tr><td> ����</td> <td> <?php echo $addr_1 . $addr_2; ?></td></tr>  
 <tr><td> Ϣ����</td> <td> 
		<form id="ContactForm" action="CContact.php" method="POST">
			<input type="hidden"  name="cname" value="<?php echo $cb_name; ?>">
			<input type="submit" value="���䤤��碌">
		</form>�����䤤��碌���ޤ����顢��Ȥ�Ϣ����ξ����᡼��ˤ�Ϣ�������ޤ���<br>
		       ����Ȥ�Ϣ����ξ��󤬤ʤ����⤴�����ޤ��ΤǤ�λ������������

		
</td></tr>  

</table>
			</div>
		</div>
	</section>
<!-- / content -->
<!-- footer -->
	<footer>
		<a rel="nofollow" href="http://vietpartner.jp/" target="_blank">�٥ȥѡ��ȡ�</a>
	</footer>

<!-- / footer -->
</div>
</body>
</html>