<?php 
session_start(); 
//トークン　GET側①開始
$token = filter_input(INPUT_POST,'token');
echo $token;
echo '<br>';
echo $_SESSION['token'];
if(empty($_SESSION['token'])||$token !==$_SESSION['token']) 
//不正な処理なので終了
die('正規の画面からご利用ください');//適切なエラーメッセージを表示
//トークン　GET側①完了
?>
<?php
//データベース接続
$pdo = new PDO('mysql:host=localhost;dbname=bulltienboard;charset=utf8', 'root', 'mariadb');
if (isset($_REQUEST['command'])) {
    switch ($_REQUEST['command']) {
            //空のメッセージは禁止
        case 'insert':
            if (empty($_REQUEST['message'])) break;
            //データ準備
            $sql1 = $pdo->prepare('insert into conversation values(null, null, ? , ?)');
            // 実行_データベースにデータ入る
            $sql1->execute([$_REQUEST['message'], $_SESSION['user']['login']]);
            break;
            //削除
        case 'delete':
            $sql3 = $pdo->prepare('delete from conversation where number=?');
            $sql3->execute([$_REQUEST['number']]);
            break;
    }
    //リダイレクトの処理 二重投稿対策 ※出力前に行うのがPoint
    header("Location:http://localhost/~itsys/practice/bulltien-input.php");
}
?>
