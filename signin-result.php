<?php require '../header.php'; ?>
  <?php
  //データベース接続
  $pdo = new PDO('mysql:host=localhost;dbname=practice;charset=utf8', 'root', 'mariadb');
  //データ準備
  $sql = $pdo->prepare('insert into user values(?, ?)');

  // 実行

//成功_データベースにデータ入る
  if ($sql->execute([$_REQUEST['id'], $_REQUEST['pass']])) {
    echo '登録に成功しました';

  } else {
    //正規表現縛りがないのでここは正しくできない
    echo '登録に失敗しました';
  }
  ?>
<?php require '../footer.php'; ?>


