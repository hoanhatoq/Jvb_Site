<!DOCTYPE html>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title>�٥ȥѡ��ȥʡ� ����</title>
<meta name="keywords" content="�٥ȥʥ�,����,������ʬ,�ӥ��ͥ�"> 
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="css/page1.css" type="text/css" media="all">
<link rel="stylesheet" href="css/kihon.css" type="text/css" media="all">
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
			<!--	<span class="text1">Effective<span>business solutions</span></span> -->
			</div>
		</div>
	</header>
<!-- / header -->
<!-- content -->
	<section id="content">
		<div class="wrapper">
			<div class="pad">
				<?php include("basic_tem.php");  ?>				
			</div>

			<div class="pad">
				<div class="wrapper">
					<article class="col1"></article>
					
					<article class="col2 pad_left1"><h2></h2></article>
				</div>
			</div>
			<div class="box pad_bot1">
				<div class="wrapper">
					<article style="text-align:left;font-size:20px"><br><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������ϥꥹ��</b></article>
				</div>
				<div class="pad marg_top">
					<article class="col1">
					       <?php
						require("config.php");
						require("RF_basic.php");
						mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
						@mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
						$sql = "SET NAMES ujis";
						mysql_query($sql);
						$query="SELECT pc_id, 
                                                               pc_code, 
                                                               short_desc, 
                                                               description, 
                                                               a_code 
                                                        FROM v_prov_cities 
                                                        WHERE l_id = 2 
                                                        ORDER BY pc_id, a_id";
						$result=mysql_query($query);

						$num=mysql_numrows($result);

						mysql_close();

						?>
						<table class="province">
						<tr>
						<th width="30" align="center">No</th>
						<th width="140" align="center">��̾</th>
						<th width="200" align="center">��̾(�ե��</th>
						<th width="100" align="center">�϶�</th>
						</tr>

						<?php
						$i=0;
						while ($i < $num) {

						$f1=mysql_result($result,$i,"pc_id");
						$f2=mysql_result($result,$i,"short_desc");
						$f3=mysql_result($result,$i,"description");
						$f4=mysql_result($result,$i,"a_code");
						$pc_id=mysql_result($result,$i,"pc_id");
						?>
						<tr>
						<td><?php echo $f1;?></td>
						<td><?php echo $f2;?></td>
						<td><?php echo $f3;?></td>
						<td><?php echo $f4; ?></td>
						</tr>
						<?php
						$i++;
						}
						?></table>
					</article>
					<article class="col2">
                                          �٥ȥʥ��Ͽޡ��϶�<br>
                                          <img src="../images/vmap.png"><br><br>
                                          <p>�٥ȥʥ��Ͽޡ���ƻ�ܸ�<br> 
					  <img src="../images/vmap1.jpg"></p>
                                        </article>

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