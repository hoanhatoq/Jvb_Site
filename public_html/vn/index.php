<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UFF-8">
<meta name="keywords" content="Việt Nam,Đối tác,partner,"> 
<title>VietPartner　Thông tin Việt Nam </title>
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
			<h1><a href="http://vietpartner.jp/vn/index.php" id="logo"> VietPartner </a></h1>
			<a href="http://vietpartner.jp/vn/index.php" id="vn"><img src="images/vi.png" alt="Vietnamese"/>Vietnamese</a>
			<a href="/index.php" id="vn"><img src="images/ja.png" alt="Japanese"/>Japanese&nbsp;&nbsp;</a>			
		</div>
		<nav>
			<ul id="menu">
				<li class="alpha" id="menu_active"><a href="http://vietpartner.jp/vn/index.php"><span><span>Trang Chủ</span></span></a></li>
				<li><a href="http://vietpartner.jp/vn/VComInfo.php?bt_id=ALL"><span><span>Danh Sách Công Ty</span></span> </a></li>
				<li><a href="http://vietpartner.jp/vn/VBasicInfo.php"><span><span>Tin Tức</span></span></a></li>
				<li><a href="http://vietpartner.jp/vn/About.php"><span><span>Giới Thiệu</span></span></a></li>
				<li class="omega"><a href="http://vietpartner.jp/vn/Contacts.html"><span><span>Liên Hệ</span></span></a></li>
			</ul>
		</nav>
		<div class="wrapper">
			<div class="text">
				<span >VIỆT NAM<span> THÔNG TIN DOANH NGHIỆP</span></span>
	
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
						<a href="http://vietpartner.jp/vn/VComInfo.php"><img src="images/page1_img1.jpg" alt="ベトナム企業リスト"></a>
						<div class="pad">
							<a href="http://vietpartner.jp/vn/VComInfo.php?bt_id=ALL"><p class="font1">Danh sách công ty</p></a>
							<p>Chúng tôi thông tin về các công ty đang hoạt động tại Việt Nam</p>
						</div>
					</li>
					<li>
						<a href="http://vietpartner.jp/vn/rf_list.php"><img src="images/page1_img2.jpg" alt=""></a>
						<div class="pad">
							<a href="http://vietpartner.jp/vn/rf_list.php"><p class="font1">Khu Công Nghiệp</p></a>
							<p>Những KCN các doanh nghiệp nước ngoài đang hoạt động</p>
						</div>
					</li>
					<li>
						<a href="http://vietpartner.jp/vn/v_procity_list.php"><img src="images/page1_img3.jpg" alt=""></a>
						<div class="pad">	
							<a href="http://vietpartner.jp/vn/v_procity_list.php"><p class="font1">Thông Tin Việt Nam</p></a>
							<p> Thông tin cơ bản về Việt Nam</p>
						</div>
					</li>
					<li>
						<a href="http://vietpartner.jp/vn/About.html"><img src="images/page1_img4.jpg" alt=""></a>
						<div class="pad">
							<a href="http://vietpartner.jp/vn/About.php">
								<p class="font1">Dịch Vụ Công Ty</p> </a>
							<p>Các dịch vụ chúng tôi cung cấp</p>
						</div>
					</li>
				</ul>
			</div>
			<div class="wrapper">
				<div class="box bot pad_bot2">
					<div class="pad">
						<h3> Tìm kiếm công ty</h3>
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
							. " WHERe vbn.l_id = 3 "
							. " AND   btn.l_id = 3 "
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
						<td with="100"><a href="http://vietpartner.jp/vn/http://vietpartner.jp/VComInfo.php?bt_id=<?php echo $f1; ?>">
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
		<a rel="nofollow" href="http://vietpartner.jp/vn/index.php" target="_blank">VietPartner</a>
	</footer>
<!-- / footer -->
</div>
</body>
</html>