<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bulltienboard;charset=utf8',
'root', 'mariadb'); //DB 接続
if (isset($_SESSION['user'])) { //ログイン中の状態
 $login=$_SESSION['user']['login']; //ログイン名の重複がなければ実行
 $sql=$pdo->prepare('select * from user where login!=? and login=?');
 $sql->execute([$login, $_REQUEST['login']]);
} else { //ログイン未の状態
 $sql=$pdo->prepare('select * from user where login=?');
 $sql->execute([$_REQUEST['login']]);}

if (empty($sql->fetchAll())) { // fetchAll() データが空なら空の配列返し
///データがない＝（登録未）新規処理
 $sql=$pdo->prepare('insert into user values(?,?,?)');
 $sql->execute([
	$_REQUEST['login'],$_REQUEST['password'],$_REQUEST['name']]);
 echo 'ユーザー情報を登録しました。';
 echo '<br>';
 echo '<div><a href="http://localhost/~itsys/practice/bu-login-input.php" >ログイン画面に戻る</a></div>';
}
?>
<?php require '../footer.php'; ?>









