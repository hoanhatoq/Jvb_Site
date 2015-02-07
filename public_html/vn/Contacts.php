<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UFF-8">
<meta name="keywords" content="Vi&#7879;t Nam, &#272;&#7889;i t&aacute;c, partner, Li&ecirc;n h&#7879;, C&ocirc;ng ty Nh&#7853;t, D&#7883;ch ti&#7871;ng Nh&#7853;t, ti&#7871;ng Nh&#7853;t"> 
<title>VietPartner¡¡Li&ecirc;n h&#7879; </title>
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
</head>
<body id="page4">
<div class="main">
<!-- header -->
	<header>
		<div class="wrapper">
			<h1><a href="http://vietpartner.jp/vn/index.php" id="logo">VietPartner</a></h1>
						<a href="http://vietpartner.jp/vn/index.php" id="vn"><img src="images/vi.png" alt="Vietnamese"/>Vietnamese</a>			
			<a href="http://vietpartner.jp/index.php" id="vn"><img src="images/ja.png" alt="Japanese"/>Japanese&nbsp;&nbsp;</a>			
		</div>
		<nav>
			<ul id="menu">
				<li class="alpha"><a href="http://vietpartner.jp/vn/index.php"><span><span>Trang Ch&#7911;</span></span></a></li>
				<li><a href="http://vietpartner.jp/vn/VComInfo.php?bt_id=ALL"><span><span>Danh S&aacute;ch C&ocirc;ng Ty</span></span> </a></li>
				<li><a href="http://vietpartner.jp/vn/VBasicInfo.php"><span><span>Tin T&#7913;c</span></span></a></li>
				<li><a href="http://vietpartner.jp/vn/About.php"><span><span>Gi&#7899;i Thi&#7879;u</span></span></a></li>
				<li class="omega" id="menu_active"><a href="http://vietpartner.jp/vn/Contacts.html"><span><span>Li&ecirc;n H&#7879;</span></span></a></li>
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
					<article class="col1"><h2>X&aacute;c nh&#7853;n th&ocirc;ng tin g&#7917;i &#273;i</h2></article>

				</div>
			</div>
			<div class="box pad_bot1">
				<div class="pad marg_top">
					<article class="col1">
						<form id="ContactForm" action="SendMail.php" method="POST">
							<div>
								<div class="wrapper">
									H&#7885; v&agrave; t&ecirc;n:<?php echo $_POST['name']; ?>
									<br>
									Email:<?php echo $_POST['email']; ?>
									<br>
									N&#7897;i dung:<?php echo $_POST['content']; ?>
								</div>
								<input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
								<input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
								<input type="hidden" name="content" value="<?php echo $_POST['content']; ?>">
                                                                <input class="button" type="submit" value="G&#7911;i">
								<input class="button" type="button" value="Quay l&#7841;i" onclick="history.back();">
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
		<a rel="nofollow" href="http://vietpartner.jp/" target="_blank">VietPartner</a>
 	</footer>
<!-- / footer -->
</div>
</body>
</html>