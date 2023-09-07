<?php require '../header.php'; ?>
<p>
  <?php
//データベース接続
$pdo = new PDO('mysql:host=localhost;dbname=practice;charset=utf8', 'root', 'mariadb');
//データ準備
$sql = $pdo->prepare('insert into user values(?, ?)');


//ID未入力
if (empty($_REQUEST['id'])) {
  echo 'IDが未入力です';

  //ID入力ミス
} else if
//preg_match ()&&()
(!preg_match('/^[0-9]+$/',$_REQUEST['id'])) {
  echo '数字を正しく入力してください';


//PW入力ミス
} else if
(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/',$_REQUEST['pass'])) {
  echo 'パスワードを正しく入力してください';

//実行
} else if 
 ($sql->execute([$_REQUEST['id'], $_REQUEST['pass']])) {//配列
  echo '登録に成功しました';
  
}else {
  echo '登録に失敗しました';
}

?>
<?php require '../footer.php'; ?>


