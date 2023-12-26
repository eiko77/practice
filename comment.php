<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-size: 20px;
            background-color: lightsteelblue;
            border-left: 0.5px solid darkgray;
            border-right: 0.5px solid darkgray;
            background-color: lightblue;
            background-repeat: y-repeat;
            background-size: 45%;
        }

        .inline {
            width: 900px;
            margin: 30px auto 0 auto;
            padding-top: 40px;
            padding-left: 30px;
            border-left: 0.5px solid gray;
            border-right: 0.5px solid gray;
            background-color: #FAEBD7;
        }

        .container1 {
            display: flex;
            width: 700px;
        }

        .container2 {
            display: flex;
            width: 700px;
        }

        .noticeinfo {
            width: 250px;
            display: inline;
            border: 0.5px dotted gray;
            background-color: lightcoral;
            text-align: center;
            color: cornsilk;
        }

        .space {
            margin-top: 5px;
        }

        .noticename {
            margin-left: 30px;
            width: 35px;
            height: 30px;
        }

        .noticename {
            width: 45px;
            text-align: right;
        }

        #name {
            margin-left: 25px;
            width: 350px;
            height: 30px;
            font-size: 20px;
            background-color: white;
            border: 0.5px solid grey;
        }

        #message {
            width: 750px;
            height: 100px;
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
            margin-left: 670px;
            width: 80px;
            height: 30px;
        }

        .button_post {
            font-size: 15px;
            width: 80px;
            background-color: lightsteelblue;
            border: 0.5px solid grey;
            text-align: centert;
            position: relative;
            margin-bottom: 20px;
            margin-left: 670px
        }

        #namelavel {
            width: 100px;
            margin-left: 20px;
        }

        #postedname {
            width: 200px;
            margin-left: 20px;
        }

        #postedtime {
            margin-left: 20px;
            font-size: 18px;
        }

        #postedmessage {
            width: 600px;
            margin-top: 30px;
            padding-left: 80px;
            margin-bottom: 25px;
        }

        #delete_btn {
            text-align: left;
            width: 30px;
            margin-left: -600px;
            margin-top: -20px;
        }

        #eva_btn {
            margin-left: 690px;
            background-color: lightcoral;
            color: white;
        }

        #eva {
            margin-left: 50px;
            margin-top: 18px;
            text-align: left;
            color: coral;
        }
    </style>
</head>

<body>

    <?php
    //データベース接続
    $pdo = new PDO('mysql:host=localhost;dbname=bulltienboard;charset=utf8', 'root', 'mariadb');
    if (isset($_REQUEST['command'])) {
        switch ($_REQUEST['command']) {
            case 'insert':
                if (!empty($_REQUEST['name'] & $_REQUEST['message'])) { //空のメッセージは禁止
                    //データ準備_
                    $sql1 = $pdo->prepare('insert into comment values(null, ?, null, ?, 0)');
                    // 実行_データベースにデータ入る
                    $sql1->execute([$_REQUEST['name'], $_REQUEST['message']]);
                    //★リダイレクトの処理 いいねの数字が更新時増えないように
                    header("Location:http://localhost/~itsys/practice/comment.php"); // 新しいページにリダイレクト
                    exit(); // リダイレクト後にスクリプトの実行を終了
                }
                break;
                //更新＿いいね実装
            case 'update':
                if (isset($_REQUEST['evaluation'])) {
                    $sql2 = $pdo->prepare('update comment set evaluation = evaluation + 1 where number=?');
                    $sql2->execute([$_REQUEST['number']]);
                    //参考：阪崎さんの記入場所 但し阪崎さんのプログラムは入出力別ファイル・
                }
                //★リダイレクトの処理① 二重投稿対策 ※出力前に行うのがPoint
                header("Location:http://localhost/~itsys/practice/comment.php");
                exit();

                break;
                //削除
            case 'delete':
                $sql3  = $pdo->prepare('delete from comment where number=?');
                $sql3->execute([$_REQUEST['number']]);
                //★リダイレクトの処理
                header("Location:http://localhost/~itsys/practice/comment.php"); // 新しいページにリダイレクト
                exit(); // リダイレクト後にスクリプトの実行を終了
                break;
        }
    }
    ?>
    <div class=inline>
        <h1>コメント</h1>
        <div class="container1">
            <div class="noticeinfo">コメントを書いてください</div>
            <div class="noticename">名前</div>
            <form action="comment.php" method="post">
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
        <!-- いいねボタン　予定-->
        <div>
            <input id="evaluation" type="hidden" name="evaluation">
        </div>
        <!-- 投稿ボタン -->
        <div>
            <input type="submit" value="投稿" class="button_post">
        </div>
        <div>-------------------------------------------------------------</div>
        </form>



        <?php
        //配列から取り出し
        foreach ($pdo->query('select*from comment order by number desc') as $row) {
            //配列から出力した要素を利用して画面表示
            echo '<div class="space"></div>';
            echo '<div class="container1">'; //container1_start
            echo '<div id="postednumber">';
            echo '<label for="number">No：</label>';
            echo '</div>';
            echo '<div>';
            echo $row['number'];
            echo '</div>';
            echo '<div id="namelavel" >';
            echo '<label for="name">　名前：</label>';
            echo '</div>';
            echo '<div id="postedname">';
            echo $row['name'];
            echo '</div>';
            echo '<div id="postedtime">';
            echo $row['time'];
            echo '</div>';

            //削除ボタン
            echo '<div id="delete_btn">';
            echo '<form class="num" action="comment.php" method ="post">';
            echo '<input type="hidden" name="command" value="delete">';
            echo '<input type="hidden" name="number" value="', $row['number'], '">';
            echo '<input type="submit" value="削除">';
            echo '</form><br>';
            echo '</div>';
            echo '</div>'; //container1_end
            echo '<div id="postedmessage">';
            echo $row['message'];
            echo '</div>';

            //更新　いいねボタンを押すと数字が増える
            echo '<form class="iine" action="comment.php" method ="post">';
            echo '<input type="hidden" name="number" value="', $row['number'], '">';
            echo '<input type="hidden" name="command" value="update">';
            echo '<div class="container2">';
            echo '<div>';
            echo '<input type="submit" id="eva_btn" name="evaluation" value="いいね">';
            echo '</div>';
            echo '<div id="eva">';
            echo $row['evaluation'];
            echo '</div>';
            echo '</div>';
            echo '</form><br>';
            //echo "\n";
            echo '<div>-------------------------------------------------------------</div>';
            echo "\n";
        }
        ?>
    </div>
</body>

</html>