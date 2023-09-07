<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    p {
      color: red;
    }

  label[for="id"] {
    margin-left: 60px;
  }

  input[type="submit"] {
    margin-top: 30px;
    margin-left: 200px;
  }
  </style>
</head>
<body>
  <form action="login-result3.php" method ="post">
    <label for="id">ID</label>
    <input type="text" name="id" id="id">
<br>
<label for="pass">パスワード</label>
    <input type="password" name="pass" id="pass">
    <br>
    <input type="submit" value="確定">
  </form>
</body>
</html>