<!DOCTYPE html>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title>�٥ȥѡ��ȥʡ�</title>
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
			<h1><a href="index.html" id="logo">�٥ȥѡ��ȥʡ�</a></h1>
						<a href="/vn/index.php" id="vn"><img src="images/vi.png" alt="Vietnamese"/>Vietnamese</a>			
			<a href="/index.php" id="vn"><img src="images/ja.png" alt="Japanese"/>Japanese&nbsp;&nbsp;</a>			
		</div>
		<nav>
			<ul id="menu">
				<li class="alpha"><a href="index.html"><span><span>�ۡ���</span></span></a></li>
				<li id="menu_active"><a href="Vinfo.php"><span><span>�٥ȥʥ���</span></span> </a></li>
				<li><a href="Businesses.html"><span><span>�٥ȥʥ����</span></span></a></li>
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
						$sql = "SET NAMES UTF-8";
						mysql_query($sql);
						$query="SELECT * FROM v_rental_factories";
						$result=mysql_query($query);

						$num=mysql_numrows($result);

						mysql_close();

						?>
						<table border="2" cellspacing="5" cellpadding="5">
						<tr>
						<td width="30">No</td>
						<td width="250">��������̾</td>
						<td width="100">������</td>
						<td width="100">�����ȿ�</td>
						<td width="80">�������</td>
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
						<td><?php If ($f4 = 1) { echo "��";
						          } else { echo "�Բ�";}
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
		<a rel="nofollow" href="http://vietpartner.jp/" target="_blank">�٥ȥѡ��ȡ�</a>
	</footer>

<!-- / footer -->
</div>
</body>
</html>