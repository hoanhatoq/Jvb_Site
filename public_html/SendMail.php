<!DOCTYPE html>
<html lang="jp">
<head>
<title>�٥ȥѡ��ȥʡ� ���䤤��碌</title>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
</head>
<body id="page4">
<div class="main">
<!-- header -->
	<header>
		<div class="wrapper">
			<h1><a href="index.php" id="logo">�٥ȥѡ��ȥʡ�</a></h1>
						<a href="/vn/index.php" id="vn"><img src="images/vi.png" alt="Vietnamese"/>Vietnamese</a>			
			<a href="/index.php" id="vn"><img src="images/ja.png" alt="Japanese"/>Japanese&nbsp;&nbsp;</a>			
		</div>
		<nav>
			<ul id="menu">
				<li class="alpha"><a href="index.php"><span><span>�ۡ���</span></span></a></li>
				<li><a href="VComInfo.php?bt_id=ALL"><span><span>�٥ȥʥ���</span></span> </a></li>
				<li><a href="VBasicInfo.php"><span><span>�٥ȥʥ����</span></span></a></li>
				<li><a href="About.php"><span><span>��ҳ���</span></span></a></li>
				<li class="omega" id="menu_active"><a href="Contacts.html"><span><span>���䤤��碌</span></span></a></li>
			</ul>
		</nav>
		<div class="wrapper">
			<div class="text">
<!--
				<span class="text1">Effective<span>business solutions</span></span>
				<a href="#" class="button">read more</a>
-->

			</div>
		</div>
	</header>
<!-- / header -->
<!-- content -->
	<section id="content">
		<div class="wrapper">
			<div class="pad">
				<div class="wrapper">
					<article class="col1"><h2>�᡼���������</h2></article>
				</div>
			</div>
			<div class="box pad_bot1">
				<div class="pad marg_top">
					<article class="col1">
					<?php
						mb_language("Japanese");
						mb_internal_encoding("EUC-JP");


						//����
						$to = "info@vietpartner.jp,nguyen.toan@vietpartner.jp,hamtoan2002@yahoo.co.jp";
						//���п�
						$header = "From: admin@vietpartner.jp";
						//��̾
						$subject = $_POST['name']."�ͤ���Τ��䤤��碌";
						//��ʸ
						$body = $_POST['name']."�͡�". $_POST['email'] . "�ˤ��鲼���Τ��䤤��碌������ޤ�����";
						$body = $body . "\n" . $_POST['content'];

						if(mb_send_mail($to,$subject,$body,$header)){
						   echo "�᡼���������������ޤ��������䤤��碌���꤬�Ȥ��������ޤ�����";
						}else{
						   echo "�᡼�����������Ԥ��ޤ�����info@vietpartner.jp��Ϣ��򤪴ꤤ�������ޤ���";
						}
					?>

					</article>
					<article class="col2 pad_left1">
						<div class="wrapper">
						</div>
					</article>
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