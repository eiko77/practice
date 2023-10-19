<?php require '../header.php'; ?>
<style>
    /* body {
        background-color: lightsteelblue;
        margin-left: 30px;
    }
    h2{
        margin-top: 50px;
        margin-bottom: 40px;
    }
    /* input[type="text"],[type="password"] {
        margin-bottom: 15px;
        height: 25px;
        width: 250px;
        
    } */
    /* input[type="submit"] {
        margin-left: 300px;
        background-color: orange;
    } */ */
</style>
<?php
$login=$password=$name=''; //各情報を保存する変数_空の文字列代入
if (isset($_SESSION['user'])) { //セッションデータに顧客情報の登録があるか？
 $login=$_SESSION['user']['login']; //true 各情報の呼び出し変数に登録 ↓
 $password=$_SESSION['user']['password'];
 $name=$_SESSION['user']['name'];
}
// 顧客情報の表示 入力画面
echo '<h2>新規ユーザー登録内容</h2>';
echo '<form action="bu-sign-result.php" method="post">';
echo '<table>';
echo '<tr><td>お名前</td><td>';
echo '<input type="text" name="name" value="', $name, '">';
echo '</td></tr>';
echo '<tr><td>ログインID</td><td>';
echo '<input type="text" name="login" value="', $login, '">';
echo '</td></tr>';
echo '<tr><td>パスワード</td><td>';
echo '<input type="password" name="password" value="', $password, '">';
echo '</td></tr>';
echo '</table>';
echo '<input type="submit" value="確定">';
echo '</form>';
?>
<?php require '../footer.php'; ?>
