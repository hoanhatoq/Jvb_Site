<!DOCTYPE html>
<html lang="jp">
<head>
<title>�٥ȥʥ�ѡ��ȥʡ� ���䤤��碌</title>
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
-->				<a href="#" class="button">read more</a>

			</div>
		</div>
	</header>
<!-- / header -->
<!-- content -->
	<section id="content">
		<div class="wrapper">
			<div class="pad">
				<div class="wrapper">
					<article class="col1"><h2>���䤤��碌��ǧ</h2></article>

				</div>
			</div>
			<div class="box pad_bot1">
				<div class="pad marg_top">
					<article class="col1">
						<form id="ContactForm" action="SendMail.php" method="POST">
							<div>
								<div class="wrapper">
									��̾��:<?php echo $_POST['name']; ?>
									<br>
									�᡼��:<?php echo $_POST['email']; ?>
									<br>
									����:<?php echo $_POST['content']; ?>
								</div>
								<input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
								<input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
								<input type="hidden" name="content" value="<?php echo $_POST['content']; ?>">
                                                                <input class="button" type="submit" value="����">
								<input class="button" type="button" value="���" onclick="history.back();">
							</div>
						</form>
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