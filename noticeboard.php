<?php require '../header.php'; ?>
<style>
    #message {
        width: 400px;
        height: 100px;
        text-align: left;
    }
</style>
<h2>掲示板</h2>
<p>投稿するメッセージを入力してください</p>

<form action="noticeboard.php" method ="post">
<div>
<input id="message" type="text" name="message">
</div><br>
<div>
<input type="submit" value="投稿">
</div>
</form>
<!-- ----------------------------------- -->
<!-- 過去の投稿----------------------------------- -->


<?php 
$file='board.txt';
// ファイルがあればjson形式から文字列に変換
if(file_exists($file)) {
    $board=json_decode(file_get_contents($file));   
}
//配列boardにメッセージを入れる
$board[]=htmlspecialchars($_REQUEST['message']);
//指定した文字列を書き込み、メッセージをjson形式へ変換
$result =file_put_contents($file, json_encode($board));
//書き込めなかったらエラー
if($result == false) {
    echo 'error';
}

foreach($board as $message) {
    echo '<p?>',$message,'</p><hr>';
}
?>



<?php require '../footer.php'; ?>





<?php require '../footer.php'; ?>