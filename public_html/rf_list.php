<!DOCTYPE html>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title>ベトパートナー ベトナム工場団地リスト</title>
<meta name="keywords" content="ベトナム,進出,工場団地"> 
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="css/kihon.css" type="text/css" media="all">
</head>
</head>
<body id="page2">
<div class="main">
<!-- header -->
	<header>
		<div class="wrapper">
			<h1><a href="index.php" id="logo">ベトパートナー</a></h1>
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
			</div>
		</div>
	</header>
<!-- / header -->
<!-- content -->
	<section id="content">
		<div class="wrapper">
			<div class="pad">
				<?php include("basic_tem.php");  ?>
				<div class="wrapper">
				</div>
			</div>
			<div class="pad">
				<div class="wrapper">
					<article class="col1"></article>
					
					<article class="col2 pad_left1"><h2></h2></article>
				</div>
			</div>

			<div class="box pad_bot1">
				<div class="wrapper">
					<article style="text-align:left;font-size:20px"><br><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;工業団地リスト</b></article>
				</div>

				<div class="pad marg_top">
					<article class="col1">
					       <?php
						require("config.php");
						require("RF_basic.php");
						mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
						@mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
						$sql = "SET NAMES UTF-8";
						mysql_query($sql);
						$query="SELECT * FROM v_rental_factories";
						$result=mysql_query($query);

						$num=mysql_numrows($result);

						mysql_close();

						?>
						<table border="2" cellspacing="5" cellpadding="5" class="province">
						<tr>
						<td width="30" align="center">No</td>
						<td width="330" align="center">工業団地名</td>
						<td width="100" align="center">住所地</td>
						<td width="150" align="center">入居企業数</td>
						<td width="120" align="center">入居可否</td>
						</tr>

						<?php
						$i=0;
						while ($i < $num) {

						$f1=mysql_result($result,$i,"rf_id");
						$f2=mysql_result($result,$i,"rf_code");
						$f3=mysql_result($result,$i,"company_rent_number");
						$f4=mysql_result($result,$i,"avail_status");
						$pc_id=mysql_result($result,$i,"pc_id");
						$rf_obj = new RF_basic($f1, "2");
						?>
						<tr>
						<td><?php echo $f1;?></td>
						<td><a href="http://vietpartner.jp/rf_detail.php?rf_id=<?php echo $f1; ?>"><?php echo $rf_obj->get_RF_name(); ?></a></td>
						<td><a href="http://vietpartner.jp/rf_loc.php?pc_id=<?php echo $pc_id; ?>"><?php echo $rf_obj->get_RF_city(); ?></a></td>
						<td><?php echo $f3; ?></td>
						<td><?php If ($f4 = 1) { echo "可";
						          } else { echo "不可";}
						           ?></td>
						</tr>
						<?php
						$i++;
						}
						?></table>

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