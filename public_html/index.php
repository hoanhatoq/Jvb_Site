<!DOCTYPE html>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<meta name="keywords" content="�٥ȥʥ�,�ѡ��ȥʡ�,����, �ʽ�, �ӥ��ͥ�"> 
<title>�٥ȥʥ�ѡ��ȥʡ����٥ȥʥ�ӥ��ͥ�����</title>
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
			<h1><a href="index.php" id="logo">�٥ȥʥࡡ�ѡ��ȥʡ�</a></h1>
						<a href="/vn/index.php" id="vn"><img src="images/vi.png" alt="Vietnamese"/>Vietnamese</a>			
			<a href="/index.php" id="vn"><img src="images/ja.png" alt="Japanese"/>Japanese&nbsp;&nbsp;</a>			
		</div>
		<nav>
			<ul id="menu">
				<li class="alpha" id="menu_active"><a href="index.php"><span><span>�ۡ���</span></span></a></li>
				<li><a href="VComInfo.php?bt_id=ALL"><span><span>�٥ȥʥ���</span></span> </a></li>
				<li><a href="VBasicInfo.php"><span><span>�٥ȥʥ����</span></span></a></li>
				<li><a href="About.php"><span><span>��ҳ���</span></span></a></li>
				<li class="omega"><a href="Contacts.html"><span><span>���䤤��碌</span></span></a></li>
			</ul>
		</nav>
		<div class="wrapper">
			<div class="text">
				<span >�٥ȥʥ�<span>�ӥ��ͥ�����</span></span>
	
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
						<a href="VComInfo.php"><img src="images/page1_img1.jpg" alt="�٥ȥʥ��ȥꥹ��"></a>
						<div class="pad">
							<a href="VComInfo.php?bt_id=ALL"><p class="font1">�٥ȥʥ��ȥꥹ��</p></a>
							<p>���ϴ�ȡ��٥ȥʥ��Ȥ���ӳ���ϴ�Ȥξ�����󶡤������ޤ���</p>
						</div>
					</li>
					<li>
						<a href="rf_list.php"><img src="images/page1_img2.jpg" alt=""></a>
						<div class="pad">
							<a href="rf_list.php"><p class="font1">�������ϥꥹ��</p></a>
							<p>���ϴ�Ȥ��褯���Ѥ��Ƥ��빩�����Ϥξ�����󶡤������ޤ���</p>
						</div>
					</li>
					<li>
						<a href="v_procity_list.php"><img src="images/page1_img3.jpg" alt=""></a>
						<div class="pad">	
							<a href="v_procity_list.php"><p class="font1">�٥ȥʥ���ܾ���</p></a>
							<p> �٥ȥʥ�δ��ܾ���򤹤٤��󶡤������ޤ���</p>
						</div>
					</li>
					<li>
						<a href="About.php"><img src="images/page1_img4.jpg" alt=""></a>
						<div class="pad">
							<a href="About.php">
								<p class="font1">���ҤΥ����ӥ�</p> </a>
							<p>�٥ȥѡ��ȥʡ��Υ����ӥ��ˤĤ���</p>
						</div>
					</li>
				</ul>
			</div>
			<div class="wrapper">
				<div class="box bot pad_bot2">
					<div class="pad">
						<h3> �ȼ狼���Ȥ򸡺�����</h3>
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
		<a rel="nofollow" href="http://vietpartner.jp/" target="_blank">�٥ȥѡ��ȡ�</a>
	</footer>
<!-- / footer -->
</div>
</body>
</html>