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
    input[type="text"],[type="password"] {
        margin-bottom: 15px;
        height: 25px;
        width: 250px;
    }
    input[type="submit"] {
        margin-left: 300px;
        background-color: #ffa07f;
  
        
    }
</style>
<h2>掲示板　ログイン</h2>
<form action="bu-login-result.php" method="=post">
    ログイン名
    <input type="text" name="login"><br>
    パスワード
    <input type="password" name="password"><br>
    <input type="submit" value="ログイン">
</form>
<?php require '../footer.php'; ?>
