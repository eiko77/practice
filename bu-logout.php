<?php 
session_start(); 
//セッション解除
unset($_SESSION['user']);
?>
<!DOCTYPE html>
<html>
<head>
<title>ログアウト</title>
</head>
<body>
<h3>
ログアウトしました。
</h3>
<p><a href='bu-login-input.php'>ログインページに戻る</a></p>
</body>
</html>



