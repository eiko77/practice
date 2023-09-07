<?php require '../header.php'; ?>
<style>
h1 {
  margin-left: 50px;
}
</style>
<?php
echo '<h1>書籍一覧</h1>';
echo '<div>----------------------------------------</div>';
//データベース接続
$pdo = new PDO('mysql:host=localhost;dbname=books;charset=utf8', 'root', 'mariadb');

if (isset($_REQUEST['command'])) {
  switch ($_REQUEST['command']) {
      //データ追加処理の問題
    case 'insert':
      if (
        empty($_REQUEST['bookname'])
        //||!preg_match()) あとで
      ) break;
      //データ準備
      $sql = $pdo->prepare('insert into booklist value(null,?,?,?,?,?)');

      // 実行_データベースにデータ入る
      $sql->execute([$_REQUEST['bookname'], $_REQUEST['author'], $_REQUEST['publisher'], $_REQUEST['price'],$_REQUEST['isbm']]);
      break;
      //更新
    case 'update':
      if (
        empty($_REQUEST['bookname'])
        //||!preg_match()) あとで
        //エラーメッセージ
      ) break;

      $sql2 = $pdo->prepare(
        'update booklist set bookname=?,author=?,publisher=?,price=?,isbm=? where bookid=?'
      );
      $sql2->execute(
        [$_REQUEST['bookname'], $_REQUEST['author'], $_REQUEST['publisher'], $_REQUEST['price'], $_REQUEST['isbm'], $_REQUEST['bookid']]
      );
      break;
      //削除
    case 'delete':
      $sql3 = $pdo->prepare('delete from booklist where bookid=?');
      $sql3->execute([$_REQUEST['bookid']]);
      break;
  }
}
//配列から取り出し
foreach ($pdo->query('select*from booklist') as $row) {
  
  echo '<form  action="books-result.php" method="post">';

  echo '<input type="hidden" name="command" value="update">';
  
  
  echo '<input type="hidden" name="bookid" value="', $row['bookid'], '">';
  echo '<div>';
  echo '<label for="bookid">番号：　</label>';
  echo $row['bookid'];
  echo '</div>';
  echo '<div>';
  echo '<label for="bookname">書籍名</label>';
  echo '<input type="text" name="bookname" value="', $row['bookname'], '">';
  echo '</div>';
  echo '<div>';
  echo '<label for="author">著者名</label>';
  echo '<input type="text" name="author" value="', $row['author'], '">';
  echo '</div>';
  echo '<div>';
  echo '<label for="publisher">出版社</label>';
  echo '<input type="text" name="publisher" value="', $row['publisher'], '">';
  echo '</div>';
  echo '<div>';
  echo '<label for="price">価格（税込）</label>';
  
  echo '<input type="number" name="price" value="', $row['price'], '">';
  echo '</div>';
  echo '<div>';
  echo ' <label for="isbm">商品番号</label>';
 
  echo '<input type="text" name="isbm" value="', $row['isbm'], '">';
  echo '</div>';

  //更新ボタン_トラブル
  echo '<div>';
  echo '<input type="submit"  value="更新">';
  echo '</div>';
  
  echo '</form><br>';
  echo "\n";

  //削除ボタン
  echo '<form class="id" action="books-result.php" method ="post">';
  echo '<input type="hidden" name="command" value="delete">';
  echo '<input type="hidden" name="bookid" value="', $row['bookid'], '">';
  echo '<input type="submit" value="削除">';
  echo '</form><br>';
  echo '<div>----------------------------------------</div>';
  echo "\n";
}
?>

<!-- ここでも追加 -->
<form action="books-result.php" method="post">
  <input type="hidden" name="command" value="insert">
  <!-- 書籍名 -->
  <label for="bookname">書籍名</label>
  <input type="hidden" name="bookid">

  <input type="text" name="bookname">
  <!-- 著者名 -->
  <label for="author">著者名</label>
  <input type="text" name="author">
  <!-- 出版社 -->
  <label for="publisher">出版社</label>
  <input type="text" name="publisher">
  <!-- 価格（税込） -->
  <label for="price">価格（税込）</label>
  <input type="number" name="price">
  <!-- 商品番号 -->
  <label for="isbm">商品番号</label>
  <input type="text" name="isbm">

  <div class="th2"><input type="submit" value="追加"></div>

</form>
<?php require '../footer.php'; ?>