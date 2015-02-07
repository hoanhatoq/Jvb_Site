<?php
	session_start();
    // Connecting Database
	require('config.php');
	require('AdmClass.php');
	
	mysql_connect(VPN_DB_HOST,VPN_DB_USER,VPN_DB_PASS);
	@mysql_select_db(VPN_DB_NAME) or die( "Unable to select database");
	// 画面に表示するため特殊文字をエスケープする
	if ( isset($_POST["userid"]) ) {
	$viewUserId = htmlspecialchars($_POST["userid"], ENT_QUOTES);
	} else {
	$viewUserId = '';
	}
	//echo $viewUserId . '\n';
	$adm_Obj = new AdmClass();
	$adm_passwd = $adm_Obj->get_passwd($viewUserId);
	//echo $adm_passwd;
   
	// Closing connection
	mysql_close();




	// エラーメッセージ
	$errorMessage = "";
	// ログインボタンが押された場合      
	if (isset($_POST["login"])) {

	// 認証成功
	if ($_POST["password"] == $adm_passwd) {
	  // セッションIDを新規に発行する
	  session_regenerate_id(TRUE);
	  $_SESSION["USERID"] = $_POST["userid"];
	  header("Location: main.php");
	  exit;
	  
	}
	else {
	  $errorMessage = "ユーザIDあるいはパスワードに誤りがあります。<br><br>";
	}
	}

?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>VPN 管理者ログイン画面</title>
    <link rel="stylesheet" href="css/login.css" type="text/css" media="all">
  </head>
  <body>
    
  <h3>管理者ログイン機能</h3><br><br>  
  <form id="loginForm" name="loginForm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
  <div><?php echo $errorMessage ?></div>
  <table class="tbl1">  
	  <tr>
	  	<td>ユーザID</td>
	    <td><input type="text" id="userid" name="userid" size=30 value="<?php echo $viewUserId ?>"></td>
	  </tr>
	  <tr>
		<td>パスワード</td>
		<td><input type="password" id="password" size=30 name="password" value=""></td>
	  </tr>
	  <tr>
	  	<td><input type="submit" id="login" name="login" value="ログイン"></td>
	  </tr>
  </table>
  </form>

	<footer>
		<a rel="nofollow" href="http://vietpartner.jp/adm/main.php" target="_blank">管理画面</a>
	</footer>

  </body>
 
</html>