<html lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UFF-8">
<meta name="keywords" content="Việt Nam, Đối tác, partner, Liên hệ, Công ty Nhật, Dịch tiếng Nhật, tiếng Nhật"> 
<title>JVB　Liên hệ </title>
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
</head>
<body id="page4">
<div class="main">
<!-- header -->
	<header>
		<div class="wrapper">
			<h1><a href="http://jvb-corp.com/index.php" id="logo">JVB</a></h1>	
			<a href="http://jvb-corp.com/Contact.php?lang=vi" id="vn"><img src="images/vi.png" alt="Vietnamese"/>Vietnamese</a>			
			<a href="http://jvb-corp.com/Contact.php?lang=jp" id="vn"><img src="images/ja.png" alt="Japanese"/>Japanese&nbsp;&nbsp;</a>			
		</div>
		<nav>
			<ul id="menu">
				<li class="alpha" ><a href="http://jvb-corp.com/index.php"><span><span>Trang Chủ</span></span></a></li>
				<li><a href="http://jvb-corp.com/Services.php"><span><span>Dịch Vụ</span></span> </a></li>
				<li><a href="http://jvb-corp.com/Customers.php"><span><span>Khách Hàng</span></span></a></li>
				<li><a href="http://jvb-corp.com/About.php"><span><span>Giới Thiệu</span></span></a></li>
				<li class="omega" id="menu_active"><a href="http://jvb-corp.com/Contact.php"><span><span>Liên Hệ</span></span></a></li>
			</ul>
		</nav>
		<div class="wrapper">
			<div class="text">
<!--				<span class="text1">Effective<span>business solutions</span></span>
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
				</div>
			</div>
			<div class="box pad_bot1">
				<div class="pad marg_top">
					<article class="col1">
						<?php
							mb_language("uni");
							mb_internal_encoding("UTF-8");


							//ｰｸﾀ・
							$to = "info@jvb-corp.com;nguyen.toan@jvb-corp.com";
							//ｺｹｽﾐｿﾍ
							$header = "From: ".$_POST['email'];
							//ｷ・ｾ
							$subject = " Thông tin liên lạc từ ".$_POST['name'];
							//ﾋﾜﾊｸ
							$body = "Ông/Bà ". $_POST['name']." từ địa chỉ". $_POST['email'] . " có gửi thông tin liên lạc sau : ";
							$body = $body . "\n" . $_POST['content'];

							if(mb_send_mail($to,$subject,$body,$header)){
							   echo "Mail của ông/bà đã được gửi đi. Chúng tôi sẽ hồi âm trong thời gian sớm nhất. ";
							}else{
							   echo "Mail của ông/bà không gửi được. Xin ông bà liên lạc trực tiếp tới info@jvb-corp.com";
							}
						?>

	
					</article>
				</div>
			</div>
		</div>
	</section>
<!-- / content -->
<!-- footer -->
	<footer>
		<a rel="nofollow" href="http://jvb-corp.com/index.php" target="_blank">JVB</a>
 	</footer>
<!-- / footer -->
</div>

</body></html>