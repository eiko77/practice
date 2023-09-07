<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      font-size: 20px;   
      color: crimson; 
    }
  </style>
</head>


<body>
  <h1>書籍管理システム_test </h1>
  <h3>本の情報を入力してください。（書籍名は必須）</h3>


  <form action="books2-result.php" method="post">
<input type="hidden" name="command" value="insert">
    <!-- 主キー自動振り番　 入力なし-->
    <div class=bookid></div>
    <!-- 書籍名 -->
    <label for="bookname">書籍名</label>
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
    <!-- 備考-->
    <label for="memo">備考</label>
    <textarea name="memo" id="" cols="30" rows="10"> 
    </textarea>
     
    <!-- 追加ボタン -->
    <input type="submit" value="追加">
  </form>
</body>
</html>