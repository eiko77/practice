<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<p>ID パスワードを入力してください</p>



  <form action="signin-result_2.php" method ="post">
    <label for="id">ID</label>
    <input type="text" name="id" >
    <p>※IDは半角数字（大文字、小文字、数字を１文字以上入力。10文字以上</p>
  
<br>
<label for="pass">パスワード</label>
    <input type="password" name="pass">
    <p>※PWは半角英数字を入力。８文字以上</p>
    <input type="submit" value="確定">
  </form>
</body>
</html>