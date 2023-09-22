<?php require '../header.php'; ?>
<style>
    body {
        font-size: 20px;
        background-color: lightsteelblue;
        border-left: 0.5px solid darkgray;
        border-right: 0.5px solid darkgray;
        background-image: url(images/renga.png);
        background-repeat: y-repeat;
        background-size: 45%;
        
    }
    .inline {
        width: 800px;
        margin: 30px auto 0 auto;
        padding-top: 40px;
        padding-left: 30px;
        border-left: 0.5px solid gray;
        border-right: 0.5px solid gray;
        background-color: #FAEBD7;

    }
    .container1 {
        display: flex;
    }
    .noticeinfo {
        width: 100px;
        display: inline;
        border: 0.5px dotted gray;
        background-color: #FFA07A; 
        text-align: center;
        color: cornsilk;
    }
    .noticename {
        margin-left: 20px;
    }
    .space {
        margin-top: 5px;
    }
    #name {
        margin-left: 20px;
        width: 300px;
        height: 25px;
        font-size: 20px;
        background-color: white;
        border: 0.5px solid grey;
    }
    #message {
        width: 600px;
        height: 200px;
        text-align: left;
        margin-top: 5px;
        border: 1px solid grey;
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
        background-color: lightsteelblue;
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
<body>
    <div class=inline>
        <h1>掲示板</h1>
        <div class="container1">
            <div class="noticeinfo">書き込む</div>
            <div class="noticename">名前</div>
            <form action="bulltien.php" method="post">
                <input type="hidden" name="command" value="insert">
                <!-- 主キー自動振り番　 入力なし-->
                <div>
                    <input id="number" type="hidden" name="number">
                </div>
                <!-- 氏名 -->
                <div>
                    <input id="name" type="text" name="name">
                </div>
                <!-- 時間 -->
                <div>
                    <input id="time" type="hidden" name="time">
                </div>
        </div>
        <!-- 投稿内容 -->
        <div>
            <input id="message" type="message" name="message">
        </div>
        <!-- 投稿ボタン -->
        <div>
            <input type="submit" value="投稿" class="button_post">
        </div>
        </form>
        <?php
        //データベース接続
        $pdo = new PDO('mysql:host=localhost;dbname=bulltienboard;charset=utf8', 'root', 'mariadb');
        if (isset($_REQUEST['command'])) {
            switch ($_REQUEST['command']) {
                    //空のメッセージは禁止
                case 'insert':
                    if (empty($_REQUEST['name'] & $_REQUEST['message'])) break;
                    //データ準備
                    $sql1 = $pdo->prepare('insert into conversation values(null, ?, null, ?)');
                    // 実行_データベースにデータ入る
                    $sql1->execute([$_REQUEST['name'], $_REQUEST['message']]);
                    
                    //リダイレクトの処理 二重投稿対策 ※出力前に行うのがPoint
                    header("Location:http://localhost/~itsys/practice/bulltien.php");
                    exit();

                    break;

                    //削除
                case 'delete':
                    $sql3 = $pdo->prepare('delete from conversation where number=?');
                    $sql3->execute([$_REQUEST['number']]);
                    break;
            }
        }
        //配列から取り出し
        foreach ($pdo->query('select*from conversation order by number desc') as $row) {
            echo '<form  action="bulltien.php" method="post" >';
            echo '<input type="hidden" name="command" value="update">';
            //echo '<input type="hidden" name="number" value="',
            //$row['number'], '">';
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
    </div>
</body>
</html>









