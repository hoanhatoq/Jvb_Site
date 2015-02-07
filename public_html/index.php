<!DOCTYPE html>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<meta name="keywords" content="ベトナム,パートナー,情報, 進出, ビジネス"> 
<title>ベトナムパートナー　ベトナムビジネス情報</title>
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="css/page1.css" type="text/css" media="all">
</head>
<body id="page1">
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
				<li class="alpha" id="menu_active"><a href="index.php"><span><span>ホーム</span></span></a></li>
				<li><a href="VComInfo.php?bt_id=ALL"><span><span>ベトナム企業</span></span> </a></li>
				<li><a href="VBasicInfo.php"><span><span>ベトナム情報</span></span></a></li>
				<li><a href="About.php"><span><span>会社概要</span></span></a></li>
				<li class="omega"><a href="Contacts.html"><span><span>お問い合わせ</span></span></a></li>
			</ul>
		</nav>
		<div class="wrapper">
			<div class="text">
				<span >ベトナム<span>ビジネス情報</span></span>
	
			</div>
		</div>
	</header>
<!-- / header -->
<!-- content -->
	<section id="content">
		<div class="wrapper">
			<div class="wrapper">
				<ul class="banners">
					<li>
						<a href="VComInfo.php"><img src="images/page1_img1.jpg" alt="ベトナム企業リスト"></a>
						<div class="pad">
							<a href="VComInfo.php?bt_id=ALL"><p class="font1">ベトナム企業リスト</p></a>
							<p>日系企業、ベトナム企業および外資系企業の情報を提供いたします。</p>
						</div>
					</li>
					<li>
						<a href="rf_list.php"><img src="images/page1_img2.jpg" alt=""></a>
						<div class="pad">
							<a href="rf_list.php"><p class="font1">工業団地リスト</p></a>
							<p>日系企業がよく利用している工業団地の情報を提供いたします。</p>
						</div>
					</li>
					<li>
						<a href="v_procity_list.php"><img src="images/page1_img3.jpg" alt=""></a>
						<div class="pad">	
							<a href="v_procity_list.php"><p class="font1">ベトナム基本情報</p></a>
							<p> ベトナムの基本情報をすべて提供いたします。</p>
						</div>
					</li>
					<li>
						<a href="About.php"><img src="images/page1_img4.jpg" alt=""></a>
						<div class="pad">
							<a href="About.php">
								<p class="font1">弊社のサービス</p> </a>
							<p>ベトパートナーのサービスについて</p>
						</div>
					</li>
				</ul>
			</div>
			<div class="wrapper">
				<div class="box bot pad_bot2">
					<div class="pad">
						<h3> 業種から企業を検索する</h3>
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
						<table class="btlist">
						<?php
						$i=0;$j=0;
						If ($j==0) {
							echo "<tr>";
						}
						while ($i < $num1) {
						
						$f1=mysql_result($result1,$i,"bt_id");
						$f2=mysql_result($result1,$i,"description");
						$f3=mysql_result($result1,$i,"num");
						?>
						<td with="100"><a href="http://vietpartner.jp/VComInfo.php?bt_id=<?php echo $f1; ?>">
								<?php echo $f2 . "(" . $f3 . ")";?>
						    </a>
						</td>
						<?php
						$i++;
						$j++;
						if ($j==5) {
							echo "</tr>";
							$j=0;	
							}
						}
						if ($j <> 0) {
							echo "</tr>";
						}
						?>
						</table>

					</div>
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