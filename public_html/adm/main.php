<?php
session_start();

// ログイン状態のチェック
if (!isset($_SESSION["USERID"])) {
  header("Location: logout.php");
  exit;
}

?>

<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>管理者画面</title>
    <link rel="stylesheet" href="css/main.css" type="text/css" media="all">

  </head>
  <body>
    
    
    
  <?php echo "ようこそ" . $_SESSION["USERID"] . "さん";?>
  <br>管理画面からリンクをクリックしてください。 </br><br>
  <table class="about">
  	  <tr>
  	  	<td bgcolor="#cccccc">機能名</td>
  	    <td>日本語</td>
  	    <td>ベトナム語</td>
  	  </tr>
  	  <tr>
  	  	<td bgcolor="#cccccc">企業一覧</td>
  	    <td><a href= VComList.php?l_id=2>企業一覧</a></td>
  	    <td><a href= VComList.php?l_id=1>Danh Sách Công Ty</a></td>
   	  </tr>
  </table>	  
  <footer>
  <br>
  <div align='left'><a href="logout.php">ログアウト</a></div>
  </footer>
  </body>
</html>