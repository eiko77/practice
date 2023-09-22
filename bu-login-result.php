<?php 
session_start(); 
?>
<?php require '../header.php'; ?>
<style>
    body {
        background-color: lightsteelblue;
        margin-left: 30px;
    }
    h2{
        margin-top: 50px;
        margin-bottom: 40px;
    }
    a {
        font-size: 20px;
     }
</style>
<?php
//同名がログインしている場合があるのでいったんデータクリア
unset($_SESSION['user']);
//データベース接続
$pdo=new PDO('mysql:host=localhost;dbname=bulltienboard;charset=utf8',
'root', 'mariadb');
$sql=$pdo->prepare('select * from user where login=? and password=?');
$sql->execute([$_REQUEST['login'], $_REQUEST['password']]);
foreach ($sql as $row) {
    $_SESSION['user']=[
        'login'=>$row['login'],'password'=>$row['password'],'name'=>$row['name']];
}
if (isset($_SESSION['user'])) {
    echo '<h2>Welcome、', $_SESSION['user']['name'], 'さん!</h2>';
    echo '<div class="url_buttien"><a href="http://localhost/~itsys/practice/bulltien-input.php" >掲示板へ</a></div>';

} else {
    echo '<div>ログイン名またはパスワードが違います。</div>';
    echo '<div>新規会員登録がお済みでない方は下記のリンクよりお願いします。</div><br>';
    echo '<div ><a href="http://localhost/~itsys/practice/bu-sign-input.php" class="url_newuser">新規登録</a></div>';
   
}
?>
<?php require '../footer.php'; ?>