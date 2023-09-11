<?php require '../header.php'; ?>
<style>
    .container1 {
        display: flex;
    }

    #name {
        margin-left: 20px;
        width: 200px;
        height: 25px;
        font-size: 20px;
    }

    #message {
        width: 600px;
        height: 200px;
        text-align: left;
        margin-top: 10px;
        border: 1px solid grey;
        font-size: 20px;
        display: table-cell;
        vertical-align: top;
        word-wrap: normal;
    }

    input[type="submit"] {
        margin-top: 15px;
        margin-left: 500px;
        width: 80px;
        height: 30px;
    }
</style>

<?php
//データベース接続
$pdo = new PDO('mysql:host=localhost;dbname=bulltienboard;charset=utf8', 'root', 'mariadb');
if (isset($_REQUEST['command'])) {
    switch ($_REQUEST['command']) {
            //データ追加処理の問題
        case 'insert':
            if (
                empty($_REQUEST['message'])
            ) break;
            //データ準備
            $sql = $pdo->prepare('insert into conversation value(null,?,?,?)');
            // 実行_データベースにデータ入る
            $sql->execute([$_REQUEST['name'], $_REQUEST['date'], $_REQUEST['message']]);
            break;
            //削除
        case 'delete':
            $sql = $pdo->prepare('delete from conversation where number=?');
            $sql->execute([$_REQUEST['number']]);
            break;
    }
}
//配列から取り出し
foreach ($pdo->query('select*from conversation') as $row) {
    echo '<form  action="bulltienboard.php" method="post">';

    echo '<input type="hidden" name="command" value="update">'; //ここ＿update

    echo '<input id="number" type="hidden" name="number" value="', $row['number'], '">';
    echo '<div>';

    echo '<label for="number">No：</label>';
    echo $row['number'];
    echo '</div>';
    echo '<div>';

    echo '<label for="name">名前</label>';


    // echo '<input type="date" name="date" value="', $row['date'], '">';
    // echo '</div>';
    // //日付
    // echo '<label for="date">名前</label>';
    // echo '<input type="text" name="name" value="', $row['name'], '">';
    // echo '</div>';
    // echo '<div>';
    // echo '<label for="date"></label>';
    // echo '<input type="text" name="message" value="', $row['message'], '">';
    // echo '</div>';
    // echo '<div>';
    // //ここまで


    //echo '<label for="publisher"></label>';//いいね　どうする？
    //echo '<input type="text" name="publisher" value="', $row['evaluation'], '">';
    //echo '</div>';

    // //更新ボタン_不要
    // echo '<div>';
    // echo '<input type="submit"  value="更新">';
    // echo '</div>';
    // echo '</form><br>';
    // echo "\n";

    //削除ボタン
    echo '<form class="id" action="bulltienboard.php" method ="post">';
    echo '<input type="hidden" name="command" value="delete">';
    echo '<input type="hidden" name="number" value="', $row['number'], '">';
    echo '<input type="submit" value="削除">';
    echo '</form><br>';
    echo '<div>----------------------------------------</div>';
    echo "\n";
}
?>
<?php
echo '<h2>２ちゃんねる掲示板</h2>';
//入力フォーム_名前　日付は自動
echo '<div class="container1">';
echo '<div class="notice">名前</div>';
echo '<form action="bulltienboard.php" method ="post">';
echo '<div>';
echo '<input id="number" type="hidden" name="number">';
echo '</div>';
echo '<div>';
echo '<input id="name" type="text" name="name">';
echo '</div>';
echo '<div>';
echo '<input id="date" type="hidden" name="date">';
echo '</div></div>';
//入力フォーム_会話
echo '<div>';
echo '<input id="message" type="text" name="conversation">';
echo '</div>';
echo '<div>';
echo '<input type="submit" value="投稿">';
echo '</div>';
echo '</form>';
?>
<?php require '../footer.php'; ?>