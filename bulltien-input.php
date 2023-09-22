<?php session_start();
//トークン確認　開始①
if(empty($_SESSION['token'])) {
    $token =bin2hex(openssl_random_pseudo_bytes(24));
    $_SESSION['token'] =$token;
}else {
    $token = $_SESSION['token'];
}
//トークン確認　完了①
?>
<?php require '../header.php'; ?>

<style>
    body {
        font-size: 20px;
        margin-left: 50px;
        background-color: lightsteelblue;
        
        /* background-image: url(images/renga.png); */
        background-repeat: y-repeat;
        background-size: 45%;
    }
    .container1 {
        display: flex;
    }
    .noticeinfo {
        width: 100px;
        display: inline;
        
        background-color: bisque;
        text-align: center;
    }
    .noticename {
        margin-left: 30px;
        font-size: 25px;
    }
    .space {
        margin-top: 5px;
    } 
    #message {
        width: 600px;
        height: 200px;
        text-align: left;
        margin-top: 5px;
        border: white;
        font-size: 20px;
        word-break: break-all;
        word-wrap: normal;
        background-color: white;
    }

    input[type="submit"] {
        margin-top: 15px;
        margin-left: 500px;
        width: 80px;
        height: 30px;
    }
    .button_post {
        font-size: 15px;
        width: 80px;
        background-color: #FFA07A;
        border: 0.5px solid grey;
    }
    #postedtime {
        margin-left: 20px;
        font-size: 15px;
    }
    #postedmessage {
        width: 600px;
        margin-top: 25px;
        margin-bottom: 25px;
    }
</style>

<?php


//login状態ならば、bunlltien-inputのmessageを送る
if (isset($_SESSION['user'])) {

    
// $sql=$pdo->prepare('select * from conversation where user_id=?');
//  $sql->execute([$login, $_REQUEST['login']]);

echo  '<h1>掲示板</h1>';
echo  '<div class="container1">';
echo  '<div class="noticeinfo">書き込む</div>';
echo  '<div class="noticename">', $_SESSION['user']['name'], 'さんの投稿</div>';
echo  '<form action="bulltien-output.php" method="post">';
echo  '<input type="hidden" name="command" value="insert">';       
echo '<input id="number" type="hidden" name="number">
        </div>';
echo '<div>';
echo '<input id="time" type="hidden" name="time">
        </div>';
echo '</div>';
echo '<div>';
echo '<input id="message" type="message" name="message">';
echo '</div>';
echo '<div>';
echo '<input id="user_id" type="hidden" name="user_id">
';
echo '<div>';
echo '<div>';
//トークン②開始_POST
echo '<input type="hidden" name="token" value="',htmlspecialchars($token, ENT_COMPAT,'UTF-8'),'">';
//トークン②終了
echo '<input type="submit" value="投稿" class="button_post">';
echo '<div>';
echo '</form>';

} else { //ログイン状態ではない
    echo 'ログインをしてください';
}

//----------------------------------
//データベース接続
$pdo = new PDO('mysql:host=localhost;dbname=bulltienboard;charset=utf8', 'root', 'mariadb');

foreach ($pdo->query('select*from conversation,user
        where user.login= conversation.user_id
        order by number desc') as $row) {
    echo '<form >';
    echo '<input type="hidden" name="command" value="update">';
    echo '<input type="hidden" name="number" value="',
    $row['number'], '">';
    //配列から出力した要素を利用して画面表示
    echo '<div class="space"></div>';
    echo '<div class="container1">';
    echo '<div id="postednumber">';
    echo '<label for="number">No：</label>';
    echo $row['number'];
    echo '</div>';
    echo '<div id="postedname" >';
    echo '<label for="name">　名前：</label>';
    echo $row['name'];
    echo '</div>';
    echo '<div id="postedtime">';
    echo $row['time'];
    echo '</div>';
    echo '</div>';
    echo '<div id="postedmessage">';
    echo $row['message'];
    echo '</div>';
    //削除ボタン

    echo '<form class="num" action="bulltien.php" method ="post">';
    echo '<input type="hidden" name="command" value="delete">';
    echo '<input type="hidden" name="number" value="', $row['number'], '">';
    echo '<input type="submit" value="削除">';
    echo '</form><br>';
    echo '<div>----------------------------------------------------------------------</div>';
    echo "\n";
}


?>
</body>

</html>