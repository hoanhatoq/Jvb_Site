<!DOCTYPE html>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<meta name="keywords" content="ベトナム,パートナー,探し,ベトナム企業, ビジネス"> 
<title>ベトナムパートナー 企業リスト</title>
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
			<h1><a href="index.php" id="logo">ベトナム　パートナー</a></h1>
			<a href="/vn/index.php" id="vn"><img src="images/vi.png" alt="Vietnamese"/>Vietnamese</a>			
			<a href="/index.php" id="vn"><img src="images/ja.png" alt="Japanese"/>Japanese&nbsp;&nbsp;</a>			
		</div>
		<nav>
			<ul id="menu">
				<li class="alpha"><a href="index.php"><span><span>ホーム</span></span></a></li>
				<li id="menu_active"><a href="VComInfo.php?bt_id=ALL"><span><span>ベトナム企業</span></span> </a></li>
				<li><a href="VBasicInfo.php"><span><span>ベトナム情報</span></span></a></li>
				<li><a href="About.php"><span><span>会社概要</span></span></a></li>
				<li class="omega"><a href="Contacts.html"><span><span>お問い合わせ</span></span></a></li>
			</ul>
		</nav>
		<div class="wrapper">
			<div class="text">
				<span>Effective<span>business solutions</span></span>
		</div>
	</header>
<!-- / header -->
<!-- content -->
	<section id="content">
		<div class="wrapper">
			<div class="pad">
				<div class="wrapper_comp"><br><br>
					ベトナム企業、日系企業、外資企業を提供いたします。<br><br><br>
				</div>
			</div>
			<div class="box pad_bot1">
				<div class="pad marg_top">
					<article class="col5">
						<div class="wrapper">
					       <?php
						require("config.php");
						require("RF_basic.php");
						mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
						@mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
						mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
						@mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
						$sql = "SET NAMES ujis";
						mysql_query($sql);
						$query1="SELECT vbn.bt_id, btn.description, count(vbn.c_id) num " 
						 	. " FROM v_company_basic_nls vbn, "
							. " v_business_type_nls btn "
							. " WHERe vbn.l_id = 2 "
							. " AND   btn.l_id = 2 "
							. " AND   vbn.bt_id = btn.bt_id "
							. " GROUP BY bt_id, short_desc";
						$result1=mysql_query($query1);

						$num1=mysql_numrows($result1);

						mysql_close();

						?>
						<table  border="1" cellspacing="5" cellpadding="5">
<!--						<tr>
						<td width="100">業種名</td>
						</tr>
-->
						<?php
						$i=0;
						while ($i < $num1) {

						$f1=mysql_result($result1,$i,"bt_id");
						$f2=mysql_result($result1,$i,"description");
						$f3=mysql_result($result1,$i,"num");
						?>
						<tr>
						<td><a href="http://vietpartner.jp/VComInfo.php?bt_id=<?php echo $f1; ?>">
								<?php echo $f2 . "(" . $f3 . ")";?>
						    </a>
						</td>
						</tr>
						<?php
						$i++;
						}
						?></table>
						</div>

					</article>
					<article class="col4 pad_left11">
						<div class="wrapper">
					       <?php
						mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
						@mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
						$bt_id = htmlspecialchars($_GET["bt_id"]);
						$sql = "SET NAMES ujis";
						mysql_query($sql);
						If ($bt_id == "ALL" OR $bt_id == "") {
							$query="SELECT cbn.*, btn.short_desc FROM v_company_basic_nls cbn, v_business_type_nls btn "
        	                                               . " WHERE cbn.l_id = 2 AND btn.l_id = 2 AND cbn.bt_id= btn.bt_id" 
                	                                       . " ORDER BY cbn.bt_id, cbn.cb_name";

						} else {
							$query="SELECT cbn.*, btn.short_desc FROM v_company_basic_nls cbn, v_business_type_nls btn "
        	                                               . " WHERE cbn.l_id = 2 AND btn.l_id = 2 AND cbn.bt_id= btn.bt_id AND cbn.bt_id = "
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
						<td> <a href="http://vietpartner.jp/VComDetaInfo.php?cbn_id=<?php echo $f5; ?>">	
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
						?></table>
						</div>
					</article>
				</div>
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